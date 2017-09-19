<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\VendorsIntegration\VendorsIntegrationManager;

class VendorsIntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VendorsIntegrationManager::class, function ($app) {
            return new VendorsIntegrationManager(request()->route()->parameter('vendorId'));
        });
    }
}
