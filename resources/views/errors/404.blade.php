@extends('layouts.dashboard.auth.auth')
<title>404</title>
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="col-sm-5 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4 box-shadow-2">
                    <div class="card border-grey border-lighten-3 px-2 my-0 row">
                        <div class="card-header no-border pb-1">
                            <div class="card-body">
                                <h2 class="error-code text-center mb-2">404</h2>
                                <h4 class="text-uppercase text-center">{{ __('static.errors.404') }}</h4>
                            </div>
                        </div>
                        <div class="card-content px-2">
                            <div class="row py-2">
                                <div class="col-12">
                                    <a href="{{ route('dashboard.home') }}" class="btn btn-primary btn-block btn-lg"><i
                                            class="la la-home"></i>
                                        {{ __('static.global.back_to_home') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
