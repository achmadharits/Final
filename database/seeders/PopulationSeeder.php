<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Population;

class PopulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/population.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Population::create([
                    // "id" => $data['0'],
                    "city_id" => $data[0],
                    "year" => $data[1],
                    "total" => $data[2]
                    
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
