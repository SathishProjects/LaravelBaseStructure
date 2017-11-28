<?php
/**
 * Notification model
 *
 * @name       Notification
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
  /**
   * Class constants to notification types
   *
   * @var const
   */
  const USER_TYPE_ADMIN = 'admin';  
  const USER_TYPE_DRIVER = 'driver';
  const USER_TYPE_CUSTOMER = 'customer';
  /**
   * Class property to hold available notification types
   *
   * @var array
   */
  public static $availableTypes = [ 
      self::USER_TYPE_ADMIN,
      self::USER_TYPE_DRIVER,
      self::USER_TYPE_CUSTOMER
  ];
  /**
   * Class property to hold model fillable attributes
   *
   * @var array
   */
  protected $fillable = [ 
      'title',
      'notified_user_type',
      'notified_user_id',
      'notifier_user_type',
      'notifier_user_id',
      'message',
  ];
}
