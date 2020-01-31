<?php
class ControllerCatalogAnswerTab extends Controller {
    private $error = array();

    public function index() {

        $this->load->language('catalog/answertab');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/answertab');

        $this->getList();
    }

    public function add() {

        $this->load->language('catalog/answertab');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/answertab');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_answertab->addAnswer($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

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

            $this->response->redirect($this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('catalog/answertab');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/answertab');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_catalog_answertab->editAnswer($this->request->get['answer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

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

            if (isset($this->request->post['sendToAuthor']) && $this->request->post['sendToAuthor'] == 1 && $this->request->post['text_answer'] != ''){

                $subject = sprintf('Ответ на ваш вопрос на сайте '.html_entity_decode($this->config->get('config_name')), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

                $message = "Ваш вопрос:\n";
                $message .= $this->request->post['text'];
                $message .= "\n\n";
                $message .= "Ответ:\n";
                $message .= $this->request->post['text_answer'];
                $message .= "\n\n";
                $message .= "Ссылка на вопрос: ".HTTP_CATALOG.'index.php?route=product/product&product_id='.$this->request->post['product_id'];

                $mail = new Mail();
                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
                $mail->smtp_username = $this->config->get('config_mail_smtp_username');
                $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                $mail->smtp_port = $this->config->get('config_mail_smtp_port');
                $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

                $mail->setTo($this->request->post['email']);
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
                $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
                $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
                $mail->send();
            }

            $this->response->redirect($this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('catalog/answertab');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/answertab');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $answer_id) {
                $this->model_catalog_answertab->deleteAnswer($answer_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

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

            $this->response->redirect($this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }

    protected function getList() {
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
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('catalog/answertab/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('catalog/answertab/delete', 'token=' . $this->session->data['token'] . $url, true);

        $data['answers'] = array();

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

        $answer_total = $this->model_catalog_answertab->getTotalAnswers($filter_data);

        $results = $this->model_catalog_answertab->getAnswers($filter_data);

        foreach ($results as $result) {
            $data['answers'][] = array(
                'answer_id'  => $result['answer_id'],
                'name'       => $result['name'],
                'author'     => $result['author'],
                'text'     => $result['text'],
                'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                'edit'       => $this->url->link('catalog/answertab/edit', 'token=' . $this->session->data['token'] . '&answer_id=' . $result['answer_id'] . $url, true)
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_sendToAuthor'] = $this->language->get('text_sendToAuthor');

        $data['column_product'] = $this->language->get('column_product');
        $data['column_author'] = $this->language->get('column_author');
        $data['column_rating'] = $this->language->get('column_rating');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_action'] = $this->language->get('column_action');
        $data['answer_ask_col'] = $this->language->get('answer_ask_col');

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

        $data['sort_product'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, true);
        $data['sort_author'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, true);
        $data['sort_rating'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, true);
        $data['sort_status'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, true);
        $data['sort_date_added'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, true);

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
        $pagination->total = $answer_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($answer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($answer_total - $this->config->get('config_limit_admin'))) ? $answer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $answer_total, ceil($answer_total / $this->config->get('config_limit_admin')));

        $data['filter_product'] = $filter_product;
        $data['filter_author'] = $filter_author;
        $data['filter_status'] = $filter_status;
        $data['filter_date_added'] = $filter_date_added;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/answer_list', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['review_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_author'] = $this->language->get('entry_author');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_text'] = $this->language->get('entry_text');

        $data['label_text_edit'] = $this->language->get('label_text_edit');
        $data['text_sendToAuthor'] = $this->language->get('text_sendToAuthor');

        $data['help_product'] = $this->language->get('help_product');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

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
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true)
        );

        if (!isset($this->request->get['answer_id'])) {
            $data['action'] = $this->url->link('catalog/answertab/add', 'token=' . $this->session->data['token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('catalog/answertab/edit', 'token=' . $this->session->data['token'] . '&answer_id=' . $this->request->get['answer_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('catalog/answertab', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->request->get['answer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $answer_info = $this->model_catalog_answertab->getAnswer($this->request->get['answer_id']);
        }

        $data['token'] = $this->session->data['token'];

        $this->load->model('catalog/product');

        if (isset($this->request->post['product_id'])) {
            $data['product_id'] = $this->request->post['product_id'];
        } elseif (!empty($answer_info)) {
            $data['product_id'] = $answer_info['product_id'];
        } else {
            $data['product_id'] = '';
        }

        if (isset($this->request->post['product'])) {
            $data['product'] = $this->request->post['product'];
        } elseif (!empty($answer_info)) {
            $data['product'] = $answer_info['product'];
        } else {
            $data['product'] = '';
        }

        if (isset($this->request->post['author'])) {
            $data['author'] = $this->request->post['author'];
        } elseif (!empty($answer_info)) {
            $data['author'] = $answer_info['author'];
        } else {
            $data['author'] = '';
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($answer_info)) {
            $data['email'] = $answer_info['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['text'])) {
            $data['text'] = $this->request->post['text'];
        } elseif (!empty($answer_info)) {
            $data['text'] = $answer_info['text'];
        } else {
            $data['text'] = '';
        }

        if (isset($this->request->post['text_answer'])) {
            $data['text_answer'] = $this->request->post['text_answer'];
        } elseif (!empty($answer_info)) {
            $data['text_answer'] = $answer_info['text_answer'];
        } else {
            $data['text_answer'] = '';
        }

        if (isset($this->request->post['date_added'])) {
            $data['date_added'] = $this->request->post['date_added'];
        } elseif (!empty($answer_info)) {
            $data['date_added'] = ($answer_info['date_added'] != '0000-00-00 00:00' ? $answer_info['date_added'] : '');
        } else {
            $data['date_added'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($answer_info)) {
            $data['status'] = $answer_info['status'];
        } else {
            $data['status'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('catalog/answer_form', $data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/answertab')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['product_id']) {
            $this->error['product'] = $this->language->get('error_product');
        }

        if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
            $this->error['author'] = $this->language->get('error_author');
        }

        if (utf8_strlen($this->request->post['text']) < 1) {
            $this->error['text'] = $this->language->get('error_text');
        }

        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/answertab')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}