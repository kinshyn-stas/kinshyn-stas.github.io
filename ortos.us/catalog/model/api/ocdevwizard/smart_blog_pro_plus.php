<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ModelApiOcdevwizardSmartBlogProPlus extends Model {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';

  public function addModule($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_module
      SET
        status = '".(int)$data['status']."',
        display_type = '".(int)$data['display_type']."',
        `position` = '".$this->db->escape($data['position'])."',
        sort_order = '".(int)$data['sort_order']."',
        `limit` = '".(int)$data['limit']."',
        show_comment_icon = '".(int)$data['show_comment_icon']."',
        show_main_image = '".(int)$data['show_main_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        show_description = '".(int)$data['show_description']."',
        description_limit = '".(int)$data['description_limit']."',
        show_count_viewed = '".(int)$data['show_count_viewed']."',
        show_count_comments = '".(int)$data['show_count_comments']."',
        show_author = '".(int)$data['show_author']."',
        show_read_more_button = '".(int)$data['show_read_more_button']."',
        show_date_added = '".(int)$data['show_date_added']."',
        display_type_inner = '".(int)$data['display_type_inner']."',
        adaptive_setting_0 = '".(int)$data['adaptive_setting_0']."',
        adaptive_setting_1 = '".(int)$data['adaptive_setting_1']."',
        adaptive_setting_2 = '".(int)$data['adaptive_setting_2']."',
        adaptive_setting_3 = '".(int)$data['adaptive_setting_3']."',
        adaptive_setting_4 = '".(int)$data['adaptive_setting_4']."',
        related_type = '".(int)$data['related_type']."',
        sort_method = '".(int)$data['sort_method']."',
        date_added = NOW()
    ");

    $module_id = $this->db->getLastId();

    foreach ($data['module_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_module_description
        SET
          module_id = '".(int)$module_id."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          read_more = '".$this->db->escape($value['read_more'])."'
      ");
    }

    if (isset($data['stores'])) {
      foreach ($data['stores'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_store SET module_id = '".(int)$module_id."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['customer_groups'])) {
      foreach ($data['customer_groups'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_customer_group SET module_id = '".(int)$module_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['module_layout'])) {
      foreach ($data['module_layout'] as $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_layout SET module_id = '".(int)$module_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$module_id."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_post SET module_id = '".(int)$module_id."', related_id = '".(int)$related_id."'");
      }
    }

    if (isset($data['category_related'])) {
      foreach ($data['category_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$module_id."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_category SET module_id = '".(int)$module_id."', related_id = '".(int)$related_id."'");
      }
    }

    return $module_id;
  }

  public function editModule($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_module
      SET
        status = '".(int)$data['status']."',
        display_type = '".(int)$data['display_type']."',
        `position` = '".$this->db->escape($data['position'])."',
        sort_order = '".(int)$data['sort_order']."',
        `limit` = '".(int)$data['limit']."',
        show_comment_icon = '".(int)$data['show_comment_icon']."',
        show_main_image = '".(int)$data['show_main_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        show_description = '".(int)$data['show_description']."',
        description_limit = '".(int)$data['description_limit']."',
        show_count_viewed = '".(int)$data['show_count_viewed']."',
        show_count_comments = '".(int)$data['show_count_comments']."',
        show_author = '".(int)$data['show_author']."',
        show_read_more_button = '".(int)$data['show_read_more_button']."',
        show_date_added = '".(int)$data['show_date_added']."',
        display_type_inner = '".(int)$data['display_type_inner']."',
        adaptive_setting_0 = '".(int)$data['adaptive_setting_0']."',
        adaptive_setting_1 = '".(int)$data['adaptive_setting_1']."',
        adaptive_setting_2 = '".(int)$data['adaptive_setting_2']."',
        adaptive_setting_3 = '".(int)$data['adaptive_setting_3']."',
        adaptive_setting_4 = '".(int)$data['adaptive_setting_4']."',
        related_type = '".(int)$data['related_type']."',
        sort_method = '".(int)$data['sort_method']."',
        date_modified = NOW()
      WHERE
        module_id = '".(int)$data['module_id']."'
    ");

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_description WHERE module_id = '".(int)$data['module_id']."'");

    foreach ($data['module_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_module_description
        SET
          module_id = '".(int)$data['module_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          read_more = '".$this->db->escape($value['read_more'])."'
      ");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_store WHERE module_id = '".(int)$data['module_id']."'");

    if (isset($data['stores'])) {
      foreach ($data['stores'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_store SET module_id = '".(int)$data['module_id']."', store_id = '".(int)$store_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_customer_group WHERE module_id = '".(int)$data['module_id']."'");

    if (isset($data['customer_groups'])) {
      foreach ($data['customer_groups'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_customer_group SET module_id = '".(int)$data['module_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_layout WHERE module_id = '".(int)$data['module_id']."'");

    if (isset($data['module_layout'])) {
      foreach ($data['module_layout'] as $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_layout SET module_id = '".(int)$data['module_id']."', layout_id = '".(int)$layout_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$data['module_id']."'");

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$data['module_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_post SET module_id = '".(int)$data['module_id']."', related_id = '".(int)$related_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$data['module_id']."'");

    if (isset($data['category_related'])) {
      foreach ($data['category_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$data['module_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_category SET module_id = '".(int)$data['module_id']."', related_id = '".(int)$related_id."'");
      }
    }
  }

  public function prepareModule() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_module");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_module_description");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_module_to_store");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_module_to_layout");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_module_to_customer_group");
  }

  public function importModule($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_module
      SET
        module_id = '".(int)$data['module_id']."',
        status = '".(int)$data['status']."',
        display_type = '".(int)$data['display_type']."',
        `position` = '".$this->db->escape($data['position'])."',
        sort_order = '".(int)$data['sort_order']."',
        `limit` = '".(int)$data['limit']."',
        show_comment_icon = '".(int)$data['show_comment_icon']."',
        show_main_image = '".(int)$data['show_main_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        show_description = '".(int)$data['show_description']."',
        description_limit = '".(int)$data['description_limit']."',
        show_count_viewed = '".(int)$data['show_count_viewed']."',
        show_count_comments = '".(int)$data['show_count_comments']."',
        show_author = '".(int)$data['show_author']."',
        show_read_more_button = '".(int)$data['show_read_more_button']."',
        show_date_added = '".(int)$data['show_date_added']."',
        display_type_inner = '".(int)$data['display_type_inner']."',
        adaptive_setting_0 = '".(int)$data['adaptive_setting_0']."',
        adaptive_setting_1 = '".(int)$data['adaptive_setting_1']."',
        adaptive_setting_2 = '".(int)$data['adaptive_setting_2']."',
        adaptive_setting_3 = '".(int)$data['adaptive_setting_3']."',
        adaptive_setting_4 = '".(int)$data['adaptive_setting_4']."',
        related_type = '".(int)$data['related_type']."',
        sort_method = '".(int)$data['sort_method']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");

    foreach ($data['module_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_module_description
        SET
          module_id = '".(int)$data['module_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          read_more = '".$this->db->escape($value['read_more'])."'
      ");
    }

    if (isset($data['stores'])) {
      foreach ($data['stores'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_store SET module_id = '".(int)$data['module_id']."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['customer_groups'])) {
      foreach ($data['customer_groups'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_customer_group SET module_id = '".(int)$data['module_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['module_layout'])) {
      foreach ($data['module_layout'] as $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_to_layout SET module_id = '".(int)$data['module_id']."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$data['module_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_post SET module_id = '".(int)$data['module_id']."', related_id = '".(int)$related_id."'");
      }
    }

    if (isset($data['category_related'])) {
      foreach ($data['category_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$data['module_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_module_related_category SET module_id = '".(int)$data['module_id']."', related_id = '".(int)$related_id."'");
      }
    }
  }

  public function deleteModule($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_description WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_store WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_customer_group WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_layout WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$data['module_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$data['module_id']."'");

    return true;
  }

  public function deleteModules() {
    $query = $this->db->query("SELECT module_id FROM ".DB_PREFIX.$this->_code."_module")->rows;

    if ($query) {
      foreach ($query as $module) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_description WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_store WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_customer_group WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_to_layout WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$module['module_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$module['module_id']."'");
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyModule($data) {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_module m LEFT JOIN ".DB_PREFIX.$this->_code."_module_description md ON (m.module_id = md.module_id) WHERE m.module_id = '".(int)$data['module_id']."' AND md.language_id = '".(int)$this->config->get('config_language_id')."'");

    if ($query->num_rows) {
      $data = [];

      $data = $query->row;

      $data['status'] = '0';

      $data = array_merge($data, ['stores' => $this->getModuleStores($data['module_id'])]);
      $data = array_merge($data, ['customer_groups' => $this->getModuleCustomerGroups($data['module_id'])]);
      $data = array_merge($data, ['module_layout' => $this->getModuleLayouts($data['module_id'])]);
      $data = array_merge($data, ['module_description' => $this->getModuleDescription($data['module_id'])]);
      $data = array_merge($data, ['post_related' => $this->getModuleRelatedPost($data['module_id'])]);
      $data = array_merge($data, ['category_related' => $this->getModuleRelatedCategory($data['module_id'])]);

      $this->addModule($data);

      return true;
    } else {
      return false;
    }
  }

  public function addCategory($data) {
    $this->db->query("
    INSERT INTO ".DB_PREFIX.$this->_code."_category
    SET
      parent_id = '".(int)$data['parent_id']."',
      sort_order = '".(int)$data['sort_order']."',
      sort_method = '".(int)$data['sort_method']."',
      description_position = '".(int)$data['description_position']."',
      show_subcategories = '".(int)$data['show_subcategories']."',
      show_subcategories_total = '".(int)$data['show_subcategories_total']."',
      status = '".(int)$data['status']."',
      show_description = '".(int)$data['show_description']."',
      show_main_image = '".(int)$data['show_main_image']."',
      show_additional_image = '".(int)$data['show_additional_image']."',
      main_image_width = '".(int)$data['main_image_width']."',
      main_image_height = '".(int)$data['main_image_height']."',
      additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
      additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
      additional_image_width = '".(int)$data['additional_image_width']."',
      additional_image_height = '".(int)$data['additional_image_height']."',
      date_added = NOW()
    ");

    $category_id = $this->db->getLastId();

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_category SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_category_id = '".(int)$category_id."'");
    }

    foreach ($data['category_description'] as $language_id => $value) {
      $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_category_description
      SET
        ".$this->_code."_category_id = '".(int)$category_id."',
        language_id = '".(int)$language_id."',
        `name` = '".$this->db->escape($value['name'])."',
        description = '".$this->db->escape($value['description'])."',
        main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
        meta_title = '".$this->db->escape($value['meta_title'])."',
        meta_description = '".$this->db->escape($value['meta_description'])."',
        meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    $level = 0;

    $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$data['parent_id']."' ORDER BY `level` ASC");

    foreach ($query->rows as $result) {
      $this->db->query("INSERT INTO `".DB_PREFIX.$this->_code."_category_path` SET `".$this->_code."_category_id` = '".(int)$category_id."', `path_id` = '".(int)$result['path_id']."', `level` = '".(int)$level."'");

      $level++;
    }

    $this->db->query("INSERT INTO `".DB_PREFIX.$this->_code."_category_path` SET `".$this->_code."_category_id` = '".(int)$category_id."', `path_id` = '".(int)$category_id."', `level` = '".(int)$level."'");

    if (isset($data['category_image'])) {
      foreach ($data['category_image'] as $category_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_image SET ".$this->_code."_category_id = '".(int)$category_id."', image = '".$this->db->escape($category_image['image'])."', sort_order = '".(int)$category_image['sort_order']."'");
      }
    }

    if (isset($data['category_store'])) {
      foreach ($data['category_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_store SET ".$this->_code."_category_id = '".(int)$category_id."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['category_layout'])) {
      foreach ($data['category_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_layout SET ".$this->_code."_category_id = '".(int)$category_id."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['category_customer_group'])) {
      foreach ($data['category_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_customer_group SET ".$this->_code."_category_id = '".(int)$category_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_category_id=".(int)$category_id."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_category_id=".(int)$category_id."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }

    return $category_id;
  }

  public function editCategory($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_category
      SET
        parent_id = '".(int)$data['parent_id']."',
        sort_order = '".(int)$data['sort_order']."',
        sort_method = '".(int)$data['sort_method']."',
        description_position = '".(int)$data['description_position']."',
        show_subcategories = '".(int)$data['show_subcategories']."',
        show_subcategories_total = '".(int)$data['show_subcategories_total']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
        additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_modified = NOW()
      WHERE
        ".$this->_code."_category_id = '".(int)$data['category_id']."'
    ");

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_category SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_description WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    foreach ($data['category_description'] as $language_id => $value) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_description 
        SET ".$this->_code."_category_id = '".(int)$data['category_id']."', 
        language_id = '".(int)$language_id."', 
        name = '".$this->db->escape($value['name'])."', 
        description = '".$this->db->escape($value['description'])."', 
        main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
        meta_title = '".$this->db->escape($value['meta_title'])."', 
        meta_description = '".$this->db->escape($value['meta_description'])."', 
        meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE path_id = '".(int)$data['category_id']."' ORDER BY level ASC");

    if ($query->rows) {
      foreach ($query->rows as $category_path) {
        $this->db->query("DELETE FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$category_path[$this->_code.'_category_id']."' AND level < '".(int)$category_path['level']."'");

        $path = [];

        $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$data['parent_id']."' ORDER BY level ASC");

        foreach ($query->rows as $result) {
          $path[] = $result['path_id'];
        }

        $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$category_path[$this->_code.'_category_id']."' ORDER BY level ASC");

        foreach ($query->rows as $result) {
          $path[] = $result['path_id'];
        }

        $level = 0;

        foreach ($path as $path_id) {
          $this->db->query("REPLACE INTO `".DB_PREFIX.$this->_code."_category_path` SET ".$this->_code."_category_id = '".(int)$category_path[$this->_code.'_category_id']."', `path_id` = '".(int)$path_id."', level = '".(int)$level."'");

          $level++;
        }
      }
    } else {
      $this->db->query("DELETE FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

      $level = 0;

      $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$data['parent_id']."' ORDER BY level ASC");

      foreach ($query->rows as $result) {
        $this->db->query("INSERT INTO `".DB_PREFIX.$this->_code."_category_path` SET ".$this->_code."_category_id = '".(int)$data['category_id']."', `path_id` = '".(int)$result['path_id']."', level = '".(int)$level."'");

        $level++;
      }

      $this->db->query("REPLACE INTO `".DB_PREFIX.$this->_code."_category_path` SET ".$this->_code."_category_id = '".(int)$data['category_id']."', `path_id` = '".(int)$data['category_id']."', level = '".(int)$level."'");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    if (isset($data['category_image'])) {
      foreach ($data['category_image'] as $category_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_image SET ".$this->_code."_category_id = '".(int)$data['category_id']."', image = '".$this->db->escape($category_image['image'])."', sort_order = '".(int)$category_image['sort_order']."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_store WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    if (isset($data['category_store'])) {
      foreach ($data['category_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_store SET ".$this->_code."_category_id = '".(int)$data['category_id']."', store_id = '".(int)$store_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_layout WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    if (isset($data['category_layout'])) {
      foreach ($data['category_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_layout SET ".$this->_code."_category_id = '".(int)$data['category_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_customer_group WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    if (isset($data['category_customer_group'])) {
      foreach ($data['category_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_customer_group SET ".$this->_code."_category_id = '".(int)$data['category_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_category_id=".(int)$data['category_id']."'");

      if ($data['keyword']) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_category_id=".(int)$data['category_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      }
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_category_id=".(int)$data['category_id']."'");

      if ($data['keyword']) {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_category_id=".(int)$data['category_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function prepareCategory() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_description");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_to_store");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_to_customer_group");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_to_layout");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_path");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_category_image");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query LIKE '%".$this->_code."_category_id=%'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query LIKE '%".$this->_code."_category_id=%'");
    }
  }

  public function importCategory($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_category
      SET
        ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."',
        parent_id = '".(int)$data['parent_id']."',
        image = '".$this->db->escape($data['image'])."',
        sort_order = '".(int)$data['sort_order']."',
        sort_method = '".(int)$data['sort_method']."',
        description_position = '".(int)$data['description_position']."',
        show_subcategories = '".(int)$data['show_subcategories']."',
        show_subcategories_total = '".(int)$data['show_subcategories_total']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
        additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");

    foreach ($data['category_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_category_description
        SET
          ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    $level = 0;

    $query = $this->db->query("SELECT * FROM `".DB_PREFIX.$this->_code."_category_path` WHERE ".$this->_code."_category_id = '".(int)$data['parent_id']."' ORDER BY `level` ASC");

    foreach ($query->rows as $result) {
      $this->db->query("INSERT INTO `".DB_PREFIX.$this->_code."_category_path` SET `".$this->_code."_category_id` = '".(int)$data[$this->_code.'_category_id']."', `path_id` = '".(int)$result['path_id']."', `level` = '".(int)$level."'");

      $level++;
    }

    $this->db->query("INSERT INTO `".DB_PREFIX.$this->_code."_category_path` SET `".$this->_code."_category_id` = '".(int)$data[$this->_code.'_category_id']."', `path_id` = '".(int)$data[$this->_code.'_category_id']."', `level` = '".(int)$level."'");

    if (isset($data['category_image'])) {
      foreach ($data['category_image'] as $category_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_image SET ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."', image = '".$this->db->escape($category_image['image'])."', sort_order = '".(int)$category_image['sort_order']."'");
      }
    }

    if (isset($data['category_store'])) {
      foreach ($data['category_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_store SET ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['category_layout'])) {
      foreach ($data['category_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_layout SET ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['category_customer_group'])) {
      foreach ($data['category_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_category_to_customer_group SET ".$this->_code."_category_id = '".(int)$data[$this->_code.'_category_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_category_id=".(int)$data[$this->_code.'_category_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_category_id=".(int)$data[$this->_code.'_category_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function deleteCategory($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_path WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_path WHERE path_id = '".(int)$data['category_id']."'");

    foreach ($query->rows as $result) {
      $this->deleteCategory($result['category_id']);
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_description WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_store WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_layout WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_customer_group WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_category_id = '".(int)$data['category_id']."'");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_category_id=".(int)$data['category_id']."'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_category_id=".(int)$data['category_id']."'");
    }

    return true;
  }

  public function deleteCategories() {
    $query = $this->db->query("SELECT ".$this->_code."_category_id FROM ".DB_PREFIX.$this->_code."_category")->rows;

    if ($query) {
      foreach ($query as $category) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_description WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_store WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_layout WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_to_customer_group WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_category_path WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_category_id = '".(int)$category[$this->_code.'_category_id']."'");
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_category_id=".(int)$category[$this->_code.'_category_id']."'");
        } else {
          $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_category_id=".(int)$category[$this->_code.'_category_id']."'");
        }
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyCategory($data) {
    $query = $this->db->query("
      SELECT
        DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_category `c`
      LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (`c`.".$this->_code."_category_id = cd.".$this->_code."_category_id)
      WHERE
        `c`.".$this->_code."_category_id = '".(int)$data['category_id']."'
      AND
        cd.language_id = '".(int)$this->config->get('config_language_id')."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['status'] = '0';

      $data = array_merge($data, ['category_image' => $this->getCategoryImages($data[$this->_code.'_category_id'])]);
      $data = array_merge($data, ['category_store' => $this->getCategoryStores($data[$this->_code.'_category_id'])]);
      $data = array_merge($data, ['category_customer_group' => $this->getCategoryCustomerGroups($data[$this->_code.'_category_id'])]);
      $data = array_merge($data, ['category_layout' => $this->getCategoryLayouts($data[$this->_code.'_category_id'])]);
      $data = array_merge($data, ['category_description' => $this->getCategoryDescription($data[$this->_code.'_category_id'])]);

      $this->addCategory($data);

      return true;
    } else {
      return false;
    }
  }

  public function addPost($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_post
      SET
        ".$this->_code."_author_id = '".(int)$data['author_id']."',
        ".$this->_code."_main_category_id = '".(int)$data['main_category_id']."',
        sort_order = '".(int)$data['sort_order']."',
        status = '".(int)$data['status']."',
        video_show_type = '".(int)$data['video_show_type']."',
        video = '".$this->db->escape($data['video'])."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        main_image_popup_width = '".(int)$data['main_image_popup_width']."',
        main_image_popup_height = '".(int)$data['main_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_available = '".$this->db->escape($data['date_available'])."',
        date_added = NOW()
    ");

    $post_id = $this->db->getLastId();

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_post SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_post_id = '".(int)$post_id."'");
    }

    foreach ($data['post_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_post_description
        SET
          ".$this->_code."_post_id = '".(int)$post_id."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          short_description = '".$this->db->escape($value['short_description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          tag = '".$this->db->escape($value['tag'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    if (isset($data['post_store'])) {
      foreach ($data['post_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_store SET ".$this->_code."_post_id = '".(int)$post_id."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['post_image'])) {
      foreach ($data['post_image'] as $post_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_image SET ".$this->_code."_post_id = '".(int)$post_id."', image = '".$this->db->escape($post_image['image'])."', sort_order = '".(int)$post_image['sort_order']."'");
      }
    }

    $data['post_category'][] = (int)$data['main_category_id'];

    $data['post_category'] = array_unique($data['post_category']);

    foreach ($data['post_category'] as $category_id) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_category SET ".$this->_code."_post_id = '".(int)$post_id."', ".$this->_code."_category_id = '".(int)$category_id."'");
    }

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$post_id."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$post_id."', related_id = '".(int)$related_id."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$related_id."' AND related_id = '".(int)$post_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$related_id."', related_id = '".(int)$post_id."'");
      }
    }

    if (isset($data['product_related'])) {
      foreach ($data['product_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$post_id."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_product SET ".$this->_code."_post_id = '".(int)$post_id."', related_id = '".(int)$related_id."'");
      }
    }

    if (isset($data['post_layout'])) {
      foreach ($data['post_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_layout SET ".$this->_code."_post_id = '".(int)$post_id."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['post_customer_group'])) {
      foreach ($data['post_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_customer_group SET ".$this->_code."_post_id = '".(int)$post_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_post_id=".(int)$post_id."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_post_id=".(int)$post_id."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }

    return $post_id;
  }

  public function editPost($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_post
      SET
        ".$this->_code."_author_id = '".(int)$data['author_id']."',
        ".$this->_code."_main_category_id = '".(int)$data['main_category_id']."',
        sort_order = '".(int)$data['sort_order']."',
        status = '".(int)$data['status']."',
        video_show_type = '".(int)$data['video_show_type']."',
        video = '".$this->db->escape($data['video'])."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        main_image_popup_width = '".(int)$data['main_image_popup_width']."',
        main_image_popup_height = '".(int)$data['main_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_available = '".$this->db->escape($data['date_available'])."',
        date_modified = NOW()
      WHERE
        ".$this->_code."_post_id = '".(int)$data['post_id']."'
    ");

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_post SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_description WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    foreach ($data['post_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_post_description
        SET
          ".$this->_code."_post_id = '".(int)$data['post_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          short_description = '".$this->db->escape($value['short_description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          tag = '".$this->db->escape($value['tag'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_store WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    if (isset($data['post_store'])) {
      foreach ($data['post_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_store SET ".$this->_code."_post_id = '".(int)$data['post_id']."', store_id = '".(int)$store_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    if (isset($data['post_image'])) {
      foreach ($data['post_image'] as $post_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_image SET ".$this->_code."_post_id = '".(int)$data['post_id']."', image = '".$this->db->escape($post_image['image'])."', sort_order = '".(int)$post_image['sort_order']."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    $data['post_category'][] = (int)$data['main_category_id'];

    $data['post_category'] = array_unique($data['post_category']);

    foreach ($data['post_category'] as $category_id) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_category SET ".$this->_code."_post_id = '".(int)$data['post_id']."', ".$this->_code."_category_id = '".(int)$category_id."'");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE related_id = '".(int)$data['post_id']."'");

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$data['post_id']."', related_id = '".(int)$related_id."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$related_id."' AND related_id = '".(int)$data['post_id']."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$related_id."', related_id = '".(int)$data['post_id']."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    if (isset($data['product_related'])) {
      foreach ($data['product_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_product SET ".$this->_code."_post_id = '".(int)$data['post_id']."', related_id = '".(int)$related_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_layout WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    if (isset($data['post_layout'])) {
      foreach ($data['post_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_layout SET ".$this->_code."_post_id = '".(int)$data['post_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_customer_group WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");

    if (isset($data['post_customer_group'])) {
      foreach ($data['post_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_customer_group SET ".$this->_code."_post_id = '".(int)$data['post_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_post_id=".(int)$data['post_id']."'");

      if ($data['keyword']) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_post_id=".(int)$data['post_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      }
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_post_id=".(int)$data['post_id']."'");

      if ($data['keyword']) {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_post_id=".(int)$data['post_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function preparePost() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_description");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_to_store");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_to_customer_group");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_to_layout");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_to_category");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_image");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_related_post");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_post_related_product");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query LIKE '%".$this->_code."_post_id=%'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query LIKE '%".$this->_code."_post_id=%'");
    }
  }

  public function importPost($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_post
      SET
        ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."',
        ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."',
        ".$this->_code."_main_category_id = '".(int)$data[$this->_code.'_main_category_id']."',
        video = '".$this->db->escape($data['video'])."',
        video_show_type = '".(int)$data['video_show_type']."',
        sort_order = '".(int)$data['sort_order']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        main_image_popup_width = '".(int)$data['main_image_popup_width']."',
        main_image_popup_height = '".(int)$data['main_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."',
        date_available = '".$this->db->escape($data['date_available'])."'
    ");

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_post SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."'");
    }

    foreach ($data['post_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_post_description
        SET
          ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          short_description = '".$this->db->escape($value['short_description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          tag = '".$this->db->escape($value['tag'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    if (isset($data['post_store'])) {
      foreach ($data['post_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_store SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['post_image'])) {
      foreach ($data['post_image'] as $post_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_image SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', image = '".$this->db->escape($post_image['image'])."', sort_order = '".(int)$post_image['sort_order']."'");
      }
    }

    $data['post_category'][] = (int)$data['main_category_id'];

    foreach ($data['post_category'] as $category_id) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_category SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', ".$this->_code."_category_id = '".(int)$category_id."'");
    }

    if (isset($data['post_related'])) {
      foreach ($data['post_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', related_id = '".(int)$related_id."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$related_id."' AND related_id = '".(int)$data[$this->_code.'_post_id']."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_post SET ".$this->_code."_post_id = '".(int)$related_id."', related_id = '".(int)$data[$this->_code.'_post_id']."'");
      }
    }

    if (isset($data['product_related'])) {
      foreach ($data['product_related'] as $related_id) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."' AND related_id = '".(int)$related_id."'");
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_related_product SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', related_id = '".(int)$related_id."'");
      }
    }

    if (isset($data['post_layout'])) {
      foreach ($data['post_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_layout SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['post_customer_group'])) {
      foreach ($data['post_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_post_to_customer_group SET ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_post_id=".(int)$data[$this->_code.'_post_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_post_id=".(int)$data[$this->_code.'_post_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function deletePost($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_description WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE related_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_customer_group WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_layout WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_store WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment WHERE ".$this->_code."_post_id = '".(int)$data['post_id']."'");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_post_id=".(int)$data['post_id']."'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_post_id=".(int)$data['post_id']."'");
    }

    return true;
  }

  public function deletePosts() {
    $query = $this->db->query("SELECT ".$this->_code."_post_id FROM ".DB_PREFIX.$this->_code."_post")->rows;

    if ($query) {
      foreach ($query as $post) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_description WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE related_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_customer_group WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_layout WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_post_to_store WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment WHERE ".$this->_code."_post_id = '".(int)$post[$this->_code.'_post_id']."'");
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_post_id=".(int)$post[$this->_code.'_post_id']."'");
        } else {
          $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_post_id=".(int)$post[$this->_code.'_post_id']."'");
        }
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyPost($data) {
    $query = $this->db->query("
      SELECT DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_post p
      LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id)
      WHERE
        p.".$this->_code."_post_id = '".(int)$data['post_id']."'
      AND
        pd.language_id = '".(int)$this->config->get('config_language_id')."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['viewed']           = '0';
      $data['status']           = '0';
      $data['author_id']        = $query->row[$this->_code.'_author_id'];
      $data['main_category_id'] = $query->row[$this->_code.'_main_category_id'];

      $data = array_merge($data, ['post_description' => $this->getPostDescription($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_image' => $this->getPostImages($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_related' => $this->getPostRelatedPost($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['product_related' => $this->getPostRelatedProduct($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_customer_group' => $this->getPostCustomerGroups($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_category' => $this->getPostCategories($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_layout' => $this->getPostLayouts($data[$this->_code.'_post_id'])]);
      $data = array_merge($data, ['post_store' => $this->getPostStores($data[$this->_code.'_post_id'])]);

      $this->addPost($data);

      return true;
    } else {
      return false;
    }
  }

  public function addAuthor($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_author
      SET
        sort_order = '".(int)$data['sort_order']."',
        sort_method = '".(int)$data['sort_method']."',
        description_position = '".(int)$data['description_position']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
        additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_added = NOW()
    ");

    $author_id = $this->db->getLastId();

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_author SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_author_id = '".(int)$author_id."'");
    }

    foreach ($data['author_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_author_description
        SET
          ".$this->_code."_author_id = '".(int)$author_id."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    if (isset($data['author_store'])) {
      foreach ($data['author_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_store SET ".$this->_code."_author_id = '".(int)$author_id."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['author_image'])) {
      foreach ($data['author_image'] as $author_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_image SET ".$this->_code."_author_id = '".(int)$author_id."', image = '".$this->db->escape($author_image['image'])."', sort_order = '".(int)$author_image['sort_order']."'");
      }
    }

    if (isset($data['author_layout'])) {
      foreach ($data['author_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_layout SET ".$this->_code."_author_id = '".(int)$author_id."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['author_customer_group'])) {
      foreach ($data['author_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_customer_group SET ".$this->_code."_author_id = '".(int)$author_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_author_id=".(int)$author_id."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_author_id=".(int)$author_id."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }

    return $author_id;
  }

  public function editAuthor($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_author
      SET
        sort_order = '".(int)$data['sort_order']."',
        sort_method = '".(int)$data['sort_method']."',
        description_position = '".(int)$data['description_position']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
        additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_modified = NOW()
      WHERE
        ".$this->_code."_author_id = '".(int)$data['author_id']."'
    ");

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_author SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_description WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");

    foreach ($data['author_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_author_description
        SET
          ".$this->_code."_author_id = '".(int)$data['author_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_store WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");

    if (isset($data['author_store'])) {
      foreach ($data['author_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_store SET ".$this->_code."_author_id = '".(int)$data['author_id']."', store_id = '".(int)$store_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");

    if (isset($data['author_image'])) {
      foreach ($data['author_image'] as $author_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_image SET ".$this->_code."_author_id = '".(int)$data['author_id']."', image = '".$this->db->escape($author_image['image'])."', sort_order = '".(int)$author_image['sort_order']."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_layout WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");

    if (isset($data['author_layout'])) {
      foreach ($data['author_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_layout SET ".$this->_code."_author_id = '".(int)$data['author_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_customer_group WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");

    if (isset($data['author_customer_group'])) {
      foreach ($data['author_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_customer_group SET ".$this->_code."_author_id = '".(int)$data['author_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_author_id=".(int)$data['author_id']."'");

      if ($data['keyword']) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_author_id=".(int)$data['author_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      }
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_author_id=".(int)$data['author_id']."'");

      if ($data['keyword']) {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_author_id=".(int)$data['author_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function prepareAuthor() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author_description");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author_to_store");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author_to_customer_group");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author_to_layout");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_author_image");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query LIKE '%".$this->_code."_author_id=%'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query LIKE '%".$this->_code."_author_id=%'");
    }
  }

  public function importAuthor($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_author
      SET
        ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."',
        image = '".$this->db->escape($data['image'])."',
        sort_order = '".(int)$data['sort_order']."',
        sort_method = '".(int)$data['sort_method']."',
        description_position = '".(int)$data['description_position']."',
        status = '".(int)$data['status']."',
        show_description = '".(int)$data['show_description']."',
        show_main_image = '".(int)$data['show_main_image']."',
        show_additional_image = '".(int)$data['show_additional_image']."',
        main_image_width = '".(int)$data['main_image_width']."',
        main_image_height = '".(int)$data['main_image_height']."',
        additional_image_popup_width = '".(int)$data['additional_image_popup_width']."',
        additional_image_popup_height = '".(int)$data['additional_image_popup_height']."',
        additional_image_width = '".(int)$data['additional_image_width']."',
        additional_image_height = '".(int)$data['additional_image_height']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");

    if (isset($data['image'])) {
      $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_author SET image = '".$this->db->escape($data['image'])."' WHERE ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."'");
    }

    foreach ($data['author_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_author_description
        SET
          ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."',
          language_id = '".(int)$language_id."',
          `name` = '".$this->db->escape($value['name'])."',
          description = '".$this->db->escape($value['description'])."',
          main_image_alt = '".$this->db->escape($value['main_image_alt'])."',
          meta_title = '".$this->db->escape($value['meta_title'])."',
          meta_description = '".$this->db->escape($value['meta_description'])."',
          meta_keyword = '".$this->db->escape($value['meta_keyword'])."'
      ");
    }

    if (isset($data['author_store'])) {
      foreach ($data['author_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_store SET ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['author_image'])) {
      foreach ($data['author_image'] as $author_image) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_image SET ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."', image = '".$this->db->escape($author_image['image'])."', sort_order = '".(int)$author_image['sort_order']."'");
      }
    }

    if (isset($data['author_layout'])) {
      foreach ($data['author_layout'] as $store_id => $layout_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_layout SET ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."', store_id = '".(int)$store_id."', layout_id = '".(int)$layout_id."'");
      }
    }

    if (isset($data['author_customer_group'])) {
      foreach ($data['author_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_author_to_customer_group SET ".$this->_code."_author_id = '".(int)$data[$this->_code.'_author_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    if (isset($data['keyword'])) {
      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($data['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $this->db->query("INSERT INTO ".DB_PREFIX."seo_url SET store_id = '".(int)$store_id."', language_id = '".(int)$language_id."', query = '".$this->_code."_author_id=".(int)$data[$this->_code.'_author_id']."', keyword = '".$this->db->escape($keyword)."'");
            }
          }
        }
      } else {
        $this->db->query("INSERT INTO ".DB_PREFIX."url_alias SET query = '".$this->_code."_author_id=".(int)$data[$this->_code.'_author_id']."', keyword = '".$this->db->escape($data['keyword'])."'");
      }
    }
  }

  public function deleteAuthor($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_description WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_customer_group WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_layout WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_store WHERE ".$this->_code."_author_id = '".(int)$data['author_id']."'");
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_author_id=".(int)$data['author_id']."'");
    } else {
      $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_author_id=".(int)$data['author_id']."'");
    }
  }

  public function deleteAuthors() {
    $query = $this->db->query("SELECT ".$this->_code."_author_id FROM ".DB_PREFIX.$this->_code."_author")->rows;

    if ($query) {
      foreach ($query as $post) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_description WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_customer_group WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_layout WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_author_to_store WHERE ".$this->_code."_author_id = '".(int)$post[$this->_code.'_author_id']."'");
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->db->query("DELETE FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_author_id=".(int)$post[$this->_code.'_author_id']."'");
        } else {
          $this->db->query("DELETE FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_author_id=".(int)$post[$this->_code.'_author_id']."'");
        }
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyAuthor($data) {
    $query = $this->db->query("
      SELECT 
        DISTINCT * 
      FROM ".DB_PREFIX.$this->_code."_author a 
      LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) 
      WHERE 
        a.".$this->_code."_author_id = '".(int)$data['author_id']."' 
      AND 
        ad.language_id = '".(int)$this->config->get('config_language_id')."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['keyword'] = '';
      $data['status']  = '0';

      $data = array_merge($data, ['author_description' => $this->getAuthorDescription($data[$this->_code.'_author_id'])]);
      $data = array_merge($data, ['author_image' => $this->getAuthorImages($data[$this->_code.'_author_id'])]);
      $data = array_merge($data, ['author_customer_group' => $this->getAuthorCustomerGroups($data[$this->_code.'_author_id'])]);
      $data = array_merge($data, ['author_layout' => $this->getAuthorLayouts($data[$this->_code.'_author_id'])]);
      $data = array_merge($data, ['author_store' => $this->getAuthorStores($data[$this->_code.'_author_id'])]);

      $this->addAuthor($data);
    }
  }

  public function addComment($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_comment
      SET
        ".$this->_code."_post_id = '".(int)$data['post_id']."',
        status = '".(int)$data['status']."',
        respond_id = '0',
        notification_on_respond = '".(int)$data['notification_on_respond']."',
        firstname = '".$this->db->escape($data['firstname'])."',
        email = '".$this->db->escape($data['email'])."',
        user_agent = '".$this->db->escape($data['user_agent'])."',
        accept_language = '".$this->db->escape($data['accept_language'])."',
        user_language_id = '".(int)$data['user_language_id']."',
        store_name = '".$this->db->escape($data['store_name'])."',
        store_url = '".$this->db->escape($data['store_url'])."',
        store_id = '".(int)$data['store_id']."',
        date_added = NOW()
    ");

    $comment_id = $this->db->getLastId();

    foreach ($data['comment_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_comment_description
        SET
          comment_id = '".(int)$comment_id."',
          language_id = '".(int)$language_id."',
          description = '".$this->db->escape($value['description'])."'
      ");
    }

    if (isset($data['comment_store'])) {
      foreach ($data['comment_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_store SET comment_id = '".(int)$comment_id."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['comment_customer_group'])) {
      foreach ($data['comment_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_customer_group SET comment_id = '".(int)$comment_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    return $comment_id;
  }

  public function addCommentRespond($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_comment
      SET
        ".$this->_code."_post_id = '".(int)$data['post_id']."',
        status = '".(int)$data['status']."',
        respond_id = '".(int)$data['comment_id']."',
        comment_type = '".(int)$data['comment_type']."',
        notification_on_respond = '".(int)$data['notification_on_respond']."',
        firstname = '".$this->db->escape($data['firstname'])."',
        email = '".$this->db->escape($data['email'])."',
        date_added = NOW()
    ");

    $comment_id = $this->db->getLastId();

    foreach ($data['comment_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_comment_description
        SET
          comment_id = '".(int)$comment_id."',
          language_id = '".(int)$language_id."',
          description = '".$this->db->escape($value['description'])."'
      ");
    }

    if ($this->getCommentStores($data['comment_id'])) {
      foreach ($this->getCommentStores($data['comment_id']) as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_store SET comment_id = '".(int)$comment_id."', store_id = '".(int)$store_id."'");
      }
    }

    if ($this->getCommentCustomerGroups($data['comment_id'])) {
      foreach ($this->getCommentCustomerGroups($data['comment_id']) as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_customer_group SET comment_id = '".(int)$comment_id."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }

    return $comment_id;
  }

  public function editComment($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_comment
      SET
        ".$this->_code."_post_id = '".(int)$data['post_id']."',
        status = '".(int)$data['status']."',
        respond_id = '".(int)$data['respond_id']."',
        notification_on_respond = '".(int)$data['notification_on_respond']."',
        firstname = '".$this->db->escape($data['firstname'])."',
        email = '".$this->db->escape($data['email'])."',
        user_agent = '".$this->db->escape($data['user_agent'])."',
        accept_language = '".$this->db->escape($data['accept_language'])."',
        user_language_id = '".(int)$data['user_language_id']."',
        store_name = '".$this->db->escape($data['store_name'])."',
        store_url = '".$this->db->escape($data['store_url'])."',
        store_id = '".(int)$data['store_id']."',
        date_modified = NOW()
      WHERE
        comment_id = '".(int)$data['comment_id']."'
    ");

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_description WHERE comment_id = '".(int)$data['comment_id']."'");

    foreach ($data['comment_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_comment_description
        SET
          comment_id = '".(int)$data['comment_id']."',
          language_id = '".(int)$language_id."',
          description = '".$this->db->escape($value['description'])."'
      ");
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_store WHERE comment_id = '".(int)$data['comment_id']."'");

    if (isset($data['comment_store'])) {
      foreach ($data['comment_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_store SET comment_id = '".(int)$data['comment_id']."', store_id = '".(int)$store_id."'");
      }
    }

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_customer_group WHERE comment_id = '".(int)$data['comment_id']."'");

    if (isset($data['comment_customer_group'])) {
      foreach ($data['comment_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_customer_group SET comment_id = '".(int)$data['comment_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }
  }

  public function prepareComment() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_comment");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_comment_description");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_comment_to_store");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_comment_to_customer_group");
  }

  public function importComment($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_comment
      SET
        comment_id = '".(int)$data['comment_id']."',
        ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."',
        status = '".(int)$data['status']."',
        respond_id = '".(int)$data['respond_id']."',
        notification_on_respond = '".(int)$data['notification_on_respond']."',
        firstname = '".$this->db->escape($data['firstname'])."',
        email = '".$this->db->escape($data['email'])."',
        user_agent = '".$this->db->escape($data['user_agent'])."',
        accept_language = '".$this->db->escape($data['accept_language'])."',
        user_language_id = '".(int)$data['user_language_id']."',
        store_name = '".$this->db->escape($data['store_name'])."',
        store_url = '".$this->db->escape($data['store_url'])."',
        store_id = '".(int)$data['store_id']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");

    foreach ($data['comment_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_comment_description
        SET
          comment_id = '".(int)$data['comment_id']."',
          language_id = '".(int)$language_id."',
          description = '".$this->db->escape($value['description'])."'
      ");
    }

    if (isset($data['comment_store'])) {
      foreach ($data['comment_store'] as $store_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_store SET comment_id = '".(int)$data['comment_id']."', store_id = '".(int)$store_id."'");
      }
    }

    if (isset($data['comment_customer_group'])) {
      foreach ($data['comment_customer_group'] as $customer_group_id) {
        $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_customer_group SET comment_id = '".(int)$data['comment_id']."', customer_group_id = '".(int)$customer_group_id."'");
      }
    }
  }

  public function deleteComment($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment WHERE comment_id = '".(int)$data['comment_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_description WHERE comment_id = '".(int)$data['comment_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_customer_group WHERE comment_id = '".(int)$data['comment_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_store WHERE comment_id = '".(int)$data['comment_id']."'");

    return true;
  }

  public function deleteComments() {
    $query = $this->db->query("SELECT comment_id FROM ".DB_PREFIX.$this->_code."_comment")->rows;

    if ($query) {
      foreach ($query as $comment) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment WHERE comment_id = '".(int)$comment['comment_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_description WHERE comment_id = '".(int)$comment['comment_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_customer_group WHERE comment_id = '".(int)$comment['comment_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_comment_to_store WHERE comment_id = '".(int)$comment['comment_id']."'");
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyComment($data) {
    $query = $this->db->query("
      SELECT DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_comment `c`
      LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id)
      WHERE
        `c`.comment_id = '".(int)$data['comment_id']."'
      AND
        cd.language_id = '".(int)$this->config->get('config_language_id')."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['status'] = '0';

      $data['post_id'] = $query->row[$this->_code.'_post_id'];

      $data = array_merge($data, ['comment_description' => $this->getCommentDescription($data['comment_id'])]);
      $data = array_merge($data, ['comment_customer_group' => $this->getCommentCustomerGroups($data['comment_id'])]);
      $data = array_merge($data, ['comment_store' => $this->getCommentStores($data['comment_id'])]);

      $this->addComment($data);

      return true;
    } else {
      return false;
    }
  }

  public function addBanned($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_banned
      SET
        status = '".(int)$data['status']."',
        ip = '".$this->db->escape($data['ip'])."',
        email = '".$this->db->escape($data['email'])."',
        date_added = NOW()
    ");

    $banned_id = $this->db->getLastId();

    return $banned_id;
  }

  public function editBanned($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_banned
      SET
        status = '".(int)$data['status']."',
        ip = '".$this->db->escape($data['ip'])."',
        email = '".$this->db->escape($data['email'])."',
        date_modified = NOW()
      WHERE
        banned_id = '".(int)$data['banned_id']."'
    ");
  }

  public function prepareBanned() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_banned");
  }

  public function importBanned($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_banned
      SET
        banned_id = '".(int)$data['banned_id']."',
        status = '".(int)$data['status']."',
        ip = '".$this->db->escape($data['ip'])."',
        email = '".$this->db->escape($data['email'])."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");
  }

  public function deleteBanned($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_banned WHERE banned_id = '".(int)$data['banned_id']."'");

    return true;
  }

  public function deleteBanneds() {
    $query = $this->db->query("SELECT banned_id FROM ".DB_PREFIX.$this->_code."_banned")->rows;

    if ($query) {
      foreach ($query as $comment) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_banned WHERE banned_id = '".(int)$comment['banned_id']."'");
      }

      return true;
    } else {
      return false;
    }
  }

  public function copyBanned($data) {
    $query = $this->db->query("
      SELECT DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_banned b
      WHERE
        b.banned_id = '".(int)$data['banned_id']."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['status'] = '0';

      $this->addBanned($data);

      return true;
    } else {
      return false;
    }
  }

  public function prepareVote() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_vote");
  }

  public function importVote($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_vote
      SET
        vote_id = '".(int)$data['vote_id']."',
        comment_id = '".(int)$data['comment_id']."',
        ".$this->_code."_post_id = '".(int)$data[$this->_code.'_post_id']."',
        content_type = '".(int)$data['content_type']."',
        rating_type = '".(int)$data['rating_type']."',
        ip = '".$this->db->escape($data['ip'])."',
        date_added = '".$this->db->escape($data['date_added'])."'
    ");
  }

  public function addEmailTemplate($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_email_template
      SET
        `name` = '".$this->db->escape($data['name'])."',
        status = '".(int)$data['status']."',
        date_added = NOW()
    ");

    $template_id = $this->db->getLastId();

    foreach ($data['template_description'] as $language_id => $value) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_email_template_description 
        SET 
        template_id = '".(int)$template_id."', 
        language_id = '".(int)$language_id."', 
        subject = '".$this->db->escape($value['subject'])."', 
        template = '".$this->db->escape($value['template'])."'
      ");
    }

    return $template_id;
  }

  public function editEmailTemplate($data) {
    $this->db->query("
      UPDATE ".DB_PREFIX.$this->_code."_email_template
      SET
        `name` = '".$this->db->escape($data['name'])."',
        status = '".(int)$data['status']."',
        date_modified = NOW()
      WHERE
        template_id = '".(int)$data['template_id']."'
    ");

    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_email_template_description WHERE template_id = '".(int)$data['template_id']."'");

    foreach ($data['template_description'] as $language_id => $value) {
      $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_email_template_description 
        SET 
        template_id = '".(int)$data['template_id']."', 
        language_id = '".(int)$language_id."', 
        subject = '".$this->db->escape($value['subject'])."', 
        template = '".$this->db->escape($value['template'])."'
      ");
    }
  }

  public function copyEmailTemplate($data) {
    $query = $this->db->query("
      SELECT
        DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_email_template et
      WHERE
        et.template_id = '".(int)$data['template_id']."'
    ");

    if ($query->num_rows) {
      $data = $query->row;

      $data['status'] = '0';

      $data['template_description'] = $this->getEmailTemplateDescription($data['template_id']);

      $this->addEmailTemplate($data);

      return true;
    } else {
      return false;
    }
  }

  public function deleteEmailTemplate($data) {
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_email_template WHERE template_id = '".(int)$data['template_id']."'");
    $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_email_template_description WHERE template_id = '".(int)$data['template_id']."'");

    return true;
  }

  public function deleteEmailTemplates() {
    $query = $this->db->query("SELECT template_id FROM ".DB_PREFIX.$this->_code."_email_template")->rows;

    if ($query) {
      foreach ($query as $email_template) {
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_email_template WHERE template_id = '".(int)$email_template['template_id']."'");
        $this->db->query("DELETE FROM ".DB_PREFIX.$this->_code."_email_template_description WHERE template_id = '".(int)$email_template['template_id']."'");
      }

      return true;
    } else {
      return false;
    }
  }

  public function prepareEmailTemplate() {
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_email_template");
    $this->db->query("TRUNCATE ".DB_PREFIX.$this->_code."_email_template_description");
  }

  public function importEmailTemplate($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_email_template
      SET
        template_id = '".(int)$data['template_id']."',
        `name` = '".$this->db->escape($data['name'])."',
        status = '".(int)$data['status']."',
        date_added = '".$this->db->escape($data['date_added'])."',
        date_modified = '".$this->db->escape($data['date_modified'])."'
    ");

    $template_id = $this->db->getLastId();

    foreach ($data['template_description'] as $language_id => $value) {
      $this->db->query("
        INSERT INTO ".DB_PREFIX.$this->_code."_email_template_description 
        SET 
          template_id = '".(int)$template_id."', 
          language_id = '".(int)$language_id."', 
          subject = '".$this->db->escape($value['subject'])."', 
          template = '".$this->db->escape($value['template'])."'
      ");
    }
  }

  private function getModuleDescription($module_id) {
    $description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_description WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $description_data[$result['language_id']] = [
          'name'      => $result['name'],
          'read_more' => $result['read_more']
        ];
      }
    }

    return $description_data;
  }

  private function getModuleCustomerGroups($module_id) {
    $module_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_customer_group WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $module_customer_group_data;
  }

  private function getModuleStores($module_id) {
    $module_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_store WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_store_data[] = $result['store_id'];
      }
    }

    return $module_store_data;
  }

  private function getModuleLayouts($module_id) {
    $module_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_layout WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_layout_data[] = $result['layout_id'];
      }
    }

    return $module_layout_data;
  }

  private function getModuleRelatedPost($module_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$module_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  private function getModuleRelatedCategory($module_id) {
    $category_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$module_id."'");

    foreach ($query->rows as $result) {
      $category_related_data[] = $result['related_id'];
    }

    return $category_related_data;
  }

  private function getCategoryDescription($category_id) {
    $description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_description WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $description_data[$result['language_id']] = [
          'name'             => $result['name'],
          'meta_title'       => $result['meta_title'],
          'meta_description' => $result['meta_description'],
          'meta_keyword'     => $result['meta_keyword'],
          'description'      => $result['description'],
          'main_image_alt'   => $result['main_image_alt']
        ];
      }
    }

    return $description_data;
  }

  private function getCategoryStores($category_id) {
    $category_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_store WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_store_data[] = $result['store_id'];
      }
    }

    return $category_store_data;
  }

  private function getCategoryLayouts($category_id) {
    $category_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_layout WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_layout_data[$result['store_id']] = $result['layout_id'];
      }
    }

    return $category_layout_data;
  }

  private function getCategoryImages($category_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$category_id."' ORDER BY sort_order ASC")->rows;
  }

  private function getCategoryCustomerGroups($category_id) {
    $category_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_customer_group WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $category_customer_group_data;
  }

  private function getPostDescription($post_id) {
    $post_description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_description WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_description_data[$result['language_id']] = [
        'name'              => $result['name'],
        'description'       => $result['description'],
        'short_description' => $result['short_description'],
        'main_image_alt'    => $result['main_image_alt'],
        'meta_title'        => $result['meta_title'],
        'meta_description'  => $result['meta_description'],
        'meta_keyword'      => $result['meta_keyword'],
        'tag'               => $result['tag']
      ];
    }

    return $post_description_data;
  }

  private function getPostCategories($post_id) {
    $post_category_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_category_data[] = $result[$this->_code.'_category_id'];
    }

    return $post_category_data;
  }

  private function getPostImages($post_id) {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$post_id."' ORDER BY sort_order ASC");

    return $query->rows;
  }

  private function getPostCustomerGroups($post_id) {
    $post_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_customer_group WHERE ".$this->_code."_post_id = '".(int)$post_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $post_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $post_customer_group_data;
  }

  private function getPostStores($post_id) {
    $post_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_store WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_store_data[] = $result['store_id'];
    }

    return $post_store_data;
  }

  private function getPostLayouts($post_id) {
    $post_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_layout WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_layout_data[$result['store_id']] = $result['layout_id'];
    }

    return $post_layout_data;
  }

  private function getPostRelatedPost($post_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  private function getPostRelatedProduct($post_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  private function getAuthorDescription($author_id) {
    $author_description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_description WHERE ".$this->_code."_author_id = '".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_description_data[$result['language_id']] = [
        'name'             => $result['name'],
        'description'      => $result['description'],
        'main_image_alt'   => $result['main_image_alt'],
        'meta_title'       => $result['meta_title'],
        'meta_description' => $result['meta_description'],
        'meta_keyword'     => $result['meta_keyword']
      ];
    }

    return $author_description_data;
  }

  private function getAuthorImages($author_id) {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$author_id."' ORDER BY sort_order ASC");

    return $query->rows;
  }

  private function getAuthorCustomerGroups($author_id) {
    $author_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_customer_group WHERE ".$this->_code."_author_id = '".(int)$author_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $author_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $author_customer_group_data;
  }

  private function getAuthorStores($author_id) {
    $author_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_store WHERE ".$this->_code."_author_id = '".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_store_data[] = $result['store_id'];
    }

    return $author_store_data;
  }

  private function getAuthorLayouts($author_id) {
    $author_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_layout WHERE ".$this->_code."_author_id = '".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_layout_data[$result['store_id']] = $result['layout_id'];
    }

    return $author_layout_data;
  }

  private function getCommentDescription($comment_id) {
    $comment_description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_description WHERE comment_id = '".(int)$comment_id."'");

    foreach ($query->rows as $result) {
      $comment_description_data[$result['language_id']] = [
        'description' => $result['description']
      ];
    }

    return $comment_description_data;
  }

  private function getCommentCustomerGroups($comment_id) {
    $comment_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_to_customer_group WHERE comment_id = '".(int)$comment_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $comment_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $comment_customer_group_data;
  }

  private function getCommentStores($comment_id) {
    $comment_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_to_store WHERE comment_id = '".(int)$comment_id."'");

    foreach ($query->rows as $result) {
      $comment_store_data[] = $result['store_id'];
    }

    return $comment_store_data;
  }

  private function getEmailTemplateDescription($template_id) {
    $template_description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_email_template_description WHERE template_id = '".(int)$template_id."'")->rows;

    foreach ($query as $result) {
      $template_description_data[$result['language_id']] = [
        'subject'  => $result['subject'],
        'template' => $result['template']
      ];
    }

    return $template_description_data;
  }
}

?>