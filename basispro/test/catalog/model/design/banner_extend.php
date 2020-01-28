<?php
class ModelDesignBannerExtend extends Model {

	public function getBanner($banner_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_extend_image bi
		LEFT JOIN " . DB_PREFIX . "banner_extend_image_description bid
		ON (bi.banner_extend_image_id  = bid.banner_extend_image_id)
		WHERE bi.banner_extend_id = '" . (int)$banner_id . "'
		AND bid.language_id = '" . (int)$this->config->get('config_language_id') . "'
		ORDER BY bi.sort_order ASC");

		return $query->rows;
	}
}