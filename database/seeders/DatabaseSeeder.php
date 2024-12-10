<?php

namespace Database\Seeders;
use App\Models\car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     *
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            priceSeeder::class
        ]);
            car::factory(20)->create();
    }
}
