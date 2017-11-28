<?php

/**
 * WebController
 *
 * To manage ui and template request
 *
 * @name       ApiController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Web;

use Illuminate\Http\Request;
use Apptha\Http\Controllers\Controller;

abstract class WebController extends Controller {
  /**
   * The auth registered on Base Controller.
   *
   * @var object
   */
  protected $auth;
  /**
   * The class property to hold the logger object
   *
   * @var object
   */
  protected $logger;
  /**
   * class intializer
   *
   * @return void
   */
  public function __construct() {
    $this->auth = app ()->make ( 'auth');
    $this->logger = app ()->make ( 'log' );
  }
}