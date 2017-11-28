<?php
/**
 * Middleware for EncryptCookies
 *
 * @name       EncryptCookies
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter {
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
       
    ];
}
