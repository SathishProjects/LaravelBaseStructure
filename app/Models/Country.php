<?php
/**
 * Country Model
 *
 * This model will hold the data related to country table and its relations
 *
 * @name       Country
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'countries';
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [ 
      'name',
      'is_active' 
  ];
}
