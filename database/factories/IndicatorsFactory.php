<?php

/** @var Factory $factory */

use App\Models\Indicator;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Indicator::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
    ];
});



