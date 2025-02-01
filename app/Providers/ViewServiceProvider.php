<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Governorate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('dashboard.*', function($view){
            if(!Cache::has('categories_count')) {
                Cache::remember('categories_count', now()->addMinutes(60), function() {
                    return Category::count();
                });
            }

            if(!Cache::has('brands_count')) {
                Cache::remember('brands_count', now()->addMinutes(60), function() {
                    return Brand::count();
                });
            }

            if(!Cache::has('admins_count')) {
                Cache::remember('admins_count', now()->addMinutes(60), function() {
                    return Admin::count();
                });
            }
            if(!Cache::has('countries_count')) {
                Cache::remember('countries_count', now()->addMinutes(60), function() {
                    return Country::count();
                });
            }
            if(!Cache::has('governorates_count')) {
                Cache::remember('governorates_count', now()->addMinutes(60), function() {
                    return Governorate::count();
                });
            }

            if(!Cache::has('cities_count')) {
                Cache::remember('cities_count', now()->addMinutes(60), function() {
                    return City::count();
                });
            }
            if(!Cache::has('coupons_count')) {
                Cache::remember('coupons_count', now()->addMinutes(60), function() {
                    return Coupon::count();
                });
            }
            if(!Cache::has('faqs_count')) {
                Cache::remember('faqs_count', now()->addMinutes(60), function() {
                    return Faq::count();
                });
            }

            view()->share([
                'admins_count' => Cache::get('admins_count'),

                'categories_count' => Cache::get('categories_count'),
                'brands_count' => Cache::get('brands_count'),
                'countries_count' => Cache::get('countries_count'),
                'governorates_count' => Cache::get('governorates_count'),
                'cities_count' => Cache::get('cities_count'),
                'coupons_count' => Cache::get('coupons_count'),

                'faqs_count' => Cache::get('faqs_count'),
            ]);
        });
    }

}
