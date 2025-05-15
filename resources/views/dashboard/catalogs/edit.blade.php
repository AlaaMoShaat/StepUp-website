@extends('layouts.dashboard.app')
<title>{{ __('static.catalogs.edit_catalog') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.catalogs.edit_catalog'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.catalogs.title'), 'url' => route('dashboard.catalogs.index')],
            ['title' => __('static.catalogs.edit_catalog'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.catalogs.edit_catalog') }}
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
                        <form action="{{ route('dashboard.catalogs.update', $catalog->id) }}" method="POST" class="form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="store_id" id="store_id" value="{{ $catalog->store->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_ar"> {{ __('static.catalogs.title_ar') }} :</label>
                                        <input name="title[ar]" value="{{ $catalog->getTranslation('title', 'ar') }}"
                                            type="text" class="form-control" id="title_ar"
                                            placeholder="{{ __('static.catalogs.title_ar') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en"> {{ __('static.catalogs.title_en') }} :</label>
                                        <input name="title[en]" value="{{ $catalog->getTranslation('title', 'en') }}"
                                            type="text" class="form-control" id="title_en"
                                            placeholder="{{ __('static.catalogs.title_en') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description_ar"> {{ __('static.catalogs.description_ar') }}
                                            :</label>
                                        <textarea name="description[ar]" class="form-control" id="description_ar">{{ $catalog->getTranslation('description', 'ar') }}</textarea>
                                        @error('description_ar')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description_en"> {{ __('static.catalogs.description_en') }}
                                            :</label>
                                        <textarea name="description[en]" class="form-control" id="description_en">{{ $catalog->getTranslation('description', 'en') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('static.global.start_date') }}</label>
                                        <input type="date" id="start_date" value="{{ $catalog->start_date }}"
                                            name="start_date" class="form-control"
                                            placeholder="{{ __('static.global.start_date') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">{{ __('static.global.end_date') }}</label>
                                        <input type="date" id="end_date" value="{{ $catalog->end_date }}"
                                            name="end_date" class="form-control"
                                            placeholder="{{ __('static.global.end_date') }}">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary pull-left mb-3"
                                type="submit">{{ __('static.global.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/vendors/css/forms/tags/tagging.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/custom/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showFullScreenModal', () => {
                $('#fullscreenModal').modal('show');
            });
        });
    </script>
    {{-- tags --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        // Initialize Tagify
        const input = document.querySelector('#tagInput');
        new Tagify(input, {
            delimiters: ", ", // Tags separated by space, comma, or enter
            placeholder: "Type and press space or enter",
            maxTags: 10, // Maximum number of tags
        });
    </script>
@endpush
