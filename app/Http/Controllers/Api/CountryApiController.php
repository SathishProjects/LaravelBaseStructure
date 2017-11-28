<?php
/**
 * CountryApiController
 *
 * To manage countries api related activities
 *
 * @name       CountryApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\CountryRepository;
use Contus\Base\Controllers\Api\ApiController;

class CountryApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(CountryRepository $countryRepository) {
  parent::__construct ();
  $this->repository = $countryRepository;
 }
}
