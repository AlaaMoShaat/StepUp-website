<div class="dropdown float-md-lift">
    <button class="btn btn-info dropdown-toggle btn-glow px-2" id="dropdownBreadcrumbButton" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('static.actions.title') }}</button>
    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a style="padding: 3px" class="dropdown-item"
            href="{{ route('dashboard.stores.edit', $store->id) }}">
            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>


        <a style="padding: 3px" class="dropdown-item change_status" data-id="{{ $store->id }}"
            data-url = "{{ route('dashboard.stores.changeStatus', $store->id) }}" data-lang="{{ app()->getLocale() }}"
            onclick="changeStatus(event,this.dataset.id, this.dataset.url,this.dataset.lang)" href="javascript:void(0)">
            <i class="la @if ($store->status == '1') la-stop @else la-play @endif"></i>
            {{ __('static.actions.change_status') }}
        </a>

        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" style="padding: 3px" class="dropdown-item"
            data-url="{{ route('dashboard.stores.destroy', $store->id) }}"
            data-message="{{ __('messages.delete_confirmation') }}" data-title="{{ __('static.global.sure') }}"
            data-item_id="store_{{ $store->id }}"
            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
        </a>
    </div>
</div>
</td>
