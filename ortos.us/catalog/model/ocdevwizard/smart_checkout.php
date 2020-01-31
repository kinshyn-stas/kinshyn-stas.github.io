<?php

// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com> 
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

class ModelOcdevwizardSmartCheckout extends Model {

  static $_module_version = '2.0.1';
  static $_module_name    = 'smart_checkout'; 
		
	public function getCoupon($coupon_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."coupon WHERE coupon_id = '".(int)$coupon_id."'");

		return $query->row;
	}

  public function getNotificationTemplateDescription($template_id, $language_id) {
		$query = $this->db->query("SELECT nd.subject, nd.template FROM ".DB_PREFIX."smch_notification n LEFT JOIN ".DB_PREFIX."smch_notification_description nd ON (n.template_id = nd.template_id) WHERE n.template_id = '".(int)$template_id."' AND nd.language_id = '".(int)$language_id."' AND n.status = '1'");

		return $query->row;
	}

	public function getLanguageByCode($code) {
    $query = $this->db->query("SELECT language_id FROM ".DB_PREFIX."language WHERE code = '".(string)$code."'");

    return $query->row['language_id'];
  }

	public function getOrderTotal($order_id) {
		$query = $this->db->query("SELECT value FROM ".DB_PREFIX."order_total WHERE order_id = '".(int)$order_id."' AND code = 'total'");

		return $query->row['value'];
	}

	public function getOrderTotals($order_id) {
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."order_total WHERE order_id = '".(int)$order_id."'");

		return $query->rows;
	}

	public function mailing($post_data = array(), $order_id, $product_id, $total, $order_status_id) {
    // connect models array
    $models = array(
      'checkout/order', 
      'tool/upload',
      'tool/image', 
      'catalog/product', 
      'ocdevwizard/ocdevwizard_setting'
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

		$form_data = (array)$this->model_ocdevwizard_ocdevwizard_setting->getSettingData(self::$_module_name.'_form_data');

		$language_id = $this->getLanguageByCode($this->session->data['language']);

    $order_info = $this->model_checkout_order->getOrder($order_id);

    if ($order_info) {

    	if (isset($form_data['allow_email_template'])) {

	      // custom html template
	      if ($form_data['allow_email_template'] == 1) {
	        if (isset($form_data['email_template_by_default']) && $form_data['email_template_by_default']) {
						$html_data = array();

		        $coupon_info = $this->getCoupon($form_data['gift_coupon']);
		        $product_info = $this->model_catalog_product->getProduct($product_id);

		        $fax         = $this->config->get('config_fax') != '' ? $this->config->get('config_fax') : '';
		        $user_email  = isset($post_data['email']) ? $post_data['email'] : '';
		        $product_img = ($product_info['image']) ? $this->model_tool_image->resize($product_info['image'], $this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height')) : $this->model_tool_image->resize("placeholder.png", $$this->config->get($this->config->get('config_theme') . '_image_product_width'), $this->config->get($this->config->get('config_theme') . '_image_product_height'));

		        $tag_codes = array(
		          '{firstname}',
		          '{lastname}',
		          '{email}',
		          '{address_1}',
		          '{address_2}',
		          '{telephone}',
		          '{fax}',
		          '{postcode}',
		          '{city}',
		          '{total}',
		          '{order_id}',
		          '{comment}',
		          '{product_name}',
		          '{product_link}',
		          '{product_img}',
		          '{store_name}',
		          '{store_address}',
		          '{store_email}',
		          '{store_telephone}',
		          '{store_fax}',
		          '{gift_coupon_code}'
		        );

		        $tag_codes_replace = array(
		          isset($post_data['firstname']) ? $post_data['firstname'] : '',
		          isset($post_data['lastname']) ? $post_data['lastname'] : '',
		          isset($post_data['email']) ? $post_data['email'] : '',
		          isset($post_data['address_1']) ? $post_data['address_1'] : '',
		          isset($post_data['address_2']) ? $post_data['address_2'] : '',
		          isset($post_data['telephone']) ? $post_data['telephone'] : '',
		          isset($post_data['fax']) ? $post_data['fax'] : '',
		          isset($post_data['postcode']) ? $post_data['postcode'] : '',
		          isset($post_data['city']) ? $post_data['city'] : '',
		          $this->currency->format($total, $this->session->data['currency']),
		          $order_id,
		          isset($post_data['comment']) ? $post_data['comment'] : '',
		          $product_info['name'],
		          $this->url->link('product/product', 'product_id='.$product_id),
		          $product_img,
		          $this->config->get('config_name'),
		          $this->config->get('config_address'),
		          $this->config->get('config_email'),
		          $this->config->get('config_telephone'),
		          $fax,
		          ($coupon_info) ? $coupon_info['code'] : ''
		        );
		  
		        $html_data['time'] = date('m/d/Y h:i:s a', time());

		        $template_description = $this->getNotificationTemplateDescription($form_data['email_template_by_default'], $language_id);

	          if ($template_description) {
	          	$html_data['html_template'] = html_entity_decode(str_replace($tag_codes, $tag_codes_replace, $template_description['template']), ENT_QUOTES, 'UTF-8');
	            $subject = html_entity_decode(str_replace($tag_codes, $tag_codes_replace, $template_description['subject']), ENT_QUOTES, 'UTF-8').':'.$html_data['time'];

	            $html_data['title'] = $subject;
		  
			        $html = $this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_mail_custom.tpl', $html_data);

			        // email notification
			        $mail = new Mail();
							$mail->protocol = $this->config->get('config_mail_protocol');
							$mail->parameter = $this->config->get('config_mail_parameter');
							$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
							$mail->smtp_username = $this->config->get('config_mail_smtp_username');
							$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
							$mail->smtp_port = $this->config->get('config_mail_smtp_port');
							$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			
			        $mail->setTo($user_email);
			        $mail->setFrom($this->config->get('config_email'));
			        $mail->setSender($this->config->get('config_name'));
			        $mail->setSubject($subject);
			        $mail->setHtml($html);
			        $mail->send();

			        if ($form_data['admin_order_email_notify']) {
			        	$emails = explode(',', $form_data['admin_email_for_notify']);
			          foreach ($emails as $email) {
			            if ($email && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
			              $mail->setTo($email);
			              $mail->send();
			            }
			          }
			        }
	          }
					}
				}

	      // default html template
	      if ($form_data['allow_email_template'] == 2) {
	      	// check for any downloadable products
		      $download_status = false;

		      $order_product_query = $this->db->query("SELECT * FROM ".DB_PREFIX."order_product WHERE order_id = '".(int)$order_id."'");

		      foreach ($order_product_query->rows as $order_product) {
		        // check if there are any linked downloads
		        $product_download_query = $this->db->query("SELECT COUNT(*) AS total FROM `".DB_PREFIX."product_to_download` WHERE product_id = '".(int)$order_product['product_id']."'");

		        if ($product_download_query->row['total']) {
		          $download_status = true;
		        }
		      }

		      $this->language->load('mail/order');

		      $order_status_query = $this->db->query("SELECT * FROM ".DB_PREFIX."order_status WHERE order_status_id = '".(int)$order_status_id."' AND language_id = '".(int)$order_info['language_id']."'");

		      $order_status = ($order_status_query->num_rows) ? $order_status_query->row['name'] : '';

		      $subject = sprintf($this->language->get('text_new_subject'), $order_info['store_name'], $order_id);

		      // HTML Mail
		      $html_data = array();

		      $html_data['title']                  = sprintf($this->language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);
		      $html_data['text_greeting']          = sprintf($this->language->get('text_new_greeting'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
		      $html_data['text_link']              = $this->language->get('text_new_link');
		      $html_data['text_download']          = $this->language->get('text_new_download');
		      $html_data['text_order_detail']      = $this->language->get('text_new_order_detail');
		      $html_data['text_instruction']       = $this->language->get('text_new_instruction');
		      $html_data['text_order_id']          = $this->language->get('text_new_order_id');
		      $html_data['text_date_added']        = $this->language->get('text_new_date_added');
		      $html_data['text_payment_method']    = $this->language->get('text_new_payment_method');
		      $html_data['text_shipping_method']   = $this->language->get('text_new_shipping_method');
		      $html_data['text_email']             = $this->language->get('text_new_email');
		      $html_data['text_telephone']         = $this->language->get('text_new_telephone');
		      $html_data['text_ip']                = $this->language->get('text_new_ip');
		      $html_data['text_order_status']      = $this->language->get('text_new_order_status');
		      $html_data['text_payment_address']   = $this->language->get('text_new_payment_address');
		      $html_data['text_shipping_address']  = $this->language->get('text_new_shipping_address');
		      $html_data['text_product']           = $this->language->get('text_new_product');
		      $html_data['text_model']             = $this->language->get('text_new_model');
		      $html_data['text_quantity']          = $this->language->get('text_new_quantity');
		      $html_data['text_price']             = $this->language->get('text_new_price');
		      $html_data['text_total']             = $this->language->get('text_new_total');
		      $html_data['text_footer']            = $this->language->get('text_new_footer');

		      $html_data['logo']                   = $this->config->get('config_url').'image/'.$this->config->get('config_logo');
		      $html_data['store_name']             = $order_info['store_name'];
		      $html_data['store_url']              = $order_info['store_url'];
		      $html_data['customer_id']            = $order_info['customer_id'];
		      $html_data['link']                   = $order_info['store_url'].'index.php?route=account/order/info&order_id='.$order_id;
		      $html_data['download']               = ($download_status) ? $order_info['store_url'].'index.php?route=account/download' : '';
		      $html_data['gift_coupon_code']       = !empty($form_data['gift_coupon_code']) ? $form_data['gift_coupon_code'] : '';
		      $html_data['order_id']               = $order_id;
		      $html_data['date_added']             = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
		      $html_data['payment_method']         = $order_info['payment_method'];
		      $html_data['shipping_method']        = $order_info['shipping_method'];
		      $html_data['email']                  = $order_info['email'];
		      $html_data['telephone']              = $order_info['telephone'];
		      $html_data['ip']                     = $order_info['ip'];
		      $html_data['order_status']           = $order_status;
		      $html_data['comment']                = $order_info['comment'];

		      $format = ($order_info['payment_address_format']) ? $order_info['payment_address_format'] : '{firstname} {lastname}'."\n".'{company}'."\n".'{address_1}'."\n".'{address_2}'."\n".'{city} {postcode}'."\n".'{zone}'."\n".'{country}';

		      $find = array(
		        '{firstname}',
		        '{lastname}',
		        '{company}',
		        '{address_1}',
		        '{address_2}',
		        '{city}',
		        '{postcode}',
		        '{zone}',
		        '{zone_code}',
		        '{country}'
		      );

		      $replace = array(
		        'firstname' => $order_info['payment_firstname'],
		        'lastname'  => $order_info['payment_lastname'],
		        'company'   => $order_info['payment_company'],
		        'address_1' => $order_info['payment_address_1'],
		        'address_2' => $order_info['payment_address_2'],
		        'city'      => $order_info['payment_city'],
		        'postcode'  => $order_info['payment_postcode'],
		        'zone'      => $order_info['payment_zone'],
		        'zone_code' => $order_info['payment_zone_code'],
		        'country'   => $order_info['payment_country']
		      );

		      $html_data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

		      $format = ($order_info['shipping_address_format']) ? $order_info['shipping_address_format'] : '{firstname} {lastname}'."\n".'{company}'."\n".'{address_1}'."\n".'{address_2}'."\n".'{city} {postcode}'."\n".'{zone}'."\n".'{country}';

		      $find = array(
		        '{firstname}',
		        '{lastname}',
		        '{company}',
		        '{address_1}',
		        '{address_2}',
		        '{city}',
		        '{postcode}',
		        '{zone}',
		        '{zone_code}',
		        '{country}'
		      );

		      $replace = array(
		        'firstname' => $order_info['shipping_firstname'],
		        'lastname'  => $order_info['shipping_lastname'],
		        'company'   => $order_info['shipping_company'],
		        'address_1' => $order_info['shipping_address_1'],
		        'address_2' => $order_info['shipping_address_2'],
		        'city'      => $order_info['shipping_city'],
		        'postcode'  => $order_info['shipping_postcode'],
		        'zone'      => $order_info['shipping_zone'],
		        'zone_code' => $order_info['shipping_zone_code'],
		        'country'   => $order_info['shipping_country']
		      );

		      $html_data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

		      // products
		      $html_data['products'] = array();

		      foreach ($order_product_query->rows as $product) {
		        $option_data = array();

		        $order_option_query = $this->db->query("SELECT * FROM ".DB_PREFIX."order_option WHERE order_id = '".(int)$order_id."' AND order_product_id = '".(int)$product['order_product_id']."'");

		        foreach ($order_option_query->rows as $option) {
		          if ($option['type'] != 'file') {
		            $value = $option['value'];
		          } else {
		            $upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
		            $value = ($upload_info) ? $upload_info['name'] : '';
		          }

		          $option_data[] = array(
		            'name'  => $option['name'],
		            'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20).'..' : $value)
		          );
		        }

		        $html_data['products'][] = array(
		          'name'     => $product['name'],
		          'model'    => $product['model'],
		          'option'   => $option_data,
		          'quantity' => $product['quantity'],
		          'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
		          'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
		        );
		      }

		      // order totals
		      $order_total_query = $this->db->query("SELECT * FROM `".DB_PREFIX."order_total` WHERE order_id = '".(int)$order_id."' ORDER BY sort_order ASC");

		      foreach ($order_total_query->rows as $total) {
		        $html_data['totals'][] = array(
		          'title' => $total['title'],
		          'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
		        );
		      }

		      $html = $this->load->view('ocdevwizard/'.self::$_module_name.'/'.self::$_module_name.'_mail_system.tpl', $html_data);

		      // email notification
		      $mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
					$mail->smtp_username = $this->config->get('config_mail_smtp_username');
					$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					$mail->smtp_port = $this->config->get('config_mail_smtp_port');
					$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			
		      $mail->setTo($order_info['email']);
		      $mail->setFrom($this->config->get('config_email'));
		      $mail->setSender($this->config->get('config_name'));
		      $mail->setSubject($subject);
		      $mail->setHtml($html);
		      $mail->send();

		      if ($form_data['admin_order_email_notify']) {
	        	$emails = explode(',', $form_data['admin_email_for_notify']);
	          foreach ($emails as $email) {
	            if ($email && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
	              $mail->setTo($email);
	              $mail->send();
	            }
	          }
	        }
				}
			}
    }
  }
}
?>