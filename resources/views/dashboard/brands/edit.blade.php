@extends('layouts.dashboard.app')
<title>{{ __('static.brands.edit_brand') }}</title>

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.brands.edit_brand'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.brands.title'), 'url' => route('dashboard.brands.index')],
            ['title' => __('static.brands.edit_brand'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.brands.edit_brand') }}
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
                        <form action="{{ route('dashboard.brands.update', $brand->id) }}" method="POST" class="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_name_en">{{ __('static.brands.brand_name_en') }}</label>
                                            <input type="text" value="{{ $brand->getTranslation('name', 'en') }}"
                                                id="brand_name_en" class="form-control border-primary"
                                                placeholder="{{ __('static.brands.brand_name_en') }}" name="name[en]">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="brand_name_ar">{{ __('static.brands.brand_name_ar') }}</label>
                                            <input type="text" value="{{ $brand->getTranslation('name', 'ar') }}"
                                                id="brand_name_ar" class="form-control border-primary"
                                                placeholder="{{ __('static.brands.brand_name_ar') }}" name="name[ar]">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="brand_logo">{{ __('static.brands.logo') }}</label>
                                            <input type="file" name="logo" id="brand_logo"
                                                class="form-control singleImageEdit border-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="display: block"
                                                for="status">{{ __('static.global.status') }}</label>
                                            @php
                                                $isActive = $brand->status;
                                            @endphp
                                            @include('dashboard.includes.status-btns', [
                                                'isActive' => $isActive,
                                            ])
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="{{ url()->previous() }}"
                                        class="btn btn-danger">{{ __('static.actions.cancel') }}</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('static.actions.edit') }}
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
        var lang = "{{ app()->getLocale() }}";
        $(function() {
            $('.singleImageEdit').fileinput({
                theme: 'fa5',
                language: lang,
                allowedFileTypes: ['image'],
                maxFileCount: 1,
                enableResumableUpload: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    "{{ asset($brand->logo) }}"
                ],
            });
        });
    </script>
@endpush
