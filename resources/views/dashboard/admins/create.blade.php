@extends('layouts.dashboard.app')
<title>{{ __('static.admins.create_admin') }}</title>

@section('content')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.admins.create_admin'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.admins.title'), 'url' => route('dashboard.admins.index')],
            ['title' => __('static.admins.create_admin'), 'url' => ''],
        ],
    ])

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.admins.create_admin') }}
                </h4>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            @include('dashboard.includes.validations')
            <div class="card-content collapse show">
                <div class="card-body">
                    <form action="{{ route('dashboard.admins.store') }}" method="POST" class="form">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput1">{{ __('static.admins.admin_name_en') }}</label>
                                        <input type="text" id="userinput1" class="form-control border-primary"
                                            placeholder="{{ __('static.admins.admin_name_en') }}" name="name[en]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput1">{{ __('static.admins.admin_name_ar') }}</label>
                                        <input type="text" id="userinput1" class="form-control border-primary"
                                            placeholder="{{ __('static.admins.admin_name_ar') }}" name="name[ar]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('static.actions.save') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
