<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalUnionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('local_unions')->insert([
            [ 
                'name'          => 'TF 1 LU 1',
                'federation_id' => 1,
            ],
            [ 
                'name'          => 'TF 1 LU 2',
                'federation_id' => 1,
            ],
            [ 
                'name'          => 'TF 2 LU 1',
                'federation_id' => 2,
            ],
            [ 
                'name'          => 'TF 2 LU 2',
                'federation_id' => 2,
            ],
            [ 
                'name'          => 'SF 1 LU 1',
                'federation_id' => 3,
            ],
            [ 
                'name'          => 'SF 1 LU 2',
                'federation_id' => 3,
            ],
            
            [ 
                'name'          => 'SF 2 LU 1',
                'federation_id' => 4,
            ],
            [ 
                'name'          => 'SF 2 LU 2',
                'federation_id' => 4,
            ],
        ]);
    }
}
