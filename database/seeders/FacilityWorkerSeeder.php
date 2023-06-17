<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacilityWorker;

class FacilityWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/facilityworker.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                FacilityWorker::create([
                    // "id" => $data['0'],
                    "city_facility_id" => $data[0],
                    "worker_id" => $data[1],
                    "total" => $data[2],
                    "population" => $data[3],
                    "ratio" => $data[4],
                    "status" => $data[5],
                    "color" => $data[6]
                    
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
