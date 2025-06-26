<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AppleJWSService
{
    protected $keysUrl = 'https://api.storekit.itunes.apple.com/in-app/v1/jwsPublicKeys';
    protected $publicKeys = null;

    // Remove constructor - use lazy loading instead
    public function __construct()
    {
        // Don't fetch keys in constructor
    }

    protected function getPublicKeys()
    {
        if ($this->publicKeys === null) {
            $this->publicKeys = $this->fetchPublicKeys();
        }
        return $this->publicKeys;
    }

    protected function fetchPublicKeys()
    {
        return Cache::remember('apple_jws_public_keys', 86400, function () {
            try {
                Log::info('Fetching Apple JWS public keys from: ' . $this->keysUrl);

                $response = Http::timeout(30)->retry(3, 1000)->get($this->keysUrl);

                if (!$response->successful()) {
                    Log::error('Apple JWS keys fetch failed', [
                        'status' => $response->status(),
                        'body' => $response->body()
                    ]);
                    throw new Exception('Failed to fetch Apple public JWS keys: HTTP ' . $response->status());
                }

                $keyData = $response->json();

                if (!isset($keyData['keys']) || !is_array($keyData['keys'])) {
                    Log::error('Invalid Apple JWS keys format', ['response' => $keyData]);
                    throw new Exception('Invalid Apple JWS keys format');
                }

                Log::info('Successfully fetched Apple JWS keys', ['count' => count($keyData['keys'])]);

                // Convert JWK keys to PEM format
                $keys = [];
                foreach ($keyData['keys'] as $key) {
                    if (isset($key['kid'])) {
                        try {
                            $keys[$key['kid']] = $this->jwkToPem($key);
                            Log::debug('Converted key to PEM', ['kid' => $key['kid']]);
                        } catch (Exception $e) {
                            Log::warning('Failed to convert key to PEM', [
                                'kid' => $key['kid'],
                                'error' => $e->getMessage()
                            ]);
                        }
                    }
                }

                if (empty($keys)) {
                    throw new Exception('No valid keys found in Apple JWS response');
                }

                return $keys;

            } catch (\Throwable $e) {
                Log::error('Failed to fetch Apple JWS keys', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                // Don't throw immediately - return empty array and let verification fail gracefully
                return [];
            }
        });
    }

    protected function jwkToPem(array $jwk): string
    {
        if (!isset($jwk['x']) || !isset($jwk['y'])) {
            throw new Exception('Invalid JWK format - missing x or y coordinates');
        }

        // Decode the base64url-encoded coordinates
        $x = $this->base64UrlDecode($jwk['x']);
        $y = $this->base64UrlDecode($jwk['y']);

        // Validate coordinate lengths for P-256
        if (strlen($x) !== 32 || strlen($y) !== 32) {
            throw new Exception('Invalid coordinate length for P-256 curve');
        }

        // Create uncompressed point (0x04 prefix + x + y)
        $publicKeyPoint = "\x04" . $x . $y;

        // ASN.1 DER encoding for P-256 public key
        // Object Identifier for prime256v1 (P-256): 1.2.840.10045.3.1.7
        $oid = "\x30\x13\x06\x07\x2a\x86\x48\xce\x3d\x02\x01\x06\x08\x2a\x86\x48\xce\x3d\x03\x01\x07";
        $publicKeyInfo = "\x30\x59" . $oid . "\x03\x42\x00" . $publicKeyPoint;

        return "-----BEGIN PUBLIC KEY-----\n" .
            chunk_split(base64_encode($publicKeyInfo), 64, "\n") .
            "-----END PUBLIC KEY-----\n";
    }

    protected function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public function isAvailable(): bool
    {
        try {
            $keys = $this->getPublicKeys();
            return !empty($keys);
        } catch (Exception $e) {
            Log::warning('Apple JWS Service not available: ' . $e->getMessage());
            return false;
        }
    }

    public function decodeJWT(string $jws): object
    {
        try {
            $parts = explode('.', $jws);
            if (count($parts) !== 3) {
                throw new Exception('Invalid JWS format');
            }

            [$headerB64, $payloadB64, $signatureB64] = $parts;

            // Decode header
            $header = json_decode($this->base64UrlDecode($headerB64), true);
            if (!$header || !isset($header['kid'])) {
                throw new Exception('Invalid or missing key ID in JWS header');
            }

            // Get the public keys (this will fetch them if not cached)
            $publicKeys = $this->getPublicKeys();

            if (empty($publicKeys)) {
                throw new Exception('No public keys available for verification');
            }

            // Get the specific public key
            $keyId = $header['kid'];
            if (!isset($publicKeys[$keyId])) {
                // Clear cache and try to refresh keys
                Cache::forget('apple_jws_public_keys');
                $this->publicKeys = null; // Reset cached keys
                $publicKeys = $this->getPublicKeys();

                if (!isset($publicKeys[$keyId])) {
                    throw new Exception('Unknown key ID: ' . $keyId);
                }
            }

            $publicKey = $publicKeys[$keyId];

            // Verify signature
            $signatureData = $headerB64 . '.' . $payloadB64;
            $signature = $this->base64UrlDecode($signatureB64);

            // Use PHP's built-in OpenSSL for ES256 verification
            $verified = openssl_verify(
                $signatureData,
                $signature,
                $publicKey,
                OPENSSL_ALGO_SHA256
            );

            if ($verified !== 1) {
                throw new Exception('JWS signature verification failed');
            }

            // Decode and return payload
            $payload = json_decode($this->base64UrlDecode($payloadB64));
            if (!$payload) {
                throw new Exception('Invalid JWS payload');
            }

            Log::info('Successfully verified Apple JWS', [
                'kid' => $keyId,
                'transaction_id' => $payload->transactionId ?? 'unknown'
            ]);

            return $payload;

        } catch (\Throwable $e) {
            Log::error('Apple JWS decode error', [
                'error' => $e->getMessage(),
                'jws_length' => strlen($jws)
            ]);
            throw new Exception('Invalid or unverifiable Apple JWS: ' . $e->getMessage());
        }
    }

    public function validateTransaction(object $decodedJWT, string $expectedTransactionId = null): bool
    {
        try {
            // Basic validation
            if (!isset($decodedJWT->transactionId)) {
                throw new Exception('Missing transaction ID in JWT');
            }

            if ($expectedTransactionId && $decodedJWT->transactionId !== $expectedTransactionId) {
                throw new Exception('Transaction ID mismatch');
            }

            // Validate required fields
            if (!isset($decodedJWT->productId)) {
                throw new Exception('Missing product ID in JWT');
            }

            // Check bundle ID (optional but recommended)
            if (isset($decodedJWT->bundleId)) {
                $expectedBundleId = config('app.apple_bundle_id', 'devdimensions.thevacationcalendar');
                if ($decodedJWT->bundleId !== $expectedBundleId) {
                    Log::warning('Bundle ID mismatch', [
                        'expected' => $expectedBundleId,
                        'received' => $decodedJWT->bundleId
                    ]);
                }
            }

            // Check environment (sandbox vs production)
            if (isset($decodedJWT->environment)) {
                Log::info('Apple transaction environment: ' . $decodedJWT->environment);
            }

            // Check if transaction is not expired (if applicable)
            if (isset($decodedJWT->expiresDate)) {
                $expiresAt = (int)$decodedJWT->expiresDate;
                if ($expiresAt < time() * 1000) { // Apple uses milliseconds
                    Log::warning('Subscription already expired', [
                        'expiresDate' => $expiresAt,
                        'transactionId' => $decodedJWT->transactionId
                    ]);
                }
            }

            return true;

        } catch (\Throwable $e) {
            Log::error('Apple JWT validation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function extractSubscriptionInfo(object $decodedJWT): array
    {
        $info = [
            'transaction_id' => $decodedJWT->transactionId ?? null,
            'product_id' => $decodedJWT->productId ?? null,
            'bundle_id' => $decodedJWT->bundleId ?? null,
            'environment' => $decodedJWT->environment ?? 'unknown',
            'purchase_date' => null,
            'expires_date' => null,
            'is_trial_period' => false,
            'subscription_group_identifier' => $decodedJWT->subscriptionGroupIdentifier ?? null,
        ];

        // Convert timestamps
        if (isset($decodedJWT->purchaseDate)) {
            $info['purchase_date'] = date('Y-m-d H:i:s', $decodedJWT->purchaseDate / 1000);
        }

        if (isset($decodedJWT->expiresDate)) {
            $info['expires_date'] = date('Y-m-d H:i:s', $decodedJWT->expiresDate / 1000);
        }

        // Check for trial period
        if (isset($decodedJWT->isTrialPeriod)) {
            $info['is_trial_period'] = (bool)$decodedJWT->isTrialPeriod;
        }

        return $info;
    }
}
