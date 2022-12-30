<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
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


            if (!auth()->user()->is_admin && $Is_Subscription)
            {
                return redirect()->route('guest.guest-calendar')->with('warnMessage','We can not redirect to Admin side. Because the house Administrator needs to set up an active subscription.');
            }
            else{
                return redirect()->route('dash.plans-and-pricing');
            }

        }
        return $next($request);
    }
}
