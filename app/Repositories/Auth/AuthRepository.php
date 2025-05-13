<?php

namespace App\Repositories\Auth;

use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function login($credenstials, $guard, $remember_me = false)
    {
        return Auth::guard($guard)->attempt($credenstials, $remember_me);
    }

    public function logout($guard)
    {
        return Auth::guard($guard)->logout();
    }
}