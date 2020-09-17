<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Music;
use Faker\Generator as Faker;

$factory->define(Music::class, function (Faker $faker) {
    // dd(factory(App\Models\Section::class)->create()->id);
    // dd($faker->sentences([0]));
    return [
        'name' => $faker->word,
        'description' =>$faker->sentences[0],
        'thumb' => $faker->imageUrl,
        'section_id' => factory(App\Models\Section::class)->create()->id,
    ];
});
