<?php

return [
/*
 |--------------------------------------------------------------------------
| Admin settings
|--------------------------------------------------------------------------
|
| This option determines the path to save the admin general settings cache and translation file. 
|
*/
'setting_cache_file_path' => storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'sitesettings.json',
'translation_cache_file_path' => base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'locale',
'insurance_related_cache_file_path' => storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'insurancerelated.json'
];