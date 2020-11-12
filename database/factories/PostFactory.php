<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6),
        'body' => $faker->realText(),
        'user_id'=> App\Role::whereIn('id', [1, 2])->first()->users()->inRandomOrder()->first()->id,
    ];
});
