<?php

if (!function_exists('link_is_active_with_class')) {
    function link_is_active_with_class($routeNames, $class = 'active')
    {
        $route = '';

        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (request()->routeIs($routeName)) {
                    $route = $routeName;
                    break;
                }
            }
        } else {
            $route = $routeNames;
        }

        return request()->routeIs($route) ? $class : '';
    }
}

if (!function_exists('link_is_active')) {
    function link_is_active($routeNames)
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (request()->routeIs($routeName)) {
                    return true;
                }
            }
        } else {
            return request()->routeIs($routeNames);
        }

        return false;
    }
}

if (!function_exists('get_class_name')) {
    function get_class_name($obj): bool|int|string|null
    {
        $classname = get_class($obj);
        if ($pos = strrpos($classname, '\\')) $classname = substr($classname, $pos + 1);
        else $classname = $pos;

        return \Illuminate\Support\Str::plural(strtolower($classname));
    }
}

if (!function_exists('current_house')) {
    function current_house()
    {
        return auth()->user()->house;
    }
}

if (!function_exists('is_subscribed')) {
    function is_subscribed($plans)
    {
        if (is_array($plans)) {
            return \App\Models\Subscription::where([
                'user_id' => auth()->user()->user_id,
                'house_id' => auth()->user()->HouseId,
                'status' => 'ACTIVE',
            ])->whereIn('plan', $plans)->exists();
        }
        return \App\Models\Subscription::where([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'plan' => $plans,
            'status' => 'ACTIVE',
        ])->exists();
    }
}

if (!function_exists('is_basic_subscribed')) {
    function is_basic_subscribed()
    {
        return is_subscribed('basic');
    }
}

if (!function_exists('is_standard_subscribed')) {
    function is_standard_subscribed()
    {
        return is_subscribed('standard');
    }
}

if (!function_exists('is_premium_subscribed')) {
    function is_premium_subscribed()
    {
        return is_subscribed('premium');
    }
}

if (!function_exists('is_any_subscribed')) {
    function is_any_subscribed()
    {
        return \App\Models\Subscription::where([
            'user_id' => auth()->user()->user_id,
            'house_id' => auth()->user()->HouseId,
            'status' => 'ACTIVE',
        ])->whereIn('plan', ['basic', 'standard', 'premium'])->exists();
    }
}
