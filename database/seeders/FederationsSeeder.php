<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FederationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('federations')->insert([
            [ 'name' => 'Trade Federation 1'],
            [ 'name' => 'Sectoral Federation 1'],          
        ]);
    }
}
