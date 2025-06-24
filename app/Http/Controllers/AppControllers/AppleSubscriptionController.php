<?php

namespace App\Http\Controllers\AppControllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppleSubscriptionController extends BaseController
{
    public function processAppleSubscription(Request $request)
    {
        $user = Auth::user();
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'transaction_id'      => 'required|string',
            'product_id'          => 'required|string',
            'plan'                => 'required|string',
            'period'              => 'required|string',
            'status'              => 'required|string',
            'apple_jwt_token'     => 'required|string',
            'expires_at'          => 'required|date',
            'transaction_type'    => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        try {
            $existing_subscription = Subscription::where('user_id', $user->user_id)
                ->where('house_id', $user->HouseId)
                ->where('platform', 'apple')
                ->first();

            if ($existing_subscription) {
                $existing_subscription->update([
                    'subscription_id'   => $inputs['transaction_id'],
                    'plan_id'           => $inputs['product_id'],
                    'plan'              => $inputs['plan'],
                    'period'            => $inputs['period'],
                    'status'            => $inputs['status'],
                    'apple_jwt_token'   => $inputs['apple_jwt_token'],
                    'expires_at'        => $inputs['expires_at'],
                    'transaction_type'  => $inputs['transaction_type'],
                ]);

                return response()->json([
                    'success' => true,
                    'subscription' => $existing_subscription,
                    'message' => 'Apple subscription updated successfully',
                ]);
            }

            // Create new subscription if not exists
            $subscription = Subscription::create([
                'user_id'            => $user->user_id,
                'house_id'           => $user->HouseId,
                'subscription_id'    => $inputs['transaction_id'],
                'plan_id'            => $inputs['product_id'],
                'plan'               => $inputs['plan'],
                'period'             => $inputs['period'],
                'status'             => $inputs['status'],
                'platform'           => 'apple',
                'apple_jwt_token'    => $inputs['apple_jwt_token'],
                'expires_at'         => $inputs['expires_at'],
                'transaction_type'   => $inputs['transaction_type'],
            ]);

            return response()->json([
                'success' => true,
                'subscription' => $subscription,
                'message' => 'Apple subscription created successfully',
            ]);

        } catch (\Exception $e) {
            Log::channel('paypal')->error('Create/Update Apple Subscription Error: ', [$e->getMessage()]);
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
