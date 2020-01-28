<?php
class ModelCatalogInformationCategory extends Model {
	public function getInformationCategory($information_category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information_category i
		LEFT JOIN " . DB_PREFIX . "information_category_description id ON (i.information_category_id = id.information_category_id)
		WHERE i.information_category_id = '" . (int)$information_category_id . "'
		AND id.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getCategoryInformations($information_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i
		LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id)
		WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
		AND i.information_category_id = '" . (int)$information_category_id . "'
		AND i.status = '1'
		ORDER BY i.sort_order ASC, i.date_added DESC");

		return $query->rows;
	}

	public function getInformationCategorys() {

            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_category i
            LEFT JOIN " . DB_PREFIX . "information_category_description id
            ON (i.information_category_id = id.information_category_id)
            WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
            ORDER BY i.sort_order");

        return $query->rows;
	}

}