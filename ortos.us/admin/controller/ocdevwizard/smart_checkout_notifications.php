<?php

// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com>
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

class ControllerOcdevwizardSmartCheckoutNotifications extends Controller {

  private $error           = array();
  static  $_module_version = '2.0.1';
  static  $_module_name    = 'smart_checkout';

	public function index() {
		// connect models array
    $models = array('ocdevwizard/'.self::$_module_name, 'ocdevwizard/ocdevwizard_setting');
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (!$this->model_ocdevwizard_ocdevwizard_setting->getSetting(self::$_module_name)) {
			$this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'));
		}

		$this->language->load('ocdevwizard/'.self::$_module_name.'_notifications');

		$this->document->setTitle($this->language->get('heading_name'));

		$this->getList();
	}

	public function add() {
		$this->language->load('ocdevwizard/'.self::$_module_name.'_notifications');

		$this->document->setTitle($this->language->get('heading_name'));

		// connect models array
    $models = array('ocdevwizard/'.self::$_module_name);
    foreach ($models as $model) {
      $this->load->model($model);
    }

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->{'model_ocdevwizard_'.self::$_module_name}->addNotificationTemplate($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status='.$this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort='.$this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order='.$this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page='.$this->request->get['page'];
			}

			$this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('ocdevwizard/'.self::$_module_name.'_notifications');

		$this->document->setTitle($this->language->get('heading_name'));

		// connect models array
    $models = array('ocdevwizard/'.self::$_module_name);
    foreach ($models as $model) {
      $this->load->model($model);
    }

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->{'model_ocdevwizard_'.self::$_module_name}->editNotificationTemplate($this->request->get['template_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status='.$this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort='.$this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order='.$this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page='.$this->request->get['page'];
			}

			$this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('ocdevwizard/'.self::$_module_name.'_notifications');

		$this->document->setTitle($this->language->get('heading_name'));

		// connect models array
    $models = array('ocdevwizard/'.self::$_module_name);
    foreach ($models as $model) {
      $this->load->model($model);
    }

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $template_id) {
				$this->{'model_ocdevwizard_'.self::$_module_name}->deleteNotificationTemplate($template_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status='.$this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort='.$this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order='.$this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page='.$this->request->get['page'];
			}

			$this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL'));
		}

		$this->getList();
	}

