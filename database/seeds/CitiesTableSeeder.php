<?php

use Illuminate\Database\Seeder;
use Apptha\Models\City;
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('cities')->delete();
      DB::unprepared("ALTER TABLE cities AUTO_INCREMENT = 1;");
      $cities = [
	   1 => [
	   'name'=>'Chennai',
	   'is_active'=>1,
	   'creator_id' => 1,
	   'updator_id' => 1
      ],
      2 => [
          'name'=>'Trichy',
          'is_active'=>1,
          'creator_id' => 1,
          'updator_id' => 1
        ]
      ];
     
      foreach ( $cities as $key => $value ) {
        City::create ( [
        'id' => $key,
        'name' => $value ['name'],
        'is_active' => $value ['is_active'],
        'creator_id' => $value ['creator_id'],
        'updator_id' => $value ['updator_id'],
        ] );
      }
    }
}
