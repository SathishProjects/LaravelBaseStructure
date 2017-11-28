<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 Route::resource('userrole', 'RoleApiController');
 Route::resource('admin','AdminApiController');
 Route::post('login','UserApiController@postLogin');
 Route::post('forgotpassword','UserApiController@postForgotpassword');
 Route::resource('admingroup','AdminGroupApiController');
 Route::resource('country', 'CountryApiController');
 Route::resource('state', 'StateApiController');
 Route::resource('city', 'CityApiController');
 Route::resource('settingcategory', 'SettingCategoryApiController');
 Route::resource('setting', 'SettingApiController');
 Route::resource('localizationsetting', 'LocalizationSettingApiController');
 Route::post('smsservice','SmsApiController@postSmsGateway');
 Route::post('verifycode','SmsApiController@postVerifySmsCode');
 Route::resource('emailtemplate','EmailTemplateApiController');
 Route::resource('smstemplate','SmsApiController');
 Route::get('emailpushnotification','ZoneApiController@emailPushNotification');
 Route::resource('notification','NotificationListApiController');
 Route::resource('pushnotification','PushNotificationApiController');