<?php
class ControllerDesignBannerExtend extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('design/banner_extend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/banner_extend');

		$this->getList();
	}

	public function add() {
		$this->load->language('design/banner_extend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/banner_extend');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_banner_extend->addBanner($this->request->post);

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

			$this->response->redirect($this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('design/banner_extend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/banner_extend');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_design_banner_extend->editBanner($this->request->get['banner_extend_id'], $this->request->post);

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

		    $this->response->redirect($this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('design/banner_extend');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/banner_extend');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $banner_extend_id) {
				$this->model_design_banner_extend->deleteBanner($banner_extend_id);
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

			$this->response->redirect($this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			'href' => $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('design/banner_extend/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/banner_extend/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['banners'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$banner_total = $this->model_design_banner_extend->getTotalBanners();

		$results = $this->model_design_banner_extend->getBanners($filter_data);

		foreach ($results as $result) {
			$data['banners'][] = array(
				'banner_extend_id' => $result['banner_extend_id'],
				'name'      => $result['name'],
				'status'    => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'      => $this->url->link('design/banner_extend/edit', 'token=' . $this->session->data['token'] . '&banner_extend_id=' . $result['banner_extend_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
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

		$data['sort_name'] = $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $banner_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($banner_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($banner_total - $this->config->get('config_limit_admin'))) ? $banner_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $banner_total, ceil($banner_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/banner_extend_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['banner_extend_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_banner_add'] = $this->language->get('button_banner_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['banner_extend_image'])) {
			$data['error_banner_extend_image'] = $this->error['banner_extend_image'];
		} else {
			$data['error_banner_extend_image'] = array();
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
			'href' => $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['banner_extend_id'])) {
			$data['action'] = $this->url->link('design/banner_extend/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('design/banner_extend/edit', 'token=' . $this->session->data['token'] . '&banner_extend_id=' . $this->request->get['banner_extend_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('design/banner_extend', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['banner_extend_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$banner_extend_info = $this->model_design_banner_extend->getBanner($this->request->get['banner_extend_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($banner_extend_info)) {
			$data['name'] = $banner_extend_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($banner_extend_info)) {
			$data['status'] = $banner_extend_info['status'];
		} else {
			$data['status'] = true;
		}

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$this->load->model('tool/image');

		if (isset($this->request->post['banner_extend_image'])) {
			$banner_images = $this->request->post['banner_extend_image'];
		} elseif (isset($this->request->get['banner_extend_id'])) {
			$banner_images = $this->model_design_banner_extend->getBannerImages($this->request->get['banner_extend_id']);
		} else {
			$banner_images = array();
		}

		$data['banner_images'] = array();

		foreach ($banner_images as $banner_extend_image) {
			if (is_file(DIR_IMAGE . $banner_extend_image['image'])) {
				$image = $banner_extend_image['image'];
				$thumb = $banner_extend_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

            if (is_file(DIR_IMAGE . $banner_extend_image['background_image'])) {
				$background_image = $banner_extend_image['background_image'];
				$background_thumb = $banner_extend_image['background_image'];
			} else {
				$background_image = '';
				$background_thumb = 'no_image.png';
			}

            if ($banner_extend_image['product_id']) {
                $this->load->model('catalog/product');
                $product_info = $this->model_catalog_product->getProduct($banner_extend_image['product_id']);
                $product_name = $product_info['name'];
            } else {
                $product_name = '';
            }

			$data['banner_images'][] = array(
				'banner_extend_image_description'   => $banner_extend_image['banner_extend_image_description'],
				'link'                              => $banner_extend_image['link'],
				'product_id'                        => $banner_extend_image['product_id'],
				'product_name'                      => $product_name,
				'view'                              => $banner_extend_image['view'],
				'text_type'                         => $banner_extend_image['text_type'],
				'show_price'                        => $banner_extend_image['show_price'],
				'image'                             => $image,
				'background_image'                  => $background_image,
				'thumb'                             => $this->model_tool_image->resize($thumb, 100, 100),
				'background_thumb'                  => $this->model_tool_image->resize($background_thumb, 100, 100),
				'sort_order'                        => $banner_extend_image['sort_order'],
				'text_css'                          => $banner_extend_image['text_css'],
				'photo_css'                         => $banner_extend_image['photo_css'],
				'bg_style'                          => $banner_extend_image['bg_style']
			);
		}

        $data['views'] = array(
            array('id' => 1, 'name' => 'Компактний вид, текст слева', 'selected' => 1),
            array('id' => 2, 'name' => 'Компактний вид, текст справа', 'selected' => 0),
            array('id' => 3, 'name' => 'Широкий вид, текст слева', 'selected' => 0),
            array('id' => 4, 'name' => 'Широкий вид, текст справа', 'selected' => 0),
            array('id' => 5, 'name' => 'Свой класс css, текст слева', 'selected' => 0),
            array('id' => 6, 'name' => 'Свой класс css, текст справа', 'selected' => 0)
        );

        $data['text_types'] = array(
            array('id' => 1, 'name' => 'Темный текст', 'selected' => 1),
            array('id' => 2, 'name' => 'Белый текст', 'selected' => 0)
        );

        $data['show_prices'] = array(
            array('id' => 1, 'name' => 'Показывать цену товара', 'selected' => 1),
            array('id' => 2, 'name' => 'Скрывать цену товара', 'selected' => 0)
        );

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/banner_extend_form.tpl', $data));
	}

	protected function validateForm() {
        //to encode
        //

		if (!$this->user->hasPermission('modify', 'design/banner_extend')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

 		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/banner_extend')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}