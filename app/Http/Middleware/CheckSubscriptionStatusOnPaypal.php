<?php

namespace App\Http\Middleware;

use App\Models\House;
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

            if ($userSubscription && $userSubscription->status === 'APPROVAL_PENDING') {
                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);
                if (isset($paypalSubscription['status'])) {
                    $userSubscription->update([
                        'status' => $paypalSubscription['status']
                    ]);
                }

            } elseif ($userSubscription && $userSubscription->status === 'REVISING') {
                $paypalSubscription = $paypal->showSubscriptionDetails($userSubscription->subscription_id);
                if (isset($paypalSubscription['status']) && $userSubscription->update([
                        'plan_id' => $paypalSubscription['plan_id'],
                        'status' => $paypalSubscription['status']
                    ])) {
                    Subscription::where([
                        'user_id' => $userSubscription->user_id,
                        'subscription_id' => $userSubscription->subscription_id,
                        ['id', '<>', $userSubscription->id]
                    ])->whereNot('status', 'CANCELLED')
                        ->update(['status' => 'COMPLETED']);
                }
            }

            $userSubscription = Subscription::where('user_id', $user_id)->orWhere('user_id', $user->parent_id)->first();

            if ($userSubscription) {
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
