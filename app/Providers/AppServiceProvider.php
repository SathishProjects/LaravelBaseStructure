<?php

/**
 * App service provider for Web & Api
 *
 * @name       AppServiceProvider
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider {
  /**
   * Set the application name and settings.
   *
   * @return void
   */
  public function boot() {
    $this->setSettingToConfig ();

    view ()->share ( 'isRouteActive', function ($routePath) {
     $class = 'nav-active';
     if (! is_array ( $routePath )) {
      $routePath = [
        $routePath
      ];
      $class = 'active';
     }
     foreach ( $routePath as $value ) {
      if ((str_is ( "$value/*", app('request')->path () ) || str_is ( "$value", app('request')->path ()))) {
       return $class;
      }
     }
    } );
    
    view ()->share ( 'includeAngularNotification', true);
  }
  /**
   * Method used to set the config values from cache file.
   *
   * While updating the setting datas from admin side the cache file will be generated.
   *
   * All the setting data stored in JSON format under the storage path
   *
   * @return void
   */
  public function setSettingToConfig() {
    $fileSystem = app ()->make ( 'files' );
    $filePath = config ( 'apptha.setting_cache_file_path' );
  
    if ($filePath && $fileSystem->exists ( $filePath )) {
      config ()->set ( 'settings', json_decode ( $fileSystem->get ( $filePath ), true ) );
    }
  }
}
