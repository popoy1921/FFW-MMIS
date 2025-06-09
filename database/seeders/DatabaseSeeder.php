<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FederationCategoriesSeeder::class);
        $this->call(FederationsSeeder::class);
        $this->call(FederationStatusesSeeder::class);
        $this->call(IndustriesSeeder::class);
        $this->call(LocalUnionsSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(UserAgeRangesSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UserStatusesSeeder::class);
    }
}
