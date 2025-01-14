<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAgeRangesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_user_age_ranges')->insert([
            [ 'description' => '15-29 years old'],
            [ 'description' => '30-40 years old'],
            [ 'description' => '41-50 years old'],
            [ 'description' => '51-64 years old'],
        ]);
    }
}
