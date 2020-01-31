<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
libxml_use_internal_errors(true);

class ModelExtensionOcdevwizardSmartBlogProPlus extends Model {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';
  private $_version;

  public function __construct($registry) {
    parent::__construct($registry);

    if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name) && is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name)) {
      if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.version')) {
        $version_array = json_decode(file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.version'), true);

        if ($version_array) {
          $this->_version = $version_array['module'];
        }
      }
    }
  }

  public function createDBTables() {
    $sql = [];

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."ocdevwizard_setting` ("
             ."`setting_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`store_id` int(11) NOT NULL DEFAULT '0',"
             ."`code` text NOT NULL,"
             ."`key` text NOT NULL,"
             ."`value` text NOT NULL,"
             ."`serialized` tinyint(1) NOT NULL,"
             ."PRIMARY KEY (`setting_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module` ("
             ."`module_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`status` tinyint(1) NOT NULL,"
             ."`display_type` tinyint(1) NOT NULL,"
             ."`position` varchar(14) COLLATE utf8_general_ci NOT NULL,"
             ."`sort_order` int(3) NOT NULL,"
             ."`limit` int(11) NOT NULL,"
             ."`show_comment_icon` tinyint(1) NOT NULL,"
             ."`show_main_image` tinyint(1) NOT NULL,"
             ."`main_image_width` int(11) NOT NULL DEFAULT '260',"
             ."`main_image_height` int(11) NOT NULL DEFAULT '95',"
             ."`show_description` tinyint(1) NOT NULL,"
             ."`description_limit` int(11) NOT NULL,"
             ."`show_count_viewed` tinyint(1) NOT NULL,"
             ."`show_count_comments` tinyint(1) NOT NULL,"
             ."`show_author` tinyint(1) NOT NULL,"
             ."`show_read_more_button` tinyint(1) NOT NULL,"
             ."`show_date_added` tinyint(1) NOT NULL,"
             ."`display_type_inner` tinyint(1) NOT NULL,"
             ."`adaptive_setting_0` int(1) NOT NULL DEFAULT '1',"
             ."`adaptive_setting_1` int(1) NOT NULL DEFAULT '2',"
             ."`adaptive_setting_2` int(1) NOT NULL DEFAULT '3',"
             ."`adaptive_setting_3` int(1) NOT NULL DEFAULT '4',"
             ."`adaptive_setting_4` int(1) NOT NULL DEFAULT '5',"
             ."`related_type` tinyint(1) NOT NULL,"
             ."`sort_method` int(1) NOT NULL,"
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL,"
             ."PRIMARY KEY (`module_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_description` ("
             ."`module_id` int(11) NOT NULL,"
             ."`language_id` int(11) NOT NULL,"
             ."`name` varchar(255) NOT NULL,"
             ."`read_more` varchar(255) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_to_customer_group` ("
             ."`module_id` int(11) NOT NULL,"
             ."`customer_group_id` int(11) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_to_layout` ("
             ."`module_id` int(11) NOT NULL,"
             ."`layout_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`module_id`,`layout_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_to_store` ("
             ."`module_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_related_post` ("
             ."`module_id` int(11) NOT NULL,"
             ."`related_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`module_id`,`related_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_module_related_category` ("
             ."`module_id` int(11) NOT NULL,"
             ."`related_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`module_id`,`related_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`status` tinyint(1) NOT NULL,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`parent_id` int(11) NOT NULL DEFAULT '0',"
             ."`sort_order` int(3) NOT NULL DEFAULT '0',"
             ."`sort_method` int(1) NOT NULL DEFAULT '1',"
             ."`description_position` int(1) NOT NULL DEFAULT '1',"
             ."`show_description` int(1) NOT NULL DEFAULT '1',"
             ."`show_subcategories` int(1) NOT NULL DEFAULT '1',"
             ."`show_subcategories_total` int(1) NOT NULL DEFAULT '0',"
             ."`show_main_image` int(1) NOT NULL DEFAULT '0',"
             ."`show_additional_image` int(1) NOT NULL DEFAULT '0',"
             ."`main_image_width` int(3) NOT NULL DEFAULT '1140',"
             ."`main_image_height` int(3) NOT NULL DEFAULT '400',"
             ."`additional_image_popup_width` int(3) NOT NULL DEFAULT '1000',"
             ."`additional_image_popup_height` int(3) NOT NULL DEFAULT '1000',"
             ."`additional_image_width` int(3) NOT NULL DEFAULT '270',"
             ."`additional_image_height` int(3) NOT NULL DEFAULT '95',"
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_category_id`),"
             ."KEY `parent_id` (`parent_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_description` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."`language_id` int(11) NOT NULL,"
             ."`name` varchar(255) NOT NULL,"
             ."`description` text NOT NULL,"
             ."`main_image_alt` text NOT NULL,"
             ."`meta_title` varchar(255) NOT NULL,"
             ."`meta_description` varchar(255) NOT NULL,"
             ."`meta_keyword` varchar(255) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_category_id`,`language_id`),"
             ."KEY `name` (`name`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_path` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."`path_id` int(11) NOT NULL,"
             ."`level` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_category_id`,`path_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_to_layout` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL,"
             ."`layout_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_category_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_image` ("
             ."`image_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`sort_order` int(3) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`image_id`),"
             ."KEY `".$this->_code."_category_id` (`".$this->_code."_category_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_to_store` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_category_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_category_to_customer_group` ("
             ."`".$this->_code."_category_id` int(11) NOT NULL, "
             ."`customer_group_id` int(11) NOT NULL "
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`".$this->_code."_main_category_id` int(11) NOT NULL,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`video_show_type` tinyint(1) NOT NULL DEFAULT '1',"
             ."`video` text NOT NULL,"
             ."`status` tinyint(1) NOT NULL DEFAULT '0',"
             ."`sort_order` int(11) NOT NULL DEFAULT '0',"
             ."`viewed` int(5) NOT NULL DEFAULT '0',"
             ."`show_description` int(1) NOT NULL DEFAULT '1',"
             ."`show_main_image` int(1) NOT NULL DEFAULT '0',"
             ."`show_additional_image` int(1) NOT NULL DEFAULT '0',"
             ."`main_image_width` int(3) NOT NULL DEFAULT '1140',"
             ."`main_image_height` int(3) NOT NULL DEFAULT '400',"
             ."`main_image_popup_width` int(3) NOT NULL DEFAULT '1000',"
             ."`main_image_popup_height` int(3) NOT NULL DEFAULT '1000',"
             ."`additional_image_width` int(3) NOT NULL DEFAULT '270',"
             ."`additional_image_height` int(3) NOT NULL DEFAULT '95',"
             ."`date_available` date NOT NULL DEFAULT '0000-00-00',"
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_description` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`language_id` int(11) NOT NULL,"
             ."`name` varchar(255) NOT NULL,"
             ."`description` text NOT NULL,"
             ."`short_description` text NOT NULL,"
             ."`main_image_alt` text NOT NULL,"
             ."`tag` text NOT NULL,"
             ."`meta_title` varchar(255) NOT NULL,"
             ."`meta_description` varchar(255) NOT NULL,"
             ."`meta_keyword` varchar(255) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`language_id`),"
             ."KEY `name` (`name`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_image` ("
             ."`image_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`sort_order` int(3) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`image_id`),"
             ."KEY `".$this->_code."_post_id` (`".$this->_code."_post_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_related_post` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`related_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`related_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_related_product` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`related_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`related_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_to_category` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`".$this->_code."_category_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`".$this->_code."_category_id`),"
             ."KEY `".$this->_code."_category_id` (`".$this->_code."_category_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_to_customer_group` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL, "
             ."`customer_group_id` int(11) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci; ";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_to_layout` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL,"
             ."`layout_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_post_to_store` ("
             ."`".$this->_code."_post_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`".$this->_code."_post_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author` ("
             ."`".$this->_code."_author_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`status` tinyint(1) NOT NULL DEFAULT '0',"
             ."`sort_order` int(11) NOT NULL DEFAULT '0',"
             ."`sort_method` int(1) NOT NULL DEFAULT '1',"
             ."`description_position` int(1) NOT NULL DEFAULT '1',"
             ."`show_description` int(1) NOT NULL DEFAULT '1',"
             ."`show_main_image` int(1) NOT NULL DEFAULT '0',"
             ."`show_additional_image` int(1) NOT NULL DEFAULT '0',"
             ."`main_image_width` int(3) NOT NULL DEFAULT '1140',"
             ."`main_image_height` int(3) NOT NULL DEFAULT '400',"
             ."`additional_image_popup_width` int(3) NOT NULL DEFAULT '1000',"
             ."`additional_image_popup_height` int(3) NOT NULL DEFAULT '1000',"
             ."`additional_image_width` int(3) NOT NULL DEFAULT '270',"
             ."`additional_image_height` int(3) NOT NULL DEFAULT '95',"
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_author_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author_description` ("
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`language_id` int(11) NOT NULL,"
             ."`name` varchar(255) NOT NULL,"
             ."`description` text NOT NULL,"
             ."`main_image_alt` text NOT NULL,"
             ."`meta_title` varchar(255) NOT NULL,"
             ."`meta_description` varchar(255) NOT NULL,"
             ."`meta_keyword` varchar(255) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_author_id`,`language_id`),"
             ."KEY `name` (`name`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author_image` ("
             ."`image_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`image` varchar(255) DEFAULT NULL,"
             ."`sort_order` int(3) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`image_id`),"
             ."KEY `".$this->_code."_author_id` (`".$this->_code."_author_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author_to_customer_group` ("
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`customer_group_id` int(11) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci; ";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author_to_layout` ("
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL,"
             ."`layout_id` int(11) NOT NULL,"
             ."PRIMARY KEY (`".$this->_code."_author_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_author_to_store` ("
             ."`".$this->_code."_author_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`".$this->_code."_author_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_comment` ("
             ."`comment_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`respond_id` int(11) NOT NULL, "
             ."`".$this->_code."_post_id` int(11) NOT NULL, "
             ."`status` tinyint(1) NOT NULL DEFAULT '0',"
             ."`comment_type` tinyint(1) NOT NULL DEFAULT '0',"
             ."`notification_on_respond` tinyint(1) NOT NULL DEFAULT '0',"
             ."`firstname` text COLLATE utf8_general_ci NOT NULL,"
             ."`email` text COLLATE utf8_general_ci NOT NULL,"
             ."`token` text COLLATE utf8_general_ci NOT NULL, "
             ."`user_agent` varchar(255) COLLATE utf8_general_ci NOT NULL, "
             ."`accept_language` varchar(255) COLLATE utf8_general_ci NOT NULL, "
             ."`user_language_id` int(11) NOT NULL,"
             ."`store_name` text COLLATE utf8_general_ci NOT NULL, "
             ."`store_url` text COLLATE utf8_general_ci NOT NULL, "
             ."`store_id` int(11) NOT NULL DEFAULT '0', "
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL, "."PRIMARY KEY (`comment_id`)"
             .") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_comment_description` ("
             ."`comment_id` int(11) NOT NULL,"
             ."`language_id` int(11) NOT NULL,"
             ."`description` text NOT NULL,"
             ."PRIMARY KEY (`comment_id`,`language_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_comment_to_customer_group` ("
             ."`comment_id` int(11) NOT NULL,"
             ."`customer_group_id` int(11) NOT NULL"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci; ";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_comment_to_store` ("
             ."`comment_id` int(11) NOT NULL,"
             ."`store_id` int(11) NOT NULL DEFAULT '0',"
             ."PRIMARY KEY (`comment_id`,`store_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_banned` ("
             ."`banned_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`status` tinyint(1) NOT NULL DEFAULT '0',"
             ."`ip` text COLLATE utf8_general_ci NOT NULL,"
             ."`email` text COLLATE utf8_general_ci NOT NULL,"
             ."`date_added` datetime NOT NULL,"
             ."`date_modified` datetime NOT NULL, "."PRIMARY KEY (`banned_id`)"
             .") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX.$this->_code."_vote` ("
             ."`vote_id` int(11) NOT NULL AUTO_INCREMENT, "
             ."`comment_id` int(11) NOT NULL, "
             ."`".$this->_code."_post_id` int(11) NOT NULL, "
             ."`content_type` int(1) NOT NULL, "
             ."`rating_type` int(1) NOT NULL, "
             ."`ip` varchar(40) COLLATE utf8_general_ci NOT NULL, "
             ."`date_added` datetime NOT NULL, "."PRIMARY KEY (`vote_id`)"
             .") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;";

    $sql[] = "CREATE TABLE IF NOT EXISTS ".DB_PREFIX.$this->_code."_email_template ( "
             ."`template_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`name` varchar(255) NOT NULL,"
             ."`status` tinyint(1) NOT NULL DEFAULT '0',"
             ."`date_added` datetime NOT NULL, "
             ."`date_modified` datetime NOT NULL, "
             ."PRIMARY KEY (`template_id`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    $sql[] = "CREATE TABLE IF NOT EXISTS ".DB_PREFIX.$this->_code."_email_template_description ( "
             ."`template_id` int(11) NOT NULL AUTO_INCREMENT,"
             ."`language_id` int(11) NOT NULL,"
             ."`subject` varchar(255) NOT NULL,"
             ."`template` text NOT NULL, "
             ."PRIMARY KEY (`template_id`,`language_id`), "
             ."KEY `subject` (`subject`)"
             .") ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

    foreach ($sql as $query) {
      $this->db->query($query);
    }
  }

  public function deleteDBTables() {
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_module;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_module_description;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_module_to_customer_group;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_module_to_layout;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_module_to_store;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_description;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_path;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_image;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_to_layout;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_to_store;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_category_to_customer_group;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_description;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_image;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_related_post;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_related_product;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_to_category;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_to_customer_group;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_to_layout;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_post_to_store;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author_description;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author_to_store;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author_to_layout;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author_image;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_author_to_customer_group;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_comment;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_comment_description;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_comment_to_customer_group;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_comment_to_store;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_banned;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_vote;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_email_template;");
    $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX.$this->_code."_email_template_description;");
  }

  public function getOCdevCatalog() {
    $catalog = [];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://ocdevwizard.com/products/share/share.xml');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    $response_data = curl_exec($curl);
    $httpcode_data = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    $results = simplexml_load_string($response_data);

    if ($httpcode_data == 200 && !empty($response_data) && $results !== false) {
      foreach ($results->product as $product) {
        $language = substr($this->request->server['HTTP_ACCEPT_LANGUAGE'], 0, 2);

        $catalog[] = [
          'extension_id'     => (int)$product->extension_id,
          'title'            => (string)$product->title,
          'img'              => (string)$product->img,
          'price'            => (string)$product->price,
          'url'              => (string)str_replace("&amp;", "&", $product->url),
          'date_added'       => (string)$product->date_added,
          'opencart_version' => (string)$product->opencart_version,
          'latest_version'   => (string)$product->latest_version,
          'version_compare'  => version_compare($this->_version, (string)$product->latest_version),
          'features'         => (in_array($language, [
              'ru',
              'uk'
            ]) && $product->{'features_'.$language}) ? (string)$product->{'features_'.$language} : (string)$product->features,
          'short_name'       => (string)$product->short_name
        ];
      }

      $sort_order = [];

      foreach ($catalog as $key => $value) {
        $sort_order[$key] = strtotime($value['date_added']);
      }

      array_multisort($sort_order, SORT_DESC, $catalog);
    }

    return $catalog;
  }

  public function getOCdevSupportInfo() {
    $catalog = [];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://ocdevwizard.com/support/support.xml');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    $response_data = curl_exec($curl);
    $httpcode_data = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    $results = simplexml_load_string($response_data);

    if ($httpcode_data == 200 && !empty($response_data) && $results !== false) {
      $language = substr($this->request->server['HTTP_ACCEPT_LANGUAGE'], 0, 2);

      $catalog = [
        'general'       => (in_array($language, [
            'ru',
            'uk'
          ]) && $results->{'general_'.$language}) ? (string)$results->{'general_'.$language} : (string)$results->general,
        'terms'         => (in_array($language, [
            'ru',
            'uk'
          ]) && $results->{'terms_'.$language}) ? (string)$results->{'terms_'.$language} : (string)$results->terms,
        'faq'           => (in_array($language, [
            'ru',
            'uk'
          ]) && $results->{'faq_'.$language}) ? (string)$results->{'faq_'.$language} : (string)$results->faq,
        'license'       => (string)$results->license,
        'license_error' => (string)$results->license_error
      ];
    }

    return $catalog;
  }

  public function getModule($module_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module WHERE module_id = '".(int)$module_id."'")->row;
  }

  public function getModules($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_module m LEFT JOIN ".DB_PREFIX.$this->_code."_module_description md ON (m.module_id = md.module_id) WHERE md.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND md.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(m.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(m.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND m.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY m.module_id";

    $sort_data = [
      'md.name',
      'm.status',
      'm.sort_order'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY md.name";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getModuleDescription($module_id) {
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

  public function getModuleCustomerGroups($module_id) {
    $module_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_customer_group WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $module_customer_group_data;
  }

  public function getModuleStores($module_id) {
    $module_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_store WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_store_data[] = $result['store_id'];
      }
    }

    return $module_store_data;
  }

  public function getModuleLayouts($module_id) {
    $module_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_to_layout WHERE module_id = '".(int)$module_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $module_layout_data[] = $result['layout_id'];
      }
    }

    return $module_layout_data;
  }

  public function getModuleRelatedPost($module_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_related_post WHERE module_id = '".(int)$module_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  public function getModuleRelatedCategory($module_id) {
    $category_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_module_related_category WHERE module_id = '".(int)$module_id."'");

    foreach ($query->rows as $result) {
      $category_related_data[] = $result['related_id'];
    }

    return $category_related_data;
  }

  public function getExportModules() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_module")->rows;

    $module_data = [];

    if ($query) {
      foreach ($query as $module) {
        $data = [];

        $data = $module;

        $data = array_merge($data, ['stores' => $this->getModuleStores($module['module_id'])]);
        $data = array_merge($data, ['customer_groups' => $this->getModuleCustomerGroups($module['module_id'])]);
        $data = array_merge($data, ['module_layout' => $this->getModuleLayouts($module['module_id'])]);
        $data = array_merge($data, ['module_description' => $this->getModuleDescription($module['module_id'])]);
        $data = array_merge($data, ['post_related' => $this->getModuleRelatedPost($module['module_id'])]);
        $data = array_merge($data, ['category_related' => $this->getModuleRelatedCategory($module['module_id'])]);

        $module_data[] = $data;
      }
    }

    return $module_data;
  }

  public function getTotalModules($data = []) {
    $sql = "SELECT COUNT(*) AS total FROM ".DB_PREFIX.$this->_code."_module m LEFT JOIN ".DB_PREFIX.$this->_code."_module_description md ON (m.module_id = md.module_id) WHERE md.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_module']) && !empty($data['filter_module'])) {
      $sql .= " AND md.heading LIKE '".$this->db->escape($data['filter_module'])."%'";
    }

    return $this->db->query($sql)->row['total'];
  }

  public function getCategory($category_id) {
    $sql = "SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM ".DB_PREFIX.$this->_code."_category_path cp LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd1 ON (cp.path_id = cd1.".$this->_code."_category_id AND cp.".$this->_code."_category_id != cp.path_id) WHERE cp.".$this->_code."_category_id = `c`.".$this->_code."_category_id AND cd1.language_id = '".(int)$this->config->get('config_language_id')."' GROUP BY cp.".$this->_code."_category_id) AS path, cd2.name AS real_name";

    if (version_compare(VERSION, '3.0.0.0', '<')) {
      $sql .= ", (SELECT keyword FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_category_id=".(int)$category_id."') AS keyword";
    }

    $sql .= " FROM ".DB_PREFIX.$this->_code."_category c LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd2 ON (c.".$this->_code."_category_id = cd2.".$this->_code."_category_id) WHERE c.".$this->_code."_category_id = '".(int)$category_id."' AND cd2.language_id = '".(int)$this->config->get('config_language_id')."'";

    return $this->db->query($sql)->row;
  }

  public function getCategories($data = []) {
    $sql = "
      SELECT
        cp.".$this->_code."_category_id AS ".$this->_code."_category_id,
        GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name,
        cd2.name AS real_name,
        c1.parent_id,
        c1.sort_order,
        c1.date_added,
        c1.date_modified,
        c1.status
      FROM ".DB_PREFIX.$this->_code."_category_path cp
      LEFT JOIN ".DB_PREFIX.$this->_code."_category c1 ON (cp.".$this->_code."_category_id = c1.".$this->_code."_category_id)
      LEFT JOIN ".DB_PREFIX.$this->_code."_category c2 ON (cp.path_id = c2.".$this->_code."_category_id)
      LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd1 ON (cp.path_id = cd1.".$this->_code."_category_id)
      LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd2 ON (cp.".$this->_code."_category_id = cd2.".$this->_code."_category_id)
      WHERE
        cd1.language_id = '".(int)$this->config->get('config_language_id')."'
       AND
        cd2.language_id = '".(int)$this->config->get('config_language_id')."'
    ";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND cd2.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(c1.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(c1.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND c1.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY cp.".$this->_code."_category_id";

    $sort_data = [
      'name',
      'c1.date_added',
      'c1.date_modified'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY c1.date_added";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $category_data = [];

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
      $category_data[$result[$this->_code.'_category_id']] = $result;
    }

    return $category_data;
  }

  public function getCategoryDescription($category_id) {
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

  public function getCategorySeoUrls($category_id) {
    $category_seo_url_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_category_id=".(int)$category_id."'");

    foreach ($query->rows as $result) {
      $category_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
    }

    return $category_seo_url_data;
  }

  public function getCategoryStores($category_id) {
    $category_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_store WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_store_data[] = $result['store_id'];
      }
    }

    return $category_store_data;
  }

  public function getCategoryLayouts($category_id) {
    $category_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_layout WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_layout_data[$result['store_id']] = $result['layout_id'];
      }
    }

    return $category_layout_data;
  }

  public function getCategoryImages($category_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$category_id."' ORDER BY sort_order ASC")->rows;
  }

  public function getCategoryCustomerGroups($category_id) {
    $category_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_to_customer_group WHERE ".$this->_code."_category_id = '".(int)$category_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $category_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $category_customer_group_data;
  }

  public function getExportCategories() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_category")->rows;

    $category_data = [];

    if ($query) {
      foreach ($query as $category) {
        $data = [];

        $data = $category;

        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $data = array_merge($data, ['keyword' => $this->getCategorySeoUrls($category[$this->_code.'_category_id'])]);
        } else {
          $seo_info        = $this->getSEOUrl($this->_code."_category_id=".(int)$category[$this->_code.'_category_id'], 'query');
          $data['keyword'] = ($seo_info) ? $seo_info['keyword'] : '';
        }
        $data = array_merge($data, ['category_image' => $this->getCategoryImages($category[$this->_code.'_category_id'])]);
        $data = array_merge($data, ['category_store' => $this->getCategoryStores($category[$this->_code.'_category_id'])]);
        $data = array_merge($data, ['category_customer_group' => $this->getCategoryCustomerGroups($category[$this->_code.'_category_id'])]);
        $data = array_merge($data, ['category_layout' => $this->getCategoryLayouts($category[$this->_code.'_category_id'])]);
        $data = array_merge($data, ['category_description' => $this->getCategoryDescription($category[$this->_code.'_category_id'])]);

        $category_data[] = $data;
      }
    }

    return $category_data;
  }

  public function getTotalCategories($data = []) {
    $sql = "
      SELECT
        COUNT(*) AS total
      FROM ".DB_PREFIX.$this->_code."_category c
      LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (c.".$this->_code."_category_id = cd.".$this->_code."_category_id)
      WHERE
        cd.language_id = '".(int)$this->config->get('config_language_id')."'
    ";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND cd.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(c.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(c.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND c.status = '".(int)$data['filter_status']."'";
    }

    return $this->db->query($sql)->row['total'];
  }

  public function getPost($post_id) {
    $sql = "SELECT DISTINCT *";

    if (version_compare(VERSION, '3.0.0.0', '<')) {
      $sql .= ", (SELECT keyword FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_post_id=".(int)$post_id."') AS keyword";
    }

    $sql .= " FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) WHERE p.".$this->_code."_post_id = '".(int)$post_id."' AND pd.language_id = '".(int)$this->config->get('config_language_id')."'";

    return $this->db->query($sql)->row;
  }

  public function getPosts($data = []) {
    $sql = "SELECT DISTINCT p.*, pd.*, cd.name AS cname FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_category pc ON (pd.".$this->_code."_post_id = pc.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (pc.".$this->_code."_category_id = cd.".$this->_code."_category_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND pd.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_category']) && !empty($data['filter_category'])) {
      $sql .= " AND cd.name LIKE '".$this->db->escape($data['filter_category'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(p.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(p.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_date_available']) && !empty($data['filter_date_available'])) {
      $sql .= " AND DATE(p.date_available) = DATE('".$this->db->escape($data['filter_date_available'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND p.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY p.".$this->_code."_post_id";

    $sort_data = [
      'pd.name',
      'p.status',
      'p.sort_order'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY pd.name";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getPostsByCategoryId($category_id) {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_category p2c ON (p.".$this->_code."_post_id = p2c.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p2c.".$this->_code."_category_id = '".(int)$category_id."' ORDER BY pd.name ASC");

    return $query->rows;
  }

  public function getPostDescription($post_id) {
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

  public function getPostSeoUrls($post_id) {
    $post_seo_url_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_post_id=".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
    }

    return $post_seo_url_data;
  }

  public function getPostCategories($post_id) {
    $post_category_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_category WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_category_data[] = $result[$this->_code.'_category_id'];
    }

    return $post_category_data;
  }

  public function getPostCategoriesForFilter($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_post_to_category pc LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (pc.".$this->_code."_category_id = cd.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post p ON (p.".$this->_code."_main_category_id = cd.".$this->_code."_category_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND cd.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    $sql .= " GROUP BY pc.".$this->_code."_category_id";

    $sort_data = [
      'cd.name'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY cd.name";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getPostImages($post_id) {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$post_id."' ORDER BY sort_order ASC");

    return $query->rows;
  }

  public function getPostCustomerGroups($post_id) {
    $post_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_customer_group WHERE ".$this->_code."_post_id = '".(int)$post_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $post_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $post_customer_group_data;
  }

  public function getPostStores($post_id) {
    $post_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_store WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_store_data[] = $result['store_id'];
    }

    return $post_store_data;
  }

  public function getPostLayouts($post_id) {
    $post_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_to_layout WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_layout_data[$result['store_id']] = $result['layout_id'];
    }

    return $post_layout_data;
  }

  public function getPostRelatedPost($post_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_related_post WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  public function getPostRelatedProduct($post_id) {
    $post_related_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_related_product WHERE ".$this->_code."_post_id = '".(int)$post_id."'");

    foreach ($query->rows as $result) {
      $post_related_data[] = $result['related_id'];
    }

    return $post_related_data;
  }

  public function getTotalPosts($data = []) {
    $sql = "SELECT COUNT(DISTINCT p.".$this->_code."_post_id) AS total FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id)";

    if (isset($data['filter_category']) && !empty($data['filter_category'])) {
      $sql .= " LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_category pc ON (pd.".$this->_code."_post_id = pc.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (pc.".$this->_code."_category_id = cd.".$this->_code."_category_id)";
    }

    $sql .= " WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND pd.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_category']) && !empty($data['filter_category'])) {
      $sql .= " AND cd.name LIKE '".$this->db->escape($data['filter_category'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(p.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(p.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_date_available']) && !empty($data['filter_date_available'])) {
      $sql .= " AND DATE(p.date_available) = DATE('".$this->db->escape($data['filter_date_available'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND p.status = '".(int)$data['filter_status']."'";
    }

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

  public function getExportPosts() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_post")->rows;

    $post_data = [];

    if ($query) {
      foreach ($query as $post) {
        $data = [];

        $data = $post;

        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $data = array_merge($data, ['keyword' => $this->getPostSeoUrls($post[$this->_code.'_post_id'])]);
        } else {
          $seo_info        = $this->getSEOUrl($this->_code."_post_id=".(int)$post[$this->_code.'_post_id'], 'query');
          $data['keyword'] = ($seo_info) ? $seo_info['keyword'] : '';
        }
        $data = array_merge($data, ['post_image' => $this->getPostImages($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_store' => $this->getPostStores($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_customer_group' => $this->getPostCustomerGroups($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_category' => $this->getPostCategories($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_layout' => $this->getPostLayouts($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_description' => $this->getPostDescription($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['post_related' => $this->getPostRelatedPost($post[$this->_code.'_post_id'])]);
        $data = array_merge($data, ['product_related' => $this->getPostRelatedProduct($post[$this->_code.'_post_id'])]);

        $post_data[] = $data;
      }
    }

    return $post_data;
  }

  public function getAuthor($author_id) {
    $sql = "SELECT DISTINCT *";

    if (version_compare(VERSION, '3.0.0.0', '<')) {
      $sql .= ", (SELECT keyword FROM ".DB_PREFIX."url_alias WHERE query = '".$this->_code."_author_id=".(int)$author_id."') AS keyword";
    }

    $sql .= " FROM ".DB_PREFIX.$this->_code."_author a LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) WHERE a.".$this->_code."_author_id = '".(int)$author_id."' AND ad.language_id = '".(int)$this->config->get('config_language_id')."'";

    return $this->db->query($sql)->row;
  }

  public function getAuthors($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_author a LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) WHERE ad.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND ad.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(a.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(a.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND a.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY a.".$this->_code."_author_id";

    $sort_data = [
      'ad.name',
      'a.status',
      'a.sort_order'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY ad.name";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getAuthorDescription($author_id) {
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

  public function getAuthorSeoUrls($author_id) {
    $author_seo_url_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX."seo_url WHERE query = '".$this->_code."_author_id=".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
    }

    return $author_seo_url_data;
  }

  public function getAuthorImages($author_id) {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$author_id."' ORDER BY sort_order ASC");

    return $query->rows;
  }

  public function getAuthorCustomerGroups($author_id) {
    $author_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_customer_group WHERE ".$this->_code."_author_id = '".(int)$author_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $author_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $author_customer_group_data;
  }

  public function getAuthorStores($author_id) {
    $author_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_store WHERE ".$this->_code."_author_id = '".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_store_data[] = $result['store_id'];
    }

    return $author_store_data;
  }

  public function getAuthorLayouts($author_id) {
    $author_layout_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_to_layout WHERE ".$this->_code."_author_id = '".(int)$author_id."'");

    foreach ($query->rows as $result) {
      $author_layout_data[$result['store_id']] = $result['layout_id'];
    }

    return $author_layout_data;
  }

  public function getTotalAuthors($data = []) {
    $sql = "SELECT COUNT(DISTINCT a.".$this->_code."_author_id) AS total FROM ".DB_PREFIX.$this->_code."_author a LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) WHERE ad.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND ad.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(a.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(a.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND a.status = '".(int)$data['filter_status']."'";
    }

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

  public function getExportAuthors() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_author")->rows;

    $author_data = [];

    if ($query) {
      foreach ($query as $author) {
        $data = [];

        $data = $author;

        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $data = array_merge($data, ['keyword' => $this->getAuthorSeoUrls($author[$this->_code.'_author_id'])]);
        } else {
          $seo_info        = $this->getSEOUrl($this->_code."_author_id=".(int)$author[$this->_code.'_author_id'], 'query');
          $data['keyword'] = ($seo_info) ? $seo_info['keyword'] : '';
        }
        $data = array_merge($data, ['author_image' => $this->getAuthorImages($author[$this->_code.'_author_id'])]);
        $data = array_merge($data, ['author_store' => $this->getAuthorStores($author[$this->_code.'_author_id'])]);
        $data = array_merge($data, ['author_customer_group' => $this->getAuthorCustomerGroups($author[$this->_code.'_author_id'])]);
        $data = array_merge($data, ['author_layout' => $this->getAuthorLayouts($author[$this->_code.'_author_id'])]);
        $data = array_merge($data, ['author_description' => $this->getAuthorDescription($author[$this->_code.'_author_id'])]);

        $author_data[] = $data;
      }
    }

    return $author_data;
  }

  public function getComment($comment_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE `c`.comment_id = '".(int)$comment_id."' AND cd.language_id = '".(int)$this->config->get('config_language_id')."'")->row;
  }

  public function getComments($data = []) {
    $sql = "SELECT DISTINCT `c`.*, pd.name as post FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (`c`.".$this->_code."_post_id = pd.".$this->_code."_post_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_post']) && !empty($data['filter_post'])) {
      $sql .= " AND pd.name = '".$this->db->escape($data['filter_post'])."'";
    }

    if (isset($data['filter_firstname']) && !empty($data['filter_firstname'])) {
      $sql .= " AND `c`.firstname = '".$this->db->escape($data['filter_firstname'])."'";
    }

    if (isset($data['filter_email']) && !empty($data['filter_email'])) {
      $sql .= " AND `c`.email = '".$this->db->escape($data['filter_email'])."'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(`c`.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(`c`.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND `c`.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY `c`.comment_id";

    $sort_data = [
      '`c`.status',
      '`c`.date_added'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY `c`.date_added";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getCommentDescription($comment_id) {
    $comment_description_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_description WHERE comment_id = '".(int)$comment_id."'");

    foreach ($query->rows as $result) {
      $comment_description_data[$result['language_id']] = [
        'description' => $result['description']
      ];
    }

    return $comment_description_data;
  }

  public function getCommentCustomerGroups($comment_id) {
    $comment_customer_group_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_to_customer_group WHERE comment_id = '".(int)$comment_id."'")->rows;

    if ($query) {
      foreach ($query as $result) {
        $comment_customer_group_data[] = $result['customer_group_id'];
      }
    }

    return $comment_customer_group_data;
  }

  public function getCommentStores($comment_id) {
    $comment_store_data = [];

    $query = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_comment_to_store WHERE comment_id = '".(int)$comment_id."'");

    foreach ($query->rows as $result) {
      $comment_store_data[] = $result['store_id'];
    }

    return $comment_store_data;
  }

  public function getTotalComments($data = []) {
    $sql = "SELECT COUNT(DISTINCT `c`.comment_id) AS total FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (`c`.".$this->_code."_post_id = pd.".$this->_code."_post_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_post']) && !empty($data['filter_post'])) {
      $sql .= " AND pd.name LIKE '".$this->db->escape($data['filter_post'])."%'";
    }

    if (isset($data['filter_firstname']) && !empty($data['filter_firstname'])) {
      $sql .= " AND `c`.firstname LIKE '".$this->db->escape($data['filter_firstname'])."%'";
    }

    if (isset($data['filter_email']) && !empty($data['filter_email'])) {
      $sql .= " AND `c`.email LIKE '".$this->db->escape($data['filter_email'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(`c`.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(`c`.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND `c`.status = '".(int)$data['filter_status']."'";
    }

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

  public function getExportComments() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_comment")->rows;

    $comment_data = [];

    if ($query) {
      foreach ($query as $comment) {
        $data = [];

        $data = $comment;

        $data = array_merge($data, ['comment_description' => $this->getCommentDescription($comment['comment_id'])]);
        $data = array_merge($data, ['comment_store' => $this->getCommentStores($comment['comment_id'])]);
        $data = array_merge($data, ['comment_customer_group' => $this->getCommentCustomerGroups($comment['comment_id'])]);

        $comment_data[] = $data;
      }
    }

    return $comment_data;
  }

  public function getBanned($banned_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_banned b WHERE b.banned_id = '".(int)$banned_id."'")->row;
  }

  public function getBanneds($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_banned b WHERE b.banned_id > '0'";

    if (isset($data['filter_ip']) && !empty($data['filter_ip'])) {
      $sql .= " AND b.ip = '".$this->db->escape($data['filter_ip'])."'";
    }

    if (isset($data['filter_email']) && !empty($data['filter_email'])) {
      $sql .= " AND b.email = '".$this->db->escape($data['filter_email'])."'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(b.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(b.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND b.status = '".(int)$data['filter_status']."'";
    }

    $sql .= " GROUP BY b.banned_id";

    $sort_data = [
      'b.status',
      'b.date_added'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY b.date_added";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getTotalBanneds($data = []) {
    $sql = "SELECT COUNT(DISTINCT b.banned_id) AS total FROM ".DB_PREFIX.$this->_code."_banned b WHERE b.banned_id > '0'";

    if (isset($data['filter_ip']) && !empty($data['filter_ip'])) {
      $sql .= " AND b.ip LIKE '".$this->db->escape($data['filter_ip'])."%'";
    }

    if (isset($data['filter_email']) && !empty($data['filter_email'])) {
      $sql .= " AND b.email LIKE '".$this->db->escape($data['filter_email'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(b.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(b.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND b.status = '".(int)$data['filter_status']."'";
    }

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

  public function getExportBanneds() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_banned")->rows;

    $banned_data = [];

    if ($query) {
      foreach ($query as $banned) {
        $data = [];

        $data = $banned;

        $banned_data[] = $data;
      }
    }

    return $banned_data;
  }

  public function getExportVotes() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_vote")->rows;

    $vote_data = [];

    if ($query) {
      foreach ($query as $vote) {
        $data = [];

        $data = $vote;

        $vote_data[] = $data;
      }
    }

    return $vote_data;
  }

  public function getEmailTemplate($template_id, $language_id = 0) {
    return $this->db->query("
      SELECT 
        DISTINCT * 
      FROM ".DB_PREFIX.$this->_code."_email_template et 
      LEFT JOIN ".DB_PREFIX.$this->_code."_email_template_description etd ON (et.template_id = etd.template_id) 
      WHERE 
        et.template_id = '".(int)$template_id."' 
      AND 
        etd.language_id = '".(int)(($language_id) ? $language_id : $this->config->get('config_language_id'))."'
    ")->row;
  }

  public function getEmailTemplates($data = []) {
    $sql = "
      SELECT 
        DISTINCT * 
      FROM ".DB_PREFIX.$this->_code."_email_template et 
      LEFT JOIN ".DB_PREFIX.$this->_code."_email_template_description etd ON (et.template_id = etd.template_id) 
      WHERE 
        etd.language_id = '".(int)$this->config->get('config_language_id')."'
    ";

    if (isset($data['filter_heading']) && !empty($data['filter_heading'])) {
      $sql .= " AND et.name LIKE '".$this->db->escape($data['filter_heading'])."%'";
    }

    if (isset($data['filter_date_added']) && !empty($data['filter_date_added'])) {
      $sql .= " AND DATE(et.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (isset($data['filter_date_modified']) && !empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(et.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND et.status = '".(int)$data['filter_status']."'";
    }

    if (isset($data['filter_group_email_template']) && !empty($data['filter_group_email_template'])) {
      $sql .= " GROUP BY et.name";
    }

    $sort_data = [
      'et.name',
      'et.status'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY etd.subject";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    return $this->db->query($sql)->rows;
  }

  public function getEmailTemplateDescription($template_id) {
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

  public function getExportEmailTemplates() {
    $query = $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_email_template")->rows;

    $email_template_data = [];

    if ($query) {
      foreach ($query as $email_template) {
        $data = [];

        $data = $email_template;

        $data = array_merge($data, ['template_description' => $this->getEmailTemplateDescription($email_template['template_id'])]);

        $email_template_data[] = $data;
      }
    }

    return $email_template_data;
  }

  public function getTotalEmailTemplates($data = []) {
    $sql = "SELECT COUNT(DISTINCT et.template_id) AS total FROM ".DB_PREFIX.$this->_code."_email_template et LEFT JOIN ".DB_PREFIX.$this->_code."_email_template_description etd ON (et.template_id = etd.template_id)";

    $sql .= " WHERE et.template_id > '0'";

    if (!empty($data['filter_heading'])) {
      $sql .= " AND et.name LIKE '".$this->db->escape($data['filter_heading'])."%'";
    }

    if (!empty($data['filter_date_added'])) {
      $sql .= " AND DATE(et.date_added) = DATE('".$this->db->escape($data['filter_date_added'])."')";
    }

    if (!empty($data['filter_date_modified'])) {
      $sql .= " AND DATE(et.date_modified) = DATE('".$this->db->escape($data['filter_date_modified'])."')";
    }

    if (isset($data['filter_status']) && $data['filter_status'] != '*') {
      $sql .= " AND et.status = '".(int)$data['filter_status']."'";
    }

    if (isset($data['filter_group_email_template']) && !empty($data['filter_group_email_template'])) {
      $sql .= " GROUP BY et.name";
    }

    return $this->db->query($sql)->row['total'];
  }

  public function getSEOUrl($data, $type) {
    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      return $this->db->query("SELECT * FROM ".DB_PREFIX."seo_url WHERE ".$this->db->escape($type)." = '".$this->db->escape($data)."'")->rows;
    } else {
      return $this->db->query("SELECT * FROM ".DB_PREFIX."url_alias WHERE ".$this->db->escape($type)." = '".$this->db->escape($data)."'")->row;
    }
  }

  public function getCustomerGroups($data = []) {
    $sql = "
      SELECT
        *
      FROM ".DB_PREFIX."customer_group cg
      LEFT JOIN ".DB_PREFIX."customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id)
      WHERE
        cgd.language_id = '".(int)$this->config->get('config_language_id')."'
    ";

    $sort_data = [
      'cgd.name'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY cgd.name";
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

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function getStoreSetting($store_id) {
    $setting_data = [];

    $query = $this->db->query("SELECT `key`, `value` FROM ".DB_PREFIX."setting WHERE store_id = '".(int)$store_id."'");

    if ($query->num_rows) {
      foreach ($query->rows as $value) {
        $setting_data[$value['key']] = $value['value'];
      }
    }

    return $setting_data;
  }

  public function getStore($store_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."store WHERE store_id = '".(int)$store_id."'")->row;
  }

  public function getProduct($product_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."product p LEFT JOIN ".DB_PREFIX."product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '".(int)$product_id."' AND pd.language_id = '".(int)$this->config->get('config_language_id')."'")->row;
  }

  public function getProducts($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX."product p LEFT JOIN ".DB_PREFIX."product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."'";

    if (isset($data['filter_name']) && !empty($data['filter_name'])) {
      $sql .= " AND pd.name LIKE '".$this->db->escape($data['filter_name'])."%'";
    }

    $sql .= " GROUP BY p.product_id";

    $sort_data = [
      'pd.name'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      $sql .= " ORDER BY ".$data['sort'];
    } else {
      $sql .= " ORDER BY pd.name";
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
        $data['limit'] = 5;
      }

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $query = $this->db->query($sql);

    return $query->rows;
  }

  public function sendLicenseRequest($data = []) {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (version_compare(VERSION, '2.0.1.1', '<=')) {
      $mail = new Mail($this->config->get('config_mail'));
    } else if (version_compare(VERSION, '2.0.2.0', '>=') && version_compare(VERSION, '2.0.3.1', '<')) {
      $mail                = new Mail();
      $mail->protocol      = $this->config->get('config_mail_protocol');
      $mail->parameter     = $this->config->get('config_mail_parameter');
      $mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
      $mail->smtp_username = $this->config->get('config_mail_smtp_username');
      $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
      $mail->smtp_port     = $this->config->get('config_mail_smtp_port');
      $mail->smtp_timeout  = $this->config->get('config_mail_smtp_timeout');
    } else {
      $mail                = new Mail();
      $mail->protocol      = $this->config->get('config_mail_protocol');
      $mail->parameter     = $this->config->get('config_mail_parameter');
      $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
      $mail->smtp_username = $this->config->get('config_mail_smtp_username');
      $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
      $mail->smtp_port     = $this->config->get('config_mail_smtp_port');
      $mail->smtp_timeout  = $this->config->get('config_mail_smtp_timeout');
    }

    $html = $this->language->get('text_request_license_code_module_field').': '.$this->language->get('heading_title')."\r\n";
    $html .= $this->language->get('text_request_license_code_email_field').': '.$data['email']."\r\n";
    $html .= $this->language->get('text_request_license_code_order_id_field').': '.$data['order_id']."\r\n";
    $html .= $this->language->get('text_request_license_code_marketplace_field').': '.$data['marketplace']."\r\n";
    $html .= $this->language->get('text_request_license_code_domain_field').': '.$data['domain']."\r\n";

    if ($data['test_domain_status']) {
      $html .= $this->language->get('text_request_license_code_test_domain_field').': '.$data['test_domain'];
    }

    $mail->setTo('ocdevwizard@gmail.com');
    $mail->setFrom($data['email']);
    $mail->setSender($this->config->get('config_name'));
    $mail->setSubject($this->language->get('text_license_request_subject'));
    $mail->setHtml($html);
    $mail->send();
  }
}