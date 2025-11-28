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
        $this->call(FederationOfficerGendersSeeder::class);
        $this->call(FederationOfficerPositionsSeeder::class);
        $this->call(FederationOfficersSeeder::class);     
        $this->call(FederationsSeeder::class);
        $this->call(FederationStatusesSeeder::class);
        $this->call(IndustriesSeeder::class);
        $this->call(IslandGroupsSeeder::class);
        $this->call(LocalUnionsSeeder::class);
        $this->call(ProvisionTypesSeeder::class);
        $this->call(ProvisionsSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(RemmitanceSeeder::class);
        $this->call(UserAgeRangesSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UserStatusesSeeder::class);
    }
}
