<?php

// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com> 
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

class ControllerOcdevwizardSmartCheckout extends Controller {

  static $_module_version = '2.0.1';
  static $_module_name    = 'smart_checkout';

  public function index() {
    $data = array();

    // connect models array
    $models = array(
      'catalog/product', 
      'tool/image', 
      'extension/extension',
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
      $this->session->data['tmp_product_id'] = $product_id;
    } else {
      die();
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data'), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $text_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data');
    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $product_info = $this->model_catalog_product->getProduct($product_id);

    $data['product_options']     = (array)$this->model_catalog_product->getProductOptions($product_id);
    $data['product_id']          = $product_id;
    $data['product_name']        = $product_info['name'];    
    $data['product_model']       = $product_info['model'];
    $data['product_ean']         = $product_info['ean'];
    $data['product_jan']         = $product_info['jan'];
    $data['product_isbn']        = $product_info['isbn'];
    $data['product_mpn']         = $product_info['mpn'];
    $data['product_location']    = $product_info['location'];
    $data['product_description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
    $data['attribute_groups']    = $this->model_catalog_product->getProductAttributes($product_id);

    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    if (isset($text_data[$language_id])) {
      $data['heading_title'] = $text_data[$language_id]['heading'];
      $data['text_info'] = html_entity_decode($text_data[$language_id]['info_message'], ENT_QUOTES, 'UTF-8');
      $data['button_send'] = html_entity_decode($text_data[$language_id]['send_button'], ENT_QUOTES, 'UTF-8');
      $data['button_go_back'] = html_entity_decode($text_data[$language_id]['continue_shopping_button'], ENT_QUOTES, 'UTF-8');
    }    

    $data['thumb'] = ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $form_data['main_image_width'], $form_data['main_image_height']) : $this->model_tool_image->resize("no_image.png", $form_data['main_image_width'], $form_data['main_image_height']);

    $data['main_thumb'] = ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $form_data['sub_images_width'], $form_data['sub_images_height']) : $this->model_tool_image->resize("no_image.png", $form_data['sub_images_width'], $form_data['sub_images_height']);

