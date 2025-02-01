<div class="dropdown float-md-lift">
    <button class="btn btn-info dropdown-toggle btn-glow px-2" id="dropdownBreadcrumbButton" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('static.actions.title') }}</button>
    <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
        <a style="padding: 3px" href="#" class="coupon-edit" type="button" coupon-id="{{ $coupon->id }}"
            coupon-status="{{ $coupon->status }}" coupon-code="{{ $coupon->code }}"
            coupon-discount="{{ $coupon->discount_percentage }}" coupon-start-date="{{ $coupon->start_date }}"
            coupon-end-date="{{ $coupon->end_date }}" coupon-limit="{{ $coupon->limit }}">
            <i class="la la-edit"></i>{{ __('static.actions.edit') }}</a>
        <a href="javascript:void(0)" style="padding: 3px" class="dropdown-item"
            data-url="{{ route('dashboard.coupons.destroy', $coupon->id) }}"
            data-message="{{ __('messages.delete_confirmation') }}" data-title="{{ __('static.global.sure') }}"
            data-item_id="coupon_{{ $coupon->id }}"
            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
        </a>

        <a style="padding: 3px" class="dropdown-item change_status" data-id="{{ $coupon->id }}"
            data-url = "{{ route('dashboard.coupons.changeStatus', $coupon->id) }}"
            data-lang="{{ app()->getLocale() }}"
            onclick="changeStatus(event,this.dataset.id, this.dataset.url,this.dataset.lang)" href="javascript:void(0)">
            <i class="la @if ($coupon->status == '1') la-stop @else la-play @endif"></i>
            {{ __('static.actions.change_status') }}
        </a>

        <div class="dropdown-divider"></div>
        <a style="padding: 3px" class="dropdown-item" href=""><i class="la la-eye"></i>
            {{ __('show') }}</a>
    </div>
</div>
</td>
