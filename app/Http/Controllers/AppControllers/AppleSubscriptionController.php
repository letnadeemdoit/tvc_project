<?php

namespace App\Http\Controllers\AppControllers;

use App\Services\AppleJWSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;
use Carbon\Carbon;

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
        ]);

        $validator = Validator::make($inputs, [
            'transaction_id'          => 'required|string',
            'product_id'              => 'required|string',
            'plan'                    => 'required|string',
            'period'                  => 'required|string',
            'status'                  => 'required|string',
            'apple_jwt_token'         => 'nullable|string',
            'expires_at'              => 'nullable|date',
            'transaction_type'        => 'required|string',
            'original_transaction_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
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

            // Calculate dynamic status based on expiry date
            $calculatedStatus = $this->calculateSubscriptionStatus(
                $verifiedData['expires_at'] ?? $inputs['expires_at']
            );

            $subscriptionData = [
                'subscription_id' => $inputs['transaction_id'],
                'plan_id' => $inputs['product_id'],
                'plan' => $inputs['plan'],
                'period' => $inputs['period'],
                'status' => $calculatedStatus,
                'platform' => 'apple',
                'apple_jwt_token' => $inputs['apple_jwt_token'] ?? null,
                'expires_at' => $verifiedData['expires_at'] ?? $inputs['expires_at'],
                'transaction_type' => $inputs['transaction_type'],
            ];

            // Add original_transaction_id if provided
            if (!empty($inputs['original_transaction_id'])) {
                $subscriptionData['original_transaction_id'] = $inputs['original_transaction_id'];
            }

            if ($existingSubscription) {
                $existingSubscription->update($subscriptionData);

                Log::info('Apple subscription updated successfully', [
                    'user_id' => $user->user_id,
                    'subscription_id' => $existingSubscription->id,
                ]);

                return response()->json([
                    'success' => true,
                    'subscription' => $existingSubscription->fresh(),
                    'message' => 'Apple subscription updated successfully',
                ]);
            } else {
                $subscriptionData['user_id'] = $user->user_id;
                $subscriptionData['house_id'] = $user->HouseId;

                $subscription = Subscription::create($subscriptionData);

                Log::info('Apple subscription created successfully', [
                    'user_id' => $user->user_id,
                    'subscription_id' => $subscription->id,
                ]);

                return response()->json([
                    'success' => true,
                    'subscription' => $subscription,
                    'message' => 'Apple subscription created successfully',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Apple subscription processing failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to process subscription: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function cancelSubscription(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'subscription_id' => 'nullable|string',
            'reason' => 'required|string',
            'cancelled_at' => 'required|date',
            'platform' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $subscription = Subscription::where('user_id', $user->user_id)
                ->where('house_id', $user->HouseId)
                ->where('platform', $inputs['platform'])
                ->first();

            if (!$subscription) {
                return response()->json([
                    'success' => false,
                    'error' => true,
                    'message' => 'Subscription not found',
                ], 404);
            }

            $subscription->update([
                'cancelled_at' => $inputs['cancelled_at'],
                'status' => $this->calculateSubscriptionStatus(
                    $subscription->expires_at,
                    $inputs['cancelled_at']
                ),
            ]);

            Log::info('Subscription cancelled successfully', [
                'user_id' => $user->user_id,
                'subscription_id' => $subscription->id,
            ]);

            return response()->json([
                'success' => true,
                'subscription' => $subscription->fresh(),
                'message' => 'Subscription cancelled successfully',
            ]);

        } catch (\Exception $e) {
            Log::error('Subscription cancellation failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to cancel subscription: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function syncSubscription(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'transaction_id' => 'required|string',
            'expires_at' => 'required|date',
            'apple_jwt_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $subscription = Subscription::where('user_id', $user->user_id)
                ->where('house_id', $user->HouseId)
                ->where('platform', 'apple')
                ->first();

            if ($subscription) {
                $subscription->update([
                    'expires_at' => $inputs['expires_at'],
                    'apple_jwt_token' => $inputs['apple_jwt_token'],
                    'status' => $this->calculateSubscriptionStatus($inputs['expires_at']),
                ]);

                Log::info('Subscription synced successfully', [
                    'user_id' => $user->user_id,
                    'subscription_id' => $subscription->id,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscription synced successfully',
            ]);

        } catch (\Exception $e) {
            Log::error('Subscription sync failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'error' => true,
                'message' => 'Failed to sync subscription: ' . $e->getMessage(),
            ], 500);
        }
    }

    protected function calculateSubscriptionStatus($expiresAt, $cancelledAt = null)
    {
        if (!$expiresAt) {
            return 'INACTIVE';
        }

        $now = Carbon::now();
        $expiryDate = Carbon::parse($expiresAt);
        $gracePeriodEnd = $expiryDate->copy()->addDays(3);

        // Check if cancelled
        if ($cancelledAt) {
            $cancelledDate = Carbon::parse($cancelledAt);
            if ($cancelledDate <= $now) {
                if ($expiryDate > $now) {
                    return 'CANCELLED_ACTIVE';
                }
                return 'CANCELLED';
            }
        }

        // Check expiry status
        if ($expiryDate > $now) {
            return 'ACTIVE';
        } else if ($gracePeriodEnd > $now) {
            return 'GRACE_PERIOD';
        } else {
            return 'EXPIRED';
        }
    }

    protected function verifyAppleTransaction(array $inputs): array
    {
        $jwtToken = $inputs['apple_jwt_token'] ?? null;

        if ($jwtToken) {
            if (!$this->appleJWSService->isAvailable()) {
                Log::warning('Apple JWS service not available', [
                    'transaction_id' => $inputs['transaction_id']
                ]);

                return [
                    'valid' => true,
                    'message' => 'JWT service unavailable - transaction accepted',
                    'expires_at' => $inputs['expires_at'] ?? null
                ];
            }

            try {
                $decodedJWT = $this->appleJWSService->decodeJWT($jwtToken);
                $this->appleJWSService->validateTransaction($decodedJWT, $inputs['transaction_id']);

                $subscriptionInfo = $this->appleJWSService->extractSubscriptionInfo($decodedJWT);

                return [
                    'valid' => true,
                    'message' => 'StoreKit 2 verification successful',
                    'expires_at' => $subscriptionInfo['expires_date'],
                ];

            } catch (\Exception $e) {
                Log::error('StoreKit 2 verification failed', [
                    'transaction_id' => $inputs['transaction_id'],
                    'error' => $e->getMessage()
                ]);

                return [
                    'valid' => true,
                    'message' => 'JWT verification failed - accepting without verification',
                    'expires_at' => $inputs['expires_at'] ?? null
                ];
            }
        }

        return [
            'valid' => true,
            'message' => 'Transaction accepted without verification',
            'expires_at' => $inputs['expires_at'] ?? null
        ];
    }
}
