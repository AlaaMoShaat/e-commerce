<?php

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\AuthorizationController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        ################################ Auth #################################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        ################################ Protected Routes #################################
        Route::group(['middleware' => 'auth:admin'], function () {

            ################################ Home Routes #################################
            Route::get('home', [HomeController::class, 'index'])->name('home');

            ################################ Roles Routes #################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', AuthorizationController::class);
            });
            ################################ End Roles Routes #############################

            ################################ Admins Routes #################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins', AdminController::class);
                Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.changeStatus');
            });
            ################################ End Admins Routes #############################
        });

        ################################ Forget Password Routes #################################
        Route::prefix('password')->as('password.')->group(function () {
            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendCode')->name('sendCode');
                Route::get('verify/{email}', 'showCodeForm')->name('showCodeForm');
                Route::post('verify', 'verifyCode')->name('verifyCode');
            });
            ################################ Reset Password Routes #################################
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}', 'showResetForm')->name('showResetForm');
                Route::post('reset', 'resetPassword')->name('reset');
            });
        });
    }
);
