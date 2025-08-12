<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProvisionTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_provision_types')->insert([
            [
                'description' => 'Wage Increase',
            ],
            [
                'description' => 'Leave',
            ],
        ]);
    }
}
