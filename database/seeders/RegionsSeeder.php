<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_regions')->insert([
            [ 'description' => 'Region I: Ilocos' ],
            [ 'description' => 'Region II: Cagayan Valley' ],
            [ 'description' => 'Region III: Central Luzon' ],
            [ 'description' => 'NCR: National Capital Region' ],
            [ 'description' => 'Region IV-A: Calabarzon' ],
            [ 'description' => 'Region IV-B: MIMAROPA' ],
            [ 'description' => 'Region V: Bicol' ],
            [ 'description' => 'Region VI: Western Visayas' ],
            [ 'description' => 'Region VII: Central Visayas' ],
            [ 'description' => 'Region VIII: Eastern Visayas' ],
            [ 'description' => 'Region IX: Zamboanga Peninsula' ],
            [ 'description' => 'Region X: Northern Mindanao' ],
            [ 'description' => 'Region XI: Davao' ],
            [ 'description' => 'Region XII: SOCCSKSARGEN' ],
            [ 'description' => 'Region XIII: Caraga' ],
            [ 'description' => 'BARMM: Bangsamoro Autonomous Region in Muslim Mindanao' ],
        ]);
    }
}
