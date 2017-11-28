<?php

/**
 * EmailTemplate model
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model {
 /**
  * The database table used by the model.
  *
  * @var string
  */
 protected $table = 'push_notification';
 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [ 
   'name',
   'body',
   'subject',
   'is_active',
   'creator_id',
   'updator_id'
 ];
}
