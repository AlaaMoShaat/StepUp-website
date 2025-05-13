@extends('layouts.dashboard.app')
<title>{{ __('static.stores.edit_store') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.stores.edit_store'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.stores.title'), 'url' => route('dashboard.stores.index')],
            ['title' => __('static.stores.edit_store'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.stores.edit_store') }}
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
                        <form action="{{ route('dashboard.stores.update', $store->id) }}" method="POST" class="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store_name_en">{{ __('static.stores.store_name_en') }}</label>
                                            <input type="text" value="{{ $store->getTranslation('name', 'en') }}"
                                                id="store_name_en" class="form-control border-primary"
                                                placeholder="{{ __('static.stores.store_name_en') }}" name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store_name_ar">{{ __('static.stores.store_name_ar') }}</label>
                                            <input type="text" value="{{ $store->getTranslation('name', 'ar') }}"
                                                id="store_name_ar" class="form-control border-primary"
                                                placeholder="{{ __('static.stores.store_name_ar') }}" name="name[ar]">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="importance_level">{{ __('static.stores.importance_level') }}</label>
                                            <select id="importance_level" name="importance_level" required
                                                class="form-control border-primary">
                                                <option value="featured"
                                                    {{ $store->importance_level == 'featured' ? 'selected' : '' }}>
                                                    {{ __('static.stores.featured') }}
                                                </option>
                                                <option value="normal"
                                                    {{ $store->importance_level == 'normal' ? 'selected' : '' }}>
                                                    {{ __('static.stores.normal') }}</option>
                                                <option value="low"
                                                    {{ $store->importance_level == 'low' ? 'selected' : '' }}>
                                                    {{ __('static.stores.low') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website_url">{{ __('static.stores.website_url') }}</label>
                                            <input type="url" value="{{ $store->website_url ?? '' }}" id="website_url"
                                                name="website_url" class="form-control border-primary"
                                                placeholder="{{ __('static.stores.website_url') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('static.stores.phone') }}</label>
                                            <input type="text" value="{{ $store->phone }}" id="phone" name="phone"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.stores.phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('static.stores.email') }}</label>
                                            <input type="email" value="{{ $store->email ?? '' }}" id="email"
                                                name="email" class="form-control border-primary"
                                                placeholder="{{ __('static.stores.email') }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="display: block"
                                                for="status">{{ __('static.global.status') }}</label>
                                            @php
                                                $isActive = $store->status;
                                            @endphp
                                            @include('dashboard.includes.status-btns', [
                                                'isActive' => $isActive,
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="store_logo">{{ __('static.stores.logo') }}</label>
                                            <input type="file" name="logo" id="store_logo"
                                                class="form-control singleImageEdit border-primary">
                                        </div>
                                    </div>
                                </div>


                                <hr>
                                <h3>{{ __('static.stores.branches') }}</h3>
                                <hr>

                                <div id="branches-container">
                                    @foreach ($store->branches as $index => $branch)
                                        <div class="row branches-row mb-3">
                                            <div class="col-md-12">
                                                <h4>{{ __('static.stores.branch') }} {{ $index + 1 }}</h4>
                                            </div>
                                            <div class="col-md-10">
                                                <fieldset class="form-group">
                                                    <label
                                                        for="neighborhood">{{ __('static.regions.neighborhood_name') }}</label>
                                                    <select class="form-control" id="neighborhood"
                                                        name="branches[{{ $branch->id }}][neighborhood_id]">
                                                        @foreach ($neighborhoods as $neighborhood)
                                                            <option value="{{ $neighborhood->id }}"
                                                                {{ $branch->neighborhood_id == $neighborhood->id ? 'selected' : '' }}>
                                                                {{ $neighborhood->name }} -
                                                                {{ $neighborhood->postal_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="address">{{ __('static.stores.address') }}</label>
                                                    <input type="text" id="address"
                                                        class="form-control border-primary"
                                                        placeholder="{{ __('static.stores.address') }}"
                                                        name="branches[{{ $branch->id }}][address]"
                                                        value="{{ $branch->address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="location">{{ __('static.stores.location') }}</label>
                                                    <input type="text" id="location"
                                                        class="form-control border-primary"
                                                        placeholder="{{ __('static.stores.location') }}"
                                                        name="branches[{{ $branch->id }}][location]"
                                                        value="{{ $branch->location }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                @if ($index > 0)
                                                    <button type="button" class="btn btn-danger remove-branch"><i
                                                            class="ft-x"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="add-branch">
                                            <i class="ft-plus"></i> {{ __('static.stores.add_branch') }}
                                        </button>
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

@push('js')
    <script>
        var lang = "{{ app()->getLocale() }}";
        $(function() {
            $('.singleImageEdit').fileinput({
                theme: 'fa5',
                language: lang,
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                enableResumableUpload: false,
                showRemove: false,
                showCancel: false,
                showUpload: false,
                initialPreviewAsData: true,
                fileActionSettings: {
                    showDrag: false,
                    showRotate: false,
                },
                initialPreview: [
                    "{{ asset($store->logo) }}"
                ],
            });
        });

        $(document).ready(function() {
            // Add new branch
            $('#add-branch').click(function() {
                var branchCount = $('.branches-row').length;
                var newIndex = branchCount + 1;

                var newBranch = `
                    <div class="row branches-row mb-3">
                        <div class="col-md-12">
                            <h4>{{ __('static.stores.branch') }} ${newIndex}</h4>
                        </div>
                        <div class="col-md-10">
                            <fieldset class="form-group">
                                <label for="neighborhood_new_${newIndex}">{{ __('static.regions.neighborhood_name') }}</label>
                                <select class="form-control" id="neighborhood_new_${newIndex}"
                                    name="branches[${newIndex}][neighborhood_id]">
                                    @foreach ($neighborhoods as $neighborhood)
                                        <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }} - {{ $neighborhood->postal_code }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="address_new_${newIndex}">{{ __('static.stores.address') }}</label>
                                <input type="text" id="address_new_${newIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.stores.address') }}"
                                    name="branches[${newIndex}][address]">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="location_new_${newIndex}">{{ __('static.stores.location') }}</label>
                                <input type="text" id="location_new_${newIndex}" class="form-control border-primary"
                                    placeholder="{{ __('static.stores.location') }}"
                                    name="branches[${newIndex}][location]">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger remove-branch"><i class="ft-x"></i></button>
                        </div>
                    </div>
                `;

                $('#branches-container').append(newBranch);
            });

            // Remove branch
            $(document).on('click', '.remove-branch', function() {
                $(this).closest('.branches-row').remove();

                // Update branch numbers
                $('.branches-row').each(function(index) {
                    $(this).find('h4').text("{{ __('static.stores.branch') }} " + (index + 1));
                });
            });
        });
    </script>
@endpush
