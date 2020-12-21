<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    $attachmentables = [App\Post::class, App\Comment::class];
    $attachmentableType = $faker->randomElement($attachmentables);
    if ($attachmentableType == App\Post::class) {
        $attachmentableId = App\Post::inRandomOrder()->first()->id;
    } else {
        $attachmentableId = App\Comment::inRandomOrder()->first()->id;
    }
    return [
        'attachmentable_type' => $attachmentableType,
        'attachmentable_id' => $attachmentableId,
    ];
});