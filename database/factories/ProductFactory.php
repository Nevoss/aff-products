<?php

use Faker\Generator as Faker;
use App\Models\Vendor;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'vendor_id' => Vendor::get()->random()->id,
        'title' => $faker->words(3, true),
        'description' => $faker->sentence,
        'price' => $faker->randomDigitNotNull,
        'image' => 'http://via.placeholder.com/300x225',
        'link' => $faker->url,
    ];
});
