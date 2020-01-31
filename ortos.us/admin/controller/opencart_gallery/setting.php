<?php
class ControllerOpencartGallerySetting extends Controller {
	private $error = array();
 
	public function index() {
		
		$this->load->language('opencart_gallery/setting'); 
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$db_insert = array(
				'gallery_db_insert'	  => 1
			);

			$this->model_setting_setting->editSetting('og', $db_insert);

			$this->model_setting_setting->editSetting('og', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('opencart_gallery/setting', 'token=' . $this->session->data['token'] , true));

		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = $this->language->get('heading_title');

		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
 		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');	
		
		$data['entry_meta_length'] = $this->language->get('entry_meta_length');
		$data['entry_picture_type'] = $this->language->get('entry_picture_type');
		$data['entry_column_width'] = $this->language->get('entry_column_width');
		$data['entry_column_height'] = $this->language->get('entry_column_height');
		$data['entry_limit_category'] = $this->language->get('entry_limit_category');
		$data['entry_limit_per_row'] = $this->language->get('entry_limit_per_row');
		
		$data['text_rectangular'] = $this->language->get('text_rectangular');
		$data['text_square'] = $this->language->get('text_square');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
	   $data['tab_setting'] = $this->language->get('tab_setting');
	   $data['tab_newspage'] = $this->language->get('tab_newspage');
	   $data['tab_newscatpage'] = $this->language->get('tab_newscatpage');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('opencart_gallery/setting', 'token=' . $this->session->data['token'], true),
      		'separator' => ' :: '
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['opencart_gallery_manager'] = $this->url->link('extension/module/opencart_gallery_manager', 'token=' . $this->session->data['token'], true);

		$data['action'] = $this->url->link('opencart_gallery/setting', 'token=' . $this->session->data['token'], true);
		
		$data['cancel'] = $this->url->link('extension/module/opencart_gallery_manager', 'token=' . $this->session->data['token'], true);
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['og_heading_title_font'])) {
			$data['og_heading_title_font'] = $this->request->post['og_heading_title_font'];
		} elseif ($this->config->get('og_heading_title_font')) {
			$data['og_heading_title_font'] = $this->config->get('og_heading_title_font');
		} else {
			$data['og_heading_title_font'] = '27';
		}

		if (isset($this->request->post['og_heading_title_size'])) {
			$data['og_heading_title_size'] = $this->request->post['og_heading_title_size'];
		} elseif ($this->config->get('og_heading_title_size')) {
			$data['og_heading_title_size'] = $this->config->get('og_heading_title_size');
		} else {
			$data['og_heading_title_size'] = '18';
		}

		if (isset($this->request->post['og_heading_title_line'])) {
			$data['og_heading_title_line'] = $this->request->post['og_heading_title_line'];
		} elseif ($this->config->get('og_heading_title_line')) {
			$data['og_heading_title_line'] = $this->config->get('og_heading_title_line');
		} else {
			$data['og_heading_title_line'] = '5';
		}

		if (isset($this->request->post['og_title_font'])) {
			$data['og_title_font'] = $this->request->post['og_title_font'];
		} elseif ($this->config->get('og_heading_title_font')) {
			$data['og_title_font'] = $this->config->get('og_title_font');
		} else {
			$data['og_title_font'] = '27';
		}

		if (isset($this->request->post['og_title_size'])) {
			$data['og_title_size'] = $this->request->post['og_title_size'];
		} elseif ($this->config->get('og_title_size')) {
			$data['og_title_size'] = $this->config->get('og_title_size');
		} else {
			$data['og_title_size'] = '12';
		}

		if (isset($this->request->post['og_title_font_weight'])) {
			$data['og_title_font_weight'] = $this->request->post['og_title_font_weight'];
		} else {
			$data['og_title_font_weight'] = $this->config->get('og_title_font_weight');
		}

		if (isset($this->request->post['og_album_per_row'])) {
			$data['og_album_per_row'] = $this->request->post['og_album_per_row'];
		} elseif ($this->config->get('og_album_per_row')) {
			$data['og_album_per_row'] = $this->config->get('og_album_per_row');
		} else {
			$data['og_album_per_row'] = '4';
		}

		if (isset($this->request->post['og_album_per_page'])) {
			$data['og_album_per_page'] = $this->request->post['og_album_per_page'];
		} elseif ($this->config->get('og_album_per_page')) {
			$data['og_album_per_page'] = $this->config->get('og_album_per_page');
		} else {
			$data['og_album_per_page'] = '12';
		}

		if (isset($this->request->post['og_album_size'])) {
			$data['og_album_size'] = $this->request->post['og_album_size'];
		} elseif ($this->config->get('og_album_size')) {
			$data['og_album_size'] = $this->config->get('og_album_size');
		} else {
			$data['og_album_size'] = '2';
		}

		if (isset($this->request->post['og_album_image_type'])) {
			$data['og_album_image_type'] = $this->request->post['og_album_image_type'];
		} else {
			$data['og_album_image_type'] = $this->config->get('og_album_image_type');
		}

		if (isset($this->request->post['og_album_height'])) {
			$data['og_album_height'] = $this->request->post['og_album_height'];
		} elseif ($this->config->get('og_album_height')) {
			$data['og_album_height'] = $this->config->get('og_album_height');
		} else {
			$data['og_album_height'] = '220';
		}

		if (isset($this->request->post['og_image_pu_width'])) {
			$data['og_image_pu_width'] = $this->request->post['og_image_pu_width'];
		} elseif ($this->config->get('og_image_pu_width')) {
			$data['og_image_pu_width'] = $this->config->get('og_image_pu_width');
		} else {
			$data['og_image_pu_width'] = '800';
		}

		if (isset($this->request->post['og_image_pu_height'])) {
			$data['og_image_pu_height'] = $this->request->post['og_image_pu_height'];
		} elseif ($this->config->get('og_image_pu_height')) {
			$data['og_image_pu_height'] = $this->config->get('og_image_pu_height');
		} else {
			$data['og_image_pu_height'] = '600';
		}

		if (isset($this->request->post['og_video_btn'])) {
			$data['og_video_btn'] = $this->request->post['og_video_btn'];
		} elseif ($this->config->get('og_video_btn')) {
			$data['og_video_btn'] = $this->config->get('og_video_btn');
		} else {
			$data['og_video_btn'] = '1';
		}

		if (isset($this->request->post['og_video_per_row'])) {
			$data['og_video_per_row'] = $this->request->post['og_video_per_row'];
		} elseif ($this->config->get('og_video_per_row')) {
			$data['og_video_per_row'] = $this->config->get('og_video_per_row');
		} else {
			$data['og_video_per_row'] = '4';
		}

		if (isset($this->request->post['og_video_per_page'])) {
			$data['og_video_per_page'] = $this->request->post['og_video_per_page'];
		} elseif ($this->config->get('og_video_per_page')) {
			$data['og_video_per_page'] = $this->config->get('og_video_per_page');
		} else {
			$data['og_video_per_page'] = '12';
		}

		if (isset($this->request->post['og_video_list_size'])) {
			$data['og_video_list_size'] = $this->request->post['og_video_list_size'];
		} elseif ($this->config->get('og_video_list_size')) {
			$data['og_video_list_size'] = $this->config->get('og_video_list_size');
		} else {
			$data['og_video_list_size'] = '3';
		}

		if (isset($this->request->post['og_video_size'])) {
			$data['og_video_size'] = $this->request->post['og_video_size'];
		} elseif ($this->config->get('og_video_size')) {
			$data['og_video_size'] = $this->config->get('og_video_size');
		} else {
			$data['og_video_size'] = '8';
		}

		if (isset($this->request->post['og_video_height'])) {
			$data['og_video_height'] = $this->request->post['og_video_height'];
		} elseif ($this->config->get('og_video_height')) {
			$data['og_video_height'] = $this->config->get('og_video_height');
		} else {
			$data['og_video_height'] = '200';
		}
						
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('opencart_gallery/setting', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'opencart_gallery/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>