<?php

/** @var Factory $factory */

use App\Models\EstablishmentType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(EstablishmentType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
