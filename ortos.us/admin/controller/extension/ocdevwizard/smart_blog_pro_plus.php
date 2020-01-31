<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ControllerExtensionOcdevwizardSmartBlogProPlus extends Controller {
  private $error = [];
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';
  private $_version;
  private $_version_engine;
  private $_session_token;
  private $_ssl_code;

  public function __construct($registry) {
    parent::__construct($registry);

    if (version_compare(VERSION, '2.2.0.0', '>=')) {
      $this->_ssl_code = true;
    } else {
      $this->_ssl_code = 'SSL';
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->_session_token = 'user_token='.$this->session->data['user_token'];
    } else {
      $this->_session_token = 'token='.$this->session->data['token'];
    }

    if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name) && is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name)) {
      if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.version')) {
        $version_array = json_decode(file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.version'), true);

        if ($version_array) {
          $this->_version        = $version_array['module'];
          $this->_version_engine = $version_array['engine'];
        }
      }
    }
  }

  public function index() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $this->document->setTitle($this->language->get('heading_title'));

    $styles = ['view/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet.css'];

    foreach ($styles as $style) {
      $this->document->addStyle($style);
    }

    $data['store_id'] = $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    $this->{'model_extension_ocdevwizard_'.$this->_name}->createDBTables();

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate_access()) {
      $response_info = $this->sendCurl([], 'default', $this->request->post[$this->_name.'_license'], $store_id);

      if ($response_info['status'] == 200 && !empty($response_info['response'])) {
        $this->sendCurl([], 'default', $this->request->post[$this->_name.'_license'], $store_id);
      }

      $this->sendCurl([], 'license_key', $this->request->post[$this->_name.'_license'], $store_id);
    }

    $this->validate_engine_version();

    $data['error_warning'] = '';

    if (!empty($this->error)) {
      foreach ($this->error as $key => $error) {
        if ($key == 'compatible_version') {
          $data['error_warning'] = $error;
        } else {
          $data['error_'.$key] = $error;
        }
      }
    }

    if (!$this->user->hasPermission('access', 'extension/ocdevwizard/'.$this->_name)) {
      $data['error_warning'] = sprintf($this->language->get('error_access_permission'), $this->url->link('user/user_permission', $this->_session_token, $this->_ssl_code));
    }

    $data['breadcrumbs'] = [
      0 => [
        'text'     => $this->language->get('text_home'),
        'href'     => $this->url->link('common/dashboard', $this->_session_token, $this->_ssl_code),
        'dropdown' => []
      ],
      1 => [
        'text'     => $this->language->get('heading_title'),
        'href'     => false,
        'dropdown' => [
          0 => [
            'text'   => $this->language->get('text_setting_left_menu'),
            'href'   => $this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code),
            'active' => true
          ]
        ]
      ]
    ];

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

    $data['action']               = $this->url->link('extension/ocdevwizard/'.$this->_name, $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['uninstall']            = $this->url->link('extension/ocdevwizard/'.$this->_name.'/uninstall', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['uninstall_and_remove'] = $this->url->link('extension/ocdevwizard/'.$this->_name.'/uninstall_and_remove', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    if (version_compare(VERSION, '2.2.0.0', '<=')) {
      $data['cancel'] = $this->url->link('extension/module', $this->_session_token, $this->_ssl_code);
    } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $data['cancel'] = $this->url->link('marketplace/extension', $this->_session_token.'&type=module', $this->_ssl_code);
    } else {
      $data['cancel'] = $this->url->link('extension/extension', $this->_session_token.'&type=module', $this->_ssl_code);
    }

    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

    if (isset($this->request->post[$this->_name.'_license'])) {
      $data['license_key'] = $license_key = $this->request->post[$this->_name.'_license'];
    } else if (isset($setting_info[$this->_name.'_license'])) {
      $data['license_key'] = $license_key = $setting_info[$this->_name.'_license'];
    } else {
      $data['license_key'] = $license_key = '';
    }

    $response_info = $this->sendCurl([], 'validate_access', $license_key);

    if ($response_info['status'] == 200 && !empty($response_info['response'])) {
      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    }

    $data['header']      = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer']      = $this->load->controller('common/footer');

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/unlicensed', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/unlicensed.tpl', $data));
    }
  }

  public function base() {
    $data = [];

    $models = [
      'setting/store',
      'tool/image',
      'localisation/language',
      'catalog/information',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $this->document->setTitle($this->language->get('heading_title'));

    $scripts = [
      'view/javascript/ocdevwizard/'.$this->_name.'/codemirror/lib/codemirror.js',
      'view/javascript/ocdevwizard/'.$this->_name.'/codemirror/lib/css.js',
      'view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js'
    ];

    if (version_compare(VERSION, '2.3.0.2.3', '<')) {
      $scripts[] = 'http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js';
    }

    if (version_compare(VERSION, '2.3.0.2', '>=')) {
      $scripts[] = 'view/javascript/summernote/summernote.js';
      $scripts[] = 'view/javascript/summernote/opencart.js';
    }

    foreach ($scripts as $script) {
      if ($script) {
        $this->document->addScript($script);
      }
    }

    $styles = [
      'view/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet.css',
      'view/javascript/ocdevwizard/'.$this->_name.'/codemirror/lib/codemirror.css',
      'view/javascript/ocdevwizard/'.$this->_name.'/codemirror/theme/monokai.css',
      'view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css'
    ];

    if (version_compare(VERSION, '2.3.0.2.3', '<')) {
      $styles[] = 'http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css';
    }

    if (version_compare(VERSION, '2.3.0.2', '>=')) {
      $styles[] = 'view/javascript/summernote/summernote.css';
    }

    foreach ($styles as $style) {
      if ($style) {
        $this->document->addStyle($style);
      }
    }

    $data['store_id'] = $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
      if (is_uploaded_file($this->request->files['config_import']['tmp_name'])) {
        $content_config = file_get_contents($this->request->files['config_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['module_import']['tmp_name'])) {
        $content_module = file_get_contents($this->request->files['module_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['category_import']['tmp_name'])) {
        $content_category = file_get_contents($this->request->files['category_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['post_import']['tmp_name'])) {
        $content_post = file_get_contents($this->request->files['post_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['author_import']['tmp_name'])) {
        $content_author = file_get_contents($this->request->files['author_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['comment_import']['tmp_name'])) {
        $content_comment = file_get_contents($this->request->files['comment_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['banned_import']['tmp_name'])) {
        $content_banned = file_get_contents($this->request->files['banned_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['vote_import']['tmp_name'])) {
        $content_vote = file_get_contents($this->request->files['vote_import']['tmp_name']);
      }

      if (is_uploaded_file($this->request->files['email_template_import']['tmp_name'])) {
        $content_email_template = file_get_contents($this->request->files['email_template_import']['tmp_name']);
      }

      $response_info = $this->sendCurl($this->request->post, 'base', $this->request->post[$this->_name.'_license']);

      $this->cache(true);

      if (isset($content_config)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $config = unserialize($content_config);

          if ($config) {
            $this->sendCurl($config, 'edit_setting', $this->request->post[$this->_name.'_license'], $store_id);
          }

          $this->session->data['success'] = $this->language->get('text_success_config_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_module)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $modules = unserialize($content_module);

          if ($modules) {
            $this->sendCurl([], 'module', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($modules as $module) {
              $this->sendCurl($module, 'module', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_module_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_category)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $categories = unserialize($content_category);

          if ($categories) {
            $this->sendCurl([], 'category', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($categories as $category) {
              $this->sendCurl($category, 'category', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_category_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_post)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $posts = unserialize($content_post);

          if ($posts) {
            $this->sendCurl([], 'post', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($posts as $post) {
              $this->sendCurl($post, 'post', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_post_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_author)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $authors = unserialize($content_author);

          if ($authors) {
            $this->sendCurl([], 'author', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($authors as $author) {
              $this->sendCurl($author, 'author', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_author_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_comment)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $comments = unserialize($content_comment);

          if ($comments) {
            $this->sendCurl([], 'comment', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($comments as $comment) {
              $this->sendCurl($comment, 'comment', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_comment_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_banned)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $banneds = unserialize($content_banned);

          if ($banneds) {
            $this->sendCurl([], 'banned', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($banneds as $banned) {
              $this->sendCurl($banned, 'banned', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_banned_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_vote)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $votes = unserialize($content_vote);

          if ($votes) {
            $this->sendCurl([], 'vote', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($votes as $vote) {
              $this->sendCurl($vote, 'vote', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_vote_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else if (isset($content_email_template)) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $email_templates = unserialize($content_email_template);

          if ($email_templates) {
            $this->sendCurl([], 'email_template', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

            foreach ($email_templates as $email_template) {
              $this->sendCurl($email_template, 'email_template', $this->request->post[$this->_name.'_license'], $store_id, 'import');
            }
          }

          $this->session->data['success'] = $this->language->get('text_success_email_template_restored');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      } else {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $this->sendCurl($response_info['response'], 'edit_setting', $this->request->post[$this->_name.'_license'], $store_id);

          $this->session->data['success'] = $this->language->get('text_success');

          if (version_compare(VERSION, '2.2.0.0', '<=')) {
            $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
          } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
            $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token, $this->_ssl_code));
          } else {
            $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
          }
        }
      }
    }

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

    if (isset($this->request->post[$this->_name.'_license'])) {
      $data['license_key'] = $license_key = $this->request->post[$this->_name.'_license'];
    } else if (isset($setting_info[$this->_name.'_license'])) {
      $data['license_key'] = $license_key = $setting_info[$this->_name.'_license'];
    } else {
      $data['license_key'] = $license_key = '';
    }

    $response_info = $this->sendCurl([], 'validate_access', $license_key);

    if ($response_info['status'] != 200 || empty($response_info['response'])) {
      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name, $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    }

    $data['license_expire'] = '';

    if ($response_info['status'] == 200 || !empty($response_info['response'])) {
      if ($response_info['response']['date_end'] == '0000-00-00') {
        $data['license_expire']        = $this->language->get('text_license_expire_forever');
        $data['license_expire_status'] = 1;
      } else {
        $license_expire_days1 = strtotime(date('Y-m-d'));
        $license_expire_days2 = strtotime($response_info['response']['date_end']);

        $license_expire_diff = $license_expire_days2 - $license_expire_days1;

        if (floor($license_expire_diff / 3600 / 24) < 0) {
          $data['license_expire']         = $this->language->get('text_license_end');
          $data['license_expire_status']  = 0;
          $this->session->data['warning'] = $this->language->get('text_license_expire_ended');
        } else {
          $data['license_expire']        = sprintf($this->language->get('text_license_date_end'), date("F j, Y", strtotime($response_info['response']['date_end'])), floor($license_expire_diff / 3600 / 24).' '.$this->day_formatting(floor($license_expire_diff / 3600 / 24), $this->language->get('text_license_expire_day_1'), $this->language->get('text_license_expire_day_2')));
          $data['license_expire_status'] = 2;
        }
      }

      $data['license_type']   = $response_info['response']['type'];
      $data['license_holder'] = $response_info['response']['holder'];
    }

    $data['error_warning'] = '';

    if (!empty($this->error)) {
      foreach ($this->error as $key => $error) {
        if ($key == 'compatible_version') {
          $data['error_warning'] = $error;
        } else {
          $data['error_'.$key] = $error;
        }
      }
    }

    if (!$this->user->hasPermission('access', 'extension/ocdevwizard/'.$this->_name)) {
      $data['error_warning'] = sprintf($this->language->get('error_access_permission'), $this->url->link('user/user_permission', $this->_session_token, $this->_ssl_code));
    }

    $data['breadcrumbs'] = [
      0 => [
        'text'     => $this->language->get('text_home'),
        'href'     => $this->url->link('common/dashboard', $this->_session_token, $this->_ssl_code),
        'dropdown' => []
      ],
      1 => [
        'text'     => $this->language->get('heading_title'),
        'href'     => false,
        'dropdown' => [
          0 => [
            'text'   => $this->language->get('text_setting_left_menu'),
            'href'   => $this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code),
            'active' => true
          ]
        ]
      ]
    ];

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

    $data['action']                                = $this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['action_plus']                           = $this->url->link('extension/ocdevwizard/'.$this->_name.'/edit_and_stay', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['restore']                               = $this->url->link('extension/ocdevwizard/'.$this->_name.'/restore', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['uninstall']                             = $this->url->link('extension/ocdevwizard/'.$this->_name.'/uninstall', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['uninstall_and_remove']                  = $this->url->link('extension/ocdevwizard/'.$this->_name.'/uninstall_and_remove', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['cache']                                 = $this->url->link('extension/ocdevwizard/'.$this->_name.'/cache', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['cache_backup']                          = $this->url->link('extension/ocdevwizard/'.$this->_name.'/cache_backup', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_config_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_config_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_config_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_config_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_module_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_module_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_module_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_module_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_category_settings_button']       = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_category_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_category_settings_button']       = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_category_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_post_settings_button']           = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_post_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_post_settings_button']           = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_post_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_author_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_author_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_author_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_author_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_comment_settings_button']        = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_comment_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_comment_settings_button']        = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_comment_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_banned_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_banned_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_banned_settings_button']         = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_banned_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_vote_settings_button']           = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_vote_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_vote_settings_button']           = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_vote_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['export_email_template_settings_button'] = $this->url->link('extension/ocdevwizard/'.$this->_name.'/export_email_template_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    $data['import_email_template_settings_button'] = $this->url->link('extension/ocdevwizard/'.$this->_name.'/import_email_template_settings', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code);
    if (version_compare(VERSION, '2.2.0.0', '<=')) {
      $data['cancel'] = $this->url->link('extension/module', $this->_session_token, $this->_ssl_code);
    } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $data['cancel'] = $this->url->link('marketplace/extension', $this->_session_token.'&type=module', $this->_ssl_code);
    } else {
      $data['cancel'] = $this->url->link('extension/extension', $this->_session_token.'&type=module', $this->_ssl_code);
    }

    $data['_name']            = $this->_name;
    $data['_code']            = $this->_code;
    $data['_version']         = $this->_version;
    $data['opencart_version'] = VERSION;
    $data['token']            = $this->_session_token;
    $data['placeholder']      = $this->model_tool_image->resize('no_image.png', 50, 50);
    $data['config_store_url'] = $this->config->get('config_secure') ? HTTPS_CATALOG : HTTP_CATALOG;

    $form_data = isset($this->request->post['form_data']) ? $this->request->post['form_data'] : $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', $store_id);

    $data['form_data'] = [];

    $response_info = $this->sendCurl(['array' => $form_data], 'form_data', $license_key);

    if ($response_info['status'] == 200 && !empty($response_info['response'])) {
      $data['form_data'] = $response_info['response'];
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'href'     => $this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store['store_id'], $this->_ssl_code),
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    $data['all_socials'] = [
      0 => [
        'name'  => 'Facebook',
        'value' => 'facebook'
      ],
      1 => [
        'name'  => 'Twitter',
        'value' => 'twitter'
      ],
      2 => [
        'name'  => 'Pinterest',
        'value' => 'pinterest'
      ],
      3 => [
        'name'  => 'VK',
        'value' => 'vk'
      ],
      4 => [
        'name'  => 'AddThis',
        'value' => 'addthis'
      ]
    ];

    if (isset($form_data['admin_icon']) && is_file(DIR_IMAGE.$form_data['admin_icon'])) {
      $data['admin_icon_image'] = $this->model_tool_image->resize($form_data['admin_icon'], 50, 50);
    } else if ($form_data['admin_icon'] && is_file(DIR_IMAGE.$form_data['admin_icon'])) {
      $data['admin_icon_image'] = $this->model_tool_image->resize($form_data['admin_icon'], 50, 50);
    } else {
      $data['admin_icon_image'] = $this->model_tool_image->resize('no_image.png', 50, 50);;
    }

    if (isset($form_data['user_icon']) && is_file(DIR_IMAGE.$form_data['user_icon'])) {
      $data['user_icon_image'] = $this->model_tool_image->resize($form_data['user_icon'], 50, 50);
    } else if ($form_data['user_icon'] && is_file(DIR_IMAGE.$form_data['user_icon'])) {
      $data['user_icon_image'] = $this->model_tool_image->resize($form_data['user_icon'], 50, 50);
    } else {
      $data['user_icon_image'] = $this->model_tool_image->resize('no_image.png', 50, 50);;
    }

    $data['config_backup_files'] = [];

    if ($this->get_config_backup_files()) {
      foreach ($this->get_config_backup_files() as $config_backup_file) {
        $name_string                   = explode("/", $config_backup_file);
        $name                          = array_pop($name_string);
        $data['config_backup_files'][] = ['name' => $name];
      }
    }

    $data['module_backup_files'] = [];

    if ($this->get_module_backup_files()) {
      foreach ($this->get_module_backup_files() as $module_backup_file) {
        $name_string                   = explode("/", $module_backup_file);
        $name                          = array_pop($name_string);
        $data['module_backup_files'][] = ['name' => $name];
      }
    }

    $data['category_backup_files'] = [];

    if ($this->get_category_backup_files()) {
      foreach ($this->get_category_backup_files() as $category_backup_file) {
        $name_string                     = explode("/", $category_backup_file);
        $name                            = array_pop($name_string);
        $data['category_backup_files'][] = ['name' => $name];
      }
    }

    $data['post_backup_files'] = [];

    if ($this->get_post_backup_files()) {
      foreach ($this->get_post_backup_files() as $post_backup_file) {
        $name_string                 = explode("/", $post_backup_file);
        $name                        = array_pop($name_string);
        $data['post_backup_files'][] = ['name' => $name];
      }
    }

    $data['author_backup_files'] = [];

    if ($this->get_author_backup_files()) {
      foreach ($this->get_author_backup_files() as $author_backup_file) {
        $name_string                   = explode("/", $author_backup_file);
        $name                          = array_pop($name_string);
        $data['author_backup_files'][] = ['name' => $name];
      }
    }

    $data['comment_backup_files'] = [];

    if ($this->get_comment_backup_files()) {
      foreach ($this->get_comment_backup_files() as $comment_backup_file) {
        $name_string                    = explode("/", $comment_backup_file);
        $name                           = array_pop($name_string);
        $data['comment_backup_files'][] = ['name' => $name];
      }
    }

    $data['banned_backup_files'] = [];

    if ($this->get_banned_backup_files()) {
      foreach ($this->get_banned_backup_files() as $banned_backup_file) {
        $name_string                   = explode("/", $banned_backup_file);
        $name                          = array_pop($name_string);
        $data['banned_backup_files'][] = ['name' => $name];
      }
    }

    $data['vote_backup_files'] = [];

    if ($this->get_vote_backup_files()) {
      foreach ($this->get_vote_backup_files() as $vote_backup_file) {
        $name_string                 = explode("/", $vote_backup_file);
        $name                        = array_pop($name_string);
        $data['vote_backup_files'][] = ['name' => $name];
      }
    }

    $data['email_template_backup_files'] = [];

    if ($this->get_email_template_backup_files()) {
      foreach ($this->get_email_template_backup_files() as $email_template_backup_file) {
        $name_string                           = explode("/", $email_template_backup_file);
        $name                                  = array_pop($name_string);
        $data['email_template_backup_files'][] = ['name' => $name];
      }
    }

    $data['all_informations'] = [];

    foreach ($this->model_catalog_information->getInformations() as $information) {
      $data['all_informations'][] = [
        'information_id' => $information['information_id'],
        'title'          => $information['title']
      ];
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    // ocdev products
    $data['products'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getOCdevCatalog();

    // ocdev support
    $data['support_info'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getOCdevSupportInfo();

    $data['stylesheet_code'] = (is_file(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet.css')) ? file_get_contents(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet.css') : $this->language->get('error_failed_load_stylesheet');

    $data['stylesheet_code_rtl'] = (is_file(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet_rtl.css')) ? file_get_contents(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/stylesheet_rtl.css') : $this->language->get('error_failed_load_stylesheet');

    // templates
    $html_email_templates = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplates(['filter_status' => 1]);

    $data['templates'] = [];

    if ($html_email_templates) {
      foreach ($html_email_templates as $html_email_template) {
        $data['templates'][] = [
          'template_id' => $html_email_template['template_id'],
          'name'        => $html_email_template['name']
        ];
      }
    }

    $data['header']      = $this->load->controller('common/header');
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer']      = $this->load->controller('common/footer');

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/index.tpl', $data));
    }
  }

  public function edit_and_stay() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $data = [];

      $models = [
        'extension/ocdevwizard/'.$this->_name,
        'extension/ocdevwizard/ocdevwizard_setting'
      ];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
      $this->document->setTitle($this->language->get('heading_title'));

      if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validate()) {
        if (is_uploaded_file($this->request->files['config_import']['tmp_name'])) {
          $content_config = file_get_contents($this->request->files['config_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['module_import']['tmp_name'])) {
          $content_module = file_get_contents($this->request->files['module_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['category_import']['tmp_name'])) {
          $content_category = file_get_contents($this->request->files['category_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['post_import']['tmp_name'])) {
          $content_post = file_get_contents($this->request->files['post_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['author_import']['tmp_name'])) {
          $content_author = file_get_contents($this->request->files['author_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['comment_import']['tmp_name'])) {
          $content_comment = file_get_contents($this->request->files['comment_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['banned_import']['tmp_name'])) {
          $content_banned = file_get_contents($this->request->files['banned_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['vote_import']['tmp_name'])) {
          $content_vote = file_get_contents($this->request->files['vote_import']['tmp_name']);
        }

        if (is_uploaded_file($this->request->files['email_template_import']['tmp_name'])) {
          $content_email_template = file_get_contents($this->request->files['email_template_import']['tmp_name']);
        }

        $response_info = $this->sendCurl($this->request->post, 'base', $this->request->post[$this->_name.'_license']);

        $this->cache(true);

        if (isset($content_config)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $config = unserialize($content_config);

            if ($config) {
              $this->sendCurl($config, 'edit_setting', $this->request->post[$this->_name.'_license'], $store_id);
            }

            $this->session->data['success'] = $this->language->get('text_success_config_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_module)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $modules = unserialize($content_module);

            if ($modules) {
              $this->sendCurl([], 'module', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($modules as $module) {
                $this->sendCurl($module, 'module', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_module_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_category)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $categories = unserialize($content_category);

            if ($categories) {
              $this->sendCurl($this->request->post, 'category', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($categories as $category) {
                $this->sendCurl($category, 'category', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_category_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_post)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $posts = unserialize($content_post);

            if ($posts) {
              $this->sendCurl([], 'post', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($posts as $post) {
                $this->sendCurl($post, 'post', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_post_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_author)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $authors = unserialize($content_author);

            if ($authors) {
              $this->sendCurl([], 'author', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($authors as $author) {
                $this->sendCurl($author, 'author', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_author_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_comment)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $comments = unserialize($content_comment);

            if ($comments) {
              $this->sendCurl([], 'comment', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($comments as $comment) {
                $this->sendCurl($comment, 'comment', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_comment_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_banned)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $banneds = unserialize($content_banned);

            if ($banneds) {
              $this->sendCurl([], 'banned', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($banneds as $banned) {
                $this->sendCurl($banned, 'banned', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_banned_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_vote)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $votes = unserialize($content_vote);

            if ($votes) {
              $this->sendCurl([], 'vote', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($votes as $vote) {
                $this->sendCurl($vote, 'vote', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_vote_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else if (isset($content_email_template)) {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $email_templates = unserialize($content_email_template);

            if ($email_templates) {
              $this->sendCurl([], 'email_template', $this->request->post[$this->_name.'_license'], $store_id, 'prepare');

              foreach ($email_templates as $email_template) {
                $this->sendCurl($email_template, 'email_template', $this->request->post[$this->_name.'_license'], $store_id, 'import');
              }
            }

            $this->session->data['success'] = $this->language->get('text_success_email_template_restored');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        } else {
          if ($response_info['status'] == 200 && !empty($response_info['response'])) {
            $this->sendCurl($response_info['response'], 'edit_setting', $this->request->post[$this->_name.'_license'], $store_id);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
          }
        }
      } else {
        $this->base();
      }
    }
  }

  private function validate_access() {
    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->checkRemoteFile()) {
      $this->error['warning'] = $this->language->get('error_license_server');
    }

    if (!in_array(VERSION, explode('|', $this->_version_engine))) {
      $this->error['compatible_version'] = $this->language->get('error_compatible_version');
    }

    if (empty($this->request->post[$this->_name.'_license'])) {
      $this->error['license_key'] = $this->language->get('error_license_key');
    }

    if (isset($this->error) && $this->error) {
      $this->session->data['warning'] = $this->language->get('error_warning');
    }

    return (!$this->error) ? true : false;
  }

  private function validate_engine_version() {
    if (!in_array(VERSION, explode('|', $this->_version_engine))) {
      $this->error['compatible_version'] = $this->language->get('error_compatible_version');
    }

    if (isset($this->error) && $this->error) {
      $this->session->data['warning'] = $this->language->get('error_warning');
    }

    return (!$this->error) ? true : false;
  }

  private function validate() {
    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->checkRemoteFile()) {
      $this->error['warning'] = $this->language->get('error_license_server');
    }

    if (!in_array(VERSION, explode('|', $this->_version_engine))) {
      $this->error['compatible_version'] = $this->language->get('error_compatible_version');
    }

    $response_errors = $this->sendCurl($this->request->post['form_data'], 'validate_data', $this->request->post[$this->_name.'_license'], 0, 'config');

    if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
      foreach ($response_errors['response'] as $key => $error) {
        $this->error[$key] = $this->language->get($error);
      }
    }

    if (isset($this->error) && $this->error) {
      $this->session->data['warning'] = $this->language->get('error_warning');
    }

    return (!$this->error) ? true : false;
  }

  public function uninstall() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = [
        'user/user_group',
        'extension/ocdevwizard/ocdevwizard_setting',
        'extension/ocdevwizard/'.$this->_name
      ];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $modules = ['extension/ocdevwizard/'.$this->_name];

      foreach ($modules as $module) {
        $this->model_user_user_group->removePermission($this->user->getId(), 'access', $module);
        $this->model_user_user_group->removePermission($this->user->getId(), 'modify', $module);
      }

      $this->{'model_extension_ocdevwizard_'.$this->_name}->deleteDBTables();

      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

      if (isset($setting_info[$this->_name.'_license'])) {
        $license_key = $setting_info[$this->_name.'_license'];
      } else {
        $license_key = '';
      }

      $this->sendCurl([], 'delete_setting', $license_key, $store_id);

      $this->session->data['success'] = $this->language->get('text_success_uninstall');

      if (version_compare(VERSION, '2.2.0.0', '<=')) {
        $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token.'&type=module', true));
      } else {
        $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
      }
    }
  }

  public function uninstall_and_remove() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = [
        'user/user_group',
        'extension/ocdevwizard/ocdevwizard_setting',
        'extension/ocdevwizard/'.$this->_name
      ];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $modules = ['extension/ocdevwizard/'.$this->_name];

      foreach ($modules as $module) {
        $this->model_user_user_group->removePermission($this->user->getId(), 'access', $module);
        $this->model_user_user_group->removePermission($this->user->getId(), 'modify', $module);
      }

      $this->{'model_extension_ocdevwizard_'.$this->_name}->deleteDBTables();
      $this->model_extension_ocdevwizard_ocdevwizard_setting->deleteSetting($this->_name, $store_id);

      $files = [];

      $files1  = glob(DIR_APPLICATION.'view/*/extension/ocdevwizard/'.$this->_name.'*');
      $files2  = glob(DIR_APPLICATION.'model/extension/ocdevwizard/'.$this->_name.'*');
      $files3  = glob(DIR_APPLICATION.'language/*/extension/ocdevwizard/'.$this->_name.'*');
      $files4  = glob(DIR_APPLICATION.'controller/extension/ocdevwizard/'.$this->_name.'*');
      $files5  = glob(DIR_CATALOG.'view/*/ocdevwizard/'.$this->_name.'*');
      $files6  = glob(DIR_CATALOG.'view/theme/*/*/extension/ocdevwizard/'.$this->_name.'*');
      $files7  = glob(DIR_CATALOG.'model/extension/ocdevwizard/'.$this->_name.'*');
      $files8  = glob(DIR_CATALOG.'model/api/ocdevwizard/'.$this->_name.'*');
      $files9  = glob(DIR_CATALOG.'language/*/extension/ocdevwizard/'.$this->_name.'*');
      $files10 = glob(DIR_CATALOG.'controller/extension/ocdevwizard/'.$this->_name.'*');
      $files11 = glob(DIR_CATALOG.'controller/api/ocdevwizard/'.$this->_name.'*');
      $files12 = glob(DIR_IMAGE.'catalog/ocdevwizard/'.$this->_name.'*');
      $files13 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'*');
      $files14 = glob(DIR_SYSTEM.'ocdevwizard_'.$this->_code.'.ocmod.xml');

      $files = array_merge($files1, $files2, $files3, $files4, $files5, $files6, $files7, $files8, $files9, $files10, $files11, $files12, $files13, $files14);

      if ($files) {
        foreach ($files as $file) {
          if (is_dir($file) && is_readable($file)) {
            $this->removeDir($file);
          }

          if (is_file($file) && is_readable($file)) {
            unlink($file);
          }
        }
      }

      $this->session->data['success'] = $this->language->get('text_success_uninstall');

      if (version_compare(VERSION, '2.2.0.0', '<=')) {
        $this->response->redirect($this->url->link('extension/module', $this->_session_token, $this->_ssl_code));
      } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
        $this->response->redirect($this->url->link('marketplace/extension', $this->_session_token.'&type=module', $this->_ssl_code));
      } else {
        $this->response->redirect($this->url->link('extension/extension', $this->_session_token, $this->_ssl_code));
      }
    }
  }

  public function removeDir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir."/".$object) == "dir") {
            $this->removeDir($dir."/".$object);
          } else {
            unlink($dir."/".$object);
          }
        }
      }

      reset($objects);
      rmdir($dir);
    }
  }

  public function restore() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = [
        'setting/store',
        'extension/ocdevwizard/ocdevwizard_setting'
      ];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $default_store = [
        0 => [
          'store_id' => 0,
          'name'     => $this->config->get('config_name').' (Default)'
        ]
      ];

      $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

      if (isset($setting_info[$this->_name.'_license'])) {
        $license_key = $setting_info[$this->_name.'_license'];
      } else {
        $license_key = '';
      }

      $response_info = $this->sendCurl([], 'validate_access', $license_key, $store_id);

      foreach ($all_stores as $store) {
        if ($response_info['status'] == 200 && !empty($response_info['response'])) {
          $this->sendCurl([], 'restore', $license_key, $store['store_id']);
        }
      }

      $this->session->data['success'] = $this->language->get('text_success_module_restored');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    }
  }

  public function cache($clear_only = false) {
    if ($clear_only) {
      $files = [];

      $files1 = glob(DIR_CATALOG.'view/javascript/ocdevwizard/ocdevwizard.js');
      $files2 = glob(DIR_CATALOG.'view/javascript/ocdevwizard/'.$this->_name.'/main.js');

      $files = array_merge($files1, $files2);

      if ($files) {
        foreach ($files as $file) {
          if (is_file($file) && is_readable($file)) {
            unlink($file);
          }
        }
      }
    } else {
      $this->language->load('extension/ocdevwizard/'.$this->_name);

      $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

      if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
        $this->session->data['warning'] = $this->language->get('error_permission');

        $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
      } else {
        $files = [];

        $files1 = glob(DIR_CATALOG.'view/javascript/ocdevwizard/ocdevwizard.js');
        $files2 = glob(DIR_CATALOG.'view/javascript/ocdevwizard/'.$this->_name.'/main.js');

        $files = array_merge($files1, $files2);

        if ($files) {
          foreach ($files as $file) {
            if (is_file($file) && is_readable($file)) {
              unlink($file);
            }
          }
        }

        $this->session->data['success'] = $this->language->get('text_success_cache');

        $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
      }
    }
  }

  public function cache_backup() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $files1 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config/*');
      $files2 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module/*');
      $files3 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category/*');
      $files4 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post/*');
      $files5 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author/*');
      $files6 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment/*');
      $files7 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote/*');
      $files8 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned/*');
      $files9 = glob(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template/*');

      $files = array_merge($files1, $files2, $files3, $files4, $files5, $files6, $files7, $files8, $files9);

      if ($files) {
        foreach ($files as $file) {
          if (is_file($file) && is_readable($file)) {
            if (!preg_match('/(index.html|index.htm|index.php|.htaccess)/', $file)) {
              unlink($file);
            }
          }
        }
      }

      $this->session->data['success'] = $this->language->get('text_success_cache_backup');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    }
  }

  public function history_email_template() {
    $data = [];

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_email_template'] = (isset($this->request->get['template_id']) && $this->request->get['template_id']) ? $this->language->get('text_edit_email_template') : $this->language->get('text_add_email_template');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;

    if (isset($this->request->get['template_id'])) {
      $data['template_id'] = $this->request->get['template_id'];
    } else {
      $data['template_id'] = 0;
    }

    if ((isset($this->request->get['template_id']) && $this->request->get['template_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $email_template_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplate($this->request->get['template_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (!empty($email_template_info)) {
      $data['status'] = $email_template_info['status'];
    } else {
      $data['status'] = 1;
    }

    if (isset($this->request->post['name'])) {
      $data['name'] = $this->request->post['name'];
    } else if (!empty($email_template_info)) {
      $data['name'] = $email_template_info['name'];
    } else {
      $data['name'] = $this->language->get('default_email_template_name');
    }

    if (isset($this->request->post['template_description'])) {
      $data['template_description'] = $this->request->post['template_description'];
    } else if (isset($this->request->get['template_id']) && $email_template_info) {
      $data['template_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplateDescription($this->request->get['template_id']);
    } else {
      foreach ($this->model_localisation_language->getLanguages() as $language) {
        $data['template_description'][$language['language_id']] = [
          'subject'  => $this->language->get('default_email_template_subject'),
          'template' => ''
        ];
      }
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/email_template_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/email_template_index.tpl', $data));
    }
  }

  public function history_email_template_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = ['extension/ocdevwizard/ocdevwizard_setting'];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {

      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'email_template');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'email_template_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['template_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['template_id']) && $this->request->post['template_id']) {
          $this->sendCurl($this->request->post, 'email_template', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_email_template_edit');
        } else {
          $this->sendCurl($this->request->post, 'email_template', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_email_template_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_email_template_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data              = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page              = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit             = 10;
    $data['_name']     = $this->_name;
    $data['token']     = $this->_session_token;
    $data['histories'] = [];

    $filter_data = [
      'filter_heading'       => (isset($this->request->get['filter_heading'])) ? trim($this->request->get['filter_heading']) : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'et.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplates($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'template_id'   => $result['template_id'],
        'name'          => $result['name'],
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalEmailTemplates($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'email_template');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_email_template', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_email_template.tpl', $data));
    }
  }

  public function preview_template() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (isset($this->request->get['template_id']) && isset($this->request->get['language_id'])) {
      if (!empty($this->request->get['template_id']) && !empty($this->request->get['language_id'])) {
        $models = ['extension/ocdevwizard/'.$this->_name];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        $template_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplate($this->request->get['template_id'], $this->request->get['language_id']);

        if ($template_info) {
          $json['name']     = html_entity_decode($template_info['name'], ENT_QUOTES, 'UTF-8');
          $json['template'] = html_entity_decode($template_info['template'], ENT_QUOTES, 'UTF-8');
        } else {
          $json['name']     = $this->language->get('error_template');
          $json['template'] = $this->language->get('error_template');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_module() {
    $data = [];

    $models = [
      'setting/store',
      'design/layout',
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['module_id']) && $this->request->get['module_id']) ? $this->language->get('text_edit_module') : $this->language->get('text_add_module');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;
    $data['config_store_url']    = $this->config->get('config_secure') ? HTTPS_CATALOG : HTTP_CATALOG;

    if (isset($this->request->get['module_id'])) {
      $data['module_id'] = $module_id = $this->request->get['module_id'];
    } else {
      $data['module_id'] = $module_id = 0;
    }

    if ((isset($this->request->get['module_id']) && $this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $module_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModule($this->request->get['module_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['status'] = $module_info['status'];
    } else {
      $data['status'] = '1';
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    if (isset($this->request->post['stores'])) {
      $data['stores'] = $this->request->post['stores'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['stores'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleStores($this->request->get['module_id']);
    } else {
      $data['stores'] = [0];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    if (isset($this->request->post['customer_groups'])) {
      $data['customer_groups'] = $this->request->post['customer_groups'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['customer_groups'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleCustomerGroups($this->request->get['module_id']);
    } else {
      $data['customer_groups'] = [1];
    }

    if (isset($this->request->post['module_layout'])) {
      $data['module_layout'] = $this->request->post['module_layout'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['module_layout'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleLayouts($this->request->get['module_id']);
    } else {
      $data['module_layout'] = [];
    }

    $data['all_layouts'] = [];

    foreach ($this->model_design_layout->getLayouts() as $layout) {
      $data['all_layouts'][] = [
        'layout_id' => $layout['layout_id'],
        'name'      => $layout['name']
      ];
    }

    if (isset($this->request->post['display_type'])) {
      $data['display_type'] = $this->request->post['display_type'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['display_type'] = $module_info['display_type'];
    } else {
      $data['display_type'] = '6';
    }

    if (isset($this->request->post['position'])) {
      $data['position'] = $this->request->post['position'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['position'] = $module_info['position'];
    } else {
      $data['position'] = '';
    }

    if (isset($this->request->post['sort_order'])) {
      $data['sort_order'] = $this->request->post['sort_order'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['sort_order'] = $module_info['sort_order'];
    } else {
      $data['sort_order'] = '0';
    }

    if (isset($this->request->post['limit'])) {
      $data['limit'] = $this->request->post['limit'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['limit'] = $module_info['limit'];
    } else {
      $data['limit'] = '5';
    }

    if (isset($this->request->post['show_comment_icon'])) {
      $data['show_comment_icon'] = $this->request->post['show_comment_icon'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_comment_icon'] = $module_info['show_comment_icon'];
    } else {
      $data['show_comment_icon'] = '1';
    }

    if (isset($this->request->post['show_main_image'])) {
      $data['show_main_image'] = $this->request->post['show_main_image'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_main_image'] = $module_info['show_main_image'];
    } else {
      $data['show_main_image'] = '1';
    }

    if (isset($this->request->post['main_image_width'])) {
      $data['main_image_width'] = $this->request->post['main_image_width'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['main_image_width'] = $module_info['main_image_width'];
    } else {
      $data['main_image_width'] = '270';
    }

    if (isset($this->request->post['main_image_height'])) {
      $data['main_image_height'] = $this->request->post['main_image_height'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['main_image_height'] = $module_info['main_image_height'];
    } else {
      $data['main_image_height'] = '95';
    }

    if (isset($this->request->post['show_description'])) {
      $data['show_description'] = $this->request->post['show_description'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_description'] = $module_info['show_description'];
    } else {
      $data['show_description'] = '1';
    }

    if (isset($this->request->post['description_limit'])) {
      $data['description_limit'] = $this->request->post['description_limit'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['description_limit'] = $module_info['description_limit'];
    } else {
      $data['description_limit'] = '100';
    }

    if (isset($this->request->post['show_count_viewed'])) {
      $data['show_count_viewed'] = $this->request->post['show_count_viewed'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_count_viewed'] = $module_info['show_count_viewed'];
    } else {
      $data['show_count_viewed'] = '1';
    }

    if (isset($this->request->post['show_count_comments'])) {
      $data['show_count_comments'] = $this->request->post['show_count_comments'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_count_comments'] = $module_info['show_count_comments'];
    } else {
      $data['show_count_comments'] = '1';
    }

    if (isset($this->request->post['show_author'])) {
      $data['show_author'] = $this->request->post['show_author'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_author'] = $module_info['show_author'];
    } else {
      $data['show_author'] = '1';
    }

    if (isset($this->request->post['show_read_more_button'])) {
      $data['show_read_more_button'] = $this->request->post['show_read_more_button'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_read_more_button'] = $module_info['show_read_more_button'];
    } else {
      $data['show_read_more_button'] = '1';
    }

    if (isset($this->request->post['show_date_added'])) {
      $data['show_date_added'] = $this->request->post['show_date_added'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['show_date_added'] = $module_info['show_date_added'];
    } else {
      $data['show_date_added'] = '1';
    }

    if (isset($this->request->post['display_type_inner'])) {
      $data['display_type_inner'] = $this->request->post['display_type_inner'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['display_type_inner'] = $module_info['display_type_inner'];
    } else {
      $data['display_type_inner'] = '1';
    }

    if (isset($this->request->post['adaptive_setting_0'])) {
      $data['adaptive_setting_0'] = $this->request->post['adaptive_setting_0'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['adaptive_setting_0'] = $module_info['adaptive_setting_0'];
    } else {
      $data['adaptive_setting_0'] = '1';
    }

    if (isset($this->request->post['adaptive_setting_1'])) {
      $data['adaptive_setting_1'] = $this->request->post['adaptive_setting_1'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['adaptive_setting_1'] = $module_info['adaptive_setting_1'];
    } else {
      $data['adaptive_setting_1'] = '2';
    }

    if (isset($this->request->post['adaptive_setting_2'])) {
      $data['adaptive_setting_2'] = $this->request->post['adaptive_setting_2'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['adaptive_setting_2'] = $module_info['adaptive_setting_2'];
    } else {
      $data['adaptive_setting_2'] = '3';
    }

    if (isset($this->request->post['adaptive_setting_3'])) {
      $data['adaptive_setting_3'] = $this->request->post['adaptive_setting_3'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['adaptive_setting_3'] = $module_info['adaptive_setting_3'];
    } else {
      $data['adaptive_setting_3'] = '4';
    }

    if (isset($this->request->post['adaptive_setting_4'])) {
      $data['adaptive_setting_4'] = $this->request->post['adaptive_setting_4'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['adaptive_setting_4'] = $module_info['adaptive_setting_4'];
    } else {
      $data['adaptive_setting_4'] = '4';
    }

    if (isset($this->request->post['related_type'])) {
      $data['related_type'] = $this->request->post['related_type'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['related_type'] = $module_info['related_type'];
    } else {
      $data['related_type'] = '1';
    }

    if (isset($this->request->post['module_description'])) {
      $data['module_description'] = $this->request->post['module_description'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['module_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleDescription($this->request->get['module_id']);
    } else {
      $data['module_description'] = [];
    }

    if (isset($this->request->post['category_related'])) {
      $categories = $this->request->post['category_related'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $categories = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleRelatedCategory($this->request->get['module_id']);
    } else {
      $categories = [];
    }

    $data['module_categories'] = [];

    foreach ($categories as $category_id) {
      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($category_id);

      if ($category_info) {
        $data['module_categories'][] = [
          'category_id' => $category_info[$this->_code.'_category_id'],
          'name'        => ($category_info['path']) ? $category_info['path'].' &gt; '.$category_info['name'] : $category_info['name']
        ];
      }
    }

    if (isset($this->request->post['post_related'])) {
      $posts = $this->request->post['post_related'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleRelatedPost($this->request->get['module_id']);
    } else {
      $posts = [];
    }

    $data['module_posts'] = [];

    foreach ($posts as $post_id) {
      $related_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($post_id);

      if ($related_info) {
        $data['module_posts'][] = [
          'post_id' => $related_info[$this->_code.'_post_id'],
          'name'    => $related_info['name']
        ];
      }
    }

    if (isset($this->request->post['sort_method'])) {
      $data['sort_method'] = $this->request->post['sort_method'];
    } else if (isset($this->request->get['module_id']) && $module_info) {
      $data['sort_method'] = $module_info['sort_method'];
    } else {
      $data['sort_method'] = '1';
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $data['is_opencart_3'] = true;
    } else {
      $data['is_opencart_3'] = false;
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/module_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/module_index.tpl', $data));
    }
  }

  public function history_module_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = ['extension/ocdevwizard/ocdevwizard_setting'];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'module');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'module_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['module_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['module_id']) && $this->request->post['module_id']) {
          $this->sendCurl($this->request->post, 'module', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_module_edit');
        } else {
          $this->sendCurl($this->request->post, 'module', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_module_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_module_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_name'          => (isset($this->request->get['filter_name'])) ? trim($this->request->get['filter_name']) : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'm.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModules($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'module_id'     => $result['module_id'],
        'heading'       => $result['name'],
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalModules($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'module');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_module', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_module.tpl', $data));
    }
  }

  public function history_category() {
    $data = [];

    $models = [
      'setting/store',
      'localisation/language',
      'design/layout',
      'tool/image',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['category_id']) && $this->request->get['category_id']) ? $this->language->get('text_edit_category') : $this->language->get('text_add_category');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;
    $data['config_store_url']    = $this->config->get('config_secure') ? HTTPS_CATALOG : HTTP_CATALOG;
    $data['is_opencart_3000']    = (version_compare(VERSION, '3.0.0.0', '>=')) ? true : false;

    if (isset($this->request->get['category_id'])) {
      $data['category_id'] = $category_id = $this->request->get['category_id'];
    } else {
      $data['category_id'] = $category_id = 0;
    }

    if ((isset($this->request->get['category_id']) && $this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($this->request->get['category_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['status'] = $category_info['status'];
    } else {
      $data['status'] = '1';
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    if (isset($this->request->post['category_store'])) {
      $data['stores'] = $this->request->post['category_store'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['stores'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryStores($this->request->get['category_id']);
    } else {
      $data['stores'] = [0];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    if (isset($this->request->post['category_customer_group'])) {
      $data['customer_groups'] = $this->request->post['category_customer_group'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['customer_groups'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryCustomerGroups($this->request->get['category_id']);
    } else {
      $data['customer_groups'] = [1];
    }

    if (isset($this->request->post['category_layout'])) {
      $data['category_layout'] = $this->request->post['category_layout'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['category_layout'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryLayouts($this->request->get['category_id']);
    } else {
      $data['category_layout'] = [];
    }

    $data['all_layouts'] = [];

    foreach ($this->model_design_layout->getLayouts() as $layout) {
      $data['all_layouts'][] = [
        'layout_id' => $layout['layout_id'],
        'name'      => $layout['name']
      ];
    }

    if (isset($this->request->post['path'])) {
      $data['path'] = $this->request->post['path'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['path'] = $category_info['path'];
    } else {
      $data['path'] = '';
    }

    if (isset($this->request->post['parent_id'])) {
      $data['parent_id'] = $this->request->post['parent_id'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['parent_id'] = $category_info['parent_id'];
    } else {
      $data['parent_id'] = 0;
    }

    if (isset($this->request->post['image'])) {
      $data['image'] = $this->request->post['image'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['image'] = $category_info['image'];
    } else {
      $data['image'] = '';
    }

    if (isset($this->request->post['image']) && is_file(DIR_IMAGE.$this->request->post['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 50, 50);
    } else if (isset($this->request->get['category_id']) && $category_info && is_file(DIR_IMAGE.$category_info['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($category_info['image'], 50, 50);
    } else {
      $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
    }

    if (isset($this->request->post['category_image'])) {
      $category_images = $this->request->post['category_image'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $category_images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryImages($this->request->get['category_id']);
    } else {
      $category_images = [];
    }

    $data['category_images'] = [];

    foreach ($category_images as $category_image) {
      if (is_file(DIR_IMAGE.$category_image['image'])) {
        $image = $category_image['image'];
        $thumb = $category_image['image'];
      } else {
        $image = '';
        $thumb = 'no_image.png';
      }

      $data['category_images'][] = [
        'image'      => $image,
        'thumb'      => $this->model_tool_image->resize($thumb, 50, 50),
        'sort_order' => $category_image['sort_order']
      ];
    }

    $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

    if (isset($this->request->post['sort_order'])) {
      $data['sort_order'] = $this->request->post['sort_order'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['sort_order'] = $category_info['sort_order'];
    } else {
      $data['sort_order'] = '0';
    }

    if (isset($this->request->post['sort_method'])) {
      $data['sort_method'] = $this->request->post['sort_method'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['sort_method'] = $category_info['sort_method'];
    } else {
      $data['sort_method'] = '1';
    }

    if (isset($this->request->post['description_position'])) {
      $data['description_position'] = $this->request->post['description_position'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['description_position'] = $category_info['description_position'];
    } else {
      $data['description_position'] = '1';
    }

    if (isset($this->request->post['show_description'])) {
      $data['show_description'] = $this->request->post['show_description'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['show_description'] = $category_info['show_description'];
    } else {
      $data['show_description'] = '1';
    }

    if (isset($this->request->post['show_subcategories'])) {
      $data['show_subcategories'] = $this->request->post['show_subcategories'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['show_subcategories'] = $category_info['show_subcategories'];
    } else {
      $data['show_subcategories'] = '1';
    }

    if (isset($this->request->post['show_subcategories_total'])) {
      $data['show_subcategories_total'] = $this->request->post['show_subcategories_total'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['show_subcategories_total'] = $category_info['show_subcategories_total'];
    } else {
      $data['show_subcategories_total'] = '0';
    }

    if (isset($this->request->post['show_main_image'])) {
      $data['show_main_image'] = $this->request->post['show_main_image'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['show_main_image'] = $category_info['show_main_image'];
    } else {
      $data['show_main_image'] = '0';
    }

    if (isset($this->request->post['show_additional_image'])) {
      $data['show_additional_image'] = $this->request->post['show_additional_image'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['show_additional_image'] = $category_info['show_additional_image'];
    } else {
      $data['show_additional_image'] = '0';
    }

    if (isset($this->request->post['main_image_width'])) {
      $data['main_image_width'] = $this->request->post['main_image_width'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['main_image_width'] = $category_info['main_image_width'];
    } else {
      $data['main_image_width'] = '1140';
    }

    if (isset($this->request->post['main_image_height'])) {
      $data['main_image_height'] = $this->request->post['main_image_height'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['main_image_height'] = $category_info['main_image_height'];
    } else {
      $data['main_image_height'] = '400';
    }

    if (isset($this->request->post['additional_image_popup_width'])) {
      $data['additional_image_popup_width'] = $this->request->post['additional_image_popup_width'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['additional_image_popup_width'] = $category_info['additional_image_popup_width'];
    } else {
      $data['additional_image_popup_width'] = '1000';
    }

    if (isset($this->request->post['additional_image_popup_height'])) {
      $data['additional_image_popup_height'] = $this->request->post['additional_image_popup_height'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['additional_image_popup_height'] = $category_info['additional_image_popup_height'];
    } else {
      $data['additional_image_popup_height'] = '1000';
    }

    if (isset($this->request->post['additional_image_width'])) {
      $data['additional_image_width'] = $this->request->post['additional_image_width'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['additional_image_width'] = $category_info['additional_image_width'];
    } else {
      $data['additional_image_width'] = '270';
    }

    if (isset($this->request->post['additional_image_height'])) {
      $data['additional_image_height'] = $this->request->post['additional_image_height'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['additional_image_height'] = $category_info['additional_image_height'];
    } else {
      $data['additional_image_height'] = '95';
    }

    if (isset($this->request->post['category_description'])) {
      $data['category_description'] = $this->request->post['category_description'];
    } else if (isset($this->request->get['category_id']) && $category_info) {
      $data['category_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategoryDescription($this->request->get['category_id']);
    } else {
      $data['category_description'] = [];
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['category_id']) && $category_info) {
        $data['keyword'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategorySeoUrls($this->request->get['category_id']);
      } else {
        $data['keyword'] = [];
      }
    } else {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['category_id']) && $category_info) {
        $data['keyword'] = $category_info['keyword'];
      } else {
        $data['keyword'] = '';
      }
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/category_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/category_index.tpl', $data));
    }
  }

  public function history_category_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'category');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'category_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['category_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'category_keyword');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          foreach ($response_errors['response'] as $store_id => $language) {
            foreach ($language as $language_id => $error) {
              $json['error']['keyword'][$store_id][$language_id] = $this->language->get($error);
            }
          }
        } else {
          foreach ($response_errors['response'] as $key => $error) {
            $json['error'][$key] = $this->language->get($error);
          }
        }
      }

      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($this->request->post['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($keyword, 'keyword');

              foreach ($url_alias_info as $seo_url) {
                if (($seo_url['store_id'] == $store_id) && (!isset($this->request->post['category_id']) || ($seo_url['query'] != $this->_code.'_category_id='.$this->request->post['category_id']))) {
                  $json['error']['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
                  break;
                }
              }
            }
          }
        }
      } else {
        if (!isset($json['error'])) {
          $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($this->request->post['keyword'], 'keyword');

          if ($url_alias_info && isset($this->request->post['category_id']) && $url_alias_info['query'] != $this->_code.'_category_id='.$this->request->post['category_id']) {
            $json['error']['keyword'] = $this->language->get('error_keyword');
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['category_id']) && $this->request->post['category_id']) {
          $this->sendCurl($this->request->post, 'category', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_category_edit');
        } else {
          $this->sendCurl($this->request->post, 'category', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_category_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_category_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_name'          => (isset($this->request->get['filter_name'])) ? trim($this->request->get['filter_name']) : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'c1.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'category_id'   => $result[$this->_code.'_category_id'],
        'heading'       => $result['name'],
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalCategories($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'category');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_category', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_category.tpl', $data));
    }
  }

  public function history_post() {
    $data = [];

    $models = [
      'setting/store',
      'localisation/language',
      'design/layout',
      'tool/image',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['post_id']) && $this->request->get['post_id']) ? $this->language->get('text_edit_post') : $this->language->get('text_add_post');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;
    $data['is_opencart_3000']    = (version_compare(VERSION, '3.0.0.0', '>=')) ? true : false;

    if (isset($this->request->get['post_id'])) {
      $data['post_id'] = $post_id = $this->request->get['post_id'];
    } else {
      $data['post_id'] = $post_id = 0;
    }

    if ((isset($this->request->get['post_id']) && $this->request->get['post_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($this->request->get['post_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['status'] = $post_info['status'];
    } else {
      $data['status'] = '1';
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    if (isset($this->request->post['post_store'])) {
      $data['stores'] = $this->request->post['post_store'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['stores'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostStores($this->request->get['post_id']);
    } else {
      $data['stores'] = [0];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    if (isset($this->request->post['post_customer_group'])) {
      $data['customer_groups'] = $this->request->post['post_customer_group'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['customer_groups'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostCustomerGroups($this->request->get['post_id']);
    } else {
      $data['customer_groups'] = [1];
    }

    if (isset($this->request->post['post_layout'])) {
      $data['post_layout'] = $this->request->post['post_layout'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['post_layout'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostLayouts($this->request->get['post_id']);
    } else {
      $data['post_layout'] = [];
    }

    $data['all_layouts'] = [];

    foreach ($this->model_design_layout->getLayouts() as $layout) {
      $data['all_layouts'][] = [
        'layout_id' => $layout['layout_id'],
        'name'      => $layout['name']
      ];
    }

    if (isset($this->request->post['author_id'])) {
      $data['author_id'] = $this->request->post['author_id'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['author_id'] = $post_info[$this->_code.'_author_id'];
    } else {
      $data['author_id'] = 0;
    }

    if (isset($this->request->post['author'])) {
      $data['author'] = $this->request->post['author'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $author_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor($post_info[$this->_code.'_author_id']);

      if ($author_info) {
        $data['author'] = $author_info['name'];
      } else {
        $data['author'] = '';
      }
    } else {
      $data['author'] = '';
    }

    if (isset($this->request->post['main_category_id'])) {
      $data['main_category_id'] = $this->request->post['main_category_id'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['main_category_id'] = $post_info[$this->_code.'_main_category_id'];
    } else {
      $data['main_category_id'] = 0;
    }

    if (isset($this->request->post['main_category'])) {
      $data['main_category'] = $this->request->post['main_category'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($post_info[$this->_code.'_main_category_id']);

      if ($category_info) {
        $data['main_category'] = $category_info['name'];
      } else {
        $data['main_category'] = '';
      }
    } else {
      $data['main_category'] = '';
    }

    if (isset($this->request->post['image'])) {
      $data['image'] = $this->request->post['image'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['image'] = $post_info['image'];
    } else {
      $data['image'] = '';
    }

    if (isset($this->request->post['image']) && is_file(DIR_IMAGE.$this->request->post['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 50, 50);
    } else if (isset($this->request->get['post_id']) && $post_info && is_file(DIR_IMAGE.$post_info['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($post_info['image'], 50, 50);
    } else {
      $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
    }

    if (isset($this->request->post['post_image'])) {
      $post_images = $this->request->post['post_image'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $post_images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostImages($this->request->get['post_id']);
    } else {
      $post_images = [];
    }

    $data['post_images'] = [];

    foreach ($post_images as $post_image) {
      if (is_file(DIR_IMAGE.$post_image['image'])) {
        $image = $post_image['image'];
        $thumb = $post_image['image'];
      } else {
        $image = '';
        $thumb = 'no_image.png';
      }

      $data['post_images'][] = [
        'image'      => $image,
        'thumb'      => $this->model_tool_image->resize($thumb, 50, 50),
        'sort_order' => $post_image['sort_order']
      ];
    }

    $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

    if (isset($this->request->post['sort_order'])) {
      $data['sort_order'] = $this->request->post['sort_order'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['sort_order'] = $post_info['sort_order'];
    } else {
      $data['sort_order'] = '0';
    }

    if (isset($this->request->post['show_description'])) {
      $data['show_description'] = $this->request->post['show_description'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['show_description'] = $post_info['show_description'];
    } else {
      $data['show_description'] = '1';
    }

    if (isset($this->request->post['show_main_image'])) {
      $data['show_main_image'] = $this->request->post['show_main_image'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['show_main_image'] = $post_info['show_main_image'];
    } else {
      $data['show_main_image'] = '1';
    }

    if (isset($this->request->post['video'])) {
      $data['video'] = $this->request->post['video'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['video'] = $post_info['video'];
    } else {
      $data['video'] = '';
    }

    if (isset($this->request->post['video_show_type'])) {
      $data['video_show_type'] = $this->request->post['video_show_type'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['video_show_type'] = $post_info['video_show_type'];
    } else {
      $data['video_show_type'] = '1';
    }

    if (isset($this->request->post['show_additional_image'])) {
      $data['show_additional_image'] = $this->request->post['show_additional_image'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['show_additional_image'] = $post_info['show_additional_image'];
    } else {
      $data['show_additional_image'] = '0';
    }

    if (isset($this->request->post['main_image_width'])) {
      $data['main_image_width'] = $this->request->post['main_image_width'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['main_image_width'] = $post_info['main_image_width'];
    } else {
      $data['main_image_width'] = '1140';
    }

    if (isset($this->request->post['main_image_height'])) {
      $data['main_image_height'] = $this->request->post['main_image_height'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['main_image_height'] = $post_info['main_image_height'];
    } else {
      $data['main_image_height'] = '400';
    }

    if (isset($this->request->post['main_image_popup_width'])) {
      $data['main_image_popup_width'] = $this->request->post['main_image_popup_width'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['main_image_popup_width'] = $post_info['main_image_popup_width'];
    } else {
      $data['main_image_popup_width'] = '1000';
    }

    if (isset($this->request->post['main_image_popup_height'])) {
      $data['main_image_popup_height'] = $this->request->post['main_image_popup_height'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['main_image_popup_height'] = $post_info['main_image_popup_height'];
    } else {
      $data['main_image_popup_height'] = '1000';
    }

    if (isset($this->request->post['additional_image_width'])) {
      $data['additional_image_width'] = $this->request->post['additional_image_width'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['additional_image_width'] = $post_info['additional_image_width'];
    } else {
      $data['additional_image_width'] = '270';
    }

    if (isset($this->request->post['additional_image_height'])) {
      $data['additional_image_height'] = $this->request->post['additional_image_height'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['additional_image_height'] = $post_info['additional_image_height'];
    } else {
      $data['additional_image_height'] = '95';
    }

    if (isset($this->request->post['post_description'])) {
      $data['post_description'] = $this->request->post['post_description'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['post_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostDescription($this->request->get['post_id']);
    } else {
      $data['post_description'] = [];
    }

    if (isset($this->request->post['date_available'])) {
      $data['date_available'] = $this->request->post['date_available'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $data['date_available'] = ($post_info['date_available'] != '0000-00-00') ? $post_info['date_available'] : '';
    } else {
      $data['date_available'] = date('Y-m-d');
    }

    if (isset($this->request->post['post_category'])) {
      $categories = $this->request->post['post_category'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $categories = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostCategories($this->request->get['post_id']);
    } else {
      $categories = [];
    }

    $data['post_categories'] = [];

    foreach ($categories as $category_id) {
      $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($category_id);

      if ($category_info) {
        $data['post_categories'][] = [
          'category_id' => $category_info[$this->_code.'_category_id'],
          'name'        => ($category_info['path']) ? $category_info['path'].' &gt; '.$category_info['name'] : $category_info['name']
        ];
      }
    }

    if (isset($this->request->post['post_related'])) {
      $posts = $this->request->post['post_related'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostRelatedPost($this->request->get['post_id']);
    } else {
      $posts = [];
    }

    $data['post_relateds'] = [];

    foreach ($posts as $post_id) {
      $related_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($post_id);

      if ($related_info) {
        $data['post_relateds'][] = [
          'post_id' => $related_info[$this->_code.'_post_id'],
          'name'    => $related_info['name']
        ];
      }
    }

    if (isset($this->request->post['product_related'])) {
      $products = $this->request->post['product_related'];
    } else if (isset($this->request->get['post_id']) && $post_info) {
      $products = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostRelatedProduct($this->request->get['post_id']);
    } else {
      $products = [];
    }

    $data['product_relateds'] = [];

    foreach ($products as $product_id) {
      $related_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getProduct($product_id);

      if ($related_info) {
        $data['product_relateds'][] = [
          'product_id' => $related_info['product_id'],
          'name'       => $related_info['name']
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['post_id']) && $post_info) {
        $data['keyword'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostSeoUrls($this->request->get['post_id']);
      } else {
        $data['keyword'] = [];
      }
    } else {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['post_id']) && $post_info) {
        $data['keyword'] = $post_info['keyword'];
      } else {
        $data['keyword'] = '';
      }
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/post_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/post_index.tpl', $data));
    }
  }

  public function history_post_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'post');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'post_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['post_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'post_keyword');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          foreach ($response_errors['response'] as $store_id => $language) {
            foreach ($language as $language_id => $error) {
              $json['error']['keyword'][$store_id][$language_id] = $this->language->get($error);
            }
          }
        } else {
          foreach ($response_errors['response'] as $key => $error) {
            $json['error'][$key] = $this->language->get($error);
          }
        }
      }

      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($this->request->post['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($keyword, 'keyword');

              foreach ($url_alias_info as $seo_url) {
                if (($seo_url['store_id'] == $store_id) && (!isset($this->request->post['post_id']) || ($seo_url['query'] != $this->_code.'_post_id='.$this->request->post['post_id']))) {
                  $json['error']['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
                  break;
                }
              }
            }
          }
        }
      } else {
        if (!isset($json['error'])) {
          $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($this->request->post['keyword'], 'keyword');

          if ($url_alias_info && isset($this->request->post['post_id']) && $url_alias_info['query'] != $this->_code.'_post_id='.$this->request->post['post_id']) {
            $json['error']['keyword'] = $this->language->get('error_keyword');
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['post_id']) && $this->request->post['post_id']) {
          $this->sendCurl($this->request->post, 'post', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_post_edit');
        } else {
          $this->sendCurl($this->request->post, 'post', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_post_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_post_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_name'           => (isset($this->request->get['filter_name'])) ? trim($this->request->get['filter_name']) : '',
      'filter_category'       => (isset($this->request->get['filter_category'])) ? $this->request->get['filter_category'] : '',
      'filter_date_added'     => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified'  => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_date_available' => (isset($this->request->get['filter_date_available'])) ? $this->request->get['filter_date_available'] : '',
      'filter_status'         => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                 => ($page - 1) * $limit,
      'limit'                 => $limit,
      'sort'                  => 'p.date_added',
      'order'                 => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

    foreach ($results as $result) {
      $categories = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostCategories($result[$this->_code.'_post_id']);

      $post_categories = [];

      foreach ($categories as $category_id) {
        $category_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory($category_id);

        if ($category_info) {
          $post_categories[] = [
            'category_id' => $category_info[$this->_code.'_category_id'],
            'name'        => ($category_info['path']) ? $category_info['path'].' &gt; '.$category_info['name'] : $category_info['name']
          ];
        }
      }

      $data['histories'][] = [
        'post_id'        => $result[$this->_code.'_post_id'],
        'heading'        => $result['name'],
        'categories'     => $post_categories,
        'date_added'     => $result['date_added'],
        'date_modified'  => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'date_available' => $result['date_available'],
        'status'         => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'post');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_post', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_post.tpl', $data));
    }
  }

  public function history_author() {
    $data = [];

    $models = [
      'setting/store',
      'localisation/language',
      'design/layout',
      'tool/image',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['author_id']) && $this->request->get['author_id']) ? $this->language->get('text_edit_author') : $this->language->get('text_add_author');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;
    $data['config_store_url']    = $this->config->get('config_secure') ? HTTPS_CATALOG : HTTP_CATALOG;
    $data['is_opencart_3000']    = (version_compare(VERSION, '3.0.0.0', '>=')) ? true : false;

    if (isset($this->request->get['author_id'])) {
      $data['author_id'] = $author_id = $this->request->get['author_id'];
    } else {
      $data['author_id'] = $author_id = 0;
    }

    if ((isset($this->request->get['author_id']) && $this->request->get['author_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $author_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor($this->request->get['author_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['status'] = $author_info['status'];
    } else {
      $data['status'] = '1';
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    if (isset($this->request->post['author_store'])) {
      $data['stores'] = $this->request->post['author_store'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['stores'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorStores($this->request->get['author_id']);
    } else {
      $data['stores'] = [0];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    if (isset($this->request->post['author_customer_group'])) {
      $data['customer_groups'] = $this->request->post['author_customer_group'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['customer_groups'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorCustomerGroups($this->request->get['author_id']);
    } else {
      $data['customer_groups'] = [1];
    }

    if (isset($this->request->post['author_layout'])) {
      $data['author_layout'] = $this->request->post['author_layout'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['author_layout'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorLayouts($this->request->get['author_id']);
    } else {
      $data['author_layout'] = [];
    }

    $data['all_layouts'] = [];

    foreach ($this->model_design_layout->getLayouts() as $layout) {
      $data['all_layouts'][] = [
        'layout_id' => $layout['layout_id'],
        'name'      => $layout['name']
      ];
    }

    if (isset($this->request->post['image'])) {
      $data['image'] = $this->request->post['image'];
    } else if (isset($this->request->get['pauthor_id']) && $author_info) {
      $data['image'] = $author_info['image'];
    } else {
      $data['image'] = '';
    }

    if (isset($this->request->post['image']) && is_file(DIR_IMAGE.$this->request->post['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 50, 50);
    } else if (isset($this->request->get['author_id']) && $author_info && is_file(DIR_IMAGE.$author_info['image'])) {
      $data['thumb'] = $this->model_tool_image->resize($author_info['image'], 50, 50);
    } else {
      $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
    }

    if (isset($this->request->post['author_image'])) {
      $author_images = $this->request->post['author_image'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $author_images = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorImages($this->request->get['author_id']);
    } else {
      $author_images = [];
    }

    $data['author_images'] = [];

    foreach ($author_images as $author_image) {
      if (is_file(DIR_IMAGE.$author_image['image'])) {
        $image = $author_image['image'];
        $thumb = $author_image['image'];
      } else {
        $image = '';
        $thumb = 'no_image.png';
      }

      $data['author_images'][] = [
        'image'      => $image,
        'thumb'      => $this->model_tool_image->resize($thumb, 50, 50),
        'sort_order' => $author_image['sort_order']
      ];
    }

    $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

    if (isset($this->request->post['sort_order'])) {
      $data['sort_order'] = $this->request->post['sort_order'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['sort_order'] = $author_info['sort_order'];
    } else {
      $data['sort_order'] = '0';
    }

    if (isset($this->request->post['sort_method'])) {
      $data['sort_method'] = $this->request->post['sort_method'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['sort_method'] = $author_info['sort_method'];
    } else {
      $data['sort_method'] = '1';
    }

    if (isset($this->request->post['show_description'])) {
      $data['show_description'] = $this->request->post['show_description'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['show_description'] = $author_info['show_description'];
    } else {
      $data['show_description'] = '1';
    }

    if (isset($this->request->post['description_position'])) {
      $data['description_position'] = $this->request->post['description_position'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['description_position'] = $author_info['description_position'];
    } else {
      $data['description_position'] = '1';
    }

    if (isset($this->request->post['show_main_image'])) {
      $data['show_main_image'] = $this->request->post['show_main_image'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['show_main_image'] = $author_info['show_main_image'];
    } else {
      $data['show_main_image'] = '0';
    }

    if (isset($this->request->post['show_additional_image'])) {
      $data['show_additional_image'] = $this->request->post['show_additional_image'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['show_additional_image'] = $author_info['show_additional_image'];
    } else {
      $data['show_additional_image'] = '0';
    }

    if (isset($this->request->post['main_image_width'])) {
      $data['main_image_width'] = $this->request->post['main_image_width'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['main_image_width'] = $author_info['main_image_width'];
    } else {
      $data['main_image_width'] = '1140';
    }

    if (isset($this->request->post['main_image_height'])) {
      $data['main_image_height'] = $this->request->post['main_image_height'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['main_image_height'] = $author_info['main_image_height'];
    } else {
      $data['main_image_height'] = '400';
    }

    if (isset($this->request->post['additional_image_popup_width'])) {
      $data['additional_image_popup_width'] = $this->request->post['additional_image_popup_width'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['additional_image_popup_width'] = $author_info['additional_image_popup_width'];
    } else {
      $data['additional_image_popup_width'] = '1000';
    }

    if (isset($this->request->post['additional_image_popup_height'])) {
      $data['additional_image_popup_height'] = $this->request->post['additional_image_popup_height'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['additional_image_popup_height'] = $author_info['additional_image_popup_height'];
    } else {
      $data['additional_image_popup_height'] = '1000';
    }

    if (isset($this->request->post['additional_image_width'])) {
      $data['additional_image_width'] = $this->request->post['additional_image_width'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['additional_image_width'] = $author_info['additional_image_width'];
    } else {
      $data['additional_image_width'] = '270';
    }

    if (isset($this->request->post['additional_image_height'])) {
      $data['additional_image_height'] = $this->request->post['additional_image_height'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['additional_image_height'] = $author_info['additional_image_height'];
    } else {
      $data['additional_image_height'] = '95';
    }

    if (isset($this->request->post['author_description'])) {
      $data['author_description'] = $this->request->post['author_description'];
    } else if (isset($this->request->get['author_id']) && $author_info) {
      $data['author_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorDescription($this->request->get['author_id']);
    } else {
      $data['author_description'] = [];
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['author_id']) && $author_info) {
        $data['keyword'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthorSeoUrls($this->request->get['author_id']);
      } else {
        $data['keyword'] = [];
      }
    } else {
      if (isset($this->request->post['keyword'])) {
        $data['keyword'] = $this->request->post['keyword'];
      } else if (isset($this->request->get['author_id']) && $author_info) {
        $data['keyword'] = $author_info['keyword'];
      } else {
        $data['keyword'] = '';
      }
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/author_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/author_index.tpl', $data));
    }
  }

  public function history_author_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'author');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'author_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['author_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'author_keyword');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        if (version_compare(VERSION, '3.0.0.0', '>=')) {
          foreach ($response_errors['response'] as $store_id => $language) {
            foreach ($language as $language_id => $error) {
              $json['error']['keyword'][$store_id][$language_id] = $this->language->get($error);
            }
          }
        } else {
          foreach ($response_errors['response'] as $key => $error) {
            $json['error'][$key] = $this->language->get($error);
          }
        }
      }

      if (version_compare(VERSION, '3.0.0.0', '>=')) {
        foreach ($this->request->post['keyword'] as $store_id => $language) {
          foreach ($language as $language_id => $keyword) {
            if (!empty($keyword)) {
              $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($keyword, 'keyword');

              foreach ($url_alias_info as $seo_url) {
                if (($seo_url['store_id'] == $store_id) && (!isset($this->request->post['author_id']) || ($seo_url['query'] != $this->_code.'_author_id='.$this->request->post['author_id']))) {
                  $json['error']['keyword'][$store_id][$language_id] = $this->language->get('error_keyword');
                  break;
                }
              }
            }
          }
        }
      } else {
        if (!isset($json['error'])) {
          $url_alias_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getSEOUrl($this->request->post['keyword'], 'keyword');

          if ($url_alias_info && isset($this->request->post['author_id']) && $url_alias_info['query'] != $this->_code.'_author_id='.$this->request->post['author_id']) {
            $json['error']['keyword'] = $this->language->get('error_keyword');
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['author_id']) && $this->request->post['author_id']) {
          $this->sendCurl($this->request->post, 'author', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_author_edit');
        } else {
          $this->sendCurl($this->request->post, 'author', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_author_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_author_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_name'          => (isset($this->request->get['filter_name'])) ? trim($this->request->get['filter_name']) : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'a.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthors($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'author_id'     => $result[$this->_code.'_author_id'],
        'heading'       => $result['name'],
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalAuthors($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'author');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_author', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_author.tpl', $data));
    }
  }

  public function history_comment() {
    $data = [];

    $models = [
      'setting/store',
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['comment_id']) && $this->request->get['comment_id']) ? $this->language->get('text_edit_comment') : $this->language->get('text_add_comment');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;

    if (isset($this->request->get['comment_id'])) {
      $data['comment_id'] = $comment_id = $this->request->get['comment_id'];
    } else {
      $data['comment_id'] = $comment_id = 0;
    }

    if ((isset($this->request->get['comment_id']) && $this->request->get['comment_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $comment_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment($this->request->get['comment_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['status'] = $comment_info['status'];
    } else {
      $data['status'] = '1';
    }

    $default_store = [
      0 => [
        'store_id' => 0,
        'name'     => $this->config->get('config_name').' (Default)'
      ]
    ];

    $all_stores = array_merge($this->model_setting_store->getStores(), $default_store);

    $data['all_stores'] = [];

    foreach ($all_stores as $store) {
      $data['all_stores'][] = [
        'store_id' => $store['store_id'],
        'name'     => $store['name']
      ];
    }

    if (isset($this->request->post['comment_store'])) {
      $data['stores'] = $this->request->post['comment_store'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['stores'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCommentStores($this->request->get['comment_id']);
    } else {
      $data['stores'] = [0];
    }

    $data['all_customer_groups'] = [];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $_model_customer_group = 'model_sale_customer_group';
    } else {
      $_model_customer_group = 'model_customer_customer_group';
    }

    foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
      $data['all_customer_groups'][] = [
        'customer_group_id' => $customer_group['customer_group_id'],
        'name'              => $customer_group['name']
      ];
    }

    if (isset($this->request->post['comment_customer_group'])) {
      $data['customer_groups'] = $this->request->post['comment_customer_group'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['customer_groups'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCommentCustomerGroups($this->request->get['comment_id']);
    } else {
      $data['customer_groups'] = [1];
    }

    if (isset($this->request->post['post_id'])) {
      $data['post_id'] = $this->request->post['post_id'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['post_id'] = $comment_info[$this->_code.'_post_id'];
    } else {
      $data['post_id'] = 0;
    }

    if (isset($this->request->post['respond_id'])) {
      $data['respond_id'] = $this->request->post['respond_id'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['respond_id'] = $comment_info['respond_id'];
    } else {
      $data['respond_id'] = 0;
    }

    if (isset($this->request->post['post'])) {
      $data['post'] = $this->request->post['post'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($comment_info[$this->_code.'_post_id']);

      if ($post_info) {
        $data['post'] = $post_info['name'];
      } else {
        $data['post'] = '';
      }
    } else {
      $data['post'] = '';
    }

    if (isset($this->request->post['firstname'])) {
      $data['firstname'] = $this->request->post['firstname'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['firstname'] = $comment_info['firstname'];
    } else {
      $data['firstname'] = '';
    }

    if (isset($this->request->post['email'])) {
      $data['email'] = $this->request->post['email'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['email'] = $comment_info['email'];
    } else {
      $data['email'] = '';
    }

    if (isset($this->request->post['notification_on_respond'])) {
      $data['notification_on_respond'] = $this->request->post['notification_on_respond'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['notification_on_respond'] = $comment_info['notification_on_respond'];
    } else {
      $data['notification_on_respond'] = '0';
    }

    if (isset($this->request->post['comment_description'])) {
      $data['comment_description'] = $this->request->post['comment_description'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['comment_description'] = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCommentDescription($this->request->get['comment_id']);
    } else {
      $data['comment_description'] = [];
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comment_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comment_index.tpl', $data));
    }
  }

  public function history_comment_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'comment');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      if ($this->request->post['post_id']) {
        $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($this->request->post['post_id']);

        if (!$post_info) {
          $json['error']['post'] = $this->language->get('error_for_all_field');
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'comment_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['comment_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['comment_id']) && $this->request->post['comment_id']) {
          $this->sendCurl($this->request->post, 'comment', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_comment_edit');
        } else {
          $this->sendCurl($this->request->post, 'comment', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_comment_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_comment_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_firstname'     => (isset($this->request->get['filter_firstname'])) ? trim($this->request->get['filter_firstname']) : '',
      'filter_email'         => (isset($this->request->get['filter_email'])) ? trim($this->request->get['filter_email']) : '',
      'filter_post'          => (isset($this->request->get['filter_post'])) ? $this->request->get['filter_post'] : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'c.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'comment_id'    => $result['comment_id'],
        'respond_id'    => $result['respond_id'],
        'post_id'       => $result[$this->_code.'_post_id'],
        'firstname'     => $result['firstname'],
        'email'         => ($result['email']) ? $result['email'] : $this->language->get('text_email_not_provided'),
        'post'          => $result['post'],
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'comment');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_comment', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_comment.tpl', $data));
    }
  }

  public function history_comment_respond() {
    $data = [];

    $models = [
      'setting/store',
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name
    ];

    if (version_compare(VERSION, '2.0.3.1', '<=')) {
      $models[] = 'sale/customer_group';
    } else {
      $models[] = 'customer/customer_group';
    }

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = $this->language->get('text_add_comment_respond');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;

    if (isset($this->request->get['comment_id'])) {
      $data['comment_id'] = $comment_id = $this->request->get['comment_id'];
    } else {
      $data['comment_id'] = $comment_id = 0;
    }

    if ((isset($this->request->get['comment_id']) && $this->request->get['comment_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $comment_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment($this->request->get['comment_id']);
    }

    if (isset($this->request->post['post_id'])) {
      $data['post_id'] = $this->request->post['post_id'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['post_id'] = $comment_info[$this->_code.'_post_id'];
    } else {
      $data['post_id'] = '0';
    }

    if (isset($this->request->post['firstname'])) {
      $data['firstname'] = $this->request->post['firstname'];
    } else if (isset($this->request->get['comment_id']) && $comment_info) {
      $data['firstname'] = $comment_info['firstname'];
    } else {
      $data['firstname'] = '';
    }

    $data['languages'] = [];

    foreach ($this->model_localisation_language->getLanguages() as $language) {
      if (version_compare(VERSION, '2.1.0.2.1', '<=')) {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'view/image/flags/'.$language['image']
        ];
      } else {
        $data['languages'][] = [
          'language_id' => $language['language_id'],
          'code'        => $language['code'],
          'name'        => $language['name'],
          'image'       => 'language/'.$language['code'].'/'.$language['code'].'.png'
        ];
      }
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comment_respond_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/comment_respond_index.tpl', $data));
    }
  }

  public function history_comment_respond_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'localisation/language',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'comment_respond');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      if ($this->request->post['post_id']) {
        $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($this->request->post['post_id']);

        if (!$post_info) {
          $json['error']['post'] = $this->language->get('error_for_all_field');
        }
      }

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'comment_respond_description');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $language) {
          foreach ($language as $language_id => $error) {
            $json['error']['comment_description_language'][$key][$language_id] = $this->language->get($error);
          }
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        $this->sendCurl($this->request->post, 'comment_respond', $license_key, 0, 'add');

        $json['success'] = $this->language->get('text_success_comment_add');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_banned() {
    $data = [];

    $models = ['extension/ocdevwizard/'.$this->_name];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));

    $data['text_modal_heading'] = (isset($this->request->get['banned_id']) && $this->request->get['banned_id']) ? $this->language->get('text_edit_banned') : $this->language->get('text_add_banned');

    $data['default_language_id'] = $this->config->get('config_language_id');
    $data['_name']               = $this->_name;
    $data['token']               = $this->_session_token;

    if (isset($this->request->get['banned_id'])) {
      $data['banned_id'] = $banned_id = $this->request->get['banned_id'];
    } else {
      $data['banned_id'] = $banned_id = 0;
    }

    if ((isset($this->request->get['banned_id']) && $this->request->get['banned_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      $banned_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanned($this->request->get['banned_id']);
    }

    if (isset($this->request->post['status'])) {
      $data['status'] = $this->request->post['status'];
    } else if (isset($this->request->get['banned_id']) && $banned_info) {
      $data['status'] = $banned_info['status'];
    } else {
      $data['status'] = '1';
    }

    if (isset($this->request->post['ip'])) {
      $data['ip'] = $this->request->post['ip'];
    } else if (isset($this->request->get['banned_id']) && $banned_info) {
      $data['ip'] = $banned_info['ip'];
    } else {
      $data['ip'] = '';
    }

    if (isset($this->request->post['email'])) {
      $data['email'] = $this->request->post['email'];
    } else if (isset($this->request->get['banned_id']) && $banned_info) {
      $data['email'] = $banned_info['email'];
    } else {
      $data['email'] = '';
    }

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/banned_index', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/banned_index.tpl', $data));
    }
  }

  public function history_banned_action() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if ($this->request->server['REQUEST_METHOD'] == 'POST') {
      $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

      $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

      $response_errors = $this->sendCurl($this->request->post, 'validate_data', $license_key, 0, 'banned');

      if ($response_errors['status'] == 200 && !empty($response_errors['response'])) {
        foreach ($response_errors['response'] as $key => $error) {
          $json['error'][$key] = $this->language->get($error);
        }
      }

      if (isset($json['error']) && !isset($json['error']['warning'])) {
        $json['error']['warning'] = $this->language->get('error_warning');
      }

      if (!isset($json['error'])) {
        if (isset($this->request->post['banned_id']) && $this->request->post['banned_id']) {
          $this->sendCurl($this->request->post, 'banned', $license_key, 0, 'edit');

          $json['success'] = $this->language->get('text_success_banned_edit');
        } else {
          $this->sendCurl($this->request->post, 'banned', $license_key, 0, 'add');

          $json['success'] = $this->language->get('text_success_banned_add');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function history_banned_list() {
    $data = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data          = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name));
    $page          = (isset($this->request->get['page'])) ? $this->request->get['page'] : 1;
    $limit         = 10;
    $data['_name'] = $this->_name;
    $data['token'] = $this->_session_token;

    $data['histories'] = [];

    $filter_data = [
      'filter_ip'            => (isset($this->request->get['filter_ip'])) ? trim($this->request->get['filter_ip']) : '',
      'filter_email'         => (isset($this->request->get['filter_email'])) ? trim($this->request->get['filter_email']) : '',
      'filter_date_added'    => (isset($this->request->get['filter_date_added'])) ? $this->request->get['filter_date_added'] : '',
      'filter_date_modified' => (isset($this->request->get['filter_date_modified'])) ? $this->request->get['filter_date_modified'] : '',
      'filter_status'        => (isset($this->request->get['filter_status'])) ? $this->request->get['filter_status'] : '*',
      'start'                => ($page - 1) * $limit,
      'limit'                => $limit,
      'sort'                 => 'b.date_added',
      'order'                => 'DESC'
    ];

    $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanneds($filter_data);

    foreach ($results as $result) {
      $data['histories'][] = [
        'banned_id'     => $result['banned_id'],
        'ip'            => $result['ip'],
        'email'         => ($result['email']) ? $result['email'] : $this->language->get('text_email_not_provided'),
        'date_added'    => $result['date_added'],
        'date_modified' => ($result['date_modified'] != '0000-00-00 00:00:00') ? $result['date_modified'] : $this->language->get('text_not_changed'),
        'status'        => $result['status'] ? $this->language->get('text_status_enabled') : $this->language->get('text_status_disabled')
      ];
    }

    $history_total = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalBanneds($filter_data);

    $filter_data = [
      'total' => $history_total,
      'page'  => $page,
      'limit' => $limit,
      'token' => $this->_session_token
    ];

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

    $response_info = $this->sendCurl($filter_data, 'pagination', $license_key, 0, 'banned');

    $data['pagination'] = ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : '';

    $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($history_total - $limit)) ? $history_total : ((($page - 1) * $limit) + $limit), $history_total, ceil($history_total / $limit));

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_banned', $data));
    } else {
      $this->response->setOutput($this->load->view('extension/ocdevwizard/'.$this->_name.'/history_banned.tpl', $data));
    }
  }

  public function save_css() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if (isset($this->request->post['code']) && !empty($this->request->post['code']) && isset($this->request->post['stylesheet']) && !empty($this->request->post['stylesheet'])) {
        if (is_file(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet'].'.css')) {
          file_put_contents(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet'].'.css', str_replace([
            "&amp;gt;",
            "&gt;"
          ], ">", $this->request->post['code']));
          $json['success'] = $this->language->get('text_success_css_saved');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function restore_css() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if (is_file(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet'].'.css') && is_file(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet_default'].'.css')) {
        if (isset($this->request->post['stylesheet']) && !empty($this->request->post['stylesheet']) && isset($this->request->post['stylesheet_default']) && !empty($this->request->post['stylesheet_default'])) {
          $stylesheet_data = file_get_contents(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet_default'].'.css');
          file_put_contents(DIR_CATALOG.'view/theme/default/stylesheet/ocdevwizard/'.$this->_name.'/'.$this->request->post['stylesheet'].'.css', str_replace([
            "&amp;gt;",
            "&gt;"
          ], ">", $stylesheet_data));
          $json['success'] = $this->language->get('text_success_css_restored');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function delete_all() {
    $json = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (isset($this->request->get['type']) && $this->request->get['type']) {
      $type = $this->request->get['type'];
    } else {
      $type = '';
    }

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if ($type) {

        $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

        $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

        if ($type == 'module') {
          $result = $this->sendCurl([], 'module', $license_key, 0, 'delete_all');
        } else if ($type == 'category') {
          $result = $this->sendCurl([], 'category', $license_key, 0, 'delete_all');
        } else if ($type == 'post') {
          $result = $this->sendCurl([], 'post', $license_key, 0, 'delete_all');
        } else if ($type == 'author') {
          $result = $this->sendCurl([], 'author', $license_key, 0, 'delete_all');
        } else if ($type == 'comment') {
          $result = $this->sendCurl([], 'comment', $license_key, 0, 'delete_all');
        } else if ($type == 'banned') {
          $result = $this->sendCurl([], 'banned', $license_key, 0, 'delete_all');
        } else if ($type == 'email-template') {
          $result = $this->sendCurl([], 'email_template', $license_key, 0, 'delete_all');
        }

        if (!isset($result) || !$result) {
          $json['error'] = $this->language->get('error_task');
        } else {
          $json['success'] = $this->language->get('text_success_task');
        }
      } else {
        $json['error'] = $this->language->get('error_task');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function delete_selected() {
    $json = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (isset($this->request->get['type']) && $this->request->get['type']) {
      $type = $this->request->get['type'];
    } else {
      $type = '';
    }

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if ($type) {

        $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

        $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

        if ($type == 'module') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModule((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['module_id' => (int)$this->request->get['delete']], 'module', $license_key, 0, 'delete');
          }
        } else if ($type == 'category') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['category_id' => (int)$this->request->get['delete']], 'category', $license_key, 0, 'delete');
          }
        } else if ($type == 'post') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['post_id' => (int)$this->request->get['delete']], 'post', $license_key, 0, 'delete');
          }
        } else if ($type == 'author') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['author_id' => (int)$this->request->get['delete']], 'author', $license_key, 0, 'delete');
          }
        } else if ($type == 'comment') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['comment_id' => (int)$this->request->get['delete']], 'comment', $license_key, 0, 'delete');
          }
        } else if ($type == 'banned') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanned((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['banned_id' => (int)$this->request->get['delete']], 'banned', $license_key, 0, 'delete');
          }
        } else if ($type == 'email-template') {
          $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplate((int)$this->request->get['delete']);

          if ($info) {
            $result = $this->sendCurl(['template_id' => (int)$this->request->get['delete']], 'email_template', $license_key, 0, 'delete');
          }
        }

        if (!isset($result) || !$result) {
          $json['error'] = $this->language->get('error_task');
        } else {
          $json['success'] = $this->language->get('text_success_task');
        }
      } else {
        $json['error'] = $this->language->get('error_task');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function delete_all_selected() {
    $json = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (isset($this->request->get['type']) && $this->request->get['type']) {
      $type = $this->request->get['type'];
    } else {
      $type = '';
    }

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if ($type) {

        $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

        $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

        if ($type == 'module') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $module_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModule((int)$module_id);

              if ($info) {
                $result = $this->sendCurl(['module_id' => (int)$module_id], 'module', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'category') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $category_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory((int)$category_id);

              if ($info) {
                $result = $this->sendCurl(['category_id' => (int)$category_id], 'category', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'post') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $post_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost((int)$post_id);

              if ($info) {
                $result = $this->sendCurl(['post_id' => (int)$post_id], 'post', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'author') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $author_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor((int)$author_id);

              if ($info) {
                $result = $this->sendCurl(['author_id' => (int)$author_id], 'author', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'comment') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $comment_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment((int)$comment_id);

              if ($info) {
                $result = $this->sendCurl(['comment_id' => (int)$comment_id], 'comment', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'banned') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $banned_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanned((int)$banned_id);

              if ($info) {
                $result = $this->sendCurl(['banned_id' => (int)$banned_id], 'banned', $license_key, 0, 'delete');
              }
            }
          }
        } else if ($type == 'email-template') {
          if (isset($this->request->request['selected'])) {
            foreach ($this->request->request['selected'] as $template_id) {
              $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplate((int)$template_id);

              if ($info) {
                $result = $this->sendCurl(['template_id' => (int)$template_id], 'email_template', $license_key, 0, 'delete');
              }
            }
          }
        }

        if (!isset($result) || !$result) {
          $json['error'] = $this->language->get('error_task');
        } else {
          $json['success'] = $this->language->get('text_success_task');
        }
      } else {
        $json['error'] = $this->language->get('error_task');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function copy_selected() {
    $json = [];

    $models = [
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (isset($this->request->get['type']) && $this->request->get['type']) {
      $type = $this->request->get['type'];
    } else {
      $type = '';
    }

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $json['error'] = $this->language->get('error_permission');
    } else {
      if ($type) {
        if (isset($this->request->get['copy']) && $this->request->get['copy']) {

          $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

          $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

          if ($type == 'module') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModule((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['module_id' => (int)$this->request->get['copy']], 'module', $license_key, 0, 'copy');
            }
          } else if ($type == 'category') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategory((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['category_id' => (int)$this->request->get['copy']], 'category', $license_key, 0, 'copy');
            }
          } else if ($type == 'post') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['post_id' => (int)$this->request->get['copy']], 'post', $license_key, 0, 'copy');
            }
          } else if ($type == 'author') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthor((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['author_id' => (int)$this->request->get['copy']], 'author', $license_key, 0, 'copy');
            }
          } else if ($type == 'comment') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComment((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['comment_id' => (int)$this->request->get['copy']], 'comment', $license_key, 0, 'copy');
            }
          } else if ($type == 'banned') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanned((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['banned_id' => (int)$this->request->get['copy']], 'banned', $license_key, 0, 'copy');
            }
          } else if ($type == 'email-template') {
            $info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplate((int)$this->request->get['copy']);

            if ($info) {
              $result = $this->sendCurl(['template_id' => (int)$this->request->get['copy']], 'email_template', $license_key, 0, 'copy');
            }
          }

          if (!isset($result) || !$result) {
            $json['error'] = $this->language->get('error_task');
          } else {
            $json['success'] = $this->language->get('text_success_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      } else {
        $json['error'] = $this->language->get('error_task');
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function get_promo_products() {
    $json = [];

    $models = ['extension/ocdevwizard/'.$this->_name];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $json['product']                 = [];
    $json['opencart_version_array']  = [];
    $json['opencart_features_array'] = [];

    if (isset($this->request->get['extension_id']) && !empty($this->request->get['extension_id'])) {
      $products = $this->{'model_extension_ocdevwizard_'.$this->_name}->getOCdevCatalog();

      if ($products) {
        foreach ($products as $product) {
          if ($product['extension_id'] == $this->request->get['extension_id']) {
            $json['product'] = $product;
          }
        }
      }

      if ($json['product']) {
        $json['opencart_version_array']  = explode(',', $json['product']['opencart_version']);
        $json['opencart_features_array'] = explode(';', $json['product']['features']);
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function get_config_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_module_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_category_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_post_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_author_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_comment_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_banned_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_vote_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function get_email_template_backup_files() {
    $files = [];

    if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template')) {
      $dir = opendir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template');

      while (($file = readdir($dir)) !== false) {
        if (in_array(substr(strrchr($file, '.'), 1), ['json'])) {
          $files[] = (DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template/'.$file);
        }
      }

      closedir($dir);
    }

    return $files;
  }

  public function export_config_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/ocdevwizard_setting'];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $config_settings = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_config_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($config_settings));
      }

      $this->response->setOutput(serialize($config_settings));
    }
  }

  public function import_config_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/config/'.$this->request->post['file_name']);

          $config = unserialize($content);

          if ($config) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl($config, 'edit_setting', $license_key, $store_id, 'import');

            $json['success'] = $this->language->get('text_success_config_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_email_template_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $email_template_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportEmailTemplates();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_email_template_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($email_template_settings));
      }

      $this->response->setOutput(serialize($email_template_settings));
    }
  }

  public function import_email_template_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/email_template/'.$this->request->post['file_name']);

          $email_templates = unserialize($content);

          if ($email_templates) {

            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'email_template', $license_key, $store_id, 'prepare');

            foreach ($email_templates as $email_template) {
              $this->sendCurl($email_template, 'email_template', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_email_template_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_module_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $module_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportModules();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_module_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($module_settings));
      }

      $this->response->setOutput(serialize($module_settings));
    }
  }

  public function import_module_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/module/'.$this->request->post['file_name']);

          $modules = unserialize($content);

          if ($modules) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'module', $license_key, $store_id, 'prepare');

            foreach ($modules as $module) {
              $this->sendCurl($module, 'module', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_module_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_category_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $category_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportCategories();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_category_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($category_settings));
      }

      $this->response->setOutput(serialize($category_settings));
    }
  }

  public function import_category_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/category/'.$this->request->post['file_name']);

          $categories = unserialize($content);

          if ($categories) {

            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'category', $license_key, $store_id, 'prepare');

            foreach ($categories as $category) {
              $this->sendCurl($category, 'category', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_category_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_post_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $post_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportPosts();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_post_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($post_settings));
      }

      $this->response->setOutput(serialize($post_settings));
    }
  }

  public function import_post_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/post/'.$this->request->post['file_name']);

          $posts = unserialize($content);

          if ($posts) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'post', $license_key, $store_id, 'prepare');

            foreach ($posts as $post) {
              $this->sendCurl($post, 'post', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_post_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_author_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $author_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportAuthors();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_author_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($author_settings));
      }

      $this->response->setOutput(serialize($author_settings));
    }
  }

  public function import_author_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/author/'.$this->request->post['file_name']);

          $authors = unserialize($content);

          if ($authors) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'author', $license_key, $store_id, 'prepare');

            foreach ($authors as $author) {
              $this->sendCurl($author, 'author', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_author_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_comment_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $comment_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportComments();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_comment_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($comment_settings));
      }

      $this->response->setOutput(serialize($comment_settings));
    }
  }

  public function import_comment_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/comment/'.$this->request->post['file_name']);

          $comments = unserialize($content);

          if ($comments) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'comment', $license_key, $store_id, 'prepare');

            foreach ($comments as $comment) {
              $this->sendCurl($comment, 'comment', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_comment_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_banned_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $banned_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportBanneds();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_banned_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($banned_settings));
      }

      $this->response->setOutput(serialize($banned_settings));
    }
  }

  public function import_banned_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/banned/'.$this->request->post['file_name']);

          $banneds = unserialize($content);

          if ($banneds) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'banned', $license_key, $store_id, 'prepare');

            foreach ($banneds as $banned) {
              $this->sendCurl($banned, 'banned', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_banned_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function export_vote_settings() {
    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $vote_settings = $this->{'model_extension_ocdevwizard_'.$this->_name}->getExportVotes();

      $this->response->addHeader('Pragma: public');
      $this->response->addHeader('Expires: 0');
      $this->response->addHeader('Content-Description: File Transfer');
      $this->response->addHeader('Content-Type: text/plain');
      $this->response->addHeader('Content-Disposition: attachment; filename='.$this->_name.'_vote_'.date("Y-m-d H:i:s", time()).'_'.$store_id.'.json');
      $this->response->addHeader('Content-Transfer-Encoding: binary');

      if (is_dir(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote')) {
        file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote/'.date("Y-m-d_H-i-s", time()).'_'.$store_id.'.json', serialize($vote_settings));
      }

      $this->response->setOutput(serialize($vote_settings));
    }
  }

  public function import_vote_settings() {
    $json = [];

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;

    if (!$this->user->hasPermission('modify', 'extension/ocdevwizard/'.$this->_name)) {
      $this->session->data['warning'] = $this->language->get('error_permission');

      $this->response->redirect($this->url->link('extension/ocdevwizard/'.$this->_name.'/base', $this->_session_token.'&store_id='.$store_id, $this->_ssl_code));
    } else {
      if (isset($this->request->post['file_name']) && !empty($this->request->post['file_name'])) {
        $models = ['extension/ocdevwizard/ocdevwizard_setting'];

        foreach ($models as $model) {
          $this->load->model($model);
        }

        if (is_file(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote/'.$this->request->post['file_name'])) {
          $content = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/vote/'.$this->request->post['file_name']);

          $votes = unserialize($content);

          if ($votes) {
            $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, $store_id);

            $license_key = (isset($setting_info[$this->_name.'_license'])) ? $setting_info[$this->_name.'_license'] : '';

            $this->sendCurl([], 'vote', $license_key, $store_id, 'prepare');

            foreach ($votes as $vote) {
              $this->sendCurl($vote, 'vote', $license_key, $store_id, 'import');
            }

            $json['success'] = $this->language->get('text_success_vote_restored');
          } else {
            $json['error'] = $this->language->get('error_task');
          }
        } else {
          $json['error'] = $this->language->get('error_task');
        }
      }
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_email_template() {
    $json = [];

    if (isset($this->request->request['filter_email_template'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name'                 => $this->request->request['filter_email_template'],
        'filter_group_email_template' => true
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getEmailTemplates($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'        => $result['name'],
          'template_id' => $result['template_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_category() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name'           => $this->request->request['filter_name'],
        'filter_group_category' => true,
        'start'                 => 0,
        'limit'                 => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'category_id' => $result[$this->_code.'_category_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_post() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name' => $this->request->request['filter_name'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'    => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'post_id' => $result[$this->_code.'_post_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_comment() {
    $json = [];

    if (isset($this->request->request['filter_post'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_post' => $this->request->request['filter_post'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'    => strip_tags(html_entity_decode($result['post'], ENT_QUOTES, 'UTF-8')),
          'post_id' => $result[$this->_code.'_post_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    if (isset($this->request->request['filter_firstname'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_firstname' => $this->request->request['filter_firstname'],
        'start'            => 0,
        'limit'            => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'firstname'  => strip_tags(html_entity_decode($result['firstname'], ENT_QUOTES, 'UTF-8')),
          'comment_id' => $result['comment_id']
        ];
      }

      $json = $this->mu_array($json, 'firstname');
    }

    if (isset($this->request->request['filter_email'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_email' => $this->request->request['filter_email'],
        'start'        => 0,
        'limit'        => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'email'      => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
          'comment_id' => $result['comment_id']
        ];
      }

      $json = $this->mu_array($json, 'email');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_banned() {
    $json = [];

    if (isset($this->request->request['filter_ip'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_ip' => $this->request->request['filter_ip'],
        'start'     => 0,
        'limit'     => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanneds($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'ip'        => $result['ip'],
          'banned_id' => $result['banned_id']
        ];
      }

      $json = $this->mu_array($json, 'ip');
    }

    if (isset($this->request->request['filter_email'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_email' => $this->request->request['filter_email'],
        'start'        => 0,
        'limit'        => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getBanneds($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'email'     => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
          'banned_id' => $result['banned_id']
        ];
      }

      $json = $this->mu_array($json, 'email');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  private function mu_array($array, $key) {
    $models = ['extension/ocdevwizard/ocdevwizard_setting'];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $setting_info = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSetting($this->_name, 0);

    if (isset($setting_info[$this->_name.'_license'])) {
      $license_key = $setting_info[$this->_name.'_license'];
    } else {
      $license_key = '';
    }

    $response_info = $this->sendCurl([
      'array' => $array,
      'key'   => $key
    ], 'mu_array', $license_key, 0);

    return ($response_info['status'] == 200 && !empty($response_info['response'])) ? $response_info['response'] : [];
  }

  public function autocomplete_post_categories() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name' => $this->request->request['filter_name'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPostCategoriesForFilter($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'category_id' => $result[$this->_code.'_category_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_product() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name' => $this->request->request['filter_name'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getProducts($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'product_id' => $result['product_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_author() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name' => $this->request->request['filter_name'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getAuthors($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'author_id' => $result[$this->_code.'_author_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function autocomplete_module() {
    $json = [];

    if (isset($this->request->request['filter_name'])) {
      $models = ['extension/ocdevwizard/'.$this->_name];

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $filter_data = [
        'filter_name' => $this->request->request['filter_name'],
        'start'       => 0,
        'limit'       => 10
      ];

      $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModules($filter_data);

      foreach ($results as $result) {
        $json[] = [
          'name'      => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
          'module_id' => $result['module_id']
        ];
      }

      $json = $this->mu_array($json, 'name');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  private function day_formatting($n, $form1, $form2) {
    $n  = abs($n) % 100;
    $n1 = $n % 10;

    if ($n > 10 && $n < 20) {
      return $form2;
    }

    if ($n1 == 1) {
      return $form1;
    }

    return $form2;
  }

  public function widget() {
    $data = [];

    $models = ['extension/ocdevwizard/'.$this->_name];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name.'_widget'));

    $today = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments(['filter_date_added' => date('Y-m-d', strtotime('-1 day'))]);

    $yesterday = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments(['filter_date_added' => date('Y-m-d', strtotime('-2 day'))]);

    $difference = $today - $yesterday;

    $data['total_new'] = $difference;
    $data['total1']    = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalCategories();
    $data['total2']    = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalPosts();
    $data['total3']    = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalAuthors();
    $data['total4']    = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTotalComments();
    $data['link']      = $this->url->link('extension/ocdevwizard/'.$this->_name, $this->_session_token, $this->_ssl_code);

    if (version_compare(VERSION, '3.0.0.0', '>=')) {
      return $this->load->view('extension/ocdevwizard/'.$this->_name.'/widget', $data);
    } else {
      return $this->load->view('extension/ocdevwizard/'.$this->_name.'/widget.tpl', $data);
    }
  }

  private function checkRemoteFile() {
    $file         = 'http://api.ocdevwizard.com/License/'.$this->_code.'/index.html';
    $file_headers = @get_headers($file);

    if (isset($file_headers[0]) && strpos($file_headers[0], '200 OK')) {
      return true;
    } else {
      return false;
    }
  }

  public function send_license_code_request() {
    $json = [];

    $models = ['extension/ocdevwizard/'.$this->_name];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $this->language->load('extension/ocdevwizard/'.$this->_name);

    if (!isset($this->request->post['email']) || empty($this->request->post['email'])) {
      $json['error']['email'] = $this->language->get('error_for_all_field');
    }

    if (!isset($this->request->post['order_id']) || empty($this->request->post['order_id'])) {
      $json['error']['order_id'] = $this->language->get('error_for_all_field');
    }

    if (!isset($this->request->post['marketplace']) || empty($this->request->post['marketplace'])) {
      $json['error']['marketplace'] = $this->language->get('error_for_all_field');
    }

    if (!isset($this->request->post['domain']) || empty($this->request->post['domain'])) {
      $json['error']['domain'] = $this->language->get('error_for_all_field');
    }

    if (!isset($json['error'])) {
      $filter_data = [
        'email'              => $this->request->post['email'],
        'order_id'           => $this->request->post['order_id'],
        'marketplace'        => $this->request->post['marketplace'],
        'domain'             => $this->request->post['domain'],
        'test_domain_status' => (isset($this->request->post['test_domain_status'])) ? 1 : 0,
        'test_domain'        => $this->request->post['test_domain']
      ];

      $this->{'model_extension_ocdevwizard_'.$this->_name}->sendLicenseRequest($filter_data);

      $json['success'] = $this->language->get('text_success_send_answer');
    }

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  private function sendCurl($data, $type, $license_key, $store_id = 0, $sub_type = '') {
    $data['referer']          = (string)($this->config->get('config_secure')) ? HTTPS_CATALOG : HTTP_CATALOG;
    $data['request_type']     = (string)$type;
    $data['sub_type']         = (string)$sub_type;
    $data['version']          = (string)$this->_version;
    $data['opencart_version'] = VERSION;
    $data['access_token']     = (string)$access_token = md5(time().rand());
    $data['store_id']         = (int)$store_id;

    if ($type != 'validate_access' && $type != 'validate_data' && $type != 'base' && $type != 'mu_array' && $type != 'pagination' && $type != 'form_data') {
      file_put_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.access', $access_token);
    }

    if ($type == 'default' || $type == 'restore') {
      $this->language->load('extension/ocdevwizard/'.$this->_name);

      $models = ['localisation/language'];

      if (version_compare(VERSION, '2.0.3.1', '<=')) {
        $models[] = 'sale/customer_group';
      } else {
        $models[] = 'customer/customer_group';
      }

      foreach ($models as $model) {
        $this->load->model($model);
      }

      $languages = $this->model_localisation_language->getLanguages();

      foreach ($languages as $language) {
        $data['direction_type'][$language['language_id']] = 1;
      }

      $data['default_vote_customer_groups']               = [];
      $data['default_comment_customer_groups_write_data'] = [];
      $data['default_comment_customer_groups_see_data']   = [];

      if (version_compare(VERSION, '2.0.3.1', '<=')) {
        $_model_customer_group = 'model_sale_customer_group';
      } else {
        $_model_customer_group = 'model_customer_customer_group';
      }

      foreach ($this->{$_model_customer_group}->getCustomerGroups() as $customer_group) {
        $data['default_vote_customer_groups'][]               = $customer_group['customer_group_id'];
        $data['default_comment_customer_groups_write_data'][] = $customer_group['customer_group_id'];
        $data['default_comment_customer_groups_see_data'][]   = $customer_group['customer_group_id'];
      }

      $data['admin_email']   = (string)$this->config->get('config_email');
      $data['heading_title'] = (string)$this->language->get('heading_title');
    }

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://api.ocdevwizard.com/License/'.$this->_code.'/?pk=6bYh3UaMRm&lc='.$license_key);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, serialize($data));

    $response_data = curl_exec($curl);
    $httpcode_data = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    $results = [
      'status'   => (int)$httpcode_data,
      'response' => json_decode($response_data, true)
    ];

    return $results;
  }
}

?>
