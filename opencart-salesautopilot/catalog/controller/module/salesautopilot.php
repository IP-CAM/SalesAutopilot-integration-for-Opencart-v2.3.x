<?php 
class ControllerModuleSalesAutopilot extends Controller { 
	public function index($order_id) { 

		if ($this->config->get('salesautopilot_status') && $this->config->get('salesautopilot_username') != '' && $this->config->get('salesautopilot_password') != '' 
			&& is_numeric($this->config->get('salesautopilot_listid')) && is_numeric($this->config->get('salesautopilot_formid'))) {
			
			if ($this->config->get('salesautopilot_debug')) {
				$this->log->write("SalesAutopilot DEBUG: Send order to SalesAutopilot");

			}
			$this->load->model('checkout/salesautopilot');
			$order_id = $this->session->data['order_id'];

			$orderData = $this->model_checkout_salesautopilot->getOrderInfo($order_id);

			$headers = array(
				'Accept: application/json',
				'Content-Type: application/json'
			);
			$url = 'http://'.$this->config->get('salesautopilot_username').':'.$this->config->get('salesautopilot_password').'@restapi.emesz.com/processWebshopOrder/'.$this->config->get('salesautopilot_listid').'/ns_id/'.$this->config->get('salesautopilot_formid');
			
			$handle = curl_init();
			curl_setopt($handle, CURLOPT_URL, $url);
			curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_USERAGENT, 'Opencart SalesAutopilot Module');
			curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($handle, CURLOPT_POST, true);
			curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($orderData));
			
			$response = curl_exec($handle);
			$info = curl_getinfo($handle);
			//print_r($info);
			if ($this->config->get('salesautopilot_debug')) {
				if ($info['http_code'] == 200) {
					$this->log->write("SalesAutopilot DEBUG: Order successfully sent");
				} else {
					$this->log->write("SalesAutopilot DEBUG: Order can't send through API, respnose code: ".$info['http_code']);
				}
			}
		}
	}
}	
?>