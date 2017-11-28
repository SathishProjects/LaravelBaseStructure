<?php

/**
 * StateApiController
 *
 * To manage state api related activities
 *
 * @name       StateApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\StateRepository;
use Contus\Base\Controllers\Api\ApiController;

class StateApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(StateRepository $stateRepository) {
  parent::__construct ();
  $this->repository = $stateRepository;
 }
}
