<?php

namespace App\Http\Middleware;

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
                $request->routeIs(    'dash.plans-and-pricing') ||
                $request->routeIs(    'dash.paypal.process') ||
                $request->routeIs(    'dash.paypal.succeeded') ||
                $request->routeIs(    'dash.paypal.canceled')
            )) {
            return redirect()->route('dash.plans-and-pricing');
        }
        return $next($request);
    }
}
