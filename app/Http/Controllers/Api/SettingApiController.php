<?php

/**
 * SettingApiController
 *
 * To manage settings  api related activities
 *
 * @name       SettingApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\SettingRepository;
use Contus\Base\Controllers\Api\ApiController;

class SettingApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(SettingRepository $settingRepository) {
  parent::__construct ();
  $this->repository = $settingRepository;
 }
 /**
  * Getting the settings json file
  */
 public function getSettingFileContent(){
 	return $this->getSuccessJsonResponse ( [
 			'message' => trans ( 'messages.setting_cache' ),
 			'data' => $this->repository->getSettingFilejson ()
 	] );
  }
  /**
   * Getting the call center support number.
   */
  public function getSupportNumer(){
  	return $this->getSuccessJsonResponse ( [
  	 'message' => trans ( 'messages.setting_support' ),
  	 'data' => $this->repository->getCallSuportNo ()
  	 ] );
  }
}
