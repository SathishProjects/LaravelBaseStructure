<?php
/**
 * Admin User Group
 *
 * This model will going to hold the table related to admin users groups and its relations
 * Contians the common validations used by this model
 * 
 * @category  Contus
 * @package   Contus_laravel 5.3
 * @author    Contus Team <developers@contus.in>
 * @copyright Copyright (C) 2016 Contus. All rights reserved.
 * @license   GNU General Public License http://www.gnu.org/copyleft/gpl.html
 * @version   Release: 1.0
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUserGroup extends Model{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'admin_user_groups';
}
