<?php

/**
 * PushNotificationApiController
 *
 * To push notification template related activities
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\PushNotificationRepository;
use Contus\Base\Controllers\Api\ApiController;

class PushNotificationApiController extends ApiController {

/**
 * Class initializer
 * 
 * @param EmailTemplateRepository $emailTemplateRepository
 */
public function __construct(PushNotificationRepository $pushNotificationRepository) {
    parent::__construct ();
    $this->repository = $pushNotificationRepository;
}
}