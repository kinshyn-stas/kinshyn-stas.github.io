<?php
class ControllerExtensionModuleSlideshowExtend extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner_extend');
		$this->load->model('tool/image');

        $this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/product-banner.css');
        $this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['banners'] = array();
        $product_info = array();

		$results = $this->model_design_banner_extend->getBanner($setting['banner_id']);

		foreach ($results as $result) {

            if ($result['product_id'] > 0) {
                $this->load->model('catalog/product');
                $product_info = $this->model_catalog_product->getProduct($result['product_id']);
            }

            if ($result['title']) {
                $title = $result['title'];
            } else {
                if ($result['product_id'] > 0) {
                    $title = $product_info['name'];
                } else {
                    $title = $result['title'];
                }
            }

            if ($result['title3']) {
                $title3 = nl2br($result['title3']);
            } else {
                if ($result['product_id'] > 0) {
                    if ($product_info['short_description']) {
                        $title3 = nl2br($product_info['short_description']);
                    } else {
                        $title3 = utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..';
                    }
                } else {
                    $title3 = nl2br($result['title3']);
                }
            }

            if ($result['link']) {
                $link = $result['link'];
            } else {
                if ($result['product_id'] > 0) {
                    $link = $this->url->link('product/product', 'product_id=' . $result['product_id']);
                } else {
                    $link = $result['link'];
                }
            }

            $setting['width'] = 360;
            $setting['height'] = 360;

            $image = false;
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
            } else {
                if ($result['product_id'] > 0) {
                    if ($product_info['image']) {
                        $image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
                    } else {
                        $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
                    }
                }
            }

            $price = false;
            if (($result['product_id'] > 0) && (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price'))) {
                $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            }

            $special = false;
            if (($result['product_id'] > 0) && (float)$product_info['special']) {
                $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            }

            if (is_file(DIR_IMAGE . $result['background_image'])) {
                $background_image = HTTP_SERVER . 'image/' . $result['background_image'];
            } else {
                $background_image = false;
            }

            $class_text = 'col-lg-offset-1 col-lg-5 col-md-7 col-xs-8';
            $class_image = 'col-lg-4 col-md-5 col-xs-4';

            if ($result['view'] == 2) {
                $class_text = 'col-lg-5 col-md-7 col-xs-8';
                $class_image = 'col-lg-offset-1 col-lg-4 col-md-5 col-xs-4';
            } elseif (($result['view'] == 3) || ($result['view'] == 4)) {
                $class_text = 'col-lg-7 col-md-7 col-xs-8';
                $class_image = 'col-lg-5 col-md-5 col-xs-4';
            } elseif (($result['view'] == 5) || ($result['view'] == 6)) {
                $class_text = $result['text_css'];
                $class_image = $result['photo_css'];
            }

            $data['banners'][] = array(
                'title'             => $title,
                'title2'            => $result['title2'],
                'title3'            => $title3,
                'link'              => $link,
                'view'              => $result['view'],
                'text_type'         => $result['text_type'],
                'price'             => $price,
                'special'           => $special,
                'show_price'        => $result['show_price'],
                'image'             => $image,
                'background_image'  => $background_image,
                'class_text'        => $class_text,
                'class_image'       => $class_image,
                'bg_style'          => $result['bg_style']
            );

		}

		$data['module'] = $module++;

		return $this->load->view('extension/module/slideshow_extend', $data);
	}
}
