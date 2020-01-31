<?php

// @category  : OpenCart
// @module    : Smart Checkout
// @author    : OCdevWizard <ocdevwizard@gmail.com> 
// @copyright : Copyright (c) 2014, OCdevWizard
// @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf

class ModelOcdevwizardSmartCheckout extends Model {

	static $_module_version = '2.0.1';
	static $_module_name    = 'smart_checkout'; 

	public function createDBTables() {
		$sql1  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."ocdevwizard_setting` ( ";
		$sql1 .= "`setting_id` int(11) NOT NULL AUTO_INCREMENT,";
		$sql1 .= "`store_id` int(11) NOT NULL DEFAULT '0',";
		$sql1 .= "`code` varchar(32) NOT NULL,";
		$sql1 .= "`key` varchar(64) NOT NULL,";
		$sql1 .= "`value` text NOT NULL,";
		$sql1 .= "`serialized` tinyint(1) NOT NULL,";
		$sql1 .= "PRIMARY KEY (`setting_id`)";
		$sql1 .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

		$this->db->query($sql1);

		$sql2  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."smch_notification` ( ";
		$sql2 .= "`template_id` int(11) NOT NULL AUTO_INCREMENT,";
		$sql2 .= "`status` tinyint(1) NOT NULL DEFAULT '0', ";
		$sql2 .= "PRIMARY KEY (`template_id`)";
		$sql2 .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

		$this->db->query($sql2);

		$sql3  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."smch_notification_description` ( ";
		$sql3 .= "`template_id` int(11) NOT NULL AUTO_INCREMENT,";
		$sql3 .= "`language_id` int(11) NOT NULL,";
  	$sql3 .= "`subject` varchar(255) NOT NULL,";
  	$sql3 .= "`template` text NOT NULL, ";
		$sql3 .= "PRIMARY KEY (`template_id`,`language_id`), ";
		$sql3 .= "KEY `subject` (`subject`)";
		$sql3 .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

		$this->db->query($sql3);
	}

	public function getLanguageByCode($code) {
		$query = $this->db->query("SELECT language_id FROM ".DB_PREFIX."language WHERE code = '".(string)$code."'");

		return $query->row['language_id'];
	}

	public function deleteDBTables() {
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."smch_notification`;");
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."smch_notification_description`;");
	}

	public function getOCdevCatalog() {
		$catalog = array();
		$source  = 'http://ocdevwizard.com/products/share/share.xml';

		if (ini_get('allow_url_fopen')) {
			$results = simplexml_load_file($source);
		} else {    
			$ch = curl_init($source);    
			curl_setopt ($ch, CURLOPT_HEADER, false); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);    
			$xml_raw = curl_exec($ch);    
			$results = simplexml_load_string($xml_raw);
		}
		
		if ($results !== false) {
			foreach ($results->product as $product) {
				$catalog[] = array(
					'extension_id'     => (int)$product->extension_id,
					'title'            => (string)$product->title,
					'img'              => (string)$product->img,
					'price'            => (string)$product->price,
					'url'              => (string)str_replace("&amp;", "&", $product->url),
					'date_added'       => (string)$product->date_added,
					'opencart_version' => (string)$product->opencart_version,
					'latest_version'   => (string)$product->latest_version,
					'features'         => (string)$product->features
				);
			}
		}
		return $catalog;
	}

	public function getOCdevSupportInfo() {
		$catalog = array();
		$source  = 'http://ocdevwizard.com/support/support.xml';

		if (ini_get('allow_url_fopen')) {
			$results = simplexml_load_file($source);
		} else {    
			$ch = curl_init($source);    
			curl_setopt ($ch, CURLOPT_HEADER, false); 
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);    
			$xml_raw = curl_exec($ch);    
			$results = simplexml_load_string($xml_raw);
		}
		
		if ($results !== false) {
			$catalog = array(
				'general' => (string)$results->general,
				'terms'   => (string)$results->terms,
				'service' => (string)$results->service,
				'faq'     => (string)$results->faq
			);
		}
		return $catalog;
	}
	
	public function addNotificationTemplate($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "smch_notification SET status = '" . (int)$data['status'] . "'");

		$template_id = $this->db->getLastId();

		foreach ($data['template_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "smch_notification_description SET template_id = '" . (int)$template_id . "', language_id = '" . (int)$language_id . "', subject = '" . $this->db->escape($value['subject']) . "', template = '" . $this->db->escape($value['template']) . "'");
		}

		return $template_id;
	}

	public function editNotificationTemplate($template_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "smch_notification SET status = '" . (int)$data['status'] . "' WHERE template_id = '" . (int)$template_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "smch_notification_description WHERE template_id = '" . (int)$template_id . "'");

		foreach ($data['template_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "smch_notification_description SET template_id = '" . (int)$template_id . "', language_id = '" . (int)$language_id . "', subject = '" . $this->db->escape($value['subject']) . "', template = '" . $this->db->escape($value['template']) . "'");
		}
	}

	public function copyNotificationTemplate($template_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "smch_notification n LEFT JOIN " . DB_PREFIX . "smch_notification_description nd ON (n.template_id = nd.template_id) WHERE n.template_id = '" . (int)$template_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['status'] = '0';

		
			$data['template_description'] = $this->getNotificationTemplateDescription($template_id);
		
			$this->addNotificationTemplate($data);
		}
	}

	public function deleteNotificationTemplate($template_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "smch_notification WHERE template_id = '" . (int)$template_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "smch_notification_description WHERE template_id = '" . (int)$template_id . "'");
	}

	public function getNotificationTemplate($template_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "smch_notification n LEFT JOIN " . DB_PREFIX . "smch_notification_description nd ON (n.template_id = nd.template_id) WHERE n.template_id = '" . (int)$template_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getNotificationTemplates($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "smch_notification n LEFT JOIN " . DB_PREFIX . "smch_notification_description nd ON (n.template_id = nd.template_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_subject'])) {
			$sql .= " AND nd.subject LIKE '" . $this->db->escape($data['filter_subject']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}

		$sql .= " GROUP BY n.template_id";

		$sort_data = array(
			'nd.subject',
			'n.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY nd.subject";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getNotificationTemplateDescription($template_id) {
		$template_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "smch_notification_description WHERE template_id = '" . (int)$template_id . "'");

		foreach ($query->rows as $result) {
			$template_description_data[$result['language_id']] = array(
				'subject'  => $result['subject'],
				'template' => $result['template']
			);
		}

		return $template_description_data;
	}

	public function getTotalNotificationTemplates($data = array()) {
		$sql = "SELECT COUNT(DISTINCT n.template_id) AS total FROM " . DB_PREFIX . "smch_notification n LEFT JOIN " . DB_PREFIX . "smch_notification_description nd ON (n.template_id = nd.template_id)";

		$sql .= " WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_subject'])) {
			$sql .= " AND nd.subject LIKE '" . $this->db->escape($data['filter_subject']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}