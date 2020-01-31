<?php
class ModelExtensionModuleAnswertab extends Model {

    public function getAnswers($product_id){

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "answer` WHERE `status` = 1 AND `product_id` = ".$product_id." ORDER BY date_added DESC");

        return $query->rows;

    }

    public function addAsk($data){

        $this->db->query("INSERT INTO " . DB_PREFIX . "answer SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', text_answer = '" . $this->db->escape(strip_tags($data['text_answer'])) . "', status = '" . (int)$data['status'] . "', date_added = '" . $this->db->escape($data['date_added']) . "'");

    }

}