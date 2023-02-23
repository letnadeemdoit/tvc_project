<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckPrimaryUserHasSubscribedAnyPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !is_any_subscribed() && !(
                $request->routeIs('dash.plans-and-pricing') ||
                $request->routeIs('dash.paypal.process') ||
                $request->routeIs('dash.paypal.succeeded') ||
                $request->routeIs('dash.paypal.canceled') ||
                $request->routeIs('dash.settings.account-information')
            )) {

//            $user = primary_user();

            $Is_Subscription = Subscription::where([
                'user_id' => primary_user()->user_id,
                'house_id' => primary_user()->HouseId,
                'status' => 'CANCELLED',
            ])->whereIn('plan', ['basic', 'standard', 'premium'])->exists();

            $admin = User::where([
                'HouseId' => primary_user()->HouseId,
                'role' => 'Administrator',
            ])->first();

            if (!auth()->user()->is_admin && $Is_Subscription || !auth()->user()->is_admin && !$Is_Subscription) {
                return redirect()->route('guest.guest-calendar');
            }
            else {
                return redirect()->route('dash.plans-and-pricing');
            }

        }
        return $next($request);
    }
}
