<?php

namespace Database\Seeders;

use App\Models\episode;
use App\Models\formation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        formation::factory(15)->create();
        episode::factory(150)->create();
    }
}
