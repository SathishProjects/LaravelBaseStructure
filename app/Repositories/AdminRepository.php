<?php

/**
 * Admin Repository
 *
 * To manage admin users related actions.
 *
 * @name       MoverBee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\UserRole;
use Apptha\Models\AdminUser;
use Apptha\Models\City;
use Apptha\Models\State;
use Apptha\Models\Country;
use Illuminate\Support\Facades\DB;
use Contus\Base\Repositories\Repository;

class AdminRepository extends Repository {
  /**
   * Class initializer
   *
   * @return void
   */
  public function __construct() {
    parent::__construct ();
    $this->user = new AdminUser ();
    $this->userRole = new UserRole ();
    $this->city = new City ();
    $this->state = new State ();
    $this->country = new Country ();
  }
  /**
   * This method is use to save the data in admin user tables
   *
   * @see \Contus\Base\Contracts\ResourceInterface::store()
   *
   * @return boolean
   */
  public function store() {
    return $this->addOrUpdateAdminUser ( $this->request->all () );
  }
  
  /**
   * This method is use to update the admin user details based on the user id
   *
   * @see \Contus\Base\Contracts\ResourceInterface::update()
   * @return boolean
   */
  public function update() {
    return $this->addOrUpdateAdminUser ( $this->request->all (), $this->request->id );
  }
  
  /**
   * This method is use as a common method for both store and update.
   *
   * @param array $requestData          
   * @param int $id          
   * @return boolean
   */
  public function addOrUpdateAdminUser($requestData, $id = null) {
    /**
     * define the validation rules for users registration and
     * for profile update
     *
     * @var array $rules
     */
    if (empty ( $id ) && is_null ( $id )) {
      $rules = [ 
          'name' => 'required|Regex:/^[a-zA-Z][a-zA-Z0-9\ ._&\-\(\)\[\]]+$/',
          'email' =>'required|unique:admin_users,email|email',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
          'mobile_number' => COMMON_MOBILE_VALIDATION_RULE . '|unique:admin_users,mobile_number|numeric',
          'gender' => 'required',
          'user_role_id' => COMMON_NUMBER_VALIDATION_RULE . '|exists:user_roles,id' 
      ];
    } else {
      $rules = [ 
          ID => COMMON_NUMBER_VALIDATION_RULE . '|exists:admin_users,id' 
      ];
    }
    $this->setRules ( $rules );
    $this->_validate ();
    $status = false;
    $userID = (isset ( $this->request->user_id )) ? $this->request->user_id : 1;
    if (! empty ( $id )) {
      $user = AdminUser::find ( $id );
      $user->updator_id = $userID;
    } else {
      $user = new AdminUser ();
      $user->password = bcrypt ( $this->request->password );
      $user->access_token = md5 ( time () . $this->request->email );
      $user->mobile_number = $this->request->mobile_number;
      $user->email = $this->request->email;
    }
    $user->creator_id = $userID;
    $user->updator_id = $userID;
    $user->name = $this->request->name;
    $user->gender = $this->request->gender;
    $user->user_role_id = $this->request->user_role_id;
    
    if ($user->save ()) {
      $status = true;
    }
    return $status;
  }
  /**
   * Prepare the grid
   * set the grid model and relation model to be loaded
   *
   * @return \Contus\Base\Repositories\Repository
   */
  public function prepareGrid() {
    $this->setGridModel ( $this->user )->setEagerLoadingModels ( 'userRole' );
    return $this;
  }
  /**
   * This method is use to soft delete the records
   *
   * @see \Contus\Base\Contracts\ResourceInterface::destroy()
   *
   * @return bool
   */
  public function destroy() {
    $id = $this->request->id;
    return $this->user->where ( ID, $id )->update ( array (
        IS_ACTIVE => '0' 
    ) );
  }
  
  /**
   * Update grid records collection query
   *
   * @param mixed $builder          
   * @return mixed
   */
  protected function updateGridQuery($adminUser) {
    /**
     * updated the grid query by using this function and apply the video condition.
     */
    $filters = $this->request->input('filters');
    if (! empty ( $filters )) {
      foreach ( $filters as $key => $value ) {
        switch ($key) {
          case 'name' :
            $adminUser->where ( 'name', 'like', '%' . $value . '%' )->get ();
            break;
          case 'email' :
            $adminUser->where ( 'email', 'like', '%' . $value . '%' )->get ();
            break;
          case 'company' :
            $adminUser->where ( 'company', 'like', '%' . $value . '%' )->get ();
            break;
          case 'tab' :
          case 'status' :
            if ($value != 'All') {
              $adminUser->where ( 'is_active', $value );
            }
            break;
          case 'created_at':
            $value = explode('-',trim($value));
            $adminUser->whereBetween('created_at', [$value[0], $value[1]]);
            break;
          case 'role' :
            if ($value != 'All') {
              $adminUser->where ( 'user_role_id', '=', $value )->get ();
            }
            break;
          default :
            $adminUser->where ( $key, 'like', "%$value%" );
            break;
        }
      }
    }
    return $adminUser;
  }
  
  /**
   * Method to pass additional information to the grid
   *
   * @see \Contus\Base\Contracts\GridableInterface::getGridAdditionalInformation()
   */
  public function getGridAdditionalInformation() {
    $activeAdminUsers = $this->user->where ( 'is_active', 1 )->count ();
    $inactiveAdminUsers = $this->user->where ( 'is_active', 0 )->count ();
    $totalAdminUsers = $this->user->count ();
    $userRoles = $this->userRole->get ();
    return [
    'activeCount' => $activeAdminUsers,
    'inactiveCount' => $inactiveAdminUsers,
    'totalCount' => $totalAdminUsers,
    'userRoles' => $userRoles
    ];
  }
}