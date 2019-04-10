<?php

class ControllerExtensionModuleRequireLogin extends Controller {
    
    public function __construct($registry) {
        parent::__construct($registry);
        $setting = $this->model_setting_setting->getSetting('module_require_login');

        if ($setting['module_require_login_enabled']==1)
        {
        
            $allowed[] = $setting['module_require_login_redirect_page'];
            foreach($setting['module_require_login_allowed_pages'] as $page)
            {
                $allowed[]=$page;
            }
            if (!in_array($this->request->get['route'],$allowed) && !$this->customer->isLogged())
            {
                $this->response->redirect($this->url->link('account/login','', ''));
            }
        }
    }

    
}