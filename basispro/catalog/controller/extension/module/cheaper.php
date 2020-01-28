<?php 
class ControllerExtensionModuleCheaper extends Controller {
	public function cheaperform() {

		$this->load->language('extension/module/cheaper');
		$this->load->model('tool/image');
		
		$this->load->model('setting/setting');
		$settings = $this->model_setting_setting->getSetting('cheaper');

		if ($settings['cheaper_h1_module']!="") {$data['text_cheaper'] = $settings['cheaper_h1_module'];} else {$data['text_cheaper'] = $this->language->get('text_cheaper');}
		if ($settings['cheaper_h4_module']!="") {$data['help_text_cheaper'] = $settings['cheaper_h4_module'];} else {$data['help_text_cheaper'] = $this->language->get('help_text_cheaper');}
		if ($settings['cheaper_namet']!="") {$data['name_msg'] = $settings['cheaper_namet'];} else {$data['name_msg'] = $this->language->get('input_name');}
		if ($settings['cheaper_phone']!="") {$data['telefon'] = $settings['cheaper_phone'];} else {$data['telefon'] = $this->language->get('input_phone');}
		if ($settings['cheaper_desired_price']!="") {$data['text_desired_price'] = $settings['cheaper_desired_price'];} else {$data['text_desired_price'] = $this->language->get('text_desired_price');}
		if ($settings['cheaper_search_cheaper']!="") {$data['text_search_cheaper'] = $settings['cheaper_search_cheaper'];} else {$data['text_search_cheaper'] = $this->language->get('text_search_cheaper');}

		$data['message'] = $this->language->get('message');
		$data['send'] = $this->language->get('send');
		$data['subject'] = $this->language->get('subject');
		$data['recievedMsg'] = $this->language->get('recievedMsg');
		$data['notRecievedMsg'] = $this->language->get('notRecievedMsg');
		
		if (isset($this->request->get['product_id'])) {
			$data['product_id'] = (int)$this->request->get['product_id'];
		} else {
			$data['product_id'] = 0;
		}
		
		$this->load->model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($data['product_id']);
		
		if ($product_info['image']) {
			$data['image'] = $this->model_tool_image->resize($product_info['image'], 50, 50);
		} else {
			$data['image'] = $this->model_tool_image->resize('placeholder.png', 50, 50);
		}
		
		$data['name'] = $product_info['name'];
		
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['price'] = false;
		}

		if ((float)$product_info['special']) {
			$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['special'] = false;
		}
		
		$data['href_tovar'] = $this->url->link('product/product', '&product_id=' . $data['product_id']);

		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/extension/module/cheaper.tpl', $data));
		
	}
	
	public function cheapermailsend() {
		$this->load->language('extension/module/cheaper');
		
		$data['name_klient'] = $this->language->get('name_klient');
		$data['telefon_klient'] = $this->language->get('telefon_klient');
		$data['tovar_klient'] = $this->language->get('tovar_klient');
		$data['href_tovar_klient'] = $this->language->get('href_tovar_klient');
		$data['message_klient'] = $this->language->get('message_klient');
		$data['text_desired_price'] = $this->language->get('text_desired_price');
		$data['text_search_cheaper'] = $this->language->get('text_search_cheaper');
		$data['text_price_tovar'] = $this->language->get('text_price_tovar');
		
		$data['to'] = $this->config->get('config_email');
		
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		
		$this->load->model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($product_id);
		
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['price'] = false;
		}

		if ((float)$product_info['special']) {
			$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
		} else {
			$data['special'] = false;
		}
		
		$data['price_tovar'] = 0;
		
		if (!$data['special']) {$data['price_tovar'] = $data['price'];} else {$data['price_tovar'] = $data['special'];}
		
		$data['name_tovar'] = $product_info['name'];
		$data['href_tovar'] = $this->url->link('product/product', '&product_id=' . $product_id);
		
		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/extension/module/cheapermail.tpl', $data));
	}

}
;