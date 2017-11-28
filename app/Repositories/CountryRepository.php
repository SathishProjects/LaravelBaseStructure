<?php
/**
 * Country Repository
 *
 * To manage country related actions.
 *
 * @name       CountryRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\Country;
use Contus\Base\Repositories\Repository;


class CountryRepository extends Repository {
/**
 * Class initializer
 *
 * @return void
 */
public function __construct(Country $countryModel) {
 parent::__construct ();
 $this->country = $countryModel;
}
/**
 * Method to save the data into the countries table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdateCountry ( $this->request->all () );
}

/**
 * Method to update country details.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdateCountry ( $this->request->all (), $this->request->id );
}
/**
 * This method is use as a common method for both store and update.
 *
 * @param array $requestData
 * @param int $id
 * @return boolean
 */
public function addOrUpdateCountry($requestData, $id = null) {
 if (! empty ( $id )) {
  $country = $this->country->find ( $id );
  $this->setRule ( NAME, 'required|unique:countries,name,' . $country->id . '|max:50' );
 } else {
  $country = $this->country;
  $this->setRule ( NAME, 'required|unique:countries,name|max:50' );
 }
 $this->validate ( $this->request, $this->getRules () );
 $country->fill ($this->request->all ());
 $country->creator_id = $this->request->user_id;
 $country->updator_id = $this->request->user_id;
 $country->save ();
 return true;
}
/**
 * Method to prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->country );
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
 * Method to soft delete the record from countries table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
 $id = $this->request->id;
 return $this->country->where (ID, $id )->update ( array (
  IS_ACTIVE => '0' 
 ) );
}
}