	public function copy() {
		$this->language->load('ocdevwizard/'.self::$_module_name.'_notifications');

		$this->document->setTitle($this->language->get('heading_name'));

		// connect models array
    $models = array('ocdevwizard/'.self::$_module_name);
    foreach ($models as $model) {
      $this->load->model($model);
    }

		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $template_id) {
				$this->{'model_ocdevwizard_'.self::$_module_name}->copyNotificationTemplate($template_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_subject'])) {
				$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status='.$this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort='.$this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order='.$this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page='.$this->request->get['page'];
			}

			$this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		$data = array();

		$data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name.'_notifications'));

		if (isset($this->request->get['filter_subject'])) {
			$filter_subject = $this->request->get['filter_subject'];
		} else {
			$filter_subject = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'nd.subject';
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

		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status='.$this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort='.$this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order='.$this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page='.$this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token='.$this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL')
		);

		$data['add'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/add', 'token='.$this->session->data['token'].$url, 'SSL');
		$data['copy'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/copy', 'token='.$this->session->data['token'].$url, 'SSL');
		$data['delete'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/delete', 'token='.$this->session->data['token'].$url, 'SSL');

		$data['templates'] = array();

		$filter_data = array(
			'filter_subject' => $filter_subject,
			'filter_status'  => $filter_status,
			'sort'           => $sort,
			'order'          => $order,
			'start'          => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'          => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$template_total = $this->{'model_ocdevwizard_'.self::$_module_name}->getTotalNotificationTemplates($filter_data);

		$results = $this->{'model_ocdevwizard_'.self::$_module_name}->getNotificationTemplates($filter_data);

		foreach ($results as $result) {
			$data['templates'][] = array(
				'template_id' => $result['template_id'],
				'subject'     => $result['subject'],
				'status'      => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'        => $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/edit', 'token='.$this->session->data['token'].'&template_id='.$result['template_id'].$url, 'SSL')
			);
		}

		$data['token'] = $this->session->data['token'];

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

		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status='.$this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page='.$this->request->get['page'];
		}

		$data['sort_subject'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].'&sort=nd.subject'.$url, 'SSL');
		$data['sort_status'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].'&sort=n.status'.$url, 'SSL');
		$data['sort_order'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].'&sort=n.sort_order'.$url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status='.$this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort='.$this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order='.$this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $template_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url.'&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($template_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($template_total - $this->config->get('config_limit_admin'))) ? $template_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $template_total, ceil($template_total / $this->config->get('config_limit_admin')));

		$data['filter_subject'] = $filter_subject;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'_notifications_list.tpl', $data));
	}

	protected function getForm() {
		$data = array();

		$data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name.'_notifications'));

		$styles = array('stylesheet.css');
    foreach ($styles as $style) {
      $this->document->addStyle('view/stylesheet/ocdevwizard/'.self::$_module_name.'/'.$style);
    }

		$data['heading_title'] = $this->language->get('heading_name');

		$data['text_form'] = !isset($this->request->get['template_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
	
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['subject'])) {
			$data['error_subject'] = $this->error['subject'];
		} else {
			$data['error_subject'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status='.$this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort='.$this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order='.$this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page='.$this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token='.$this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL')
		);

		if (!isset($this->request->get['template_id'])) {
			$data['action'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/add', 'token='.$this->session->data['token'].$url, 'SSL');
		} else {
			$data['action'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/edit', 'token='.$this->session->data['token'].'&template_id='.$this->request->get['template_id'].$url, 'SSL');
			$data['action_plus'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications/edit_and_stay&template_id='.$this->request->get['template_id'], 'token='.$this->session->data['token'], 'SSL');
		}

		$data['cancel'] = $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'].$url, 'SSL');

		if (isset($this->request->get['template_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$template_info = $this->{'model_ocdevwizard_'.self::$_module_name}->getNotificationTemplate($this->request->get['template_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['template_description'])) {
			$data['template_description'] = $this->request->post['template_description'];
		} elseif (isset($this->request->get['template_id'])) {
			$data['template_description'] = $this->{'model_ocdevwizard_'.self::$_module_name}->getNotificationTemplateDescription($this->request->get['template_id']);
		} else {
			$data['template_description'] = array();
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($template_info)) {
			$data['status'] = $template_info['status'];
		} else {
			$data['status'] = true;
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'_notifications_form.tpl', $data));
	}

	 public function edit_and_stay() {
    $data = array();

    // connect models array
    $models = array('ocdevwizard/'.self::$_module_name);
    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name.'_notifications'));
    $this->document->setTitle($this->language->get('heading_name'));

    $url = '';

		if (isset($this->request->get['filter_subject'])) {
			$url .= '&filter_subject='.urlencode(html_entity_decode($this->request->get['filter_subject'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status='.$this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort='.$this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order='.$this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page='.$this->request->get['page'];
		}

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
      $this->session->data['success'] = $this->language->get('text_success');
      $this->{'model_ocdevwizard_'.self::$_module_name}->editNotificationTemplate($this->request->get['template_id'], $this->request->post);
    }

    $this->getForm();
  }

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['template_description'] as $language_id => $value) {
			if ((utf8_strlen($value['subject']) < 3) || (utf8_strlen($value['subject']) > 255)) {
				$this->error['subject'][$language_id] = $this->language->get('error_subject');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_subject'])) {
			// connect models array
	    $models = array('ocdevwizard/'.self::$_module_name);
	    foreach ($models as $model) {
	      $this->load->model($model);
	    }

			if (isset($this->request->get['filter_subject'])) {
				$filter_subject = $this->request->get['filter_subject'];
			} else {
				$filter_subject = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_subject' => $filter_subject,
				'start'          => 0,
				'limit'          => $limit
			);

			$results = $this->{'model_ocdevwizard_'.self::$_module_name}->getNotificationTemplates($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'template_id' => $result['template_id'],
					'subject'     => strip_tags(html_entity_decode($result['subject'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
