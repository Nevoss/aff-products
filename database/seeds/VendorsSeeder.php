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
        ]);

        Vendor::create([
            'name' => 'AliExpress',
        ]);

        Vendor::create([
            'name' => 'Amazon',
        ]);
    }
}
