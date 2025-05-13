<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;

class AuthService
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login($credenstials, $guard, $remember_me = false)
    {
        return $this->authRepository->login($credenstials, $guard, $remember_me);
    }

    public function logout($guard)
    {
        $this->authRepository->logout($guard);
    }
}