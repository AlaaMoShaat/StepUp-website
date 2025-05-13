@extends('layouts.dashboard.auth.auth')

<title>{{ __('auth.login') }}</title>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img width="60px" src="{{ asset($setting->logo) }}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle ine-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{ __('auth.login_with') }} {{ $setting->site_name }}</span>
                                    </h6>
                                    @include('dashboard.includes.validations')
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="loginForm" action="{{ route('dashboard.login.post') }}" method="POST"
                                            class="form-horizontal" action="index.html" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="email" type="text" class="form-control input-lg"
                                                    id="user-name" placeholder="{{ __('auth.email') }}" tabindex="1">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="password" type="password" class="form-control input-lg"
                                                    id="password" placeholder="{{ __('auth.password') }}" tabindex="2">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>

                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-md-left">
                                                    <fieldset>
                                                        <input name="remember_me" type="checkbox" id="remember-me"
                                                            class="chk-remember">
                                                        <label for="remember-me">{{ __('auth.remember_me') }}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-12 text-center text-md-right"><a
                                                        href="{{ route('dashboard.password.email') }}"
                                                        class="card-link">{{ __('auth.forget_password') }}</a></div>
                                            </div>
                                            <button id="loginButton" type="submit"
                                                class="btn btn-danger btn-block btn-lg"><i
                                                    class="ft-unlock"></i>{{ __('auth.login') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
