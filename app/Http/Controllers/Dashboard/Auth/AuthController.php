<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Dashboard\LoginAdminRequest;

class AuthController extends Controller implements HasMiddleware
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        // $this->middleware('guest:admin')->except('logout');
    }


    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(LoginAdminRequest $request)
    {

        $credenstials = $request->only(['email', 'password']);

        $remember_me = $request->remember_me;

        if ($this->authService->login($credenstials, 'admin', $remember_me)) {
            Session::flash('success', __('auth.logged_in'));
            return redirect()->intended(route('dashboard.home'));
        } else {
            return redirect()->back()->withErrors(['email' => __('auth.failed')]);
        }
    }

    public function logout()
    {
        $this->authService->logout('admin');
        Session::flash('success', __('auth.logged_out'));
        return redirect()->route('dashboard.login');
    }
}