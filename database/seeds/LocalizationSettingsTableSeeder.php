<?php
use Illuminate\Database\Seeder;
use Apptha\Models\LocalizationSetting;
class LocalizationSettingsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table ( 'localization_settings' )->delete ();
    /**
     * Auto increment value set to 1
     */
    DB::unprepared ( "ALTER TABLE localization_settings AUTO_INCREMENT = 1;" );
    
    $localizationSettings = [ 
        '1' => [ 
            'language' => 'Hindi',
            'time_zone' => 'UTC+05:30',
            'currency' => 'Rupees',
            'is_active' => 1 
        ],
        '2' => [ 
            'language' => 'Tamil',
            'time_zone' => 'UTC+05:30',
            'currency' => 'Rupees',
            'is_active' => 1 
        ] 
    ];
    foreach ( $localizationSettings as $key => $value ) {
      LocalizationSetting::create ( [
      'id' => $key,
      'language' => $value ['language'],
      'time_zone' => $value ['time_zone'],
      'currency' => $value ['currency'],
      'is_active' => $value ['is_active'],
      ] );
    }
    }
}
