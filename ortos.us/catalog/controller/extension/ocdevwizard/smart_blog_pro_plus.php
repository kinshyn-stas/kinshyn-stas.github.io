<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ControllerExtensionOcdevwizardSmartBlogProPlus extends Controller {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';
  private $_session_currency;
  private $_currency_code;

  public function __construct($registry) {
    parent::__construct($registry);

    if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
      $this->_session_currency = '';
      $this->_currency_code = $this->currency->getCode();
    } else {
      $this->_session_currency = $this->_currency_code = $this->session->data['currency'];
    }
  }

  public function post() {
    $data = [];

    $models = [
      'tool/image',
      'catalog/information',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $data = array_merge($data, $this->load->language('extension/ocdevwizard/'.$this->_name), $form_data);

    $data['_name'] = $this->_name;
    $data['_code'] = $this->_code;

    if (isset($this->request->get[$this->_code.'_post_id'])) {
      $data['post_id'] = $post_id = (int)$this->request->get[$this->_code.'_post_id'];
    } else {
      $data['post_id'] = $post_id = 0;
    }

    if (isset($form_data['activate']) && $form_data['activate'] && isset($this->request->get[$this->_code.'_path'])) {
      $data['breadcrumbs'] = [];

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
      ];

      $path = '';

      $parts = explode('_', (string)$this->request->get[$this->_code.'_path']);

      $category_id = (int)array_pop($parts);

      foreach ($parts as $path_id) {
        if (!$path) {
          $path = $path_id;
        } else {
          $path .= '_'.$path_id;
        }

        $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($path_id);

        if ($category_info) {
          $data['breadcrumbs'][] = [
            'text' => $category_info['name'],
            'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$path)
          ];
        }
      }

      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($category_id);

      if ($category_info) {
        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
          $url .= '&page='.$this->request->get['page'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['breadcrumbs'][] = [
          'text' => $category_info['name'],
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url)
        ];
      }

      $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($post_id);

      if ($post_info) {
        $data = array_merge($data, $post_info);

        $url = '';

        if (isset($this->request->get[$this->_code.'_path'])) {
          $url .= '&'.$this->_code.'_path='.$this->request->get[$this->_code.'_path'];
        }

        if (isset($this->request->get[$this->_code.'_author_id'])) {
          $url .= '&'.$this->_code.'_author_id='.$this->request->get[$this->_code.'_author_id'];
        }

        if (isset($this->request->get[$this->_code.'_search'])) {
          $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_tag'])) {
          $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_description'])) {
          $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
        }

        if (isset($this->request->get[$this->_code.'_category_id'])) {
          $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
        }

        if (isset($this->request->get[$this->_code.'_sub_category'])) {
          $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
        }

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
          $url .= '&page='.$this->request->get['page'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['breadcrumbs'][] = [
          'text' => $post_info['name'],
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $url.'&'.$this->_code.'_post_id='.$post_id)
        ];

        $this->document->setTitle($post_info['meta_title']);
        $this->document->setDescription($post_info['meta_description']);
        $this->document->setKeywords($post_info['meta_keyword']);
        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$post_info['main_category_id'].'&'.$this->_code.'_post_id='.$post_info['post_id']), 'canonical');

        if ($form_data['show_post_vote'] || $post_info['show_main_image'] == 1 || $post_info['show_additional_image']) {
          $this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
          $this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
        }

        $data['heading_title']         = $post_info['name'];
        $data['text_login']            = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
        $data['post_id']               = (int)$post_id;
        $data['author']                = $post_info['author'];
        $data['author_logo']           = ($post_info['author_logo']) ? $this->model_tool_image->resize($post_info['author_logo'], 600, 60) : '';
        $data['authors']               = $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$post_info['author_id']);
        $data['popup']                 = ($post_info['image']) ? $this->model_tool_image->resize($post_info['image'], $post_info['main_image_popup_width'], $post_info['main_image_popup_height']) : '';
        $data['thumb']                 = ($post_info['image']) ? $this->model_tool_image->resize($post_info['image'], $post_info['main_image_width'], $post_info['main_image_height']) : '';
        $data['customer_name']         = ($this->customer->isLogged()) ? $this->customer->getFirstName().'&nbsp;'.$this->customer->getLastName() : '';
        $data['description']           = html_entity_decode($post_info['description'], ENT_QUOTES, 'UTF-8');
        $customer_group_id             = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');
        $comment_write_customer_groups = (isset($form_data['comment_customer_groups_write']) && $form_data['comment_customer_groups_write']) ? $form_data['comment_customer_groups_write'] : [];
        $comment_see_customer_groups   = (isset($form_data['comment_customer_groups_see']) && $form_data['comment_customer_groups_see']) ? $form_data['comment_customer_groups_see'] : [];
        $data['comment_write_status']  = (in_array($customer_group_id, $comment_write_customer_groups)) ? true : false;
        $data['comment_see_status']    = (in_array($customer_group_id, $comment_see_customer_groups)) ? true : false;
        $data['date_added']            = $this->make_time_ago($post_info['date_added']);
        $data['real_date_added']       = date("c", strtotime($post_info['date_added']));
        $data['real_date_modified']    = date("c", strtotime($post_info['date_modified']));
        $data['comment_total']         = (int)$post_info['comments'];
        $data['post_vote_down']        = $post_info['total_vote_down'];
        $data['post_vote_up']          = $post_info['total_vote_up'];
        $data['email']                 = ($this->customer->isLogged()) ? $this->customer->getEmail() : '';
        $data['firstname']             = ($this->customer->isLogged()) ? $this->customer->getFirstName() : '';
        $data['canonical']             = $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $url.'&'.$this->_code.'_post_id='.$post_id);

        $data['images'] = [];

        $dat['main_image_alt'] = $post_info['main_image_alt'] ? $post_info['main_image_alt'] : $post_info['name'];

        $images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostImages($post_id);

        foreach ($images as $image) {
          $data['images'][] = [
            'popup' => $this->model_tool_image->resize($image['image'], $post_info['main_image_popup_width'], $post_info['main_image_popup_height']),
            'thumb' => $this->model_tool_image->resize($image['image'], $post_info['additional_image_width'], $post_info['additional_image_height'])
          ];
        }

        $data['images_other']       = [];
        $data['images_other_total'] = 0;

        if (count($images) >= 4) {
          $data['images_other'] = array_slice($data['images'], 4);

          $data['images_other_total'] = count($data['images_other']);

          $data['images'] = array_slice($data['images'], 0, 3, true);
        }

        $page_href = $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $url.'&'.$this->_code.'_post_id='.$post_id);

        $socials = [
          0 => [
            'name'  => 'Facebook',
            'value' => 'facebook',
            'href'  => 'https://www.facebook.com/sharer.php?u='.$page_href,
            'class' => 'fb',
            'icon'  => 'fa fa-facebook'
          ],
          1 => [
            'name'  => 'Twitter',
            'value' => 'twitter',
            'href'  => 'https://twitter.com/intent/tweet?url='.$page_href.'&text='.$post_info['name'].'&via=&hashtags=',
            'class' => 'tw',
            'icon'  => 'fa fa-twitter'
          ],
          2 => [
            'name'  => 'Pinterest',
            'value' => 'pinterest',
            'href'  => 'http://pinterest.com/pin/create/button/?url='.$page_href,
            'class' => 'pt',
            'icon'  => 'fa fa-pinterest'
          ],
          3 => [
            'name'  => 'VK',
            'value' => 'vk',
            'href'  => 'http://vk.com/share.php?url='.$page_href.'&title='.$post_info['name'].'&comment=',
            'class' => 'vk',
            'icon'  => 'fa fa-vk'
          ],
          4 => [
            'name'  => 'AddThis',
            'value' => 'addthis',
            'href'  => 'http://www.addthis.com/bookmark.php?url='.$page_href,
            'class' => 'at',
            'icon'  => 'fa fa-plus'
          ]
        ];

        $data['socials'] = [];

        foreach ($socials as $social) {
          if (isset($form_data['post_socials']) && $form_data['post_socials'] && in_array($social['value'], $form_data['post_socials'])) {
            $data['socials'][] = [
              'name'  => $social['name'],
              'href'  => $social['href'],
              'class' => $social['class'],
              'icon'  => $social['icon']
            ];
          }
        }

        $data['related_products'] = [];

        if ($form_data['show_related_products']) {
          $related_products = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostRelatedProduct($post_id);

          $related_products = array_slice($related_products, 0, (int)$form_data['limit_product_on_post']);

          foreach ($related_products as $related_product_id) {
            $related_product_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getProduct($related_product_id);

            if ($related_product_info) {
              $image   = ($related_product_info['image']) ? $this->model_tool_image->resize($related_product_info['image'], $form_data['product_main_image_width_on_post'], $form_data['product_main_image_height_on_post']) : $this->model_tool_image->resize("no_image.png", $form_data['product_main_image_width_on_post'], $form_data['product_main_image_height_on_post']);
              $price = (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) ? $this->currency->format($this->tax->calculate($related_product_info['price'], $related_product_info['tax_class_id'], $this->config->get('config_tax')), $this->_session_currency) : false;
              $special = ((float)$related_product_info['special']) ? $this->currency->format($this->tax->calculate($related_product_info['special'], $related_product_info['tax_class_id'], $this->config->get('config_tax')), $this->_session_currency) : false;
              $tax = ($this->config->get('config_tax')) ? $this->currency->format((float)$related_product_info['special'] ? $related_product_info['special'] : $related_product_info['price'], $this->_session_currency) : false;
              $rating  = ($this->config->get('config_review_status')) ? $related_product_info['rating'] : false;

              $data['related_products'][] = [
                'product_id'  => $related_product_info['product_id'],
                'thumb'       => $image,
                'name'        => $related_product_info['name'],
                'description' => utf8_substr(strip_tags(html_entity_decode($related_product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['product_description_limit_on_post']).'..',
                'price'       => $price,
                'special'     => $special,
                'tax'         => $tax,
                'rating'      => $rating,
                'href'        => $this->url->link('product/product', 'product_id='.$related_product_info['product_id'])
              ];
            }
          }

          if ($form_data['product_randomize_on_post']) {
            shuffle($data['related_products']);
          }
        }

        $data['related_posts'] = [];

        if ($form_data['show_related_posts']) {
          $related_posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostRelatedPost($post_id);

          $related_posts = array_slice($related_posts, 0, (int)$form_data['limit_post_on_post']);

          foreach ($related_posts as $related_post_id) {
            $related_post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($related_post_id);

            if ($related_post_info) {
              $image = ($related_post_info['image']) ? $this->model_tool_image->resize($related_post_info['image'], $form_data['post_image_width_on_post'], $form_data['post_image_height_on_post']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_post'], $form_data['post_image_height_on_post']);

              if (utf8_strlen(strip_tags(html_entity_decode($related_post_info['description'], ENT_QUOTES, 'UTF-8'))) > 0) {
                $description = utf8_substr(strip_tags(html_entity_decode($related_post_info['description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_post']).'..';
              } else {
                $description = '';
              }

              if (utf8_strlen(strip_tags(html_entity_decode($related_post_info['short_description'], ENT_QUOTES, 'UTF-8'))) > 0) {
                $short_description = utf8_substr(strip_tags(html_entity_decode($related_post_info['short_description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_post']).'..';
              } else {
                $short_description = '';
              }

              $data['related_posts'][] = [
                'post_id'           => $related_post_info['post_id'],
                'name'              => $related_post_info['name'],
                'author'            => $related_post_info['author'],
                'video'             => $related_post_info['video'],
                'show_main_image'   => $related_post_info['show_main_image'],
                'date_added'        => $this->make_time_ago($related_post_info['date_added']),
                'comments'          => ($related_post_info['comments']) ? $related_post_info['comments'] : 0,
                'viewed'            => $related_post_info['viewed'],
                'description'       => $description,
                'short_description' => $short_description,
                'image'             => $image,
                'href'              => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$related_post_info['main_category_id'].'&'.$this->_code.'_post_id='.$related_post_info['post_id'])
              ];
            }
          }

          if ($form_data['post_randomize_on_post']) {
            shuffle($data['related_posts']);
          }
        }

        $data['tags'] = [];

        if ($post_info['tag']) {
          $tags = explode(',', $post_info['tag']);

          foreach ($tags as $tag) {
            $data['tags'][] = [
              'tag'  => trim($tag),
              'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $this->_code.'_tag='.trim($tag))
            ];
          }
        }

        $data['comment_require_informations'] = [];

        if (isset($form_data['comment_require_information']) && $form_data['comment_require_information']) {
          $informations                         = $this->model_catalog_information->getInformation((int)$form_data['comment_require_information']);
          $data['comment_require_informations'] = sprintf($this->language->get('entry_require_information'), $this->url->link('information/information', 'information_id='.$form_data['comment_require_information']), $informations['title']);
        }

        $customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

        $comment_customer_groups_see = (isset($form_data['comment_customer_groups_see']) && $form_data['comment_customer_groups_see']) ? $form_data['comment_customer_groups_see'] : [];

        $data['comments'] = [];

        if (in_array($customer_group_id, $comment_customer_groups_see)) {
          $data['tab_comment'] = sprintf($this->language->get('tab_comment'), (int)$post_info['comments']);

          $filter_data = [
            'post_id' => $post_id,
            'start'   => 0,
            'limit'   => $form_data['limit_comment']
          ];

          $comment_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments($filter_data);

          $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

          foreach ($results as $result) {
            $responds = [];

            $results_responds = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCommentResponds($result['comment_id'], $post_id);

            if ($results_responds) {
              foreach ($results_responds as $respond) {
                $responds[] = [
                  'firstname'   => ($respond['comment_type'] == 1) ? $form_data['admin_nickname'] : $respond['firstname'],
                  'thumb'       => ($form_data['comment_icon_status']) ? $this->model_tool_image->resize((($respond['comment_type'] == 1) ? $form_data['admin_icon'] : $form_data['user_icon']), $form_data['icon_image_width'], $form_data['icon_image_height']) : '',
                  'description' => html_entity_decode($respond['description'], ENT_QUOTES, 'UTF-8'),
                  'date_added'  => $this->make_time_ago($respond['date_added'])
                ];
              }
            }

            $data['comments'][] = [
              'comment_id'      => $result['comment_id'],
              'firstname'       => ($result['comment_type'] == 1) ? $form_data['admin_nickname'] : $result['firstname'],
              'thumb'           => ($form_data['comment_icon_status']) ? $this->model_tool_image->resize((($result['comment_type'] == 1) ? $form_data['admin_icon'] : $form_data['user_icon']), $form_data['icon_image_width'], $form_data['icon_image_height']) : '',
              'responds'        => $responds,
              'total_vote_down' => (int)$result['total_vote_down'],
              'total_vote_up'   => (int)$result['total_vote_up'],
              'description'     => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
              'date_added'      => $this->make_time_ago($result['date_added'])
            ];
          }

          $data['pagination'] = $this->comment_pagination($comment_total, 1, $form_data['limit_comment'], '{page}');

          // $data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? ((1 - 1) * $form_data['limit_comment']) + 1 : 0, (((1 - 1) * $form_data['limit_comment']) > ($comment_total - $form_data['limit_comment'])) ? $comment_total : (((1 - 1) * $form_data['limit_comment']) + $form_data['limit_comment']), $comment_total, ceil($comment_total / $form_data['limit_comment']));
        }

        $this->{'model_extension_ocdevwizard_'.$this->_name}->updateViewed($post_id);

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/post.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/post.tpl', $data);
          } else {
            $view = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/post.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/post', $data));
        } else {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/post.tpl', $data));
        }
      } else {
        $url = '';

        if (isset($this->request->get[$this->_code.'_path'])) {
          $url .= '&'.$this->_code.'_path='.$this->request->get[$this->_code.'_path'];
        }

        if (isset($this->request->get[$this->_code.'_author_id'])) {
          $url .= '&'.$this->_code.'_author_id='.$this->request->get[$this->_code.'_author_id'];
        }

        if (isset($this->request->get[$this->_code.'_search'])) {
          $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_tag'])) {
          $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_description'])) {
          $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
        }

        if (isset($this->request->get[$this->_code.'_category_id'])) {
          $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
        }

        if (isset($this->request->get[$this->_code.'_sub_category'])) {
          $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
        }

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
          $url .= '&page='.$this->request->get['page'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['breadcrumbs'][] = [
          'text' => $this->language->get('text_error'),
          'href' => $this->url->link('product/product', $url.'&'.$this->_code.'_post_id='.$post_id)
        ];

        $this->document->setTitle($this->language->get('text_error'));

        $data['heading_title'] = $this->language->get('text_error');

        $data['text_error'] = $this->language->get('text_error');

        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/home');

        $this->response->addHeader($this->request->server['SERVER_PROTOCOL'].' 404 Not Found');

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
          } else {
            $view = $this->load->view('default/template/error/not_found.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('error/not_found', $data));
        } else {
          $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }
      }
    } else {
      $url = '';

      if (isset($this->request->get[$this->_code.'_path'])) {
        $url .= '&'.$this->_code.'_path='.$this->request->get[$this->_code.'_path'];
      }

      if (isset($this->request->get[$this->_code.'_author_id'])) {
        $url .= '&'.$this->_code.'_author_id='.$this->request->get[$this->_code.'_author_id'];
      }

      if (isset($this->request->get[$this->_code.'_search'])) {
        $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
      }

      if (isset($this->request->get[$this->_code.'_tag'])) {
        $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
      }

      if (isset($this->request->get[$this->_code.'_description'])) {
        $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
      }

      if (isset($this->request->get[$this->_code.'_category_id'])) {
        $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
      }

      if (isset($this->request->get[$this->_code.'_sub_category'])) {
        $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
      }

      if (isset($this->request->get['sort'])) {
        $url .= '&sort='.$this->request->get['sort'];
      }

      if (isset($this->request->get['order'])) {
        $url .= '&order='.$this->request->get['order'];
      }

      if (isset($this->request->get['page'])) {
        $url .= '&page='.$this->request->get['page'];
      }

      if (isset($this->request->get['limit'])) {
        $url .= '&limit='.$this->request->get['limit'];
      }

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_error'),
        'href' => $this->url->link('product/product', $url.'&'.$this->_code.'_post_id='.$post_id)
      ];

      $this->document->setTitle($this->language->get('text_error'));

      $data['heading_title'] = $this->language->get('text_error');

      $data['text_error'] = $this->language->get('text_error');

      $data['button_continue'] = $this->language->get('button_continue');

      $data['continue'] = $this->url->link('common/home');

      $this->response->addHeader($this->request->server['SERVER_PROTOCOL'].' 404 Not Found');

      $data['column_left']    = $this->load->controller('common/column_left');
      $data['column_right']   = $this->load->controller('common/column_right');
      $data['content_top']    = $this->load->controller('common/content_top');
      $data['content_bottom'] = $this->load->controller('common/content_bottom');
      $data['content_ban1'] = $this->load->controller('common/content_ban1');
      $data['footer']         = $this->load->controller('common/footer');
      $data['header1']         = $this->load->controller('common/header1');

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
        } else {
          $view = $this->load->view('default/template/error/not_found.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('error/not_found', $data));
      } else {
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
      }
    }
  }

  public function comments() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data['_name'] = $this->_name;
    $data['_code'] = $this->_code;

    $form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $data = array_merge($data, $this->load->language('extension/ocdevwizard/'.$this->_name), $form_data);

    $customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $customer_groups = (isset($form_data['comment_customer_groups_see']) && $form_data['comment_customer_groups_see']) ? $form_data['comment_customer_groups_see'] : [];

    if (isset($this->request->get['post_id'])) {
      $post_id = (int)$this->request->get['post_id'];
    } else {
      $post_id = 0;
    }

    $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($post_id);

    if ($post_info && in_array($customer_group_id, $customer_groups)) {
      if (isset($this->request->get['page'])) {
        $page = $this->request->get['page'];
      } else {
        $page = 1;
      }

      $limit = $form_data['limit_comment'];

      $data['comments'] = [];

      $filter_data = [
        'post_id' => $post_id,
        'start'   => ($page - 1) * $limit,
        'limit'   => $limit
      ];

      $comment_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments($filter_data);

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

      foreach ($results as $result) {
        $responds = [];

        $results_responds = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCommentResponds($result['comment_id'], $post_id);

        if ($results_responds) {
          foreach ($results_responds as $respond) {
            $responds[] = [
              'firstname'   => ($respond['comment_type'] == 1) ? $form_data['admin_nickname'] : $respond['firstname'],
              'thumb'       => ($form_data['comment_icon_status']) ? $this->model_tool_image->resize((($respond['comment_type'] == 1) ? $form_data['admin_icon'] : $form_data['user_icon']), $form_data['icon_image_width'], $form_data['icon_image_height']) : '',
              'description' => html_entity_decode($respond['description'], ENT_QUOTES, 'UTF-8'),
              'date_added'  => $this->make_time_ago($respond['date_added'])
            ];
          }
        }

        $data['comments'][] = [
          'comment_id'      => $result['comment_id'],
          'firstname'       => ($result['comment_type'] == 1) ? $form_data['admin_nickname'] : $result['firstname'],
          'thumb'           => ($form_data['comment_icon_status']) ? $this->model_tool_image->resize((($result['comment_type'] == 1) ? $form_data['admin_icon'] : $form_data['user_icon']), $form_data['icon_image_width'], $form_data['icon_image_height']) : '',
          'responds'        => $responds,
          'total_vote_down' => (int)$result['total_vote_down'],
          'total_vote_up'   => (int)$result['total_vote_up'],
          'description'     => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
          'date_added'      => $this->make_time_ago($result['date_added'])
        ];
      }

      $data['pagination'] = $this->comment_pagination($comment_total, $page, $limit, '{page}');

      // $data['results'] = sprintf($this->language->get('text_pagination'), ($comment_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($comment_total - $limit)) ? $comment_total : ((($page - 1) * $limit) + $limit), $comment_total, ceil($comment_total / $limit));

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/comments.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/comments.tpl', $data);
        } else {
          $view = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/comments.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comments', $data));
      } else {
        $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comments.tpl', $data));
      }
    }
  }

  public function comment_pagination($c_total, $c_page, $c_limit, $c_url) {
    $this->load->language('extension/ocdevwizard/'.$this->_name);

    $total = $c_total;

    if ($c_page < 1) {
      $page = 1;
    } else {
      $page = $c_page;
    }

    if (!(int)$c_limit) {
      $limit = 10;
    } else {
      $limit = $c_limit;
    }

    $num_pages = ceil($total / $limit);

    $c_url = str_replace('%7Bpage%7D', '{page}', $c_url);

    $output = '<div class="pagination">';

    if ($num_pages > 1) {
      $start = 2;
      $end   = $num_pages;

      for ($i = $start; $i <= $end; $i++) {
        if ($page == $i || $start == $i) {
          $output .= '<button type="button" onclick="show_more_comments('.$i.', this);" class="comment-pagination-item btn btn-default" style="display:block">'.$this->language->get('button_show_more_comment').'</button>';
        } else {
          $output .= '<button type="button" onclick="show_more_comments('.$i.', this);" class="comment-pagination-item btn btn-default">'.$this->language->get('button_show_more_comment').'</button>';
        }
      }
    }

    $output .= '</div>';

    if ($num_pages > 1) {
      return $output;
    } else {
      return '';
    }
  }

  public function write_comment() {
    $json = [];

    $models = [
      'tool/image',
      'catalog/information',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $customer_groups = (isset($form_data['comment_customer_groups_write']) && $form_data['comment_customer_groups_write']) ? $form_data['comment_customer_groups_write'] : [];

    if (isset($this->request->get['comment_id']) && !empty($this->request->get['comment_id'])) {
      $comment_id = $this->request->get['comment_id'];
    } else {
      $comment_id = 0;
    }

    if (isset($this->request->get['post_id']) && !empty($this->request->get['post_id'])) {
      $post_id = $this->request->get['post_id'];
    } else {
      $post_id = 0;
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && $post_id) {
      if (!in_array($customer_group_id, $customer_groups)) {
        $json['error']['warning'] = $this->language->get('error_not_allowed_comment');
      }

      if ((utf8_strlen($this->request->request['firstname']) < 3) || (utf8_strlen($this->request->request['firstname']) > 25)) {
        $json['error']['field']['firstname'] = $this->language->get('error_firstname');
      }

      if ((utf8_strlen($this->request->request['description']) < 1) || (utf8_strlen($this->request->request['description']) > 5000)) {
        $json['error']['field']['description'] = $this->language->get('error_description');
      }

      if ($form_data['allow_notification_on_respond'] == 1 && isset($this->request->request['notification_on_respond']) && $this->request->request['notification_on_respond'] == 1) {
        if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->request['email'])) {
          $json['error']['field']['email'] = $this->language->get('error_email');
        }

        if ($this->{'model_extension_ocdevwizard_'.$this->_name}->checkBanned($this->request->request['email'], $this->request->server['REMOTE_ADDR'])) {
          $json['error']['warning'] = $this->language->get('error_banned_comment');
        }
      } else {
        if ($this->{'model_extension_ocdevwizard_'.$this->_name}->checkBanned('', $this->request->server['REMOTE_ADDR'])) {
          $json['error']['warning'] = $this->language->get('error_banned_comment');
        }
      }

      if (!isset($this->request->request['comment_require_information']) || empty($this->request->request['comment_require_information'])) {
        if (isset($form_data['comment_require_information']) && $form_data['comment_require_information']) {
          $informations                                          = (array)$this->model_catalog_information->getInformation((int)$form_data['comment_require_information']);
          $json['error']['field']['comment_require_information'] = sprintf($this->language->get('error_require_information'), $informations['title']);
        }
      }

      if ($form_data['captcha_status'] && (!isset($this->session->data[$this->_code.'_gcapcha']) || empty($this->session->data[$this->_code.'_gcapcha']))) {
        $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($form_data['captcha_secret_key']).'&response='.$this->request->request['g-recaptcha-response'].'&remoteip='.$this->request->server['REMOTE_ADDR']);

        $recaptcha = json_decode($recaptcha, true);

        if ($recaptcha['success']) {
          $this->session->data[$this->_code.'_gcapcha'] = true;
        } else {
          $json['error']['field']['recaptcha'] = $this->language->get('error_recaptcha');
        }
      }

      if (!isset($json['error'])) {
        $language_id = $this->{'model_extension_ocdevwizard_'.$this->_name}->getLanguageByCode($this->session->data['language']);

        $store_id   = $this->config->get('config_store_id');
        $store_name = $this->config->get('config_name');
        $store_url  = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) ? HTTPS_SERVER : HTTP_SERVER;

        if ($store_id != 0) {
          $store_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getStore($store_id);

          if ($store_info) {
            $store_name = $store_info['name'];
            $store_url  = (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) ? $store_info['ssl'] : $store_info['url'];
          }
        }

        if (isset($this->request->server['HTTP_USER_AGENT'])) {
          $user_agent = $this->request->server['HTTP_USER_AGENT'];
        } else {
          $user_agent = '';
        }

        if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
          $accept_language = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
        } else {
          $accept_language = '';
        }

        $email = (isset($this->request->request['email'])) ? strip_tags($this->request->request['email']) : '';

        if (version_compare(VERSION, '2.0.3.1', '<=')) {
          $salt = substr(md5(uniqid(rand(), true)), 0, 9);
        } else {
          $salt = token(9);
        }

        $token = md5(sha1($salt.sha1($salt.sha1($post_id))).$email);

        $filter_data = [
          'post_id'                 => $post_id,
          'respond_id'              => $comment_id,
          'status'                  => ($form_data['comment_premoderation'] == 1) ? 0 : 1,
          'notification_on_respond' => ($form_data['allow_notification_on_respond'] == 1 && isset($this->request->request['notification_on_respond']) && $this->request->request['notification_on_respond'] == 1) ? 1 : 0,
          'firstname'               => strip_tags($this->request->request['firstname']),
          'email'                   => $email,
          'description'             => strip_tags($this->request->request['description']),
          'token'                   => ($form_data['allow_notification_on_respond'] == 1 && isset($this->request->request['notification_on_respond']) && $this->request->request['notification_on_respond'] == 1) ? $token : '',
          'user_agent'              => $user_agent,
          'accept_language'         => $accept_language,
          'user_language_id'        => $language_id,
          'store_name'              => $store_name,
          'store_url'               => $store_url,
          'store_id'                => $store_id
        ];

        $json['success'] = $this->language->get('text_comment_success');

        $comment_id = $this->{'model_extension_ocdevwizard_'.$this->_name}->addComment($filter_data);

        $json['comment'] = [];

        if ($comment_id && !$form_data['comment_premoderation']) {
          $comment_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment($comment_id);

          if ($comment_info) {
            $json['comment'][] = [
              'comment_id'  => $comment_info['comment_id'],
              'firstname'   => $comment_info['firstname'],
              'thumb'       => ($form_data['comment_icon_status']) ? $this->model_tool_image->resize($form_data['user_icon'], $form_data['icon_image_width'], $form_data['icon_image_height']) : '',
              'description' => html_entity_decode($comment_info['description'], ENT_QUOTES, 'UTF-8'),
              'date_added'  => $this->make_time_ago($comment_info['date_added'])
            ];
          }
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function vote() {
    $json = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $customer_group_id = ($this->customer->isLogged()) ? (int)$this->customer->getGroupId() : (int)$this->config->get('config_customer_group_id');

    $customer_groups = (isset($form_data['vote_customer_groups']) && $form_data['vote_customer_groups']) ? $form_data['vote_customer_groups'] : [];

    if ($this->request->server['REQUEST_METHOD'] == 'GET') {
      if (!in_array($customer_group_id, $customer_groups)) {
        $json['error']['warning'] = $this->language->get('error_not_allowed_vote');
      }

      if (isset($this->request->get['comment_id']) && !empty($this->request->get['comment_id'])) {
        $comment_id = $this->request->get['comment_id'];
      } else {
        $comment_id = 0;
      }

      if (isset($this->request->get['post_id']) && !empty($this->request->get['post_id'])) {
        $post_id = $this->request->get['post_id'];
      } else {
        $post_id = 0;
      }

      if (!$post_id && !$comment_id) {
        $json['error']['warning'] = $this->language->get('error_vote_ids');
      }

      if ($this->{'model_extension_ocdevwizard_'.$this->_name}->checkBanned('', $this->request->server['REMOTE_ADDR'])) {
        $json['error']['warning'] = $this->language->get('error_banned_vote');
      }

      $filter_data = [
        'comment_id'   => $comment_id,
        'post_id'      => $post_id,
        'content_type' => ($this->request->get['content_type'] == 'post') ? 1 : 2,
        'ip'           => $this->request->server['REMOTE_ADDR']
      ];

      if ($this->{'model_extension_ocdevwizard_'.$this->_name}->checkVote($filter_data)) {
        $json['error']['warning'] = $this->language->get('error_already_vote');
      }

      if (!isset($json['error'])) {
        $filter_data = [
          'comment_id'   => $comment_id,
          'post_id'      => $post_id,
          'content_type' => ($this->request->get['content_type'] == 'post') ? 1 : 2,
          'rating_type'  => ($this->request->get['rating_type'] == 'up') ? 1 : 0,
          'ip'           => $this->request->server['REMOTE_ADDR']
        ];

        $this->{'model_extension_ocdevwizard_'.$this->_name}->addVote($filter_data);

        $json['post_vote_down']    = 0;
        $json['post_vote_up']      = 0;
        $json['comment_vote_down'] = 0;
        $json['comment_vote_up']   = 0;

        if ($this->request->get['content_type'] == 'post') {
          $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($post_id);

          $json['post_vote_down'] = $post_info['total_vote_down'];
          $json['post_vote_up']   = $post_info['total_vote_up'];
        }

        if ($this->request->get['content_type'] == 'comment') {
          $comment_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment($comment_id);

          $json['comment_vote_down'] = $comment_info['total_vote_down'];
          $json['comment_vote_up']   = $comment_info['total_vote_up'];
        }

        $json['success'] = $this->language->get('text_vote_success');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function category() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $data = array_merge($data, $this->load->language('extension/ocdevwizard/'.$this->_name), $form_data);

    $data['_name'] = $this->_name;
    $data['_code'] = $this->_code;

    if (isset($form_data['activate']) && $form_data['activate']) {

      if (isset($this->request->get['sort'])) {
        $sort = $this->request->get['sort'];
      } else {
        $sort = 'p.sort_order';
      }

      if (isset($this->request->get['order'])) {
        $order = $this->request->get['order'];
      } else {
        $order = 'ASC';
      }

      if (isset($this->request->get['page'])) {
        $page = $this->request->get['page'];
      } else {
        $page = 1;
      }

      if (isset($this->request->get['limit'])) {
        $limit = $this->request->get['limit'];
      } else {
        $limit = $form_data['limit_post_on_category'];
      }

      $data['breadcrumbs'] = [];

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
      ];

      if (isset($this->request->get[$this->_code.'_path'])) {
        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $path = '';

        $parts = explode('_', (string)$this->request->get[$this->_code.'_path']);

        $category_id = (int)array_pop($parts);

        foreach ($parts as $path_id) {
          if (!$path) {
            $path = (int)$path_id;
          } else {
            $path .= '_'.(int)$path_id;
          }

          $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($path_id);

          if ($category_info) {
            $data['breadcrumbs'][] = [
              'text' => $category_info['name'],
              'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$path.$url)
            ];
          }
        }
      } else {
        $category_id = 0;
      }

      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($category_id);

      if ($category_info) {
        $this->document->setTitle($category_info['meta_title']);
        $this->document->setDescription($category_info['meta_description']);
        $this->document->setKeywords($category_info['meta_keyword']);
        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path']), 'canonical');
        $this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
        $this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

        $data['heading_title']         = $category_info['name'];
        $data['show_main_image']       = $category_info['show_main_image'];
        $data['show_additional_image'] = $category_info['show_additional_image'];
        $data['show_description']      = $category_info['show_description'];
        $data['description_position']  = $category_info['description_position'];
        $data['show_subcategories']    = $category_info['show_subcategories'];
        $data['thumb']                 = ($category_info['image'] && $category_info['show_main_image']) ? $this->model_tool_image->resize($category_info['image'], $category_info['main_image_width'], $category_info['main_image_height']) : '';
        $data['popup']                 = ($category_info['image'] && $category_info['show_main_image']) ? $this->model_tool_image->resize($category_info['image'], $category_info['additional_image_popup_width'], $category_info['additional_image_popup_height']) : '';
        $data['description']           = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
        $data['main_image_alt']        = $category_info['main_image_alt'] ? $category_info['main_image_alt'] : $category_info['name'];

        $data['images'] = [];

        $images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryImages($category_id);

        foreach ($images as $image) {
          $data['images'][] = [
            'popup' => $this->model_tool_image->resize($image['image'], $category_info['additional_image_popup_width'], $category_info['additional_image_popup_height']),
            'thumb' => $this->model_tool_image->resize($image['image'], $category_info['additional_image_width'], $category_info['additional_image_height'])
          ];
        }

        $data['images_other']       = [];
        $data['images_other_total'] = 0;

        if (count($images) >= 4) {
          $data['images_other'] = array_slice($data['images'], 4);

          $data['images_other_total'] = count($data['images_other']);

          $data['images'] = array_slice($data['images'], 0, 3, true);
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
          $url .= '&page='.$this->request->get['page'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['breadcrumbs'][] = [
          'text' => $category_info['name'],
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'])
        ];

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['categories'] = [];

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($category_id);

        foreach ($results as $result) {
          $filter_data = [
            'filter_category_id'  => $result[$this->_code.'_category_id'],
            'filter_sub_category' => true
          ];

          $image          = ($result['image']) ? $this->model_tool_image->resize($result['image'], $form_data['additional_image_width_on_category'], $form_data['additional_image_height_on_category']) : $this->model_tool_image->resize("no_image.png", $form_data['additional_image_width_on_category'], $form_data['additional_image_height_on_category']);
          $main_image_alt = $result['main_image_alt'] ? $result['main_image_alt'] : $result['name'];

          $data['categories'][] = [
            'name'           => $result['name'].(($category_info['show_subcategories_total'] == 1) ? ' ('.$this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts($filter_data).')' : ''),
            'main_image_alt' => $main_image_alt,
            'thumb'          => $image,
            'href'           => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'_'.$result[$this->_code.'_category_id'].$url)
          ];
        }

        $data['posts'] = [];

        $filter_data = [
          'filter_category_id' => $category_id,
          'sort'               => $sort,
          'order'              => $order,
          'start'              => ($page - 1) * $limit,
          'limit'              => $limit
        ];

        $post_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts($filter_data);

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

        foreach ($results as $result) {
          $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']);

          $description = (utf8_strlen(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))) > 0) ? utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_category']).'..' : '';

          $short_description = (utf8_strlen(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'))) > 0) ? utf8_substr(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_category']).'..' : '';

          $main_image_alt = $result['main_image_alt'] ? $result['main_image_alt'] : $result['name'];

          $data['posts'][] = [
            'post_id'           => $result['post_id'],
            'name'              => $result['name'],
            'main_image_alt'    => $main_image_alt,
            'author'            => $result['author'],
            'video'             => $result['video'],
            'show_main_image'   => $result['show_main_image'],
            'date_added'        => $this->make_time_ago($result['date_added']),
            'comments'          => ($result['comments']) ? $result['comments'] : 0,
            'viewed'            => $result['viewed'],
            'description'       => $description,
            'short_description' => $short_description,
            'image'             => $image,
            'href'              => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$result['main_category_id'].'&'.$this->_code.'_post_id='.$result['post_id'].$url)
          ];
        }

        $url = '';

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['sorts'] = [];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_asc'),
          'value' => 'pd.name-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=pd.name&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_desc'),
          'value' => 'pd.name-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=pd.name&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_asc'),
          'value' => 'p.sort_order-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.sort_order&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_desc'),
          'value' => 'p.sort_order-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.sort_order&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_asc'),
          'value' => 'p.date_added-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.date_added&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_desc'),
          'value' => 'p.date_added-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.date_added&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_asc'),
          'value' => 'p.viewed-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.viewed&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_desc'),
          'value' => 'p.viewed-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=p.viewed&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_asc'),
          'value' => 'comments-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=comments&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_desc'),
          'value' => 'comments-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].'&sort=comments&order=DESC'.$url)
        ];

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        $data['limits'] = [];

        $limits = array_unique([
          $form_data['limit_post_on_category'],
          25,
          50,
          75,
          100
        ]);

        sort($limits);

        foreach ($limits as $value) {
          $data['limits'][] = [
            'text'  => $value,
            'value' => $value,
            'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url.'&limit='.$value)
          ];
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $pagination        = new Pagination();
        $pagination->total = $post_total;
        $pagination->page  = $page;
        $pagination->limit = $limit;
        $pagination->url   = $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url.'&page={page}');

        $data['pagination'] = $pagination->render();

        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url.'&page='.$pagination->page), 'canonical');

        if ($pagination->limit && ceil($pagination->total / $pagination->limit) > $pagination->page) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url.'&page='.($pagination->page + 1)), 'next');
        }

        if ($pagination->page > 1) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url.'&page='.($pagination->page - 1)), 'prev');
        }

        $data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($post_total - $limit)) ? $post_total : ((($page - 1) * $limit) + $limit), $post_total, ceil($post_total / $limit));

        $data['sort']  = $sort;
        $data['order'] = $order;
        $data['limit'] = $limit;

        $data['continue'] = $this->url->link('common/home');

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/category.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/category.tpl', $data);
          } else {
            $view = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/category.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/category', $data));
        } else {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/category.tpl', $data));
        }
      } else {
        $data['breadcrumbs'][] = [
          'text' => $this->language->get('text_error'),
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$this->request->get[$this->_code.'_path'].$url)
        ];

        $this->document->setTitle($this->language->get('text_error'));

        $data['heading_title'] = $this->language->get('text_error');

        $data['text_error'] = $this->language->get('text_error');

        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/home');

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
          } else {
            $view = $this->load->view('default/template/error/not_found.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('error/not_found', $data));
        } else {
          $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }
      }
    } else {
      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_error'),
        'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category')
      ];

      $this->document->setTitle($this->language->get('text_error'));

      $data['heading_title'] = $this->language->get('text_error');

      $data['text_error'] = $this->language->get('text_error');

      $data['button_continue'] = $this->language->get('button_continue');

      $data['continue'] = $this->url->link('common/home');

      $data['column_left']    = $this->load->controller('common/column_left');
      $data['column_right']   = $this->load->controller('common/column_right');
      $data['content_top']    = $this->load->controller('common/content_top');
      $data['content_bottom'] = $this->load->controller('common/content_bottom');
      $data['content_ban1'] = $this->load->controller('common/content_ban1');
      $data['footer']         = $this->load->controller('common/footer');
      $data['header1']         = $this->load->controller('common/header1');

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
        } else {
          $view = $this->load->view('default/template/error/not_found.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('error/not_found', $data));
      } else {
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
      }
    }
  }

  public function author() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $data = array_merge($data, $this->load->language('extension/ocdevwizard/'.$this->_name), $form_data);

    $data['_name'] = $this->_name;
    $data['_code'] = $this->_code;

    if (isset($form_data['activate']) && $form_data['activate']) {

      if (isset($this->request->get[$this->_code.'_author_id'])) {
        $author_id = (int)$this->request->get[$this->_code.'_author_id'];
      } else {
        $author_id = 0;
      }

      if (isset($this->request->get['sort'])) {
        $sort = $this->request->get['sort'];
      } else {
        $sort = 'p.sort_order';
      }

      if (isset($this->request->get['order'])) {
        $order = $this->request->get['order'];
      } else {
        $order = 'ASC';
      }

      if (isset($this->request->get['page'])) {
        $page = $this->request->get['page'];
      } else {
        $page = 1;
      }

      if (isset($this->request->get['limit'])) {
        $limit = $this->request->get['limit'];
      } else {
        $limit = $form_data['limit_post_on_author'];
      }

      $data['breadcrumbs'] = [];

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
      ];

      $author_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor($author_id);

      if ($author_info) {
        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
          $url .= '&page='.$this->request->get['page'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['breadcrumbs'][] = [
          'text' => $author_info['name'],
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id)
        ];

        $this->document->setTitle($author_info['meta_title']);
        $this->document->setDescription($author_info['meta_description']);
        $this->document->setKeywords($author_info['meta_keyword']);
        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id), 'canonical');
        $this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
        $this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

        $data['heading_title']         = $author_info['name'];
        $data['show_main_image']       = $author_info['show_main_image'];
        $data['show_additional_image'] = $author_info['show_additional_image'];
        $data['show_description']      = $author_info['show_description'];
        $data['description_position']  = $author_info['description_position'];
        $data['thumb']                 = ($author_info['image'] && $author_info['show_main_image']) ? $this->model_tool_image->resize($author_info['image'], $author_info['main_image_width'], $author_info['main_image_height']) : '';
        $data['popup']                 = ($author_info['image'] && $author_info['show_main_image']) ? $this->model_tool_image->resize($author_info['image'], $author_info['additional_image_popup_width'], $author_info['additional_image_popup_height']) : '';
        $data['description']           = html_entity_decode($author_info['description'], ENT_QUOTES, 'UTF-8');

        $data['images'] = [];

        $images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorImages($author_id);

        foreach ($images as $image) {
          $data['images'][] = [
            'popup' => $this->model_tool_image->resize($image['image'], $author_info['additional_image_popup_width'], $author_info['additional_image_popup_height']),
            'thumb' => $this->model_tool_image->resize($image['image'], $author_info['additional_image_width'], $author_info['additional_image_height'])
          ];
        }

        $data['images_other']       = [];
        $data['images_other_total'] = 0;

        if (count($images) >= 4) {
          $data['images_other'] = array_slice($data['images'], 4);

          $data['images_other_total'] = count($data['images_other']);

          $data['images'] = array_slice($data['images'], 0, 3, true);
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['posts'] = [];

        $filter_data = [
          'filter_author_id' => $author_id,
          'sort'             => $sort,
          'order'            => $order,
          'start'            => ($page - 1) * $limit,
          'limit'            => $limit
        ];

        $post_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts($filter_data);

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

        foreach ($results as $result) {
          $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $form_data['post_image_width_on_author'], $form_data['post_image_height_on_author']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_author'], $form_data['post_image_height_on_author']);

          if (utf8_strlen(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))) > 0) {
            $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_author']).'..';
          } else {
            $description = '';
          }

          if (utf8_strlen(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'))) > 0) {
            $short_description = utf8_substr(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_author']).'..';
          } else {
            $short_description = '';
          }

          $data['posts'][] = [
            'post_id'           => $result['post_id'],
            'name'              => $result['name'],
            'author'            => $result['author'],
            'video'             => $result['video'],
            'show_main_image'   => $result['show_main_image'],
            'date_added'        => $this->make_time_ago($result['date_added']),
            'comments'          => ($result['comments']) ? $result['comments'] : 0,
            'viewed'            => $result['viewed'],
            'description'       => $description,
            'short_description' => $short_description,
            'image'             => $image,
            'href'              => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$result['main_category_id'].'&'.$this->_code.'_post_id='.$result['post_id'].$url)
          ];
        }

        $url = '';

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['sorts'] = [];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_asc'),
          'value' => 'pd.name-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=pd.name&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_desc'),
          'value' => 'pd.name-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=pd.name&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_asc'),
          'value' => 'p.sort_order-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.sort_order&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_desc'),
          'value' => 'p.sort_order-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.sort_order&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_asc'),
          'value' => 'p.date_added-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.date_added&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_desc'),
          'value' => 'p.date_added-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.date_added&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_asc'),
          'value' => 'p.viewed-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.viewed&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_desc'),
          'value' => 'p.viewed-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=p.viewed&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_asc'),
          'value' => 'comments-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=comments&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_desc'),
          'value' => 'comments-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.'&sort=comments&order=DESC'.$url)
        ];

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        $data['limits'] = [];

        $limits = array_unique([
          $form_data['limit_post_on_author'],
          25,
          50,
          75,
          100
        ]);

        sort($limits);

        foreach ($limits as $value) {
          $data['limits'][] = [
            'text'  => $value,
            'value' => $value,
            'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url.'&limit='.$value)
          ];
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $pagination        = new Pagination();
        $pagination->total = $post_total;
        $pagination->page  = $page;
        $pagination->limit = $limit;
        $pagination->url   = $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url.'&page={page}');

        $data['pagination'] = $pagination->render();

        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url.'&page='.$pagination->page), 'canonical');

        if ($pagination->limit && ceil($pagination->total / $pagination->limit) > $pagination->page) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url.'&page='.($pagination->page + 1)), 'next');
        }

        if ($pagination->page > 1) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url.'&page='.($pagination->page - 1)), 'prev');
        }

        $data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($post_total - $limit)) ? $post_total : ((($page - 1) * $limit) + $limit), $post_total, ceil($post_total / $limit));

        $data['sort']  = $sort;
        $data['order'] = $order;
        $data['limit'] = $limit;

        $data['continue'] = $this->url->link('common/home');

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/author.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/author.tpl', $data);
          } else {
            $view = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/author.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/author', $data));
        } else {
          $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/author.tpl', $data));
        }
      } else {
        $data['breadcrumbs'][] = [
          'text' => $this->language->get('text_error'),
          'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author', $this->_code.'_author_id='.$author_id.$url)
        ];

        $this->document->setTitle($this->language->get('text_error'));

        $data['heading_title'] = $this->language->get('text_error');

        $data['text_error'] = $this->language->get('text_error');

        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/home');

        $data['column_left']    = $this->load->controller('common/column_left');
        $data['column_right']   = $this->load->controller('common/column_right');
        $data['content_top']    = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['content_ban1'] = $this->load->controller('common/content_ban1');
        $data['footer']         = $this->load->controller('common/footer');
        $data['header1']         = $this->load->controller('common/header1');

        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
            $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
          } else {
            $view = $this->load->view('default/template/error/not_found.tpl', $data);
          }

          $this->response->setOutput($view);
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          $this->response->setOutput($this->load->view('error/not_found', $data));
        } else {
          $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }
      }
    } else {
      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_error'),
        'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/author')
      ];

      $this->document->setTitle($this->language->get('text_error'));

      $data['heading_title'] = $this->language->get('text_error');

      $data['text_error'] = $this->language->get('text_error');

      $data['button_continue'] = $this->language->get('button_continue');

      $data['continue'] = $this->url->link('common/home');

      $data['column_left']    = $this->load->controller('common/column_left');
      $data['column_right']   = $this->load->controller('common/column_right');
      $data['content_top']    = $this->load->controller('common/content_top');
      $data['content_bottom'] = $this->load->controller('common/content_bottom');
      $data['content_ban1'] = $this->load->controller('common/content_ban1');
      $data['footer']         = $this->load->controller('common/footer');
      $data['header1']         = $this->load->controller('common/header1');

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
        } else {
          $view = $this->load->view('default/template/error/not_found.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('error/not_found', $data));
      } else {
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
      }
    }
  }

  public function search() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $data = array_merge($data, $this->load->language('extension/ocdevwizard/'.$this->_name), $form_data);

    $data['_name'] = $this->_name;
    $data['_code'] = $this->_code;

    if (isset($form_data['activate']) && $form_data['activate']) {
      if (isset($this->request->get[$this->_code.'_search'])) {
        $search = $this->request->get[$this->_code.'_search'];
      } else {
        $search = '';
      }

      if (isset($this->request->get[$this->_code.'_tag'])) {
        $tag = $this->request->get[$this->_code.'_tag'];
      } else if (isset($this->request->get[$this->_code.'_search'])) {
        $tag = $this->request->get[$this->_code.'_search'];
      } else {
        $tag = '';
      }

      if (isset($this->request->get[$this->_code.'_description'])) {
        $description = $this->request->get[$this->_code.'_description'];
      } else {
        $description = '';
      }

      if (isset($this->request->get[$this->_code.'_category_id'])) {
        $category_id = $this->request->get[$this->_code.'_category_id'];
      } else {
        $category_id = 0;
      }

      if (isset($this->request->get[$this->_code.'_sub_category'])) {
        $sub_category = $this->request->get[$this->_code.'_sub_category'];
      } else {
        $sub_category = '';
      }

      if (isset($this->request->get[$this->_code.'_archive'])) {
        $archive = $this->request->get[$this->_code.'_archive'];
      } else {
        $archive = '';
      }

      if (isset($this->request->get['sort'])) {
        $sort = $this->request->get['sort'];
      } else {
        $sort = 'p.sort_order';
      }

      if (isset($this->request->get['order'])) {
        $order = $this->request->get['order'];
      } else {
        $order = 'ASC';
      }

      if (isset($this->request->get['page'])) {
        $page = $this->request->get['page'];
      } else {
        $page = 1;
      }

      if (isset($this->request->get['limit'])) {
        $limit = $this->request->get['limit'];
      } else {
        $limit = $form_data['limit_post_on_search'];
      }

      $data['breadcrumbs'] = [];

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/home')
      ];

      if (isset($this->request->get[$this->_code.'_search'])) {
        $this->document->setTitle($this->language->get('heading_title').' - '.$this->request->get[$this->_code.'_search']);
      } else if (isset($this->request->get[$this->_code.'_tag'])) {
        $this->document->setTitle($this->language->get('heading_title').' - '.$this->language->get('heading_tag').$this->request->get[$this->_code.'_tag']);
      } else {
        $this->document->setTitle($this->language->get('heading_title'));
      }

      $url = '';

      if (isset($this->request->get[$this->_code.'_search'])) {
        $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
      }

      if (isset($this->request->get[$this->_code.'_tag'])) {
        $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
      }

      if (isset($this->request->get[$this->_code.'_description'])) {
        $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
      }

      if (isset($this->request->get[$this->_code.'_category_id'])) {
        $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
      }

      if (isset($this->request->get[$this->_code.'_sub_category'])) {
        $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
      }

      if (isset($this->request->get[$this->_code.'_archive'])) {
        $url .= '&'.$this->_code.'_archive='.$this->request->get[$this->_code.'_archive'];
      }

      if (isset($this->request->get['sort'])) {
        $url .= '&sort='.$this->request->get['sort'];
      }

      if (isset($this->request->get['order'])) {
        $url .= '&order='.$this->request->get['order'];
      }

      if (isset($this->request->get['page'])) {
        $url .= '&page='.$this->request->get['page'];
      }

      if (isset($this->request->get['limit'])) {
        $url .= '&limit='.$this->request->get['limit'];
      }

      $data['breadcrumbs'][] = [
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url)
      ];

      if (isset($this->request->get[$this->_code.'_search'])) {
        $data['heading_title'] = $this->language->get('heading_title').' - '.$this->request->get[$this->_code.'_search'];
      } else {
        $data['heading_title'] = $this->language->get('heading_title');
      }

      // 3 Level Category Search
      $data['categories'] = [];

      $categories_1 = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories(0);

      foreach ($categories_1 as $category_1) {
        $level_2_data = [];

        $categories_2 = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($category_1[$this->_code.'_category_id']);

        foreach ($categories_2 as $category_2) {
          $level_3_data = [];

          $categories_3 = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($category_2[$this->_code.'_category_id']);

          foreach ($categories_3 as $category_3) {
            $level_3_data[] = [
              'category_id' => $category_3[$this->_code.'_category_id'],
              'name'        => $category_3['name'],
            ];
          }

          $level_2_data[] = [
            'category_id' => $category_2[$this->_code.'_category_id'],
            'name'        => $category_2['name'],
            'children'    => $level_3_data
          ];
        }

        $data['categories'][] = [
          'category_id' => $category_1[$this->_code.'_category_id'],
          'name'        => $category_1['name'],
          'children'    => $level_2_data
        ];
      }

      $data['posts'] = [];

      if (isset($this->request->get[$this->_code.'_search']) || isset($this->request->get[$this->_code.'_archive']) || isset($this->request->get[$this->_code.'_tag'])) {
        $filter_data = [
          'filter_name'         => $search,
          'filter_tag'          => $tag,
          'filter_description'  => $description,
          'filter_category_id'  => $category_id,
          'filter_sub_category' => $sub_category,
          'filter_archive'      => $archive,
          'sort'                => $sort,
          'order'               => $order,
          'start'               => ($page - 1) * $limit,
          'limit'               => $limit
        ];

        $post_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts($filter_data);

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

        foreach ($results as $result) {
          $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']);

          if (utf8_strlen(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))) > 0) {
            $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_search']).'..';
          } else {
            $description = '';
          }

          if (utf8_strlen(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'))) > 0) {
            $short_description = utf8_substr(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8')), 0, $form_data['description_limit_on_search']).'..';
          } else {
            $short_description = '';
          }

          $data['posts'][] = [
            'post_id'           => $result['post_id'],
            'name'              => $result['name'],
            'author'            => $result['author'],
            'video'             => $result['video'],
            'show_main_image'   => $result['show_main_image'],
            'date_added'        => $this->make_time_ago($result['date_added']),
            'comments'          => ($result['comments']) ? $result['comments'] : 0,
            'viewed'            => $result['viewed'],
            'description'       => $description,
            'short_description' => $short_description,
            'image'             => $image,
            'href'              => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$result['main_category_id'].'&'.$this->_code.'_post_id='.$result['post_id'].$url)
          ];
        }

        $url = '';

        if (isset($this->request->get[$this->_code.'_search'])) {
          $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_tag'])) {
          $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_description'])) {
          $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
        }

        if (isset($this->request->get[$this->_code.'_category_id'])) {
          $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
        }

        if (isset($this->request->get[$this->_code.'_sub_category'])) {
          $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
        }

        if (isset($this->request->get[$this->_code.'_archive'])) {
          $url .= '&'.$this->_code.'_archive='.$this->request->get[$this->_code.'_archive'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $data['sorts'] = [];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_asc'),
          'value' => 'pd.name-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=pd.name&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_name_desc'),
          'value' => 'pd.name-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=pd.name&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_asc'),
          'value' => 'p.sort_order-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.sort_order&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_sort_order_desc'),
          'value' => 'p.sort_order-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.sort_order&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_asc'),
          'value' => 'p.date_added-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.date_added&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_date_added_desc'),
          'value' => 'p.date_added-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.date_added&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_asc'),
          'value' => 'p.viewed-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.viewed&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_viewed_desc'),
          'value' => 'p.viewed-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=p.viewed&order=DESC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_asc'),
          'value' => 'comments-ASC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=comments&order=ASC'.$url)
        ];

        $data['sorts'][] = [
          'text'  => $this->language->get('text_comments_desc'),
          'value' => 'comments-DESC',
          'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', 'sort=comments&order=DESC'.$url)
        ];

        $url = '';

        if (isset($this->request->get[$this->_code.'_search'])) {
          $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_tag'])) {
          $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_description'])) {
          $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
        }

        if (isset($this->request->get[$this->_code.'_category_id'])) {
          $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
        }

        if (isset($this->request->get[$this->_code.'_sub_category'])) {
          $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
        }

        if (isset($this->request->get[$this->_code.'_archive'])) {
          $url .= '&'.$this->_code.'_archive='.$this->request->get[$this->_code.'_archive'];
        }

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        $data['limits'] = [];

        $limits = array_unique([
          $form_data['limit_post_on_search'],
          25,
          50,
          75,
          100
        ]);

        sort($limits);

        foreach ($limits as $value) {
          $data['limits'][] = [
            'text'  => $value,
            'value' => $value,
            'href'  => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url.'&limit='.$value)
          ];
        }

        $url = '';

        if (isset($this->request->get[$this->_code.'_search'])) {
          $url .= '&'.$this->_code.'_search='.urlencode(html_entity_decode($this->request->get[$this->_code.'_search'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_tag'])) {
          $url .= '&'.$this->_code.'_tag='.urlencode(html_entity_decode($this->request->get[$this->_code.'_tag'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get[$this->_code.'_description'])) {
          $url .= '&'.$this->_code.'_description='.$this->request->get[$this->_code.'_description'];
        }

        if (isset($this->request->get[$this->_code.'_category_id'])) {
          $url .= '&'.$this->_code.'_category_id='.$this->request->get[$this->_code.'_category_id'];
        }

        if (isset($this->request->get[$this->_code.'_sub_category'])) {
          $url .= '&'.$this->_code.'_sub_category='.$this->request->get[$this->_code.'_sub_category'];
        }

        if (isset($this->request->get[$this->_code.'_archive'])) {
          $url .= '&'.$this->_code.'_archive='.$this->request->get[$this->_code.'_archive'];
        }

        if (isset($this->request->get['sort'])) {
          $url .= '&sort='.$this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
          $url .= '&order='.$this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
          $url .= '&limit='.$this->request->get['limit'];
        }

        $pagination        = new Pagination();
        $pagination->total = $post_total;
        $pagination->page  = $page;
        $pagination->limit = $limit;
        $pagination->url   = $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url.'&page={page}');

        $data['pagination'] = $pagination->render();

        $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url.'&page='.$pagination->page), 'canonical');

        if ($pagination->limit && ceil($pagination->total / $pagination->limit) > $pagination->page) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url.'&page='.($pagination->page + 1)), 'next');
        }

        if ($pagination->page > 1) {
          $this->document->addLink($this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $url.'&page='.($pagination->page - 1)), 'prev');
        }

        $data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($post_total - $limit)) ? $post_total : ((($page - 1) * $limit) + $limit), $post_total, ceil($post_total / $limit));
      }

      $data['search']       = $search;
      $data['description']  = $description;
      $data['category_id']  = $category_id;
      $data['sub_category'] = $sub_category;
      $data['sort']         = $sort;
      $data['order']        = $order;
      $data['limit']        = $limit;

      $data['continue'] = $this->url->link('common/home');

      $data['column_left']    = $this->load->controller('common/column_left');
      $data['column_right']   = $this->load->controller('common/column_right');
      $data['content_top']    = $this->load->controller('common/content_top');
      $data['content_bottom'] = $this->load->controller('common/content_bottom');
      $data['content_ban1'] = $this->load->controller('common/content_ban1');
      $data['footer']         = $this->load->controller('common/footer');
      $data['header1']         = $this->load->controller('common/header1');

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/search.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/search.tpl', $data);
        } else {
          $view = $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/search.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/search', $data));
      } else {
        $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/search.tpl', $data));
      }
    } else {
      $data['breadcrumbs'][] = [
        'text' => $this->language->get('text_error'),
        'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search')
      ];

      $this->document->setTitle($this->language->get('text_error'));

      $data['heading_title'] = $this->language->get('text_error');

      $data['text_error'] = $this->language->get('text_error');

      $data['button_continue'] = $this->language->get('button_continue');

      $data['continue'] = $this->url->link('common/home');

      $data['column_left']    = $this->load->controller('common/column_left');
      $data['column_right']   = $this->load->controller('common/column_right');
      $data['content_top']    = $this->load->controller('common/content_top');
      $data['content_bottom'] = $this->load->controller('common/content_bottom');
      $data['content_ban1'] = $this->load->controller('common/content_ban1');
      $data['footer']         = $this->load->controller('common/footer');
      $data['header1']         = $this->load->controller('common/header1');

      if (version_compare(VERSION, '2.1.0.2', '<=')) {
        if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/error/not_found.tpl')) {
          $view = $this->load->view($this->config->get('config_template').'/template/error/not_found.tpl', $data);
        } else {
          $view = $this->load->view('default/template/error/not_found.tpl', $data);
        }

        $this->response->setOutput($view);
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->setOutput($this->load->view('error/not_found', $data));
      } else {
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
      }
    }
  }

  protected function make_time_ago($date, $type = '') {
    $time_ago     = strtotime($date);
    $cur_time     = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds      = $time_elapsed;
    $minutes      = round($time_elapsed / 60);
    $hours        = round($time_elapsed / 3600);
    $days         = round($time_elapsed / 86400);
    $weeks        = round($time_elapsed / 604800);
    $months       = round($time_elapsed / 2600640);
    $years        = round($time_elapsed / 31207680);

    if ($type == 'comment') {
      if ($seconds <= 60) {
        return $this->language->get('text_time_seconds');
      } else if ($minutes <= 60) {
        return ($minutes == 1) ? $this->language->get('text_time_minutes') : sprintf($this->language->get('text_time_minutes_1'), $minutes);
      } else if ($hours <= 24) {
        return ($hours == 1) ? $this->language->get('text_time_hours') : sprintf($this->language->get('text_time_hours_1'), $hours);
      } else if ($days <= 7) {
        return ($days == 1) ? $this->language->get('text_time_days') : sprintf($this->language->get('text_time_days_1'), $days);
      } else if ($weeks <= 4.3) {
        return ($weeks == 1) ? $this->language->get('text_time_weeks') : sprintf($this->language->get('text_time_weeks_1'), $weeks);
      } else if ($months <= 12) {
        return ($months == 1) ? $this->language->get('text_time_months') : sprintf($this->language->get('text_time_months_1'), $months);
      } else {
        return ($years == 1) ? $this->language->get('text_time_years') : sprintf($this->language->get('text_time_years_1'), $years);
      }
    } else {
      if ($seconds <= 60) {
        return $this->language->get('text_time_seconds');
      } else if ($minutes <= 60) {
        return ($minutes == 1) ? $this->language->get('text_time_minutes') : sprintf($this->language->get('text_time_minutes_1'), $minutes);
      } else if ($hours <= 24) {
        return ($hours == 1) ? $this->language->get('text_time_hours') : sprintf($this->language->get('text_time_hours_1'), $hours);
      } else {
        return date("d M Y", strtotime($date));
      }
    }
  }

  public function xml_feed() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    if (isset($form_data['activate']) && $form_data['activate'] && $form_data['activate_xml_feed']) {
      $output = '<?xml version="1.0" encoding="UTF-8"?>';
      $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

      $filter_data = [
        'filter_category_id' => 0
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

      foreach ($results as $result) {
        $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']);

        if ($image) {
          $output .= '<url>';
          $output .= '  <loc>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$result['main_category_id'].'&'.$this->_code.'_post_id='.$result['post_id']).'</loc>';
          $output .= '  <changefreq>'.$form_data['xml_feed_post_frequency'].'</changefreq>';
          $output .= '  <lastmod>'.date('Y-m-d\TH:i:sP', strtotime($result['date_modified'])).'</lastmod>';
          $output .= '  <priority>'.$form_data['xml_feed_post_priority'].'</priority>';
          $output .= '  <image:image>';
          $output .= '  <image:loc>'.$image.'</image:loc>';
          $output .= '  <image:caption>'.$result['name'].'</image:caption>';
          $output .= '  <image:title>'.$result['name'].'</image:title>';
          $output .= '  </image:image>';
          $output .= '</url>';
        }
      }

      $output .= $this->getXMLFeedCategories(0);

      $authors = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthors();

      foreach ($authors as $author) {
        $output .= '<url>';
        $output .= '  <loc>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/author_info', $this->_code.'_author_id='.$author[$this->_code.'_author_id']).'</loc>';
        $output .= '  <changefreq>'.$form_data['xml_feed_author_frequency'].'</changefreq>';
        $output .= '  <priority>'.$form_data['xml_feed_author_priority'].'</priority>';
        $output .= '</url>';

        $posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts(['filter_author_id' => $author[$this->_code.'_author_id']]);

        foreach ($posts as $post) {
          $output .= '<url>';
          $output .= '  <loc>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_author_id='.$author[$this->_code.'_author_id'].'&'.$this->_code.'_post_id='.$post['post_id']).'</loc>';
          $output .= '  <changefreq>'.$form_data['xml_feed_post_frequency'].'</changefreq>';
          $output .= '  <priority>'.$form_data['xml_feed_post_priority'].'</priority>';
          $output .= '</url>';
        }
      }

      $output .= '</urlset>';

      $this->response->addHeader('Content-Type: application/xml');
      $this->response->setOutput($output);
    }
  }

  protected function getXMLFeedCategories($parent_id, $current_path = '') {
    $models = [
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($parent_id);

    $output = '';
    foreach ($results as $result) {
      $new_path = (!$current_path) ? $result[$this->_code.'_category_id'] : $current_path.'_'.$result[$this->_code.'_category_id'];

      $output .= '<url>';
      $output .= '  <loc>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$new_path).'</loc>';
      $output .= '  <changefreq>'.$form_data['xml_feed_category_frequency'].'</changefreq>';
      $output .= '  <priority>'.$form_data['xml_feed_category_priority'].'</priority>';
      $output .= '</url>';

      $posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts(['filter_category_id' => $result[$this->_code.'_category_id']]);

      foreach ($posts as $post) {
        $output .= '<url>';
        $output .= '  <loc>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$post['main_category_id'].'&'.$this->_code.'_post_id='.$post['post_id']).'</loc>';
        $output .= '  <changefreq>'.$form_data['xml_feed_post_frequency'].'</changefreq>';
        $output .= '  <priority>'.$form_data['xml_feed_post_priority'].'</priority>';
        $output .= '</url>';
      }

      $output .= $this->getXMLFeedCategories($result[$this->_code.'_category_id'], $new_path);
    }

    return $output;
  }

  public function rss_feed() {
    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    if (isset($form_data['activate']) && $form_data['activate'] && $form_data['activate_rss_feed']) {
      $output = '<?xml version="1.0" encoding="UTF-8" ?>';
      $output .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
      $output .= '  <channel>';
      $output .= '  <title>'.$this->config->get('config_name').'</title>';
      $output .= '  <description>'.$this->config->get('config_meta_description').'</description>';
      $output .= '  <link>'.$this->config->get('config_url').'</link>';

      $post_data = [];

      $categories = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories();

      foreach ($categories as $category) {
        $filter_data = [
          'filter_category_id' => $category[$this->_code.'_category_id']
        ];

        $posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

        foreach ($posts as $post) {
          if (!in_array($post['post_id'], $post_data) && $post['description']) {

            $post_data[] = $post['post_id'];

            $output .= '<item>';
            $output .= '<title><![CDATA['.$post['name'].']]></title>';
            $output .= '<link>'.$this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$post['main_category_id'].'&'.$this->_code.'_post_id='.$post['post_id']).'</link>';
            $output .= '<description><![CDATA['.strip_tags(html_entity_decode($post['description'], ENT_QUOTES, 'UTF-8')).']]></description>';
            $output .= '<g:brand><![CDATA['.html_entity_decode($post['author'], ENT_QUOTES, 'UTF-8').']]></g:brand>';
            $output .= '<g:condition>new</g:condition>';
            $output .= '<g:id>'.$post['post_id'].'</g:id>';

            $image = ($post['image']) ? $this->model_tool_image->resize($post['image'], $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']) : $this->model_tool_image->resize("no_image.png", $form_data['post_image_width_on_category'], $form_data['post_image_height_on_category']);

            if ($post['image']) {
              $output .= '  <g:image_link>'.$image.'</g:image_link>';
            } else {
              $output .= '  <g:image_link></g:image_link>';
            }

            $output .= '  <g:post_category>'.$category[$this->_code.'_category_id'].'</g:post_category>';

            $inner_categories = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($post['post_id']);

            foreach ($inner_categories as $category) {
              $path = $this->getRSSFeedPath($category[$this->_code.'_category_id']);

              if ($path) {
                $string = '';

                foreach (explode('_', $path) as $path_id) {
                  $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($path_id);

                  if ($category_info) {
                    if (!$string) {
                      $string = $category_info['name'];
                    } else {
                      $string .= ' &gt; '.$category_info['name'];
                    }
                  }
                }

                $output .= '<g:post_type><![CDATA['.$string.']]></g:post_type>';
              }
            }

            $output .= '</item>';
          }
        }
      }

      $output .= '  </channel>';
      $output .= '</rss>';

      $this->response->addHeader('Content-Type: application/rss+xml');
      $this->response->setOutput($output);
    }
  }

  protected function getRSSFeedPath($parent_id, $current_path = '') {
    $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($parent_id);

    if ($category_info) {
      if (!$current_path) {
        $new_path = $category_info[$this->_code.'_category_id'];
      } else {
        $new_path = $category_info[$this->_code.'_category_id'].'_'.$current_path;
      }

      $path = $this->getRSSFeedPath($category_info['parent_id'], $new_path);

      if ($path) {
        return $path;
      } else {
        return $new_path;
      }
    }
  }
}

?>