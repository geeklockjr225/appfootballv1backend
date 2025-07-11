<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BladeUI\Icons\Factory as IconFactory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(IconFactory $icons): void
    {

        $icons->add('lucide', [
            'path' => resource_path('icons/lucide'),
            'prefix' => 'lucide',
        ]);
        //
    }
}
