<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('activeMenu')) {
    function activeMenu($routeNames)
    {
        if (is_array($routeNames)) {
            foreach ($routeNames as $routeName) {
                if (Request::routeIs($routeName)) {
                    return 'active';
                }
            }
        } else {
            if (Request::routeIs($routeNames)) {
                return 'active';
            }
        }

        return '';
    }
}


