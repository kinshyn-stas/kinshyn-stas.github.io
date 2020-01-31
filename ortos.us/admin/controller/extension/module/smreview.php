<?php
class ControllerExtensionModuleSmreview extends Controller {
    private $error = array();

    public function addLicense() {
        $this->load->model('extension/module/smreview');
        $this->load->model('setting/setting');
        if(isset($this->request->post['smreview_license'])) {
            $checked = $this->model_extension_module_smreview->checklicense($this->request->post['smreview_license']);
            // echo 'rrr= $checked';
            if($checked == 'true')
            {
                //$this->model_module_avail->addLicense($this->request->post['license']);
                $this->model_setting_setting->editSetting('smreview_l', $this->request->post);

                $json = 'true';
            } else {
                $json = 'false';
            }
        } else {
            $json = 'false';
        }
        $this->response->setOutput(json_encode($json));
    }

    public function requestKey(){

        if($this->request->server['REQUEST_METHOD'] == 'POST' ) {

            $mail_text = "<!DOCTYPE html><html><head><meta charset=\"UTF-8\"><title>Document</title></head><body>";
            $mail_text .= "<p> Новый заказ на лицензию!</p>";
            $mail_text .= "<p> покупка на: " . $this->request->post['wherebuy_radio'] . "</p>";
            $mail_text .= "<p> заказ / код: " . $this->request->post['user_data'] . "</p>";
            $mail_text .= "<p> домен: " . $this->request->post['client_domain'] . "</p>";
            $mail_text .= "<p> e-mail клиента  :" .  $this->request->post['client_mail'] . "</p></body></html>";

            if ($this->config->get('config_mail')){
                $mail = new Mail($this->config->get('config_mail'));
            } else {
                $mail = new Mail();
                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
            }

            $mail->setTo('support@myopencart.club');
            $mail->setFrom('support@myopencart.club');
            $mail->setSender('SMReview');
            $mail->setSubject('SMReview Новый заказ на лицензионный ключ');

            $mail->setHtml($mail_text);

            $mail->send();
            $json = 'true';
            $this->response->setOutput(json_encode($json));
        }  else {

            $json = 'false';
            $this->response->setOutput(json_encode($json));
        }

    }

