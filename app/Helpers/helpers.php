<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = 'active')
    {
        return Route::currentRouteName() === $routeName ? $output : '';
    }
}
