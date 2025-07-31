<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FederationOfficersSeeder extends Seeder
{
    public function run()
    {
        DB::table('federation_officers')->insert([
            [
                'name'           => 'Mark Muncada',
                'guid'          => (string) Str::uuid(),
                'position_id'    => 1,
                'federation_id'  => 14,
                'local_union_id' => 1,
                'gender_id'      => 1,
                'age'            => 25,
                'newly_created' => 0,
            ],
            [
                'name'           => 'Joven Panajustan',
                'guid'          => (string) Str::uuid(),
                'position_id'    => 2,
                'federation_id'  => 14,
                'local_union_id' => 2,
                'gender_id'      => 2,
                'age'            => 25,
                'newly_created' => 0,
            ],
            [
                'name'           => 'Jinn Ravina',
                'guid'          => (string) Str::uuid(),
                'position_id'    => 3,
                'federation_id'  => 14,
                'local_union_id' => 2,
                'gender_id'      => 3,
                'age'            => 24,
                'newly_created' => 0,
            ],
            [
                'name'           => 'Jush Carl',
                'guid'          => (string) Str::uuid(),
                'position_id'    => 1,
                'federation_id'  => 2,
                'local_union_id' => 3,
                'gender_id'      => 3,
                'age'            => 31,
                'newly_created' => 0,
            ],
        ]);
    }
}
