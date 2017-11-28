<?php
/**
 * AdminApiController
 *
 * To manage admin user related activities
 *
 * @name       MoverBee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\AdminRepository as AdminBaseRepository;
use Apptha\Repositories\Web\AdminRepository ;
use Contus\Base\Controllers\Api\ApiController;

class AdminApiController extends ApiController {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct ();

    if ($this->isMobileRequest()) {
      $this->repository = new AdminBaseRepository();
    }else{
      $this->repository = new AdminRepository();
    }
  }
}
