<?php
/**
 * State Model
 *
 * This model will hold the data related to state table and its relations
 *
 * @name       State Model
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'states';
  
  public function country(){
    return $this->belongsTo('Apptha\Models\Country');
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'name',
  'is_active',
  'country_id'
  ];
}
