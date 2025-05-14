<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = 'active')
    {
        return Route::currentRouteName() === $routeName ? $output : '';
    }
}

if (!function_exists('generateTimeSlots')) {
    function generateTimeSlots($interval = 30) {
        $times = [];
        for ($hours = 0; $hours < 24; $hours++) {
            for ($mins = 0; $mins < 60; $mins += $interval) {
                $times[] = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' .
                          str_pad($mins, 2, '0', STR_PAD_LEFT);
            }
        }
        return $times;
    }
}
