<?php
class ControllerExtensionModuleAnswerTab extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/answertab');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('answertab', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
        $data['input_text_after'] = $this->language->get('input_text_after');
        $data['tooltip_text_after'] = $this->language->get('tooltip_text_after');
        $data['show_text_after'] = $this->language->get('show_text_after');

		$data['entry_status'] = $this->language->get('entry_status');

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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/answertab', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/answertab', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->post['answertab_status'])) {
			$data['answertab_status'] = $this->request->post['answertab_status'];
		} else {
			$data['answertab_status'] = $this->config->get('answertab_status');
		}

        if (isset($this->request->post['answertab_show_text_after'])) {
            $data['answertab_show_text_after'] = $this->request->post['answertab_show_text_after'];
        } elseif ( !empty($this->config->get('answertab_show_text_after')) ) {
            $data['answertab_show_text_after'] = $this->config->get('answertab_show_text_after');
        }else{
            $data['answertab_show_text_after'] = 0;
        }

        if (isset($this->request->post['answertab_text_after'])) {
            $data['answertab_text_after'] = $this->request->post['answertab_text_after'];
        } elseif ( !empty($this->config->get('answertab_text_after')) ) {
            $data['answertab_text_after'] = $this->config->get('answertab_text_after');
        }else{
            $data['answertab_text_after'] = '';
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/answertab', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/answertab')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}