@php
    $field = $field ?? 'error';
@endphp

@if ($errors->has($field))
    <div class="row mt-1">
        <button class="btn btn-outline-danger" id="type-error">
            {{ $errors->first($field) }}
        </button>
    </div>
@endif
