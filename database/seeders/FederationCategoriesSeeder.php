<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FederationCategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_federation_categories')->insert([
            [ 'description' => 'Trade Federation'],
            [ 'description' => 'Sectoral Federation'],
        ]);
    }
}
