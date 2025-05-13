@extends('layouts.dashboard.app')
<title>{{ __('static.admins.title') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.admins.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.admins.title'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('dashboard.admins.create') }}" type="button"
                        class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.admins.create_new_admin') }}</a>
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
                                        <th>{{ __('static.admins.admin_name') }}</th>
                                        <th>{{ __('static.admins.role') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.global.email') }}</th>
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
                                    @forelse ($admins as $admin)
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
                                        <tr id="admin_{{ $admin->id }}" class="{{ $randomColor }} bg-lighten-4">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->role->role }}
                                            </td>
                                            <td>
                                                <p id="status_{{ $admin->id }}"
                                                    style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
                                                    class="@if ($admin->status == '1') btn-success  @else btn-danger @endif">
                                                    {{ $admin->getStatusTranslatable() }}
                                                </p>
                                            </td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                {{ $admin->created_at->format('Y-m-d h:m a') }}</td>

                                            <td>
                                                <div class="dropdown float-md-lift">
                                                    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                        id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">{{ __('static.actions.title') }}</button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a
                                                            style="padding: 3px" class="dropdown-item"
                                                            href="{{ route('dashboard.admins.edit', $admin->id) }}">
                                                            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>


                                                        <a style="padding: 3px" class="dropdown-item change_status"
                                                            data-id="{{ $admin->id }}"
                                                            data-url = "{{ route('dashboard.admins.changeStatus', $admin->id) }}"
                                                            data-lang="{{ app()->getLocale() }}"
                                                            onclick="changeStatus(event,this.dataset.id, this.dataset.url,this.dataset.lang)"
                                                            href="javascript:void(0)">
                                                            <i
                                                                class="la @if ($admin->status == '1') la-stop @else la-play @endif"></i>
                                                            {{ __('static.actions.change_status') }}
                                                        </a>

                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" style="padding: 3px"
                                                            class="dropdown-item"
                                                            data-url="{{ route('dashboard.admins.destroy', $admin->id) }}"
                                                            data-message="{{ __('messages.delete_confirmation') }}"
                                                            data-title="{{ __('static.global.sure') }}"
                                                            data-item_id="admin_{{ $admin->id }}"
                                                            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
                                                            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
                                                        </a>
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
                                            <td class="alert alert-info" colspan="7"> No Admins</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
