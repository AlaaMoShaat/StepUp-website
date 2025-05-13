@extends('layouts.dashboard.app')
<title>{{ __('static.role.create_role') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.role.create_role'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.global.roles'), 'url' => route('dashboard.roles.index')],
            ['title' => __('static.role.create_role'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.role.create_role') }}
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
                        <form action="{{ route('dashboard.roles.store') }}" method="POST" class="form">
                            <div class="form-body">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role_name_en">{{ __('static.role.role_name_en') }}</label>
                                            <input type="text" id="role_name_en" class="form-control border-primary"
                                                placeholder="{{ __('static.role.role_name_en') }}" name="role[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role_name_ar">{{ __('static.role.role_name_ar') }}</label>
                                            <input type="text" id="role_name_ar" class="form-control border-primary"
                                                placeholder="{{ __('static.role.role_name_ar') }}" name="role[ar]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">{{ __('static.role.select_permassions') }}
                                                </h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <fieldset>
                                                        <input id="select-all" type="checkbox">
                                                        <label for="select-all">{{ __('static.global.select_all') }}</label>
                                                    </fieldset>
                                                    <div class="row skin skin-line">
                                                        @foreach (__('permessions') as $permessionKey => $permession)
                                                            <div class="col-3">
                                                                <fieldset>
                                                                    <input class="permession-checkbox"
                                                                        value="{{ $permessionKey }}" name="permessions[]"
                                                                        type="checkbox" id="input-{{ $loop->iteration }}">
                                                                    <label
                                                                        for="input-{{ $loop->iteration }}">{{ $permession }}</label>
                                                                </fieldset>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('static.actions.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.permession-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
