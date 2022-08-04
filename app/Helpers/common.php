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
