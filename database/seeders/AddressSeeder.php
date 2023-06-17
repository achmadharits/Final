<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/address.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Address::create([
                    // "id" => $data['0'],
                    "city_id" => $data[0],
                    "facility_id" => $data[1],
                    "address" => $data[2]
                    
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
