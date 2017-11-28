<?php
/**
 * Admin Repository for web
 *
 * To manage admin users related actions.
 *
 * @name       AdminRepository Web Interface
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories\Web;

use Apptha\Repositories\AdminRepository as AdminBaseRepository;
use Apptha\Models\UserRole;
use Apptha\Models\AdminUser;
use Apptha\Models\City;
use Apptha\Models\State;
use Apptha\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Contus\Base\Repositories\Repository;

class AdminRepository extends AdminBaseRepository {
  /**
   * Class initializer
   *
   * @return void
   */
  public function __construct() {
    parent::__construct ();
    $this->setRules (array(
       'name' => 'required|Regex:/^[a-zA-Z][a-zA-Z0-9\ ._&\-\(\)\[\]]+$/',
        'email' => 'required|unique:admin_users,email|email',
        'mobile_number' => 'required|unique:admin_users,mobile_number|numeric',
        'user_role' => 'required|exists:user_roles,id',
        'address' => 'required',
        'city' => 'required|exists:cities,id',
        'state' => 'required|exists:states,id',
        'country' => 'required|exists:countries,id',
        'zipcode' => 'required|numeric|digits_between:5,10',
        'company' => 'required'
    ));
  }
  /**
   * Method to get rules, city, state and country for adding users for admin.
   *
   * @return array
   */
  public function create() {
    return array (
        'rules' => $this->getRules(),
        'userRoles' => $this->userRole->get (),
        'city' => $this->city->get (),
        'country' => $this->country->get (),
        'state' => $this->state->get ()
    );
  }
  /**
   * Method to fetch single info of a admin user
   * 
   * @param int $id          
   * @return array
   */
  public function edit($id) {
    return array (
        'id' => $id,
        'adminUserSingleInfo' => $this->user->where ( 'id', $id )->first (),
        'rules' => $this->getRules(),
        'userRoles' => $this->userRole->get (),
        'city' => $this->city->get (),
        'country' => $this->country->get (),
        'state' => $this->state->get () 
    );
  }
  /**
   * This method is use as a common method for both store and update.
   *
   * @param array $requestData          
   * @param int $id          
   * @return boolean
   */
  public function addOrUpdateAdminUser($requestData, $id = null) {
    $userID = (isset ( $this->request->user_id )) ? $this->request->user_id : 1;
    if (! empty ( $id )) {
      $user = $this->user->findOrFail ( $id );
      $this->setRule ( 'name', 'required|unique:admin_users,name,' . $user->id . '|max:50' );
      $this->setRule ( 'email', 'required|unique:admin_users,email,' . $user->id . '|email' );
      $this->setRule ( 'mobile_number', 'required|unique:admin_users,mobile_number,' . $user->id . '|numeric' );
    }else{
      $user = $this->user;
      $user->verification_code = Hash::make(str_random(10));
    }
    $this->_validate();
    $user->fill ( $this->request->all (),array (
      $user->creator_id = $userID,
      $user->updator_id = $userID,
      $user->user_role_id = $this->request->user_role,
      $user->access_token = '',
      $user->city_id = $this->request->city,
      $user->country_id = $this->request->country,
      $user->state_id = $this->request->state
    ));
    if(isset($this->request->uploadedImage)) {
     $user->profile_image = $this->request->uploadedImage;
    }
    if ($user->save ()) {
      $status = true;
    }
    return $status;
  }
}