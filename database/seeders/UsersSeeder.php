<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'superadm.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Super Admin User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Super Admin User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 1,
                'federation_id'   => null,
                'local_union_id'        => null,
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'adm.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Admin User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Admin User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 2,
                'federation_id'   => null,
                'local_union_id'        => null,
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'federation1.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Federation User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 3,
                'federation_id'   => '1',
                'local_union_id'        => null,
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'federation2.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Federation User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 3,
                'federation_id'   => '2',
                'local_union_id'        => null,
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union1.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '1',
                'local_union_id'        => '1',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union2.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '1',
                'local_union_id'        => '2',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union3.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '2',
                'local_union_id'        => '3',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union4.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '2',
                'local_union_id'        => '4',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union5.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '1',
                'local_union_id'        => '1',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union6.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '1',
                'local_union_id'        => '2',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union7.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '2',
                'local_union_id'        => '3',
            ],
            [
                'guid'                  => (string) Str::uuid(),
                'email'                 => 'union8.user@mailinator.com',
                'password'              => Hash::make('S@mple123'),
                'fname'                 => 'Union User',
                'mname'                 => 'Sy',
                'lname'                 => 'Sy',
                'fullname'              => 'Federation User Sy Sy',
                'photo'                 => '1',
                'status_id'             => '1',
                'role_id'               => 4,
                'federation_id'         => '2',
                'local_union_id'        => '4',
            ],
        ]);
    }
}
