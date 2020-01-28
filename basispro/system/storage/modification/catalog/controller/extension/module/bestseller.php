<?php
class ControllerExtensionModuleBestSeller extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/bestseller');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');


		$this->load->language('extension/module/cheaper');
		$data['text_cheaper'] = $this->language->get('text_cheaper');
		if ($this->config->get('cheaper_ssmb')) {$data['cheaper_ssmb'] = $this->config->get('cheaper_ssmb');} else {$data['cheaper_ssmb'] = 0;}
            
		$this->load->model('catalog/product');

		$this->load->model('tool/image');


				$data['position'] = ''; //$setting['position'];
			
		$data['products'] = array();

			    //added template
			    $this->load->language('common/template');
			    $data['label_1'] = $this->language->get('label_1');
			    $data['label_2'] = $this->language->get('label_2');
			    $data['label_3'] = $this->language->get('label_3');
			    $data['label_4'] = $this->language->get('label_4');
			    $data['label_5'] = $this->language->get('label_5');
			    $data['label_special'] = $this->language->get('label_special');
				//added template
			

		$results = $this->model_catalog_product->getBestSellerProducts($setting['limit']);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {

                $percent = round(($result['price'] - $result['special']) / $result['price'] * 100);
			
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;

                $percent = false;
			
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(

			    'percent'         => $percent,
			    'short_description'  => nl2br($result['short_description']),
                'promo_label_id'  => $result['promo_label_id'],
                'quantity'        => $result['quantity'],
                'stock_status'    => $result['stock_status'],
			
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('extension/module/bestseller', $data);
		}
	}
}
