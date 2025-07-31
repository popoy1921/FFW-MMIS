<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FederationOfficerPositionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_federation_officer_positions')->insert([
            [
                'id'          => 1,
                'description' => 'President',
            ],
            [
                'id'          => 2,
                'description' => 'Vice President',
            ],
            [
                'id'          => 3,
                'description' => 'Secretary',
            ],
            [
                'id'          => 4,
                'description' => 'Treasurer',
            ],
            [
                'id'          => 5,
                'description' => 'Auditor',
            ],
            [
                'id'          => 6,
                'description' => 'PRO',
            ],
            [
                'id'          => 7,
                'description' => 'Board Member',
            ],
        ]);
    }
}
