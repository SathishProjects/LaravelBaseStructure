<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $this->call(UserRolesTableSeeder::class);
        $this->call(AdminGroupTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminUserGroupTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(SettingsCategoryTableSeeder::class);
        $this->call(LocalizationSettingsTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(SMSTemplatesTableSeeder::class);
    }
}
