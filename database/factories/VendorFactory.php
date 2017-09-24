<?php

use Faker\Generator as Faker;
use App\Models\Vendor;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->word,
        'key' => $name,
        'class_path' => $faker->word,
    ];
});
