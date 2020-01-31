<?php
class ControllerExtensionModuleSmreview extends Controller {
    public function index()
    {

    //  $this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
    //   $this->document->addScript('catalog/view/javascript/smreview.js');
      if($this->config->get('smreview_status') == 1) {

          $this->load->language('extension/module/smreview');

          $data['text_reply'] = $this->language->get('text_reply');
          $data['text_send'] = $this->language->get('text_send');
          $data['text_name'] = $this->language->get('text_name');
          $data['text_mail'] = $this->language->get('text_mail');
          $data['text_text'] = $this->language->get('text_text');
          $data['text_review'] = $this->language->get('text_review');

          $data['fatal_error'] = $this->language->get('fatal_error');

          $data['text_show_hide_comments'] = $this->language->get('text_show_hide_comments');

          $data['text_chose_photo'] = $this->language->get('text_chose_photo');
          $data['text_chose_video'] = $this->language->get('text_chose_video');
          $data['text_chose_video_yt'] = $this->language->get('text_chose_video_yt');
          $data['text_rating'] = $this->language->get('text_rating');
          $data['load_more_text'] = $this->language->get('load_more_text');

          $data['text_write'] = $this->language->get('text_write');
          $data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
          $data['text_note'] = $this->language->get('text_note');
          $data['text_tags'] = $this->language->get('text_tags');
          $data['text_related'] = $this->language->get('text_related');
          $data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
          $data['text_loading'] = $this->language->get('text_loading');
          $data['text_write_review'] = $this->language->get('text_write_review');
          $data['text_allow_customer'] = $this->language->get('text_allow_customer');
          $data['text_allow_customer_buy'] = $this->language->get('text_allow_customer_buy');
          $data['text_or'] = $this->language->get('text_or');
          $data['text_allow_customer_reg'] = $this->language->get('text_allow_customer_reg');
          $data['text_allow_customer_log'] = $this->language->get('text_allow_customer_log');
          $data['text_allow_customer_like'] = $this->language->get('text_allow_customer_like');

          $data['product_id'] = $this->request->get['product_id'];
          $data['setting_gravatar'] = $this->config->get('smreview_gravatar');
          $data['setting_comment'] = $this->config->get('smreview_comment');
          $data['setting_rating'] = $this->config->get('smreview_rating');
          $data['setting_like'] = $this->config->get('smreview_like');
          $data['setting_add_date'] = $this->config->get('smreview_add_date');
          $data['setting_comment'] = $this->config->get('smreview_comment');
          $data['setting_picture'] = $this->config->get('smreview_picture');
          $data['setting_video'] = $this->config->get('smreview_video');
          $data['setting_add_review_customer'] = $this->config->get('smreview_add_review_customer');
          $data['setting_add_review_customer_buy'] = $this->config->get('smreview_add_review_customer_buy');
          $data['setting_display_form'] = $this->config->get('smreview_display_form');

          $data['error_file_review_size'] = $this->language->get('error_file_review_size');
          $data['error_file_review_type'] = $this->language->get('error_file_review_type');
          $data['error_file_video_review_type'] = $this->language->get('error_file_video_review_type');
          $data['text_delete'] = $this->language->get('text_delete');

          if(!empty($this->config->get('smreview_picture_max_size'))) {
              $data['picture_max_size'] = (int)$this->config->get('smreview_picture_max_size') * 1000000;
          }else{
              $data['picture_max_size'] = 1000000;
          }
          if(!empty($this->config->get('smreview_video_max_size'))) {
              $data['video_max_size'] = (int)$this->config->get('smreview_video_max_size') * 1000000;
          }else{
              $data['video_max_size'] = 3000000;
          }

          // Змінні для посилання на реєстрацію та авторизацію
          $data['register'] = $this->url->link('account/register', '', true);
          $data['login'] = $this->url->link('account/login', '', true);


          $this->load->model('catalog/smreview');

          //Якщо стоїть налаштування "Завжди показувати форму коментарія" - створюємо змінну, яка матиме display: block
          if($this->config->get('smreview_display_form') == 1) {
              $data['style_display_form'] = 'style="display:block;"';
          } else {
              $data['style_display_form']  = '' ;
          }


          if (isset($this->request->get['page'])) {
              $page = $this->request->get['page'];
          } else {
              $page = 1;
          }

          $data['reviews'] = array();
          // Якщо існує сесія з id користувача, тобто якщо користувач увійшов на сайт
          if(isset($this->session->data['customer_id'])){
              // Підключаємо модель покупця
              $this->load->model('account/customer');
              // Витягуємо всі дані покупця
              $customer_info = $this->model_account_customer->getCustomer($this->session->data['customer_id']);
              // Змінна з ім'ям покупця
              $data['name_customer'] = $customer_info['firstname'] . ' ' . $customer_info['lastname'];
              // Змінна з Email покупця
              $data['email_customer'] = $customer_info['email'];
              // Створюємо змінну, яка буде показувати, що користувач увійшов
              $data['allow_customer'] = 1;
              //Дістаємо всі дані по лайках та дізлайках цього користувача на відкритий товар, та записуємо їх в сесії
              $info_custom_like = $this->model_catalog_smreview->getTableLikeCustomerId($this->session->data['customer_id'], $this->request->get['product_id']);
              //Перебіраємо масив, щоб зробити новий масив, в якому ключі будуть = review_id
              $data['info_custom_like'] = array();
              foreach($info_custom_like as $info_custom_lik){
                  $data['info_custom_like'][$info_custom_lik['review_id']] = $info_custom_lik;
              }
              // Створюємо змінну, яка буде дорівнювати id покупця
              $customer_id = $this->session->data['customer_id'];
              // Якщо в налаштуваннях увімкнено, що відгуки залишають користувачі які купили товар
              if($data['setting_add_review_customer_buy'] == 1){
                  $customer_buy_total = $this->model_catalog_smreview->getTotalOrdersByCustomerId($this->session->data['customer_id'], $this->request->get['product_id']);
                  if ($customer_buy_total > 0){

                      // Дістаємо id статусів замовлень, які означають завершений етап замовлення
                      $data['sm_config_complete_status'] = $this->config->get('config_complete_status');

                      // Дістаємо всі order_id та order_status_id користувача по даному товару
                      $customer_order = $this->model_catalog_smreview->getOrdersProductByCustomerId($this->session->data['customer_id'], $this->request->get['product_id']);

                      // Змінна для розуміння, чи користувач реально купив товар
                      $cus_buy_product = 0;

                      // Якщо змінна з order_id та order_status_id не пуста
                      if(!empty($customer_order)){
                          // Перебіраємо масив з order_id та order_status_id
                          foreach($customer_order as $cus_or){
                              // Якщо статус хоть одного замовлення користувача по даному товару завершений, збільшуємо змінну
                              if(in_array($cus_or['order_status_id'],$data['sm_config_complete_status'])){
                                  $cus_buy_product++;
                              }
                          }
                          // Якщо змінна для розуміння більше 0, тоді дозволяємо користувачу залишати відгук
                          if($cus_buy_product > 0){
                              $data['allow_customer_buy'] = 1;
                          }
                      }
                  }
              }
          }

          $review_total = $this->model_catalog_smreview->getTotalReviewsByProductId($this->request->get['product_id']);

          $data['total_reviews'] = $review_total;

          $results = $this->model_catalog_smreview->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);
//          // если в настройках включены комментарии
//          if($this->config->get('smreview_comment') == 1) {
//              $data['reviews'] = $this->buildTreeArray($results);
//          } else {
//              $data['reviews']  = $results ;
//          }
          $data['reviews'] = $this->buildTreeArray($results);

          // Змінна з максимальним рейтингом на товар
          $data['smreview_max_rating'] = $this->model_catalog_smreview->getMaxRating($this->request->get['product_id']);

          $data['smreview_maxrating'] = 5;
          $pagination = new SmPagination();
          $pagination->total = $review_total;
          $pagination->page = $page;
          $pagination->limit = 5;

          $pagination->url = $this->url->link('extension/module/smreview', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

          $data['pagination'] = $pagination->render();

          $this->response->setOutput($this->load->view('extension/module/smreview', $data));
      }
    }
    function buildTreeArray($arItems, $review_id = 'review_id', $element_id = 'id') {

        foreach($arItems as $key => $item) {
            $arItems[$key]['comment'] = $this->model_catalog_smreview->getCommentByReviewId($item['id']);
            }
       /* echo '<pre>';
        print_r($arItems);
        echo '</pre>';*/
        return $arItems;
    }
    public function write() {
        $this->load->language('product/product');
        $this->load->language('extension/module/smreview');
        $data['error_file_review_size'] = $this->language->get('error_file_review_size');
        $data['error_file_review_type'] = $this->language->get('error_file_review_type');
        $data['error_file_video_review_type'] = $this->language->get('error_file_video_review_type');
        $data['error_review_link_yt'] = $this->language->get('error_review_link_yt');


        if(!empty($this->config->get('smreview_picture_max_size'))) {
            $picture_max_size = (int)$this->config->get('smreview_picture_max_size') * 1000000;
        }else{
            $picture_max_size = 1000000;
        }
        if(!empty($this->config->get('smreview_video_max_size'))) {
            $video_max_size = (int)$this->config->get('smreview_video_max_size') * 1000000;
        }else{
            $video_max_size = 3000000;
        }

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if($this->request->post != array()){
                if($this->config->get('smreview_picture') or $this->config->get('smreview_video')) {
                    if (!isset($this->request->post['review_id'])) {
                        if ($this->config->get('smreview_picture') == 1) {
                            // Визначення допустимих розширень файлів
                            $extensions = array('jpeg', 'jpg', 'png', 'gif');
                            // Максимальний розмір файлу
                            $max_size = $picture_max_size;
                            // Шлях до папки завантаження файлу
                            $path = DIR_IMAGE."user_pictures/";
                            if (!file_exists($path)){
                                mkdir($path);
                            }
                            if ($this->request->files['picture']['name'] != '')
                            {
                                if ($this->request->files['picture']['size'] > $max_size)
                                {
                                    $json['error']['error_file_review_size'] = $data['error_file_review_size'];
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
                                        $json['error']['error_file_review_type'] = $data['error_file_review_type'];
                                    }
                                }
                            }
                            else {
                                $this->request->post['picture'] = 'no image';
                            }
                        }else{
                            $this->request->post['picture'] = 'no image';
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
                                    $json['error']['error_review_link_yt'] = $data['error_review_link_yt'];
                                }
                            }
                            else{
                                // Визначення допустимих розширень файлів
                                $extensions = array('mp4');
                                // Максимальний розмір файлу
                                $max_size = $video_max_size;
                                // Шлях до папки завантаження файлу
                                $path = DIR_IMAGE."user_video/";
                                if (!file_exists($path)){
                                    mkdir($path);
                                }
                                if ($this->request->files['video']['name'] != '')
                                {
                                    if ($this->request->files['video']['size'] > $max_size)
                                    {
                                        $json['error']['error_video_review_size'] = $data['error_file_review_size'];
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
                                            $json['error']['error_file_video_review_type'] = $data['error_file_video_review_type'];
                                        }
                                    }
                                }
                                else {
                                    $this->request->post['video'] = 'no video';
                                }
                            }
                        }
                    }else{
                        $this->request->post['video'] = 'no video';
                    }
                }else{
                    $this->request->post['video'] = 'no video';
                    $this->request->post['picture'] = 'no image';
                }

                // Якщо це не коментарій, тоді потрібно перевірити обов'язковість E-mail
                if(!isset($this->request->post['review_id'])){
                    // Якщо в налаштуваннях - обов'язковий E-mail
                    if(!empty($this->config->get('smreview_requir_email')) and $this->config->get('smreview_requir_email') == 'on'){
                        if (utf8_strlen($this->request->post['mail']) < 3) {
                            $json['error']['error_email'] = $this->language->get('error_email');
                        }
                        if(!filter_var($this->request->post['mail'], FILTER_VALIDATE_EMAIL)){
                            $json['error']['error_email'] = $this->language->get('error_email');
                        }
                    }
                }
                if(!empty($this->config->get('smreview_requir_name')) and $this->config->get('smreview_requir_name') == 'on'){
                    if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 25)) {
                        $json['error']['error_name'] = $this->language->get('error_name');
                    }
                }

                if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
                    $json['error']['error_text'] = $this->language->get('error_text');
                }
                if (empty($this->request->post['rating'])){
                    $this->request->post['rating'] = '5';
                }

                /*if($this->config->get('smreview_rating')) {
                    if ($this->config->get('smreview_rating') == 1) {

                        if (empty($this->request->post['review_id'])) {
                            if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
                                $json['error'] = $this->language->get('error_rating');
                            }
                        }
                    }
                }*/

                // Captcha
                if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
                    $captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

                    if ($captcha) {
                        $json['error']['captcha'] = $captcha;
                    }
                }

                if (!isset($json['error'])) {
                    $this->load->model('catalog/smreview');

                    $this->model_catalog_smreview->addReview($this->request->get['product_id'], $this->request->post);

                    $json['success'] = $this->language->get('text_success');
                }
            }else{
                $json['error']['fatal_error'] = $this->language->get('fatal_error');
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function addlike() {
        $this->load->language('product/product');

        $json = array();
        // id зареєстрованого користувача
        $customer_id = $this->session->data['customer_id'];
        // id відгука
        $review_id = $this->request->post['id'];
        // id товару
        $product_id = $this->request->post['product_id'];
        // Що додається - лайк чи дізлайк
        $column = 'like';
        // Протилежна дія
        $column_opposite = 'dslike';

        //$this->request->get['product_id']

//        echo '<pre>';
//        print_r($this->request->post);
//        echo '</pre>';


        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->request->post['id']) {

                $this->load->model('catalog/smreview');

                $find_like_dslike = $this->model_catalog_smreview->getTableLike($review_id, $product_id, $customer_id);

//                        echo '<pre>';
//                        print_r($find_like_dslike);
//                        echo '</pre>';
                        //exit;

                // Якщо користувач не ставив лайк даному відгуку, тоді записуємо інформацію про лайк в табличку і додаємо лайк до відгуку
                if($find_like_dslike == array()){
                    $this->model_catalog_smreview->addTableLike($review_id, $product_id, $customer_id, $column);
                    $count_like  =  $this->model_catalog_smreview->addLike($this->request->post['id']);
                }
                //Якщо ж користувач ставив лайк і не ставив дізлайк - прибираємо лайк з відгуку і видаляємо інформацію про лайк з таблички
                elseif($find_like_dslike['like'] == 1 and $find_like_dslike['dslike'] == 0){
                    $count_like  =  $this->model_catalog_smreview->takeLike($this->request->post['id']);
                    $this->model_catalog_smreview->deleteTableLike($find_like_dslike['id']);
                }
                // Якщо ж користувач не ставив лайк, але ставив дізлайк - прибираємо дізлайк і ставимо лайк
                elseif($find_like_dslike['like'] == 0 and $find_like_dslike['dslike'] == 1){
                    $count_like  =  $this->model_catalog_smreview->addLike($this->request->post['id']);
                    $count_dslike  =  $this->model_catalog_smreview->takedsLike($this->request->post['id']);
                    $this->model_catalog_smreview->updateTableLikeTake($find_like_dslike['id'], $column_opposite);
                    $this->model_catalog_smreview->updateTableLikeAdd($find_like_dslike['id'], $column);
                }

               // $count_like  = $this->model_catalog_smreview->GetLike($this->request->post['id']);

                $json['success']['like'] = $count_like;

                if(isset($count_dslike)){
                    $json['success']['dslike'] = $count_dslike;
                }
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    public function adddslike() {
        $this->load->language('product/product');

        $json = array();
        // id зареєстрованого користувача
        $customer_id = $this->session->data['customer_id'];
        // id відгука
        $review_id = $this->request->post['id'];
        // id товару
        $product_id = $this->request->post['product_id'];
        // Що додається - лайк чи дізлайк
        $column = 'dslike';
        // Протилежна дія
        $column_opposite = 'like';

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->request->post['id']) {

                $this->load->model('catalog/smreview');

                $find_like_dslike = $this->model_catalog_smreview->getTableLike($review_id, $product_id, $customer_id);

                // Якщо користувач не ставив дізлайк даному відгуку, тоді записуємо інформацію про дізлайк в табличку і додаємо дізлайк до відгуку
                if($find_like_dslike == array()){
                    $this->model_catalog_smreview->addTableLike($review_id, $product_id, $customer_id, $column);
                    $count_dslike  =  $this->model_catalog_smreview->adddsLike($this->request->post['id']);
                }
                //Якщо ж користувач ставив дізлайк і не ставив лайк - прибираємо дізлайк з відгуку і видаляємо інформацію про дізлайк з таблички
                elseif($find_like_dslike['dslike'] == 1 and $find_like_dslike['like'] == 0){
                    $count_dslike  =  $this->model_catalog_smreview->takedsLike($this->request->post['id']);
                    $this->model_catalog_smreview->deleteTableLike($find_like_dslike['id']);
                }
                // Якщо ж користувач не ставив дізлайк, але ставив лайк - прибираємо лайк і ставимо дізлайк
                elseif($find_like_dslike['dslike'] == 0 and $find_like_dslike['like'] == 1){
                    $count_dslike  =  $this->model_catalog_smreview->adddsLike($this->request->post['id']);
                    $count_like  =  $this->model_catalog_smreview->takeLike($this->request->post['id']);
                    $this->model_catalog_smreview->updateTableLikeTake($find_like_dslike['id'], $column_opposite);
                    $this->model_catalog_smreview->updateTableLikeAdd($find_like_dslike['id'], $column);
                }

                // $count_like  = $this->model_catalog_smreview->GetLike($this->request->post['id']);

                if(isset($count_like)){
                    $json['success']['like'] = $count_like;
                }

                $json['success']['dslike'] = $count_dslike;
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    function get_gravatar( $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $email = $this->request->post['mail'];
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($url)); // return $url;
    }
}
?>