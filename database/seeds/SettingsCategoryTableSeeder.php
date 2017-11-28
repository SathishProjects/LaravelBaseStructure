<?php
use Illuminate\Database\Seeder;
use Apptha\Models\SettingCategory;
use Apptha\Models\Setting;
use Apptha\Models\City;
use Apptha\Repositories\SettingRepository;
class SettingsCategoryTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table ( 'settings' )->delete ();
    DB::table ( 'setting_categories' )->delete ();
    /**
     * Auto increment value set to 1
     */
    DB::unprepared ( "ALTER TABLE setting_categories AUTO_INCREMENT = 1;" );
    DB::unprepared ( "ALTER TABLE settings AUTO_INCREMENT = 1;" );
    
    $settingsCategories = [ 
        '1' => [ 
            'id' => 1,
            'name' => 'General Settings',
            'slug' => 'general_settings',
            'parent_id' => 0,
            'settings' => [ 
                [ 
                    'setting_name' => 'application_name',
                    'setting_value' => 'MoverBee',
                    'display_name' => 'Application Name',
                    'type' => 'text',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 1,
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'logo',
                    'setting_value' => 'logo.png',
                    'display_name' => 'Logo',
                    'type' => 'image',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 2,
                    'description'=>'Recommended logo resolution is 216px x 38px.',
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'fav',
                    'setting_value' => 'fav.png',
                    'display_name' => 'Fav Icon',
                    'type' => 'image',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 2,
                    'description'=>'Recommended favicon resolution is 40px x 40px.',
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'default_currency',
                    'setting_value' => 'INR',
                    'display_name' => 'Default Currency',
                    'type' => 'dropdown',
                    'option' => 'INR,SGT',
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
                [
                'setting_name' => 'default_currency_symbol',
                'setting_value' => '₹',
                'display_name' => 'Default Currency Symbol',
                'type' => 'dropdown',
                'option' => '₹,$',
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
                [ 
                    'setting_name' => 'default_timezone',
                    'setting_value' => '',
                    'display_name' => 'Default Timezone',
                    'type' => 'dropdown',
                    'option' => '(UTC+05:30) India,(GMT-11:00) Midway Island, Samoa,(GMT-10:00) Hawaii',
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'default_language',
                    'setting_value' => '',
                    'display_name' => 'Default Language',
                    'type' => 'dropdown',
                    'option' => 'English,Hindi',
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'support_number',
                    'setting_value' => '+91 9791005806',
                    'display_name' => 'Support Number',
                    'type' => 'text',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'support_email_id',
                    'setting_value' => 'example@gmail.com',
                    'display_name' => 'Support Email ID',
                    'type' => 'text',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
                [ 
                    'setting_name' => 'commision_percentage',
                    'setting_value' => '1',
                    'display_name' => 'Commision %',
                    'type' => 'text',
                    'option' => NULL,
                    'class' => NULL,
                    'order' => 2,
                    'setting_category_id' => 1 
                ],
            	[
            		'setting_name' => 'insurance_minimum_limit',
            		'setting_value' => '2000',
            		'display_name' => 'Insurance Minimum Limit Rs',
            		'type' => 'text',
            		'option' => NULL,
            		'class' => NULL,
            		'order' => 2,
            		'setting_category_id' => 1
            	],
                [
                'setting_name' => 'package_maximum_limit',
                'setting_value' => '100000',
                'display_name' => 'Package Maximum Limit Rs',
                'type' => 'text',
                'option' => NULL,
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
                [
                'setting_name' => 'package_maximum_weight_limit',
                'setting_value' => '8',
                'display_name' => 'Package Maximum Weight Limit (Kgs)',
                'type' => 'text',
                'option' => NULL,
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
                [
                'setting_name' => 'service_tax_settings',
                'setting_value' => '14',
                'display_name' => 'Service Tax',
                'type' => 'text',
                'option' => NULL,
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
                [
                'setting_name' => 'swachh_bharat_cess',
                'setting_value' => '0.5',
                'display_name' => 'Swachh Bharat Cess',
                'type' => 'text',
                'option' => NULL,
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
                [
                'setting_name' => 'krishi_kalyan_cess',
                'setting_value' => '0.5',
                'display_name' => 'Krishi Kalyan Cess',
                'type' => 'text',
                'option' => NULL,
                'class' => NULL,
                'order' => 2,
                'setting_category_id' => 1
                ],
            	[
            		'setting_name' => 'city_code',
            		'setting_value' => 'CHE',
            		'display_name' => 'City Code',
            		'type' => 'text',
            		'option' => NULL,
            		'class' => NULL,
            		'order' => 2,
            		'setting_category_id' => 1
            	],
            	[
            		'setting_name' => 'enterprise_customer_code',
            		'setting_value' => 'CP',
            		'display_name' => 'Enterprise Customer Code',
            		'type' => 'text',
            		'option' => NULL,
            		'class' => NULL,
            		'order' => 2,
            		'setting_category_id' => 1
            	],
            	[
            		'setting_name' => 'individual_customr_code',
            		'setting_value' => 'IN',
            		'display_name' => 'Individual Customer Code',
            		'type' => 'text',
            		'option' => NULL,
            		'class' => NULL,
            		'order' => 2,
            		'setting_category_id' => 1
            	],

                [
                  'setting_name' => 'disable_delete',
                  'setting_value' => 'No',
                  'display_name' => 'Disable Delete',
                  'type' => 'dropdown',
                  'option' => 'No,Yes',
                  'class' => NULL,
                  'order' => 2,
                  'setting_category_id' => 1
                ]

            ] 
        ],
    ]
    ;
    foreach ( $settingsCategories as $key => $value ) {
      $setting_category = $value;
      unset ( $setting_category ['settings'] );
      (new SettingCategory ())->fill ( $setting_category )->save ();
      if (isset ( $value ['settings'] ) && count ( $value ['settings'] ) > 0) {
        foreach ( $value ['settings'] as $setting ) {
          (new Setting ())->fill ( $setting )->save ();
        }
      }
    }
    (new SettingRepository ( new Setting (), new SettingCategory () ))->generateSettingsCache ();
        (new SettingRepository ( new Setting (), new SettingCategory () ))->generateValidationCache ();
    }
}
