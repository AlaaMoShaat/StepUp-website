@extends('layouts.dashboard.auth.auth')
<title>{{ __('auth.verify_email') }}</title>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png"
                                            alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{ __('auth.send_reset_link') }}</span>
                                    </h6>
                                </div>
                                @include('dashboard.includes.validations')
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('dashboard.password.sendCode') }}" method="POST"
                                            class="form-horizontal" action="login-simple.html" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="email" type="email"
                                                    class="form-control form-control-lg input-lg" id="user-email"
                                                    placeholder="{{ __('auth.email') }}" required>
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i
                                                    class="ft-unlock">{{ __('head_title') }}</i>{{ __('auth.send_reset_link') }}</button>
                                        </form>
                                        <div class="col-md-6 col-12"><a href="{{ route('dashboard.login') }}"
                                                class="card-link">{{ __('auth.login') }}</a></div>
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
