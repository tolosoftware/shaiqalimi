<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(ProjectSeeder::class);

         \App\Models\User::factory(10)->create();
    }
}