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

        }
        return $next($request);
    }
}
