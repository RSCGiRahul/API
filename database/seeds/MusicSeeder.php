<?php

use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Music::class, 2)->create();
    }
}
