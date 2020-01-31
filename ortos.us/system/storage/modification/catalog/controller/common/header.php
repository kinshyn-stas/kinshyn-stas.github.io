<?php
class ControllerCommonHeader extends Controller {

        // start: OCdevWizard
        public function ocdevwizard_js_create($data) {
          if ($data) {
            $ocdevwizard_script  = "var ocdev_modules = [];
";

            if (isset($data['smca_status']) && $data['smca_status'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=ocdevwizard/smart_cart',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (isset($data['smpcp_status']) && $data['smpcp_status'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=ocdevwizard/smart_popup_cart_pro',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (isset($data['smpcpp_status']) && $data['smpcpp_status'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=ocdevwizard/smart_popup_cart_pro_plus',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (isset($data['smac_status']) && $data['smac_status'] == 1 && $data['smart_abandoned_cart'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=ocdevwizard/smart_abandoned_cart',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (isset($data['smchup_status']) && $data['smchup_status'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=extension/ocdevwizard/smart_checkout_upsell_pro',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (isset($data['smchupp_status']) && $data['smchupp_status'] == 1) {
              $ocdevwizard_script .= "ocdev_modules.push({
";
              $ocdevwizard_script .= "  src: 'index.php?route=extension/ocdevwizard/smart_checkout_upsell_pro_plus',
";
              $ocdevwizard_script .= "  type:'ajax'
";
              $ocdevwizard_script .= "});
";
            }

            if (!file_exists(DIR_APPLICATION.'view/javascript/ocdevwizard/ocdevwizard.js')) {
              file_put_contents(DIR_APPLICATION.'view/javascript/ocdevwizard/ocdevwizard.js', $ocdevwizard_script);
            }
          }
        }
        // end: OCdevWizard
      

        // start: OCdevWizard SMBPP
        public function smbpp_js_create($data) {
        if ($data) {
          $script  = "";
          $script .= "function show_youtube(youtube_code, block) {
";
          $script .= "  $(block).html('<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/' + youtube_code + '?controls=1&rel=0&showinfo=0&autoplay=1&enablejsapi=1&cc_load_policy=1\" frameborder=\"0\" allowfullscreen></iframe>');
";
          $script .= "}
";

          if ($data['minify_main_js']) {
            $script = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $script);
            if ($data['minify_main_js'] == 1) {
              $script = str_replace(array("
", "
"), "
", $script);
            } else {
              $script = str_replace(array("
", "
"), "", $script);
            }
            $script = preg_replace('/[^\S
]+/', ' ', $script);
            $script = str_replace(array(" 
", "
 "), "
", $script);
            $script = preg_replace('/
+/', "
", $script);
            $script = str_replace(': ', ':', $script);
            $script = preg_replace(array('(( )+{)','({( )+)'), '{', $script);
            $script = preg_replace(array('(( )+})','(}( )+)','(;( )*})'), '}', $script);
            $script = preg_replace(array('(;( )+)','(( )+;)'), ';', $script);
            $script = str_replace(array(' {',' }','{ ','; '),array('{','}','{',';'), $script);
          }

          if (!file_exists(DIR_APPLICATION.'view/javascript/ocdevwizard/smart_blog_pro_plus/main.js')) {
            file_put_contents(DIR_APPLICATION.'view/javascript/ocdevwizard/smart_blog_pro_plus/main.js', $script);
          }
        }
      }
      // end: OCdevWizard SMBPP
      
	public function index() {

		if ($this->registry->get('config')->get('progroman_cm_status')) {
            $this->document->addScript('catalog/view/javascript/progroman/jquery.progroman.autocomplete.js');
            $this->document->addScript('catalog/view/javascript/progroman/jquery.progroman.city-manager.js');
            $this->document->addStyle('catalog/view/javascript/progroman/progroman.city-manager.css');
        }
            

        // start: OCdevWizard SMCH
        $this->load->model('ocdevwizard/ocdevwizard_setting');
      
        $smch_form_data         = $this->model_ocdevwizard_ocdevwizard_setting->getSettingData('smart_checkout_form_data');  
        $smch_store_id          = (int)$this->config->get('config_store_id');
        $smch_customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');
        $smch_customer_groups   = isset($smch_form_data['customer_groups']) ? $smch_form_data['customer_groups'] : array();
        $smch_stores            = isset($smch_form_data['stores']) ? $smch_form_data['stores'] : array();
        $data['smch_form_data'] = $smch_form_data;
        $data['moment_js_dir']  = 'catalog/view/javascript/jquery/datetimepicker/';

        if (isset($smch_form_data['activate']) && $smch_form_data['activate'] && !in_array($smch_customer_group_id, $smch_customer_groups) && !in_array($smch_store_id, $smch_stores)) {
          $data['smch_status'] = 1;    
        } else {
          $data['smch_status'] = 0;
        }
        // end: OCdevWizard SMCH
      

        // start: OCdevWizard SMBPP
        $this->load->model('extension/ocdevwizard/ocdevwizard_setting');

        $smbpp_form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData('smart_blog_pro_plus_form_data', (int)$this->config->get('config_store_id'));

        if (isset($smbpp_form_data['activate']) && $smbpp_form_data['activate']) {
          $this->document->addStyle("catalog/view/theme/default/stylesheet/ocdevwizard/smart_blog_pro_plus/stylesheet.css?v=".$smbpp_form_data['front_module_version']);
         
          
          $this->load->model('extension/ocdevwizard/smart_blog_pro_plus');

          $language_id = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getLanguageByCode($this->session->data['language']);
          
          if (isset($smbpp_form_data['direction_type'][$language_id]) && $smbpp_form_data['direction_type'][$language_id] == '2') {
            $this->document->addStyle("catalog/view/theme/default/stylesheet/ocdevwizard/smart_blog_pro_plus/stylesheet_rtl.css?v=".$smbpp_form_data['front_module_version']);
          }

          $smbpp_open_graph = '';

          if (isset($this->request->get['route']) && $this->request->get['route'] == 'extension/ocdevwizard/smart_blog_pro_plus/post' && ($smbpp_form_data['allow_open_graph_on_post'] == 1 || $smbpp_form_data['allow_twitter_card_on_post'] == 1)) {
            
            if (isset($this->request->get['smbpp_post_id'])) {
              $smbpp_post_id = (int)$this->request->get['smbpp_post_id'];
            } else {
              $smbpp_post_id = 0;
            }

            $smbpp_post_info = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getPost($smbpp_post_id);
      
            if ($smbpp_post_info) {
              $this->load->model('tool/image');

              if ($smbpp_form_data['allow_open_graph_on_post'] == 1) {
                $smbpp_open_graph .= '<meta property="og:url" content="'.$this->url->link('extension/ocdevwizard/smart_blog_pro_plus/post', 'smbpp_path='.$smbpp_post_info['main_category_id'].'&smbpp_post_id='.$smbpp_post_info['post_id']).'">'."
";
                $smbpp_open_graph .= '<meta property="og:type" content="article">'."
";
                $smbpp_open_graph .= '<meta property="og:title" content="'.$smbpp_post_info['name'].'">'."
";
                $smbpp_open_graph .= '<meta property="og:description" content="'.$smbpp_post_info['short_description'].'">'."
";
                $smbpp_open_graph .= '<meta property="og:image" content="'.$this->model_tool_image->resize($smbpp_post_info['image'], $smbpp_post_info['main_image_width'], $smbpp_post_info['main_image_height']).'">'."
";
              }

              if ($smbpp_form_data['allow_twitter_card_on_post'] == 1) {
                $smbpp_open_graph .= '<meta name="twitter:card" content="summary" />'."
";
                $smbpp_open_graph .= '<meta name="twitter:url" content="'.$this->url->link('extension/ocdevwizard/smart_blog_pro_plus/post', 'smbpp_path='.$smbpp_post_info['main_category_id'].'&smbpp_post_id='.$smbpp_post_info['post_id']).'" />'."
";
                $smbpp_open_graph .= '<meta name="twitter:title" content="'.$smbpp_post_info['name'].'" />'."
";
                $smbpp_open_graph .= '<meta name="twitter:description" content="'.$smbpp_post_info['short_description'].'" />'."
";
                $smbpp_open_graph .= '<meta name="twitter:image:src" content="'.$this->model_tool_image->resize($smbpp_post_info['image'], $smbpp_post_info['main_image_width'], $smbpp_post_info['main_image_height']).'" />'."
";
              }
            }
          }

          $data['smbpp_open_graph'] = $smbpp_open_graph;

          $this->smbpp_js_create($smbpp_form_data);

          if (file_exists(DIR_APPLICATION.'view/javascript/ocdevwizard/smart_blog_pro_plus/main.js')) {
            $this->document->addScript("catalog/view/javascript/ocdevwizard/smart_blog_pro_plus/main.js?v=".$smbpp_form_data['front_module_version']);
          }
        }
        // end: OCdevWizard SMBPP
      

        // start: OCdevWizard
        $ocdevwizard_modules = array();

        if (isset($smca_status)) {
          $ocdevwizard_modules['smca_status'] = $smca_status;
        }

        if (isset($smpcp_status)) {
          $ocdevwizard_modules['smpcp_status'] = $smpcp_status;
        }

        if (isset($smpcpp_status)) {
          $ocdevwizard_modules['smpcpp_status'] = $smpcpp_status;
        }

        if (isset($smac_status)) {
          $ocdevwizard_modules['smac_status'] = $smac_status;
          $ocdevwizard_modules['smart_abandoned_cart'] = $smart_abandoned_cart;
        }

        if (!isset($smca_status) && !isset($smpcp_status) && !isset($smpcpp_status) && !isset($smac_status)) {
          if (isset($smchup_status)) {
            $ocdevwizard_modules['smchup_status'] = $smchup_status;
          }

          if (isset($smchupp_status)) {
            $ocdevwizard_modules['smchupp_status'] = $smchupp_status;
          }
        }

        $this->ocdevwizard_js_create($ocdevwizard_modules);

        if (file_exists(DIR_APPLICATION.'view/javascript/ocdevwizard/ocdevwizard.js')) {
          $this->document->addScript("catalog/view/javascript/ocdevwizard/ocdevwizard.js");
        }
        // end: OCdevWizard
      
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


            // YUMenu
            $yumenus = $this->config->get('yumenu_main');
            $data['yumenus'] = array();

            if ($yumenus) {
                $this->load->model('extension/module');

                $main_menus = array();

                foreach ($yumenus as $menu_id) {
                    $setting_info = $this->model_extension_module->getModule($menu_id);

                    if ($setting_info && $setting_info['status']) {
                        $main_menus[] = $setting_info;

                        $sort_order = array();
                        foreach ($main_menus as $key => $value) {
                            $sort_order[$key] = isset($value['main_sort']) ? $value['main_sort'] : 0;
                        }
                        array_multisort($sort_order, SORT_ASC, $main_menus);
                    }
                }

                foreach ($main_menus as $main_menu) {
                    $output = $this->load->controller('extension/module/yumenu', $main_menu);

                    if ($output) {
                        $data['yumenus'][] = $output;
                    }
                }
            }
            
		$data['title'] = $this->document->getTitle();


                //OCEXT SEO URL GENERATOR - microdata
                $this->load->model('extension/module/seourlgenerator');
                $microdataseourlgenerator = $this->model_extension_module_seourlgenerator->getScript();
                if($microdataseourlgenerator){
                    $data['analytics'][] = $microdataseourlgenerator;
                }
                //end OCEXT SEO URL GENERATOR - microdata



		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');
		$data['og_url'] = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1));
		$data['og_image'] = $this->document->getOgImage();

		$data['text_home'] = $this->language->get('text_home');
		$data['text_help1'] = $this->language->get('text_help1');
		$data['text_open'] = $this->language->get('text_open');

		$data['text_account0'] = $this->language->get('text_account0');
		$data['text_wishlist0'] = $this->language->get('text_wishlist0');
		$data['text_compare0'] = $this->language->get('text_compare0');
		$data['text_srav'] = $this->language->get('text_srav');
		$data['text_srav2'] = $this->language->get('text_srav2');

		$data['language_id'] = $this->config->get('config_language_id'); 
		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
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
		$data['compare'] = $this->url->link('product/compare', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['open'] = $this->config->get('config_open');
		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = array();

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

				'sort_order' => $category['sort_order'],
			
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		
	 
			if($this->config->get('megamenu_status')=="1")
			{
			
		$this->load->language('extension/module/megamenu');
		$this->load->model('extension/module/megamenu');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		
		
	 
		$data['heading_title'] = $this->language->get('heading_title');		
	
		$data['items']=array();
		$tmp_items= $this->model_extension_module_megamenu->getItems();
		if(count($tmp_items))
		{
			foreach($tmp_items as $item){
			if($item['menu_type']=="category")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseCategory($item);
			}
			if($item['menu_type']=="html")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseHtml($item);
			}
            if($item['menu_type']=="link")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseLink($item);
			}
			if($item['menu_type']=="manufacturer")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseManufacturer($item);
			}
			if($item['menu_type']=="information")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseInformation($item);
			}
			if($item['menu_type']=="product")	{
			$data['items'][]=$this->model_extension_module_megamenu->parseProduct($item);
			}	
			if($item['menu_type']=="auth" && !$this->customer->isLogged())	{
			$data['items'][]=$this->model_extension_module_megamenu->parseAuth($item);
			}
				
				
			}
			
			
			
		}
		
		//auth
		$this->load->language('account/login');
		$this->load->language('extension/module/megamenu');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['text_register'] = $this->language->get('text_register');
		$data['menu_title'] = $this->language->get('menu_title');
		
		$data['button_login'] = $this->language->get('button_login');
		$data['action'] = $this->url->link('account/login', '', true);
		$data['email'] = "";
		$data['register'] = $this->url->link('account/register', '', true);
		$data['forgotten'] = $this->url->link('account/forgotten', '', true);
		$data['use_megamenu']=true;
	    }
		else
		$data['use_megamenu']=false;
		
	   
		$data['categories'] = array();
		$data['supermenu'] = $this->load->controller('module/supermenu');
		$data['supermenu_settings'] = $this->load->controller('module/supermenu_settings');
		$data['language'] = $this->load->controller('common/language/langNew');
		
			
	
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

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
