<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'weekday' => $faker->dayOfWeek,
        'hour' => $faker->numberBetween(8, 20)
    ];
});
