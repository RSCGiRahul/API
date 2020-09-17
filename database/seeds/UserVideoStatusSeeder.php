<?php

use Illuminate\Database\Seeder;

class UserVideoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UserVideoStatus::class, 2)->create();
    }
}
