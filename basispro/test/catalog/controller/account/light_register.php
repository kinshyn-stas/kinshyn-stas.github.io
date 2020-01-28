<?php
class ControllerAccountLightRegister extends Controller {
	private $error = array();

	public function index() {

		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$this->load->language('account/register');
		$this->load->language('account/light');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/locale/'.$this->session->data['language'].'.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('account/customer');
        $this->load->model('account/light');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $post_data = $this->request->post;
            
            $post_data += array(
                'firstname' => '',
                'lastname' => '',
                'email' => 'empty@localhost',
                'telephone' => '',
                'fax' => '',
                'address_1' => '',
                'address_2' => '',
                'city' => '',
                'country_id' => '',
                'zone_id' => '',
                'postcode' => '',
                'company' => '',
            );

            if (isset($post_data)) {
                foreach ($post_data['light_field'] as $key => $light_field_id) {
                    if (isset($light_field_id)) {
                        $light_field_to_standart_fields = $this->model_account_light->getLightFieldToStandartField($key);
                        foreach ($light_field_to_standart_fields as $light_field_to_standart_field) {
                            $standart_field = $light_field_to_standart_field['standart_field_name'];
                            if ($post_data['light_field'][$key] != '') {
                                $post_data = array_merge($post_data, array($standart_field => $post_data['light_field'][$key]));
                            }
                        }
                    }
                }
            }
            
            $customer_id = $this->model_account_customer->addCustomer($post_data);

            $this->model_account_light->addCustomerLightField($post_data, $customer_id);

            $customer_info = $this->model_account_customer->getCustomer($customer_id);
            $c_email = $customer_info['email'];
            $c_firstname = $customer_info['firstname'];
            $c_lastname = $customer_info['lastname'];

            // Clear any previous login attempts for unregistered accounts.
            $this->model_account_customer->deleteLoginAttempts($c_email);

            $this->customer->login($c_email, $this->request->post['password']);

            unset($this->session->data['guest']);

            // Add to activity log
            $this->load->model('account/activity');

            $activity_data = array(
                'customer_id' => $customer_id,
                'name'        => $c_firstname . ' ' . $c_lastname
            );

            $this->model_account_activity->addActivity('register', $activity_data);

            $this->response->redirect($this->url->link('account/success'));
        }

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('account/light_register', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));
		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_your_address'] = $this->language->get('text_your_address');
		$data['text_your_password'] = $this->language->get('text_your_password');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['light_field'])) {
			$data['error_light_field'] = $this->error['light_field'];
		} else {
			$data['error_light_field'] = array();
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		$data['action'] = $this->url->link('account/light_register', '', true);

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->request->post['customer_group_id'])) {
			$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		$data['light_fields'] = $this->model_account_light->getLightFields();

        if (isset($this->request->post['light_field'])) {
            $data['post_light_field'] = $this->request->post['light_field'];
        } else {
            $data['post_light_field'] = array();
        }

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$data['newsletter'] = $this->request->post['newsletter'];
		} else {
			$data['newsletter'] = '';
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');


        $this->response->setOutput($this->load->view('account/light_register', $data));
	}

	private function validate() {

        $email_arr = $this->model_account_light->getLightFieldToEmailField();

        if (empty($email_arr)) {
            $this->error['warning'] = $this->language->get('error_email');
        }

        foreach ($email_arr as $email) {

            if ((utf8_strlen($this->request->post['light_field'][$email['light_field_id']]) > 96) || !preg_match($this->config->get('config_mail_regexp'), $this->request->post['light_field'][$email['light_field_id']])) {
                $this->error['warning'] = $this->language->get('error_email');
            }

            if (isset($email['light_field_id']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['light_field'][$email['light_field_id']])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

		// Customer Group
		if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->post['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$light_fields = $this->model_account_light->getLightFields($customer_group_id);

		foreach ($light_fields as $light_field) {
			if (($light_field['status_reg'] == 0) && $light_field['required'] && empty($this->request->post['light_field'][$light_field['light_field_id']])) {
				$this->error['light_field'][$light_field['light_field_id']] = sprintf($this->language->get('error_custom_field'), $light_field['name']);
			}
		}

		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		return !$this->error;
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/light');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$light_fields = $this->model_account_light->getLightFields($customer_group_id);

		foreach ($light_fields as $light_field) {
			$json[] = array(
				'light_field_id' => $light_field['light_field_id'],
				'required'        => $light_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
