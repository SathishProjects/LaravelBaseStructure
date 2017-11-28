<?php

/**
 * UserApiController
 *
 * To manage user related activities
 *
 * @name       UserApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Api;

use Apptha\Repositories\UserRepository;
use Contus\Base\Controllers\Api\ApiController;

class UserApiController extends ApiController {
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct(UserRepository $userRepository) {
  parent::__construct ();
  $this->repository = $userRepository;
 }
 
 /**
  * Function to authenticate user
  * it will takes the email and password as input and check and returns the response
  * 
  * @return json object
  */
 public function postLogin() {
  $isLoggedin = false;
  $data = $this->repository->checkLogin ();
  if ($data [STATUS]) {
   $isLoggedin = true;
  }
  return ($isLoggedin) ? $this->getSuccessJsonResponse ( [ 
    RESPONSE => $data 
  ], $data [MESSAGE] ) : $this->getErrorJsonResponse ( [ ], $data [MESSAGE], $data [CODE] );
 }
 
 /**
  * This function is used to send new password
  * it will takes the user and communication medium as input
  * return new password
  * @return json object
  */
 public function postForgotpassword(){
  $result=$this->repository->forgotPassword();
  return ($result[STATUS]) ? $this->getSuccessJsonResponse ( [ ], $result [MESSAGE] ) : $this->getErrorJsonResponse ( [ ], $result [MESSAGE],$result[CODE] );
 }
}
