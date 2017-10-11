<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com  		   #
################################################################################################
class ControllerExtensionModuleSalesAutopilot extends Controller { 
	
	private $error = array(); 
	
	public function index() {   
		//Load the language file for this module
		$this->load->language('extension/module/salesautopilot');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('salesautopilot', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			//$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		//This is how the language gets pulled through from the language file.
		//
		// If you want to use any extra language items - ie extra text on your admin page for any reason,
		// then just add an extra line to the $text_strings array with the name you want to call the extra text,
		// then add the same named item to the $_[] array in the language file.
		//
		// 'salesautopilot_example' is added here as an example of how to add - see admin/language/english/module/salesautopilot.php for the
		// other required part.
		
		//$data = array_merge($data, $this->load->language('module/salesautopilot'));
		//END LANGUAGE
		
		//The following code pulls in the required data from either config files or user
		//submitted data (when the user presses save in admin). Add any extra config data
		// you want to store.
		//
		// NOTE: These must have the same names as the form data in your salesautopilot.tpl file
		//
		$config_data = array(
				'salesautopilot_example' //this becomes available in our view by the foreach loop just below.
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				$data[$conf] = $this->config->get($conf);
			}
		}
	
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		// Assign the language data for parsing it to view
        $data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit']    = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');      
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');
     
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
     
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['entry_salesautopilot_username'] = $this->language->get('entry_salesautopilot_username');
        $data['entry_salesautopilot_password'] = $this->language->get('entry_salesautopilot_password');
        $data['entry_salesautopilot_listid'] = $this->language->get('entry_salesautopilot_listid');
        $data['entry_salesautopilot_formid'] = $this->language->get('entry_salesautopilot_formid');
        $data['entry_debug'] = $this->language->get('entry_debug');
		
		//SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS UNLESS YOU CHANGE YOUR MODULE NAME.
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module/salesautopilot', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/salesautopilot', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/module/salesautopilot', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['salesautopilot_status'])) {
			$data['salesautopilot_status'] = $this->request->post['salesautopilot_status'];
		} else {
			$data['salesautopilot_status'] = $this->config->get('salesautopilot_status');
		}

		if (isset($this->request->post['salesautopilot_username'])) {
			$data['salesautopilot_username'] = $this->request->post['salesautopilot_username'];
		} else {
			$data['salesautopilot_username'] = $this->config->get('salesautopilot_username');
		}
		
		if (isset($this->request->post['salesautopilot_password'])) {
			$data['salesautopilot_password'] = $this->request->post['salesautopilot_password'];
		} else {
			$data['salesautopilot_password'] = $this->config->get('salesautopilot_password');
		}
		
		if (isset($this->request->post['salesautopilot_listid'])) {
			$data['salesautopilot_listid'] = $this->request->post['salesautopilot_listid'];
		} else {
			$data['salesautopilot_listid'] = $this->config->get('salesautopilot_listid');
		}
		
		if (isset($this->request->post['salesautopilot_formid'])) {
			$data['salesautopilot_formid'] = $this->request->post['salesautopilot_formid'];
		} else {
			$data['salesautopilot_formid'] = $this->config->get('salesautopilot_formid');
		}
		
		if (isset($this->request->post['salesautopilot_debug'])) {
			$data['salesautopilot_debug'] = $this->request->post['salesautopilot_debug'];
		} else {
			$data['salesautopilot_debug'] = $this->config->get('salesautopilot_debug');
		}

	
		//This code handles the situation where you have multiple instances of this module, for different layouts.
		$data['modules'] = array();
		
		if (isset($this->request->post['salesautopilot_module'])) {
			$data['modules'] = $this->request->post['salesautopilot_module'];
		} elseif ($this->config->get('salesautopilot_module')) { 
			$data['modules'] = $this->config->get('salesautopilot_module');
		}		

		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		//Choose which template file will be used to display this request.
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		//Send the output.
		$this->response->setOutput($this->load->view('extension/module/salesautopilot.tpl', $data));
	}
	
	/*
	 * 
	 * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
	 * You can add checks in here of your own.
	 * 
	 */
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/salesautopilot')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	/**
	  * Install checkout event 
	  */
	public function install() {
		$this->load->model('extension/event');
		$this->model_extension_event->addEvent('salesautopilot', 'post.order.history.add', 'module/salesautopilot/index');
	}

	/**
	  * Uninstall checkout event 
	  */
	public function uninstall() {
		$this->load->model('extension/event');
		$this->model_extension_event->deleteEvent('salesautopilot');
	}
}
?>