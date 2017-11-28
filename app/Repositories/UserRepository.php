<?php
/**
 * User Repository
 *
 * To manage user related actions.
 *
 * @name       UserRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
/**
 * Including dependency classes
 * models, repositories, laravel default libraries
 */
namespace Apptha\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Apptha\User;
use Illuminate\Auth\Access\Response;
use Psy\Util\Json;
use Contus\Base\Repositories\Repository;

class UserRepository extends Repository {
 
 /**
  * Class initializer
  *
  * @return void
  */
 public function __construct(User $user) {
  parent::__construct ();
  $this->user = $user;
 }
 
 /**
  * this function is used to check if the user is authenticated or it will takes the email and password as input
  *
  * @return json response
  */
 public function checkLogin() {
  $response = [ 
    'status' => false,
    'code' => 422 
  ];
  $this->setRules ( [ 
    EMAIL => 'required|email',
    PASSWORD => 'required'
  ] );
  $this->_validate ();
  $user = $this->user->where ( EMAIL, $this->request->email )->first ();
  
  if (count ( $user ) > 0) {
   if (Hash::check ( $this->request->password, $user->password )) {
    $response ['status'] = true;
    auth ()->loginUsingId ( $user->id );
    $response = $this->checkUserStatus ();
   } else {
    $response [MESSAGE] = trans ( 'user.login.invalid-password' );
   }
  } else {
   $response [MESSAGE] = trans ( 'user.login.invalid-email' );
  }
  return $response;
 }
 
 /**
  * This function is used to check if user account is active or not
  *
  * @return array Response
  */
 protected function checkUserStatus() {
  $response = '';
  if (auth ()->user ()->is_active == 1) {
   if (auth ()->user ()->is_verified == 1) {
    $response = [ 
      STATUS => true,
      MESSAGE => trans ( 'user.login.success' ),
      'adminusers' => auth ()->user () 
    ];
   } else {
    $response = [ 
      STATUS => true,
      MESSAGE => trans ( 'user.login.invalid-authorise' ),
      'adminusers' => auth ()->user () 
    ];
   }
  } else {
   $response = [ 
     STATUS => false,
     MESSAGE => trans ( 'user.login.invalid-status' ),
     'code' => 422 
   ];
  }
  return $response;
 }
 
 /**
  * This function is used to reset the user password and assign the new password to user
  *
  * @return Json response
  */
 public function forgotPassword() {
  $this->setRules ( [ 
    EMAIL =>  'required|exists:admin_users,email',
    'is_sms' => 'required' 
  ] );
  $this->_validate ();
  $newPassword = str_random ( 8 );
  $user = User::where ( EMAIL, $this->request->email )->first ();
  $user->password = bcrypt ( $newPassword );
  $user->save ();
  return [
    STATUS => true,
    MESSAGE => trans ( 'user.forgotpassword.success' ) 
  ];
 }
}

