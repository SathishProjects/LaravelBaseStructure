<?php
/**
 * CityApiController
 *
 * To manage city api related activities
 *
 * @name       CityApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\CityRepository;
use Contus\Base\Controllers\Api\ApiController;

class CityApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(CityRepository $cityRepository) {
  parent::__construct ();
  $this->repository = $cityRepository;
 }
}
