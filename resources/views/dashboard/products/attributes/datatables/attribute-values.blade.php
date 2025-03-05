@foreach ($attribute->attributeValues as $value)
    <div class="badge border-info info badge-border">
        {{ $value->getTranslation('value', app()->getLocale()) }}
    </div>
@endforeach
