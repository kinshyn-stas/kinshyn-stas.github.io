<?php
class ControllerCommonFooter extends Controller {

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
		$this->load->language('common/footer');

            //added template
            /* $this->load->model('catalog/information_category');
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
            $data['address'] = nl2br($this->config->get('config_address'));
            $data['telephone'] = $this->config->get('config_telephone');
            $data['show_scrollup'] = $this->config->get('config_show_scrollup');
            $data['telephone_add'] = nl2br($this->config->get('config_telephone_add'));

            $data['footerone_html_module'] = $this->getHtml($this->config->get('config_footerone_html_module'));
            $data['footertwo_html_module'] = $this->getHtml($this->config->get('config_footertwo_html_module'));
            $data['footerthree_html_module'] = $this->getHtml($this->config->get('config_footerthree_html_module'));
            $data['footerfour_html_module'] = $this->getHtml($this->config->get('config_footerfour_html_module'));
            $data['povered_html_module'] = $this->getHtml($this->config->get('config_povered_html_module'));

            $data['footer_banners'] = array();
            if ($this->config->get('config_footer_banner_id')) {
                $this->load->model('design/banner');
                $this->load->model('tool/image');
                $results = $this->model_design_banner->getBanner($this->config->get('config_footer_banner_id'));
                foreach ($results as $result) {
                    if (is_file(DIR_IMAGE . $result['image'])) {
                        $data['footer_banners'][] = array(
                            'title' => $result['title'],
                            'link'  => $result['link'],
                            'oimage'  => HTTP_SERVER . 'image/' . $result['image'],
                            'image' => $this->model_tool_image->resize($result['image'], 44, 44)
                        );
                    }
                }
            }

            //added template
    			

		$data['scripts'] = $this->document->getScripts('footer');

            //added
            $data['scripts_to_footer'] = false;
            if (isset($this->request->get['route'])) {
                $route = str_replace('/', '-', $this->request->get['route']);
            } else {
                $route = 'common-home';
            }

            $path_str = substr($route, 0, 8);
            if ((($path_str == 'common-h' ) || ($path_str == 'product-' ) || ($path_str == 'informat' )) && ($this->config->get('config_move_scripts') == 1)) {
                $data['scripts'] = array_merge($data['scripts'], $this->document->getScripts());
                $data['scripts_to_footer'] = true;
            }
            //added
            

		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/account', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		return $this->load->view('common/footer', $data);
	}
}
