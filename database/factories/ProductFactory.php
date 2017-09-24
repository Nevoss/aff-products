<?php

use Faker\Generator as Faker;
use App\Models\Vendor;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'vendor_id' => Vendor::get()->random()->id,
        'title' => $faker->words(3, true),
        'description' => $faker->sentence,
        'price' => $faker->randomDigitNotNull,
        'image' => null,
        'link' => $faker->url,
    ];
});
