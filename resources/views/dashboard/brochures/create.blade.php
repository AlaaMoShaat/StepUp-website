@extends('layouts.dashboard.app')
<title>{{ __('static.brochures.create_brochure') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.brochures.create_brochure'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.brochures.title'), 'url' => ''],
            ['title' => __('static.brochures.create_brochure'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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
                        <form action="{{ route('dashboard.brochures.store') }}" method="post" enctype="multipart/form-data"
                            class="form">
                            @csrf
                            <div class="form-body">
                                <hr>
                                <h3>{{ __('static.brochures.images') }}</h3>
                                <hr>
                                <div id="brochures_container">
                                    <!-- Initial Brochure -->
                                    <div class="brochure-container mb-4 border border-dark p-3 rounded"
                                        data-brochure-index="1">
                                        <div class="row brochures_row">
                                            <div class="col-md-12">
                                                <h4>{{ __('static.brochures.brochure_name') }} 1</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="file" name="brochures[1][file]"
                                                        class="form-control singleImage border-primary" required>
                                                    <div class="image-preview mt-2" style="display: none;">
                                                        <img src="" class="img-fluid" style="max-height: 200px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hotspots_container">
                                                <!-- Initial Hotspot -->
                                                <div class="hotspot-container mb-4 border border-dark p-3 rounded">
                                                    <div class="row brochure_hotspot_row">
                                                        <div class="col-md-12 mb-2">
                                                            <h4>
                                                                {{ __('static.brochures.link') }} 1
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <fieldset class="form-group">
                                                                <label>{{ __('static.offers.offer_name') }}</label>
                                                                <select class="single-select-box selectivity-input"
                                                                    name="brochures[1][hotspots][1][offer_id]" required>

                                                                    @foreach ($offers as $offer)
                                                                        <option value="{{ $offer['id'] }}">
                                                                            {{ $offer['current_title'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label>{{ __('static.brochures.coordinates') }}</label>
                                                                <input type="text"
                                                                    class="form-control border-primary coordinates-input"
                                                                    placeholder="{{ __('static.brochures.coordinates') }}"
                                                                    name="brochures[1][hotspots][1][coordinates]" required>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary open-map-btn">
                                                                    <i class="ft-map-pin"></i>
                                                                </button>
                                                            </div>
                                                        </div>


                                                        <div class="modal fade" id="coordinatesModal" tabindex="-1"
                                                            role="dialog">
                                                            <div class="modal-dialog modal-xl" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            {{ __('static.brochures.select_area') }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">
                                                                            <span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="image-map-container">
                                                                            <img class="image-map-preview">
                                                                            <div class="selection-rectangle"></div>
                                                                        </div>
                                                                        <p class="mt-2">
                                                                            <strong>{{ __('static.brochures.coordinates') }}:</strong>
                                                                            <span class="current-coordinates"></span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">
                                                                            {{ __('static.actions.cancel') }}
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-primary apply-coordinates">
                                                                            {{ __('static.actions.apply') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label>{{ __('static.brochures.link') }}</label>
                                                                <input type="url" class="form-control border-primary"
                                                                    placeholder="{{ __('static.brochures.link') }}"
                                                                    name="brochures[1][hotspots][1][link]">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 mt-2">
                                                            <button type="button" class="btn btn-danger removeHotSpotRow"
                                                                disabled>
                                                                <i class="ft-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary add_more_hotspots">
                                                    <i class="ft-plus"></i> {{ __('static.brochures.add_hotspot') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2 mb-2">
                                            <button type="button" class="btn btn-danger removeBrochureRow"
                                                style="float: left" disabled>
                                                <i class="ft-x"></i>{{ __('static.brochures.remove_brochure') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="add_more_brochures"
                                            data-brochure-text="{{ __('static.brochures.brochure_name') }}">
                                            <i class="ft-plus"></i> {{ __('static.brochures.add_brochure') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-actions right mt-3">
                                    <a href="" class="btn btn-danger">
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

@push('css')
    <style>
        .image-map-container {
            position: relative;
            display: inline-block;
            margin: 10px 0;
        }

        .image-map-preview {
            max-width: 100%;
            max-height: 400px;
        }

        .selection-rectangle {
            border: 2px dashed red;
            position: absolute;
            pointer-events: none;
            display: none;
        }

        .coordinates-input-group {
            position: relative;
        }

        .open-map-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            let brochureCounter = 1;
            const currentLang = '{{ app()->getLocale() }}';
            const offers = {!! json_encode($offers) !!};

            // Add Brochure
            $('#add_more_brochures').click(function(e) {
                e.preventDefault();
                brochureCounter++;
                const brochureIndex = brochureCounter;
                const brochureText = $(this).data('brochure-text');

                const newBrochure = `
                <div class="brochure-container mb-4 border border-dark p-3 rounded" data-brochure-index="${brochureIndex}">
                    <div class="row brochures_row">
                        <div class="col-md-12">
                            <h4>${brochureText} ${brochureIndex}</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="brochures[${brochureIndex}][file]"
                                       class="form-control singleImage border-primary" required>
                            </div>
                        </div>
                        <div class="hotspots_container">
                            <div class="hotspot-container mb-4 border border-dark p-3 rounded">
                                <div class="row brochure_hotspot_row">
                                     <div class="col-md-12 mb-2">
                                        <h4>
                                            {{ __('static.brochures.link') }} 1
                                        </h4>
                                    </div>
                                    <div class="col-md-10">
                                        <fieldset class="form-group">
                                            <label>{{ __('static.offers.offer_name') }}</label>
                                            <select class="single-select-box selectivity-input"
                                                    name="brochures[${brochureIndex}][hotspots][1][offer_id]" required>
                                                ${offers.map(offer => `
                                                                                                                                                                                                                                                                                <option value="${offer.id}">
                                                                                                                                                                                                                                                                                    ${offer.title[currentLang]}
                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                            `).join('')}
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>{{ __('static.brochures.coordinates') }}</label>
                                            <input type="text" class="form-control border-primary"
                                                   placeholder="{{ __('static.brochures.coordinates') }}"
                                                   name="brochures[${brochureIndex}][hotspots][1][coordinates]" required>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>{{ __('static.brochures.link') }}</label>
                                            <input type="url" class="form-control border-primary"
                                                   placeholder="{{ __('static.brochures.link') }}"
                                                   name="brochures[${brochureIndex}][hotspots][1][link]">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <button type="button" class="btn btn-danger removeHotSpotRow" disabled>
                                            <i class="ft-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary add_more_hotspots">
                                <i class="ft-plus"></i> {{ __('static.brochures.add_hotspot') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-2">
                        <button type="button" class="btn btn-danger removeBrochureRow" style="float: left">
                            <i class="ft-x"></i>{{ __('static.brochures.remove_brochure') }}
                        </button>
                    </div>
                </div>`;

                $('#brochures_container').append(newBrochure);
                $('#brochures_container .singleImage').fileinput({
                    theme: 'fa5',
                    language: lang,
                    allowedFileTypes: ['image'],
                    maxFileCount: 1,
                    enableResumableUpload: false,
                    showUpload: false,
                });
                let newElement = $('#brochures_container .brochure-container').last();
                newElement.find('.single-select-box').selectivity();
                updateRemoveButtons();
            });

            // Add Hotspot
            $(document).on('click', '.add_more_hotspots', function(e) {
                e.preventDefault();
                const brochureContainer = $(this).closest('.brochure-container');
                const brochureIndex = brochureContainer.data('brochure-index');
                const hotspotCount = brochureContainer.find('.hotspot-container').length + 1;

                const newHotspot = `
                <div class="hotspot-container mb-4 border border-dark p-3 rounded">
                    <div class="row brochure_hotspot_row">
                          <div class="col-md-12 mb-2">
                            <h4>
                                {{ __('static.brochures.link') }} ${hotspotCount}
                            </h4>
                        </div>
                        <div class="col-md-10">
                            <fieldset class="form-group">
                                <label>{{ __('static.offers.offer_name') }}</label>
                                <select class="single-select-box selectivity-input"
                                        name="brochures[${brochureIndex}][hotspots][${hotspotCount}][offer_id]" required>
                                    ${offers.map(offer => `
                                                                                                                                                                                                        <option value="${offer.id}">
                                                                                                                                                                                                            ${offer.title[currentLang]}
                                                                                                                                                                                                        </option>
                                                                                                                                                                                                    `).join('')}
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>{{ __('static.brochures.coordinates') }}</label>
                                <input type="text" class="form-control border-primary"
                                       placeholder="{{ __('static.brochures.coordinates') }}"
                                       name="brochures[${brochureIndex}][hotspots][${hotspotCount}][coordinates]" required>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label>{{ __('static.brochures.link') }}</label>
                                <input type="url" class="form-control border-primary"
                                       placeholder="{{ __('static.brochures.link') }}"
                                       name="brochures[${brochureIndex}][hotspots][${hotspotCount}][link]">
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger removeHotSpotRow">
                                <i class="ft-x"></i>
                            </button>
                        </div>
                    </div>
                </div>`;

                brochureContainer.find('.hotspots_container').append(newHotspot);
                brochureContainer.find('.hotspot-container').last().find('.single-select-box')
                    .selectivity();
                updateRemoveButtons();
            });

            // Remove Brochure
            $(document).on('click', '.removeBrochureRow', function() {
                if ($('.brochure-container').length > 1) {
                    $(this).closest('.brochure-container').remove();
                    updateRemoveButtons();
                }
            });

            // Remove Hotspot
            $(document).on('click', '.removeHotSpotRow', function() {
                const hotspotContainer = $(this).closest('.hotspot-container');
                if (hotspotContainer.siblings('.hotspot-container').length >= 1) {
                    hotspotContainer.remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                // Update brochure remove buttons
                $('.removeBrochureRow').prop('disabled', $('.brochure-container').length === 1);

                // Update hotspot remove buttons
                $('.brochure-container').each(function() {
                    const hotspots = $(this).find('.hotspot-container');
                    hotspots.find('.removeHotSpotRow').prop('disabled', hotspots.length === 1);
                });
            }

            // Initialize remove buttons state
            updateRemoveButtons();



            // داخل document.ready
            let currentCoordinatesInput = null;
            let currentImageSrc = null;


            // عند اختيار الصورة
            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                const container = $(this).closest('.brochure-container');
                const preview = container.find('.image-preview img');
                const previewContainer = container.find('.image-preview');

                reader.onload = function(e) {
                    preview.attr('src', e.target.result);
                    previewContainer.show();
                    container.data('preview', e.target.result); // حفظ رابط الصورة
                }

                reader.onerror = function() {
                    alert('حدث خطأ أثناء قراءة الملف');
                };

                reader.readAsDataURL(file);
            });

            // عند النقر على زر الخريطة
            $(document).on('click', '.open-map-btn', function() {
                const brochureContainer = $(this).closest('.brochure-container');
                const preview = brochureContainer.find('.image-preview img').attr('src');

                if (!preview) {
                    alert('{{ __('static.brochures.upload_image_first') }}');
                    return;
                }

                currentCoordinatesInput = $(this).siblings('.coordinates-input');
                $('#coordinatesModal').modal('show');
                initCoordinatesSelection(preview);
            });

            // Initialize coordinates selection
            // تعديل دالة initCoordinatesSelection
            function initCoordinatesSelection(imageSrc) {
                const container = $('.image-map-container');
                const image = container.find('.image-map-preview');
                const selection = container.find('.selection-rectangle');
                const currentCoords = container.closest('.modal-body').find('.current-coordinates');

                selection.hide();
                currentCoords.text('');
                image.attr('src', imageSrc);

                image.off('load').on('load', function() {
                    let isDrawing = false;
                    let startX, startY, endX, endY;

                    container.off('mousedown mousemove mouseup');

                    container.on('mousedown', function(e) {
                        isDrawing = true;
                        const rect = image[0].getBoundingClientRect();
                        const scaleX = image[0].naturalWidth / rect.width;
                        const scaleY = image[0].naturalHeight / rect.height;

                        startX = (e.clientX - rect.left) * scaleX;
                        startY = (e.clientY - rect.top) * scaleY;

                        selection.css({
                            left: (startX / scaleX) + 'px',
                            top: (startY / scaleY) + 'px',
                            width: '0px',
                            height: '0px',
                            display: 'block'
                        });
                    });

                    container.on('mousemove', function(e) {
                        if (!isDrawing) return;

                        const rect = image[0].getBoundingClientRect();
                        const scaleX = image[0].naturalWidth / rect.width;
                        const scaleY = image[0].naturalHeight / rect.height;

                        endX = (e.clientX - rect.left) * scaleX;
                        endY = (e.clientY - rect.top) * scaleY;

                        const displayWidth = Math.abs(endX - startX) / scaleX;
                        const displayHeight = Math.abs(endY - startY) / scaleY;

                        selection.css({
                            width: displayWidth + 'px',
                            height: displayHeight + 'px',
                            left: (endX < startX ? endX / scaleX : startX / scaleX) + 'px',
                            top: (endY < startY ? endY / scaleY : startY / scaleY) + 'px'
                        });

                        currentCoords.text(
                            `${Math.round(Math.min(startX, endX))},` +
                            `${Math.round(Math.min(startY, endY))},` +
                            `${Math.round(Math.max(startX, endX))},` +
                            `${Math.round(Math.max(startY, endY))}`
                        );
                    });

                    container.on('mouseup', function() {
                        isDrawing = false;
                    });
                });
            }


            // تعديل حدث تطبيق الإحداثيات
            $('.apply-coordinates').click(function() {
                const coords = $('.current-coordinates').text()
                    .replace('X1: ', '')
                    .replace('Y1: ', '')
                    .replace('X2: ', '')
                    .replace('Y2: ', '')
                    .replace(/ /g, '');

                if (currentCoordinatesInput) {
                    currentCoordinatesInput.val(coords);
                }
                $('#coordinatesModal').modal('hide');
            });

            // تطبيق الإحداثيات
            $('.apply-coordinates').click(function() {
                const coords = $('.current-coordinates').text();
                if (currentCoordinatesInput) {
                    currentCoordinatesInput.val(coords);
                }
                $('#coordinatesModal').modal('hide');
            });
        });
    </script>

    <script></script>
@endpush
