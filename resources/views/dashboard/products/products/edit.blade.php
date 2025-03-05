@extends('layouts.dashboard.app')
<title>{{ __('static.products.edit_product') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.products.edit_product'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.products.title'), 'url' => route('dashboard.products.index')],
            ['title' => __('static.products.edit_product'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.products.edit_product') }}
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
                        @livewire('dashboard.edit-product', ['productId' => $productId, 'categories' => $categories, 'brands' => $brands, 'productAttributes' => $attributes])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/vendors/css/forms/tags/tagging.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/custom/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showFullScreenModal', () => {
                $('#fullscreenModal').modal('show');
            });
        });
    </script>
    {{-- tags --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        // Initialize Tagify
        const input = document.querySelector('#tagInput');
        new Tagify(input, {
            delimiters: ", ", // Tags separated by space, comma, or enter
            placeholder: "Type and press space or enter",
            maxTags: 10, // Maximum number of tags
        });
    </script>
@endpush
