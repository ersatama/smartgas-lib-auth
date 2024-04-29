<?php

namespace Ruslan_sgs\SmartgasLibAuth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
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
            __DIR__ . '/../../config/smartgas.php' => config_path('smartgas.php')
        ], 'smartgas-config');
        $this->publishes([
            __DIR__ . '/../Http/Controllers/AuthController.php' => app_path('Http/Controllers/Api/Auth/AuthController.php'),
        ], 'smartgas-controller');
    }
}