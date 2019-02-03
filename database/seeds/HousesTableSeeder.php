<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HousesTableSeeder extends Seeder
{
    private $delimetr = ';';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $fdata = 'property-data.csv';
      if ( file_exists($fdata))
          $h = file_get_contents($fdata);
      else exit('Не найден файл' . realpath (__FILE__));
      $file = fopen('php://memory', 'w+');
      fwrite($file, $h);
      rewind($file);
      $dt = fgetcsv($file,1000,$this->delimetr); // first line as table header
      while(($dt = fgetcsv($file,1000,$this->delimetr)) !== FALSE) {
      DB::table('houses')->insert([
       'name' => $dt[0],
       'price' =>floatval($dt[1]),
       'bedrooms' =>(int) $dt[2],
       'bathrooms' => (int) $dt[3],
       'storeys' =>(int) $dt[4],
       'garages' => (int) $dt[5],
        'created_at' => Carbon::now(),
      ]);

      }
    }
}
