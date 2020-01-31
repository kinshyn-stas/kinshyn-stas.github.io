<?php
class ControllerExtensionModulePopupProductSV extends Controller {
	private $error = array(); 
	
	public function index() {   
		$data = $this->load->language('extension/module/popup_product_sv');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('popup_product_sv', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
				
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['image_width'])) {
			$data['error_image_width'] = $this->error['image_width'];
		} else {
			$data['error_image_width'] = '';
		}

 		if (isset($this->error['image_height'])) {
			$data['error_image_height'] = $this->error['image_height'];
		} else {
			$data['error_image_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/popup_product_sv', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/popup_product_sv', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);


		if (isset($this->request->post['popup_product_sv'])) {
			$data['popup_product_sv'] = $this->request->post['popup_product_sv'];
		} elseif ($this->config->get('popup_product_sv')) { 
			$data['popup_product_sv'] = $this->config->get('popup_product_sv');
		}	else {
      $data['popup_product_sv'] = array(
       'image_width' => $this->config->get('config_image_product_width'),
       'image_height' => $this->config->get('config_image_product_height'),
       'status' => 0
      );
    }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/popup_product_sv', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/popup_product_sv')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
    
    $this->request->post['popup_product_sv']['image_width'] = (int)$this->request->post['popup_product_sv']['image_width'];
    if (!$this->request->post['popup_product_sv']['image_width']) {
      $this->error['image_width'] = $this->language->get('error_image_width');
    }
		
    $this->request->post['popup_product_sv']['image_height'] = (int)$this->request->post['popup_product_sv']['image_height'];
    if (!$this->request->post['popup_product_sv']['image_height']) {
      $this->error['image_height'] = $this->language->get('error_image_height');
    }

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
  
  public function install() {
    $this->installEvents();
  }
  
  public function uninstall() {
    $this->uninstallEvents();
  }
  
  public function installEvents() {
    $this->load->model('extension/event');

    $result = $this->db->query("SELECT COUNT(*) as `total` FROM `" . DB_PREFIX . "event` WHERE `code` = 'popup_product_sv'");
    if (!$result->row['total']) {
      $this->model_extension_event->addEvent('popup_product_sv', 'catalog/controller/common/header/before', 'extension/module/popup_product_sv/addScript');
    }
  }
  
  public function uninstallEvents() {
    $this->load->model('extension/event');
    $this->model_extension_event->deleteEvent('popup_product_sv');
  }
}
?>