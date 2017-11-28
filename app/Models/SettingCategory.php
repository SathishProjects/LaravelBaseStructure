<?php
/**
 * SettingCategory Model
 *
 * This model will hold the data related to settings category table and its relations
 *
 * @name       SettingCategory Model
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCategory extends Model {
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'setting_categories';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'name',
  'is_active',
  'parent_id',
  'slug'
  ];
  function settings(){
    return $this->hasMany('Apptha\Models\Setting','setting_category_id','id');
  }
}
