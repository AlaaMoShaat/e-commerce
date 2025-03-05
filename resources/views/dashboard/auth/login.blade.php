@extends('layouts.dashboard.auth.auth')

<title>{{ __('auth.login') }}</title>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset($setting->logo) }}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{ __('auth.login_with_ecom') }}</span>
                                    </h6>
                                    @include('dashboard.includes.validations')
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="loginForm" action="{{ route('dashboard.login.post') }}" method="POST"
                                            class="form-horizontal" action="index.html" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="email" type="text" class="form-control input-lg"
                                                    id="user-name" placeholder="{{ __('auth.email') }}" tabindex="1">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="password" type="password" class="form-control input-lg"
                                                    id="password" placeholder="{{ __('auth.password') }}" tabindex="2">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>
                                            <div class="overlay" id="captchaOverlay" style="display: none;">
                                                <div class="captcha-container">
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            </div>

                                            <style>
                                                /* الغلاف الكامل */
                                                .overlay {
                                                    position: fixed;
                                                    top: 0;
                                                    left: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    background: rgba(0, 0, 0, 0.7);
                                                    /* خلفية نصف شفافة */
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    z-index: 9999;
                                                    /* ضمان الظهور فوق جميع العناصر */
                                                }

                                                /* صندوق الكابتشا */
                                                .captcha-container {
                                                    background: #fff;
                                                    padding: 20px;
                                                    border-radius: 8px;
                                                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
                                                    /* إضافة تأثير الظل */
                                                    text-align: center;
                                                    max-width: 400px;
                                                    /* عرض مناسب */
                                                    width: 90%;
                                                    /* قابل للتكيف مع الشاشات الصغيرة */
                                                }
                                            </style>
                                            <div class="row">
                                                @error('g-recaptcha-response')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-md-left">
                                                    <fieldset>
                                                        <input name="remember_me" type="checkbox" id="remember-me"
                                                            class="chk-remember">
                                                        <label for="remember-me">{{ __('auth.remember_me') }}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-12 text-center text-md-right"><a
                                                        href="{{ route('dashboard.password.email') }}"
                                                        class="card-link">{{ __('auth.forget_password') }}</a></div>
                                            </div>
                                            <button id="loginButton" class="btn btn-danger btn-block btn-lg"><i
                                                    class="ft-unlock"></i>{{ __('auth.login') }}</button>
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

@push('js')
    {!! NoCaptcha::renderJs() !!}
    <script>
        document.getElementById('loginButton').addEventListener('click', function(event) {
            event.preventDefault(); // منع إعادة تحميل الصفحة

            // عرض نافذة الكابتشا
            document.getElementById('captchaOverlay').style.display = 'flex';

            setTimeout(() => {
                const captchaResponse = grecaptcha.getResponse();

                if (captchaResponse.length === 0) {
                    alert("Please complete the CAPTCHA.");
                } else {
                    document.getElementById('loginForm').submit();
                }
            }, 5000);
        });
    </script>
@endpush
