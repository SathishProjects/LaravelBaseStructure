<?php
/**
 * Base service provider service
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Contus\Base;

use Illuminate\Http\Request;
use Barryvdh\Cors\HandleCors;
use Barryvdh\Cors\HandlePreflightSimple;
use Barryvdh\Cors\LumenServiceProvider;

class CorsServiceProvider extends LumenServiceProvider{
    /**
     * Add the Cors middleware to the router.
     * and made sure directory access from browser
     * is taken care
     */
    public function boot(){
        $this->app->routeMiddleware(['cors' => HandleCors::class]);

        $request = app(Request::class);

        if($request->isMethod('OPTIONS')) {
            $appURI = env('API_URI','order');
    
            $this->app->options($appURI.'/'.$request->path(),function(){
                return response('OK', 200);
            });

            $this->app->middleware([HandlePreflightSimple::class]);
        }
    }
}
