<?php

class ModelExtensionModuleRequireLogin extends Model {

    private $events = array(
        'catalog/view/common/header/after' => array(
            'extension/module/require_login/redirect'
        ));

    public function install() {
        $this->load->model('setting/setting');
        $this->load->model('setting/event');
        $settings = array(
            'module_require_login_enabled' => 0,
            'module_require_login_redirect_page' => 'account/login',
            'module_require_login_allowed_pages' => 
                array('account/register','account/forgotten')
        );
        $this->model_setting_setting->editSetting('module_require_login', $settings);
        $this->model_setting_event->addEvent('module_require_login', 'catalog/view/common/header/after', 'extension/module/require_login/redirect');
    }
    public function uninstall() {
        $this->load->model('setting/event');
        $this->model_setting_event->deleteEventByCode('module_require_login');
    }
}