<?php

namespace App\Providers;

use App\Models\Vendor;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;
use App\VendorsIntegration\VendorsIntegrationInterface;

class VendorsIntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VendorsIntegrationInterface::class, function ($app) {

            $vendorRecord = Vendor::active()->where(
                'id', request()->route()->parameter('vendor')
            )->firstOrFail();

            return new $vendorRecord->class_path(
                $vendorRecord->key, new HttpClient
            );
        });
    }
}
