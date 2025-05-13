@extends('layouts.dashboard.app')
<title>{{ __('static.global.roles') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.global.roles'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.global.roles'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard.roles.create') }}" type="button"
                        class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.role.create_new_role') }}</a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('dashboard.includes.toster-error')
                        @include('dashboard.includes.toster-success')
                        <div style="min-height: 200px" class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.global.roles') }}</th>
                                        <th>{{ __('static.role.permassions') }}</th>
                                        <th>{{ __('static.role.related_admins') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <style>
                                    th {
                                        text-align: center
                                    }
                                </style>
                                <tbody>
                                    @forelse ($roles as $role)
                                        @php
                                            $colors = [
                                                'bg-blue',
                                                'bg-light-blue',
                                                'bg-teal',
                                                'bg-cyan',
                                                'bg-indigo',
                                                'bg-purple',
                                                'bg-pink',
                                                'bg-gray',
                                                'bg-white',
                                            ];

                                            $randomColor = $colors[array_rand($colors)];
                                        @endphp
                                        <tr id="role_{{ $role->id }}" class="{{ $randomColor }} bg-lighten-4">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->role }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('static.role.permassions') }}
                                                        ({{ count($role->permession) }})
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="dropdownMenuButton"
                                                        style="max-height: 200px; overflow-y: auto; width: 200px;">
                                                        @foreach ($role->permession as $permession)
                                                            <a class="dropdown-item"
                                                                href="javascript:void()">{{ __('permessions.' . $permession) }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $role->admins->count() }}</td>
                                            <td>{{ $role->created_at->format('Y-m-d h:m a') }}</td>
                                            <td>
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.roles.edit', $role->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>

                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            data-url="{{ route('dashboard.roles.destroy', $role->id) }}"
                                                            data-message="{{ __('messages.delete_confirmation') }}"
                                                            data-title="{{ __('static.global.sure') }}"
                                                            data-item_id="role_{{ $role->id }}"
                                                            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)"><i
                                                                class="la la-trash"></i>{{ __('static.actions.delete') }}</a>


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <style>
                                            td {
                                                text-align: center
                                            }
                                        </style>
                                    @empty
                                        <tr>
                                            <td class="alert alert-info" colspan="6"> No Roles</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
