<?php
class ControllerExtensionModuleRequireLogin extends Controller {
    public function __construct($registry) {
        parent::__construct($registry);

        $this->load->model('setting/setting');
        $setting = $this->model_setting_setting->getSetting('module_require_login');

        if ($setting['module_require_login_enabled']==1)
        {
        
            $allowed[] = $setting['module_require_login_redirect_page'];
            foreach($setting['module_require_login_allowed_pages'] as $page){
                $allowed[]=$page;
            }

            $route = '';
            if(isset($this->request->get['route']))
            {
                $route = $this->request->get['route'];
            }

            if (!in_array($route,$allowed) && !$this->customer->isLogged()){
               $this->response->redirect($this->url->link('account/login','',''));
            }
        }
    }
}