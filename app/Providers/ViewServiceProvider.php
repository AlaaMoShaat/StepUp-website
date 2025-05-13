<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\Store;
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
                'admins_count' => Admin::class,
                'stores_count' => Store::class,
            ];

            $cachedData = [];

            foreach ($cacheKeys as $key => $model) {
                $cachedData[$key] = Cache::remember($key, now()->addMinutes(30), function () use ($model) {
                    return $model == 'contacts_count'? $model::where('is_read', 0)->count() : $model::count();
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
                'ar' => 'StepUp',
                'en' => 'StepUp',
            ],
            'site_desc' => [
                'ar' => 'متجر إلكتروني متكامل ومتوفر',
                'en' => 'Complete and available StepUp store',
            ],
            'site_address' => [
                'ar' => 'مصر, القاهرة',
                'en' => 'Cairo, Egypt',
            ],
            'site_phone' => '555-5555-5555',
            'site_email' => 'info@stepup.com',
            'favicon' => 'mainLogo.png',
            'site_email_support' => 'email-support@stepup.com',
            'site_facebook_url' => 'https://www.facebook.com/stepup',
            'site_twitter_url' => 'https://www.twitter.com/stepup',
            'site_instagram_url' => 'https://www.instagram.com/stepup',
            'site_whatsapp_url' => 'https://www.whatsapp.com/stepup',
            'logo' => 'mainLogo.png',
            'site_copyright' => 'copyright',
            'site_meta_description' => [
                'ar' => 'متجر إلكتروني متكامل ومتوفر',
                'en' => 'Complete and available e-commerce store',
            ],
            'site_promotion_video_url' => 'https://www.youtube.com/watch?v=WbDh1Ot7Dhg'
        ]);
    }
}