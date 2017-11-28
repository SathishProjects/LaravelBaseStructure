<?php
/**
 * Localization Setting Repository
 *
 * To manage localization settings related actions.
 *
 * @name       LocalizationSettingRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\LocalizationSetting;
use Contus\Base\Repositories\Repository;

class LocalizationSettingRepository extends Repository {
/**
 * Class initializer
 *
 * @return void
 */
public function __construct(LocalizationSetting $localizationSettingModel) {
 parent::__construct ();
 $this->localizationSetting = $localizationSettingModel;
}
/**
 * Method to save the data into the localization settings table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdateLocalizationSettings ( $this->request->all ());
}

/**
 * Method to update settings table details.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdateLocalizationSettings ( $this->request->all (), $this->request->id );
}
/**
 * This method is use as a common method for both store and update.
 *
 * @param array $requestData
 * @param int $id
 * @return boolean
 */
public function addOrUpdateLocalizationSettings($requestData, $id = null) {
 if (! empty ( $id )) {
  $localizationSettings = $this->localizationSetting->find ( $id );
  $this->setRule ( LANGUAGE, 'required|unique:localization_settings,language,' . $localizationSettings->id . '|max:50' );
 } else {
  $localizationSettings = $this->localizationSetting;
  $this->setRule ( LANGUAGE, 'required|unique:localization_settings,language|max:50' );
 }
 $this->setRule ( TIME_ZONE, 'required');
 $this->setRule ( CURRENCY, 'required');
 $this->validate ( $this->request, $this->getRules () );
 $localizationSettings->fill ($this->request->all ());
 $localizationSettings->save ();
 return true;
}
/**
 * Method to prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->localizationSetting );
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
 $builder->where(IS_ACTIVE,1);

 return $builder;
}
/**
 * Method to soft delete the record from the localization settings table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
 $id = $this->request->id;
 return $this->localizationSetting->where (ID, $id )->update ( array (
  IS_ACTIVE => '0' 
 ) );
}
}