<?php
/**
 * TemplateController
 *
 * Common Template controller reponse templete for various modules
 *
 * @name       TemplateController
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Web;

class TemplateController extends WebController{
    /**
    * Make Reponse module index
    *
    * @param string $module
    * @return \Illuminate\Http\Response
    */
    public function getModuleTemplate($module) {
      $resource = "$module.index";
      return view()->exists($resource) ? view($resource) : response(trans(MESSAGE_RESOURCE_NOT_EXISTS),404);
    }
    /**
    * Make Reponse module grid
    *
    * @param string $module
    * @return \Illuminate\Http\Response
    */
    public function getModuleGrid($module) {
      $resource = "$module.grid";
      return view()->exists($resource) ? view($resource) : response(trans(MESSAGE_RESOURCE_NOT_EXISTS),404);
    }
    /**
     * Make Reponse module action
     *
     * @param string $module
     * @param string $action
     * @return \Illuminate\Http\Response
     */
    public function getActionTemplate($module,$action,$id = null) {
      $resource = "$module.$action";
      return view()->exists($resource) ? view($resource, array('id'=>$id)) : response(trans(MESSAGE_RESOURCE_NOT_EXISTS),404);
    }    
}
