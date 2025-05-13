<!-- Modal -->
<form action="{{ route('dashboard.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="add-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('static.stores.create_new_store') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.includes.validations')
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

                        <div class="row branches_row">
                            <div class="col-md-12">
                                <h4>{{ __('static.stores.branch') }} 1</h4>
                            </div>
                            <div class="col-md-10" id="address-dropdown-1">
                                <fieldset class="form-group">
                                    <label for="neighborhood">{{ __('static.regions.neighborhood_name') }}</label>
                                    <select class="single-select-box selectivity-input" id="neighborhood"
                                        data-placeholder="No city selected" name="branches[1][neighborhood_id]">
                                        @foreach ($neighborhoods as $neighborhood)
                                            <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }} -
                                                {{ $neighborhood->postal_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="address">{{ __('static.stores.address') }}</label>
                                    <input type="text" id="address" class="form-control border-primary"
                                        placeholder="{{ __('static.stores.address') }}" name="branches[1][address]">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="attribute_value_ar">{{ __('static.stores.location') }}</label>
                                    <input type="text" id="attribute_value_ar" class="form-control border-primary"
                                        placeholder="{{ __('static.stores.location') }}"
                                        name="branches[1][location]">
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="button" disabled class="btn btn-danger removeValRow"><i
                                        class="ft-x"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primery" id="add_more_branches">
                                    <i class="ft-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('static.actions.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('static.actions.save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
