<?php

/**
 * Push Notification Repository 
 *
 * To manage push notification template related actions.
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */

namespace Apptha\Repositories;
use Illuminate\Database\QueryException;
use Apptha\Models\PushNotification;
use Contus\Base\Repositories\Repository;
use Contus\Base\Exceptions\InvalidRequestException;

class PushNotificationRepository extends Repository {
/**
 * Class initializer
 *
 * @return void
 */
public function __construct(PushNotification $pushNotification) {
 parent::__construct ();
 $this->pushNotification = $pushNotification;
}
/**
 * This method is use to save the data in email templates tables
 *
 * @see \\Contus\Base\Contracts\ResourceInterface::store()
 *
 * @return boolean
 */
public function store() {
 return $this->addOrUpdate ( $this->request->all () );
}

/**
 * This method is use to update the email templates
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
 return $this->addOrUpdate ( $this->request->all (), $this->request->id );
}

/**
 * This method is use as a common method for both store and update email templates 
 *
 * @param array $requestData         
 * @param int $id         
 * @return boolean
 */
public function addOrUpdate($requestData, $id = null) {
  $operationStatus=true;
   if (! empty ( $id )) {
     $pushNotification = $this->pushNotification->find ( $id );
     $this->setRule ( 'name', 'required|unique:push_notification,name,' . $pushNotification->id . '|max:50' );
    } else {
     $pushNotification = $this->pushNotification;
     $this->setRule ( 'name', 'required|unique:push_notification,name|max:50' );
    }
    $this->setRule ( 'is_active', 'required|numeric' );
    $this->_validate ();
    $pushNotification->fill ( $this->request->all() );  
    $pushNotification->fill ( array(
    		                    'creator_id' => $this->request->user_id,
    		                    'updator_id' => $this->request->user_id
    		             ) );
    if(empty($id)) {
     $pushNotification->slug = str_slug($this->request->name);
    }
    $pushNotification->save ();
    return $operationStatus;
}
/**
 * Prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->pushNotification );
 return $this;
}

/**
 * Update grid records collection query
 *
 * @param mixed $pushNotification         
 * @return mixed
 */
protected function updateGridQuery($pushNotification) {
 /**
  * updated the grid query by using this function and apply the is_active condition.
  */
 $filters = $this->request->input('filters');
 if (! empty ( $filters )) {
  foreach ( $filters as $key => $value ) {
   switch ($key) {
    case 'name' :
     $pushNotification->where ( 'name', 'like', '%' . $value . '%' )->get ();
     break;
    default :
     $pushNotification->where ( 'is_active', 1 )->orWhere('is_active', 0);
     break;
   }
  }
 }
 return $pushNotification;
}

/**
 * This method is use to soft delete the records
 *
 * @see \Contus\Base\Contracts\ResourceInterface::destroy()
 *
 * @return bool
 */
public function destroy() {
return $this->pushNotification->where ( 'id', $this->request->id )->update ( array (
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
   'pushSingleInfo' => $this->pushNotification->where ( 'id', $id )->first (),
   'rules' => array (
     'name' => 'required',
     'subject' => 'required',
     'body' => 'required',
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
     'body' => 'required',
   )
 );
}
}
