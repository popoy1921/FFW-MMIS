<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_user_roles')->insert([
            [
                'id'          => 1,
                'description' => 'Super Admin',
            ],
            [
                'id'          => 2,
                'description' => 'Admin',
            ],
            [
                'id'          => 3,
                'description' => 'Trade Federation',
            ],
            [
                'id'          => 4,
                'description' => 'Local Union',
            ],
        ]);
    }
}
