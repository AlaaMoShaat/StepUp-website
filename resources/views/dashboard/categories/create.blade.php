@extends('layouts.dashboard.app')
<title>{{ __('static.categories.create_category') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.categories.create_category'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.categories.title'), 'url' => route('dashboard.categories.index')],
            ['title' => __('static.categories.create_category'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">
                        {{ __('static.categories.create_category') }}
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
                        <form action="{{ route('dashboard.categories.store') }}" method="POST" class="form">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="category_name_en">{{ __('static.categories.category_name_en') }}</label>
                                            <input type="text" value="{{ old("name['en']") }}" id="category_name_en"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.categories.category_name_en') }}"
                                                name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="category_name_ar">{{ __('static.categories.category_name_ar') }}</label>
                                            <input type="text" value="{{ old("name['ar']") }}" id="category_name_ar"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.categories.category_name_ar') }}"
                                                name="name[ar]">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent">
                                                {{ __('static.categories.parent_category') }}
                                                <input type="checkbox" name="has_parent" id="has_parent">
                                            </label>
                                            <select id="parent" name="parent" class="form-control" disabled>
                                                <option selected disabled>{{ __('static.global.select') }}</option>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('parent') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
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
                                            @include('dashboard.includes.status-btns', ['isActive' => '0'])
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
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hasParentCheckbox = document.getElementById('has_parent');
            const parentSelect = document.getElementById('parent');

            // Toggle the select input state based on the checkbox
            hasParentCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    parentSelect.removeAttribute('disabled');
                    // Restore the old value if available
                    const oldValue = '{{ old('parent') }}';
                    if (oldValue) {
                        parentSelect.value = oldValue;
                    }
                } else {
                    parentSelect.setAttribute('disabled', true);
                    parentSelect.value = '';
                }
            });

            // Initialize the state on page load
            if (hasParentCheckbox.checked) {
                parentSelect.removeAttribute('disabled');
            }
        });
    </script>
@endpush
