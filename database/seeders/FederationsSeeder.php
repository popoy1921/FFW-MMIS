<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FederationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('federations')->insert([
            [
                'name'          => 'Trade Federation 1: Food, Beverages, and Agriculture',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [
                'name'          => 'Trade Federation 2: Garments, Textile, Rubber',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Trade Federation 3: Pharmaceuticals, Chemicals',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Trade Federation 4: Metal, Electronics, Electrical and Allied Industries',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 0,
                'newly_created' => 0,
            ],  
            [ 
                'name'          => 'Trade Federation 5: Wood, Pulp, Paper, Building & Construction',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Trade Federation 6: Commercial Industries ',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Trade Federation 7: Telecommunications, Logistics',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Trade Federation 8: Education and Health Services',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 1,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'FFW Women’s Network',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Young Free Workers',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Farmers',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Fisherfolks',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Vendors',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Cooperatives',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Transport',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Indigenous Peoples',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Migrant Workers',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
            [ 
                'name'          => 'Others',
                'guid'          => (string) Str::uuid(),
                'category_id'   => 2,
                'status_id'     => 1,
                'newly_created' => 0,
            ],
        ]);
    }
}
