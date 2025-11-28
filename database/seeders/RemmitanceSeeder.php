<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RemmitanceSeeder extends Seeder
{
    public function run()
    {
        DB::table('remmitance')->insert([
            [
                'local_union_id' => 1,
                'remmitance'     => 1000,
                'date_paid'      => now(),
                'for_the_month'  => '11-2025',
            ],
            [
                'local_union_id' => 1,
                'remmitance'     => 2000,
                'date_paid'      => now(),
                'for_the_month'  => '11-2025',
            ],
            [
                'local_union_id' => 1,
                'remmitance'     => 3000.5,
                'date_paid'      => now(),
                'for_the_month'  => '11-2025',
            ],
        ]);
    }
}
