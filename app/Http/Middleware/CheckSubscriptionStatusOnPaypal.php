<?php

namespace App\Http\Middleware;

use App\Models\House;
use App\Models\ProcessingSubscription;
use App\Models\Subscription;
use App\Models\User;
use Closure;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class CheckSubscriptionStatusOnPaypal
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            $paypal = PayPal::setProvider();
            $paypal->getAccessToken();
            $user = auth()->user();
            $user_id = $user->user_id;

            $userSubscription = Subscription::where('user_id', $user_id)->latest()->first();


            $processingSubscription = null;
//            if (isset($paypalSubscription['plan_id'])){
//                $processingSubscription = ProcessingSubscription::where('plan_id', $paypalSubscription['plan_id'])->latest()->first();
//            }
//            if (!is_null($processingSubscription) && $processingSubscription->status === 'APPROVAL_PENDING') {
//                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);
//                if (isset($paypalSubscription['status']) && $paypalSubscription['status'] != 'APPROVAL_PENDING') {
//                    $processingSubscription->update([
//                        'status' => $paypalSubscription['status']
//                    ]);
//
//                    if ($processingSubscription['status'] === 'ACTIVE'){
//                        $userSubscription->update([
//                            'status' => $processingSubscription['status']
//                        ]);
//                        $processingSubscription->delete();
//                    }
//                }
//            }
//            elseif (isset($processingSubscription) && $processingSubscription->status === 'APPROVAL_PENDING') {
//                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);
//                if (isset($paypalSubscription['status']) && $processingSubscription->update([
//                        'plan_id' => $paypalSubscription['plan_id'],
//                        'status' => $paypalSubscription['status']
//                    ])) {
//                    Subscription::where([
//                        'user_id' => $userSubscription->user_id,
//                        'subscription_id' => $userSubscription->subscription_id,
//                        ['id', '<>', $userSubscription->id]
//                    ])->whereNot('status', 'CANCELLED')
//                        ->update(['status' => 'COMPLETED']);
//                }
//            }

//            if ($userSubscription && $userSubscription->status === 'APPROVAL_PENDING') {
//                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);
//                if (isset($paypalSubscription['status'])) {
//                    $userSubscription->update([
//                        'status' => $paypalSubscription['status']
//                    ]);
//                }
//
//            } else
            if ($userSubscription && $userSubscription->processingSubscriptions->count() > 0) {
                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);

                if (isset($paypalSubscription['status']) && $paypalSubscription['status'] === 'ACTIVE') {
                    $processingSubscription = ProcessingSubscription::where([
                        'subscription_id' => $userSubscription->id,
                        'plan_id' => $paypalSubscription['plan_id'],
                        'status' => 'APPROVAL_PENDING'
                    ])->first();

                    if ($processingSubscription) {
                        $processingSubscription->subscription->update([
                            'plan_id' => $paypalSubscription['plan_id'],
                            'plan' => $processingSubscription->plan,
                            'period' => $processingSubscription->period,
                            'status' => 'ACTIVE'
                        ]);

                        $processingSubscription->delete();
                    }

                } elseif (isset($paypalSubscription['status']) && $paypalSubscription['status'] !== 'ACTIVE' && $paypalSubscription['status'] !== 'APPROVAL_PENDING' && $paypalSubscription['status'] !== 'APPROVED') {
                    $userSubscription->update(['status' => $paypalSubscription['status']]);
                    if ($userSubscription->processingSubscriptions && $userSubscription->processingSubscriptions->count() > 0){
                        foreach ($userSubscription->processingSubscriptions as $processSubscription){
                            $processSubscription->delete();
                        }
                    }
                }
//                if (isset($paypalSubscription['status']) && $userSubscription->update([
//                        'plan_id' => $paypalSubscription['plan_id'],
//                        'status' => $paypalSubscription['status']
//                    ])) {
//                    Subscription::where([
//                        'user_id' => $userSubscription->user_id,
//                        'subscription_id' => $userSubscription->subscription_id,
//                        ['id', '<>', $userSubscription->id]
//                    ])->whereNot('status', 'CANCELLED')
//                        ->update(['status' => 'COMPLETED']);
//                }
            }

            $userSubscription = Subscription::where('user_id', $user_id)->orWhere('user_id', $user->parent_id)->first();

            if (!is_null($userSubscription)) {
                $status = $userSubscription->status === 'ACTIVE' ? 'A' : 'C';
                $houseIds = User::where('user_id', $user_id)->orWhere('parent_id', $user_id)->orWhere('user_id', $user->parent_id)->distinct('HouseId')->pluck('HouseId')->toArray();
                House::whereIn('HouseID', $houseIds)->update([
                    'Status' => $status
                ]);
            }
        }
        return $next($request);
    }
}
