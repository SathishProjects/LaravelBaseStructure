<?php
/**
 * Settings category Repository
 *
 * To manage settings category related actions.
 *
 * @name       MoverBee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\SettingCategory;
use Contus\Base\Repositories\Repository;

class SettingCategoryRepository extends Repository {
 /**
   * Class initializer
   *
   * @return void
   */
  public function __construct(SettingCategory $settingCategoryModel) {
    parent::__construct ();
    $this->settingCategory = $settingCategoryModel;
  }
  /**
   * Method to save the data into the setting categories table.
   *
   * @see \Apptha\Contracts\ResourceInterface::store()
   *
   * @return boolean
   */
  public function store() {
    return $this->addOrUpdateSettingCategory ( $this->request->all () );
  }
  
  /**
   * Method to update setting categories details.
   *
   * @see \Apptha\Contracts\ResourceInterface::update()
   * @return boolean
   */
  public function update() {
    return $this->addOrUpdateSettingCategory ( $this->request->all (), $this->request->id );
  }
  /**
   * This method is use as a common method for both store and update.
   *
   * @param array $requestData          
   * @param int $id          
   * @return boolean
   */
  public function addOrUpdateSettingCategory($requestData, $id = null) {
    if (! empty ( $id )) {
      $settingCategory = $this->settingCategory->find ( $id );
      $this->setRule ( NAME, 'required|unique:setting_categories,name,' . $settingCategory->id . '|max:50' );
    } else {
      $settingCategory = $this->settingCategory;
      $this->setRule ( NAME,  'required|unique:setting_categories,name|max:50' );
    }
    $this->validate ( $this->request, $this->getRules () );
    $settingCategory->fill ( $this->request->all () );
    $settingCategory->save ();
    return true;
  }
  /**
   * Method to prepare the grid
   * set the grid model and relation model to be loaded
   *
   * @return \App\Repositories\BaseRepository
   */
  public function prepareGrid() {
    $this->setGridModel ( $this->settingCategory );
    return $this;
  }
  /**
   * Method to update grid records collection query
   *
   * @param mixed $builder          
   * @return mixed
   */
  protected function updateGridQuery($builder) {
    /**
     * updated the grid query by using this function and apply the video condition.
     */
    $builder->where ( IS_ACTIVE, 1 );
    
    return $builder;
  }
  /**
   * Method to soft delete the records from the settings category table.
   *
   * @see \Apptha\Contracts\ResourceInterface::destroy()
   *
   * @return bool
   */
  public function destroy() {
    $id = $this->request->id;
    return $this->settingCategory->where ( ID, $id )->update ( array (
        IS_ACTIVE => '0' 
    ) );
  }
  /**
   * Method to get the setting categories
   * 
   * @return object list of setting categories
   */
  public function getSettingCategories(){
    return  $this->settingCategory->get ();
  }
}