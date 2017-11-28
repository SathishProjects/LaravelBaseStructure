<?php

/**
 * State Repository
 *
 * To manage state related actions.
 *
 * @name       StateRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Apptha\Models\State;
use Contus\Base\Repositories\Repository;

class StateRepository extends Repository {
/**
 * Class initializer
 *
 * @return void
 */
public function __construct(State $stateModel) {
 parent::__construct ();
 $this->state = $stateModel;
}
/**
 * Method to save the data into the state table.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdateState ( $this->request->all () );
}

/**
 * Method to update state details.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdateState ( $this->request->all (), $this->request->id  );
}
/**
 * This method is use as a common method for both store and update.
 *
 * @param array $requestData
 * @param int $id
 * @return boolean
 */
public function addOrUpdateState($requestData, $id = null) {
 if (! empty ( $id )) {
  $state = $this->state->find ( $id );
  $this->setRule ( NAME, 'required|unique:states,name,' . $state->id . '|max:50' );
 } else {
  $state = $this->state;
  $this->setRule ( NAME, 'required|unique:states,name|max:50' );
 }
 $this->validate ( $this->request, $this->getRules () );
 $state->fill ($this->request->all ());
 $state->creator_id = $this->request->user_id;
 $state->updator_id = $this->request->user_id;
 $state->save ();
 return true;
}
/**
 * Method to prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->state )->setEagerLoadingModels('country');
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
 * Method to soft delete the records.
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
 return $this->state->where (ID, $this->request->id )->update ( array (
  IS_ACTIVE => '0' 
 ) );
}
}