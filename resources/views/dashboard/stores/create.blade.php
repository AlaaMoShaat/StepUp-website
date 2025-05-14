@extends('layouts.dashboard.app')
<title>{{ __('static.stores.create_store') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.stores.create_store'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.stores.title'), 'url' => route('dashboard.stores.index')],
            ['title' => __('static.stores.create_store'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.stores.create_store') }}
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
                        <form action="{{ route('dashboard.stores.store') }}" method="post" enctype="multipart/form-data"
                            class="form">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store_name_en">{{ __('static.stores.store_name_en') }}</label>
                                            <input type="text" value="{{ old("name['en']") }}" id="store_name_en"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.stores.store_name_en') }}" name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="store_name_ar">{{ __('static.stores.store_name_ar') }}</label>
                                            <input type="text" value="{{ old("name['ar']") }}" id="store_name_ar"
                                                class="form-control border-primary"
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
                                                    {{ old('importance_level') == 'featured' ? 'selected' : '' }}>
                                                    {{ __('static.stores.featured') }}
                                                </option>
                                                <option value="normal"
                                                    {{ old('importance_level') == 'normal' ? 'selected' : '' }}>
                                                    {{ __('static.stores.normal') }}</option>
                                                <option value="low"
                                                    {{ old('importance_level') == 'low' ? 'selected' : '' }}>
                                                    {{ __('static.stores.low') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website_url">{{ __('static.stores.website_url') }}</label>
                                            <input type="url" value="{{ old('website_url') }}" id="website_url"
                                                name="website_url" class="form-control border-primary"
                                                placeholder="{{ __('static.stores.website_url') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('static.stores.phone') }}</label>
                                            <input type="text" value="{{ old('phone') }}" id="phone" name="phone"
                                                class="form-control border-primary"
                                                placeholder="{{ __('static.stores.phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('static.stores.email') }}</label>
                                            <input type="email" value="{{ old('email') }}" id="email" name="email"
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
                                            @include('dashboard.includes.status-btns', ['isActive' => '0'])
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="store_logo">{{ __('static.stores.logo') }}</label>
                                            <input type="file" name="logo" id="store_logo"
                                                class="form-control singleImage border-primary">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h3>{{ __('static.stores.branches') }}</h3>
                                <hr>
                                <div id="branches_container">
                                    <div class="branch-container mb-4 border border-dark p-3 rounded">
                                        <div class="row branches_row">
                                            <div class="col-md-12">
                                                <h4>{{ __('static.stores.branch') }} 1</h4>
                                            </div>
                                            <div class="col-md-10" id="address-dropdown-1">
                                                <fieldset class="form-group">
                                                    <label
                                                        for="neighborhood">{{ __('static.regions.neighborhood_name') }}</label>
                                                    <select class="single-select-box selectivity-input" id="neighborhood"
                                                        data-placeholder="No city selected"
                                                        name="branches[1][neighborhood_id]">
                                                        @foreach ($neighborhoods as $neighborhood)
                                                            <option value="{{ $neighborhood['id'] }}">
                                                                {{ $neighborhood['current_name'] }} -
                                                                {{ $neighborhood['postal_code'] }}
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
                                                        name="branches[1][address]">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label
                                                        for="attribute_value_ar">{{ __('static.stores.location') }}</label>
                                                    <input type="text" id="attribute_value_ar"
                                                        class="form-control border-primary"
                                                        placeholder="{{ __('static.stores.location') }}"
                                                        name="branches[1][location]">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-2">
                                                <button type="button" disabled class="btn btn-danger removeValRow"><i
                                                        class="ft-x"></i></button>
                                            </div>
                                        </div>

                                        <div class="working-hours-section mt-3">
                                            <hr>
                                            <h5>{{ __('static.stores.working_hours') }}</h5>
                                            @foreach ($days as $day)
                                                <div class="row day-row mb-2">
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input day-checkbox"
                                                                id="day_1_{{ $day->id }}"
                                                                name="branches[1][days][{{ $day->id }}][enabled]"
                                                                value="1">
                                                            <label class="form-check-label"
                                                                for="day_1_{{ $day->id }}">
                                                                {{ $day->day }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control open-time"
                                                            name="branches[1][days][{{ $day->id }}][open_time]"
                                                            disabled>
                                                            @foreach (generateTimeSlots() as $time)
                                                                <option value="{{ $time }}">{{ $time }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control close-time"
                                                            name="branches[1][days][{{ $day->id }}][close_time]"
                                                            disabled>
                                                            @foreach (generateTimeSlots() as $time)
                                                                <option value="{{ $time }}">{{ $time }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="add_more_branches"
                                            data-branch-text="{{ __('static.stores.branch') }}">
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
            let valueIndex = $('.branch-container').length + 1;
            var neighborhoods = {!! json_encode($neighborhoods) !!};
            var currentLang = '{{ app()->getLocale() }}';
            var days = {!! json_encode($days) !!};
            var timeSlots = {!! json_encode(generateTimeSlots()) !!};

            $('#add_more_branches').on('click', function(e) {
                e.preventDefault();
                let branchText = $(this).data('branch-text');

                let daysOptions = days.map(day => `
            <div class="row day-row mb-2">
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input day-checkbox"
                               id="day_${valueIndex}_${day.id}"
                               name="branches[${valueIndex}][days][${day.id}][enabled]"
                               value="1">
                        <label class="form-check-label" for="day_${valueIndex}_${day.id}">
                            ${day.day[currentLang]}
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control open-time"
                            name="branches[${valueIndex}][days][${day.id}][open_time]"
                            disabled>
                        ${timeSlots.map(time => `<option value="${time}">${time}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control close-time"
                            name="branches[${valueIndex}][days][${day.id}][close_time]"
                            disabled>
                        ${timeSlots.map(time => `<option value="${time}">${time}</option>`).join('')}
                    </select>
                </div>
            </div>
        `).join('');

                let newBranch = `
        <div class="branch-container mb-4 border border-dark p-3 rounded">
            <div class="row branches_row">
                <div class="col-md-12"><h4>${branchText} ${valueIndex}</h4></div>
                <div class="col-md-10" id="address-dropdown-${valueIndex}">
                    <fieldset class="form-group">
                        <label for="neighborhood_${valueIndex}">{{ __('static.regions.neighborhood_name') }}</label>
                        <select class="single-select-box selectivity-input" id="neighborhood_${valueIndex}"
                            data-placeholder="{{ __('static.global.select_option') }}" name="branches[${valueIndex}][neighborhood_id]">
                            ${neighborhoods.map(neighborhood => `
                                    <option value="${neighborhood.id}">
                                        ${neighborhood.name[currentLang]} - ${neighborhood.postal_code}
                                    </option>
                                `).join('')}
                        </select>
                    </fieldset>
                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        <label for="address_${valueIndex}">{{ __('static.stores.address') }}</label>
                        <input type="text" id="address_${valueIndex}" class="form-control border-primary"
                            placeholder="{{ __('static.stores.address') }}"
                           name="branches[${valueIndex}][address]">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="location_${valueIndex}">{{ __('static.stores.location') }}</label>
                        <input type="text" id="location_${valueIndex}" class="form-control border-primary"
                            placeholder="{{ __('static.stores.location') }}"
                            name="branches[${valueIndex}][location]">
                    </div>
                </div>
                <div class="col-md-2 mt-2">
                    <button type="button" class="btn btn-danger removeBranch">
                        <i class="ft-x"></i>
                    </button>
                </div>
            </div>

            <!-- قسم مواعيد العمل -->
            <div class="working-hours-section mt-3">
                <hr>
                <h5>{{ __('static.stores.working_hours') }}</h5>
                ${daysOptions}
            </div>
        </div>
        `;

                $('#branches_container').append(newBranch);
                $(`#neighborhood_${valueIndex}`).selectivity();
                valueIndex++;

                updateRemoveButtons();
            });

            $(document).on('change', '.day-checkbox', function() {
                let row = $(this).closest('.day-row');
                let isChecked = $(this).is(':checked');

                row.find('.open-time, .close-time').prop('disabled', !isChecked);
                if (isChecked) {
                    row.find('.open-time').val('08:00');
                    row.find('.close-time').val('17:00');
                }
            });

            $(document).on('click', '.removeBranch', function() {
                if ($('.branch-container').length > 1) {
                    $(this).closest('.branch-container').remove();
                    renumberBranches();
                }
            });

            function renumberBranches() {
                $('.branch-container').each(function(index) {
                    let newIndex = index + 1;
                    $(this).find('h4').text($('#add_more_branches').data('branch-text') + ' ' + newIndex);

                    $(this).find('[id]').each(function() {
                        let id = $(this).attr('id').replace(/\d+$/, newIndex);
                        $(this).attr('id', id);
                    });

                    $(this).find('[name]').each(function() {
                        let name = $(this).attr('name').replace(/branches\[\d+\]/,
                            `branches[${newIndex}]`);
                        $(this).attr('name', name);
                    });
                });
                valueIndex = $('.branch-container').length + 1;
                updateRemoveButtons();
            }

            function updateRemoveButtons() {
                $('.branch-container').each(function(index) {
                    if (index === 0) {
                        $(this).find('.removeBranch').prop('disabled', true);
                    } else {
                        $(this).find('.removeBranch').prop('disabled', false);
                    }
                });
            }

            updateRemoveButtons();
        });
    </script>
@endpush
