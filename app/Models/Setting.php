<?php
/**
 * Settings Model
 *
 * This model will hold the data related to settings table and its relations
 *
 * @name       Settings Model
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'settings';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
  'setting_name',
  'setting_value',
  'display_name',
  'class',
  'type',
  'option',
  'order',
  'description',
  'setting_category_id',
  'is_active'
  ];
  /**
   * Method used to get the option list based on the settings class
   *
   * @return array
   */
  public function getOption() {
    if ($this->class && ($classInstance = $this->getClassInstance ())) {
      return $classInstance->getOptionList ();
    } else {
      return explode ( ",", $this->option );
    }
  }
  
  /**
   * Method used to create instance for the class updated in settings
   *
   * @return Object
   */
  public function getClassInstance() {
    $classInstance = false;
    $status = false;
  
    if (class_exists ( $this->class )) {
      $classInstance = new $this->class ();
    }
  
    return ($classInstance instanceof ConfigurableModel) ? $classInstance : $status;
  }
}
