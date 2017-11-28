<?php
/**
 * User Model
 *
 * This model will going to hold the table related to user and its relations
 *
 * @category  Contus
 * @package   Contus_laravel 5.3
 * @author    Contus Team <developers@contus.in>
 * @copyright Copyright (C) 2016 Contus. All rights reserved.
 * @license   GNU General Public License http://www.gnu.org/copyleft/gpl.html
 **/

namespace Apptha;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
 protected $table = 'admin_users';
 
 use Notifiable;
 
 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [ 
   'name',
   'email',
   'password',
   'user_role_id',
   'mobile_number',
   'gender',
   'profile_image',
   'verification_code',
   'creator_id',
   'updator_id' 
 ];
 
 /**
  * The attributes that should be hidden for array.
  *
  * @var array
  */
 protected $hidden = [ 
   'password',
   'remember_token' 
 ];
}
