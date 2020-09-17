<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Video::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'description' => $faker->company,
        'video' => $faker->imageUrl,
        'thum' => $faker->imageUrl,
        'gif' => $faker->imageUrl,
        'view' => 1,
    ];
});
