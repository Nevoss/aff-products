<?php

namespace App\Providers;

use App\Models\Vendor;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;
use App\VendorsIntegration\VendorsIntegrationInterface;
use App\VendorsIntegration\Exceptions\VendorNotFoundException;

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
            
            $vendorRecord = Vendor::findOrFail(
                request()->route()->parameter('vendor')
            );

            $keys = $this->getVendorConfigKeys($vendorRecord->key);

            return new $vendorRecord->class_path(
                $keys, new HttpClient
            );
        });
    }

    /**
     * get the config keys of the vendor
     *
     * @param  integer $vendorKey
     * @return array
     */
    protected function getVendorConfigKeys($vendorKey)
    {
        if (!$keys = config("vendors-integrations.{$vendorKey}")) {
            throw new VendorNotFoundException("the vendor key '{$vendorKey}' doesn't have config keys");
        }

        return $keys;
    }
}
