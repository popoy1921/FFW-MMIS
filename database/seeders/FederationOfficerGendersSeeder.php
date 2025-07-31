<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FederationOfficerGendersSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_federation_officer_genders')->insert([
            [
                'id'          => 1,
                'description' => 'Female',
            ],
            [
                'id'          => 2,
                'description' => 'Male',
            ],
            [
                'id'          => 3,
                'description' => 'Other',
            ],
        ]);
    }
}
