<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class priceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     */
    public function run()
    {
        DB::table('prices')->insert([
            'price' => '$$$$'
        ]);
        DB::table('prices')->insert([
            'price' => '$$$'
        ]);
        DB::table('prices')->insert([
            'price' => '$$'
        ]);
        DB::table('prices')->insert([
            'price' => '$'
        ]);
    }
}
