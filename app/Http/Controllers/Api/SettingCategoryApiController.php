<?php

/**
 * SettingCategoryApiController
 *
 * To manage setting category api related activities
 *
 * @name       SettingCategoryApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\SettingCategoryRepository;
use Contus\Base\Controllers\Api\ApiController;

class SettingCategoryApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(SettingCategoryRepository $settingCategoryRepository) {
  parent::__construct ();
  $this->repository = $settingCategoryRepository;
 }
}
