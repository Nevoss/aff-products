<?php

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * create the main Vendors of the app
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'name' => 'eBay',
            'key' => 'ebay',
            'class_path' => 'App\VendorsIntegration\EbayIntegration'
        ]);

        Vendor::create([
            'name' => 'AliExpress',
            'key' => 'aliexpress',
        ]);

        Vendor::create([
            'name' => 'Amazon',
            'key' => 'amazon',
        ]);
    }
}
