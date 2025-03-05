<div class="form-group">
    <div class="btn-group" role="group">
        <button class="attribute-edit btn btn-outline-success" data-id="{{ $attribute->id }}"
            data-name-ar="{{ $attribute->getTranslation('name', 'ar') }}"
            data-name-en="{{ $attribute->getTranslation('name', 'en') }}"
            data-values={{ $attribute->attributeValues->map(
                    fn($val) => [
                        'id' => $val->id,
                        'value_ar' => $val->getTranslation('value', 'ar'),
                        'value_en' => $val->getTranslation('value', 'en'),
                    ],
                )->toJson() }}>

            <i class="la la-edit"></i>{{ __('static.actions.edit') }}
        </button>

        <a href="javascript:void(0)" class="delete_attribute btn btn-outline-danger"
            data-url="{{ route('dashboard.attributes.destroy', $attribute->id) }}"
            data-message="{{ __('messages.delete_confirmation') }}" data-title="{{ __('static.global.sure') }}"
            data-item_id="attribute_{{ $attribute->id }}"
            onclick="confirmDelete(event, this.dataset.url,this.dataset.item_id, this.dataset.message, this.dataset.title)">
            <i class="la la-trash"></i>{{ __('static.actions.delete') }}
        </a>
    </div>
</div>
