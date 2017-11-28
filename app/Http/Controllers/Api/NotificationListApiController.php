<?php

/**
 * NotificationApiController
 *
 * To manage notification related activities
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\NotificationListRepository;
use Contus\Base\Controllers\Api\ApiController;

class NotificationListApiController extends ApiController {
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct(NotificationListRepository $notificationListRepository) {
 parent::__construct ();
 $this->repository = $notificationListRepository;
}
}
