<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class CheckSubscriptionStatusOnPaypal
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            $paypal = PayPal::setProvider();
            $paypal->getAccessToken();
            $user_id = auth()->user()->user_id;

            $current_subscription = Subscription::where('user_id', $user_id)
                ->whereIn('status', ['APPROVAL_PENDING', 'ACTIVE', 'REVISING'])
                ->latest()
                ->first();

            if ($current_subscription) {
                $paypalSubscription = $paypal->showSubscriptionDetails($current_subscription->subscription_id);
                Subscription::where('user_id', $user_id)->where('subscription_id', $current_subscription->subscription_id)->latest()->update([
                    'status' => $paypalSubscription['status']
                ]);

                $keep = Subscription::where('user_id', $user_id)
                    ->where('subscription_id', $current_subscription->subscription_id)
                    ->where('status', 'ACTIVE')
                    ->latest()
                    ->first();

//                Subscription::where('user_id', $user_id)
//                    ->where('subscription_id', $current_subscription->subscription_id)
//                    ->whereNot('id', $keep->id)
//                    ->update([
//                        'status' => 'INACTIVE'
//                    ]);
            }

        }
        return $next($request);
    }
}
