<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use Faker\Generator as Faker;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'url' => Str::random(40),
        'email' => $faker->unique()->safeEmail,
    ];
});
