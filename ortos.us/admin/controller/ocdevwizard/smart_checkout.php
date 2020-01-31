<?php

// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com> 
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

class ControllerOcdevwizardSmartCheckout extends Controller {

  private $error           = array(); 
  static  $_module_version = '2.0.1';
  static  $_module_name    = 'smart_checkout';
  static  $_compatible_version = '2.3.0.2.3';

  public function index() {  
    $data = array();

    // connect models array
    $models = array(
      'setting/store', 
      'extension/extension', 
      'catalog/information', 
      'customer/customer_group', 
      'localisation/language', 
      'localisation/order_status', 
      'localisation/country', 
      'catalog/option', 
      'marketing/coupon', 
      'user/user_group', 
      'ocdevwizard/'.self::$_module_name, 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    } 

    $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name));
    $this->document->setTitle($this->language->get('heading_name'));

    $scripts = array('jquery-ui.min.js');
    foreach ($scripts as $script) {
      $this->document->addScript('view/javascript/ocdevwizard/'.self::$_module_name.'/'.$script);
    }

    $styles = array('stylesheet.css');
    foreach ($styles as $style) {
      $this->document->addStyle('view/stylesheet/ocdevwizard/'.self::$_module_name.'/'.$style);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
      if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
        $content = file_get_contents($this->request->files['import']['tmp_name']);
      }

      if (isset($content)) {
        $this->session->data['success'] = $this->language->get('text_success');
        $this->model_ocdevwizard_ocdevwizard_setting->editSetting(self::$_module_name, unserialize($content));
        $this->response->redirect($this->url->link('extension/extension', 'token='.$this->session->data['token'], 'SSL'));
      } else {
        $this->session->data['success'] = $this->language->get('text_success');
        $this->model_ocdevwizard_ocdevwizard_setting->editSetting(self::$_module_name, $this->request->post);
        $this->response->redirect($this->url->link('extension/extension', 'token='.$this->session->data['token'], 'SSL'));
      }
    }

    $data['error_warning'] = (isset($this->error['warning'])) ? $this->error['warning'] : '';
    $data['error_warning'] = (isset($this->error['compatible_version'])) ? $this->error['compatible_version'] : '';
    $data['error_data_fields'] = (isset($this->error['data_fields'])) ? $this->error['data_fields'] : array();
    $data['error_add_function_selector'] = (isset($this->error['add_function_selector'])) ? $this->error['add_function_selector'] : '';
    $data['error_add_id_selector']  = (isset($this->error['add_id_selector'])) ? $this->error['add_id_selector'] : '';
    $data['error_main_product_id_selector'] = (isset($this->error['main_product_id_selector'])) ? $this->error['main_product_id_selector'] : '';
    $data['error_alternative_email'] = (isset($this->error['alternative_email'])) ? $this->error['alternative_email'] : '';
    $data['error_admin_email_for_notify'] = (isset($this->error['admin_email_for_notify'])) ? $this->error['admin_email_for_notify'] : '';
    $data['error_prefix_order'] = (isset($this->error['prefix_order'])) ? $this->error['prefix_order'] : '';
    $data['error_call_button'] = (isset($this->error['call_button'])) ? $this->error['call_button'] : '';
    $data['error_heading'] = (isset($this->error['heading'])) ? $this->error['heading'] : '';
    $data['error_send_button'] = (isset($this->error['send_button'])) ? $this->error['send_button'] : '';
    $data['error_success_text'] = (isset($this->error['success_text'])) ? $this->error['success_text'] : '';
    $data['error_continue_shopping_button'] = (isset($this->error['continue_shopping_button'])) ? $this->error['continue_shopping_button'] : '';

    if (isset($this->session->data['success'])) {
      $data['success'] = $this->session->data['success'];

      unset($this->session->data['success']);
    } else {
      $data['success'] = '';
    }

    if (isset($this->session->data['warning'])) {
      $data['warning'] = $this->session->data['warning'];

      unset($this->session->data['warning']);
    } else {
      $data['warning'] = '';
    }

    $data['breadcrumbs'] = array(
      0 => array(
        'text'      => $this->language->get('text_home'),
        'href'      => $this->url->link('common/home', 'token='.$this->session->data['token'], 'SSL'),
        'separator' => false
      ),
      1 => array(
        'text'      => $this->language->get('text_module'),
        'href'      => $this->url->link('extension/extension', 'token='.$this->session->data['token'], 'SSL'),
        'separator' => ' :: '
      ),
      2 => array(
        'text'      => $this->language->get('heading_title'),
        'href'      => $this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'),
        'separator' => ' :: '
      )
    );

    $data['language_id'] = $language_id = $this->{'model_ocdevwizard_'.self::$_module_name}->getLanguageByCode($this->config->get('config_admin_language'));

    $this->{'model_ocdevwizard_'.self::$_module_name}->createDBTables();

    $module_settings = $this->model_ocdevwizard_ocdevwizard_setting->getSetting(self::$_module_name);

    if (!$module_settings) {
      // add permission
      $modules = array('ocdevwizard/'.self::$_module_name, 'ocdevwizard/'.self::$_module_name.'_notifications');
      foreach ($modules as $module) {
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', $module);
        $this->model_user_user_group->addPermission($this->user->getId(), 'modify', $module);
      }
      
      $languages = $this->model_localisation_language->getLanguages();

      foreach ($languages as $language) {
        $default_language_data[$language['language_id']] = array(
          'heading' => $this->language->get('default_heading'),
          'success_text' => $this->language->get('default_success_text'),
          'info_message' => $this->language->get('default_info_message'),
          'send_button' => $this->language->get('default_send_button'),
          'call_button' => $this->language->get('default_call_button'),
          'continue_shopping_button' => $this->language->get('default_continue_shopping_button')
        );
      }

      // set default data
      $this->model_ocdevwizard_ocdevwizard_setting->editSetting(self::$_module_name, array(
        self::$_module_name.'_text_data' => $default_language_data,
        self::$_module_name.'_form_data' => array(
          'activate'                  => '1',
          'add_function_selector'     => 'cart.add,addToCart',
          'add_id_selector'           => '#button-cart',
          'main_product_id_selector'  => '#product input[name=\'product_id\']',
          'stock_validate'            => '1',
          'alternative_email'         => (string)$this->config->get('config_email'),
          'admin_order_email_notify'  => '1',
          'admin_email_for_notify'    => (string)$this->config->get('config_email'),
          'prefix_order'              => 'SMCH: ',
          'order_status_id'           => (int)$this->config->get('config_order_status_id'),
          'stores'                    => array(),
          'customer_groups'           => array(),
          'hide_main_img'             => '1',
          'main_image_width'          => '215',
          'main_image_height'         => '180',
          'hide_sub_img'              => '1',
          'sub_images_width'          => '50',
          'sub_images_height'         => '50',
          'count_sub_images'          => '6',
          'option_images_width'       => '30',
          'option_images_height'      => '30',
          'discount_status'           => '1',
          'hide_product_options'      => '1',
          'hide_product_attributes'   => '1',
          'hide_product_description'  => '1',
          'hide_product_model'        => '1',
          'hide_product_ean'          => '0',
          'hide_product_jan'          => '0',
          'hide_product_isbn'         => '0',
          'hide_product_mpn'          => '0',
          'hide_product_location'     => '0',
          'hide_shipping_title'       => '0',
          'hide_table_info'           => '1',
          'hide_coupon'               => '1',
          'hide_voucher'              => '1',
          'hide_reward'               => '1',
          'display_info_text'         => '0',
          'allow_email_template'      => '2',
          'email_template_by_default' => '',
          'payment_code_array'        => array(),
          'transfer_payments'         => array(),
          'shipping_code_array'       => array(),
          'product_options_array'     => array(),
          'product_countries'         => array($this->config->get('config_country_id')),
          'require_information'       => '',
          'style_background'          => 'bg_7.png',
          'background_opacity'        => '8',
          'gift_coupon'               => '',
          'allow_google_analytics'    => '0',
          'allow_google_event'        => '0',
          'google_event_category'     => 'Smart Checkout',
          'google_event_action'       => 'Success',
          'google_analytics_script'   => '',
          'front_module_name'         => str_replace(array('<b>','</b>'), "", $this->language->get('heading_title')),
          'front_module_version'      => (string)self::$_module_version
        ),
        self::$_module_name.'_field_data' => array(
          0 => array(
            'sort_order'       => '1',
            'name'             => array($language_id => $this->language->get('text_field_firstname')),
            'activate'         => '1',
            'title'            => array($language_id => $this->language->get('text_field_firstname')),
            'view'             => 'firstname',
            'mask'             => '',
            'check'            => '0',
            'check_rule'       => '',
            'check_min'        => '',
            'check_max'        => '',
            'error_text'       => array($language_id => $this->language->get('default_error_message')),
            'placeholder_text' => array($language_id => $this->language->get('text_field_firstname')),
            'css_id'           => '',
            'css_class'        => '',
            'position'         => '1',
          ),
          1 => array(
            'sort_order'       => '2',
            'name'             => array($language_id => $this->language->get('text_field_email')),
            'activate'         => '1',
            'title'            => array($language_id => $this->language->get('text_field_email')),
            'view'             => 'email',
            'mask'             => '',
            'check'            => '1',
            'check_rule'       => '',
            'check_min'        => '',
            'check_max'        => '',
            'error_text'       => array($language_id => $this->language->get('default_error_message')),
            'placeholder_text' => array($language_id => $this->language->get('text_field_email')),
            'css_id'           => '',
            'css_class'        => '',
            'position'         => '2',
          )
        )
      ));

      $this->session->data['success'] = $this->language->get('text_success_install');
    }

    $data['action']           = $this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL');
    $data['uninstall']        = $this->url->link('ocdevwizard/'.self::$_module_name.'/uninstall', 'token='.$this->session->data['token'], 'SSL');
    $data['action_plus']      = $this->url->link('ocdevwizard/'.self::$_module_name.'/edit_and_stay', 'token='.$this->session->data['token'], 'SSL');
    $data['export_settings_button'] = $this->url->link('ocdevwizard/'.self::$_module_name.'/export_settings', 'token='.$this->session->data['token'], 'SSL');
    $data['import_settings_button'] = $this->url->link('ocdevwizard/'.self::$_module_name.'/import_settings', 'token='.$this->session->data['token'], 'SSL');
    $data['cancel']           = $this->url->link('extension/extension', 'token='.$this->session->data['token'], 'SSL');
    $data['admin_language']   = $this->config->get('config_admin_language');
    $data['_module_name']     = (string)self::$_module_name;
    $data['_module_version']  = (string)self::$_module_version;
    $data['opencart_version'] = VERSION;
    $data['token']            = $this->session->data['token'];
    $data['text_data']        = isset($this->request->post[self::$_module_name.'_text_data']) ? $this->request->post[self::$_module_name.'_text_data'] : $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_text_data');
    $data['form_data'] = $form_data = isset($this->request->post[self::$_module_name.'_form_data']) ? $this->request->post[self::$_module_name.'_form_data'] : $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

    if (isset($this->request->post[self::$_module_name.'_field_data'])) {
      $field_datas = $this->request->post[self::$_module_name.'_field_data'];
    } elseif ($this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_field_data')) {
      $field_datas = $this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_field_data');
    } else {
      $field_datas = array(0);
    }

    $data['field_view_data'] = array(
      'text'       => $this->language->get('text_field_simple_text'),
      'textarea'   => $this->language->get('text_field_simple_textarea'),
      'email'      => $this->language->get('text_field_email'),
      'firstname'  => $this->language->get('text_field_firstname'),
      'lastname'   => $this->language->get('text_field_lastname'),
      'telephone'  => $this->language->get('text_field_telephone'),
      'fax'        => $this->language->get('text_field_fax'),
      'company'    => $this->language->get('text_field_company'),
      'company_id' => $this->language->get('text_field_company_id'),
      'address_1'  => $this->language->get('text_field_address_1'),
      'address_2'  => $this->language->get('text_field_address_2'),
      'city'       => $this->language->get('text_field_city'),
      'postcode'   => $this->language->get('text_field_postcode'),
      'country_id' => $this->language->get('text_field_country_id'),
      'zone_id'    => $this->language->get('text_field_zone_id'),
      'comment'    => $this->language->get('text_field_comment')
    );

    $data['field_data'] = array();

    foreach ($field_datas as $field) {
      $data['field_data'][] = array(
        'sort_order'       => $field['sort_order'],
        'name'             => $field['name'],
        'activate'         => $field['activate'],
        'title'            => $field['title'],
        'view'             => $field['view'],
        'mask'             => $field['mask'],
        'customer_groups'  => isset($field['customer_groups']) ? $field['customer_groups'] : array(),
        'check'            => $field['check'],
        'check_rule'       => $field['check_rule'],
        'check_min'        => $field['check_min'],
        'check_max'        => $field['check_max'],
        'error_text'       => $field['error_text'],
        'placeholder_text' => $field['placeholder_text'],
        'css_id'           => $field['css_id'],
        'css_class'        => $field['css_class'],
        'position'         => $field['position']
      );
    }      

    $data['product_options'] = array();

    $allowed_types = array('file');

    foreach ($this->model_catalog_option->getOptions() as $product_option) {
      if (!in_array($product_option['type'], $allowed_types)) {
        $data['product_options'][] = array(
          'option_id' => $product_option['option_id'],
          'name'      => $product_option['name']
        );   
      }           
    }

    $default_store = array(0 => array('store_id' => 0, 'name' => $this->config->get('config_name').' (Default)'));

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = array();

    foreach ($all_stores as $store) {
      $data['all_stores'][] = array(
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      );
    }

    $data['all_customer_groups'] = array();

    foreach ($this->model_customer_customer_group->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = array(
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      );
    }

    $payments = $this->model_extension_extension->getInstalled('payment');

    $data['payments'] = array();
    
    foreach ($payments as $payment) {
      if ($payment) {

        $this->load->language('extension/payment/'.$payment);

        $data['payments'][] = array(
          'code' => $payment,
          'name' => $this->language->get('heading_title')
        );
      }
    }

    $shippings = $this->model_extension_extension->getInstalled('shipping');

    $data['shippings'] = array();
    
    foreach ($shippings as $shipping) {
      if ($shipping) {

        $this->load->language('extension/shipping/'.$shipping);

        $data['shippings'][] = array(
          'code' => $shipping,
          'name' => $this->language->get('heading_title')
        );
      }
    }

    $data['order_statuses'] = array(); 

    foreach ($this->model_localisation_order_status->getOrderStatuses() as $status) {
      $data['order_statuses'][] = array(
        'status_id' => $status['order_status_id'],
        'name'      => $status['name']
      );
    }

    $data['countries_data'] = array();

    foreach ($this->model_localisation_country->getCountries() as $country) {
      $data['countries_data'][] = array(
        'country_id' => $country['country_id'],
        'name'       => $country['name'].(($country['country_id'] == $this->config->get('config_country_id')) ? $this->language->get('text_default') : null)

      );
    }

    $data['informations'] = array();

    foreach ($this->model_catalog_information->getInformations() as $information) {
      $data['informations'][] = array(
        'information_id' => $information['information_id'],
        'title'          => $information['title']
      );
    }

    $data['all_coupons'] = array();

    foreach ($this->model_marketing_coupon->getCoupons() as $coupon) {
      if ($coupon['status']) {
        $data['all_coupons'][] = array(
          'coupon_id'  => $coupon['coupon_id'],
          'name'       => $coupon['name'],
        );
      }
    }

    $data['backgrounds'] = array();

    if ($this->get_background()) {
      foreach ($this->get_background() as $background) {
        $name_string = explode("/", $background);
        $name = array_pop($name_string);
        $data['backgrounds'][] = array(
          'src'  => $background,
          'name' => $name
        );
      }
    }

    // codev products
    $data['products'] = $this->{'model_ocdevwizard_'.self::$_module_name}->getOCdevCatalog();

    // codev support
    $data['support_info'] = $this->{'model_ocdevwizard_'.self::$_module_name}->getOCdevSupportInfo();

    $data['text_email_template_by_default_faq'] = sprintf($this->language->get('text_email_template_by_default_faq'), $this->url->link('ocdevwizard/'.self::$_module_name.'_notifications', 'token='.$this->session->data['token'], 'SSL'));

    // templates
    $data['templates'] = $this->{'model_ocdevwizard_'.self::$_module_name}->getNotificationTemplates(array('filter_status' => 1));

    $data['languages']   = $this->model_localisation_language->getLanguages();
    $data['header']      = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer']      = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('ocdevwizard/'.self::$_module_name.'.tpl', $data));
  }

  public function edit_and_stay() {
    if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
      $this->language->load('ocdevwizard/'.self::$_module_name);
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'));
    } else {
      $data = array();

      // connect models array
      $models = array('ocdevwizard/ocdevwizard_setting');
      foreach ($models as $model) {
        $this->load->model($model);
      }

      $data = array_merge($data, $this->language->load('ocdevwizard/'.self::$_module_name));
      $this->document->setTitle($this->language->get('heading_title'));

      if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {

        if (is_uploaded_file($this->request->files['import']['tmp_name'])) {
          $content = file_get_contents($this->request->files['import']['tmp_name']);
        }

        if (isset($content)) {
          $this->session->data['success'] = $this->language->get('text_success');
          $this->model_ocdevwizard_ocdevwizard_setting->editSetting(self::$_module_name, unserialize($content));
          $this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'));
        } else {
          $this->session->data['success'] = $this->language->get('text_success');
          $this->model_ocdevwizard_ocdevwizard_setting->editSetting(self::$_module_name, $this->request->post);
          $this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'));
        }
      } else {
        $this->index();
      }
    }  
  }

  public function uninstall() {
    $this->language->load('ocdevwizard/'.self::$_module_name);

    if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('ocdevwizard/'.self::$_module_name, 'token='.$this->session->data['token'], 'SSL'));
    } else {
      // connect model data
      $models = array(
        'ocdevwizard/ocdevwizard_setting', 
        'ocdevwizard/'.self::$_module_name, 
        'user/user_group'
      );

      foreach ($models as $model) {
        $this->load->model($model);
      }

      // add permission
      $modules = array('ocdevwizard/'.self::$_module_name, 'ocdevwizard/'.self::$_module_name.'_notifications');
      foreach ($modules as $module) {
        $this->model_user_user_group->removePermission($this->user->getId(), 'access', $module);
        $this->model_user_user_group->removePermission($this->user->getId(), 'modify', $module);
      }

      $this->{'model_ocdevwizard_'.self::$_module_name}->deleteDBTables();
      $this->model_ocdevwizard_ocdevwizard_setting->deleteSetting(self::$_module_name);

      $this->session->data['success'] = $this->language->get('text_success_uninstall');
       
      $this->response->redirect($this->url->link('extension/extension', 'token='.$this->session->data['token'], 'SSL'));
    }
  }

  private function validate() {
    // connect models array
    $models = array(
      'localisation/language'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    } 

    if (!$this->user->hasPermission('modify', 'ocdevwizard/'.self::$_module_name)) {
      $this->error['warning'] = $this->language->get('error_permission');
      $this->session->data['warning'] = $this->language->get('error_permission');
    }

    $opencart_version = explode("|", self::$_compatible_version);
    if (!in_array(VERSION, $opencart_version)) {
      $this->error['compatible_version'] = $this->language->get('error_compatible_version');
    }

    foreach ($this->request->post[self::$_module_name.'_text_data'] as $language_id => $value) {
      if ((utf8_strlen($value['heading']) < 1) || (utf8_strlen($value['heading']) > 255)) {
        $this->error['heading'][$language_id] = $this->language->get('error_for_all_field');
      }

      if ((utf8_strlen($value['send_button']) < 1) || (utf8_strlen($value['send_button']) > 255)) {
        $this->error['send_button'][$language_id] = $this->language->get('error_for_all_field');
      }

      if ((utf8_strlen($value['info_message']) < 1) || (utf8_strlen($value['info_message']) > 5000)) {
        $this->error['info_message'][$language_id] = $this->language->get('error_for_all_field');
      }

      if ((utf8_strlen($value['success_text']) < 1) || (utf8_strlen($value['success_text']) > 5000)) {
        $this->error['success_text'][$language_id] = $this->language->get('error_for_all_field');
      }

      if ((utf8_strlen($value['continue_shopping_button']) < 1) || (utf8_strlen($value['continue_shopping_button']) > 255)) {
        $this->error['continue_shopping_button'][$language_id] = $this->language->get('error_for_all_field');
      }

      if ((utf8_strlen($value['call_button']) < 1) || (utf8_strlen($value['call_button']) > 255)) {
        $this->error['call_button'][$language_id] = $this->language->get('error_for_all_field');
      }
    }

    if (isset($this->request->post[self::$_module_name.'_field_data'])) {
      foreach ($this->request->post[self::$_module_name.'_field_data'] as $main_key => $field) {

        foreach ($field as $key => $value) {

          if (empty($value) && $key == "view") {
            $this->error['data_fields'][$main_key][$key] = $this->language->get('error_view');
          }

          foreach ($this->model_localisation_language->getLanguages() as $language) {

            if (empty($value[$language['language_id']]) && $key == "title") {
              $this->error['data_fields'][$main_key][$key][$language['language_id']] = $this->language->get('error_for_all_field');
            }

            if (empty($value[$language['language_id']]) && $key == "error_text") {
              $this->error['data_fields'][$main_key][$key][$language['language_id']] = $this->language->get('error_for_all_field');
            }
          }
        }
      }
    }

    foreach ($this->request->post[self::$_module_name.'_form_data'] as $main_key => $field) {
      if (empty($field) && $main_key == "add_function_selector") {
        $this->error['add_function_selector'] = $this->language->get('error_for_all_field');
      }

      if (empty($field) && $main_key == "add_id_selector") {
        $this->error['add_id_selector'] = $this->language->get('error_for_all_field');
      }

      if (empty($field) && $main_key == "main_product_id_selector") {
        $this->error['main_product_id_selector'] = $this->language->get('error_for_all_field');
      }

      if (empty($field) && $main_key == "alternative_email") {
        $this->error['alternative_email'] = $this->language->get('error_for_all_field');
      }

      if (empty($field) && $main_key == "admin_email_for_notify") {
        $this->error['admin_email_for_notify'] = $this->language->get('error_for_all_field');
      }

      if (empty($field) && $main_key == "prefix_order") {
        $this->error['prefix_order'] = $this->language->get('error_for_all_field');
      }
    }

    return (!$this->error) ? TRUE : FALSE;
  }

  public function get_background() {
    $backgrounds = array();

    $dir = opendir(DIR_IMAGE.'ocdevwizard/'.self::$_module_name.'/background');

    while (($file = readdir($dir)) !== FALSE) {
      if (in_array(substr(strrchr($file, '.'), 1), array('png', 'jpg'))) {
        $backgrounds[] = (HTTP_CATALOG.'image/ocdevwizard/'.self::$_module_name.'/background/'.$file);
      }
    }

    closedir($dir);

    return $backgrounds;
  }

  public function export_settings() {
    // connect models array
    $models = array('ocdevwizard/ocdevwizard_setting');
    foreach ($models as $model) {
      $this->load->model($model);
    }

    $module_settings = $this->model_ocdevwizard_ocdevwizard_setting->getSetting(self::$_module_name);

    $this->response->addheader('Pragma: public');
    $this->response->addheader('Expires: 0');
    $this->response->addheader('Content-Description: File Transfer');
    $this->response->addheader('Content-Type: application/octet-stream');
    $this->response->addheader('Content-Disposition: attachment; filename='.self::$_module_name.'_'.date("Y-m-d H:i:s", time()).'.txt');
    $this->response->addheader('Content-Transfer-Encoding: binary');

    $this->response->setOutput(serialize($module_settings));
  }
}
?>