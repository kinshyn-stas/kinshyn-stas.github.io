<?php
class ControllerExtensionModuleCheaper extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('extension/module/cheaper');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('view/stylesheet/cheaper.css');

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('cheaper', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['text_select'] = $this->language->get('text_select');
		$data['text_settings'] = $this->language->get('text_settings');
		$data['text_h1_module'] = $this->language->get('text_h1_module');
		$data['text_h4_module'] = $this->language->get('text_h4_module');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_phone'] = $this->language->get('text_phone');
		$data['text_desired_price'] = $this->language->get('text_desired_price');
		$data['text_search_cheaper'] = $this->language->get('text_search_cheaper');
		$data['text_succes'] = $this->language->get('text_succes');
		$data['text_error'] = $this->language->get('text_error');
		
		$data['column_select'] = $this->language->get('column_select');
		$data['column_special'] = $this->language->get('column_special');
		$data['column_new_product'] = $this->language->get('column_new_product');
		$data['column_popular'] = $this->language->get('column_popular');
		$data['column_bestseller'] = $this->language->get('column_bestseller');
		$data['entry_sticker_module_bestseller'] = $this->language->get('entry_sticker_module_bestseller');
		$data['entry_sticker_module_featured'] = $this->language->get('entry_sticker_module_featured');
		$data['entry_sticker_module_latest'] = $this->language->get('entry_sticker_module_latest');
		$data['entry_sticker_module_special'] = $this->language->get('entry_sticker_module_special');
		$data['entry_sticker_categories'] = $this->language->get('entry_sticker_categories');
		$data['entry_sticker_manufacturer'] = $this->language->get('entry_sticker_manufacturer');
		$data['entry_sticker_product'] = $this->language->get('entry_sticker_product');
		$data['entry_sticker_product_related'] = $this->language->get('entry_sticker_product_related');
		$data['entry_sticker_search'] = $this->language->get('entry_sticker_search');
		$data['entry_sticker_special'] = $this->language->get('entry_sticker_special');
		
		$data['protection'] = $this->language->get('protection');
		$data['help_protection'] = $this->language->get('help_protection');
		$data['help_cod_protection'] = $this->language->get('help_cod_protection');
		$data['protection_no_base'] = $this->language->get('protection_no_base');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['cheaper_h1_module'])) {
			$data['error_cheaper_h1_module'] = $this->error['cheaper_h1_module'];
		} else {
			$data['error_cheaper_h1_module'] = '';
		}
		
		if (isset($this->error['cheaper_h4_module'])) {
			$data['error_cheaper_h4_module'] = $this->error['cheaper_h4_module'];
		} else {
			$data['error_cheaper_h4_module'] = '';
		}
		
		if (isset($this->error['cheaper_namet'])) {
			$data['error_cheaper_namet'] = $this->error['cheaper_namet'];
		} else {
			$data['error_cheaper_namet'] = '';
		}
		
		if (isset($this->error['cheaper_phone'])) {
			$data['error_cheaper_phone'] = $this->error['cheaper_phone'];
		} else {
			$data['error_cheaper_phone'] = '';
		}
		
		if (isset($this->error['cheaper_desired_price'])) {
			$data['error_cheaper_desired_price'] = $this->error['cheaper_desired_price'];
		} else {
			$data['error_cheaper_desired_price'] = '';
		}
		
		if (isset($this->error['cheaper_search_cheaper'])) {
			$data['error_cheaper_search_cheaper'] = $this->error['cheaper_search_cheaper'];
		} else {
			$data['error_cheaper_search_cheaper'] = '';
		}
		
		if (isset($this->error['cheaper_succes'])) {
			$data['error_cheaper_succes'] = $this->error['cheaper_succes'];
		} else {
			$data['error_cheaper_succes'] = '';
		}
		
		if (isset($this->error['cheaper_errort'])) {
			$data['error_cheaper_errort'] = $this->error['cheaper_errort'];
		} else {
			$data['error_cheaper_errort'] = '';
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
			'href' => $this->url->link('extension/module/cheaper', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/cheaper', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['cheaper_protection_cod'])) {
			$data['cheaper_protection_cod'] = $this->request->post['cheaper_protection_cod'];
		} else {
			if ($this->config->get('cheaper_protection_cod')) {
				$data['cheaper_protection_cod'] = $this->config->get('cheaper_protection_cod');
			} else {
				$data['cheaper_protection_cod'] = false;
			}
		}
		
		if (isset($this->request->post['cheaper_h1_module'])) {
			$data['cheaper_h1_module'] = $this->request->post['cheaper_h1_module'];
		} else {
			if ($this->config->get('cheaper_h1_module')) {
				$data['cheaper_h1_module'] = $this->config->get('cheaper_h1_module');
			} else {
				$data['cheaper_h1_module'] = $this->language->get('input_h1_module');
			}
		}
		
		if (isset($this->request->post['cheaper_h4_module'])) {
			$data['cheaper_h4_module'] = $this->request->post['cheaper_h4_module'];
		} else {
			if ($this->config->get('cheaper_h4_module')) {
				$data['cheaper_h4_module'] = $this->config->get('cheaper_h4_module');
			} else {
				$data['cheaper_h4_module'] = $this->language->get('input_h4_module');
			}
		}
		
		if (isset($this->request->post['cheaper_namet'])) {
			$data['cheaper_namet'] = $this->request->post['cheaper_namet'];
		} else {
			if ($this->config->get('cheaper_namet')) {
				$data['cheaper_namet'] = $this->config->get('cheaper_namet');
			} else {
				$data['cheaper_namet'] = $this->language->get('input_name');
			}
		}
		
		if (isset($this->request->post['cheaper_phone'])) {
			$data['cheaper_phone'] = $this->request->post['cheaper_phone'];
		} else {
			if ($this->config->get('cheaper_phone')) {
				$data['cheaper_phone'] = $this->config->get('cheaper_phone');
			} else {
				$data['cheaper_phone'] = $this->language->get('input_phone');
			}
		}
		
		if (isset($this->request->post['cheaper_desired_price'])) {
			$data['cheaper_desired_price'] = $this->request->post['cheaper_desired_price'];
		} else {
			if ($this->config->get('cheaper_desired_price')) {
				$data['cheaper_desired_price'] = $this->config->get('cheaper_desired_price');
			} else {
				$data['cheaper_desired_price'] = $this->language->get('input_desired_price');
			}
		}
		
		if (isset($this->request->post['cheaper_search_cheaper'])) {
			$data['cheaper_search_cheaper'] = $this->request->post['cheaper_search_cheaper'];
		} else {
			if ($this->config->get('cheaper_search_cheaper')) {
				$data['cheaper_search_cheaper'] = $this->config->get('cheaper_search_cheaper');
			} else {
				$data['cheaper_search_cheaper'] = $this->language->get('input_search_cheaper');
			}
		}
		
		if (isset($this->request->post['cheaper_succes'])) {
			$data['cheaper_succes'] = $this->request->post['cheaper_succes'];
		} else {
			if ($this->config->get('cheaper_succes')) {
				$data['cheaper_succes'] = $this->config->get('cheaper_succes');
			} else {
				$data['cheaper_succes'] = $this->language->get('input_succes');
			}
		}
		
		if (isset($this->request->post['cheaper_errort'])) {
			$data['cheaper_errort'] = $this->request->post['cheaper_errort'];
		} else {
			if ($this->config->get('cheaper_errort')) {
				$data['cheaper_errort'] = $this->config->get('cheaper_errort');
			} else {
				$data['cheaper_errort'] = $this->language->get('input_error');
			}
		}

		if (isset($this->request->post['cheaper_status'])) {
			$data['cheaper_status'] = $this->request->post['cheaper_status'];
		} else {
			$data['cheaper_status'] = $this->config->get('cheaper_status');
		}
		
		if (isset($this->request->post['cheaper_ssmb'])) {
			$data['cheaper_ssmb'] = $this->request->post['cheaper_ssmb'];
		} else {
			if ($this->config->get('cheaper_ssmb')) {
				$data['cheaper_ssmb'] = $this->config->get('cheaper_ssmb');
			} else {
				$data['cheaper_ssmb'] = 0;
			}
		}
		
		if (isset($this->request->post['cheaper_ssmf'])) {
			$data['cheaper_ssmf'] = $this->request->post['cheaper_ssmf'];
		} else {
			if ($this->config->get('cheaper_ssmf')) {
				$data['cheaper_ssmf'] = $this->config->get('cheaper_ssmf');
			} else {
				$data['cheaper_ssmf'] = 0;
			}
		}
		
		
		if (isset($this->request->post['cheaper_ssml'])) {
			$data['cheaper_ssml'] = $this->request->post['cheaper_ssml'];
		} else {
			if ($this->config->get('cheaper_ssml')) {
				$data['cheaper_ssml'] = $this->config->get('cheaper_ssml');
			} else {
				$data['cheaper_ssml'] = 0;
			}
		}
		
		if (isset($this->request->post['cheaper_ssms'])) {
			$data['cheaper_ssms'] = $this->request->post['cheaper_ssms'];
		} else {
			if ($this->config->get('cheaper_ssms')) {
				$data['cheaper_ssms'] = $this->config->get('cheaper_ssms');
			} else {
				$data['cheaper_ssms'] = 0;
			}
		}

		if (isset($this->request->post['cheaper_ssc'])) {
			$data['cheaper_ssc'] = $this->request->post['cheaper_ssc'];
		} else {
			if ($this->config->get('cheaper_ssc')) {
				$data['cheaper_ssc'] = $this->config->get('cheaper_ssc');
			} else {
				$data['cheaper_ssc'] = 0;
			}
		}

		if (isset($this->request->post['cheaper_ssm'])) {
			$data['cheaper_ssm'] = $this->request->post['cheaper_ssm'];
		} else {
			if ($this->config->get('cheaper_ssm')) {
				$data['cheaper_ssm'] = $this->config->get('cheaper_ssm');
			} else {
				$data['cheaper_ssm'] = 0;
			}
		}

		if (isset($this->request->post['cheaper_ssp'])) {
			$data['cheaper_ssp'] = $this->request->post['cheaper_ssp'];
		} else {
			if ($this->config->get('cheaper_ssp')) {
				$data['cheaper_ssp'] = $this->config->get('cheaper_ssp');
			} else {
				$data['cheaper_ssp'] = 0;
			}
		}

		if (isset($this->request->post['cheaper_sspr'])) {
			$data['cheaper_sspr'] = $this->request->post['cheaper_sspr'];
		} else {
			if ($this->config->get('cheaper_sspr')) {
				$data['cheaper_sspr'] = $this->config->get('cheaper_sspr');
			} else {
				$data['cheaper_sspr'] = 0;
			}
		}

		if (isset($this->request->post['cheaper_sss'])) {
			$data['cheaper_sss'] = $this->request->post['cheaper_sss'];
		} else {
			if ($this->config->get('cheaper_sss')) {
				$data['cheaper_sss'] = $this->config->get('cheaper_sss');
			} else {
				$data['cheaper_sss'] = 0;
			}
		}
		if (isset($this->request->post['cheaper_ssspec'])) {
			$data['cheaper_ssspec'] = $this->request->post['cheaper_ssspec'];
		} else {
			if ($this->config->get('cheaper_ssspec')) {
				$data['cheaper_ssspec'] = $this->config->get('cheaper_ssspec');
			} else {
				$data['cheaper_ssspec'] = 0;
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/cheaper', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/cheaper')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_h1_module']) < 3) || (utf8_strlen($this->request->post['cheaper_h1_module']) > 300)) {
			$this->error['cheaper_h1_module'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_h4_module']) < 3) || (utf8_strlen($this->request->post['cheaper_h4_module']) > 300)) {
			$this->error['cheaper_h4_module'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_namet']) < 3) || (utf8_strlen($this->request->post['cheaper_namet']) > 300)) {
			$this->error['cheaper_namet'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_phone']) < 3) || (utf8_strlen($this->request->post['cheaper_phone']) > 300)) {
			$this->error['cheaper_phone'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_desired_price']) < 3) || (utf8_strlen($this->request->post['cheaper_desired_price']) > 300)) {
			$this->error['cheaper_desired_price'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_search_cheaper']) < 3) || (utf8_strlen($this->request->post['cheaper_search_cheaper']) > 300)) {
			$this->error['cheaper_search_cheaper'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_succes']) < 3) || (utf8_strlen($this->request->post['cheaper_succes']) > 300)) {
			$this->error['cheaper_succes'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['cheaper_errort']) < 3) || (utf8_strlen($this->request->post['cheaper_errort']) > 300)) {
			$this->error['cheaper_errort'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}