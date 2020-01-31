<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['content_ban1'] = $this->load->controller('common/content_ban1');
		$data['content_ban2'] = $this->load->controller('common/content_ban2');
		$data['content_ban3'] = $this->load->controller('common/content_ban3');
		$data['content_ban4'] = $this->load->controller('common/content_ban4');
		$data['content_viewt'] = $this->load->controller('common/content_viewt');
		$data['content_main1'] = $this->load->controller('common/content_main1');
		$data['content_main2'] = $this->load->controller('common/content_main2');
		$data['content_main3'] = $this->load->controller('common/content_main3');
		$data['content_main4'] = $this->load->controller('common/content_main4');
		$data['content_main5'] = $this->load->controller('common/content_main5');
		$data['content_main6'] = $this->load->controller('common/content_main6');
		
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
