<?php
/**
 * Settings Controller
 *
 * To manage admin settings related actions.
 *
 * @name       Settings Controller
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Apptha\Http\Controllers\Web;

use Contus\Base\Controllers\Controller;
use Apptha\Repositories\SettingCategoryRepository;
use Apptha\Repositories\SettingRepository;

class SettingsController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(SettingCategoryRepository $settingCategoryRepository, SettingRepository $settings ) {
    $this->_settingCategoryRepository = $settingCategoryRepository;
    $this->_settingRepository = $settings;
    $this->_settingRepository->setRequestType ('HTTP');
    $this->request = app('request');
    view ()->share ( 'includeAngularNotification', false);
  }
  /**
   * Method to get the list of setting categories and setting fields.
   * 
   * @return \Illuminate\Http\View
   */
  public function listSettingCategories() {
    return view ( 'settings.settings', [ 
        'settingCategories' => $this->_settingCategoryRepository->getSettingCategories (),
        'settingsField' => $this->_settingRepository->getSettings(),
    ] );
  }
  /**
   * Method to update settings fields data into settings table
   * 
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateSettings(){
    $this->_settingRepository->updateSettings();
    return redirect('/settings')->with('success','Settings updated successfully');
  }
}