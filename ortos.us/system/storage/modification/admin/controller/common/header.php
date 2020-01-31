<?php
class ControllerCommonHeader extends Controller {
	public function index() {

        // start: OCdevWizard SMBPP
        $this->load->language('extension/ocdevwizard/smart_blog_pro_plus_widget');
        $this->load->model('extension/ocdevwizard/smart_blog_pro_plus');
        $this->load->model('extension/ocdevwizard/ocdevwizard_setting');
        $this->model_extension_ocdevwizard_smart_blog_pro_plus->createDBTables();
        $data['smbpp_form_data'] = $smbpp_form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData('smart_blog_pro_plus_form_data', (int)$this->config->get('config_store_id'));
        // end: OCdevWizard SMBPP
      
		$data['title'] = $this->document->getTitle();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['code'] = $this->language->get('code');
		$data['lang'] = $this->language->get('lang');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_order'] = $this->language->get('text_order');
		$data['text_processing_status'] = $this->language->get('text_processing_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('common/dashboard', '', true);
		} else {
			$data['logged'] = true;

			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], true);

			// Orders
			$this->load->model('sale/order');

			// Processing Orders
			$data['processing_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_processing_status'))));
			$data['processing_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_processing_status')), true);

			// Complete Orders
			$data['complete_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_complete_status'))));
			$data['complete_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_complete_status')), true);

			// Returns
			$this->load->model('sale/return');

			$return_total = $this->model_sale_return->getTotalReturns(array('filter_return_status_id' => $this->config->get('config_return_status_id')));

			$data['return_total'] = $return_total;

			$data['return'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'], true);

			// Customers
			$this->load->model('report/customer');

			$data['online_total'] = $this->model_report_customer->getTotalCustomersOnline();

			$data['online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], true);

			$this->load->model('customer/customer');

			$customer_total = $this->model_customer_customer->getTotalCustomers(array('filter_approved' => false));

			$data['customer_total'] = $customer_total;
			$data['customer_approval'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&filter_approved=0', true);

			// Products
			$this->load->model('catalog/product');

			$product_total = $this->model_catalog_product->getTotalProducts(array('filter_quantity' => 0));

			$data['product_total'] = $product_total;

			$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&filter_quantity=0', true);

			// Reviews
			$this->load->model('catalog/review');

			
                $this->load->model('extension/module/smreview');
			    $review_total = $this->model_extension_module_smreview->getTotalReviews(array('filter_status' => 0));
            

			$data['review_total'] = $review_total;

			
                $data['review'] = $this->url->link('extension/module/smreview/getlist', 'token=' . $this->session->data['token'] . '&filter_status=0', true);
            

			// Affliate
			$this->load->model('marketing/affiliate');

			$affiliate_total = $this->model_marketing_affiliate->getTotalAffiliates(array('filter_approved' => false));

			$data['affiliate_total'] = $affiliate_total;
			$data['affiliate_approval'] = $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'] . '&filter_approved=1', true);

            /*** cgs ***/
            $this->load->language('catalog/answertab');
            $this->load->model('catalog/answertab');
            $page = 1;
            $filter_data = array(
                'filter_status'     => 0,
                'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit'             => $this->config->get('config_limit_admin')
            );

            $answer_total = $this->model_catalog_answertab->getTotalAnswers($filter_data);
            $data['ansewrtab_total'] = $answer_total;
            $data['ansewrtab'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&filter_status=0', true);
            $data['answer_text'] = $this->language->get('heading_title');
			/*** cgs ***/
			

			$data['alerts'] = $customer_total + $product_total + $review_total + $return_total + $affiliate_total;

        // start: OCdevWizard SMBPP
        if (isset($smbpp_form_data['activate']) && $smbpp_form_data['activate'] && $smbpp_form_data['show_on_top_notification']) {
          $data['text_smart_blog_pro_plus'] = $this->language->get('text_smart_blog_pro_plus');
          $data['text_total_smart_blog_pro_plus_1'] = $this->language->get('text_total_smart_blog_pro_plus_1');
          $data['text_total_smart_blog_pro_plus_2'] = $this->language->get('text_total_smart_blog_pro_plus_2');
          $data['text_total_smart_blog_pro_plus_3'] = $this->language->get('text_total_smart_blog_pro_plus_3');
          $data['text_total_smart_blog_pro_plus_4'] = $this->language->get('text_total_smart_blog_pro_plus_4');
          $data['smart_blog_pro_plus_url'] = $this->url->link('extension/ocdevwizard/smart_blog_pro_plus', 'token='.$this->session->data['token'], 'SSL');
          $data['total_smart_blog_pro_plus_1'] = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalCategories();
          $data['total_smart_blog_pro_plus_2'] = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalPosts();
          $data['total_smart_blog_pro_plus_3'] = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalAuthors();
          $data['total_smart_blog_pro_plus_4'] = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalComments();
          $smart_blog_pro_plus_today = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalComments(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));
		      $smart_blog_pro_plus_yesterday = $this->model_extension_ocdevwizard_smart_blog_pro_plus->getTotalComments(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));
          $data['total_smart_blog_pro_plus_5'] = $smart_blog_pro_plus_today - $smart_blog_pro_plus_yesterday;
          $data['alerts'] = $data['alerts'] + $data['total_smart_blog_pro_plus_5'];
        }
        // end: OCdevWizard SMBPP
      

            /*** cgs ***/
            $data['alerts'] = $data['alerts'] + $answer_total;
			/*** cgs ***/
			

			// Online Stores
			$data['stores'] = array();

			$data['stores'][] = array(
				'name' => $this->config->get('config_name'),
				'href' => HTTP_CATALOG
			);

			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();

			foreach ($results as $result) {
				$data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url']
				);
			}
		}

		return $this->load->view('common/header', $data);
	}
}
