<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('lu_industries')->insert([
            [ 'description' => 'Accommodation and Food Service Activities'],
            [ 'description' => 'Administrative Support Services Activities'],
            [ 'description' => 'Agriculture, Forestry and Fishing'],
            [ 'description' => 'Arts, Entertainment and Recreation'],
            [ 'description' => 'Construction'],
            [ 'description' => 'Education except Public Education'],
            [ 'description' => 'Electricity, Gas, Steam and Air Conditioning Supply'],
            [ 'description' => 'Financial and Insurance Activities'],
            [ 'description' => 'Human Health and Social Work Activities except Public Health'],
            [ 'description' => 'Information and Communication'],
            [ 'description' => 'Manufacturing'],
            [ 'description' => 'Mining and Quarrying'],
            [ 'description' => 'Professional, Scientific and Technical Activities'],
            [ 'description' => 'Real Estate Activities'],
            [ 'description' => 'Transportation and Storage'],
            [ 'description' => 'Water Supply, Sewerage, Waste Management, and Remediation Activities'],
            [ 'description' => 'Wholesale and Retail Trade'],
            [ 'description' => 'Other Service Activities except Activities of Membership Organizations'],
            [ 'description' => 'Others'],
        ]);
    }
}
