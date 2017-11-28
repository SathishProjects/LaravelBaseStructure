<?php

/**
 * Sms Repository
 *
 * To manage SMS related actions.
 *
 * @name       SmsRepository
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Illuminate\Database\QueryException;
use Apptha\Models\SmsTemplate;
use Contus\Base\Repositories\Repository;
use Contus\Base\Exceptions\InvalidRequestException;

class SmsRepository extends Repository {

/**
 * Class initializer
 *
 * @return void
 */
public function __construct(SmsTemplate $smsTemplate) {
 parent::__construct ();
 $this->smsTemplate = $smsTemplate;
}

/**
 * This method is use to save the data in sms templates tables
 *
 * @see \Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdate ( $this->request->all () );
}

/**
 * This method is use to update the sms templates
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdate ( $this->request->all (), $this->request->id );
}

/**
 * This method is use as a common method for both store and update sms templates
 *
 * @param array $requestData
 * @param int $id
 * @return boolean
 */
public function addOrUpdate($requestData, $id = null) {
 $operationStatus=true;
 if (! empty ( $id )) {
  $smsTemplate = $this->smsTemplate->find ( $id );
  $this->setRule ( 'name', 'required|unique:sms_templates,name,' . $smsTemplate->id . '|max:50' );
 } else {
  $smsTemplate = $this->smsTemplate;
  $this->setRule ( 'name', 'required|unique:sms_templates,name|max:50' );
 }
 $this->setRule ( 'is_active', 'required|numeric' );
 $this->_validate ();
 $smsTemplate->fill ( $this->request->all() );
 $smsTemplate->fill ( array(
 		'creator_id' => $this->request->user_id,
 		'updator_id' => $this->request->user_id
 ) );
 if(empty($id)) {
  $smsTemplate->slug = str_slug($this->request->name);
 }
 $smsTemplate->save ();
 return $operationStatus;
}
/**
 * Prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->smsTemplate );
 return $this;
}

/**
 * Update grid records collection query
 *
 * @param mixed $smsTemplate
 * @return mixed
 */
protected function updateGridQuery($smsTemplate) {
 /**
  * updated the grid query by using this function and apply the is_active condition.
  */
 /**
  * updated the grid query by using this function and apply the is_active condition.
  */
 $filters = $this->request->input('filters');
 if (! empty ( $filters )) {
  foreach ( $filters as $key => $value ) {
   switch ($key) {
    case 'name' :
     $smsTemplate->where ( 'name', 'like', '%' . $value . '%' )->get ();
     break;
    default :
     $smsTemplate->where ( 'is_active', 1 )->orWhere('is_active', 0);
     break;
   }
  }
 }
 return $smsTemplate;
}

/**
 * This method is use to soft delete the records
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
 return $this->smsTemplate->where ( 'id', $this->request->id )->update ( array (
   'is_active' => 0
 ) );
}
/**
 * Method to get the data of single record of email template
 *
 * @see \Contus\Base\Contracts\ResourceInterface::edit()
 * @return array, id, list of email
 */
public function edit($id) {
 return array (
   'id' => $id,
   'smsSingleInfo' => $this->smsTemplate->where ( 'id', $id )->first (),
   'rules' => array (
     'name' => 'required',
     'subject' => 'required',
     'content' => 'required',
   )
 );
}
/**
 * Method to get the rules of email template
 *
 * @see \Contus\Base\Contracts\ResourceInterface::create()
 * @return array
 */
public function create() {
 return array (
   'rules' => array (
     'name' => 'required',
     'subject' => 'required',
     'content' => 'required',
   )
 );
}
}