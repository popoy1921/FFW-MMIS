<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IslandGroupsSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_island_groups')->insert([
            [ 'island_description' => 'Luzon' ],
            [ 'island_description' => 'Visayas' ],
            [ 'island_description' => 'Mindanao' ],
        ]);
    }
}
