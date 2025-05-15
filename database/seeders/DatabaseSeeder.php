<?php

namespace Database\Seeders;

use Database\Seeders\Dashboard\AdminSeeder;
use Database\Seeders\Dashboard\CitySeeder;
use Database\Seeders\Dashboard\DaySeeder;
use Database\Seeders\Dashboard\NeighborhoodSeeder;
use Database\Seeders\Dashboard\RoleSeeder;
use Database\Seeders\Dashboard\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            AdminSeeder::class,
            CitySeeder::class,
            NeighborhoodSeeder::class,
            DaySeeder::class,
        ]);
    }
}
