<?php

use Illuminate\Database\Seeder;
use Apptha\Models\AdminUserGroup;

class AdminUserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admin_user_groups')->delete();
      DB::unprepared("ALTER TABLE admin_user_groups AUTO_INCREMENT = 1;");
      AdminUserGroup::create(
          [
              'user_id'=>1,
              'group_id'=>1          
          ]);
    }
}
