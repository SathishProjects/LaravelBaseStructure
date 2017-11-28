<?php

/**
 * Notificationlist model
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationList extends Model {
 /**
  * The database table used by the model.
  *
  * @var string
  */
 protected $table = 'notification_lists';
 /**
  * The attributes that are mass insertion.
  *
  * @var array
  */
 protected $fillable = [ 
 		'from_user_id',
 		'to_user_id',
 		'from_user_name',
 		'to_user_name',
 		'user_type',
 		'service_type',
 		'message', 
 		'is_read',
 		'order_format_id',
 		'order_id',
 		'shipment_id',
 		'status',
 		'job_type',
   		'creator_id',
 		'updator_id'
 ];
}
