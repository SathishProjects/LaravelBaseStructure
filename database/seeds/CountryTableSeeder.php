<?php

use Illuminate\Database\Seeder;
use Apptha\Models\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::unprepared("ALTER TABLE countries AUTO_INCREMENT = 1;");
      
      $countries = [
        '1' => [
          'name' => 'India',
          'is_active' => '1',
          'creator_id' => 1,
          'updator_id' => 1,
        ],
        '2' => [
          'name' => 'Kenya',
          'is_active' => '1',
          'creator_id' => 1,
          'updator_id' => 1,
        ]
      ];
      foreach ( $countries as $key => $value ) {
        Country::create ( [
         'id' => $key,
         'name' => $value ['name'],
         'is_active' => $value ['is_active'],
         'creator_id' => $value ['creator_id'],
         'updator_id' => $value ['updator_id'],
        ] );
      }
    
    }
}