    public function install() {
        $this->load->model('extension/module/smreview');
        $this->model_extension_module_smreview->install();

    }
    public function index() {
        $this->load->language('extension/module/smreview');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        $this->load->model('extension/module/smreview');

        // Перевірка ліцензії
        $checked = $this->model_extension_module_smreview->checklicense($this->config->get("smreview_license"));

        // Якщо ліцензії немає, виводимо сторінку з активацією
        if ($checked <> '1'){
            $data['entry_license'] = $this->language->get('entry_license');
            $data['text_license'] = $this->language->get('text_license');
            $data['button_submit_key'] = $this->language->get('button_submit_key');
            $data['text_edit_license'] = $this->language->get('text_edit_license');
            $data['text_license_abow'] = $this->language->get('text_license_abow');
            $data['button_submit'] = $this->language->get('button_submit');
            $data['token'] = $this->session->data['token'];
            $data['heading_title'] = $this->language->get('heading_title');
            $data['text_varsion'] = $this->language->get('text_varsion');
            $data['button_send'] = $this->language->get('button_send');
            $data['button_save'] = $this->language->get('button_save');
            $data['button_cancel'] = $this->language->get('button_cancel');

            $data['text_sometext'] = $this->language->get('text_sometext');
            $data['text_purchased'] = $this->language->get('text_purchased');
            $data['text_codecan'] = $this->language->get('text_codecan');
            $data['text_opencart'] = $this->language->get('text_opencart');
            $data['text_forumopencart'] = $this->language->get('text_forumopencart');
            $data['text_myopencart'] = $this->language->get('text_myopencart');
            $data['text_purchased'] = $this->language->get('text_purchased');
            $data['text_opencart_user'] = $this->language->get('text_opencart_user');
            $data['text_forumopencart_user'] = $this->language->get('text_forumopencart_user');
            $data['text_payment_numer'] = $this->language->get('text_payment_numer');
            $data['text_client_mail'] = $this->language->get('text_client_mail');
            $data['text_domain'] = $this->language->get('text_domain');
            $data['text_comment'] = $this->language->get('text_comment');
            $data['text_success_license'] = $this->language->get('text_success_license');
            $data['text_not_successe'] = $this->language->get('text_not_successe');

            $data['text_success_send_mail'] = $this->language->get('text_success_send_mail');

            $data['client_mail'] = $this->config->get('config_email');

            $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
            );

            $data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_module'),
                'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );

            $data['breadcrumbs'][] = array(
                'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('extension/module/avail', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
            );


            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('extension/module/smgetlicense.tpl', $data));

        } else { // Якщо ж ліцензія є, все працює

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_setting_setting->editSetting('smreview', $this->request->post);

                $this->session->data['success'] = $this->language->get('text_success');

                $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
            }

            $data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

            $data['text_edit'] = $this->language->get('text_edit_setting');
            $data['text_version'] = $this->language->get('text_version');
            $data['text_enabled'] = $this->language->get('text_enabled');
            $data['text_disabled'] = $this->language->get('text_disabled');

            $data['entry_status'] = $this->language->get('entry_status');
            $data['entry_gravatar'] = $this->language->get('entry_gravatar');
            $data['entry_social_networks'] = $this->language->get('entry_social_networks');
            $data['entry_comment'] = $this->language->get('entry_comment');
            $data['entry_rating'] = $this->language->get('entry_rating');
            $data['entry_like'] = $this->language->get('entry_like');
            $data['entry_add_date'] = $this->language->get('entry_add_date');
            $data['entry_published_date'] = $this->language->get('entry_published_date');
            $data['entry_picture'] = $this->language->get('entry_picture');
            $data['entry_picture_max_size'] = $this->language->get('entry_picture_max_size');
            $data['entry_video'] = $this->language->get('entry_video');
            $data['entry_video_max_size'] = $this->language->get('entry_video_max_size');
            $data['entry_add_review_customer'] = $this->language->get('entry_add_review_customer');
            $data['entry_add_review_customer_buy'] = $this->language->get('entry_add_review_customer_buy');
            $data['entry_display_form'] = $this->language->get('entry_display_form');
            $data['entry_required'] = $this->language->get('entry_required');
            $data['entry_requir_email'] = $this->language->get('entry_requir_email');
            $data['entry_requir_name'] = $this->language->get('entry_requir_name');
            $data['text_php_ini_max_size'] = $this->language->get('text_php_ini_max_size');

            $data['button_save'] = $this->language->get('button_save');
            $data['button_cancel'] = $this->language->get('button_cancel');

            $data['php_ini_max_size'] = ini_get('post_max_size');;

            if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
            } else {
                $data['error_warning'] = '';
            }

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_extension'),
                'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title_with_picture'),
                'href' => $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'], true)
            );

            $data['action'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'], true);

            $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

            if (isset($this->request->post['smreview_status'])) {
                $data['smreview_status'] = $this->request->post['smreview_status'];
            } else {
                $data['smreview_status'] = $this->config->get('smreview_status');
            }
            if (isset($this->request->post['smreview_gravatar'])) {
                $data['smreview_gravatar'] = $this->request->post['smreview_gravatar'];
            } else {
                $data['smreview_gravatar'] = $this->config->get('smreview_gravatar');
            }
            if (isset($this->request->post['smreview_social_networks'])) {
                $data['smreview_social_networks'] = $this->request->post['smreview_social_networks'];
            } else {
                $data['smreview_social_networks'] = $this->config->get('smreview_social_networks');
            }
            if (isset($this->request->post['smreview_picture'])) {
                $data['smreview_picture'] = $this->request->post['smreview_picture'];
            } else {
                $data['smreview_picture'] = $this->config->get('smreview_picture');
            }
            if (isset($this->request->post['smreview_picture_max_size'])) {
                $data['smreview_picture_max_size'] = $this->request->post['smreview_picture_max_size'];
            } else {
                $data['smreview_picture_max_size'] = $this->config->get('smreview_picture_max_size');
            }
            if (isset($this->request->post['smreview_video'])) {
                $data['smreview_video'] = $this->request->post['smreview_video'];
            } else {
                $data['smreview_video'] = $this->config->get('smreview_video');
            }
            if (isset($this->request->post['smreview_video_max_size'])) {
                $data['smreview_video_max_size'] = $this->request->post['smreview_video_max_size'];
            } else {
                $data['smreview_video_max_size'] = $this->config->get('smreview_video_max_size');
            }
            if (isset($this->request->post['smreview_comment'])) {
                $data['smreview_comment'] = $this->request->post['smreview_comment'];
            } else {
                $data['smreview_comment'] = $this->config->get('smreview_comment');
            }
            if (isset($this->request->post['smreview_add_date'])) {
                $data['smreview_add_date'] = $this->request->post['smreview_add_date'];
            } else {
                $data['smreview_add_date'] = $this->config->get('smreview_add_date');
            }
            if (isset($this->request->post['smreview_add_review_customer'])) {
                $data['smreview_add_review_customer'] = $this->request->post['smreview_add_review_customer'];
            } else {
                $data['smreview_add_review_customer'] = $this->config->get('smreview_add_review_customer');
            }
            if (isset($this->request->post['smreview_add_review_customer_buy'])) {
                $data['smreview_add_review_customer_buy'] = $this->request->post['smreview_add_review_customer_buy'];
            } else {
                $data['smreview_add_review_customer_buy'] = $this->config->get('smreview_add_review_customer_buy');
            }

            if (isset($this->request->post['smreview_rating'])) {
                $data['smreview_rating'] = $this->request->post['smreview_rating'];
            } else {
                $data['smreview_rating'] = $this->config->get('smreview_rating');
            }
            if (isset($this->request->post['smreview_like'])) {
                $data['smreview_like'] = $this->request->post['smreview_like'];
            } else {
                $data['smreview_like'] = $this->config->get('smreview_like');
            }
            if (isset($this->request->post['smreview_display_form'])) {
                $data['smreview_display_form'] = $this->request->post['smreview_display_form'];
            } else {
                $data['smreview_display_form'] = $this->config->get('smreview_display_form');
            }
            if (isset($this->request->post['smreview_requir_email'])) {
                $data['smreview_requir_email'] = $this->request->post['smreview_requir_email'];
            } else {
                $data['smreview_requir_email'] = $this->config->get('smreview_requir_email');
            }
            if (isset($this->request->post['smreview_requir_name'])) {
                $data['smreview_requir_name'] = $this->request->post['smreview_requir_name'];
            } else {
                $data['smreview_requir_name'] = $this->config->get('smreview_requir_name');
            }

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('extension/module/smreviewsetting', $data));
        }
    }
    public function getList() {
        $this->document->addScript('view/javascript/smreview.js');
        $this->document->addStyle('view/stylesheet/smreview.css');
        $this->load->language('extension/module/smreview');

        if (isset($this->request->get['filter_product'])) {
            $filter_product = $this->request->get['filter_product'];
        } else {
            $filter_product = null;
        }

        if (isset($this->request->get['filter_author'])) {
            $filter_author = $this->request->get['filter_author'];
        } else {
            $filter_author = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'r.date_added';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_with_picture'),
            'href' => $this->url->link('extension/module/smreview/getlist', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('extension/module/smreview/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('extension/module/smreview/delete', 'token=' . $this->session->data['token'] . $url, true);

        $data['reviews'] = array();

        $filter_data = array(
            'filter_product'    => $filter_product,
            'filter_author'     => $filter_author,
            'filter_status'     => $filter_status,
            'filter_date_added' => $filter_date_added,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'             => $this->config->get('config_limit_admin')
        );

  /*      $review_total = $this->model_extension_module_smreview->getTotalReviews($filter_data);

        $results = $this->model_extension_module_smreview->getReviews($filter_data);

        foreach ($results as $result) {
            $data['reviews'][] = array(
                'review_id'  => $result['review_id'],
                'name'       => $result['name'],
                'author'     => $result['author'],
                'rating'     => $result['rating'],
                'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'edit'       => $this->url->link('extension/module/smreview/edit', 'token=' . $this->session->data['token'] . '&review_id=' . $result['review_id'] . $url, true),
                'comment'    => !empty($result['comment'])?count($result['comment']):0
            );
        }
*/

        $data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_write_review'] = $this->language->get('text_write_review');
        $data['text_allert_delete'] = $this->language->get('text_allert_delete');
        $data['text_delete_review'] = $this->language->get('text_delete_review');

        $data['text_chose_video'] = $this->language->get('text_chose_video');
        $data['text_chose_video_yt'] = $this->language->get('text_chose_video_yt');

        $data['text_reply'] = $this->language->get('text_reply');
        $data['text_name'] = $this->language->get('text_name');
        $data['text_mail'] = $this->language->get('text_mail');
        $data['text_text'] = $this->language->get('text_text');
        $data['text_review'] = $this->language->get('text_review');

        $data['text_chose_photo'] = $this->language->get('text_chose_photo');
        $data['text_rating'] = $this->language->get('text_rating');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_rating'] = $this->language->get('column_rating');
        $data['column_comment'] = $this->language->get('column_comment');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_date_added'] = $this->language->get('entry_date_added');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

       if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_product'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
        $data['sort_author'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, true);
        $data['sort_rating'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, true);
        $data['sort_status'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, true);
        $data['sort_date_added'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, true);

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

    /*    $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($review_total - $this->config->get('config_limit_admin'))) ? $review_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $review_total, ceil($review_total / $this->config->get('config_limit_admin')));
*/
        $data['filter_product'] = $filter_product;
        $data['filter_author'] = $filter_author;
        $data['filter_status'] = $filter_status;
        $data['filter_date_added'] = $filter_date_added;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/smreview_list', $data));
    }
    public function addReview() {
        $this->load->language('extension/module/smreview');

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {

            if($this->config->get('smreview_picture') or $this->config->get('smreview_video')) {
                if (!isset($this->request->post['review_id'])) {
                    if ($this->config->get('smreview_picture') == 1) {
                        // Визначення допустимих розширень файлів
                        $extensions = array('jpeg', 'jpg', 'png', 'gif');
                        // Максимальний розмір файлу
                        $max_size = 3000000;
                        // Шлях до папки завантаження файлу
                        $path = DIR_IMAGE."user_pictures/";
                        if (!file_exists($path)){
                            mkdir($path);
                        }
                        if ($this->request->files['picture']['name'] != '')
                        {
                            if ($this->request->files['picture']['size'] > $max_size)
                            {
                                $json['error'] = $this->language->get('error_file_review_size');
                            }
                            else
                            {
                                $ext = strtolower(pathinfo($this->request->files['picture']['name'], PATHINFO_EXTENSION));
                                if (in_array($ext, $extensions))
                                {
                                    $newname = uniqid() . '.' . $ext;
                                    $path = $path . $newname;

                                    if (move_uploaded_file($this->request->files['picture']['tmp_name'], $path))
                                    {
                                        $response = "<img style='height: 100px' src='$path' />";
                                        $this->request->post['picture'] = "user_pictures/".$newname; // так как через post не передается файл по ajax, прописываем его сами из переменной $_FILES
                                    }
                                }
                                else
                                {
                                    $json['error'] = $this->language->get('error_file_review_type');
                                }
                            }
                        }
                        else {
                            $this->request->post['picture'] = 'no image';
                        }
                    }
                }
                if ($this->config->get('smreview_video') == 1) {

                    // Якщо в поле для відео з YouTube було вставлено посилання
                    if(isset($this->request->post['video_yt'])){
                        if($this->request->post['video_yt'] != ''){
                            if(strrpos($this->request->post['video_yt'], "watch")) {
                                // змінюємо текст "watch?v=" на "embed/", для того, щоб потім можна було вивести відео через iframe
                                $this->request->post['video'] = str_replace("watch?v=", "embed/", $this->request->post['video_yt']);
                            }
                            else{
                                $json['error'] = $this->language->get('error_review_link_yt');
                            }
                        }
                        else{
                            // Визначення допустимих розширень файлів
                            $extensions = array('mp4');
                            // Максимальний розмір файлу
                            $max_size = 66000000;
                            // Шлях до папки завантаження файлу
                            $path = DIR_IMAGE."user_video/";
                            if (!file_exists($path)){
                                mkdir($path);
                            }
                            if ($this->request->files['video']['name'] != '')
                            {
                                if ($this->request->files['video']['size'] > $max_size)
                                {
                                    $json['error'] = $this->language->get('error_file_review_size');
                                }
                                else
                                {
                                    $ext = strtolower(pathinfo($this->request->files['video']['name'], PATHINFO_EXTENSION));
                                    if (in_array($ext, $extensions))
                                    {
                                        $newname = uniqid() . '.' . $ext;
                                        $path = $path . $newname;

                                        if (move_uploaded_file($this->request->files['video']['tmp_name'], $path))
                                        {
                                            $response = "<img style='height: 100px' src='$path' />";
                                            $this->request->post['video'] = "user_video/".$newname; // так как через post не передается файл по ajax, прописываем его сами из переменной $_FILES
                                        }
                                    }
                                    else
                                    {
                                        $json['error'] = $this->language->get('error_file_review_type');
                                    }
                                }
                            }
                            else {
                                $this->request->post['video'] = 'no video';
                            }
                        }
                    }
                }
            }
            if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 25)) {
                $json['error'] = $this->language->get('error_author');
            }

            if(empty($this->request->post['product_id'])) {
                $json['error'] = $this->language->get('error_product');
            }
            if(empty($this->request->post['text'])) {
                $json['error'] = $this->language->get('error_text');
            }

            if(!empty($this->request->post['review_id']) && empty($this->request->post['review_id'])) {
                if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
                    $json['error'] = $this->language->get('error_rating');
                }
            }

            if(empty($this->request->post['logo'])){
                $this->request->post['logo'] = '';
            }

            if (!isset($json['error'])) {
                $this->load->model('extension/module/smreview');

                $this->model_extension_module_smreview->addReview($this->request->post);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function editReview() {

        $this->load->language('extension/module/smreview');

        $this->document->addScript('view/javascript/smreview.js');
        $this->document->addStyle('view/stylesheet/smreview.css');
        $json = array();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 25)) {
                $json['error'] = $this->language->get('error_name');
            }

            if (empty($this->request->post['text'])) {
                $json['error-text'] = $this->language->get('error_text');
            }

            if(!empty($this->request->post['review_id']) && empty($this->request->post['review_id'])) {
                if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
                    $json['error'] = $this->language->get('error_rating');
                }
            }

            if (!isset($json['error'])) {
                $this->load->model('extension/module/smreview');

                $this->model_extension_module_smreview->editReview($this->request->post);

                $json['success'] = $this->language->get('text_success');
                $this->request->post['success_edit'] = 'success';

               // $url = '&review_id='.$this->request->get['review_id'];
               // $this->response->redirect($this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url, true));
                $this->getForm();
            }
        } else {
            $this->getForm();
        }


    }
    public function QvickeditReview() {

        $this->load->language('extension/module/smreview');

        $this->document->addScript('view/javascript/smreview.js');
        $this->document->addStyle('view/stylesheet/smreview.css');
        $json = array();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

                if(empty($this->request->post['status'])){
                    $this->request->post['status'] = 0;
                }

                $this->load->model('extension/module/smreview');

                $this->model_extension_module_smreview->editReview($this->request->post);

                $json['success'] = $this->language->get('text_success');
                // $url = '&review_id='.$this->request->get['review_id'];
                // $this->response->redirect($this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url, true));
                $this->response->addHeader('Content-Type: application/json');
                $this->response->setOutput(json_encode($json));

        } else {
            if(!empty($json['error']['author'])){
                $json['error-author'] = $json['error']['author'];
            }

            if(!empty($json['error']['text'])){
                $json['error-text'] = $json['error']['text'];
            }
            if(!empty($json['error']['rating'])){
                $json['error-rating'] = $json['error']['rating'];
            }


            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($json));
        }


    }
    public function GetReviews(){
        $this->load->language('extension/module/smreview');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/smreview');

        if (isset($this->request->get['filter_product'])) {
            $filter_product = $this->request->get['filter_product'];
        } else {
            $filter_product = null;
        }

        if (isset($this->request->get['filter_author'])) {
            $filter_author = $this->request->get['filter_author'];
        } else {
            $filter_author = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'r.date_added';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_with_picture'),
            'href' => $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('extension/module/smreview/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('extension/module/smreview/delete', 'token=' . $this->session->data['token'] . $url, true);

        $data['reviews'] = array();

        $filter_data = array(
            'filter_product'    => $filter_product,
            'filter_author'     => $filter_author,
            'filter_status'     => $filter_status,
            'filter_date_added' => $filter_date_added,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'             => $this->config->get('config_limit_admin')
        );

        $review_total = $this->model_extension_module_smreview->getTotalReviews($filter_data);

        $results = $this->model_extension_module_smreview->getReviews($filter_data);

        if( $results === false){
            return false;
            exit();
        }

        foreach ($results as $result) {

            $data['reviews'][] = array(
                'id'  => $result['id'],
                'review_id'  => $result['review_id'],
                'name'       => $result['name'],
                'picture'       => $result['picture'],
                'video'       => $result['video'],
                'author'     => $result['author'],
                'rating'     => $result['rating'],
                'text_status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'status'     => $result['status'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'edit'       => $this->url->link('extension/module/smreview/getform', 'token=' . $this->session->data['token'] . '&review_id=' . $result['id'] . $url, true),
                'comment'    => !empty($result['comment'])?count($result['comment']):0
            );
        }
//        echo '<pre>';
//        print_r($data['reviews']);
//        echo '</pre>';

        $data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_write_review'] = $this->language->get('text_write_review');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_rating'] = $this->language->get('column_rating');
        $data['column_comment'] = $this->language->get('column_comment');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_date_added'] = $this->language->get('entry_date_added');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_product'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
        $data['sort_author'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, true);
        $data['sort_rating'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, true);
        $data['sort_status'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, true);
        $data['sort_date_added'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, true);

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new SmPagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('extension/module/smreview/getreviews', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($review_total - $this->config->get('config_limit_admin'))) ? $review_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $review_total, ceil($review_total / $this->config->get('config_limit_admin')));

        $data['filter_product'] = $filter_product;
        $data['filter_author'] = $filter_author;
        $data['filter_status'] = $filter_status;
        $data['filter_date_added'] = $filter_date_added;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/smreviews', $data));
    }
    public function GetForm(){

        $this->load->language('extension/module/smreview');

        $this->document->addScript('view/javascript/smreview.js');
        $this->document->addStyle('view/stylesheet/smreview.css');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/smreview');

        $data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

        $data['text_form'] = !isset($this->request->get['review_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_write_review'] = $this->language->get('text_write_review');
        $data['text_delete_review'] = $this->language->get('text_delete_review');
        $data['text_comment'] = $this->language->get('text_comment');
        $data['text_allert_delete'] = $this->language->get('text_allert_delete');
        $data['text_edit_comment'] = $this->language->get('text_edit_comment');
        $data['text_success_edit'] = $this->language->get('text_success_edit');

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_published_date'] = $this->language->get('entry_published_date');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_like'] = $this->language->get('entry_like');
        $data['entry_dslike'] = $this->language->get('entry_dslike');

        $data['column_like'] = $this->language->get('column_like');
        $data['column_dslike'] = $this->language->get('column_dslike');

        $data['text_reply'] = $this->language->get('text_reply');
        $data['text_name'] = $this->language->get('text_name');
        $data['text_mail'] = $this->language->get('text_mail');
        $data['text_text'] = $this->language->get('text_text');
        $data['text_add_text'] = $this->language->get('text_add_text');
        $data['text_review'] = $this->language->get('text_review');

        $data['text_review'] = $this->language->get('text_review');
        $data['text_review'] = $this->language->get('text_review');

        $data['text_chose_photo'] = $this->language->get('text_chose_photo');

        $data['text_picture_to_review'] = $this->language->get('text_picture_to_review');
        $data['text_video_to_review'] = $this->language->get('text_video_to_review');
        $data['text_no'] = $this->language->get('text_no');

        $data['help_product'] = $this->language->get('help_product');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['breadcrumbs'] = array();

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['product'])) {
            $data['error_product'] = $this->error['product'];
        } else {
            $data['error_product'] = '';
        }

        if (isset($this->error['author'])) {
            $data['error_author'] = $this->error['author'];
        } else {
            $data['error_author'] = '';
        }

        if (isset($this->error['text'])) {
            $data['error_text'] = $this->error['text'];
        } else {
            $data['error_text'] = '';
        }

        if (isset($this->error['rating'])) {
            $data['error_rating'] = $this->error['rating'];
        } else {
            $data['error_rating'] = '';
        }

        $url = '';

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_with_picture'),
            'href' => $this->url->link('extension/module/smreview/getlist', 'token=' . $this->session->data['token'] . $url, true)
        );


        $data['cancel'] = $this->url->link('extension/module/smreview/getlist', 'token=' . $this->session->data['token'] . $url, true);


        $data['action'] = $this->url->link('extension/module/smreview/editreview', 'token=' . $this->session->data['token'] .'&review_id='.$this->request->get['review_id']. $url, true);

        $review_info = $this->model_extension_module_smreview->getReview($this->request->get['review_id']);

        $data['token'] = $this->session->data['token'];

        if(isset($this->request->post['success_edit']) and $this->request->post['success_edit'] == 'success'){
            $data['text_success_edit'] = $this->language->get('text_success_edit');
        }else{
            $data['text_success_edit'] = '';
        }

        foreach($review_info as $review_info) {
            // усли нету id то значит мы сейча не в отзыве а в комментарии
            if(empty($review_info['id'])){
                $review_info = $review_info['comment'][0];
                $url .= "&review_id=".$review_info['review_id'];
                $data['cancel'] = $this->url->link('extension/module/smreview/getform', 'token=' . $this->session->data['token'] . $url, true);
            }

            $this->load->model('catalog/product');

            $product = $this->model_catalog_product->getProduct($review_info['product_id']);

            if (!empty($review_info)) {
                $data['product_id'] = $review_info['product_id'];
            } else {
                $data['product_id'] = '';
            }
            if (!empty($review_info)) {
                $data['review_id'] = $review_info['review_id'];
            } else {
                $data['review_id'] = '';
            }
            if (!empty($review_info)) {
                $data['like'] = $review_info['like'];
            } else {
                $data['like'] = '';
            }
            if (!empty($review_info)) {
                $data['dslike'] = $review_info['dslike'];
            } else {
                $data['dslike'] = '';
            }

            if (!empty($review_info)) {
                $data['product'] = $product['name'];
            } else {
                $data['product'] = '';
            }

            if (!empty($review_info)) {
                $data['author'] = $review_info['author'];
            } else {
                $data['author'] = '';
            }

            if (!empty($review_info)) {
                $data['text'] = $review_info['text'];
            } else {
                $data['text'] = '';
            }
            // Для зображень
            if (!empty($review_info)) {
                $data['picture'] = $review_info['picture'];
            } else {
                $data['picture'] = '';
            }
            // Для відео
            if (!empty($review_info)) {
                $data['video'] = $review_info['video'];
            } else {
                $data['video'] = '';
            }

            if (!empty($review_info)) {
                $data['rating'] = $review_info['rating'];
            } else {
                $data['rating'] = '';
            }

            if (!empty($review_info)) {
                $data['date_added'] = ($review_info['date_added'] != '0000-00-00 00:00' ? $review_info['date_added'] : '');
            } else {
                $data['date_added'] = '';
            }

            if (!empty($review_info)) {
                $data['date_published'] = ($review_info['date_published'] != '0000-00-00 00:00' ? $review_info['date_published'] : '');
            } else {
                $data['date_published'] = '';
            }

            if (!empty($review_info)) {
                $data['status'] = $review_info['status'];
            } else {
                $data['status'] = '';
            }
            if (!empty($review_info)) {
                $data['id'] = $review_info['id'];
            } else {
                $data['id'] = '';
            }
        }

        // Якщо зараз коментарій, то $data['is_comment'] = 1
        if(($data['review_id'] == 0) or ($data['review_id'] == '') or ($data['review_id'] == NULL)){
            $data['is_comment'] = '';
        }else{
            $data['is_comment'] = 1;
        }


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/smreview_form', $data));


    }
    public function GetComments(){
        $this->load->language('extension/module/smreview');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/module/smreview');

        if (isset($this->request->get['filter_product'])) {
            $filter_product = $this->request->get['filter_product'];
        } else {
            $filter_product = null;
        }

        if (isset($this->request->get['filter_author'])) {
            $filter_author = $this->request->get['filter_author'];
        } else {
            $filter_author = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'r.date_added';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_with_picture'),
            'href' => $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('extension/module/smreview/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('extension/module/smreview/delete', 'token=' . $this->session->data['token'] . $url, true);

        $data['reviews'] = array();

        $filter_data = array(
            'filter_product'    => $filter_product,
            'filter_author'     => $filter_author,
            'filter_status'     => $filter_status,
            'filter_date_added' => $filter_date_added,
            'sort'              => $sort,
            'order'             => $order,
            'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'             => $this->config->get('config_limit_admin')
        );


        if (isset($this->request->get['review_id'])) {
            $id = $this->request->get['review_id'];
        } else {
            $id = '';
        }

         if($id) {
             $review_total = $this->model_extension_module_smreview->getTotalComments($filter_data, $id);

             $results = $this->model_extension_module_smreview->getAllReviews($filter_data, $id);
         } else {

             $review_total = $this->model_extension_module_smreview->getTotalComments($filter_data);

             $results = $this->model_extension_module_smreview->getAllReviews($filter_data);
         }
        foreach ($results as $result) {


            $data['reviews'][] = array(
                'id'  => $result['id'],
                'review_id'  => $result['review_id'],
                'product_id'  => $result['product_id'],
                'name'       => $result['name'],
                'author'     => $result['author'],
                'like'       => $result['like'],
                'dslike'     => $result['dslike'],
                'text'       => $result['text'],
                'rating'     => $result['rating'],
                'text_status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'status'     => $result['status'],
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'edit'       => $this->url->link('extension/module/smreview/getform', 'token=' . $this->session->data['token'] . '&review_id=' . $result['id'] . $url, true),
                'comment'    => !empty($result['comment'])?count($result['comment']):0
            );
        }

        $data['heading_title_with_picture'] = $this->language->get('heading_title_with_picture');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_write_review'] = $this->language->get('text_write_review');
        $data['entry_text'] = $this->language->get('entry_text');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_rating'] = $this->language->get('column_rating');
        $data['column_comment'] = $this->language->get('column_comment');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');
        $data['column_like'] = $this->language->get('column_like');
        $data['column_dslike'] = $this->language->get('column_dslike');

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_date_added'] = $this->language->get('entry_date_added');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_product'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
        $data['sort_author'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, true);
        $data['sort_rating'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, true);
        $data['sort_status'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, true);
        $data['sort_date_added'] = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, true);

        $url = '';

        if (isset($this->request->get['filter_product'])) {
            $url .= '&filter_product=' . urlencode(html_entity_decode($this->request->get['filter_product'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_author'])) {
            $url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('extension/module/smreview', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($review_total - $this->config->get('config_limit_admin'))) ? $review_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $review_total, ceil($review_total / $this->config->get('config_limit_admin')));

        $data['filter_product'] = $filter_product;
        $data['filter_author'] = $filter_author;
        $data['filter_status'] = $filter_status;
        $data['filter_date_added'] = $filter_date_added;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/smreview_comment', $data));
    }
    public function delete(){

        if ($this->request->server['REQUEST_METHOD'] == 'POST' && !empty($this->request->post['idArray'])) {
            $this->load->language('extension/module/smreview');
            $this->load->model('extension/module/smreview');

            foreach($this->request->post['idArray'] as $id_rev) {

                // Дістаємо дані відгука
                $review_info = $this->model_extension_module_smreview->getReview($id_rev);

                // Якщо відгук має картинку та/або відео - видаляємо їх
                if ($review_info[$id_rev]['picture'] != 'no image' and $review_info[$id_rev]['picture'] != '') {
                    unlink(DIR_IMAGE . $review_info[$id_rev]['picture']);
                }
                if ($review_info[$id_rev]['video'] != 'no video' and $review_info[$id_rev]['video'] != '') {
                    unlink(DIR_IMAGE . $review_info[$id_rev]['video']);
                }

                $this->model_extension_module_smreview->delete($id_rev);
            }
            $json['success'] = $this->language->get('delete_success');
        } else {
            $json['error'] = $this->language->get('delete_error');
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function confirm(){

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {

          //  print_r($this->request->post);
            $this->load->model('extension/module/smreview');
            $id = $this->request->post['id'];
            $statuse = $this->request->post['statuse'];

            $this->model_extension_module_smreview->activate($id,$statuse);

            $json['success'] = ' ';
        } else {
            $json['error'] = ' ';
        }

    //   return $json;
    }
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'extension/module/smreview')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['product_id']) {
            $this->error['product'] = $this->language->get('error_product');
        }

        if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
            $this->error['author'] = $this->language->get('error_author');

        }

//        if (empty($this->request->post['text']) || utf8_strlen($this->request->post['text']) < 25) {
//            $this->error['text'] = $this->language->get('error_text');
//
//        }
        if(empty($this->request->post['review_id'])) {

            if (!isset($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
                $this->error['rating'] = $this->language->get('error_rating');
            }
        }

        return !$this->error;
    }
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/smreview')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}