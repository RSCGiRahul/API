<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserVideoStatus;
use Faker\Generator as Faker;

$factory->define(UserVideoStatus::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'video_id' =>  $faker->randomElement([1,2]),
        'action' =>  $faker->randomElement([1,2]),
    ];
});
