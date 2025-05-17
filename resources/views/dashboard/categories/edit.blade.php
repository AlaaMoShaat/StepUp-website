@extends('layouts.dashboard.app')
<title>{{ __('static.categories.edit_category') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.categories.edit_category'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.categories.title'), 'url' => route('dashboard.categories.index')],
            ['title' => __('static.categories.edit_category'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.categories.edit_category') }}
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
                        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST"
                            class="form">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="category_name_en">{{ __('static.categories.category_name_en') }}</label>
                                            <input type="text" value="{{ $category->getTranslation('name', 'en') }}"
                                                id="category_name_en" class="form-control border-primary"
                                                placeholder="{{ __('static.categories.category_name_en') }}"
                                                name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="category_name_ar">{{ __('static.categories.category_name_ar') }}</label>
                                            <input type="text" value="{{ $category->getTranslation('name', 'ar') }}"
                                                id="category_name_ar" class="form-control border-primary"
                                                placeholder="{{ __('static.categories.category_name_ar') }}"
                                                name="name[ar]">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent">{{ __('static.categories.parent_category') }}
                                            </label>
                                            <select id="parent" name="parent" class="form-control"
                                                @if (!old('parent', $category->parent)) disabled @endif>
                                                <option selected disabled>{{ __('static.global.select') }}</option>

                                                @forelse ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('parent') == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}</option>
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
                                                $isActive = $category->status;
                                            @endphp
                                            @include('dashboard.includes.status-btns', [
                                                'isActive' => $isActive,
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="{{ url()->previous() }}"
                                        class="btn btn-danger">{{ __('static.actions.cancel') }}</a>
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
