@extends('layouts.dashboard.auth.auth')
<title>{{ __('auth.verify_code') }}</title>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png"
                                            alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{ __('auth.verify_code') }}</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('dashboard.password.verifyCode') }}" method="POST"
                                            class="form-horizontal" novalidate>
                                            @csrf
                                            <input hidden type="email" name="email" value="{{ $email }}"
                                                class="form-control form-control-lg input-lg" id="user-email" required>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="code" type="text"
                                                    class="form-control form-control-lg input-lg" id="user-code"
                                                    placeholder="{{ __('auth.code') }}" required>
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            @include('dashboard.includes.validations')
                                            <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i>{{ __('auth.verify_code') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
