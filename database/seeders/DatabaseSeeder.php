<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Zone::create(['name' => 'General', 'price_per_hour' => 1.25]);
        \App\Models\Zone::create(['name' => 'VIP', 'price_per_hour' => 8]);
    }
}
