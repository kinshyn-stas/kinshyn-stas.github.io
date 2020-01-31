<?php
class ControllerExtensionModuleFourInTab extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/four_in_tab');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('four_in_tab', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->cache->delete('product');

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_module'] = $this->language->get('text_module');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_limit_description'] = $this->language->get('entry_limit_description');
		$data['entry_name_tab'] = $this->language->get('entry_name_tab');
        $data['entry_product'] = $this->language->get('entry_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_adaptive'] = $this->language->get('entry_adaptive');
		$data['entry_display'] = $this->language->get('entry_display');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_autoplay'] = $this->language->get('entry_autoplay');
		$data['entry_hover'] = $this->language->get('entry_hover');
		$data['entry_prev'] = $this->language->get('entry_prev');
		$data['entry_next'] = $this->language->get('entry_next');
		$data['entry_navigation'] = $this->language->get('entry_navigation');
		$data['entry_pagination'] = $this->language->get('entry_pagination');
		$data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_tab'] = $this->language->get('entry_tab');
		$data['entry_panel'] = $this->language->get('entry_panel');
		$data['entry_site_theme'] = $this->language->get('entry_site_theme');
		$data['entry_category'] = $this->language->get('entry_category');
        
        $data['module_bestseller'] = $this->language->get('module_bestseller');
        $data['module_latest'] = $this->language->get('module_latest');
        $data['module_special'] = $this->language->get('module_special');
        $data['module_featured'] = $this->language->get('module_featured');
        
        $data['help_category'] = $this->language->get('help_category');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_enable'] = $this->language->get('button_enable');
		$data['button_disable'] = $this->language->get('button_disable');
        
        $data['tab_general'] = $this->language->get('tab_general');

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

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/four_in_tab', 'token=' . $this->session->data['token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/four_in_tab', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/four_in_tab', 'token=' . $this->session->data['token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/four_in_tab', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
        
        $data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		$this->load->model('catalog/product');

		$data['products'] = array();

		if (isset($this->request->post['product'])) {
			$products = $this->request->post['product'];
		} elseif (!empty($module_info)) {
			$products = $module_info['product'];
		} else {
			$products = array();
		}
        
        if (is_array($products)) {
		    foreach ($products as $product_id) {
			    $product_info = $this->model_catalog_product->getProduct($product_id);

			    if ($product_info) {
				    $data['products'][] = array(
					    'product_id' => $product_info['product_id'],
					    'name'       => $product_info['name']
				    );
			    }
		    }
        }

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
        
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 200;
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 200;
		}

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (!empty($module_info)) {
			$data['description'] = $module_info['description'];
		} else {
			$data['description'] = '';
		}
        
		if (isset($this->request->post['limit_description'])) {
			$data['limit_description'] = $this->request->post['limit_description'];
		} elseif (!empty($module_info)) {
			$data['limit_description'] = $module_info['limit_description'];
		} else {
			$data['limit_description'] = 100;
		}

		if (isset($this->request->post['adaptive'])) {
			$data['adaptive'] = $this->request->post['adaptive'];
		} elseif (!empty($module_info)) {
			$data['adaptive'] = $module_info['adaptive'];
		} else {
			$data['adaptive'] = '';
		}
                
		if (isset($this->request->post['theme'])) {
			$data['theme'] = $this->request->post['theme'];
		} elseif (!empty($module_info)) {
			$data['theme'] = $module_info['theme'];
		} else {
			$data['theme'] = 'tab';
		}
                
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

        // Featured
		if (isset($this->request->post['name_featured'])) {
			$data['name_featured'] = $this->request->post['name_featured'];
		} elseif (!empty($module_info)) {
			$data['name_featured'] = $module_info['name_featured'];
		} else {
			$data['name_featured'][] = $data['module_featured'];
		}

		if (isset($this->request->post['limit_featured'])) {
			$data['limit_featured'] = $this->request->post['limit_featured'];
		} elseif (!empty($module_info)) {
			$data['limit_featured'] = $module_info['limit_featured'];
		} else {
			$data['limit_featured'] = 5;
		}

		if (isset($this->request->post['sort_featured'])) {
			$data['sort_featured'] = (int)$this->request->post['sort_featured'];
		} elseif (!empty($module_info)) {
			$data['sort_featured'] = $module_info['sort_featured'];
		} else {
			$data['sort_featured'] = 0;
		}

		if (isset($this->request->post['status_featured'])) {
			$data['status_featured'] = $this->request->post['status_featured'];
		} elseif (!empty($module_info)) {
			$data['status_featured'] = $module_info['status_featured'];
		} else {
			$data['status_featured'] = '';
		}
        
		if (isset($this->request->post['featured_xs'])) {
			$data['featured_xs'] = (int)$this->request->post['featured_xs'];
		} elseif (!empty($module_info)) {
			$data['featured_xs'] = $module_info['featured_xs'];
		} else {
			$data['featured_xs'] = 12;
		}

		if (isset($this->request->post['featured_sm'])) {
			$data['featured_sm'] = (int)$this->request->post['featured_sm'];
		} elseif (!empty($module_info)) {
			$data['featured_sm'] = $module_info['featured_sm'];
		} else {
			$data['featured_sm'] = 3;
		}

		if (isset($this->request->post['featured_md'])) {
			$data['featured_md'] = (int)$this->request->post['featured_md'];
		} elseif (!empty($module_info)) {
			$data['featured_md'] = $module_info['featured_md'];
		} else {
			$data['featured_md'] = 3;
		}

		if (isset($this->request->post['featured_lg'])) {
			$data['featured_lg'] = (int)$this->request->post['featured_lg'];
		} elseif (!empty($module_info)) {
			$data['featured_lg'] = $module_info['featured_lg'];
		} else {
			$data['featured_lg'] = 3;
		}

		if (isset($this->request->post['category_featured'])) {
			$data['category_featured'] = $this->request->post['category_featured'];
		} elseif (!empty($module_info)) {
			$data['category_featured'] = $module_info['category_featured'];
		} else {
			$data['category_featured'] = '';
		}
        
        // Bestseller
		if (isset($this->request->post['name_bestseller'])) {
			$data['name_bestseller'] = $this->request->post['name_bestseller'];
		} elseif (!empty($module_info)) {
			$data['name_bestseller'] = $module_info['name_bestseller'];
		} else {
			$data['name_bestseller'][] = $data['module_bestseller'];
		}

		if (isset($this->request->post['limit_bestseller'])) {
			$data['limit_bestseller'] = $this->request->post['limit_bestseller'];
		} elseif (!empty($module_info)) {
			$data['limit_bestseller'] = $module_info['limit_bestseller'];
		} else {
			$data['limit_bestseller'] = 5;
		}

		if (isset($this->request->post['sort_bestseller'])) {
			$data['sort_bestseller'] = (int)$this->request->post['sort_bestseller'];
		} elseif (!empty($module_info)) {
			$data['sort_bestseller'] = $module_info['sort_bestseller'];
		} else {
			$data['sort_bestseller'] = 0;
		}

		if (isset($this->request->post['status_bestseller'])) {
			$data['status_bestseller'] = $this->request->post['status_bestseller'];
		} elseif (!empty($module_info)) {
			$data['status_bestseller'] = $module_info['status_bestseller'];
		} else {
			$data['status_bestseller'] = '';
		}

		if (isset($this->request->post['status_bestseller'])) {
			$data['status_bestseller'] = $this->request->post['status_bestseller'];
		} elseif (!empty($module_info)) {
			$data['status_bestseller'] = $module_info['status_bestseller'];
		} else {
			$data['status_bestseller'] = '';
		}
        
		if (isset($this->request->post['bestseller_xs'])) {
			$data['bestseller_xs'] = (int)$this->request->post['bestseller_xs'];
		} elseif (!empty($module_info)) {
			$data['bestseller_xs'] = $module_info['bestseller_xs'];
		} else {
			$data['bestseller_xs'] = 12;
		}

		if (isset($this->request->post['bestseller_sm'])) {
			$data['bestseller_sm'] = (int)$this->request->post['bestseller_sm'];
		} elseif (!empty($module_info)) {
			$data['bestseller_sm'] = $module_info['bestseller_sm'];
		} else {
			$data['bestseller_sm'] = 3;
		}

		if (isset($this->request->post['bestseller_md'])) {
			$data['bestseller_md'] = (int)$this->request->post['bestseller_md'];
		} elseif (!empty($module_info)) {
			$data['bestseller_md'] = $module_info['bestseller_md'];
		} else {
			$data['bestseller_md'] = 3;
		}

		if (isset($this->request->post['bestseller_lg'])) {
			$data['bestseller_lg'] = (int)$this->request->post['bestseller_lg'];
		} elseif (!empty($module_info)) {
			$data['bestseller_lg'] = $module_info['bestseller_lg'];
		} else {
			$data['bestseller_lg'] = 3;
		}

		if (isset($this->request->post['category_bestseller'])) {
			$data['category_bestseller'] = $this->request->post['category_bestseller'];
		} elseif (!empty($module_info)) {
			$data['category_bestseller'] = $module_info['category_bestseller'];
		} else {
			$data['category_bestseller'] = '';
		}
        
        // Latest
		if (isset($this->request->post['name_latest'])) {
			$data['name_latest'] = $this->request->post['name_latest'];
		} elseif (!empty($module_info)) {
			$data['name_latest'] = $module_info['name_latest'];
		} else {
			$data['name_latest'][] = $data['module_latest'];
		}

		if (isset($this->request->post['limit_latest'])) {
			$data['limit_latest'] = $this->request->post['limit_latest'];
		} elseif (!empty($module_info)) {
			$data['limit_latest'] = $module_info['limit_latest'];
		} else {
			$data['limit_latest'] = 5;
		}

		if (isset($this->request->post['sort_latest'])) {
			$data['sort_latest'] = (int)$this->request->post['sort_latest'];
		} elseif (!empty($module_info)) {
			$data['sort_latest'] = $module_info['sort_latest'];
		} else {
			$data['sort_latest'] = 0;
		}

		if (isset($this->request->post['status_latest'])) {
			$data['status_latest'] = $this->request->post['status_latest'];
		} elseif (!empty($module_info)) {
			$data['status_latest'] = $module_info['status_latest'];
		} else {
			$data['status_latest'] = '';
		}
        
		if (isset($this->request->post['status_latest'])) {
			$data['status_latest'] = $this->request->post['status_latest'];
		} elseif (!empty($module_info)) {
			$data['status_latest'] = $module_info['status_latest'];
		} else {
			$data['status_latest'] = '';
		}
        
		if (isset($this->request->post['latest_xs'])) {
			$data['latest_xs'] = (int)$this->request->post['latest_xs'];
		} elseif (!empty($module_info)) {
			$data['latest_xs'] = $module_info['latest_xs'];
		} else {
			$data['latest_xs'] = 12;
		}

		if (isset($this->request->post['latest_sm'])) {
			$data['latest_sm'] = (int)$this->request->post['latest_sm'];
		} elseif (!empty($module_info)) {
			$data['latest_sm'] = $module_info['latest_sm'];
		} else {
			$data['latest_sm'] = 3;
		}

		if (isset($this->request->post['latest_md'])) {
			$data['latest_md'] = (int)$this->request->post['latest_md'];
		} elseif (!empty($module_info)) {
			$data['latest_md'] = $module_info['latest_md'];
		} else {
			$data['latest_md'] = 3;
		}

		if (isset($this->request->post['latest_lg'])) {
			$data['latest_lg'] = (int)$this->request->post['latest_lg'];
		} elseif (!empty($module_info)) {
			$data['latest_lg'] = $module_info['latest_lg'];
		} else {
			$data['latest_lg'] = 3;
		}

		if (isset($this->request->post['category_latest'])) {
			$data['category_latest'] = $this->request->post['category_latest'];
		} elseif (!empty($module_info)) {
			$data['category_latest'] = $module_info['category_latest'];
		} else {
			$data['category_latest'] = '';
		}
        
        // Special
		if (isset($this->request->post['name_special'])) {
			$data['name_special'] = $this->request->post['name_special'];
		} elseif (!empty($module_info)) {
			$data['name_special'] = $module_info['name_special'];
		} else {
			$data['name_special'][] = $data['module_special'];
		}

		if (isset($this->request->post['limit_special'])) {
			$data['limit_special'] = $this->request->post['limit_special'];
		} elseif (!empty($module_info)) {
			$data['limit_special'] = $module_info['limit_special'];
		} else {
			$data['limit_special'] = 5;
		}

		if (isset($this->request->post['sort_special'])) {
			$data['sort_special'] = (int)$this->request->post['sort_special'];
		} elseif (!empty($module_info)) {
			$data['sort_special'] = $module_info['sort_special'];
		} else {
			$data['sort_special'] = 0;
		}

		if (isset($this->request->post['status_special'])) {
			$data['status_special'] = $this->request->post['status_special'];
		} elseif (!empty($module_info)) {
			$data['status_special'] = $module_info['status_special'];
		} else {
			$data['status_special'] = '';
		}
        
		if (isset($this->request->post['status_special'])) {
			$data['status_special'] = $this->request->post['status_special'];
		} elseif (!empty($module_info)) {
			$data['status_special'] = $module_info['status_special'];
		} else {
			$data['status_special'] = '';
		}
        
		if (isset($this->request->post['special_xs'])) {
			$data['special_xs'] = (int)$this->request->post['special_xs'];
		} elseif (!empty($module_info)) {
			$data['special_xs'] = $module_info['special_xs'];
		} else {
			$data['special_xs'] = 12;
		}

		if (isset($this->request->post['special_sm'])) {
			$data['special_sm'] = (int)$this->request->post['special_sm'];
		} elseif (!empty($module_info)) {
			$data['special_sm'] = $module_info['special_sm'];
		} else {
			$data['special_sm'] = 3;
		}

		if (isset($this->request->post['special_md'])) {
			$data['special_md'] = (int)$this->request->post['special_md'];
		} elseif (!empty($module_info)) {
			$data['special_md'] = $module_info['special_md'];
		} else {
			$data['special_md'] = 3;
		}

		if (isset($this->request->post['special_lg'])) {
			$data['special_lg'] = (int)$this->request->post['special_lg'];
		} elseif (!empty($module_info)) {
			$data['special_lg'] = $module_info['special_lg'];
		} else {
			$data['special_lg'] = 3;
		}

		if (isset($this->request->post['category_special'])) {
			$data['category_special'] = $this->request->post['category_special'];
		} elseif (!empty($module_info)) {
			$data['category_special'] = $module_info['category_special'];
		} else {
			$data['category_special'] = '';
		}
        
        // Owl Carousel
		if (isset($this->request->post['status_carousel'])) {
			$data['status_carousel'] = $this->request->post['status_carousel'];
		} elseif (!empty($module_info)) {
			$data['status_carousel'] = $module_info['status_carousel'];
		} else {
			$data['status_carousel'] = '';
		}
        
		if (isset($this->request->post['items'])) {
			$data['items'] = $this->request->post['items'];
		} elseif (!empty($module_info)) {
			$data['items'] = $module_info['items'];
		} else {
			$data['items'] = 4;
		}
        
		if (isset($this->request->post['autoplay'])) {
			$data['autoplay'] = $this->request->post['autoplay'];
		} elseif (!empty($module_info)) {
			$data['autoplay'] = $module_info['autoplay'];
		} else {
			$data['autoplay'] = 5000;
		}
        
		if (isset($this->request->post['hover'])) {
			$data['hover'] = $this->request->post['hover'];
		} elseif (!empty($module_info)) {
			$data['hover'] = $module_info['hover'];
		} else {
			$data['hover'] = 0;
		}
        
		if (isset($this->request->post['prev'])) {
			$data['prev'] = $this->request->post['prev'];
		} elseif (!empty($module_info)) {
			$data['prev'] = $module_info['prev'];
		} else {
			$data['prev'] = htmlentities($this->language->get('nav_prev'));
		}
        
		if (isset($this->request->post['next'])) {
			$data['next'] = $this->request->post['next'];
		} elseif (!empty($module_info)) {
			$data['next'] = $module_info['next'];
		} else {
			$data['next'] = htmlentities($this->language->get('nav_next'));
		}
        
		if (isset($this->request->post['navigation'])) {
			$data['navigation'] = $this->request->post['navigation'];
		} elseif (!empty($module_info)) {
			$data['navigation'] = $module_info['navigation'];
		} else {
			$data['navigation'] = 1;
		}
        
		if (isset($this->request->post['pagination'])) {
			$data['pagination'] = $this->request->post['pagination'];
		} elseif (!empty($module_info)) {
			$data['pagination'] = $module_info['pagination'];
		} else {
			$data['pagination'] = 1;
		}
        
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/four_in_tab', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/four_in_tab')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}

		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}
}