<?php
/**
 * Localization settings Model
 *
 * This model will hold the data related to localization settings table and its relations
 *
 * @name       Localization settings Model
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class LocalizationSetting extends Model{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'localization_settings';
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
   'language',
   'time_zone',
   'currency',
   'is_active',
  ];
}
