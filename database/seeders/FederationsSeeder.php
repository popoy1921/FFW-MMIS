<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FederationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('federations')->insert([
            [
                'name'          => 'Trade Federation 1: Food, Beverages, and Agriculture',
                'category_id'   => 1,
                'region_id'     => 1,
                'status_id'     => 1,
            ],
            [
                'name'          => 'Trade Federation 2: Garments, Textile, Rubber',
                'category_id'   => 1,
                'region_id'     => 2,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Trade Federation 3: Pharmaceuticals, Chemicals',
                'category_id'   => 1,
                'region_id'     => 3,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Trade Federation 4: Metal, Electronics, Electrical and Allied Industries',
                'category_id'   => 1,
                'region_id'     => 5,
                'status_id'     => 0,
            ],  
            [ 
                'name'          => 'Trade Federation 5: Wood, Pulp, Paper, Building & Construction',
                'category_id'   => 1,
                'region_id'     => 5,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Trade Federation 6: Commercial Industries ',
                'category_id'   => 1,
                'region_id'     => 5,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Trade Federation 7: Telecommunications, Logistics',
                'category_id'   => 1,
                'region_id'     => 5,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Trade Federation 8: Education and Health Services',
                'category_id'   => 1,
                'region_id'     => 5,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'FFW Women’s Network',
                'category_id'   => 2,
                'region_id'     => 5,
                'status_id'     => 1,
            ],
            [ 
                'name'          => 'Young Free Workers',
                'category_id'   => 2,
                'region_id'     => 8,
                'status_id'     => 1,
            ],
        ]);
    }
}
