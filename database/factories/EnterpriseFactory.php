<?php

/** @var Factory $factory */

use App\Models\Enterprise;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Enterprise::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
    ];
});
