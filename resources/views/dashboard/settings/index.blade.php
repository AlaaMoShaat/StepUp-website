@extends('layouts.dashboard.app')
<title>{{ __('static.site_settings.title') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.site_settings.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.site_settings.title'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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
                        <div class="card-text">

                        </div>
                        <form action="{{ route('dashboard.settings.update', $setting->id) }}" method="POST"
                            enctype="multipart/form-data" class="form form-horizontal row-separator setting_form">
                            @csrf
                            @method('PUT')

                            <div class="form-body">

                                {{-- basic info --}}
                                <h4 class="form-section"><i class="la la-eye"></i>{{ __('static.site_settings.title') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_name_ar') }}</label>
                                            <div class="col-md-9">
                                                <input readonly type="text" id="userinput1"
                                                    class="form-control border-primary "
                                                    placeholder="{{ __('static.site_settings.site_name_ar') }}"
                                                    name="site_name[ar]"
                                                    value="{{ $setting->getTranslation('site_name', 'ar') }}">

                                                @error('site_name.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_name_en') }}</label>
                                            <div class="col-md-9">
                                                <input readonly type="text" id="userinput1"
                                                    class="form-control border-primary "
                                                    placeholder="{{ __('static.site_settings.site_name_en') }}"
                                                    name="site_name[en]"
                                                    value="{{ $setting->getTranslation('site_name', 'en') }}">
                                                @error('site_name.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_desc_ar') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" readonly name="site_desc[ar]" class="form-control border-primary ">{{ $setting->getTranslation('site_desc', 'ar') }}</textarea>
                                                @error('site_desc.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_desc_en') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" readonly name="site_desc[en]" class="form-control border-primary ">{{ $setting->getTranslation('site_desc', 'en') }}</textarea>
                                                @error('site_desc.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_meta_description_ar') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" readonly name="site_meta_description[ar]" class="form-control border-primary ">{{ $setting->getTranslation('site_meta_description', 'ar') }}</textarea>
                                                @error('site_meta_description.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput1">{{ __('static.site_settings.site_meta_description_en') }}</label>
                                            <div class="col-md-9">
                                                <textarea rows="6" readonly name="site_meta_description[en]" class="form-control border-primary ">{{ $setting->getTranslation('site_meta_description', 'en') }} </textarea>
                                                @error('site_meta_description.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="userinput3">{{ __('static.site_settings.site_address_ar') }}</label>
                                            <div class="col-md-9">
                                                <input readonly type="text" id="userinput3"
                                                    class="form-control border-primary "
                                                    placeholder="{{ __('static.site_settings.site_address_ar') }}"
                                                    name="site_address[ar]"
                                                    value="{{ $setting->getTranslation('site_address', 'ar') }}">
                                                @error('site_address.ar')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="userinput3">{{ __('static.site_settings.site_address_en') }}</label>
                                            <div class="col-md-9">
                                                <input readonly type="text" id="userinput3"
                                                    class="form-control border-primary "
                                                    placeholder="{{ __('static.site_settings.site_address_en') }}"
                                                    name="site_address[en]"
                                                    value="{{ $setting->getTranslation('site_address', 'en') }}">
                                                @error('site_address.en')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control"
                                                for="userinput3">{{ __('static.site_settings.site_copyright') }}</label>
                                            <div class="col-md-9">
                                                <input readonly type="text" id="userinput3"
                                                    class="form-control border-primary "
                                                    placeholder="{{ __('static.site_settings.site_copyright') }}"
                                                    name="site_copyright" value="{{ $setting->site_copyright }}">
                                                @error('site_copyright')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end basic info --}}

                                {{-- contact info --}}
                                <h4 class="form-section"><i class="la la-envelope"></i>{{ __('dashboard.contact_info') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_email') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_email" class="form-control border-primary "
                                                    type="email"
                                                    placeholder="{{ __('static.site_settings.site_email') }}"
                                                    id="userinput5" value="{{ $setting->site_email }}">
                                                @error('site_email')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_email_support') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_email_support"
                                                    class="form-control border-primary " type="email"
                                                    placeholder="{{ __('static.site_settings.site_email_support') }}"
                                                    id="userinput5" value="{{ $setting->site_email_support }}">
                                                @error('site_email_support')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_phone') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_phone" class="form-control border-primary "
                                                    type="text"
                                                    placeholder="{{ __('static.site_settings.site_phone') }}"
                                                    id="userinput5" value="{{ $setting->site_phone }}">
                                                @error('site_phone')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end contact info --}}

                                {{-- socail --}}
                                <h4 class="form-section"><i
                                        class="la la-envelope"></i>{{ __('static.site_settings.site_social') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_facebook_url') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_facebook_url"
                                                    class="form-control border-primary " type="url"
                                                    placeholder="{{ __('static.site_settings.site_facebook_url') }}"
                                                    id="userinput5" value="{{ $setting->site_facebook_url }}">
                                                @error('site_facebook_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_twitter_url') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_twitter_url"
                                                    class="form-control border-primary " type="url"
                                                    placeholder="{{ __('static.site_settings.site_twitter_url') }}"
                                                    id="userinput5" value="{{ $setting->site_twitter_url }}">
                                                @error('site_twitter_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_instagram_url') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_instagram_url"
                                                    class="form-control border-primary " type="url"
                                                    placeholder="{{ __('static.site_settings.site_instagram_url') }}"
                                                    id="userinput5" value="{{ $setting->site_instagram_url }}">
                                                @error('site_instagram_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_whatsapp_url') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_whatsapp_url"
                                                    class="form-control border-primary " type="url"
                                                    placeholder="{{ __('static.site_settings.site_whatsapp_url') }}"
                                                    id="userinput5" value="{{ $setting->site_whatsapp_url }}">
                                                @error('site_whatsapp_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end social --}}

                                {{-- Media --}}
                                <h4 class="form-section"><i
                                        class="la la-envelope"></i>{{ __('static.site_settings.site_media') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_logo') }}</label>
                                            <div class="col-md-9">
                                                <input name="logo" id="logo-image"
                                                    class="form-control border-primary " type="file"
                                                    placeholder="{{ __('static.site_settings.site_logo') }}">
                                                @error('logo')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_favicon') }}</label>
                                            <div class="col-md-9">
                                                <input name="favicon" id="favicon-image"
                                                    class="form-control border-primary " type="file"
                                                    placeholder="{{ __('static.site_settings.site_favicon') }}">
                                                @error('favicon')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="userinput5">{{ __('static.site_settings.site_promotion_video_url') }}</label>
                                            <div class="col-md-9">
                                                <input readonly name="site_promotion_video_url"
                                                    class="form-control border-primary " type="text"
                                                    placeholder="{{ __('static.site_settings.site_promotion_video_url') }}"
                                                    id="userinput5" value="{{ $setting->site_promotion_video_url }}">
                                                @error('site_promotion_video_url')
                                                    <strong class="text-danger"> {{ $message }}</strong>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end media --}}
                            </div>
                            {{-- buttons --}}
                            <div class="form-actions right">
                                <button hidden id="cancel_btn" type="button" class="btn btn-warning mr-1">
                                    <i class="la la-remove"></i> {{ __('static.actions.cancel') }}
                                </button>
                                <button hidden id="submit_btn" type="submit" class="btn btn-primary">
                                    <i class="la la-check"></i> {{ __('static.actions.save') }}
                                </button>
                                <button id="edit_btn" type="button" class="btn btn-info">
                                    <i class="la la-edit"></i> {{ __('static.actions.edit') }}
                                </button>
                            </div>
                            {{-- end button --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- File Input (Logo & Favicon) --}}
    <script>
        var lang = "{{ app()->getLocale() }}";
        $(function() {
            $('#logo-image').fileinput({
                theme: 'fa5',
                language: lang,
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                enableResumableUpload: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset($setting->logo) }}",
                ],

            });
            $('#favicon-image').fileinput({
                theme: 'fa5',
                language: lang,
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                enableResumableUpload: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset($setting->favicon) }}",
                ],

            });

        });
    </script>

    <script>
        let originalValues = {};
        $(document).on('click', '#edit_btn', function() {
            $('#edit_btn').attr('hidden', true);
            $('#submit_btn').removeAttr('hidden');
            $('#cancel_btn').removeAttr('hidden');

            $('.setting_form input').each(function() {
                originalValues[$(this).attr('name')] = $(this).val(); // Save original values
                $(this).removeAttr('readonly');
            });
            $('.setting_form textarea').each(function() {
                originalValues[$(this).attr('name')] = $(this).val(); // Save original values
                $(this).removeAttr('readonly');
            });

            $('.setting_form input').removeAttr('readonly');
            $('.setting_form textarea').removeAttr('readonly');
        });

        // when click on cancel button
        $(document).on('click', '#cancel_btn', function() {
            // remove additional text add to inputs and textarea
            // task
            $('.setting_form input').each(function() {
                const name = $(this).attr('name');
                if (originalValues[name] !== undefined) {
                    $(this).val(originalValues[name]);
                }
            });
            $('.setting_form textarea').each(function() {
                const name = $(this).attr('name');
                if (originalValues[name] !== undefined) {
                    $(this).val(originalValues[name]);
                }
            });

            $('#edit_btn').removeAttr('hidden');
            $('#submit_btn').attr('hidden', true);
            $('#cancel_btn').attr('hidden', true);
            $('.setting_form input').attr('readonly', true);
            $('.setting_form textarea').attr('readonly', true);
        });
    </script>
@endpush
