<?php

/**
 * LocalizationSettingApiController
 *
 * To manage localization settings  api related activities
 *
 * @name       LocalizationSettingApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\LocalizationSettingRepository;
use Contus\Base\Controllers\Api\ApiController;

class LocalizationSettingApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(LocalizationSettingRepository $localizationSettingRepository) {
  parent::__construct ();
  $this->repository = $localizationSettingRepository;
 }
}
