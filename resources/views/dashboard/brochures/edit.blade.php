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
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.stores.edit_store') }}</h4>
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
                                                @foreach (['featured', 'normal', 'low'] as $level)
                                                    <option value="{{ $level }}"
                                                        {{ $store->importance_level == $level ? 'selected' : '' }}>
                                                        {{ __('static.stores.' . $level) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website_url">{{ __('static.stores.website_url') }}</label>
                                            <input type="url" value="{{ $store->website_url }}" id="website_url"
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
                                            <input type="email" value="{{ $store->email }}" id="email" name="email"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.stores.email') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="display: block"
                                                for="status">{{ __('static.global.status') }}</label>
                                            @include('dashboard.includes.status-btns', [
                                                'isActive' => $store->status,
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                        <div class="branch-container mb-4 border border-dark p-3 rounded">
                                            <div class="row branches-row">
                                                <div class="col-md-12">
                                                    <h4>{{ __('static.stores.branch') }} {{ $index + 1 }}</h4>
                                                </div>

                                                <div class="col-md-10">
                                                    <fieldset class="form-group">
                                                        <label>{{ __('static.regions.neighborhood_name') }}</label>
                                                        <select class="form-control"
                                                            name="branches[{{ $branch->id }}][neighborhood_id]">
                                                            @foreach ($neighborhoods as $neighborhood)
                                                                <option value="{{ $neighborhood['id'] }}"
                                                                    {{ $branch->neighborhood_id == $neighborhood['id'] ? 'selected' : '' }}>
                                                                    {{ $neighborhood['current_name'] }} -
                                                                    {{ $neighborhood['postal_code'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>{{ __('static.stores.address') }}</label>
                                                        <input type="text" class="form-control border-primary"
                                                            placeholder="{{ __('static.stores.address') }}"
                                                            name="branches[{{ $branch->id }}][address]"
                                                            value="{{ $branch->address }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>{{ __('static.stores.location') }}</label>
                                                        <input type="text" class="form-control border-primary"
                                                            placeholder="{{ __('static.stores.location') }}"
                                                            name="branches[{{ $branch->id }}][location]"
                                                            value="{{ $branch->location }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <hr>
                                                    <h5>{{ __('static.stores.working_hours') }}</h5>

                                                    @foreach ($days as $day)
                                                        @php
                                                            $appointment = $branch->days
                                                                ->where('id', $day->id)
                                                                ->first();
                                                            $isEnabled = $appointment ? true : false;
                                                            $openTime = $isEnabled
                                                                ? $appointment->pivot->open_time
                                                                : '00:00';
                                                            $closeTime = $isEnabled
                                                                ? $appointment->pivot->close_time
                                                                : '00:00';
                                                        @endphp

                                                        <div class="row day-row mb-2">
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        class="form-check-input day-checkbox"
                                                                        id="day_{{ $branch->id }}_{{ $day->id }}"
                                                                        name="branches[{{ $branch->id }}][days][{{ $day->id }}][enabled]"
                                                                        value="1" {{ $isEnabled ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="day_{{ $branch->id }}_{{ $day->id }}">
                                                                        {{ $day->day }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control open-time"
                                                                    name="branches[{{ $branch->id }}][days][{{ $day->id }}][open_time]"
                                                                    {{ $isEnabled ? '' : 'disabled' }}>
                                                                    @foreach (generateTimeSlots() as $time)
                                                                        <option value="{{ $time }}"
                                                                            {{ $openTime == $time ? 'selected' : '' }}>
                                                                            {{ $time }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select class="form-control close-time"
                                                                    name="branches[{{ $branch->id }}][days][{{ $day->id }}][close_time]"
                                                                    {{ $isEnabled ? '' : 'disabled' }}>
                                                                    @foreach (generateTimeSlots() as $time)
                                                                        <option value="{{ $time }}"
                                                                            {{ $closeTime == $time ? 'selected' : '' }}>
                                                                            {{ $time }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-2 mt-2">
                                                    @if ($index > 0)
                                                        <button type="button" class="btn btn-danger remove-branch">
                                                            <i class="ft-x"></i>
                                                        </button>
                                                    @endif
                                                </div>
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

                                <div class="form-actions right mt-3">
                                    <a href="{{ route('dashboard.stores.index') }}" class="btn btn-danger">
                                        {{ __('static.actions.cancel') }}
                                    </a>
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
        $(document).ready(function() {
            $('.singleImageEdit').fileinput({
                theme: 'fa5',
                language: "{{ app()->getLocale() }}",
                allowedFileTypes: ['image'],
                showRemove: false,
                showCancel: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ $store->logo ? asset($store->logo) : '' }}"
                ],
                initialPreviewConfig: [{
                    caption: "{{ basename($store->logo) }}",
                    size: "{{ $store->logo ? filesize(public_path($store->logo)) : 0 }}"
                }]
            });

            var neighborhoods = {!! json_encode($neighborhoods) !!};
            var days = {!! json_encode($days) !!};
            var timeSlots = {!! json_encode(generateTimeSlots()) !!};
            var currentLang = "{{ app()->getLocale() }}";

            $('#add-branch').click(function() {
                var branchCount = $('.branch-container').length;
                var newIndex = branchCount + 1;
                var newId = 'new_' + newIndex;

                var neighborhoodsOptions = '';
                neighborhoods.forEach(function(neighborhood) {
                    var name = neighborhood.name[currentLang] || neighborhood.name;
                    neighborhoodsOptions +=
                        `<option value="${neighborhood.id}">${name} - ${neighborhood.postal_code}</option>`;
                });

                var daysHtml = '';
                days.forEach(function(day) {
                    var dayName = day.day[currentLang] || day.day;
                    daysHtml += `
                <div class="row day-row mb-2">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input day-checkbox"
                                   id="day_${newId}_${day.id}"
                                   name="branches[${newId}][days][${day.id}][enabled]"
                                   value="1">
                            <label class="form-check-label" for="day_${newId}_${day.id}">
                                ${dayName}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control open-time"
                                name="branches[${newId}][days][${day.id}][open_time]"
                                disabled>
                            ${generateTimeOptions(timeSlots, '08:00')}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control close-time"
                                name="branches[${newId}][days][${day.id}][close_time]"
                                disabled>
                            ${generateTimeOptions(timeSlots, '17:00')}
                        </select>
                    </div>
                </div>`;
                });

                var newBranch = `
            <div class="branch-container mb-4 border border-dark p-3 rounded">
                <div class="row branches-row">
                    <div class="col-md-12">
                        <h4>{{ __('static.stores.branch') }} ${newIndex}</h4>
                    </div>

                    <!-- Branch Details -->
                    <div class="col-md-10">
                        <fieldset class="form-group">
                            <label>{{ __('static.regions.neighborhood_name') }}</label>
                            <select class="form-control" name="branches[${newId}][neighborhood_id]">
                                ${neighborhoodsOptions}
                            </select>
                        </fieldset>
                    </div>

                    <div class="col-md-10">
                        <div class="form-group">
                            <label>{{ __('static.stores.address') }}</label>
                            <input type="text" class="form-control border-primary"
                                   placeholder="{{ __('static.stores.address') }}"
                                   name="branches[${newId}][address]">
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="form-group">
                            <label>{{ __('static.stores.location') }}</label>
                            <input type="text" class="form-control border-primary"
                                   placeholder="{{ __('static.stores.location') }}"
                                   name="branches[${newId}][location]">
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="col-md-12 mt-3">
                        <hr>
                        <h5>{{ __('static.stores.working_hours') }}</h5>
                        ${daysHtml}
                    </div>

                    <!-- Remove Button -->
                    <div class="col-md-2 mt-2">
                        <button type="button" class="btn btn-danger remove-branch">
                            <i class="ft-x"></i>
                        </button>
                    </div>
                </div>
            </div>`;

                $('#branches-container').append(newBranch);
            });

            function generateTimeOptions(times, defaultTime) {
                var options = '';
                times.forEach(function(time) {
                    var selected = time === defaultTime ? 'selected' : '';
                    options += `<option value="${time}" ${selected}>${time}</option>`;
                });
                return options;
            }

            $(document).on('click', '.remove-branch', function() {
                if ($('.branch-container').length > 1) {
                    $(this).closest('.branch-container').remove();

                    $('.branch-container').each(function(index) {
                        $(this).find('h4').text("{{ __('static.stores.branch') }} " + (index + 1));
                    });
                }
            });

            $(document).on('change', '.day-checkbox', function() {
                var row = $(this).closest('.day-row');
                var isChecked = $(this).is(':checked');

                row.find('.open-time, .close-time').prop('disabled', !isChecked);
            });
        });
    </script>
@endpush
