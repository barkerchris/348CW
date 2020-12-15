<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProfilePicture;
use Faker\Generator as Faker;

$factory->define(ProfilePicture::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence($nbWords = 6),
        'user_id' => App\User::inRandomOrder()->first()->unique()->id,
    ];
});
