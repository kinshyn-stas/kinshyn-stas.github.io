<?php
class ModelCatalogSmreview extends Model {


    public function getReviewsByProductId($product_id, $start = 0, $limit = 20) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 20;
        }

        $query = $this->db->query("SELECT r.id, r.review_id, r.like, r.dslike, r.image ,r.author, r.rating, r.text, p.product_id, pd.name, p.price, r.video, r.picture, r.image, r.date_added, r.date_published FROM " . DB_PREFIX . "smreview r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.date_published < '" . date('Y-m-d H:i:s') . "' AND r.status = '1' AND (r.review_id IS NULL OR r.review_id = '0') AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

        return $query->rows;
    }
    public function getCommentByReviewId($review_id) {


        $query = $this->db->query("SELECT r.id, r.review_id, r.like, r.dslike, r.image ,r.author, r.rating, r.text, r.image, r.date_added FROM " . DB_PREFIX . "smreview r WHERE r.status = '1' AND r.date_published < '" . date('Y-m-d H:i:s') . "' AND r.review_id = ".$review_id." ORDER BY r.date_added DESC");

        return $query->rows;
    }
    public function getTotalReviewsByProductId($product_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "smreview r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND r.date_published < '" . date('Y-m-d H:i:s') . "' AND p.status = '1' AND r.status = '1' AND r.review_id is NULL AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row['total'];
    }
    public function addReview($product_id, $data) {

        // усли комментарий
        if(!empty($data['review_id'])){
            $this->db->query("INSERT INTO " . DB_PREFIX . "smreview SET review_id = '" . $this->db->escape($data['review_id']) . "', author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '', date_added = NOW()");
        } else {
            // отзыв
            $this->db->query("INSERT INTO " . DB_PREFIX . "smreview SET author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', image = '".$this->db->escape($data['logo'])."', picture = '".$this->db->escape($data['picture'])."', video = '".$this->db->escape($data['video'])."', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', date_added = NOW()");
        }
        $review_id = $this->db->getLastId();

        if (in_array('review', (array)$this->config->get('config_mail_alert'))) {
            $this->load->language('mail/review');
            $this->load->model('catalog/product');

            $product_info = $this->model_catalog_product->getProduct($product_id);

            $subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

            $message  = $this->language->get('text_waiting') . "\n";
            $message .= sprintf($this->language->get('text_product'), html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')) . "\n";
            $message .= sprintf($this->language->get('text_reviewer'), html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8')) . "\n";
            $message .= sprintf($this->language->get('text_rating'), $data['rating']) . "\n";
            $message .= $this->language->get('text_review') . "\n";
            $message .= html_entity_decode($data['text'], ENT_QUOTES, 'UTF-8') . "\n\n";

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
            $mail->setSubject($subject);
            $mail->setText($message);
            $mail->send();

            // Send to additional alert emails
            $emails = explode(',', $this->config->get('config_alert_email'));

            foreach ($emails as $email) {
                if ($email && preg_match($this->config->get('config_mail_regexp'), $email)) {
                    $mail->setTo($email);
                    $mail->send();
                }
            }
        }
    }
    public function addLike ($id){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview SET `like` = `like` + 1 WHERE id =  '".$id."'");

        $query = $this->db->query("SELECT r.like FROM " . DB_PREFIX . "smreview r WHERE id =  '".$id."'");

        return $query->row['like'];

    }
    public function adddsLike ($id){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview SET `dslike` = `dslike` + 1 WHERE id =  '".$id."'");

        $query = $this->db->query("SELECT r.dslike FROM " . DB_PREFIX . "smreview r WHERE id =  '".$id."'");

        return $query->row['dslike'];

    }
    public function takeLike ($id){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview SET `like` = `like` - 1 WHERE id =  '".$id."'");

        $query = $this->db->query("SELECT r.like FROM " . DB_PREFIX . "smreview r WHERE id =  '".$id."'");

        return $query->row['like'];

    }
    public function takedsLike ($id){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview SET `dslike` = `dslike` - 1 WHERE id =  '".$id."'");

        $query = $this->db->query("SELECT r.dslike FROM " . DB_PREFIX . "smreview r WHERE id =  '".$id."'");

        return $query->row['dslike'];

    }
    // Функція заповнення таблиці лайків і дізлайків по відгукам
    public function addTableLike ($review_id, $product_id, $customer_id, $like_dslike) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "smreview_like SET review_id = '" . (int)$review_id . "', product_id = '" . (int)$product_id . "', customer_id = '" . (int)$customer_id . "', `".$this->db->escape($like_dslike)."` = '1'");

    }

    public function getTableLike($review_id,$product_id,$customer_id){

        $query = $this->db->query("SELECT rl.id, rl.like, rl.dslike FROM " . DB_PREFIX . "smreview_like rl WHERE rl.review_id = '" . (int)$review_id . "' AND rl.product_id = '" . (int)$product_id . "' AND rl.customer_id = '" . (int)$customer_id . "'");

        return $query->row;
    }
    public function deleteTableLike($id){
        $this->db->query("DELETE FROM " . DB_PREFIX . "smreview_like WHERE id =  '" . $id . "'");
    }
    public function updateTableLikeAdd($id, $like_dslike){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview_like SET `".$this->db->escape($like_dslike)."` = 1 WHERE id =  '" . $id . "'");
    }
    public function updateTableLikeTake($id, $like_dslike){
        $this->db->query("UPDATE  " . DB_PREFIX . "smreview_like SET `".$this->db->escape($like_dslike)."` = 0 WHERE id =  '" . $id . "'");
    }
    public function getTableLikeCustomerId($customer_id, $product_id){

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "smreview_like WHERE customer_id = '" . (int)$customer_id . "' AND product_id = '" . (int)$product_id . "'");

        return $query->rows;
    }

    public function getAllReviewsByProductId($product_id) {

        $query = $this->db->query("SELECT r.id, r.review_id, r.like, r.dslike, r.image ,r.author, r.rating, r.text, p.product_id, pd.name, p.price, r.image, r.date_added FROM " . DB_PREFIX . "smreview r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND (r.review_id IS NULL OR r.review_id = '0') AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added");

        return $query->rows;
    }
    // Функція для визначення максимального рейтингу на товар
    public function getMaxRating($product_id){
        $query = $this->db->query("SELECT MAX(rating) AS rating FROM " . DB_PREFIX . "smreview WHERE product_id =" . $product_id);
        return $query->row['rating'];
    }
    public function getTotalOrdersByCustomerId($customer_id, $product_id) {
        // Дізнаємось всі id замовлень, які зробив користувач
        $query = $this->db->query("SELECT order_id FROM `" . DB_PREFIX . "order` WHERE customer_id = '" . (int)$customer_id . "'");
        // Змінна для кількості замовлень даного товару
        $total_order_for_review = 0;
        // Перебіраємо всі замовлення і визначаємо в яких користувач купив даний товар
        foreach ($query->rows as $r){
            $one_order = $this->getTotalOrdersByOrderId($r['order_id'],$product_id);
            $total_order_for_review = $total_order_for_review + $one_order;
        }
        return $total_order_for_review;
    }
    public function getTotalOrdersByOrderId($order_id, $product_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND product_id = '" . (int)$product_id . "'");

        return $query->row['total'];
    }
    public function getReviewsForSmReviewDisplay($data){
        $sql = "SELECT * FROM " . DB_PREFIX . "smreview";

        // Якщо вибрано мінімальний і максимальний рейтинг
        if((($data['smreviewdisp_min'] != 0) or (trim($data['smreviewdisp_min']) != '')) and (($data['smreviewdisp_max'] != 0) or (trim($data['smreviewdisp_max']) != ''))){
            $sql .= " WHERE rating >= " . (int)$data['smreviewdisp_min'] . " AND rating <= " . (int)$data['smreviewdisp_max'];
        }
        //Якщо вибрано тільки мінімальний рейтинг
        elseif((($data['smreviewdisp_min'] != 0) or (trim($data['smreviewdisp_min']) != '')) and (($data['smreviewdisp_max'] == 0) or (trim($data['smreviewdisp_max']) == ''))){
            $sql .= " WHERE rating >= " . (int)$data['smreviewdisp_min'];
        }
        //Якщо вибрано тільки максимальний рейтинг
        elseif((($data['smreviewdisp_min'] == 0) or (trim($data['smreviewdisp_min']) == '')) and (($data['smreviewdisp_max'] != 0) or (trim($data['smreviewdisp_max']) != ''))){
            $sql .= " WHERE rating <= " . (int)$data['smreviewdisp_max'];
        }

        // Якщо вибрано рандомний показ
        if($data['smreviewdisp_display'] == 'random'){
            $sql .= " ORDER BY RAND()";
        }
        // Якщо вибрано показувати останні
        elseif($data['smreviewdisp_display'] == 'last'){
            $sql .= " ORDER BY date_added DESC";
        }
        // Якщо вибрано показувати перші
        elseif($data['smreviewdisp_display'] == 'first'){
            $sql .= " ORDER BY date_added ASC";
        }

        // Якщо стоїть кількість відгуків
        if($data['smreviewdisp_quantity'] != 0 and trim($data['smreviewdisp_quantity']) != ''){
            $sql .= " LIMIT " . (int)$data['smreviewdisp_quantity'];
        // Якщо ж кількість відгуків не стоїть, виводимо по 10
        }else{
            $sql .= " LIMIT 10";
        }
        $query = $this->db->query($sql);
        return $query->rows;
    }
    //Функція для відбору замовлень користувача по певному продукту
    public function getOrdersProductByCustomerId($customer_id, $product_id) {
        $query = $this->db->query("SELECT o.order_id, o.order_status_id FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_product op ON (o.order_id = op.order_id) WHERE o.customer_id = '" . (int)$customer_id . "' AND op.product_id = '" . (int)$product_id . "' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "'");
        return $query->rows;
    }
}