    $data['main_popup'] = ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $form_data['main_image_width'], $form_data['main_image_height']) : $this->model_tool_image->resize("no_image.png", $form_data['main_image_width'], $form_data['main_image_height']);

    $data['images'] = array();
    $images_array = (array)$this->model_catalog_product->getProductImages($product_id);
    $images_new_array = array_splice($images_array, 0, $form_data['count_sub_images'], true);

    foreach ($images_new_array as $sub_image) {
      $data['images'][] = array(
        'popup' => ($sub_image['image']) ? $this->model_tool_image->resize($sub_image['image'], $form_data['main_image_width'], $form_data['main_image_height']) : $this->model_tool_image->resize("no_image.png", $form_data['main_image_width'], $form_data['main_image_height']),
        'thumb' => ($sub_image['image']) ? $this->model_tool_image->resize($sub_image['image'], $form_data['sub_images_width'], $form_data['sub_images_height']) : $this->model_tool_image->resize("no_image.png", $form_data['sub_images_width'], $form_data['sub_images_height'])
     );
    }

    // add main image to sub images list
    $data['images'][] =  array(
      'popup' => ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $form_data['main_image_width'], $form_data['main_image_height']) : $this->model_tool_image->resize("no_image.png", $form_data['main_image_width'], $form_data['main_image_height']),
      'thumb' => ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $form_data['sub_images_width'], $form_data['sub_images_height']) : $this->model_tool_image->resize("no_image.png", $form_data['sub_images_width'], $form_data['sub_images_height'])
    );

    // product price
    if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
      $data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
    } else {
      $data['price'] = false;
    }

    // product special
    if ((float)$product_info['special']) {
      $data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
    } else {
      $data['special'] = false;
    }

    // product tax
    if ($this->config->get('config_tax')) {
      $data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
    } else {
      $data['tax'] = false;
    }

    // product discount
    $data['discounts'] = array(); 

    foreach ((array)$this->model_catalog_product->getProductDiscounts($product_id) as $discount) {
      $data['discounts'][] = array(
        'quantity' => $discount['quantity'],
        'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
      );
    }

    if (isset($this->request->request['option'])) {
      $option = $this->request->request['option'];
    } else {
      $option = array();
    }

    if (isset($this->request->request['quantity'])) {
      $quantity = (int)$this->request->request['quantity'];
    } else {
      $quantity = 1;
    }

    if (isset($this->request->request['recurring_id'])) {
      $recurring_id = $this->request->request['recurring_id'];
    } else {
      $recurring_id = 0;
    }

    $product_key = (int)$product_id;

    $product_in_old_cart = $this->cart->getProducts();

    // remove this product from cart
    if (isset($product_in_old_cart[$product_key])) {
      $this->cart->remove($product_key);
    }

    // save current cart and clear old sessions
    $current_cart = $this->cart->getProducts();
    $this->session->data['current_cart'] = $current_cart; 
    $this->cart->clear();

    // add current product to cart
    $this->cart->add($product_id, $quantity, $option, $recurring_id); 

    // totals and total
    $totals = array();
    $taxes = $this->cart->getTaxes();
    $total = 0;

    // Because __call can not keep var references so we put them into an array. 
    $total_data = array(
      'totals' => &$totals,
      'taxes'  => &$taxes,
      'total'  => &$total
    );

    $sort_order = array();

    $results = $this->model_extension_extension->getExtensions('total');

    foreach ($results as $key => $value) {
      $sort_order[$key] = $this->config->get($value['code'].'_sort_order');
    }

    array_multisort($sort_order, SORT_ASC, $results);

    foreach ($results as $result) {
      if ($this->config->get($result['code'].'_status')) {
        $this->load->model('extension/total/'.$result['code']);

        // We have to put the totals in an array so that they pass by reference.
        $this->{'model_extension_total_'.$result['code']}->getTotal($total_data);
      }
    }

    $sort_order = array();

    foreach ($totals as $key => $value) {
      $sort_order[$key] = $value['sort_order'];
    }

    array_multisort($sort_order, SORT_ASC, $totals);

    foreach ($totals as $value) {
      if ($value['code'] == 'total') {
        $data['total'] = $this->currency->format($value['value'], $this->session->data['currency']);
      }
    }

    $points = $this->customer->getRewardPoints();
    $data['tab_reward'] = sprintf($this->language->get('tab_reward'), $points);
    if (isset($this->session->data['reward'])) {
      $data['reward'] = $this->session->data['reward'];
    } else {
      $data['reward'] = '';
    }
    
    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_index.tpl', $data));
  }

  public function user() {
    $data = array();

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

    // connect models array
    $models = array(
      'account/customer', 
      'localisation/country', 
      'catalog/product', 
      'catalog/information',
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data'), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    $product_options = (array)$this->model_catalog_product->getProductOptions($product_id);

    if ($product_options) {
      $data['user_button_next'] = $this->language->get('button_select_options');
    } elseif ((isset($form_data['shipping_code_array']) && !isset($form_data['payment_code_array'])) || (isset($form_data['shipping_code_array']) && isset($form_data['payment_code_array']))) {
      $data['user_button_next'] = $this->language->get('button_select_shipping');
    } elseif (!isset($form_data['shipping_code_array']) && isset($form_data['payment_code_array'])) {
      $data['user_button_next'] = $this->language->get('button_select_payment');
    } else {
      $data['user_button_next'] = false;
    }

    // checkout terms
    $data['informations'] = array();

    if (isset($form_data['require_information']) && $form_data['require_information']) {
      $informations = $this->model_catalog_information->getInformation((int)$form_data['require_information']);
      $data['informations'] = sprintf($this->language->get('text_require_information'), $this->url->link('information/information', 'information_id='.$form_data['require_information']), $informations['title']);
    }

    $product_countries = (isset($form_data['product_countries'])) ? $form_data['product_countries'] : '';

    $data['countries'] = array();

    if ($product_countries) {
      foreach ($this->model_localisation_country->getCountries() as $country) {
        if (in_array($country['country_id'], $product_countries)) {
          $data['countries'][] = $this->model_localisation_country->getCountry($country['country_id']);
        }
      }
    }

    $customer_info = ($this->customer->isLogged()) ? $this->model_account_customer->getCustomer($this->customer->getId()) : FALSE;

    $customer_info_data = array('firstname', 'lastname', 'email', 'telephone', 'fax');

    $data['fields_data'] = array();

    foreach ($this->getActiveField() as $field) {
      switch ($field['position']) {
        case '1': $position = "left"; break;
        case '2': $position = "right"; break;
        case '3': $position = "center"; break;
      }

      $data['fields_data'][] = array(
        'activate'         => $field['activate'],
        'title'            => $field['title'][$language_id],
        'value'            => $this->replaceValue($field['view'], 1),
        'name'             => $this->replaceValue($field['view'], 2),
        'type'             => $this->replaceValue($field['view'], 1),
        'check'            => $field['check'],
        'error_text'       => $field['error_text'],
        'css_id'           => $field['css_id'],
        'css_class'        => $field['css_class'],
        'position'         => $position,
        'placeholder_text' => $field['placeholder_text'][$language_id],
        'mask'             => $field['mask']
     );

      if (isset($this->request->post[ $this->replaceValue($field['view'], 2) ])) {
        $data['input_value'][$this->replaceValue($field['view'], 2)] = $this->request->post[$this->replaceValue($field['view'], 2)];
      } elseif ($customer_info && in_array($this->replaceValue($field['view'], 2), $customer_info_data)) {
        $data['input_value'][$this->replaceValue($field['view'], 2)] = $customer_info[$this->replaceValue($field['view'], 2)];
      } else {
        $data['input_value'][$this->replaceValue($field['view'], 2)] = '';
      }
    }

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_user.tpl', $data));
  }

  public function user_save() {
    $json = array();

    // connect models array
    $models = array(
      'localisation/country', 
      'localisation/zone', 
      'catalog/information',
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('ocdevwizard/'.self::$_module_name);

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    // validate fields
    foreach ($this->getActiveField() as $field) {
      if (empty($this->request->request[$field['view']]) && $field['check'] == 1) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } elseif (!empty($field['check_rule']) && !preg_match($field['check_rule'], $this->request->request[$field['view']]) && $field['check'] == 2) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } elseif (utf8_strlen(str_replace(array('_','-','(',')','+'), "", $this->request->request[$field['view']])) < $field['check_min'] || utf8_strlen(str_replace(array('_','-','(',')','+'), "", $this->request->request[$field['view']])) > $field['check_max'] && $field['check'] == 3) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } else {
         unset($json['error']['field'][$field['view']]);
      }
    }

    // validate require information
    if (!isset($this->request->request['require_information']) || empty($this->request->request['require_information'])) {
      if (isset($form_data['require_information'])) {
        $informations = (array)$this->model_catalog_information->getInformation((int)$form_data['require_information']);
        $json['error']['field']['require_information'] = sprintf($this->language->get('error_require_information'), $informations['title']);
      }
    }

    if (!isset($json['error'])) {
      $this->session->data['guest']['customer_group_id'] = $this->config->get('config_customer_group_id');
      $this->session->data['guest']['firstname'] = isset($this->request->request['firstname']) ? $this->request->request['firstname'] : '';
      $this->session->data['guest']['lastname'] = isset($this->request->request['lastname']) ? $this->request->request['lastname'] : '';
      $this->session->data['guest']['email'] = isset($this->request->request['email']) && !empty($this->request->request['email']) ? $this->request->request['email'] : $form_data['alternative_email'];
      $this->session->data['guest']['telephone'] = isset($this->request->request['telephone']) ? $this->request->request['telephone'] : '';
      $this->session->data['guest']['fax'] = isset($this->request->request['fax']) ? $this->request->request['fax'] : '';
      $country_id = isset($this->request->request['country_id']) ? $this->request->request['country_id'] : '';
      $zone_id = isset($this->request->request['zone_id']) ? $this->request->request['zone_id'] : '';
      $this->session->data['payment_address']['firstname'] = isset($this->request->request['firstname']) ? $this->request->request['firstname'] : '';
      $this->session->data['payment_address']['lastname'] = isset($this->request->request['lastname']) ? $this->request->request['lastname'] : '';
      $this->session->data['payment_address']['company'] = isset($this->request->request['company']) ? $this->request->request['company'] : '';
      $this->session->data['payment_address']['address_1'] = isset($this->request->request['address_1']) ? $this->request->request['address_1'] : '';
      $this->session->data['payment_address']['address_2'] = isset($this->request->request['address_2']) ? $this->request->request['address_2'] : '';
      $this->session->data['payment_address']['postcode'] = isset($this->request->request['postcode']) ? $this->request->request['postcode'] : '';
      $this->session->data['payment_address']['city'] = isset($this->request->request['city']) ? $this->request->request['city'] : '';
      $this->session->data['payment_address']['country_id'] = $country_id;
      $this->session->data['payment_address']['zone_id'] = $zone_id;
      $this->session->data['shipping_address']['firstname'] = isset($this->request->request['firstname']) ? $this->request->request['firstname'] : '';
      $this->session->data['shipping_address']['lastname'] = isset($this->request->request['lastname']) ? $this->request->request['lastname'] : '';
      $this->session->data['shipping_address']['company'] = isset($this->request->request['company']) ? $this->request->request['company'] : '';
      $this->session->data['shipping_address']['address_1'] = isset($this->request->request['address_1']) ? $this->request->request['address_1'] : '';
      $this->session->data['shipping_address']['address_2'] = isset($this->request->request['address_2']) ? $this->request->request['address_2'] : '';
      $this->session->data['shipping_address']['postcode'] = isset($this->request->request['postcode']) ? $this->request->request['postcode'] : '';
      $this->session->data['shipping_address']['city'] = isset($this->request->request['city']) ? $this->request->request['city'] : '';
      $this->session->data['shipping_address']['country_id'] = $country_id;
      $this->session->data['shipping_address']['zone_id'] = $zone_id;

      $this->session->data['comment'] = isset($this->request->request['comment']) ? $this->request->request['comment'] : '';

      foreach ($this->getActiveField() as $field) {
        if (!empty($this->request->request[$this->replaceValue($field['view'], 2)])) {
          if ($this->replaceValue($field['view'], 2) == 'text' || $this->replaceValue($field['view'], 2) == 'textarea' || $this->replaceValue($field['view'], 2) == 'comment') {
            $this->session->data['comment'] .= html_entity_decode($field['title'][$language_id].' : '.$this->request->request[$this->replaceValue($field['view'], 2)].'<br/><hr/>', ENT_QUOTES, 'UTF-8');
          }
        }
      }

      $country_info = $this->model_localisation_country->getCountry($country_id);

      if ($country_info) {
        $this->session->data['payment_address']['country'] = $country_info['name'];
        $this->session->data['payment_address']['iso_code_2'] = $country_info['iso_code_2'];
        $this->session->data['payment_address']['iso_code_3'] = $country_info['iso_code_3'];
        $this->session->data['payment_address']['address_format'] = $country_info['address_format'];

        $this->session->data['shipping_address']['country'] = $country_info['name'];
        $this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
        $this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
        $this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
      } else {
        $this->session->data['payment_address']['country'] = '';
        $this->session->data['payment_address']['iso_code_2'] = '';
        $this->session->data['payment_address']['iso_code_3'] = '';
        $this->session->data['payment_address']['address_format'] = '';

        $this->session->data['shipping_address']['country'] = '';
        $this->session->data['shipping_address']['iso_code_2'] = '';
        $this->session->data['shipping_address']['iso_code_3'] = '';
        $this->session->data['shipping_address']['address_format'] = '';
      }

      $zone_info = $this->model_localisation_zone->getZone($zone_id);

      if ($zone_info) {
        $this->session->data['payment_address']['zone'] = $zone_info['name'];
        $this->session->data['payment_address']['zone_code'] = $zone_info['code'];

        $this->session->data['shipping_address']['zone'] = $zone_info['name'];
        $this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
      } else {
        $this->session->data['payment_address']['zone'] = '';
        $this->session->data['payment_address']['zone_code'] = '';

        $this->session->data['shipping_address']['zone'] = '';
        $this->session->data['shipping_address']['zone_code'] = '';
      }

      unset($this->session->data['shipping_method']);
      unset($this->session->data['shipping_methods']);
      unset($this->session->data['payment_method']);
      unset($this->session->data['payment_methods']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function options() {
    $data = array();

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

    // connect models array
    $models = array(
      'catalog/product', 
      'tool/image',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data'), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $product_info = $this->model_catalog_product->getProduct($product_id);

    if ((isset($form_data['shipping_code_array']) && !isset($form_data['payment_code_array'])) || (isset($form_data['shipping_code_array']) && isset($form_data['payment_code_array']))) {
      $data['user_button_next'] = $this->language->get('button_select_shipping');
    } elseif (!isset($form_data['shipping_code_array']) && isset($form_data['payment_code_array'])) {
      $data['user_button_next'] = $this->language->get('button_select_payment');
    } else {
      $data['user_button_next'] = false;
    }

    // product options data
    $data['options'] = array();

    if (isset($form_data['product_options_array'])) {
      foreach ((array)$this->model_catalog_product->getProductOptions($product_id) as $option) { 
        if (in_array($option['option_id'], $form_data['product_options_array'])) {
          if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
            $option_value_data = array();

            foreach ($option['product_option_value'] as $option_value) {
              if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                  $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
                } else {
                  $price = false;
                }

                $option_image_width = !empty($form_data['option_images_width']) ? $form_data['option_images_width'] : 50;
                $option_image_height = !empty($form_data['option_images_height']) ? $form_data['option_images_height'] : 50;

                $option_value_data[] = array(
                  'product_option_value_id' => $option_value['product_option_value_id'],
                  'option_value_id'         => $option_value['option_value_id'],
                  'name'                    => $option_value['name'],
                  'image'                   => $this->model_tool_image->resize($option_value['image'], $option_image_width, $option_image_height),
                  'price'                   => $price,
                  'price_prefix'            => $option_value['price_prefix']
                );
              }
            }

            $data['options'][] = array(
              'product_option_id'    => $option['product_option_id'],
              'option_id'            => $option['option_id'],
              'name'                 => $option['name'],
              'type'                 => $option['type'],
              'product_option_value' => $option_value_data,
              'required'             => $option['required']
            );                  

          } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' 
                            // || $option['type'] == 'file' 
            || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time' 
          ) {
            $data['options'][] = array(
              'product_option_id' => $option['product_option_id'],
              'option_id'         => $option['option_id'],
              'name'              => $option['name'],
              'type'              => $option['type'],
              'value'             => $option['value'],
              'required'          => $option['required']
            );                      
          }
        }
      }
    }

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_options.tpl', $data));
  }

  public function options_save() {
    $json = array();

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

  	// connect models array
    $models = array(
      'catalog/product',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('ocdevwizard/'.self::$_module_name);

    if (isset($this->request->request['option'])) {
      $option = $this->request->request['option'];
    } else {
      $option = array();
    }

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $product_options = (array)$this->model_catalog_product->getProductOptions($product_id);

    // validate product options
    foreach ($product_options as $product_option) {
      if (in_array($product_option['option_id'], $form_data['product_options_array'])) {
        if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
          $json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_option'), $product_option['name']);
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function shipping() {
    $data = array();

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

    // connect models array
    $models = array(
      'extension/extension',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($this->request->request['option'])) {
      $option = $this->request->request['option'];
    } else {
      $option = array();
    }

    if (isset($this->request->request['quantity'])) {
      $quantity = (int)$this->request->request['quantity'];
    } else {
      $quantity = 1;
    }

    $product_key = (int)$product_id;

    $product_in_current_cart = $this->cart->getProducts();

    // remove this product from cart
    if (isset($product_in_current_cart[$product_key])) {
      $this->cart->remove($product_key);
    }

    // save current cart and clear old sessions
    $this->cart->clear();

    // add current product to cart
    $this->cart->add($product_id, $quantity, $option); 

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    if (isset($form_data['shipping_code_array']) && isset($form_data['payment_code_array'])) {
      $data['user_button_next'] = $this->language->get('button_select_payment');
    } elseif (isset($form_data['shipping_code_array']) && !isset($form_data['payment_code_array'])) {
      $data['user_button_next'] = $this->language->get('button_go_to_confirm');
    } else {
      $data['user_button_next'] = false;
    }

    if (isset($this->session->data['shipping_address'])) {
    	// shipping methods
      $method_data = array();

      $results = $this->model_extension_extension->getExtensions('shipping');

      foreach ($results as $result) {
        if ($this->config->get($result['code'].'_status')) {
          $this->load->model('extension/shipping/'.$result['code']);

          $quote = $this->{'model_extension_shipping_'.$result['code']}->getQuote($this->session->data['shipping_address']);

          if ($quote && in_array($result['code'], $form_data['shipping_code_array'])) {
            $method_data[$result['code']] = array(
              'title'      => $quote['title'],
              'quote'      => $quote['quote'],
              'sort_order' => $quote['sort_order'],
              'error'      => $quote['error']
            );
          }
        }
      }

      $sort_order = array();

      foreach ($method_data as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $method_data);

      $this->session->data['shipping_methods'] = $method_data;
    }

    if (empty($this->session->data['shipping_methods'])) {
      $data['error_warning_shipping'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
    } else {
      $data['error_warning_shipping'] = '';
    }

    $data['shipping_methods'] = isset($this->session->data['shipping_methods']) ? $this->session->data['shipping_methods'] : array();
    $data['code'] = isset($this->session->data['shipping_method']['code']) ? $this->session->data['shipping_method']['code'] : '';

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_shipping.tpl', $data));
  }

  public function shipping_save() {
    $json = array();

    $this->load->language('ocdevwizard/'.self::$_module_name);

    // validate shipping
    if (!isset($this->request->request['shipping_method']) || empty($this->request->request['shipping_method'])) {
      $json['error']['field']['shipping_method'] = $this->language->get('error_shipping');
    } else {
      $shipping = explode('.', $this->request->request['shipping_method']);

      if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
        $json['error']['field']['shipping_method'] = $this->language->get('error_shipping');
      }
    }

    if (!isset($json['error'])) {
      $this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function payment() {
    $data = array();

    // connect models array
    $models = array(
      'extension/extension',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    if (isset($this->session->data['payment_address'])) {
      // totals and total
      $totals = array();
      $taxes = $this->cart->getTaxes();
      $total = 0;

      // Because __call can not keep var references so we put them into an array. 
      $total_data = array(
        'totals' => &$totals,
        'taxes'  => &$taxes,
        'total'  => &$total
      );

      $sort_order = array();

      $results = $this->model_extension_extension->getExtensions('total');

      foreach ($results as $key => $value) {
        $sort_order[$key] = $this->config->get($value['code'].'_sort_order');
      }

      array_multisort($sort_order, SORT_ASC, $results);

      foreach ($results as $result) {
        if ($this->config->get($result['code'].'_status')) {
          $this->load->model('extension/total/'.$result['code']);

          // We have to put the totals in an array so that they pass by reference.
          $this->{'model_extension_total_'.$result['code']}->getTotal($total_data);
        }
      }

      $sort_order = array();

      foreach ($totals as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $totals);

    	// payment methods
      $method_data = array();

      $results = $this->model_extension_extension->getExtensions('payment');

      foreach ($results as $result) {
        if ($this->config->get($result['code'].'_status')) {
          $this->load->model('extension/payment/'.$result['code']);

          $method = $this->{'model_extension_payment_'.$result['code']}->getMethod($this->session->data['payment_address'], $total);

          if ($method && in_array($result['code'], $form_data['payment_code_array'])) {
            $method_data[$result['code']] = $method;
          }
        }
      }

      $sort_order = array();

      foreach ($method_data as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $method_data);

      $this->session->data['payment_methods'] = $method_data;
    }

    if (empty($this->session->data['payment_methods'])) {
      $data['error_warning_payment'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact'));
    } else {
      $data['error_warning_payment'] = '';
    }

    $data['payment_methods'] = isset($this->session->data['payment_methods']) ? $this->session->data['payment_methods'] : array();
    $data['code'] = isset($this->session->data['payment_method']['code']) ? $this->session->data['payment_method']['code'] : '';

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_payment.tpl', $data));
  }

  public function payment_save() {
    $json = array();

    $this->load->language('ocdevwizard/'.self::$_module_name);

    // validate payment
    if (!isset($this->request->request['payment_method']) || empty($this->request->request['payment_method'])) {
      $json['error']['field']['payment_method'] = $this->language->get('error_payment');
    } elseif (!isset($this->session->data['payment_methods'][$this->request->request['payment_method']])) {
      $json['error']['field']['payment_method'] = $this->language->get('error_payment');
    }

    if (!isset($json['error'])) {
      $this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->request['payment_method']];
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function confirm() {
    $data = array();

    // connect models array
    $models = array(
      'extension/extension', 
      'checkout/order', 
      'account/customer', 
      'affiliate/affiliate', 
      'checkout/marketing',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    // totals
    $totals = array();
    $taxes = $this->cart->getTaxes();
    $total = 0;

    // Because __call can not keep var references so we put them into an array.       
    $total_data = array(
      'totals' => &$totals,
      'taxes'  => &$taxes,
      'total'  => &$total
    );

    // Display prices
    if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
      $sort_order = array();

      $results = $this->model_extension_extension->getExtensions('total');

      foreach ($results as $key => $value) {
        $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
      }

      array_multisort($sort_order, SORT_ASC, $results);

      foreach ($results as $result) {
        if ($this->config->get($result['code'] . '_status')) {
          $this->load->model('extension/total/' . $result['code']);

          // We have to put the totals in an array so that they pass by reference.
          $this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
        }
      }

      $sort_order = array();

      foreach ($totals as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $totals);
    }

    // show totals info table
    $data['totals'] = array();

    // order totals
    foreach ($totals as $total) {
      $data['totals'][] = array(
        'title' => $total['title'],
        'text'  => $this->currency->format($total['value'], $this->session->data['currency'])
      );
    }

    // validate if payment method has been set
    if (!isset($this->session->data['payment_method'])) {
      $payment_status = true;
    }

    $order_data = array();

    if (!isset($payment_status)) {
      // totals and total
      $order_data['totals'] = array();
      $taxes = $this->cart->getTaxes();
      $total = 0;

      // Because __call can not keep var references so we put them into an array. 
      $total_data = array(
        'totals' => &$order_data['totals'],
        'taxes'  => &$taxes,
        'total'  => &$total
      );

      $sort_order = array();

      $results = $this->model_extension_extension->getExtensions('total');

      foreach ($results as $key => $value) {
        $sort_order[$key] = $this->config->get($value['code'].'_sort_order');
      }

      array_multisort($sort_order, SORT_ASC, $results);

      foreach ($results as $result) {
        if ($this->config->get($result['code'].'_status')) {
          $this->load->model('extension/total/'.$result['code']);

          // We have to put the totals in an array so that they pass by reference.
          $this->{'model_extension_total_'.$result['code']}->getTotal($total_data);
        }
      }

      $sort_order = array();

      foreach ($order_data['totals'] as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $order_data['totals']);

      // create order
      $order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
      $order_data['store_id']       = $this->config->get('config_store_id');
      $order_data['store_name']     = $this->config->get('config_name');
      $order_data['store_url']      = ($order_data['store_id']) ? $this->config->get('config_url') : HTTP_SERVER;

      if ($this->customer->isLogged()) {
        $customer_info = $this->model_account_customer->getCustomer($this->customer->getId());

        $order_data['customer_id']          = $this->customer->getId();
        $order_data['customer_group_id']    = $customer_info['customer_group_id'];
        $order_data['firstname']            = (!empty($form_data['prefix_order']) ? $form_data['prefix_order'] : '').$customer_info['firstname'];
        $order_data['lastname']             = $customer_info['lastname'];
        $order_data['email']                = $customer_info['email'];
        $order_data['telephone']            = $customer_info['telephone'];
        $order_data['fax']                  = $customer_info['fax'];
        $order_data['custom_field']         = array();
      } elseif (isset($this->session->data['guest'])) {
        $order_data['customer_id']          = 0;
        $order_data['customer_group_id']    = $this->session->data['guest']['customer_group_id'];
        $order_data['firstname']            = (!empty($form_data['prefix_order']) ? $form_data['prefix_order'] : '').$this->session->data['guest']['firstname'];
        $order_data['lastname']             = $this->session->data['guest']['lastname'];
        $order_data['email']                = $this->session->data['guest']['email'];
        $order_data['telephone']            = $this->session->data['guest']['telephone'];
        $order_data['fax']                  = $this->session->data['guest']['fax'];
        $order_data['custom_field']         = array();
      }

      $order_data['payment_firstname']        = $this->session->data['payment_address']['firstname'];
      $order_data['payment_lastname']         = $this->session->data['payment_address']['lastname'];
      $order_data['payment_company']          = $this->session->data['payment_address']['company'];
      $order_data['payment_address_1']        = $this->session->data['payment_address']['address_1'];
      $order_data['payment_address_2']        = $this->session->data['payment_address']['address_2'];
      $order_data['payment_city']             = $this->session->data['payment_address']['city'];
      $order_data['payment_postcode']         = $this->session->data['payment_address']['postcode'];
      $order_data['payment_zone']             = $this->session->data['payment_address']['zone'];
      $order_data['payment_zone_id']          = $this->session->data['payment_address']['zone_id'];
      $order_data['payment_country']          = $this->session->data['payment_address']['country'];
      $order_data['payment_country_id']       = $this->session->data['payment_address']['country_id'];
      $order_data['payment_address_format']   = $this->session->data['payment_address']['address_format'];
      $order_data['payment_custom_field']     = array();
      $order_data['payment_method']           = isset($this->session->data['payment_method']['title']) ? $this->session->data['payment_method']['title'] : '';
      $order_data['payment_code']             = isset($this->session->data['payment_method']['code']) ? $this->session->data['payment_method']['code'] : '';

      if ($this->cart->hasShipping()) {
        $order_data['shipping_firstname']      = $this->session->data['shipping_address']['firstname'];
        $order_data['shipping_lastname']       = $this->session->data['shipping_address']['lastname'];
        $order_data['shipping_company']        = $this->session->data['shipping_address']['company'];
        $order_data['shipping_address_1']      = $this->session->data['shipping_address']['address_1'];
        $order_data['shipping_address_2']      = $this->session->data['shipping_address']['address_2'];
        $order_data['shipping_city']           = $this->session->data['shipping_address']['city'];
        $order_data['shipping_postcode']       = $this->session->data['shipping_address']['postcode'];
        $order_data['shipping_zone']           = $this->session->data['shipping_address']['zone'];
        $order_data['shipping_zone_id']        = $this->session->data['shipping_address']['zone_id'];
        $order_data['shipping_country']        = $this->session->data['shipping_address']['country'];
        $order_data['shipping_country_id']     = $this->session->data['shipping_address']['country_id'];
        $order_data['shipping_address_format'] = $this->session->data['shipping_address']['address_format'];
        $order_data['shipping_custom_field']   = array();
        $order_data['shipping_method']         = isset($this->session->data['shipping_method']['title']) ? $this->session->data['shipping_method']['title'] : '';
        $order_data['shipping_code']           = isset($this->session->data['shipping_method']['code']) ? $this->session->data['shipping_method']['code'] : '';
      } else {
        $order_data['shipping_firstname']       = '';
        $order_data['shipping_lastname']        = '';
        $order_data['shipping_company']         = '';
        $order_data['shipping_address_1']       = '';
        $order_data['shipping_address_2']       = '';
        $order_data['shipping_city']            = '';
        $order_data['shipping_postcode']        = '';
        $order_data['shipping_zone']            = '';
        $order_data['shipping_zone_id']         = '';
        $order_data['shipping_country']         = '';
        $order_data['shipping_country_id']      = '';
        $order_data['shipping_address_format']  = '';
        $order_data['shipping_custom_field']    = array();
        $order_data['shipping_method']          = '';
        $order_data['shipping_code']            = '';
      }

      $order_data['products'] = array();

      foreach ($this->cart->getProducts() as $product) {
        $option_data = array();

        foreach ($product['option'] as $option) {
          $option_data[] = array(
            'product_option_id'       => $option['product_option_id'],
            'product_option_value_id' => $option['product_option_value_id'],
            'option_id'               => $option['option_id'],
            'option_value_id'         => $option['option_value_id'],
            'name'                    => $option['name'],
            'value'                   => $option['value'],
            'type'                    => $option['type']
          );
        }

        $order_data['products'][] = array(
          'product_id' => $product['product_id'],
          'name'       => $product['name'],
          'model'      => $product['model'],
          'option'     => $option_data,
          'download'   => $product['download'],
          'quantity'   => $product['quantity'],
          'subtract'   => $product['subtract'],
          'price'      => $product['price'],
          'total'      => $product['total'],
          'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
          'reward'     => $product['reward']
        );
      }

      // Gift Voucher
      $order_data['vouchers'] = array();

      if ($form_data['hide_voucher'] && !empty($this->session->data['vouchers'])) {
        foreach ($this->session->data['vouchers'] as $voucher) {
          $order_data['vouchers'][] = array(
            'description'      => $voucher['description'],
            'code'             => substr(md5(mt_rand()), 0, 10),
            'to_name'          => $voucher['to_name'],
            'to_email'         => $voucher['to_email'],
            'from_name'        => $voucher['from_name'],
            'from_email'       => $voucher['from_email'],
            'voucher_theme_id' => $voucher['voucher_theme_id'],
            'message'          => $voucher['message'],
            'amount'           => $voucher['amount']
          );
        }
      }

      $order_data['comment'] = $this->session->data['comment'];
      $order_data['total'] = $total;

      if (isset($this->request->cookie['tracking'])) {
        $order_data['tracking'] = $this->request->cookie['tracking'];

        $subtotal = $this->cart->getSubTotal();

        // affiliate
        $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

        if ($affiliate_info) {
          $order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
          $order_data['commission']   = ($subtotal / 100) * $affiliate_info['commission'];
        } else {
          $order_data['affiliate_id'] = 0;
          $order_data['commission']   = 0;
        }

        // marketing
        $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

        $order_data['marketing_id'] = ($marketing_info) ? $marketing_info['marketing_id'] : 0;
      } else {
        $order_data['affiliate_id'] = 0;
        $order_data['commission'] = 0;
        $order_data['marketing_id'] = 0;
        $order_data['tracking'] = '';
      }

      $order_data['language_id'] = $this->config->get('config_language_id');
      $order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
      $order_data['currency_code'] = $this->session->data['currency'];
      $order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
      $order_data['ip'] = $this->request->server['REMOTE_ADDR'];

      if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
        $order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
      } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
        $order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
      } else {
        $order_data['forwarded_ip'] = '';
      }

      $order_data['user_agent'] = isset($this->request->server['HTTP_USER_AGENT']) ? $this->request->server['HTTP_USER_AGENT'] : '';
      $order_data['accept_language'] = isset($this->request->server['HTTP_ACCEPT_LANGUAGE']) ? $this->request->server['HTTP_ACCEPT_LANGUAGE'] : '';

      $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);
      $this->session->data['tmp_output'] = true;

      $data['transfer_payments_status'] = false;

      if (isset($this->session->data['payment_method']))  {
        if (isset($form_data['transfer_payments'])) {
          foreach ($form_data['transfer_payments'] as $value) {
            if ($this->session->data['payment_method']['code'] == $value) {
              $data['transfer_payments_status'] = true;
						}
          }
        }
      }

      // show payment info
      $data['payment'] = '';

      if (isset($this->session->data['payment_method'])) {
        $data['payment'] = $this->load->controller('extension/payment/'.$this->session->data['payment_method']['code']);
      }
    }

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_confirm.tpl', $data));
  }

  // confirm_save_complete - complete checkout process with shipping and payment methods.

  public function confirm_save_complete() {
    $json = array();

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

    if (isset($this->request->request['quantity'])) {
      $quantity = (int)$this->request->request['quantity'];
    } else {
      $quantity = 1;
    }

    // connect models array
    $models = array(
      'catalog/product', 
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->load->language('ocdevwizard/'.self::$_module_name);

    $text_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data');
    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    if (isset($this->session->data['order_id'])) {
      $order_id = (int)$this->session->data['order_id'];

      $total = $this->{'model_ocdevwizard_'.self::$_module_name}->getOrderTotal($order_id);
      $totals = $this->{'model_ocdevwizard_'.self::$_module_name}->getOrderTotals($order_id);

      $code_find = array(
        '{firstname}',
        '{lastname}',
        '{email}',
        '{total}',
        '{address_1}',
        '{address_2}',
        '{telephone}',
        '{fax}',
        '{postcode}',
        '{city}',
        '{order_id}',
        '{comment}'
      );

      $code_replace = array(
        isset($this->request->request['firstname']) ? $this->request->request['firstname'] : '',
        isset($this->request->request['lastname']) ? $this->request->request['lastname'] : '',
        isset($this->request->request['email']) ? $this->request->request['email'] : '',
        $this->currency->format($total, $this->session->data['currency']),
        isset($this->request->request['address_1']) ? $this->request->request['address_1'] : '',
        isset($this->request->request['address_2']) ? $this->request->request['address_2'] : '',
        isset($this->request->request['telephone']) ? $this->request->request['telephone'] : '',
        isset($this->request->request['fax']) ? $this->request->request['fax'] : '',
        isset($this->request->request['postcode']) ? $this->request->request['postcode'] : '',
        isset($this->request->request['city']) ? $this->request->request['city'] : '',
        $order_id,
        isset($this->request->request['comment']) ? $this->request->request['comment'] : ''
      );

      if (isset($text_data[$language_id])) {
        $json['output'] = html_entity_decode(str_ireplace($code_find, $code_replace, $text_data[$language_id]['success_text']), ENT_QUOTES, 'UTF-8');
        $json['button_go_back'] = html_entity_decode($text_data[$language_id]['continue_shopping_button'], ENT_QUOTES, 'UTF-8');
      }

      if ($form_data['allow_google_analytics']) {

        $total_to_ga = array('tax' => 0, 'shipping' => 0);

        foreach ($totals as $value) {
          if ($value['code'] == 'tax') {
            $total_to_ga['tax'] += $value['value'];
          } elseif ($value['code'] == 'shipping') {
            $total_to_ga['shipping'] = $value['value'];
          } else { }
        }

        $product_info = $this->model_catalog_product->getProduct($product_id);

        $json['google_analytics'] = array(
          'transaction_id' => (int)$order_id,
          'affiliation'    => (string)$this->config->get('config_name'),
          'revenue'        => $total,
          'shipping'       => $total_to_ga['shipping'],
          'tax'            => $total_to_ga['tax'],
          'currency'       => $this->session->data['currency'],
          'product_id'     => $product_id,
          'name'           => $product_info['name'],
          'sku'            => !empty($product_info['sku']) ? $product_info['sku'] : $product_info['model'],
          'price'          => $this->processing(TRUE),
          'quantity'       => $quantity
        );
      }

      if ($form_data['allow_google_event']) {
        $json['google_event'] = array(
          'product_id' => $product_id,
          'name'       => $product_info['name'],
          'сategory'   => !empty($form_data['google_event_category']) ? $form_data['google_event_category'] : "Smart Checkout",
          'action'     => !empty($form_data['google_event_action']) ? $form_data['google_event_action'] : "Success"
        );
      }
			
			$this->db->query("UPDATE `".DB_PREFIX."order` SET order_status_id = '".(int)$form_data['order_status_id']."', date_modified = NOW() WHERE order_id = '".(int)$this->session->data['order_id']."'");

      $this->{'model_ocdevwizard_'.self::$_module_name}->mailing($this->request->request, $order_id, $product_id, $total, $form_data['order_status_id']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  // confirm_save_simple - simple checkout process without shipping and payment methods.

  public function confirm_save_simple() {
    $json = array();
    $data = array();

    // connect models array
    $models = array(
      'catalog/product', 
      'catalog/information', 
      'extension/extension', 
      'account/customer', 
      'affiliate/affiliate', 
      'checkout/order', 
      'checkout/marketing', 
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    } 

    // get @product_id
    if (isset($this->request->request['product_id'])) {
      $product_id = (int)$this->request->request['product_id'];
    } elseif (isset($this->session->data['tmp_product_id'])) {
      $product_id = (int)$this->session->data['tmp_product_id'];
    } else {
      die();
    }

    if (isset($this->request->request['option'])) {
      $option = $this->request->request['option'];
    } else {
      $option = array();
    }

    if (isset($this->request->request['quantity'])) {
      $quantity = (int)$this->request->request['quantity'];
    } else {
      $quantity = 1;
    }

    if (isset($this->request->request['recurring_id'])) {
      $recurring_id = $this->request->request['recurring_id'];
    } else {
      $recurring_id = 0;
    }

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data'), $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data'));

    $text_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data');
    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');
    $field_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_field_data');
    
    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    $product_info     = (array)$this->model_catalog_product->getProduct($product_id);
    $product_options  = (array)$this->model_catalog_product->getProductOptions($product_id);
    $order_status_id  = (!empty($form_data['order_status_id'])) ? (int)$form_data['order_status_id'] : (int)$this->config->get('config_order_status_id');
    $customer_info    = ($this->customer->isLogged()) ? $this->model_account_customer->getCustomer($this->customer->getId()) : FALSE;

    // validate fields
    foreach ($this->getActiveField() as $field) {
      if (empty($this->request->request[$field['view']]) && $field['check'] == 1) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } elseif (!empty($field['check_rule']) && !preg_match($field['check_rule'], $this->request->request[$field['view']]) && $field['check'] == 2) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } elseif (utf8_strlen(str_replace(array('_','-','(',')','+'), "", $this->request->request[$field['view']])) < $field['check_min'] || utf8_strlen(str_replace(array('_','-','(',')','+'), "", $this->request->request[$field['view']])) > $field['check_max'] && $field['check'] == 3) {
        $json['error']['field'][$field['view']] = $field['error_text'][$language_id];
      } else {
        unset($json['error']['field'][$field['view']]);
      }
    }

    // validate product options
    foreach ($product_options as $product_option) {
      if (in_array($product_option['option_id'], $form_data['product_options_array'])) {
        if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
          $json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_option'), $product_option['name']);
        }
      }
    }

    // validate require information
    if (!isset($this->request->request['require_information']) || empty($this->request->request['require_information'])) {
      if (isset($form_data['require_information'])) {
        $informations = (array)$this->model_catalog_information->getInformation((int)$form_data['require_information']);
        $json['error']['field']['require_information'] = sprintf($this->language->get('error_require_information'), $informations['title']);
      }
    }

    // fill order table
    $order_data = array();

    if (!isset($json['error'])) {
      if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
        $forwarded_ip = $this->request->server['HTTP_X_FORWARDED_FOR']; 
      } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
        $forwarded_ip = $this->request->server['HTTP_CLIENT_IP'];   
      } else {
        $forwarded_ip = '';
      }

      $user_agent = isset($this->request->server['HTTP_USER_AGENT']) ? $this->request->server['HTTP_USER_AGENT'] : '';
      $accept_language = isset($this->request->server['HTTP_ACCEPT_LANGUAGE']) ? $this->request->server['HTTP_ACCEPT_LANGUAGE'] : '';

      // affiliate
      if (isset($this->request->cookie['tracking'])) {
        $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);
        $tracking = $this->request->cookie['tracking'];
        $subtotal = $this->cart->getSubTotal();

        if ($affiliate_info) {
          $affiliate_id = $affiliate_info['affiliate_id']; 
          $commission = ($subtotal / 100) * $affiliate_info['commission']; 
        } else {
          $affiliate_id = 0;
          $commission = 0;
        }

        // marketing
        $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

        if ($marketing_info) {
          $marketing_id = $marketing_info['marketing_id'];
        } else {
          $marketing_id = 0;
        }

      } else {
        $affiliate_id = 0;
        $commission = 0;
        $marketing_id = 0;
        $tracking = '';
      }

      $product_key = (int)$product_id;

      $product_in_old_cart = $this->cart->getProducts();

      // remove this product from cart
      if (isset($product_in_old_cart[$product_key])) {
        $this->cart->remove($product_key);
      }

      // save current cart and clear old sessions
      $current_cart = $this->cart->getProducts();
      $this->cart->clear();

      // add current product to cart
      $this->cart->add($product_id, $quantity, $option, $recurring_id); 

      // get this product from new cart
      $product_to_order = array();

      foreach ($this->cart->getProducts() as $product) {
        $option_data = array();

        foreach ($product['option'] as $option) {
          $option_data[] = array(
            'product_option_id'       => $option['product_option_id'],
            'product_option_value_id' => $option['product_option_value_id'],
            'option_id'               => $option['option_id'],
            'option_value_id'         => $option['option_value_id'],
            'name'                    => $option['name'],
            'value'                   => $option['value'],
            'type'                    => $option['type']
          );
        }

        $product_to_order[] = array(
          'product_id' => $product['product_id'],
          'name'       => $product['name'],
          'model'      => $product['model'],
          'option'     => $option_data,
          'download'   => $product['download'],
          'quantity'   => $product['quantity'],
          'subtract'   => $product['subtract'],
          'price'      => $product['price'],
          'total'      => $product['total'],
          'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
          'reward'     => $product['reward']
        );
      }

      // Gift Voucher
      $vouchers = array();

      if ($form_data['hide_voucher'] && !empty($this->session->data['vouchers'])) {
        foreach ($this->session->data['vouchers'] as $voucher) {
          $vouchers[] = array(
            'description'      => $voucher['description'],
            'code'             => substr(md5(mt_rand()), 0, 10),
            'to_name'          => $voucher['to_name'],
            'to_email'         => $voucher['to_email'],
            'from_name'        => $voucher['from_name'],
            'from_email'       => $voucher['from_email'],
            'voucher_theme_id' => $voucher['voucher_theme_id'],
            'message'          => $voucher['message'],
            'amount'           => $voucher['amount']
          );
        }
      }

      // totals and total
      $totals = array();
      $taxes = $this->cart->getTaxes();
      $total = 0;

      // Because __call can not keep var references so we put them into an array. 
      $total_data = array(
        'totals' => &$totals,
        'taxes'  => &$taxes,
        'total'  => &$total
      );

      $sort_order = array();

      $results = $this->model_extension_extension->getExtensions('total');

      foreach ($results as $key => $value) {
        $sort_order[$key] = $this->config->get($value['code'].'_sort_order');
      }

      array_multisort($sort_order, SORT_ASC, $results);

      foreach ($results as $result) {
        if ($this->config->get($result['code'].'_status')) {
          $this->load->model('extension/total/'.$result['code']);

          // We have to put the totals in an array so that they pass by reference.
          $this->{'model_extension_total_'.$result['code']}->getTotal($total_data);
        }
      }

      $sort_order = array();

      foreach ($totals as $key => $value) {
        $sort_order[$key] = $value['sort_order'];
      }

      array_multisort($sort_order, SORT_ASC, $totals);

      // make order data
      $order_data = array(
        'invoice_prefix'          => (string)$this->config->get('config_invoice_prefix'),
        'store_id'                => $store_id = (int)$this->config->get('config_store_id'),
        'store_name'              => (string)$this->config->get('config_name'),
        'store_url'               => $store_id ? (string)$this->config->get('config_url') : HTTP_SERVER,
        'customer_id'             => $this->customer->isLogged() ? $this->customer->getId() : 0,
        'customer_group_id'       => $this->customer->isLogged() ? $this->customer->getGroupId() : $this->config->get('config_customer_group_id'),
        'firstname'               => '',
        'lastname'                => '',
        'email'                   => '',
        'telephone'               => '',
        'fax'                     => '',
        'shipping_city'           => '',
        'shipping_postcode'       => '',
        'shipping_country'        => '',
        'shipping_country_id'     => '',
        'shipping_zone_id'        => '',
        'shipping_zone'           => '',
        'shipping_address_format' => '',
        'shipping_firstname'      => '',
        'shipping_lastname'       => '',
        'shipping_company'        => '',
        'shipping_address_1'      => '',
        'shipping_address_2'      => '',
        'shipping_code'           => '',
        'shipping_method'         => '',
        'payment_city'            => '',
        'payment_postcode'        => '',
        'payment_country'         => '',
        'payment_country_id'      => '',
        'payment_zone'            => '',
        'payment_zone_id'         => '',
        'payment_address_format'  => '',
        'payment_firstname'       => '',
        'payment_lastname'        => '',
        'payment_company'         => '',
        'payment_address_1'       => '',
        'payment_address_2'       => '',
        'payment_company_id'      => '',
        'payment_tax_id'          => '',
        'payment_code'            => '',
        'payment_method'          => '',
        'forwarded_ip'            => $forwarded_ip,
        'user_agent'              => $user_agent,
        'accept_language'         => $accept_language,
        'vouchers'                => $vouchers,
        'comment'                 => '',
        'total'                   => $total,
        'reward'                  => '',
        'affiliate_id'            => $affiliate_id,
        'tracking'                => $tracking,
        'commission'              => $commission,
        'marketing_id'            => $marketing_id,
        'language_id'             => $this->config->get('config_language_id'),
        'currency_id'             => $this->currency->getId($this->session->data['currency']),
        'currency_code'           => $this->session->data['currency'],
        'currency_value'          => $this->currency->getValue($this->session->data['currency']),
        'ip'                      => $this->request->server['REMOTE_ADDR'],
        'products'                => $product_to_order,
        'totals'                  => $totals
      );

      foreach ($this->getActiveField() as $field) {
        if (!isset($this->request->request['email'])) {
          $order_data['email'] = $form_data['alternative_email'];
        }
        if (!empty($this->request->request[$this->replaceValue($field['view'], 2)])) {
          $comment_text = '';
          if ($this->replaceValue($field['view'], 2) == 'city') {
            $order_data['shipping_city'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_city'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'postcode') {
            $order_data['shipping_postcode'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_postcode'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'country_id') {
            $order_data['shipping_country_id'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_country_id'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'address_1') {
            $order_data['shipping_address_1'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_address_1'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'address_2') {
            $order_data['shipping_address_2'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_address_2'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'company') {
            $order_data['shipping_company'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_company'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'firstname') {
            $order_data['shipping_firstname'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_firstname'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['firstname'] = (!empty($form_data['prefix_order'])) ? $form_data['prefix_order'].$this->request->request[$this->replaceValue($field['view'], 2)] : $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'lastname') {
            $order_data['shipping_lastname'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['payment_lastname'] = $this->request->request[$this->replaceValue($field['view'], 2)];
            $order_data['lastname'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'company_id') {
            $order_data['payment_company_id'] = $this->request->request[$this->replaceValue($field['view'], 2)];
          } elseif ($this->replaceValue($field['view'], 2) == 'text' || $this->replaceValue($field['view'], 2) == 'textarea' || $this->replaceValue($field['view'], 2) == 'comment') {
            $order_data['comment'] .= html_entity_decode($field['title'][$language_id].' : '.$this->request->request[$this->replaceValue($field['view'], 2)].'<br/><hr/>', ENT_QUOTES, 'UTF-8');
          } else {
            $order_data[$this->replaceValue($field['view'], 2)] = $this->request->request[$this->replaceValue($field['view'], 2)];
          }
        } else {
          $order_data[$this->replaceValue($field['view'], 2)] = '';

          if ($this->replaceValue($field['view'], 2) == 'email' && $field['check'] == 0) {
            $order_data['email'] = $form_data['alternative_email'];
          }
        }
      }

      $this->session->data['order_id'] = $this->model_checkout_order->addOrder($order_data);

      $order_id = (int)$this->session->data['order_id'];

      $this->session->data['tmp_output'] = true;

      $this->db->query("UPDATE `".DB_PREFIX."order` SET order_status_id = '".(int)$form_data['order_status_id']."', date_modified = NOW() WHERE order_id = '".$order_id."'");

      $this->session->data['cart'] = $current_cart;

      $code_find = array(
        '{firstname}',
        '{lastname}',
        '{email}',
        '{total}',
        '{address_1}',
        '{address_2}',
        '{telephone}',
        '{fax}',
        '{postcode}',
        '{city}',
        '{order_id}',
        '{comment}'
      );

      $code_replace = array(
        isset($this->request->request['firstname']) ? $this->request->request['firstname'] : '',
        isset($this->request->request['lastname']) ? $this->request->request['lastname'] : '',
        isset($this->request->request['email']) ? $this->request->request['email'] : '',
        $this->currency->format($total, $this->session->data['currency']),
        isset($this->request->request['address_1']) ? $this->request->request['address_1'] : '',
        isset($this->request->request['address_2']) ? $this->request->request['address_2'] : '',
        isset($this->request->request['telephone']) ? $this->request->request['telephone'] : '',
        isset($this->request->request['fax']) ? $this->request->request['fax'] : '',
        isset($this->request->request['postcode']) ? $this->request->request['postcode'] : '',
        isset($this->request->request['city']) ? $this->request->request['city'] : '',
        $order_id,
        isset($this->request->request['comment']) ? $this->request->request['comment'] : ''
      );

      if (isset($text_data[$language_id])) {
        $json['output'] = html_entity_decode(str_ireplace($code_find, $code_replace, $text_data[$language_id]['success_text']), ENT_QUOTES, 'UTF-8');
        $json['button_go_back'] = html_entity_decode($text_data[$language_id]['continue_shopping_button'], ENT_QUOTES, 'UTF-8');
      }

      if ($form_data['allow_google_analytics']) {

        $total_to_ga = array('tax' => 0, 'shipping' => 0);

        foreach ($total_data as $value) {
          if ($value['code'] == 'tax') {
            $total_to_ga['tax'] += $value['value'];
          } elseif ($value['code'] == 'shipping') {
            $total_to_ga['shipping'] = $value['value'];
          } else { }
        }

        $json['google_analytics'] = array(
          'transaction_id' => (int)$order_id,
          'affiliation'    => (string)$this->config->get('config_name'),
          'revenue'        => $total,
          'shipping'       => $total_to_ga['shipping'],
          'tax'            => $total_to_ga['tax'],
          'currency'       => $this->session->data['currency'],
          'product_id'     => $product_id,
          'name'           => $product_info['name'],
          'sku'            => !empty($product_info['sku']) ? $product_info['sku'] : $product_info['model'],
          'price'          => $this->processing(TRUE),
          'quantity'       => $quantity
        );
      }

      if ($form_data['allow_google_event']) {
        $json['google_event'] = array(
          'product_id'     => $product_id,
          'name'           => $product_info['name'],
          'сategory'       => !empty($form_data['google_event_category']) ? $form_data['google_event_category'] : "Smart Checkout",
          'action'         => !empty($form_data['google_event_action']) ? $form_data['google_event_action'] : "Success"
        );
      }     

      $this->{'model_ocdevwizard_'.self::$_module_name}->mailing($this->request->request, $order_id, $product_id, $total, $form_data['order_status_id']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function processing($status = FALSE) { 
    if (isset($this->request->request['product_id']) && isset($this->request->request['quantity'])) {

      // connect models array
      $models = array(
        'catalog/product',
        'extension/extension',
        'ocdevwizard/ocdevwizard_setting'
      );

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

      $option_price    = 0;
      $product_id      = (int)$this->request->request['product_id'];
      $quantity        = (int)$this->request->request['quantity'];
      $product_info    = (array)$this->model_catalog_product->getProduct($product_id);
      $product_options = (array)$this->model_catalog_product->getProductOptions($product_id);
      $shipping_data   = isset($this->session->data['shipping_method']) ? $this->session->data['shipping_method'] : '';
      $payment_data    = isset($this->session->data['payment_method']) ? $this->session->data['payment_method'] : '';

      if (isset($shipping_data) && isset($this->request->request['shipping_method']) && !empty($this->request->request['shipping_method'])) {
        $shipping_cost = $shipping_data['cost'];
      } else {
        $shipping_cost = 0;
      }

      if (isset($this->request->request['option'])) {
        $option = $this->request->request['option'];
      } else {
        $option = array();
      }

      $product_key = (int)$product_id;

      $product_in_current_cart = $this->cart->getProducts();

      // remove this product from cart
      if (isset($product_in_current_cart[$product_key])) {
        $this->cart->remove($product_key);
      }

      // save current cart and clear old sessions
      $this->cart->clear();

      // add current product to cart
      $this->cart->add($product_id, $quantity, $option); 

      foreach ($product_options as $product_option) {
        if (is_array($product_option['product_option_value'])) {
          foreach ($product_option['product_option_value'] as $option_value) {
            if(isset($option[$product_option['product_option_id']])) {
              if(($option[$product_option['product_option_id']] == $option_value['product_option_value_id']) || ((is_array($option[$product_option['product_option_id']])) && (in_array($option_value['product_option_value_id'], $option[$product_option['product_option_id']])))) {
                if ($option_value['price_prefix'] == '+') {  
                  $option_price += $option_value['price']; 
                } elseif ($option_value['price_prefix'] == '-') { 
                  $option_price -= $option_value['price']; 
                } elseif ($option_value['price_prefix'] == '*') { 
                  $option_price *= $option_value['price']; 
                } elseif ($option_value['price_prefix'] == '/') { 
                  $option_price /= $option_value['price']; 
                } elseif ($option_value['price_prefix'] == '%') { 
                  $option_price %= $option_value['price']; 
                }
              }
            }
          }
        }
      }

      $json = array();

      $json['special'] = $this->currency->format(($this->tax->calculate($this->calculateDiscount($product_id, $quantity), $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity) + $this->tax->calculate($shipping_cost + ($option_price * $quantity), $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

      $json['price'] = $this->currency->format(($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity) + $this->tax->calculate($shipping_cost + ($option_price * $quantity), $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

      $json['tax'] = $this->currency->format(($this->calculateDiscount($product_id, $quantity) + $option_price) * $quantity, $this->session->data['currency']);

      // totals
      $totals = array();
      $taxes = $this->cart->getTaxes();
      $total = 0;

      // Because __call can not keep var references so we put them into an array.       
      $total_data = array(
        'totals' => &$totals,
        'taxes'  => &$taxes,
        'total'  => &$total
      );

      // Display prices
      if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
        $sort_order = array();

        $results = $this->model_extension_extension->getExtensions('total');

        foreach ($results as $key => $value) {
          $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
          if ($this->config->get($result['code'] . '_status')) {
            $this->load->model('extension/total/' . $result['code']);

            // We have to put the totals in an array so that they pass by reference.
            $this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
          }
        }

        $sort_order = array();

        foreach ($totals as $key => $value) {
          $sort_order[$key] = $value['sort_order'];
        }

        array_multisort($sort_order, SORT_ASC, $totals);
      }

      // order totals
      foreach ($totals as $total) {
        if ($total['code'] == 'total') {
          $json['total'] = $this->currency->format($total['value'], $this->session->data['currency']);
        }
      }

      if ($status == TRUE) {
        return (($this->tax->calculate($this->calculateDiscount($product_id, $quantity), $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity) + $this->tax->calculate($shipping_cost + ($option_price * $quantity), $product_info['tax_class_id'], $this->config->get('config_tax')));
      } else {
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
      }
    }
  }

  public function replaceValue($view, $selector) {
    $views = array(
      'text'       => 'text',
      'textarea'   => 'textarea',
      'email'      => 'text',
      'firstname'  => 'text',
      'lastname'   => 'text',
      'telephone'  => 'text',
      'fax'        => 'text',
      'company'    => 'text',
      'company_id' => 'text',
      'text_id'    => 'text',
      'address_1'  => 'text',
      'address_2'  => 'text',
      'city'       => 'text',
      'postcode'   => 'text',
      'country_id' => 'select',
      'zone_id'    => 'select',
      'comment'    => 'textarea',        
    );

    if ($selector == 1) {
      foreach ($views as $key => $value) {
        if ($key == $view) {
          return $value;
        }
      }
    } else {
      foreach ($views as $key => $value) {
        if ($key == $view) {
          return $key;
        }
      }
    }
  }

  public function getActiveField() {
    // connect models array
    $models = array(
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $field_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_field_data');

    foreach ($field_data as $key => $field) {
      if ($field['activate'] == 0) { 
        unset($field_data[$key]);
      }
    }

    return $field_data;
  }

  public function calculateDiscount($product_id, $quantity) {

    // connect models array
    $models = array(
      'catalog/product',
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $product_info = (array)$this->model_catalog_product->getProduct($product_id);

    $price = $product_info['price'];

    // product discount
    if (isset($form_data['discount_status'])) {
      $product_discount_query = $this->db->query("SELECT price FROM ".DB_PREFIX."product_discount WHERE product_id = '".(int)$product_id."' AND customer_group_id = '".(int)$customer_group_id."' AND quantity <= '".(int)$quantity."' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");
      if ($product_discount_query->num_rows) {
        $price = $product_discount_query->row['price'];
      }
    }

    // product specials
    $product_special_query = $this->db->query("SELECT price FROM ".DB_PREFIX."product_special WHERE product_id = '".(int)$product_id."' AND customer_group_id = '".(int)$customer_group_id."' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");

    if ($product_special_query->num_rows) {
      $price = $product_special_query->row['price'];
    }       

    return $price;
  }

  public function getProducts() {
    // connect models array
    $models = array(
      'catalog/product',
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $json = array();

    $text_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data');
    $form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->session->data['language']);

    if (isset($text_data[$language_id])) {
      $json['call_button'] = $text_data[$language_id]['call_button'];
    }  

    $json['products'] = array();

    if (isset($this->request->request['smch_product_ids'])) {

      $results = explode(",", $this->request->request['smch_product_ids']);

      foreach($results as $result) {
        if ($form_data['stock_validate']) {
          $product_info = $this->model_catalog_product->getProduct((int)$result);
          if ($product_info['quantity'] > 0) {
            $json['products'][] = (int)$result;
          }
        } else {
          $json['products'][] = (int)$result;
        }
      }

      $json['products'] = array_unique($json['products']);
    }

    $json['add_function_selectors'] = explode(',', $form_data['add_function_selector']);
    $json['add_id_selectors'] = explode(',', $form_data['add_id_selector']);

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function close() {
    $this->cart->clear();
    foreach ($this->session->data['current_cart'] as $cart) {
      $this->cart->add($cart['product_id'], $cart['quantity'], $cart['option']);
    }
    unset($this->session->data['tmp_product_id']);
    unset($this->session->data['shipping_method']);
    unset($this->session->data['shipping_methods']);
    unset($this->session->data['payment_method']);
    unset($this->session->data['payment_methods']);
    unset($this->session->data['order_id']);
    unset($this->session->data['tmp_output']);
  }

  public function coupon_index() {
    $data = array();

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name));

    $data['coupon'] = (isset($this->session->data['coupon'])) ? $this->session->data['coupon'] : '';

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_coupon.tpl', $data));
  }

  public function coupon() {
    $json = array();

    // connect models array
    $models = array(
      'extension/total/coupon'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    } 

    $this->language->load('ocdevwizard/'.self::$_module_name);

    $coupon = (isset($this->request->post['smch_coupon'])) ? $this->request->post['smch_coupon'] : '';

    $coupon_info = $this->model_extension_total_coupon->getCoupon($coupon);

    if (empty($this->request->post['smch_coupon'])) {
      $json['error'] = $this->language->get('error_coupon_empty');

      unset($this->session->data['coupon']);
    } elseif ($coupon_info) {
      $this->session->data['coupon'] = $this->request->post['smch_coupon'];
      $json['success'] = $this->language->get('text_success_coupon');
    } else {
      $json['error'] = $this->language->get('error_coupon');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function remove_coupon() {
    $json = array();

    if (isset($this->session->data['coupon'])) {
      unset($this->session->data['coupon']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function voucher_index() {
    $data = array();

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name));

    $data['voucher'] = (isset($this->session->data['voucher'])) ? $this->session->data['voucher'] : '';

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_voucher.tpl', $data));
  }

  public function voucher() {
    $json = array();

    // connect models array
    $models = array(
      'extension/total/voucher'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    } 

    $this->language->load('ocdevwizard/'.self::$_module_name);

    $voucher = (isset($this->request->post['smch_voucher'])) ? $this->request->post['smch_voucher'] : '';

    $voucher_info = $this->model_extension_total_voucher->getVoucher($voucher);

    if (empty($this->request->post['smch_voucher'])) {
      $json['error'] = $this->language->get('error_voucher_empty');
    } elseif ($voucher_info) {
      $this->session->data['voucher'] = $this->request->post['smch_voucher'];
      $json['success'] = $this->language->get('text_success_voucher');
    } else {
      $json['error'] = $this->language->get('error_voucher');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function remove_voucher() {
    $json = array();

    if (isset($this->session->data['voucher'])) {
      unset($this->session->data['voucher']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function reward_index() {
    $data = array();

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name));

    $points = $this->customer->getRewardPoints();

    $points_total = 0;

    foreach ($this->cart->getProducts() as $product) {
      if ($product['points']) {
        $points_total += $product['points'];
      }
    }

    if ($points && $points_total) {
      $data['text_loading'] = $this->language->get('text_loading');
      $data['entry_reward'] = sprintf($this->language->get('entry_reward'), $points_total);
      $data['reward'] = isset($this->session->data['reward']) ? $this->session->data['reward'] : '';

      $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_reward.tpl', $data));
    }
  }

  public function reward() {
    $json = array();

    $this->language->load('ocdevwizard/'.self::$_module_name);

    $points = $this->customer->getRewardPoints();

    $points_total = 0;

    foreach ($this->cart->getProducts() as $product) {
      if ($product['points']) {
        $points_total += $product['points'];
      }
    }

    if (empty($this->request->post['smch_reward'])) {
      $json['error'] = $this->language->get('error_reward');
    }

    if ($this->request->post['smch_reward'] > $points) {
      $json['error'] = sprintf($this->language->get('error_points'), $this->request->post['smch_reward']);
    }

    if ($this->request->post['smch_reward'] > $points_total) {
      $json['error'] = sprintf($this->language->get('error_maximum'), $points_total);
    }

    if (!$json) {
      $this->session->data['reward'] = abs($this->request->post['smch_reward']);
      $json['success'] = $this->language->get('text_success_reward');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function remove_reward() {
    $json = array();

    if (isset($this->session->data['reward'])) {
      unset($this->session->data['reward']);
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }
}
?>