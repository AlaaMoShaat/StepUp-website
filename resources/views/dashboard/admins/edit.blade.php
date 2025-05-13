@extends('layouts.dashboard.app')
<title>{{ __('static.admins.edit_admin') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.admins.edit_admin'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.admins.title'), 'url' => route('dashboard.admins.index')],
            ['title' => __('static.admins.edit_admin'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.admins.edit_admin') }}
                    </h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                @include('dashboard.includes.validations')
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="POST" class="form">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="admin_name_en">{{ __('static.admins.admin_name_en') }}</label>
                                            <input type="text" value="{{ $admin->getTranslation('name', 'en') }}"
                                                id="admin_name_en" class="form-control border-primary"
                                                placeholder="{{ __('static.admins.admin_name_en') }}" name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="admin_name_ar">{{ __('static.admins.admin_name_ar') }}</label>
                                            <input type="text" value="{{ $admin->getTranslation('name', 'ar') }}"
                                                id="admin_name_ar" class="form-control border-primary"
                                                placeholder="{{ __('static.admins.admin_name_ar') }}" name="name[ar]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('static.global.email') }}</label>
                                            <input type="text" value="{{ $admin->email }}" id="email"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.global.email') }}" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('static.global.phone') }}</label>
                                            <input type="text" value="{{ $admin->phone }}" id="phone international-mask"
                                                class="form-control border-primary international-inputmask"
                                                placeholder="{{ __('static.global.phone') }}" name="phone">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">{{ __('static.global.password') }}</label>
                                            <input type="password" id="password international-mask"
                                                class="form-control border-primary international-inputmask"
                                                placeholder="{{ __('static.global.password') }}" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="password_confirmation">{{ __('static.global.password_confirmation') }}</label>
                                            <input type="password" id="password international-mask"
                                                class="form-control border-primary international-inputmask"
                                                placeholder="{{ __('static.global.password_confirmation') }}"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role_id">{{ __('static.admins.role') }}</label>
                                            <select id="role_id" name="role_id" class="form-control">
                                                <option selected disabled>{{ __('static.global.select') }}</option>
                                                @forelse ($roles as $role)
                                                    <option @selected($admin->role_id == $role->id) value="{{ $role->id }}">
                                                        {{ $role->role }}
                                                    </option>
                                                @empty
                                                    <option disabled selected>{{ __('static.global.no_items') }}</option>
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="display: block"
                                                for="status">{{ __('static.global.status') }}</label>
                                            @php
                                                $isActive = $admin->status;
                                            @endphp
                                            @include('dashboard.includes.status-btns', [
                                                'isActive' => $isActive,
                                            ])

                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('static.actions.edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
