<?php

namespace Webkul\DynamicTheme\Providers;

use Illuminate\Support\ServiceProvider;

class DynamicThemeServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('themes/dynamic-theme/views'),
        ], 'dynamic-theme-views');
    }
}
