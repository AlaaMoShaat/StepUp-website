<?php

namespace App\Http\Controllers\Dashboard\Auth;


use App\Http\Controllers\Controller;
use App\Services\Auth\PasswordService;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ResetPasswordController extends Controller
{
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function showResetForm($email)
    {
        if (!session()->has('password_reset_email') || !session()->has('password_reset_verified')) {
            return redirect()->route('dashboard.password.email')->with('error', __('auth.complete_steps'));
        }

        if (session('password_reset_email') !== $email) {
            return redirect()->route('dashboard.password.email')->with('error', __('auth.verify_email'));
        }

        return view('dashboard.auth.password.reset', compact('email'));
    }
    public function resetPassword(ForgotPasswordRequest $request)
    {
        if (session('password_reset_email') !== $request->email) {
            return redirect()->route('dashboard.password.email')->with('error', __('auth.verify_email'));
        }
        $data = $request->only('email', 'password');

        $admin = $this->passwordService->resetPassword($data);

        if (!$admin) {
            return redirect()->back()->with(['emailError' => __('auth.try_again')]);
        }

        session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('dashboard.login')->with('success', __('passwords.reset'));
    }
}