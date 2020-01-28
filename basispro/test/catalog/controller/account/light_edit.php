<?php
class ControllerAccountLightEdit extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/light_edit', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->load->language('account/edit');
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

            if (isset($post_data['light_field'])) {
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

			$this->model_account_customer->editCustomer($post_data);

            $this->model_account_light->addCustomerLightField($post_data, $this->customer->getId());

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$this->model_account_activity->addActivity('edit', $activity_data);

			$this->response->redirect($this->url->link('account/account', '', true));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_edit'),
			'href'      => $this->url->link('account/light_edit', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_your_details'] = $this->language->get('text_your_details');
		$data['text_additional'] = $this->language->get('text_additional');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
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

		$data['action'] = $this->url->link('account/light_edit', '', true);

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		// Custom Fields

		$data['light_fields'] = $this->model_account_light->getLightFields($this->config->get('config_customer_group_id'));

		if (isset($this->request->post['light_field'])) {
			$data['post_light_field'] = $this->request->post['light_field'];
		} elseif (isset($customer_info)) {
			$data['post_light_field'] = json_decode($customer_info['light_field'], true);
		} else {
			$data['post_light_field'] = array();
		}

		$data['back'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('account/light_edit', $data));
	}

	protected function validate() {

        $email_arr = $this->model_account_light->getLightFieldToEmailField();

        foreach ($email_arr as $email) {

            if ((utf8_strlen($this->request->post['light_field'][$email['light_field_id']]) > 96) || !preg_match($this->config->get('config_mail_regexp'), $this->request->post['light_field'][$email['light_field_id']])) {
                $this->error['warning'] = $this->language->get('error_email');
            }

            if (isset($email['light_field_id']) && ($this->customer->getEmail() != $this->request->post['light_field'][$email['light_field_id']]) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['light_field'][$email['light_field_id']])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

		// Custom field validation
		$this->load->model('account/light');

		$light_fields = $this->model_account_light->getLightFields($this->config->get('config_customer_group_id'));

		foreach ($light_fields as $light_field) {
			if (($light_field['status_edit'] == 0) && $light_field['required'] && empty($this->request->post['light_field'][$light_field['light_field_id']])) {
				$this->error['light_field'][$light_field['light_field_id']] = sprintf($this->language->get('error_custom_field'), $light_field['name']);
			}
		}

		return !$this->error;
	}
}