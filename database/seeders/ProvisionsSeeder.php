<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProvisionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('provisions')->insert([
            [
                'local_union_id' =>     1,
                'provision_type_id' =>  1,
                'description' =>        'This is a sample 1',
            ],
            [
                'local_union_id' =>     1,
                'provision_type_id' =>  1,
                'description' =>        'This is a sample 2',
            ],
            [
                'local_union_id' =>     1,
                'provision_type_id' =>  1,
                'description' =>        'This is a sample 3',
            ],
            [
                'local_union_id' =>     1,
                'provision_type_id' =>  2,
                'description' =>        'This is a sample 4',
            ],
            [
                'local_union_id' =>     2,
                'provision_type_id' =>  2,
                'description' =>        'This is a sample 5',
            ],
            [
                'local_union_id' =>     9,
                'provision_type_id' =>  2,
                'description' =>        'This is a sample 6',
            ],
        ]);
    }
}
