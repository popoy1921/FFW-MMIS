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
            [ 
                'region_description'       => 'Region I: Ilocos',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region II: Cagayan Valley',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region III: Central Luzon',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'NCR: National Capital Region',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region IV-A: Calabarzon',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region IV-B: MIMAROPA',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region V: Bicol',
                'island_group_id'   => 1,
            ],
            [ 
                'region_description'       => 'Region VI: Western Visayas',
                'island_group_id'   => 2,
            ],
            [ 
                'region_description'       => 'Region VII: Central Visayas',
                'island_group_id'   => 2,
            ],
            [ 
                'region_description'       => 'Region VIII: Eastern Visayas',
                'island_group_id'   => 2,
            ],
            [ 
                'region_description'       => 'Region IX: Zamboanga Peninsula',
                'island_group_id'   => 3,
            ],
            [ 
                'region_description'       => 'Region X: Northern Mindanao',
                'island_group_id'   => 3,
            ],
            [ 
                'region_description'       => 'Region XI: Davao',
                'island_group_id'   => 3,
            ],
            [ 
                'region_description'       => 'Region XII: SOCCSKSARGEN',
                'island_group_id'   => 3,
            ],
            [ 
                'region_description'       => 'Region XIII: Caraga',
                'island_group_id'   => 3,
            ],
            [ 
                'region_description'       => 'BARMM: Bangsamoro Autonomous Region in Muslim Mindanao',
                'island_group_id'   => 3,
            ],
        ]);
    }
}
