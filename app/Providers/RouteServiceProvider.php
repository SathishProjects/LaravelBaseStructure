<?php
/**
 * To manage seperate route service provider for Web & Api
 *
 * @name       RouteServiceProvider
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Apptha\Http\Controllers';
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes ();
        $this->mapWebRoutes ();
        /** Check the mobile app request */
        app()->singleton('isMobileAppRequest', function(){
          return $this->isMobileAppRequest();
        });
    }
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::group ( [ 
                'middleware' => 'web',
                'namespace' => 'Apptha\Http\Controllers\Web' 
        ], function () {
            require base_path ( 'routes/web.php' );
        } );
    }
    /**
     * Check current request is for Mobile APP
     * Check this by header, HTTP_X-MOVERBEE-MOBILE should be in the request header
     *
     * @return bool
     */
    private function isMobileAppRequest(){
      $isMobileApp = false;
      if(!is_null($this->app['request']->header('HTTP_X-MOVERBEE-MOBILE')) && $this->app['request']->header('HTTP_X-MOVERBEE-MOBILE') == 'Yes') {
        $isMobileApp = true;
      }
      return $isMobileApp;
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::group ( [ 
                'middleware' => 'api',
                'namespace' => 'Apptha\Http\Controllers\Api',
                'prefix' => 'api' 
        ], function () {
            require base_path ( 'routes/api.php' );
        } );
    }
}