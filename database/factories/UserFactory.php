<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $device = ['mobile', 'ios'];
    $deviceKey = array_rand($device);

    
    $signup_type = ['fb', 'mobile'];
    $signup_typeKey = array_rand($signup_type);
    // dd($faker->gender);
    return [
        'first_name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),

        'fb_id' => $faker->uuid,
        'profile_pic' => $faker->imageUrl,
        'version' => 1.0,
        'last_name' => $faker->lastName,
        'bio' =>$faker->sentences[0],
        'gender' => 'Male',
        'device' => $device[$deviceKey],
        'signup_type' => $signup_type[$signup_typeKey],
        'username' => $faker->userName,
        // "action" => "login",
    ];
});
