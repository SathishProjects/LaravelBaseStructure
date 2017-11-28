<?php

/**
 * SmsApiController
 *
 * To manage SMS related activities
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\SmsRepository;
use Contus\Base\Controllers\Api\ApiController;

class SmsApiController extends ApiController {
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct(SmsRepository $SmsRepository) {
 parent::__construct ();
 $this->repository = $SmsRepository;
}
}
