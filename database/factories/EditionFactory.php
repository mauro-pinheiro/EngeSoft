<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Edition;
use App\Theme;
use App\User;
use Faker\Generator as Faker;

$factory->define(Edition::class, function (Faker $faker) {
    return [
        'volume' => $faker->randomDigit,
        'number' => $faker->randomNumber(),
        'month' => $faker->month,
        'year' => $faker->year,
        'theme_id' => factory(Theme::class)->create()->id,
        'user_id' => factory(User::class)->create()->id
    ];
});
