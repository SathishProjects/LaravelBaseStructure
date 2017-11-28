<?php

/**
 * Notification List Repository
 *
 * To manage notification lists related actions.
 *
 * @name       MoverBee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Repositories;

use Illuminate\Database\QueryException;
use Apptha\Models\NotificationList;
use Contus\Base\Repositories\Repository;
use Contus\Base\Exceptions\InvalidRequestException;

class NotificationListRepository extends Repository {

/**
 * Class initializer
 *
 * @return void
 */
public function __construct(NotificationList $notificationList) {
 parent::__construct ();
 $this->notificationList = $notificationList;
}

/**
 * This method is use to update the notificatio list table
 *
 * @see \Contus\Base\Contracts\ResourceInterface::update()
 * @return boolean
 */
public function update() {
	/**
	 * Set the rules
	 */
	$this->setRules ( [
			'id' => 'required'			
	] );
	/**
	 * Validate the fields
	 */
	$this->_validate ();	
	if($this->notificationList->where('id',$this->request->input('id'))->first()) {
		$this->notificationList->where('id',$this->request->input('id'))->update(array(
				'is_read' => 1
		));
		return true;
	} else {
		return false;
	}
}

/**
 * Prepare the grid
 * set the grid model and relation model to be loaded
 *
 * @return \Contus\Base\Repositories\Repository
 */
public function prepareGrid() {
 $this->setGridModel ( $this->notificationList );
 return $this;
}

/**
 * Update grid records collection query
 *
 * @param mixed $builder
 * @return mixed
 */
protected function updateGridQuery($builder) {
	if(($filters = $this->request->input('filters')) && is_array($filters)){
		foreach ($filters as $key => $value) {
			switch ($key) {
				case 'user_type':
					$builder->where('user_type',$value);
					break;
				case 'from_user_id':
					$builder->where('from_user_id',$value);
					break;
				case 'to_user_id':
					$builder->where('to_user_id',$value);
					break;
				case 'service_type':
					$builder->where('service_type',$value);
					break;
				default:
					break;
			}
		}
	}
	return $builder;
}
}