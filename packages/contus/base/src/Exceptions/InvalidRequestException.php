<?php
/**
 * invalid request exception
 * thrown while invalid request is found on various logics
 *
 * @name       InvalidRequestException
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Contus\Base\Exceptions;

use Illuminate\Routing\UrlGenerator;
use Contus\Base\Traits\ResponseHandler;
use Illuminate\Http\Exception\HttpResponseException;

class InvalidRequestException extends HttpResponseException {
  use ResponseHandler;
  /**
   * Class property to hold the message
   *
   * @var string
   */
  protected $message = 500;
  /**
   * Class property to hold the status
   *
   * @var int
   */
  protected $statusCode = 500;
  /**
   * Class property to hold the data need to be sent while exception thrown
   *
   * @var array
   */
  protected $data;
  /**
   * class intializer
   *
   * @param string $message
   * @param int $statusCode
   * @param array $data
   * @return void
   */
  public function __construct($message,$statusCode,array $data = []) {
     $this->message = $message;
     $this->statusCode = $statusCode;
     $this->data = $data;
  } 
  /**
   * Get the underlying response instance.
   *
   * @return \Illuminate\Http\Response
   */
  public function getResponse(){
  	if(app('repository.requestype') == 'HTTP'){
  		$response = redirect()->to(app(UrlGenerator::class)->previous())->withErrors($this->message);
  	} else {
  		$response = $this->getErrorJsonResponse ($this->data, $this->message,$this->statusCode);
  	}
  	
  	return $response;
  }     
}