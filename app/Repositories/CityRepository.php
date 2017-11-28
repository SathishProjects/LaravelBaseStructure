<?php

/**
 * City Repository
 *
 * To manage city related actions.
 *
 * @name       CityRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\City;
use Contus\Base\Repositories\Repository;


class CityRepository extends Repository {
/**
 * Class initializer
 *
 * @return void
 */
public function __construct(City $cityModel) {
 parent::__construct ();
 $this->city = $cityModel;
}
/**
 * Method to save the data into the cities table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdateCity( $this->request->all ());
}

/**
 * Method to update city details.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdateCity( $this->request->all (), $this->request->id );
}
/**
 * This method is use as a common method for both store and update.
 *
 * @param array $requestData
 * @param int $id
 * @return boolean
 */
public function addOrUpdateCity($requestData, $id = null) {
 if (! empty ( $id )) {
  $city = $this->city->find ( $id );
  $this->setRule ( NAME, 'required|unique:cities,name,' . $city->id . '|max:50' );
 } else {
  $city = $this->city;
  $this->setRule ( NAME, 'required|unique:cities,name|max:50' );
 }
 $this->validate ( $this->request, $this->getRules () );
 $city->fill ($this->request->all ());
 $city->is_active = $this->request->is_active;
 $city->creator_id = $this->request->user_id;
 $city->updator_id = $this->request->user_id;
 $city->save ();
 return true;
}
/**
 * Method to prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->city );
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
  * updated the grid query by using this function.
  */
 $builder->where(IS_ACTIVE,1);

 return $builder;
}
/**
 * Method to soft delete the records.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
 $id = $this->request->id;
 return $this->city->where (ID, $id )->update ( array (
  IS_ACTIVE => '0' 
 ) );
}
}