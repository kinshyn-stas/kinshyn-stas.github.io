<?php
class ControllerExtensionModuleSmreviewdisp extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/smreviewdisp');

		$this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule('smreviewdisp', $this->request->post);
            } else {
                $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            }

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_title'] = $this->language->get('entry_title');

		$data['entry_display'] = $this->language->get('entry_display');
		$data['text_random'] = $this->language->get('text_random');
		$data['text_last'] = $this->language->get('text_last');
		$data['text_first'] = $this->language->get('text_first');
		$data['text_quantity'] = $this->language->get('text_quantity');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_min'] = $this->language->get('text_min');
		$data['text_max'] = $this->language->get('text_max');

		$data['text_view'] = $this->language->get('text_view');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_table'] = $this->language->get('text_table');
		$data['text_carousel'] = $this->language->get('text_carousel');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
			'text' => $this->language->get('heading_title_with_picture'),
			'href' => $this->url->link('extension/module/smreviewdisp', 'token=' . $this->session->data['token'], true)
		);


        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('extension/module/smreviewdisp', 'token=' . $this->session->data['token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/smreviewdisp', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
        }

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
        }

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }
        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }
        if (isset($this->request->post['smreviewdisp_display'])) {
            $data['smreviewdisp_display'] = $this->request->post['smreviewdisp_display'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_display'] = $module_info['smreviewdisp_display'];
        } else {
            $data['smreviewdisp_display'] = '';
        }
        if (isset($this->request->post['smreviewdisp_quantity'])) {
            $data['smreviewdisp_quantity'] = $this->request->post['smreviewdisp_quantity'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_quantity'] = $module_info['smreviewdisp_quantity'];
        } else {
            $data['smreviewdisp_quantity'] = '';
        }
        if (isset($this->request->post['smreviewdisp_date'])) {
            $data['smreviewdisp_date'] = $this->request->post['smreviewdisp_date'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_date'] = $module_info['smreviewdisp_date'];
        } else {
            $data['smreviewdisp_date'] = '';
        }
        if (isset($this->request->post['smreviewdisp_min'])) {
            $data['smreviewdisp_min'] = $this->request->post['smreviewdisp_min'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_min'] = $module_info['smreviewdisp_min'];
        } else {
            $data['smreviewdisp_min'] = '';
        }
        if (isset($this->request->post['smreviewdisp_max'])) {
            $data['smreviewdisp_max'] = $this->request->post['smreviewdisp_max'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_max'] = $module_info['smreviewdisp_max'];
        } else {
            $data['smreviewdisp_max'] = '';
        }
        if (isset($this->request->post['smreviewdisp_view'])) {
            $data['smreviewdisp_view'] = $this->request->post['smreviewdisp_view'];
        } elseif (!empty($module_info)) {
            $data['smreviewdisp_view'] = $module_info['smreviewdisp_view'];
        } else {
            $data['smreviewdisp_view'] = '';
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/smreviewdisp', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/smreviewdisp')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}