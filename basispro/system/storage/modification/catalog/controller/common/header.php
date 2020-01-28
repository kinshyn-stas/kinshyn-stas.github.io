<?php
class ControllerCommonHeader extends Controller {

            //added template
            private function getHtml($module) {
                $this->load->model('extension/module');
                $html_data = '';

                if (isset($module) && $module != '0') {
                    $html_data = array();
                    $part = explode('.', $module);

                    if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
                        $html_data[] = $this->load->controller('extension/module/' . $part[0]);
                    }

                    if (isset($part[1])) {
                        $setting_info = $this->model_extension_module->getModule($part[1]);
                        if ($setting_info && $setting_info['status']) {
                            $html_data[] = $this->load->controller('extension/module/' . $part[0], $setting_info);
                        }
                    }

                    if (isset($html_data[0])) {
                        $html_data = $html_data[0];
                    } else {
                        $html_data ='';
                    }

                }

                return $html_data;
            }
            //added template
			
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();

    // OCFilter start
    $data['noindex'] = $this->document->isNoindex();
    // OCFilter end
      
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

            //added template
            $data['search_link'] = $this->url->link('product/search');
            $this->load->language('common/template');

         /*   $this->load->model('catalog/information_category');
            $information_categories = $this->model_catalog_information_category->getInformationCategorys();

            $data['information_categories'] = array();
            foreach ($information_categories as $information_category) {
                if ($information_category['status'] == 1) {
                    $data['information_categories'][] = array(
                        'information_category_id' => $information_category['information_category_id'],
                        'name' => $information_category['name'],
                        'href' => $this->url->link('information/information_category', 'information_category_id=' .  $information_category['information_category_id'])
                    );
                }
            } */
            $data['text_info'] = $this->language->get('text_info');
            $data['topleft_html_module'] = $this->getHtml($this->config->get('config_topleft_html_module'));
            $data['top_html_module'] = $this->getHtml($this->config->get('config_top_html_module'));
            $data['top_info'] = $this->config->get('config_top_info');

            $data['telephone_add'] = nl2br($this->config->get('config_telephone_add'));
            $data['header_phone'] = $this->config->get('config_header_phone');
            $data['header_phone_add'] = $this->config->get('config_header_phone_add');
            $data['header_widget'] = $this->config->get('config_header_widget');
            $data['header_html_module'] = $this->getHtml($this->config->get('config_header_html_module'));
            if($this->config->get('config_widget_code')){
                $operators = explode(PHP_EOL, $this->config->get('config_widget_code'));
                $data['widget_phones'] = array();
                 foreach($operators as $operator){
                    $operator_array = explode("==", $operator);
                     $data['widget_phones'][] = array(
                         'operator' => $operator_array[0],
                         'code' => $operator_array[1],
                         'phone' => $operator_array[2]
                     );
                };
            }

            $data['premenu_html_module'] = $this->getHtml($this->config->get('config_premenu_html_module'));
            $data['aftermenu_html_module'] = $this->getHtml($this->config->get('config_aftermenu_html_module'));

            $data['color_theme_id'] = $this->config->get('config_color_theme_id');
            $data['maincolor'] = $this->config->get('config_maincolor');
            $data['mainhovercolor'] = $this->config->get('config_mainhovercolor');
            $data['custom_css'] = $this->config->get('config_custom_css');
            //added template
			
		$data['og_url'] = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1));
		$data['og_image'] = $this->document->getOgImage();

		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_page'] = $this->language->get('text_page');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		
                //added
                if ($this->config->get('config_light_field_status')) {
                    $data['checkout'] = $this->url->link('checkout/light_checkout', '', true);
                } else {
                    $data['checkout'] = $this->url->link('checkout/checkout', '', true);
                }
            
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}


      	$this->load->model('newsblog/category');
        $this->load->model('newsblog/article');

		$data['newsblog_categories'] = array();

		$categories = $this->model_newsblog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['settings']) {
				$settings=unserialize($category['settings']);
				if ($settings['show_in_top']==0) continue;
			}

			$articles = array();

			if ($category['settings'] && $settings['show_in_top_articles']) {
				$filter=array('filter_category_id'=>$category['category_id'],'filter_sub_category'=>true);
				$results = $this->model_newsblog_article->getArticles($filter);

				foreach ($results as $result) {
					$articles[] = array(
						'name'        => $result['name'],
						'href'        => $this->url->link('newsblog/article', 'newsblog_path=' . $category['category_id'] . '&newsblog_article_id=' . $result['article_id'])
					);
				}
            }
			$data['categories'][] = array(
				'name'     => $category['name'],
				'children' => $articles,
				'column'   => 1,
				'href'     => $this->url->link('newsblog/category', 'newsblog_path=' . $category['category_id'])
			);
		}
		
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

            //added
            if (isset($this->request->get['route'])) {
                $route = str_replace('/', '-', $this->request->get['route']);
            } else {
                $route = 'common-home';
            }
            $data['scripts_to_footer'] = false;
            $data['merge_css'] = $this->config->get('config_merge_css');
            $data['inline_css'] = $this->config->get('config_inline_css');

            $path_str = substr($route, 0, 8);
            if ((($path_str == 'common-h') || ($path_str == 'product-') || ($path_str == 'informat')) && ($this->config->get('config_move_scripts') == 1)) {
                $data['scripts_to_footer'] = true;
            };
            if ($this->config->get('config_merge_css')) {
                $css = array(
                    HTTP_SERVER . 'catalog/view/theme/default/javascript/bootstrap/css/bootstrap.min.css',
                    HTTP_SERVER . 'catalog/view/theme/default/stylesheet/stylesheet.css',
                    HTTP_SERVER . 'catalog/view/theme/default/stylesheet/responsive.css'
                );

                $modules = array();
                foreach ($data['styles'] as $key => $value) {
                    $modules[$key] = $value['href'];
                }
                $css = array_merge($css, $modules);

                function compress($buffer)
                {
                    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
                    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
                    return $buffer;
                }

                $css_content = '';

                $cache_filename = DIR_CACHE . 'style_' . $route . '.css';
                $cache_style = glob($cache_filename);

                if ($cache_style) {
                    if ($this->config->get('config_inline_css')) {
                        $data['css_content'] = file_get_contents($cache_filename);
                    }
                } else {
                    foreach ($css as $css_file) {
                        $css_content .= compress(file_get_contents($css_file));
                    }
                    if ($this->config->get('config_inline_css')) {
                        $data['css_content'] = $css_content;
                    }
                    $file = $cache_filename;
                    $handle = fopen($file, 'w');
                    flock($handle, LOCK_EX);
                    fwrite($handle, $css_content);
                    fflush($handle);
                    flock($handle, LOCK_UN);
                    fclose($handle);
                }
                $data['cache_style'] = HTTP_SERVER . 'system/storage/cache/style_' . $route . '.css';
            }
            //added
            

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		return $this->load->view('common/header', $data);
	}
}
