<?php
use Illuminate\Database\Seeder;
use Apptha\Models\AdminGroup;
class AdminGroupTableSeeder extends Seeder {
/**
 * Run the database seeds.
 *
 * @return void
 */
public function run() {
 DB::table ( 'admin_groups' )->delete ();
 DB::unprepared ( "ALTER TABLE admin_groups AUTO_INCREMENT = 1;" );
 AdminGroup::create ( [ 
  'name' => 'Super Admin',
  'is_active' => '1',
  'creator_id' => '1',
  'updator_id' => '1' 
 ] );
}
}
