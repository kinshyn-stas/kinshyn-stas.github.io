<?php
class ControllerCommonContentTop extends Controller {
	public function index() {
		$this->load->model('design/layout');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}

		$layout_id = 0;

			if ($route == 'blog/blog' && isset($this->request->get['blog_id'])) { $this->load->model('blog/blog');
			$layout_id = $this->model_blog_blog->getBlogLayoutId($this->request->get['blog_id']);}
			if ($route == 'blog/category' && isset($this->request->get['blogpath'])) { $this->load->model('blog/blog_category');
			$layout_id = $this->model_blog_blog_category->getBlogCategoryLayoutId($this->request->get['blogpath']);}
			

		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$this->load->model('catalog/category');

			$path = explode('_', (string)$this->request->get['path']);

			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
		}

		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$this->load->model('catalog/product');

			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
		}

		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$this->load->model('catalog/information');

			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}

		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}

		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}

		$this->load->model('extension/module');

		$data['modules'] = array();

		$modules = $this->model_design_layout->getLayoutModules($layout_id, 'content_top');


        // start: OCdevWizard SMBPP
        $this->load->model('extension/ocdevwizard/smart_blog_pro_plus');

        $smbpp_modules = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getModules($layout_id, 'content_top');

        if ($smbpp_modules) {
          $modules = array_merge($modules, $smbpp_modules);

          $sort_order = [];

          foreach ($modules as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
          }

          array_multisort($sort_order, SORT_ASC, $modules);
        }
        // end: OCdevWizard SMBPP
      
		foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$module_data = $this->load->controller('extension/module/' . $part[0]);

				if ($module_data) {
					$data['modules'][] = $module_data;
				}
			}

			if (isset($part[1])) {

        // start: OCdevWizard SMBPP
        if ($part[1] && $part[0] == 'smart_blog_pro_plus') {
          $data['modules'][] = $this->load->controller('extension/ocdevwizard/smart_blog_pro_plus_static', $this->model_extension_ocdevwizard_smart_blog_pro_plus->getModule($part[1]));
        }
        // end: OCdevWizard SMBPP
      
				$setting_info = $this->model_extension_module->getModule($part[1]);

				if ($setting_info && $setting_info['status']) {
					$output = $this->load->controller('extension/module/' . $part[0], $setting_info);

					if ($output) {
						$data['modules'][] = $output;
					}
				}
			}
		}

		return $this->load->view('common/content_top', $data);
	}
}
