<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\City;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Category;
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
        view()->composer('dashboard.*', function ($view) {
            $cacheKeys = [
                'categories_count' => Category::class,
                'brands_count' => Brand::class,
                'admins_count' => Admin::class,
                'countries_count' => Country::class,
                'governorates_count' => Governorate::class,
                'cities_count' => City::class,
                'coupons_count' => Coupon::class,
                'faqs_count' => Faq::class,
            ];

            $cachedData = [];

            foreach ($cacheKeys as $key => $model) {
                $cachedData[$key] = Cache::remember($key, now()->addMinutes(60), function () use ($model) {
                    return $model::count();
                });
            }

            view()->share($cachedData);
        });

        $setting = self::firstOrCreateSetting();
        view()->share([
            'setting' => $setting,
        ]);
    }


    public function firstOrCreateSetting()
    {
        return Setting::firstOrCreate([], [
            'site_name' => [
                'ar' => 'المتجر الإلكتروني',
                'en' => 'E-Commerce',
            ],
            'site_desc' => [
                'ar' => 'متجر إلكتروني متكامل ومتوفر',
                'en' => 'Complete and available e-commerce store',
            ],
            'site_address' => [
                'ar' => 'مصر, الاسكندرية',
                'en' => 'Alexandria, Egypt',
            ],
            'site_phone' => '555-5555-5555',
            'site_email' => 'info@ecommerce.com',
            'favicon' => 'favicon.ico',
            'site_email_support' => 'email-support@ecommerce.com',
            'site_facebook_url' => 'https://www.facebook.com/ecommerce',
            'site_twitter_url' => 'https://www.twitter.com/ecommerce',
            'site_instagram_url' => 'https://www.instagram.com/ecommerce',
            'site_whatsapp_url' => 'https://www.whatsapp.com/ecommerce',
            'logo' => 'logo.png',
            'site_copyright' => 'copyright',
            'site_meta_description' => [
                'ar' => 'متجر إلكتروني متكامل ومتوفر',
                'en' => 'Complete and available e-commerce store',
            ],
            'site_promotion_video_url' => 'https://www.youtube.com/watch?v=WbDh1Ot7Dhg'
        ]);
    }
}