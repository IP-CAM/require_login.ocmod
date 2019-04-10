<?php
class ControllerExtensionModuleRequireLogin extends Controller {

    private $error = array();

    public function index()
    {
        $this->load->language('extension/module/require_login');
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('extension/module/require_login');
        $this->load->model('setting/setting');
        

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_require_login', $this->request->post);
            
            // var_dump($this->request->post);

			// $this->session->data['success'] = $this->language->get('text_success');

			// $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
        
        
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

       $data += $this->model_setting_setting->getSetting('module_require_login');

        $this->response->setOutput($this->load->view('extension/module/requirelogin', $data));
    }    
    public function install() {
        $this->load->model('extension/module/require_login');
        $this->model_extension_module_require_login->install();
    }
    public function uninstall() {
        $this->load->model('extension/module/require_login');
        $this->model_extension_module_require_login->uninstall();
    }
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/require_login')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>