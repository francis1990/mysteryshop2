<?php

/** @var Factory $factory */

use App\Models\Survey;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Survey::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});



