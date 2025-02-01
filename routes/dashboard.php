<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\WorldController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Region\CityController;
use App\Http\Controllers\Dashboard\AuthorizationController;
use App\Http\Controllers\Dashboard\Region\CountryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Region\GovernorateController;
use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\SettingController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        ################################ Auth Routes #################################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        ################################ End Auth Routes #################################


          ################################ Forget Password Routes #################################
          Route::prefix('password')->as('password.')->group(function () {
            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendCode')->name('sendCode');
                Route::get('verify/{email}', 'showCodeForm')->name('showCodeForm');
                Route::post('verify', 'verifyCode')->name('verifyCode');
            });
            ################################ End Forget Password Routes ############################

            ################################ Reset Password Routes #################################
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}', 'showResetForm')->name('showResetForm');
                Route::post('reset', 'resetPassword')->name('reset');
            });
            ################################ End Reset Password Routes #############################
        });

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


            ################################ Shipping & Region Routes #################################
            Route::group(['middleware'=>'can:region'], function () {
                Route::group([],function () {
                    Route::resource('countries', CountryController::class);
                    Route::get('countries/{id}/status', [CountryController::class, 'changeStatus'])->name('countries.changeStatus');
                });

                Route::group([],function () {
                    Route::resource('governorates', GovernorateController::class);
                    Route::get('governorates/{id}/status', [GovernorateController::class, 'changeStatus'])->name('governorates.changeStatus');
                    Route::put('governorates/{id}/shipping-price', [GovernorateController::class, 'changeShippingPrice'])->name('governorates.shipping.price');

                });

                Route::group([],function () {
                    Route::resource('cities', CityController::class);
                    Route::get('cities/{id}/status', [CityController::class, 'changeStatus'])->name('cities.changeStatus');
                });
            });
            ################################ End Shipping & Region Routes #################################

            ################################ Category Routes #################################
            Route::group(['middleware'=>'can:categories'], function() {
                Route::resource('categories', CategoryController::class)->except('show');
                Route::get('categories-all', [CategoryController::class, 'getAllCategories'])->name('categories.all');
                Route::get('categories/{id}/status', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');
            });
            ################################ End Category Routes #################################

             ################################ Brand Routes #################################
             Route::group(['middleware'=>'can:brands'], function() {
                Route::resource('brands', BrandController::class)->except('show');
                Route::get('brands-all', [BrandController::class, 'getAllBrands'])->name('brands.all');
                Route::get('brands/{id}/status', [BrandController::class, 'changeStatus'])->name('brands.changeStatus');
            });
            ################################ End Brand Routes #################################


             ################################ Coupon Routes #################################
             Route::group(['middleware'=>'can:coupons'], function() {
                Route::resource('coupons', CouponController::class)->except('show');
                Route::get('coupons-all', [CouponController::class, 'getAllCoupons'])->name('coupons.all');
                Route::get('coupons/{id}/status', [CouponController::class, 'changeStatus'])->name('coupons.changeStatus');
            });
            ################################ End Coupon Routes #################################

            ################################ Fqas Routes #################################
             Route::group(['middleware'=>'can:faqs'], function() {
                Route::resource('faqs', FaqController::class)->except('show');
                Route::get('faqs-all', [FaqController::class, 'getAllFaqs'])->name('faqs.all');
                Route::get('faqs/{id}/status', [FaqController::class, 'changeStatus'])->name('faqs.changeStatus');
            });
            ################################ End Fqas Routes #################################

            ################################ Setting Routes #################################
            Route::group(['middleware'=>'can:settings', 'as' => 'settings.'],  function() {
                Route::get('settings', [SettingController::class, 'index'])->name('index');
                Route::put('settings/{id}', [SettingController::class, 'update'])->name('update');
            });
            ################################ End Setting Routes #################################
        });


    }
);