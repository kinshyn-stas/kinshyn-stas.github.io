<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ControllerExtensionOcdevwizardSmartBlogProPlusStatic extends Controller {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';

  public function index($setting) {
    static $module = 0;

    $data = [];

    $models = [
      'tool/image',
      'extension/ocdevwizard/'.$this->_name,
      'extension/ocdevwizard/ocdevwizard_setting'
    ];

    foreach ($models as $model) {
      $this->load->model($model);
    }

    $data = array_merge($data, $this->language->load('extension/ocdevwizard/'.$this->_name), $setting);

    $form_data = $this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData($this->_name.'_form_data', (int)$this->config->get('config_store_id'));

    if (isset($form_data['activate']) && $form_data['activate'] && $setting) {
      $language_id = $this->{'model_extension_ocdevwizard_'.$this->_name}->getLanguageByCode($this->session->data['language']);

      $data['heading_title']    = $setting['name'];
      $data['button_read_more'] = $setting['read_more'];

      $data['_name']          = $this->_name;
      $data['_code']          = $this->_code;
      $data['_language_code'] = substr($this->session->data['language'], 0, 2);

      $data['search'] = (isset($thos->request->get[$this->_code.'_search'])) ? $thos->request->get[$this->_code.'_search'] : '';

      $find = [
        '{1}',
        '{2}',
        '{3}',
        '{4}',
        '{5}'
      ];

      $replace = [
        12,
        6,
        4,
        3,
        2
      ];

      $data['adaptive_setting_0_bootstrap'] = str_replace($find, $replace, '{'.$setting['adaptive_setting_0'].'}');
      $data['adaptive_setting_1_bootstrap'] = str_replace($find, $replace, '{'.$setting['adaptive_setting_1'].'}');
      $data['adaptive_setting_2_bootstrap'] = str_replace($find, $replace, '{'.$setting['adaptive_setting_2'].'}');
      $data['adaptive_setting_3_bootstrap'] = str_replace($find, $replace, '{'.$setting['adaptive_setting_3'].'}');
      $data['adaptive_setting_4_bootstrap'] = str_replace($find, $replace, '{'.$setting['adaptive_setting_4'].'}');

      $data['results'] = [];

      if ($setting['display_type'] == 1) {
        $filter_data = [
          'filter_data' => $setting
        ];

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getArchive2Module($filter_data);

        if ($results) {
          foreach ($results as $result) {
            $data['results'][] = [
              'name' => $result['month'].' '.$result['year'].' ('.$result['total'].')',
              'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search&'.$this->_code.'_archive='.$result['month'].' '.$result['year'])
            ];
          }
        }

        $template = 'archive';
      } else if ($setting['display_type'] == 2) {
        if (isset($this->request->get[$this->_code.'_path'])) {
          $parts = explode('_', (string)$this->request->get[$this->_code.'_path']);
        } else {
          $parts = [];
        }

        if (isset($parts[0])) {
          $data['category_id'] = $parts[0];
        } else {
          $data['category_id'] = 0;
        }

        if (isset($parts[1])) {
          $data['child_id'] = $parts[1];
        } else {
          $data['child_id'] = 0;
        }

        if (isset($parts[2])) {
          $data['child_2lv_id'] = $parts[2];
        } else {
          $data['child_2lv_id'] = 0;
        }

        if (isset($parts[3])) {
          $data['child_3lv_id'] = $parts[3];
        } else {
          $data['child_3lv_id'] = 0;
        }

        if (isset($parts[4])) {
          $data['child_4lv_id'] = $parts[4];
        } else {
          $data['child_4lv_id'] = 0;
        }

        if (isset($parts[5])) {
          $data['child_5lv_id'] = $parts[5];
        } else {
          $data['child_5lv_id'] = 0;
        }

        $filter_data = [
          'filter_data' => $setting
        ];

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories2Module(0, $filter_data);

        if ($results) {
          foreach ($results as $result) {
            // 2lv
            $children_data_2lv = [];

            $children_2lv = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories2Module($result[$this->_code.'_category_id'], $filter_data);

            if ($children_2lv) {
              foreach ($children_2lv as $child_2lv) {
                $image_2lv = ($child_2lv['image']) ? $this->model_tool_image->resize($child_2lv['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

                // 3lv
                $children_data_3lv = [];

                $children_3lv = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories2Module($child_2lv[$this->_code.'_category_id'], $filter_data);

                if ($children_3lv) {
                  foreach ($children_3lv as $child_3lv) {
                    $image_3lv = ($child_3lv['image']) ? $this->model_tool_image->resize($child_3lv['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

                    // 4lv
                    $children_data_4lv = [];

                    $children_4lv = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories2Module($child_3lv[$this->_code.'_category_id'], $filter_data);

                    if ($children_4lv) {
                      foreach ($children_4lv as $child_4lv) {
                        $image_4lv = ($child_4lv['image']) ? $this->model_tool_image->resize($child_4lv['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

                        // 5lv
                        $children_data_5lv = [];

                        $children_5lv = $this->{'model_extension_ocdevwizard_'.$this->_name}->getCategories2Module($child_4lv[$this->_code.'_category_id'], $filter_data);

                        if ($children_5lv) {
                          foreach ($children_5lv as $child_5lv) {
                            $image_5lv = ($child_5lv['image']) ? $this->model_tool_image->resize($child_5lv['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

                            $children_data_5lv[] = [
                              'category_id' => $child_5lv[$this->_code.'_category_id'],
                              'name'        => $child_5lv['name'],
                              'image'       => $image_5lv,
                              'href'        => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$result[$this->_code.'_category_id'].'_'.$child_2lv[$this->_code.'_category_id'].'_'.$child_3lv[$this->_code.'_category_id'].'_'.$child_4lv[$this->_code.'_category_id'].'_'.$child_5lv[$this->_code.'_category_id'])
                            ];
                          }
                        }

                        $children_data_4lv[] = [
                          'category_id' => $child_4lv[$this->_code.'_category_id'],
                          'name'        => $child_4lv['name'],
                          'image'       => $image_4lv,
                          'children'    => $children_data_5lv,
                          'href'        => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$result[$this->_code.'_category_id'].'_'.$child_2lv[$this->_code.'_category_id'].'_'.$child_3lv[$this->_code.'_category_id'].'_'.$child_4lv[$this->_code.'_category_id'])
                        ];
                      }
                    }

                    $children_data_3lv[] = [
                      'category_id' => $child_3lv[$this->_code.'_category_id'],
                      'name'        => $child_3lv['name'],
                      'image'       => $image_3lv,
                      'children'    => $children_data_4lv,
                      'href'        => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$result[$this->_code.'_category_id'].'_'.$child_2lv[$this->_code.'_category_id'].'_'.$child_3lv[$this->_code.'_category_id'])
                    ];
                  }
                }

                $children_data_2lv[] = [
                  'category_id' => $child_2lv[$this->_code.'_category_id'],
                  'name'        => $child_2lv['name'],
                  'image'       => $image_2lv,
                  'children'    => $children_data_3lv,
                  'href'        => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$result[$this->_code.'_category_id'].'_'.$child_2lv[$this->_code.'_category_id'])
                ];
              }
            }

            $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

            $data['results'][] = [
              'category_id' => $result[$this->_code.'_category_id'],
              'name'        => $result['name'],
              'image'       => $image,
              'children'    => $children_data_2lv,
              'href'        => $this->url->link('extension/ocdevwizard/'.$this->_name.'/category', $this->_code.'_path='.$result[$this->_code.'_category_id'])
            ];
          }
        }

        $template = 'categories';
      } else if ($setting['display_type'] == 3) {
        $filter_data = [
          'filter_data' => $setting
        ];

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getComments2Module($filter_data);

        if ($results) {
          foreach ($results as $result) {
            $user_icon = ($form_data['user_icon']) ? $this->model_tool_image->resize($form_data['user_icon'], $form_data['icon_image_width'], $form_data['icon_image_height']) : $this->model_tool_image->resize("no_image.png", $form_data['icon_image_width'], $form_data['icon_image_height']);

            $post_info = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPost($result[$this->_code.'_post_id']);

            if ($post_info) {
              $data['results'][] = [
                'firstname'   => $result['firstname'],
                'date_added'  => $this->make_time_ago($result['date_added'], 'comment'),
                'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_limit']).'..',
                'user_icon'   => $user_icon,
                'post_name'   => $post_info['name'],
                'post_href'   => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$post_info['main_category_id'].'&'.$this->_code.'_post_id='.$post_info['post_id'])
              ];
            }
          }
        }

        $template = 'comments';
      } else if ($setting['display_type'] == 4) {
        $template = 'search';
      } else if ($setting['display_type'] == 5) {
        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getTags2Module($setting);

        $results_inner = [];

        if ($results) {
          foreach ($results as $result) {
            if ($result['tag']) {
              $explodes = explode(',', $result['tag']);

              foreach ($explodes as $explode) {
                $results_inner[] = $explode;
              }
            }
          }
        }

        $results_inner = array_unique($results_inner);

        foreach ($results_inner as $item) {
          $data['results'][] = [
            'name' => $item,
            'href' => $this->url->link('extension/ocdevwizard/'.$this->_name.'/search', $this->_code.'_tag='.$item)
          ];
        }

        $sort_order = [];

        foreach ($data['results'] as $key => $value) {
          $sort_order[$key] = $value['name'];
        }

        if ($setting['sort_method'] == 1) {
          array_multisort($sort_order, SORT_ASC, $data['results']);
        } else {
          array_multisort($sort_order, SORT_DESC, $data['results']);
        }

        $template = 'tags';
      } else {
        $filter_data = [
          'filter_data' => $setting
        ];

        $results = $this->{'model_extension_ocdevwizard_'.$this->_name}->getPosts2Module($filter_data);

        if ($results) {
          $selected_posts = $this->{'model_extension_ocdevwizard_'.$this->_name}->getModuleRelatedPost($setting['module_id']);

          foreach ($results as $result) {
            $image = ($result['image']) ? $this->model_tool_image->resize($result['image'], $setting['main_image_width'], $setting['main_image_height']) : $this->model_tool_image->resize("no_image.png", $setting['main_image_width'], $setting['main_image_height']);

            if (utf8_strlen(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))) > 0) {
              $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_limit']).'..';
            } else {
              $description = '';
            }

            if (utf8_strlen(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8'))) > 0) {
              $short_description = utf8_substr(strip_tags(html_entity_decode($result['short_description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_limit']).'..';
            } else {
              $short_description = '';
            }

            $data['results'][] = [
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
              'href'              => $this->url->link('extension/ocdevwizard/'.$this->_name.'/post', $this->_code.'_path='.$result['main_category_id'].'&'.$this->_code.'_post_id='.$result['post_id'])
            ];
          }
        }

        $template = 'posts';
      }

      $data['module_id'] = $module++;

      if (isset($setting['status']) && $setting['status']) {
        if (version_compare(VERSION, '2.1.0.2', '<=')) {
          if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/static_'.$template.'.tpl')) {
            return $this->load->view($this->config->get('config_template').'/template/extension/ocdevwizard/'.$this->_name.'/static_'.$template.'.tpl', $data);
          } else {
            return $this->load->view('default/template/extension/ocdevwizard/'.$this->_name.'/static_'.$template.'.tpl', $data);
          }
        } else if (version_compare(VERSION, '3.0.0.0', '>=')) {
          return $this->load->view('extension/ocdevwizard/'.$this->_name.'/static_'.$template, $data);
        } else {
          return $this->load->view('extension/ocdevwizard/'.$this->_name.'/static_'.$template.'.tpl', $data);
        }
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
}

?>