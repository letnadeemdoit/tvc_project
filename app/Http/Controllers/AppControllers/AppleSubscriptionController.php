<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\AppControllers\BaseController;
use App\Services\AppleJWSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;

class AppleSubscriptionController extends BaseController
{
    protected $appleJWSService;

    public function __construct(AppleJWSService $appleJWSService)
    {
        $this->appleJWSService = $appleJWSService;
    }

    public function processAppleSubscription(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();

        Log::info('Apple subscription request received', [
            'user_id' => $user->user_id ?? null,
            'transaction_id' => $inputs['transaction_id'] ?? null,
            'verification_method' => $inputs['verification_method'] ?? 'unknown'
        ]);

        $validator = Validator::make($inputs, [
            'transaction_id'          => 'required|string',
            'product_id'              => 'required|string',
            'plan'                    => 'required|string',
            'period'                  => 'required|string',
            'status'                  => 'required|string',
            'apple_jwt_token'         => 'nullable|string',
            'apple_receipt'           => 'nullable|string',
            'expires_at'              => 'nullable|date',
            'transaction_type'        => 'required|string',
            'verification_method'     => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Log::warning('Apple subscription validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);

            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $verifiedData = $this->verifyAppleTransaction($inputs);

            if (!$verifiedData['valid']) {
                Log::warning('Apple transaction verification failed', [
                    'transaction_id' => $inputs['transaction_id'],
                    'reason' => $verifiedData['message']
                ]);

                return response()->json([
                    'success' => false,
                    'error' => true,
                    'message' => $verifiedData['message'],
                ], 400);
            }

            // Check for existing subscription by user_id and house_id
            $existingSubscription = Subscription::where('user_id', $user->user_id)
                ->where('house_id', $user->HouseId)
                ->first();

            $subscriptionData = [
                'subscription_id' => $inputs['transaction_id'],
                'plan_id' => $inputs['product_id'],
                'plan' => $inputs['plan'],
                'period' => $inputs['period'],
                'status' => $inputs['status'],
                'platform' => 'apple',
                'apple_jwt_token' => $inputs['apple_jwt_token'] ?? null,
                'expires_at' => $verifiedData['expires_at'] ?? $inputs['expires_at'],
                'transaction_type' => $inputs['transaction_type'],
            ];

            if ($existingSubscription) {
                // Update existing subscription
                $existingSubscription->update($subscriptionData);

                Log::info('Apple subscription updated successfully', [
                    'user_id' => $user->user_id,
                    'house_id' => $user->HouseId,
                    'subscription_id' => $existingSubscription->id,
                    'transaction_id' => $inputs['transaction_id'],
                    'verification_method' => $inputs['verification_method'] ?? 'unknown'
                ]);

                return response()->json([
                    'success' => true,
                    'subscription' => $existingSubscription->fresh(),
                    'message' => 'Apple subscription updated successfully',
                ]);
            } else {
                // Create new subscription
                $subscriptionData['user_id'] = $user->user_id;
                $subscriptionData['house_id'] = $user->HouseId;

                $subscription = Subscription::create($subscriptionData);

                Log::info('Apple subscription created successfully', [
                    'user_id' => $user->user_id,
                    'house_id' => $user->HouseId,
                    'subscription_id' => $subscription->id,
                    'transaction_id' => $inputs['transaction_id'],
                    'verification_method' => $inputs['verification_method'] ?? 'unknown'
                ]);

                return response()->json([
                    'success' => true,
                    'subscription' => $subscription,
                    'message' => 'Apple subscription created successfully',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Apple subscription processing failed', [
                'user_id' => $user->user_id ?? null,
                'house_id' => $user->HouseId ?? null,
                'transaction_id' => $inputs['transaction_id'] ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to process subscription: ' . $e->getMessage(),
            ], 500);
        }
    }

    protected function verifyAppleTransaction(array $inputs): array
    {
        $jwtToken = $inputs['apple_jwt_token'] ?? null;
        $verificationMethod = $inputs['verification_method'] ?? 'unknown';

        // Check if JWT verification is available and we have a JWT token
        if ($jwtToken && $verificationMethod === 'StoreKit2') {

            // Check if Apple JWS service is available
            if (!$this->appleJWSService->isAvailable()) {
                Log::warning('Apple JWS service not available, accepting transaction without verification', [
                    'transaction_id' => $inputs['transaction_id']
                ]);

                return [
                    'valid' => true,
                    'message' => 'JWT service unavailable - transaction accepted without verification',
                    'expires_at' => $inputs['expires_at'] ?? null
                ];
            }

            try {
                // Decode and verify JWT
                $decodedJWT = $this->appleJWSService->decodeJWT($jwtToken);
                $this->appleJWSService->validateTransaction($decodedJWT, $inputs['transaction_id']);

                // Extract subscription info
                $subscriptionInfo = $this->appleJWSService->extractSubscriptionInfo($decodedJWT);

                Log::info('StoreKit 2 verification successful', [
                    'transaction_id' => $inputs['transaction_id'],
                    'environment' => $subscriptionInfo['environment']
                ]);

                return [
                    'valid' => true,
                    'message' => 'StoreKit 2 verification successful',
                    'expires_at' => $subscriptionInfo['expires_date'],
                    'subscription_info' => $subscriptionInfo
                ];

            } catch (\Exception $e) {
                Log::error('StoreKit 2 verification failed', [
                    'transaction_id' => $inputs['transaction_id'],
                    'error' => $e->getMessage()
                ]);

                // Fallback: accept transaction without verification
                return [
                    'valid' => true,
                    'message' => 'JWT verification failed - accepting transaction without verification',
                    'expires_at' => $inputs['expires_at'] ?? null
                ];
            }
        }

        // Accept without verification for other cases
        Log::info('Accepting Apple transaction without verification', [
            'transaction_id' => $inputs['transaction_id'],
            'has_jwt' => !empty($jwtToken),
            'verification_method' => $verificationMethod
        ]);

        return [
            'valid' => true,
            'message' => 'Transaction accepted without verification',
            'expires_at' => $inputs['expires_at'] ?? null
        ];
    }
}
