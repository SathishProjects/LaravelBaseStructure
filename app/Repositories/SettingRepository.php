<?php

/**
 * Settings Repository
 *
 * To manage settings related actions.
 *
 * @name       SettingRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\Setting;
use Apptha\Models\SettingCategory;
use Contus\Base\Repositories\Repository;
use Contus\Base\Exceptions\InvalidRequestException;


class SettingRepository extends Repository {
  /**
   * Class initializer
   *
   * @return void
   */
  public function __construct(Setting $SettingModel, SettingCategory $settingCategoryModel ) {
    parent::__construct ();
    $this->_settings = $SettingModel;
    $this->_settingsCategory = $settingCategoryModel;
  }
  /**
   * Method to save the data into the settings table.
   *
   * @see \Apptha\Contracts\ResourceInterface::store()
   *
   * @return boolean
   */
  public function store() {
    return $this->addOrUpdateSettings ( $this->request->all () );
  }
  
  /**
   * Method to update settings table details.
   *
   * @see \Apptha\Contracts\ResourceInterface::update()
   * @return boolean
   */
  public function update() {
    return $this->addOrUpdateSettings ( $this->request->all (), $this->request->id );
  }
  /**
   * This method is use as a common method for both store and update.
   *
   * @param array $requestData          
   * @param int $id          
   * @return boolean
   */
  public function addOrUpdateSettings($requestData, $id = null) {
    if (! empty ( $id )) {
      $setting = $this->_settings->find ( $id );
      $this->setRule ( DISPLAY_NAME,  'required|unique:settings,display_name,' . $setting->id . '|max:50' );
    } else {
      $setting = $this->_settings;
      $this->setRule ( DISPLAY_NAME, 'required|unique:settings,display_name|max:50' );
    }
    $this->validate ( $this->request, $this->getRules () );
    $setting->fill ( $this->request->all () );
    $setting->save ();
    return true;
  }
  /**
   * Method to prepare the grid
   * set the grid model and relation model to be loaded
   *
   * @return \App\Repositories\BaseRepository
   */
  public function prepareGrid() {
    $this->setGridModel ( $this->_settings );
    return $this;
  }
  /**
   * Method to update grid records collection query
   *
   * @param mixed $builder          
   * @return mixed
   */
  protected function updateGridQuery($builder) {
    /**
     * updated the grid query by using this function and apply the video condition.
     */
    $builder->where ( IS_ACTIVE, 1 );
    
    return $builder;
  }
  /**
   * Method to soft delete the record from the settings table.
   *
   * @see \Apptha\Contracts\ResourceInterface::destroy()
   *
   * @return bool
   */
  public function destroy() {
    $id = $this->request->id;
    return $this->_settings->where ( ID, $id )->update ( array (IS_ACTIVE => '0' ) );
  }
  /**
   * Method to update settings table from the admin panel
   * 
   * @return boolean
   */
  public function updateSettings(){
    $this->generateSettingRules();
    $this->validate ( $this->request, $this->getRules () );
    foreach ( $this->request->except ( '_token' ) as $key => $value ) {
      $this->logger->info($key);
      $split = explode ( '__', $key );
      $settingCategory = $this->_settingsCategory->where ( 'slug', $split [0] )->first ();
      $setting = $this->_settings->where ( 'setting_name', $split [1] )->where ( 'setting_category_id', $settingCategory->id )->first ();
      if (isset ( $setting ) && count ( $setting ) > 0) {
        if ($setting->type == 'image') {
          $this->__imageUpload ( $setting, $settingCategory );
        }
        $setting->setting_value = ($setting->type == 'image') ? $setting->setting_value : $value;
        $setting->save ();
      }
    }

    return true;
  }
  /**
   * Method to validate setting fields
   * 
   * @return array, list of errors if the vaidation fails
   */
  public function generateSettingRules() {
    $rules = [ ];
    foreach ( $this->request->except ( '_token' ) as $key => $value ) {
      if($key == 'general-settings__commision_percentage') {
       $rules [$key] = 'required|numeric';
      } else{
       $rules [$key] = 'required';
      }
    }
   
    return $this->setRules ( $rules );
  }
  /**
   * Method to upload image for all process in settings
   *
   * @param $setting, setting table data.
   * @param $settingCategory, setting categories table data.
   *
   * @return boolean
   */
  public function __imageUpload($setting, $settingCategory) {
    $fieldName = $settingCategory->slug . '__' . $setting->setting_name;
    if (isset ( $this->request [$fieldName] ) && ! empty ( $this->request [$fieldName] )) {
      $destinationPath = public_path () . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';
      if ($this->request->file($fieldName)->move ( $destinationPath, $setting->setting_name . ".png" )) {
        return true;
      }
    }
  }
  /**
   * To generate cache file after updating the setting records.
   *
   * Cache file path configured in config file. Once the setting data updated the JSON file will be generated.
   *
   * @return response
   */
  public function generateSettingsCache() {
    $fileSystem = app ()->make ( 'files' );
    $settingDetails = $this->getSettings ();
    $siteSettingPath = config ( 'apptha.setting_cache_file_path' );
    $result = [ ];
    foreach ( $settingDetails as $settingDetail ) {
      foreach ( $settingDetail ['settings'] as $setting ) {
          $result [$settingDetail->slug][$setting->setting_name] = $setting->setting_value;
      }
    }
    $fileSystem->delete ( $siteSettingPath );
    if (! $fileSystem->exists ( $siteSettingPath )) {
      $fileSystem->put ( $siteSettingPath, json_encode ( $result ) );
    }
  }
  
  /**
   * To generate cache file for validation rule.
   *
   * All the validation rule will be generated as JSON file .
   *
   * @return response
   */
  public function generateValidationCache() {
    $fileSystem = app ()->make ( 'files' );
    $siteTranslationPath = config ( 'apptha.translation_cache_file_path' ) . '/translation_en.json';
    $fileSystem->delete ( $siteTranslationPath );
    if (! $fileSystem->exists ( $siteTranslationPath )) {
      $fileSystem->put ( $siteTranslationPath, json_encode ( trans ( 'validation' ) ) );
    }
  }
  /**
   * Fetch settings to display in admin block.
   *
   * @return response
   */
  public function getSettings() {
    return $this->_settingsCategory->with ( [
        'settings'
        ] )->get ();
  }
  /**
   * Fetch the sitesetting data from catch file
   *
   * @return Response
   * @throws \Contus\Base\Exceptions\InvalidRequestException
   */
  public function getSettingFilejson() {  	
  	$settingsData = [];  	 
  	try {
  		$this->generateSettingsCache();
  		$settingsData = file_get_contents ( app ( 'config' )->get ( 'apptha.setting_cache_file_path' ) );
   	} catch(Exception $e) {
   		throw new InvalidRequestException(trans('messages.unable_retrive'),500);
  	}  	 
  	return json_decode ($settingsData, true );
  }
  /**
   * This method is used to get the support call number.
   * @throws InvalidRequestException
   * @return unknown
   */
  public function getCallSuportNo(){
  	$supportno=$this->_settings->where ('setting_name', 'support_number' )->first( );
   	if(sizeof($supportno) > 0) 
  	return $supportno;
  	else 
  	throw new InvalidRequestException(trans('messages.unable_retrive'),500);
  }
}