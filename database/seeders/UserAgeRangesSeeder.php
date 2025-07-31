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
            [ 'description' => '15-29 years old', 'min' => 15, 'max' => 29],
            [ 'description' => '30-40 years old', 'min' => 30, 'max' => 40],
            [ 'description' => '41-50 years old', 'min' => 41, 'max' => 50],
            [ 'description' => '51-64 years old', 'min' => 51, 'max' => 64],
        ]);
    }
}
