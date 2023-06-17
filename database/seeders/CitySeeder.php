<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\City;
  
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        $csvFile = fopen(base_path("database/city.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                City::create([
                    // "id" => $data['0'],
                    "name" => $data[0]
                    
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}