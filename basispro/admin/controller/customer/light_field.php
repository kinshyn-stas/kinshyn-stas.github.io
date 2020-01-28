<?php
class ControllerCustomerLightField extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('customer/light_field');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/light_field');

		$this->getList();
	}

	public function add() {
		$this->load->language('customer/light_field');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/light_field');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_light_field->addLightField($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('customer/light_field');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/light_field');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_customer_light_field->editLightField($this->request->get['light_field_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('customer/light_field');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('customer/light_field');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $light_field_id) {
				$this->model_customer_light_field->deleteLightField($light_field_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'lf.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('customer/light_field/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('customer/light_field/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['light_fields'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$light_field_total = $this->model_customer_light_field->getTotalLightFields();

		$results = $this->model_customer_light_field->getLightFields($filter_data);

		foreach ($results as $result) {
			$type = '';

			switch ($result['type']) {
				case 'select':
					$type = $this->language->get('text_select');
					break;
				case 'radio':
					$type = $this->language->get('text_radio');
					break;
/*				case 'checkbox':
					$type = $this->language->get('text_checkbox');
					break;*/
				case 'input':
					$type = $this->language->get('text_input');
					break;
				case 'text':
					$type = $this->language->get('text_text');
					break;
				case 'textarea':
					$type = $this->language->get('text_textarea');
					break;
/*				case 'file':
					$type = $this->language->get('text_file');
					break;*/
				case 'date':
					$type = $this->language->get('text_date');
					break;
				case 'datetime':
					$type = $this->language->get('text_datetime');
					break;
				case 'time':
					$type = $this->language->get('text_time');
					break;
			}

			$data['light_fields'][] = array(
				'light_field_id' => $result['light_field_id'],
				'name'            => $result['name'],
				'type'            => $type,
				'status'          => $result['status'],
				'status_edit'          => $result['status_edit'],
				'status_reg'          => $result['status_reg'],
				'status_cart'          => $result['status_cart'],
				'sort_order'      => $result['sort_order'],
				'edit'            => $this->url->link('customer/light_field/edit', 'token=' . $this->session->data['token'] . '&light_field_id=' . $result['light_field_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_type'] = $this->language->get('column_type');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . '&sort=lfd.name' . $url, 'SSL');
		$data['sort_type'] = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . '&sort=lf.type' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . '&sort=lf.status' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . '&sort=lf.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $light_field_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($light_field_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($light_field_total - $this->config->get('config_limit_admin'))) ? $light_field_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $light_field_total, ceil($light_field_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/light_field_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['light_field_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_radio'] = $this->language->get('text_radio');
		$data['text_checkbox'] = $this->language->get('text_checkbox');
		$data['text_input'] = $this->language->get('text_input');
		$data['text_text'] = $this->language->get('text_text');
		$data['text_textarea'] = $this->language->get('text_textarea');
		$data['text_file'] = $this->language->get('text_file');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_datetime'] = $this->language->get('text_datetime');
		$data['text_time'] = $this->language->get('text_time');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
        $data['text_standart'] = $this->language->get('text_standart');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_light_value'] = $this->language->get('entry_light_value');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_status_reg'] = $this->language->get('entry_status_reg');
		$data['entry_status_edit'] = $this->language->get('entry_status_edit');
		$data['entry_status_cart'] = $this->language->get('entry_status_cart');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_sort_order'] = $this->language->get('help_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_light_field_value_add'] = $this->language->get('button_light_field_value_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['light_field_value'])) {
			$data['error_light_field_value'] = $this->error['light_field_value'];
		} else {
			$data['error_light_field_value'] = array();
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['light_field_id'])) {
			$data['action'] = $this->url->link('customer/light_field/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('customer/light_field/edit', 'token=' . $this->session->data['token'] . '&light_field_id=' . $this->request->get['light_field_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('customer/light_field', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['light_field_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$light_field_info = $this->model_customer_light_field->getLightField($this->request->get['light_field_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['light_field_description'])) {
			$data['light_field_description'] = $this->request->post['light_field_description'];
		} elseif (isset($this->request->get['light_field_id'])) {
			$data['light_field_description'] = $this->model_customer_light_field->getLightFieldDescriptions($this->request->get['light_field_id']);
		} else {
			$data['light_field_description'] = array();
		}


		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($light_field_info)) {
			$data['type'] = $light_field_info['type'];
		} else {
			$data['type'] = '';
		}

		if (isset($this->request->post['value'])) {
			$data['value'] = $this->request->post['value'];
		} elseif (!empty($light_field_info)) {
			$data['value'] = $light_field_info['value'];
		} else {
			$data['value'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($light_field_info)) {
			$data['status'] = $light_field_info['status'];
		} else {
			$data['status'] = '';
		}
        
		if (isset($this->request->post['status_reg'])) {
			$data['status_reg'] = $this->request->post['status_reg'];
		} elseif (!empty($light_field_info)) {
			$data['status_reg'] = $light_field_info['status_reg'];
		} else {
			$data['status_reg'] = '';
		}
        
		if (isset($this->request->post['status_edit'])) {
			$data['status_edit'] = $this->request->post['status_edit'];
		} elseif (!empty($light_field_info)) {
			$data['status_edit'] = $light_field_info['status_edit'];
		} else {
			$data['status_edit'] = '';
		}

        if (isset($this->request->post['status_cart'])) {
            $data['status_cart'] = $this->request->post['status_cart'];
        } elseif (!empty($light_field_info)) {
            $data['status_cart'] = $light_field_info['status_cart'];
        } else {
            $data['status_cart'] = '';
        }

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($light_field_info)) {
			$data['sort_order'] = $light_field_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['light_field_value'])) {
			$light_field_values = $this->request->post['light_field_value'];
		} elseif (isset($this->request->get['light_field_id'])) {
			$light_field_values = $this->model_customer_light_field->getLightFieldValueDescriptions($this->request->get['light_field_id']);
		} else {
			$light_field_values = array();
		}

		$data['light_field_values'] = array();

		foreach ($light_field_values as $light_field_value) {
			$data['light_field_values'][] = array(
				'light_field_value_id'          => $light_field_value['light_field_value_id'],
				'light_field_value_description' => $light_field_value['light_field_value_description'],
				'sort_order'                    => $light_field_value['sort_order']
			);
		}

		if (isset($this->request->post['light_field_customer_group'])) {
			$light_field_customer_groups = $this->request->post['light_field_customer_group'];
		} elseif (isset($this->request->get['light_field_id'])) {
			$light_field_customer_groups = $this->model_customer_light_field->getLightFieldCustomerGroups($this->request->get['light_field_id']);
		} else {
			$light_field_customer_groups = array();
		}

		$data['light_field_customer_group'] = array();

		foreach ($light_field_customer_groups as $light_field_customer_group) {
			$data['light_field_customer_group'][] = $light_field_customer_group['customer_group_id'];
		}

		$data['light_field_required'] = array();

		foreach ($light_field_customer_groups as $light_field_customer_group) {
			if ($light_field_customer_group['required']) {
				$data['light_field_required'][] = $light_field_customer_group['customer_group_id'];
			}
		}

		if (isset($this->request->post['light_field_to_standart_field'])) {
			$light_field_to_standart_fields = $this->request->post['light_field_to_standart_field'];
		} elseif (isset($this->request->get['light_field_id'])) {
			$light_field_to_standart_fields = $this->model_customer_light_field->getLightFieldToStandartField($this->request->get['light_field_id']);
		} else {
			$light_field_to_standart_fields = array();
		}

		$data['light_field_to_standart_field'] = array();

		foreach ($light_field_to_standart_fields as $light_field_to_standart_field) {
			$data['light_field_to_standart_field'][] = $light_field_to_standart_field['standart_field_name'];
		}

		$this->load->model('customer/customer_group');

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('customer/light_field_form.tpl', $data));
	}

	protected function validateForm() {
        //to encode
        //

		if (!$this->user->hasPermission('modify', 'customer/light_field')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['light_field_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 128)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if (($this->request->post['type'] == 'select' || $this->request->post['type'] == 'radio')) {
			if (!isset($this->request->post['light_field_value'])) {
				$this->error['warning'] = $this->language->get('error_type');
			}

			if (isset($this->request->post['light_field_value'])) {
				foreach ($this->request->post['light_field_value'] as $light_field_value_id => $light_field_value) {
					foreach ($light_field_value['light_field_value_description'] as $language_id => $light_field_value_description) {
						if ((utf8_strlen($light_field_value_description['name']) < 1) || (utf8_strlen($light_field_value_description['name']) > 128)) {
							$this->error['light_field_value'][$light_field_value_id][$language_id] = $this->language->get('error_light_value');
						}
					}
				}
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'customer/light_field')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

    public function lightfield() {
        $json = array();

        $this->load->model('customer/light_field');

        // Customer Group
        if (isset($this->request->get['customer_group_id'])) {
            $customer_group_id = $this->request->get['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }



        $light_fields = $this->model_customer_light_field->getLightFields(array('filter_customer_group_id' => $customer_group_id));

        foreach ($light_fields as $light_field) {
            $json[] = array(
                'light_field_id' => $light_field['light_field_id'],
                'required'        => empty($light_field['required']) || $light_field['required'] == 0 ? false : true
            );
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}