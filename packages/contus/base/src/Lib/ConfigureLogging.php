<?php
/**
 * ConfigureLogging
 *
 * @name       Moverbee
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Contus\Base\Lib;

use Illuminate\Log\Writer;
use Monolog\Logger as Monolog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\ConfigureLogging as IlluminateConfigureLogging;

class ConfigureLogging extends IlluminateConfigureLogging{
    /**
     * Configure the Monolog handlers for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Log\Writer  $log
     * @return void
     */
    protected function configureSingleHandler(Application $app, Writer $log){
        $log->useFiles(
            $app->storagePath().'/logs/admin_laravel.log',
            $app->make('config')->get('app.log_level', 'debug')
        );
    }
    /**
     * Configure the Monolog handlers for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Log\Writer  $log
     * @return void
     */
    protected function configureDailyHandler(Application $app, Writer $log){
        $config = $app->make('config');

        $maxFiles = $config->get('app.log_max_files');

        $log->useDailyFiles(
            $app->storagePath().'/logs/admin_laravel.log', is_null($maxFiles) ? 5 : $maxFiles,
            $config->get('app.log_level', 'debug')
        );
    }
}
