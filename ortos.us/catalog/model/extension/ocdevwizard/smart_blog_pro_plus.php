<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ModelExtensionOcdevwizardSmartBlogProPlus extends Model {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';

  public function getModule($module_id) {
    $customer_group_id = $this->customer->isLogged() ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    return $this->db->query("
      SELECT
      DISTINCT *
      FROM ".DB_PREFIX.$this->_code."_module m
      LEFT JOIN ".DB_PREFIX.$this->_code."_module_description md ON (m.module_id = md.module_id)
      LEFT JOIN ".DB_PREFIX.$this->_code."_module_to_store m2s ON (m.module_id = m2s.module_id)
      LEFT JOIN ".DB_PREFIX.$this->_code."_module_to_customer_group m2c ON (m.module_id = m2c.module_id)
      WHERE
        m.module_id = '".(int)$module_id."'
        AND md.language_id = '".(int)$this->config->get('config_language_id')."'
        AND m2s.store_id = '".(int)$this->config->get('config_store_id')."'
        AND m2c.customer_group_id = '".(int)$customer_group_id."'
        AND m.status = '1'
    ")->row;
  }

  public function getModules($layout_id, $position) {
    $query = $this->db->query("SELECT DISTINCT m2l.*, m.sort_order, m2l.module_id FROM ".DB_PREFIX.$this->_code."_module m LEFT JOIN ".DB_PREFIX.$this->_code."_module_to_layout m2l ON (m.module_id = m2l.module_id) AND m2l.layout_id = '".(int)$layout_id."' AND m.position = '".$this->db->escape($position)."' ORDER BY m.sort_order ASC");

    $module_data = [];

    if ($query->num_rows) {
      foreach ($query->rows as $key => $row) {
        if ($row['module_id']) {
          $module_data[] = [
            'layout_module_id' => $key,
            'layout_id'        => $layout_id,
            'code'             => $this->_name.'.'.$row['module_id'],
            'position'         => $position,
            'sort_order'       => $row['sort_order']
          ];
        }
      }
    }

    return $module_data;
  }

  public function updateViewed($post_id) {
    $this->db->query("UPDATE ".DB_PREFIX.$this->_code."_post SET viewed = (viewed + 1) WHERE ".$this->_code."_post_id = '".(int)$post_id."'");
  }

  public function getPost($post_id) {
    $query = $this->db->query("SELECT DISTINCT p.*, pd.*, pd.name AS name, ad.name AS author, (SELECT COUNT(comment_id) AS total FROM ".DB_PREFIX.$this->_code."_comment c1 WHERE c1.".$this->_code."_post_id = p.".$this->_code."_post_id AND c1.status = '1' AND c1.respond_id = '0' GROUP BY c1.".$this->_code."_post_id) AS comments, (SELECT COUNT(vote_id) AS total FROM ".DB_PREFIX.$this->_code."_vote v1 WHERE v1.".$this->_code."_post_id = p.".$this->_code."_post_id AND v1.content_type = '1' AND v1.rating_type = '1' GROUP BY v1.".$this->_code."_post_id) AS total_vote_up, (SELECT COUNT(vote_id) AS total FROM ".DB_PREFIX.$this->_code."_vote v1 WHERE v1.".$this->_code."_post_id = p.".$this->_code."_post_id AND v1.content_type = '1' AND v1.rating_type = '0' GROUP BY v1.".$this->_code."_post_id) AS total_vote_down, (SELECT image FROM ".DB_PREFIX.$this->_code."_author a1 WHERE a1.".$this->_code."_author_id = p.".$this->_code."_author_id AND a1.status = '1') as author_logo FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_customer_group p2cg ON (p.".$this->_code."_post_id = p2cg.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author a ON (p.".$this->_code."_author_id = a.".$this->_code."_author_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (p.".$this->_code."_author_id = ad.".$this->_code."_author_id) WHERE p.".$this->_code."_post_id = '".(int)$post_id."' AND pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."' AND p2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."'");

    if ($query->num_rows) {
      preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $query->row['video'], $matches);
      $video = (isset($matches[1])) ? $matches[1] : '';

      return [
        'post_id'                 => $query->row[$this->_code.'_post_id'],
        'main_category_id'        => $query->row[$this->_code.'_main_category_id'],
        'name'                    => $query->row['name'],
        'short_description'       => $query->row['short_description'],
        'main_image_alt'          => $query->row['main_image_alt'],
        'description'             => $query->row['description'],
        'meta_title'              => $query->row['meta_title'],
        'meta_description'        => $query->row['meta_description'],
        'meta_keyword'            => $query->row['meta_keyword'],
        'tag'                     => $query->row['tag'],
        'image'                   => $query->row['image'],
        'video_show_type'         => $query->row['video_show_type'],
        'author_id'               => $query->row[$this->_code.'_author_id'],
        'author'                  => $query->row['author'],
        'author_logo'             => $query->row['author_logo'],
        'sort_order'              => $query->row['sort_order'],
        'status'                  => $query->row['status'],
        'date_added'              => $query->row['date_added'],
        'date_modified'           => $query->row['date_modified'],
        'comments'                => $query->row['comments'],
        'total_vote_up'           => (int)$query->row['total_vote_up'],
        'total_vote_down'         => (int)$query->row['total_vote_down'],
        'viewed'                  => $query->row['viewed'],
        'video'                   => $video,
        'show_main_image'         => $query->row['show_main_image'],
        'main_image_width'        => $query->row['main_image_width'],
        'main_image_height'       => $query->row['main_image_height'],
        'main_image_popup_width'  => $query->row['main_image_popup_width'],
        'main_image_popup_height' => $query->row['main_image_popup_height'],
        'show_additional_image'   => $query->row['show_additional_image'],
        'additional_image_width'  => $query->row['additional_image_width'],
        'additional_image_height' => $query->row['additional_image_height'],
        'show_description'        => $query->row['show_description'],
      ];
    } else {
      return false;
    }
  }

  public function getPosts($data = []) {
    $sql = "SELECT p.".$this->_code."_post_id, (SELECT comment_id AS total FROM ".DB_PREFIX.$this->_code."_comment c1 WHERE c1.".$this->_code."_post_id = p.".$this->_code."_post_id AND c1.status = '1' GROUP BY c1.".$this->_code."_post_id) AS comments";

    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " FROM ".DB_PREFIX.$this->_code."_category_path cp LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_category p2c ON (cp.".$this->_code."_category_id = p2c.".$this->_code."_category_id)";
      } else {
        $sql .= " FROM ".DB_PREFIX.$this->_code."_post_to_category p2c";
      }

      $sql .= " LEFT JOIN ".DB_PREFIX.$this->_code."_post p ON (p2c.".$this->_code."_post_id = p.".$this->_code."_post_id)";
    } else {
      $sql .= " FROM ".DB_PREFIX.$this->_code."_post p";
    }

    $sql .= " LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."'";

    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " AND cp.path_id = '".(int)$data['filter_category_id']."'";
      } else {
        $sql .= " AND p2c.".$this->_code."_category_id = '".(int)$data['filter_category_id']."'";
      }
    }

    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
      $sql .= " AND (";

      if (!empty($data['filter_name'])) {
        $implode = [];

        $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

        foreach ($words as $word) {
          $implode[] = "pd.name LIKE '%".$this->db->escape($word)."%'";
        }

        if ($implode) {
          $sql .= " ".implode(" AND ", $implode)."";
        }

        if (!empty($data['filter_description'])) {
          $sql .= " OR pd.description LIKE '%".$this->db->escape($data['filter_name'])."%'";
        }
      }

      if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
        $sql .= " OR ";
      }

      if (!empty($data['filter_tag'])) {
        $sql .= "LCASE(pd.tag) LIKE '%".$this->db->escape($data['filter_tag'])."%'";
      }

      $sql .= ")";
    }

    if (!empty($data['filter_author_id'])) {
      $sql .= " AND p.".$this->_code."_author_id = '".(int)$data['filter_author_id']."'";
    }

    if (!empty($data['filter_archive'])) {
      $sql .= " AND DATE_FORMAT(p.date_available, '%M %Y') = '".$this->db->escape($data['filter_archive'])."'";
    }

    $sql .= " GROUP BY p.".$this->_code."_post_id";

    $sort_data = [
      'pd.name',
      'p.sort_order',
      'p.date_added',
      'p.viewed',
      'comments'
    ];

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
      if ($data['sort'] == 'pd.name') {
        $sql .= " ORDER BY LCASE(".$data['sort'].")";
      } else {
        $sql .= " ORDER BY ".$data['sort'];
      }
    } else {
      $sql .= " ORDER BY p.sort_order";
    }

    if (isset($data['order']) && ($data['order'] == 'DESC')) {
      $sql .= " DESC, LCASE(pd.name) DESC";
    } else {
      $sql .= " ASC, LCASE(pd.name) ASC";
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

    $product_data = [];

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
      $product_data[$result[$this->_code.'_post_id']] = $this->getPost($result[$this->_code.'_post_id']);
    }

    return $product_data;
  }

  public function getTotalPosts($data = []) {
    $sql = "SELECT COUNT(DISTINCT p.".$this->_code."_post_id) AS total";

    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " FROM ".DB_PREFIX.$this->_code."_category_path cp LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_category p2c ON (cp.".$this->_code."_category_id = p2c.".$this->_code."_category_id)";
      } else {
        $sql .= " FROM ".DB_PREFIX.$this->_code."_post_to_category p2c";
      }

      $sql .= " LEFT JOIN ".DB_PREFIX.$this->_code."_post p ON (p2c.".$this->_code."_post_id = p.".$this->_code."_post_id)";
    } else {
      $sql .= " FROM ".DB_PREFIX.$this->_code."_post p";
    }

    $sql .= " LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."'";

    if (!empty($data['filter_category_id'])) {
      if (!empty($data['filter_sub_category'])) {
        $sql .= " AND cp.path_id = '".(int)$data['filter_category_id']."'";
      } else {
        $sql .= " AND p2c.".$this->_code."_category_id = '".(int)$data['filter_category_id']."'";
      }
    }

    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
      $sql .= " AND (";

      if (!empty($data['filter_name'])) {
        $implode = [];

        $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

        foreach ($words as $word) {
          $implode[] = "pd.name LIKE '%".$this->db->escape($word)."%'";
        }

        if ($implode) {
          $sql .= " ".implode(" AND ", $implode)."";
        }

        if (!empty($data['filter_description'])) {
          $sql .= " OR pd.description LIKE '%".$this->db->escape($data['filter_name'])."%'";
        }
      }

      if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
        $sql .= " OR ";
      }

      if (!empty($data['filter_tag'])) {
        $sql .= "LCASE(pd.tag) LIKE '%".$this->db->escape(utf8_strtolower($data['filter_tag']))."%'";
      }

      $sql .= ")";
    }

    if (!empty($data['filter_manufacturer_id'])) {
      $sql .= " AND p.manufacturer_id = '".(int)$data['filter_manufacturer_id']."'";
    }

    if (!empty($data['filter_archive'])) {
      $sql .= " AND DATE_FORMAT(p.date_available, '%M %Y') = '".$this->db->escape($data['filter_archive'])."'";
    }

    $query = $this->db->query($sql);

    return $query->row['total'];
  }

  public function getPosts2Module($data = []) {
    $sql = "SELECT p.".$this->_code."_post_id, (SELECT comment_id AS total FROM ".DB_PREFIX.$this->_code."_comment c1 WHERE c1.".$this->_code."_post_id = p.".$this->_code."_post_id AND c1.status = '1' GROUP BY c1.".$this->_code."_post_id) AS comments FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_customer_group p2cg ON (p.".$this->_code."_post_id = p2cg.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."' AND p2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' GROUP BY p.".$this->_code."_post_id";

    if ($data['filter_data']['sort_method'] == 1) {
      $sql .= " ORDER BY LCASE(pd.name) ASC";
    } else if ($data['filter_data']['sort_method'] == 2) {
      $sql .= " ORDER BY LCASE(pd.name) DESC";
    } else if ($data['filter_data']['sort_method'] == 3) {
      $sql .= " ORDER BY p.sort_order ASC";
    } else if ($data['filter_data']['sort_method'] == 4) {
      $sql .= " ORDER BY p.sort_order DESC";
    } else if ($data['filter_data']['sort_method'] == 5) {
      $sql .= " ORDER BY p.date_added ASC";
    } else if ($data['filter_data']['sort_method'] == 6) {
      $sql .= " ORDER BY p.date_added DESC";
    } else if ($data['filter_data']['sort_method'] == 7) {
      $sql .= " ORDER BY p.viewed ASC";
    } else if ($data['filter_data']['sort_method'] == 8) {
      $sql .= " ORDER BY p.viewed DESC";
    } else if ($data['filter_data']['sort_method'] == 9) {
      $sql .= " ORDER BY comments ASC";
    } else if ($data['filter_data']['sort_method'] == 10) {
      $sql .= " ORDER BY comments DESC";
    } else {
      $sql .= " ORDER BY p.date_added ASC";
    }

    $sql .= " LIMIT 0,".(int)$data['filter_data']['limit'];

    $product_data = [];

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
      $product_data[$result[$this->_code.'_post_id']] = $this->getPost($result[$this->_code.'_post_id']);
    }

    return $product_data;
  }

  public function getPostImages($post_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_post_image WHERE ".$this->_code."_post_id = '".(int)$post_id."' ORDER BY sort_order ASC")->rows;
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

  public function addComment($data) {
    $customer_group_id = $this->customer->isLogged() ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_comment
      SET
        ".$this->_code."_post_id = '".(int)$data['post_id']."',
        status = '".(int)$data['status']."',
        respond_id = '".(int)$data['respond_id']."',
        notification_on_respond = '".(int)$data['notification_on_respond']."',
        firstname = '".$this->db->escape($data['firstname'])."',
        email = '".$this->db->escape($data['email'])."',
        token = '".$this->db->escape($data['token'])."', 
        user_agent = '".$this->db->escape($data['user_agent'])."',
        accept_language = '".$this->db->escape($data['accept_language'])."',
        user_language_id = '".(int)$data['user_language_id']."',
        store_name = '".$this->db->escape($data['store_name'])."',
        store_url = '".$this->db->escape($data['store_url'])."',
        store_id = '".(int)$data['store_id']."',
        date_added = NOW()
    ");

    $comment_id = $this->db->getLastId();

    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_comment_description
      SET
        comment_id = '".(int)$comment_id."',
        language_id = '".(int)$this->config->get('config_language_id')."',
        description = '".$this->db->escape($data['description'])."'
    ");

    $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_store SET comment_id = '".(int)$comment_id."', store_id = '".(int)$this->config->get('config_store_id')."'");

    $this->db->query("INSERT INTO ".DB_PREFIX.$this->_code."_comment_to_customer_group SET comment_id = '".(int)$comment_id."', customer_group_id = '".(int)$customer_group_id."'");

    if ($data['respond_id']) {
      $this->mailingRecords((int)$data['respond_id'], (int)$comment_id);
    }

    return $comment_id;
  }

  public function getComment($comment_id) {
    $query = $this->db->query("SELECT DISTINCT *, (SELECT COUNT(vote_id) AS total FROM ".DB_PREFIX.$this->_code."_vote v1 WHERE v1.".$this->_code."_post_id = `c`.".$this->_code."_post_id AND v1.content_type = '2' AND v1.rating_type = '1' AND v1.comment_id = `c`.comment_id GROUP BY v1.comment_id) AS total_vote_up, (SELECT COUNT(vote_id) AS total FROM ".DB_PREFIX.$this->_code."_vote v1 WHERE v1.".$this->_code."_post_id = `c`.".$this->_code."_post_id AND v1.content_type = '2' AND v1.rating_type = '0' AND v1.comment_id = `c`.comment_id GROUP BY v1.comment_id) AS total_vote_down FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND `c`.status = '1' AND `c`.comment_id = '".(int)$comment_id."'");

    if ($query->num_rows) {
      return [
        'comment_id'              => $query->row['comment_id'],
        'respond_id'              => $query->row['respond_id'],
        'comment_type'            => $query->row['comment_type'],
        'post_id'                 => $query->row[$this->_code.'_post_id'],
        'status'                  => $query->row['status'],
        'notification_on_respond' => $query->row['notification_on_respond'],
        'firstname'               => $query->row['firstname'],
        'email'                   => $query->row['email'],
        'description'             => $query->row['description'],
        'total_vote_up'           => (int)$query->row['total_vote_up'],
        'total_vote_down'         => (int)$query->row['total_vote_down'],
        'date_added'              => $query->row['date_added'],
        'date_modified'           => $query->row['date_modified']
      ];
    } else {
      return false;
    }
  }

  public function getComments($data = []) {
    $sql = "SELECT `c`.comment_id FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND `c`.status = '1' AND `c`.respond_id = '0' AND `c`.".$this->_code."_post_id = '".(int)$data['post_id']."' ORDER BY `c`.date_added DESC";

    if (isset($data['start']) || isset($data['limit'])) {
      if ($data['start'] < 0) {
        $data['start'] = 0;
      }

      if ($data['limit'] < 1) {
        $data['limit'] = 20;
      }

      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
    }

    $comment_data = [];

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
      $comment_data[$result['comment_id']] = $this->getComment($result['comment_id']);
    }

    return $comment_data;
  }

  public function getTotalComments($data = []) {
    return $this->db->query("SELECT COUNT(DISTINCT `c`.comment_id) AS total FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND `c`.status = '1' AND `c`.respond_id = '0' AND `c`.".$this->_code."_post_id = '".(int)$data['post_id']."'")->row['total'];
  }

  public function getCommentResponds($comment_id, $post_id) {
    $sql = "SELECT `c`.comment_id FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND `c`.status = '1' AND `c`.".$this->_code."_post_id = '".(int)$post_id."' AND `c`.respond_id = '".(int)$comment_id."' ORDER BY `c`.date_added DESC";

    $respond_data = [];

    $query = $this->db->query($sql);

    foreach ($query->rows as $result) {
      $respond_data[$result['comment_id']] = $this->getComment($result['comment_id']);
    }

    return $respond_data;
  }

  public function addVote($data) {
    $this->db->query("
      INSERT INTO ".DB_PREFIX.$this->_code."_vote
      SET
        comment_id = '".(int)$data['comment_id']."',
        ".$this->_code."_post_id = '".(int)$data['post_id']."',
        content_type = '".(int)$data['content_type']."',
        rating_type = '".(int)$data['rating_type']."',
        ip = '".$this->db->escape($data['ip'])."',
        date_added = NOW()
    ");
  }

  public function getArchive2Module($data = []) {
    $sql = "SELECT MONTHNAME(p.date_available) AS month, YEAR(p.date_available) AS year, COUNT(p.".$this->_code."_post_id) AS total FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_customer_group p2cg ON (p.".$this->_code."_post_id = p2cg.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."' AND p2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' GROUP BY CONCAT(month(p.date_available), ' ', year(p.date_available))";

    if ($data['filter_data']['sort_method'] == 5) {
      $sql .= " ORDER BY p.date_available ASC";
    } else if ($data['filter_data']['sort_method'] == 6) {
      $sql .= " ORDER BY p.date_available DESC";
    } else {
      $sql .= " ORDER BY p.date_available ASC";
    }

    return $this->db->query($sql)->rows;
  }

  public function getCategory($category_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_category `c` LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (`c`.".$this->_code."_category_id = cd.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_store c2s ON (`c`.".$this->_code."_category_id = c2s.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_customer_group c2cg ON (`c`.".$this->_code."_category_id = c2cg.".$this->_code."_category_id) WHERE `c`.".$this->_code."_category_id = '".(int)$category_id."' AND cd.language_id = '".(int)$this->config->get('config_language_id')."' AND c2s.store_id = '".(int)$this->config->get('config_store_id')."' AND c2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND `c`.status = '1'")->row;
  }

  public function getCategories($parent_id = 0) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category c LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (`c`.".$this->_code."_category_id = cd.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_store c2s ON (`c`.".$this->_code."_category_id = c2s.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_customer_group c2cg ON (`c`.".$this->_code."_category_id = c2cg.".$this->_code."_category_id) WHERE `c`.parent_id = '".(int)$parent_id."' AND cd.language_id = '".(int)$this->config->get('config_language_id')."' AND c2s.store_id = '".(int)$this->config->get('config_store_id')."' AND c2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND `c`.status = '1' ORDER BY `c`.sort_order, LCASE(cd.name)")->rows;
  }

  public function getCategoryImages($category_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_category_image WHERE ".$this->_code."_category_id = '".(int)$category_id."' ORDER BY sort_order ASC")->rows;
  }

  public function getCategories2Module($parent_id = 0, $data = []) {
    $sql = "SELECT `c`.".$this->_code."_category_id FROM ".DB_PREFIX.$this->_code."_category `c` LEFT JOIN ".DB_PREFIX.$this->_code."_category_description cd ON (`c`.".$this->_code."_category_id = cd.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_store c2s ON (`c`.".$this->_code."_category_id = c2s.".$this->_code."_category_id) LEFT JOIN ".DB_PREFIX.$this->_code."_category_to_customer_group c2cg ON (c.".$this->_code."_category_id = c2cg.".$this->_code."_category_id) WHERE `c`.parent_id = '".(int)$parent_id."' AND cd.language_id = '".(int)$this->config->get('config_language_id')."' AND c2s.store_id = '".(int)$this->config->get('config_store_id')."' AND c2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND `c`.status = '1'";

    if ($data['filter_data']['sort_method'] == 1) {
      $sql .= " ORDER BY LCASE(cd.name) ASC";
    } else if ($data['filter_data']['sort_method'] == 2) {
      $sql .= " ORDER BY LCASE(cd.name) DESC";
    } else if ($data['filter_data']['sort_method'] == 3) {
      $sql .= " ORDER BY `c`.sort_order ASC";
    } else if ($data['filter_data']['sort_method'] == 4) {
      $sql .= " ORDER BY `c`.sort_order DESC";
    } else if ($data['filter_data']['sort_method'] == 5) {
      $sql .= " ORDER BY `c`.date_added ASC";
    } else if ($data['filter_data']['sort_method'] == 6) {
      $sql .= " ORDER BY `c`.date_added DESC";
    } else {
      $sql .= " ORDER BY `c`.date_added ASC";
    }

    $sql .= " LIMIT 0,".(int)$data['filter_data']['limit'];

    $category_data = [];

    $query = $this->db->query($sql);

    $selected_categories = $this->getModuleRelatedCategory($data['filter_data']['module_id']);

    foreach ($query->rows as $result) {
      if ($data['filter_data']['related_type'] == 2 && in_array($result[$this->_code.'_category_id'], $selected_categories)) {
        $category_data[$result[$this->_code.'_category_id']] = $this->getCategory($result[$this->_code.'_category_id']);
      }

      if ($data['filter_data']['related_type'] == 1) {
        $category_data[$result[$this->_code.'_category_id']] = $this->getCategory($result[$this->_code.'_category_id']);
      }
    }

    return $category_data;
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

  public function getTags2Module($data = []) {
    return $this->db->query("SELECT DISTINCT pd.tag FROM ".DB_PREFIX.$this->_code."_post p LEFT JOIN ".DB_PREFIX.$this->_code."_post_description pd ON (p.".$this->_code."_post_id = pd.".$this->_code."_post_id) LEFT JOIN ".DB_PREFIX.$this->_code."_post_to_store p2s ON (p.".$this->_code."_post_id = p2s.".$this->_code."_post_id) WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."' GROUP BY pd.tag LIMIT 0,".(int)$data['limit'])->rows;
  }

  public function getComments2Module($data = []) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_comment `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) LEFT JOIN ".DB_PREFIX.$this->_code."_comment_to_store c2s ON (`c`.comment_id = c2s.comment_id) LEFT JOIN ".DB_PREFIX.$this->_code."_comment_to_customer_group c2cg ON (`c`.comment_id = c2cg.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND c2s.store_id = '".(int)$this->config->get('config_store_id')."' AND c2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND `c`.status = '1'";

    if (isset($data['filter_post_id']) && !empty($data['filter_post_id'])) {
      $sql .= " AND `c`.".$this->_code."_post_id = '".(int)$data['filter_post_id']."'";
    }

    $sql .= " GROUP BY `c`.comment_id";

    if ($data['filter_data']['sort_method'] == 5) {
      $sql .= " ORDER BY `c`.date_added ASC";
    } else if ($data['filter_data']['sort_method'] == 6) {
      $sql .= " ORDER BY `c`.date_added DESC";
    } else {
      $sql .= " ORDER BY `c`.date_added ASC";
    }

    if (isset($data['start'])) {
      $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['filter_data']['limit'];
    } else {
      $sql .= " LIMIT 0,".(int)$data['filter_data']['limit'];
    }

    return $this->db->query($sql)->rows;
  }

  public function getTotalComments2Module($data = []) {
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

  public function getLanguageByCode($code) {
    return $this->db->query("SELECT language_id FROM ".DB_PREFIX."language WHERE code = '".$this->db->escape($code)."'")->row['language_id'];
  }

  public function getStore($store_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX."store WHERE store_id = '".(int)$store_id."'")->row;
  }

  public function getProduct($product_id) {
    $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM ".DB_PREFIX."product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM ".DB_PREFIX."product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM ".DB_PREFIX."product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '".(int)$this->config->get('config_customer_group_id')."') AS reward, (SELECT ss.name FROM ".DB_PREFIX."stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '".(int)$this->config->get('config_language_id')."') AS stock_status, (SELECT wcd.unit FROM ".DB_PREFIX."weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '".(int)$this->config->get('config_language_id')."') AS weight_class, (SELECT lcd.unit FROM ".DB_PREFIX."length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '".(int)$this->config->get('config_language_id')."') AS length_class, (SELECT AVG(rating) AS total FROM ".DB_PREFIX."review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM ".DB_PREFIX."review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM ".DB_PREFIX."product p LEFT JOIN ".DB_PREFIX."product_description pd ON (p.product_id = pd.product_id) LEFT JOIN ".DB_PREFIX."product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN ".DB_PREFIX."manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '".(int)$product_id."' AND pd.language_id = '".(int)$this->config->get('config_language_id')."' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '".(int)$this->config->get('config_store_id')."'");

    if ($query->num_rows) {
      return [
        'product_id'       => $query->row['product_id'],
        'name'             => $query->row['name'],
        'description'      => $query->row['description'],
        'meta_title'       => $query->row['meta_title'],
        'meta_description' => $query->row['meta_description'],
        'meta_keyword'     => $query->row['meta_keyword'],
        'tag'              => $query->row['tag'],
        'model'            => $query->row['model'],
        'sku'              => $query->row['sku'],
        'upc'              => $query->row['upc'],
        'ean'              => $query->row['ean'],
        'jan'              => $query->row['jan'],
        'isbn'             => $query->row['isbn'],
        'mpn'              => $query->row['mpn'],
        'location'         => $query->row['location'],
        'quantity'         => $query->row['quantity'],
        'stock_status'     => $query->row['stock_status'],
        'image'            => $query->row['image'],
        'manufacturer_id'  => $query->row['manufacturer_id'],
        'manufacturer'     => $query->row['manufacturer'],
        'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
        'special'          => $query->row['special'],
        'reward'           => $query->row['reward'],
        'points'           => $query->row['points'],
        'tax_class_id'     => $query->row['tax_class_id'],
        'date_available'   => $query->row['date_available'],
        'weight'           => $query->row['weight'],
        'weight_class_id'  => $query->row['weight_class_id'],
        'length'           => $query->row['length'],
        'width'            => $query->row['width'],
        'height'           => $query->row['height'],
        'length_class_id'  => $query->row['length_class_id'],
        'subtract'         => $query->row['subtract'],
        'rating'           => round($query->row['rating']),
        'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
        'minimum'          => $query->row['minimum'],
        'sort_order'       => $query->row['sort_order'],
        'status'           => $query->row['status'],
        'date_added'       => $query->row['date_added'],
        'date_modified'    => $query->row['date_modified'],
        'viewed'           => $query->row['viewed']
      ];
    } else {
      return false;
    }
  }

  public function getAuthor($author_id) {
    return $this->db->query("SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_author a LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author_to_store a2s ON (a.".$this->_code."_author_id = a2s.".$this->_code."_author_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author_to_customer_group a2cg ON (a.".$this->_code."_author_id = a2cg.".$this->_code."_author_id) WHERE a.".$this->_code."_author_id = '".(int)$author_id."' AND ad.language_id = '".(int)$this->config->get('config_language_id')."' AND a2s.store_id = '".(int)$this->config->get('config_store_id')."' AND a2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND a.status = '1'")->row;
  }

  public function getAuthors($data = []) {
    $customer_group_id = $this->customer->isLogged() ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $sql = "SELECT * FROM ".DB_PREFIX.$this->_code."_author a LEFT JOIN ".DB_PREFIX.$this->_code."_author_description ad ON (a.".$this->_code."_author_id = ad.".$this->_code."_author_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author_to_store a2s ON (a.".$this->_code."_author_id = a2s.".$this->_code."_author_id) LEFT JOIN ".DB_PREFIX.$this->_code."_author_to_customer_group a2cg ON (a.".$this->_code."_author_id = a2cg.".$this->_code."_author_id) WHERE ad.language_id = '".(int)$this->config->get('config_language_id')."' AND a2s.store_id = '".(int)$this->config->get('config_store_id')."' AND a2cg.customer_group_id = '".(int)$this->config->get('config_customer_group_id')."' AND a.status = '1'";

    $sort_data = [
      'ad.name',
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

  public function getAuthorImages($author_id) {
    return $this->db->query("SELECT * FROM ".DB_PREFIX.$this->_code."_author_image WHERE ".$this->_code."_author_id = '".(int)$author_id."' ORDER BY sort_order ASC")->rows;
  }

  public function checkBanned($email, $ip) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_banned WHERE (";

    if ($email) {
      $sql .= "LCASE(email) = '".$this->db->escape(utf8_strtolower($email))."' OR ";
    }

    $sql .= "ip = '".$this->db->escape($ip)."') AND status = '1'";

    $query = $this->db->query($sql);

    if ($query->row) {
      return true;
    } else {
      return false;
    }
  }

  public function checkVote($data) {
    $sql = "SELECT DISTINCT * FROM ".DB_PREFIX.$this->_code."_vote WHERE (";

    if ($data['content_type'] == '1') {
      $sql .= "ip = '".$this->db->escape($data['ip'])."') AND ".$this->_code."_post_id = '".(int)$data['post_id']."' AND content_type = '".(int)$data['content_type']."'";
    } else {
      $sql .= "ip = '".$this->db->escape($data['ip'])."') AND ".$this->_code."_post_id = '".(int)$data['post_id']."' AND comment_id = '".(int)$data['comment_id']."' AND content_type = '".(int)$data['content_type']."'";
    }

    $query = $this->db->query($sql);

    if ($query->row) {
      return true;
    } else {
      return false;
    }
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

  public function mailingRecords($respond_id, $comment_id) {
    $records = [];

    if ($respond_id) {
      $query = $this->db->query("SELECT DISTINCT * FROM `".DB_PREFIX.$this->_code."_comment` `c` LEFT JOIN ".DB_PREFIX.$this->_code."_comment_description cd ON (`c`.comment_id = cd.comment_id) WHERE cd.language_id = '".(int)$this->config->get('config_language_id')."' AND `c`.status = '1' AND `c`.comment_id = '".(int)$respond_id."'");
      if ($query->row) {
        $records[] = $query->row;
      }
    }

    if ($records) {
      $models = [
        'extension/ocdevwizard/ocdevwizard_setting'
      ];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

      foreach ($records as $record) {
        if (isset($form_data['email_template_by_default']) && $form_data['email_template_by_default']) {
          $comment_info = $this->getComment($comment_id);

          $tag_codes = [
            '{firstname}',
            '{email}',
            '{comment}',
            '{respond_firstname}',
            '{respond_email}',
            '{respond_comment}',
            '{store_name}',
            '{store_address}',
            '{store_email}',
            '{store_telephone}',
            '{store_fax}',
            '{unsubscribe_url}',
          ];

          $tag_codes_replace = [
            $record['firstname'],
            $record['email'],
            $record['description'],
            $comment_info['firstname'],
            $comment_info['email'],
            $comment_info['description'],
            $record['store_name'],
            $this->config->get('config_address'),
            $this->config->get('config_email'),
            $this->config->get('config_telephone'),
            ($this->config->get('config_fax') != '') ? $this->config->get('config_fax') : '',
            $record['store_url'].'index.php?route=checkout/cart&'.$this->_code.'_visitor_delete='.$record['token']
          ];

          $html_data = [];
          $html_data = array_merge($html_data, $this->language->load('extension/ocdevwizard/'.$this->_name));

          $template_description = $this->getEmailTemplateDescription($form_data['email_template_by_default']);

          if ($template_description) {
            $html_data['html_template'] = html_entity_decode(str_replace($tag_codes, $tag_codes_replace, $template_description[$record['user_language_id']]['template']), ENT_QUOTES, 'UTF-8');
            $subject                    = html_entity_decode(str_replace($tag_codes, $tag_codes_replace, $template_description[$record['user_language_id']]['subject']), ENT_QUOTES, 'UTF-8');

            $html_data['title'] = $subject;

            if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
              if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/mail_custom.tpl')) {
                $html = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/mail_custom.tpl', $html_data);
              } else {
                $html = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/mail_custom.tpl', $html_data);
              }
            } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
              $html = $this->load->view('extension/ocdevwizard/'.$this->_name.'/mail_custom', $html_data);
            } else {
              $html = $this->load->view('extension/ocdevwizard/'.$this->_name.'/mail_custom.tpl', $html_data);
            }

            // email notification
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

            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($record['store_name']);
            $mail->setSubject($subject);
            $mail->setHtml($html);
            $mail->setTo($record['email']);
            $mail->send();
          }
        }
      }

      return true;
    } else {
      return false;
    }
  }
}

?>