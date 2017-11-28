<?php

use Illuminate\Database\Seeder;
use Apptha\Models\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table ( 'states' )->delete ();
        /** Auto increment value set to 1 */
        DB::unprepared("ALTER TABLE states AUTO_INCREMENT = 1;");
        $states = [ 
            '1' => [
                    'country_id' => '1',
                    'name'       => 'Tamilnadu',
                    'is_active'       => '1',
                    'creator_id'       => '1',
                    'updator_id'       => '1',
            ],
            '2' => [ 
                    'country_id' => '1',
                    'name'       => 'Delhi',
                    'is_active'       => '1',
                    'creator_id'       => '1',
                    'updator_id'       => '1',
            ]
        ];
        foreach ( $states as $key => $value ) {
            State::create ( [ 
                    'id' => $key,
                    'name' => $value ['name'],
                    'country_id' => $value ['country_id'],
                    'is_active' => $value ['is_active'],
                    'creator_id' => $value ['creator_id'],
                    'updator_id' => $value ['updator_id'],
            ] );
        }
        
    }
}
