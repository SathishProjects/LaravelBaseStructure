<?php
/**
 * City Model
 *
 * This model will going to hold the table related to cities and its relations
 * Contians the common validations used by this model
 *
 * @name       City Model
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cities';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'name',
  'is_active',
  ];
}
