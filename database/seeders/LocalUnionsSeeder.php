<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalUnionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('local_unions')->insert([
            [ 'name' => 'TF LU 1'],
            [ 'name' => 'TF LU 2'],
            [ 'name' => 'SF LU 1'],
            [ 'name' => 'SF LU 2'],
        ]);
    }
}
