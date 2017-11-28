<?php

use Illuminate\Database\Seeder;
use Apptha\Models\AdminUser;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admin_users')->delete();
      DB::unprepared("ALTER TABLE admin_users AUTO_INCREMENT = 1;");
      $adminUsers = [
        '1' => [
        'name' => 'Moverbee',
        'email' => 'apptha@contus.in',
        'password' =>  Hash::make ("admin123"),
        'gender'=> 'female',
        'mobile_number'=>9791005608,
        'access_token'=>bcrypt('12334'),
        'user_role_id'=>1,
        'is_verified'=>1,
        'is_active'=>1,
        'creator_id'=>'1',
        'updator_id'=>'1'
        ],
        '2' => [
        'name' => 'Raju',
        'email' => 'raju@contus.in',
        'password' =>  Hash::make ("admin123"),
        'gender'=> 'male',
        'mobile_number'=>9791005607,
        'access_token'=>bcrypt('12334'),
        'user_role_id'=>1,
        'is_verified'=>1,
        'is_active'=>0,
        'creator_id'=>'1',
        'updator_id'=>'1'
        ],
        '3' => [
        'name' => 'Hema',
        'email' => 'durgadevi@contus.in',
        'password' =>  Hash::make ("admin123"),
        'gender'=> 'female',
        'mobile_number'=>9791005606,
        'access_token'=>bcrypt('12334'),
        'user_role_id'=>1,
        'is_verified'=>0,
        'is_active'=>1,
        'creator_id'=>'1',
        'updator_id'=>'1'
            ]
      ];
      foreach ( $adminUsers as $key => $value ) {
        AdminUser::create ( [
        'id' => $key,
        'name' => $value ['name'],
        'email' => $value ['email'],
        'password' => $value ['password'],
        'gender'=> $value ['gender'],
        'mobile_number'=>$value ['mobile_number'],
        'access_token'=>$value ['access_token'],
        'user_role_id'=>$value ['user_role_id'],
        'is_verified'=>$value ['is_verified'],
        'is_active' => $value ['is_active'],
        'creator_id' => $value ['creator_id'],
        'updator_id' => $value ['updator_id'],
        ] );
      }
    }
}
