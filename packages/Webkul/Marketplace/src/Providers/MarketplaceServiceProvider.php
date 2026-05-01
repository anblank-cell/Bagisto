<?php

namespace Webkul\Marketplace\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Webkul\Marketplace\Http\Middleware\AuthenticateSeller;

class MarketplaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/acl.php', 'acl');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/system.php', 'core');
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/customer-menu.php', 'menu.customer');
    }

    public function boot(Router $router): void
    {
        $router->aliasMiddleware('marketplace.seller', AuthenticateSeller::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/admin-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/seller-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/shop-routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'marketplace');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'marketplace');

        $this->app->register(ModuleServiceProvider::class);
    }
}
