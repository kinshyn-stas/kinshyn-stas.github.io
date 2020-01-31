<?php
class ControllerExtensionModuleFourInTab extends Controller {
	public function index($setting) {
	    static $module = 0;
        
		$this->load->language('extension/module/four_in_tab');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('extension/module/four_in_tab');
		$this->load->model('tool/image');
        
        $data['module_data'] = array();

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);
		} else {
			$category_id = 0;
		}

		// Featured featured
        if (!empty($setting['product']) && $setting['status_featured'] == 1) {
            if (!$setting['limit_featured']) {
                $setting['limit_featured'] = 4;
            }
            
            if ($setting['category_featured'] == 1 && $category_id) {
                $products = $this->model_extension_module_four_in_tab->getFeaturedProducts($setting['product'], $category_id);
            } else {
                $products = array_slice($setting['product'], 0, (int)$setting['limit_featured']);
            }
            
            if ($products) {
                foreach ($products as $product_id) {
			        $product_info = $this->model_extension_module_four_in_tab->getProduct($product_id);

			        if ($product_info) {
			    	    if ($product_info['image']) {
			    	    	$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
			    	    } else {
				        	$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				        }

				        if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				            $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				        } else {
				        	$price = false;
				        }

			    	    if ((float)$product_info['special']) {
			    	    	$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				        } else {
				        	$special = false;
				        }

				        if ($this->config->get('config_tax')) {
					        $tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
				        } else {
				        	$tax = false;
				        }

				        if ($this->config->get('config_review_status')) {
				        	$rating = $product_info['rating'];
				        } else {
				        	$rating = false;
				        }

				        $products_featured[] = array(
				    	    'product_id'  => $product_info['product_id'],
				    	    'thumb'       => $image,
							'name'        => $product_info['name'],
							'model'        => $product_info['model'],
							'upc'        => $product_info['upc'],
							'ean'        => $product_info['ean'],
							'jan'        => $product_info['jan'],
							'isbn'        => $product_info['isbn'],
				    	    'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['limit_description']) . '..',
				        	'price'       => $price,
				        	'special'     => $special,
					        'tax'         => $tax,
					        'rating'      => $rating,
					        'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
			        	);
		        	}
	        	}
            
                $data['module_data'][] = array(
                    'id'       => 'featured',
                	'name'     => html_entity_decode($setting['name_featured'][$this->config->get('config_language_id')]),
                    'sort'     => $setting['sort_featured'],
                    'xs'       => $setting['featured_xs'],
                    'sm'       => $setting['featured_sm'],
                    'md'       => $setting['featured_md'],
                    'lg'       => $setting['featured_lg'],
                    'products' => $products_featured
			    );
            }
        }

        // Bestseller bestseller
        if ($setting['status_bestseller'] == 1) {
            if ($setting['category_bestseller'] == 1 && $category_id) {
                $results = $this->model_extension_module_four_in_tab->getBestSellerProducts($setting['limit_bestseller'], $category_id);
            } else {
                $results = $this->model_extension_module_four_in_tab->getBestSellerProducts($setting['limit_bestseller']);
            }

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
			    		$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			    	} else {
				    	$special = false;
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

				    $products_bestseller[] = array(
				    	'product_id'  => $result['product_id'],
				    	'thumb'       => $image,
						'name'        => $result['name'],
						'model'        => $result['model'],
						'upc'        => $result['upc'],
							'ean'        => $result['ean'],
							'jan'        => $result['jan'],
							'isbn'        => $result['isbn'],
				    	'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['limit_description']) . '..',
				    	'price'       => $price,
					    'special'     => $special,
					    'tax'         => $tax,
					    'rating'      => $rating,
					    'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			    	);
		    	}
            
            	$data['module_data'][] = array(
                	'id'       => 'bestseller',
            		'name'     => html_entity_decode($setting['name_bestseller'][$this->config->get('config_language_id')]),
                	'sort'     => $setting['sort_bestseller'],
                	'xs'       => $setting['bestseller_xs'],
                	'sm'       => $setting['bestseller_sm'],
                	'md'       => $setting['bestseller_md'],
                	'lg'       => $setting['bestseller_lg'],
                	'products' => $products_bestseller
				);
		    }
        }

		// Latest latest
        if ($setting['status_latest'] == 1) {
            if ($setting['category_latest'] == 1 && $category_id) {
                $filter_data = array(
                    'filter_category_id' => $category_id,
		       	    'sort'  => 'p.date_added',
		    	    'order' => 'DESC',
		    	    'start' => 0,
		    	    'limit' => $setting['limit_latest']
	    	    );
            } else {
		        $filter_data = array(
		       	    'sort'  => 'p.date_added',
		    	    'order' => 'DESC',
		    	    'start' => 0,
		    	    'limit' => $setting['limit_latest']
	    	    );
            }

	    	$results = $this->model_extension_module_four_in_tab->getProducts($filter_data);

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
			    		$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			    	} else {
				    	$special = false;
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

			    	$products_latest[] = array(
				    	'product_id'  => $result['product_id'],
				    	'thumb'       => $image,
						'name'        => $result['name'],
						'model'        => $result['model'],
						'upc'        => $result['upc'],
							'ean'        => $result['ean'],
							'jan'        => $result['jan'],
							'isbn'        => $result['isbn'],
				    	'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['limit_description']) . '..',
				    	'price'       => $price,
				    	'special'     => $special,
				    	'tax'         => $tax,
				    	'rating'      => $rating,
				    	'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			    	);
		    	}
            
                $data['module_data'][] = array(
                	'id'       => 'latest',
            		'name'     => html_entity_decode($setting['name_latest'][$this->config->get('config_language_id')]),
                	'sort'     => $setting['sort_latest'],
                	'xs'       => $setting['latest_xs'],
                	'sm'       => $setting['latest_sm'],
                	'md'       => $setting['latest_md'],
                	'lg'       => $setting['latest_lg'],
                	'products' => $products_latest
				);
	    	}
        }
        
        // Special special
        if ($setting['status_special'] == 1) {
            if (!($setting['category_special'] == 1 && $category_id)) {
                $category_id = 0;
            }

			$filter_data = array(
                'filter_category_id' => $category_id,
				'sort'  => 'pd.name',
				'order' => 'ASC',
				'start' => 0,
				'limit' => $setting['limit_special']
			);

			$results = $this->model_extension_module_four_in_tab->getProductSpecials($filter_data);

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
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
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

					$products_special[] = array(
						'product_id'  => $result['product_id'],
						'thumb'       => $image,
						'name'        => $result['name'],
						'model'        => $result['model'],
						'upc'        => $result['upc'],
							'ean'        => $result['ean'],
							'jan'        => $result['jan'],
							'isbn'        => $result['isbn'],
						'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['limit_description']) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
					);
				}
            
            	$data['module_data'][] = array(
                	'id'       => 'special',
            		'name'     => html_entity_decode($setting['name_special'][$this->config->get('config_language_id')]),
                	'sort'     => $setting['sort_special'],
                	'xs'       => $setting['special_xs'],
                	'sm'       => $setting['special_sm'],
                	'md'       => $setting['special_md'],
                	'lg'       => $setting['special_lg'],
                	'products' => $products_special
				);
			}
        }
        
        // Owl Carousel
        $data['carousel'] = array();
        
        if ($setting['status_carousel'] == 1) {
            $this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
            $this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

            $data['carousel_status']     = true;
            $data['carousel_items']      = $setting['items'];
            $data['carousel_autoplay']   = $setting['autoplay'];
            $data['carousel_hover']      = $setting['hover'] ? 'true' : 'false';
            $data['carousel_prev']       = html_entity_decode($setting['prev']);
            $data['carousel_next']       = html_entity_decode($setting['next']);
            $data['carousel_navigation'] = $setting['navigation'] ? 'true' : 'false';
            $data['carousel_pagination'] = $setting['pagination'] ? 'true' : 'false';
        }
        
        if (!empty($data['module_data'])) {
            // Получение списка столбцов
            foreach ($data['module_data'] as $key => $row) {
                $sort[$key]  = $row['sort'];
                $name[$key]  = $row['name'];
            }
        
            // Сортируем данные по sort по возрастанию и по name по возрастанию
            // Добавляем $data['module_data'] в качестве последнего параметра, для сортировки по общему ключу
            array_multisort($sort, SORT_ASC, $name, SORT_ASC, $data['module_data']);            
        }
        
        $data['module'] = $module++;
        $data['description'] = $setting['description'];
        $data['adaptive'] = $setting['adaptive'];
        $data['theme'] = $setting['theme'];
        
        return $this->load->view('extension/module/four_in_tab', $data);
	}
}