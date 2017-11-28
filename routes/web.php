<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function(){
  return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
 Route::get('settings', 'SettingsController@listSettingCategories');
 Route::get('changepassword','PasswordController@getchangePassword');
 Route::post('changepassword','PasswordController@changePassword');
 Route::post('settings/update','SettingsController@updateSettings');
 Route::get('{module}', 'TemplateController@getModuleTemplate');
 Route::get('grid/{module}', 'TemplateController@getModuleGrid');
 Route::get('{module}/{action}/{id?}', 'TemplateController@getActionTemplate');
});

