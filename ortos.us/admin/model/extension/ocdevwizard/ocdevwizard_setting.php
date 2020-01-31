<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Setting, 2017                      ##
##==================================================================##
class ModelExtensionOcdevwizardOcdevwizardSetting extends Model {
  public function getSetting($code, $store_id = 0) {
    $setting_data = [];

    if ($this->checkTableExist(DB_PREFIX."ocdevwizard_setting")) {
      $query = $this->db->query("SELECT * FROM ".DB_PREFIX."ocdevwizard_setting WHERE store_id = '".(int)$store_id."' AND `code` = '".$this->db->escape($code)."'")->rows;

      foreach ($query as $result) {
        $setting_data[$result['key']] = (!$result['serialized']) ? $result['value'] : json_decode($result['value'], true);
      }
    }

    return $setting_data;
  }

  public function getSettingData($key, $store_id = 0) {
    $setting_data = [];

    if ($this->checkTableExist(DB_PREFIX."ocdevwizard_setting")) {
      $query = $this->db->query("SELECT * FROM ".DB_PREFIX."ocdevwizard_setting WHERE store_id = '".(int)$store_id."' AND `key` = '".$this->db->escape($key)."'")->rows;

      foreach ($query as $result) {
        $setting_data = (!$result['serialized']) ? $result['value'] : json_decode($result['value'], true);
      }
    }

    return $setting_data;
  }

  public function checkTableExist($table_name) {
    return $this->db->query("SELECT COUNT(*) as total FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$this->db->escape(DB_DATABASE)."' AND TABLE_NAME = '".$this->db->escape($table_name)."'")->row['total'];
  }
}
