<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_user_statuses')->insert([
            [
                'id'          => 0,
                'description' => 'Inactive',
            ],
            [
                'id'          => 1,
                'description' => 'Active',
            ],
        ]);
    }
}
