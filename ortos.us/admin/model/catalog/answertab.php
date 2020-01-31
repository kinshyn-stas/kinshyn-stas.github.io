<?php
class ModelCatalogAnswerTab extends Model {
    public function addAnswer($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "answer SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', text_answer = '" . $this->db->escape(strip_tags($data['text_answer'])) . "', status = '" . (int)$data['status'] . "', date_added = '" . $this->db->escape($data['date_added']) . "'");

        $answer_id = $this->db->getLastId();

        $this->cache->delete('product');

        return $answer_id;
    }

    public function editAnswer($answer_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "answer SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', text_answer = '" . $this->db->escape(strip_tags($data['text_answer'])) . "', status = '" . (int)$data['status'] . "', date_added = '" . $this->db->escape($data['date_added']) . "', date_modified = NOW() WHERE answer_id = '" . (int)$answer_id . "'");

        $this->cache->delete('product');
    }

    public function deleteAnswer($answer_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "answer WHERE answer_id = '" . (int)$answer_id . "'");

        $this->cache->delete('product');
    }

    public function getAnswer($answer_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT pd.name FROM " . DB_PREFIX . "product_description pd WHERE pd.product_id = r.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS product FROM " . DB_PREFIX . "answer r WHERE r.answer_id = '" . (int)$answer_id . "'");

        return $query->row;
    }

    public function getAnswers($data = array()) {
        $sql = "SELECT r.answer_id, pd.name, r.author, r.text, r.status, r.date_added FROM " . DB_PREFIX . "answer r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_product'])) {
            $sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
        }

        if (!empty($data['filter_author'])) {
            $sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        $sort_data = array(
            'pd.name',
            'r.author',
            'r.status',
            'r.date_added'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY r.date_added";
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

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalAnswers($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "answer r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_product'])) {
            $sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
        }

        if (!empty($data['filter_author'])) {
            $sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
        }

        if (!empty($data['filter_date_added'])) {
            $sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalReviewsAwaitingApproval() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review WHERE status = '0'");

        return $query->row['total'];
    }
}