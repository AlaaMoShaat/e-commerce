@extends('layouts.dashboard.auth.auth')
<title>419</title>
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="col-sm-5 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4 box-shadow-2">
                    <div class="card border-grey border-lighten-3 px-2 my-0 row">
                        <div class="card-header no-border pb-1">
                            <div class="card-body">
                                <h2 class="error-code text-center mb-2">419</h2>
                                <h4 class="text-uppercase text-center">{{ __('static.errors.419') }}</h4>
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
                        {{-- <div class="card-footer no-border pb-1">
                            <div class="text-center">
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook">
                                    <span class="la la-facebook"></span>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter">
                                    <span class="la la-twitter"></span>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin">
                                    <span class="la la-linkedin font-medium-4"></span>
                                </a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github">
                                    <span class="la la-github font-medium-4"></span>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
