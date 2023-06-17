<?php

namespace Database\Seeders;

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
        $this->call([
            CitySeeder::class, 
            FacilitySeeder::class,
            WorkerSeeder::class,
            AddressSeeder::class,
            PopulationSeeder::class,
            CityFacilitySeeder::class,
            FacilityWorkerSeeder::class
            
        ]);
    }
}
