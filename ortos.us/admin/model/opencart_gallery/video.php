<?php
class ModelOpencartGalleryvideo extends Model {
	public function addVideo($data) {
		$this->db->query("INSERT INTO po_opencart_gallery_video SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', video = '" . $data['video'] . "', date_added = NOW()");

		$video_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE po_opencart_gallery_video SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE video_id = '" . (int)$video_id . "'");
		}

		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO po_opencart_gallery_video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		if (isset($data['video_store'])) {
			foreach ($data['video_store'] as $store_id) {
				$this->db->query("INSERT INTO po_opencart_gallery_video_to_store SET video_id = '" . (int)$video_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'video_id=" . (int)$video_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('video');
	}

	public function editVideo($video_id, $data) {
		$this->db->query("UPDATE po_opencart_gallery_video SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', video = '" . $data['video'] . "' WHERE video_id = '" . (int)$video_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE po_opencart_gallery_video SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE video_id = '" . (int)$video_id . "'");
		}

		$this->db->query("DELETE FROM po_opencart_gallery_video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO po_opencart_gallery_video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "',  meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		
		$this->db->query("DELETE FROM po_opencart_gallery_video_to_store WHERE video_id = '" . (int)$video_id . "'");

		if (isset($data['video_store'])) {		
			foreach ($data['video_store'] as $store_id) {
				$this->db->query("INSERT INTO po_opencart_gallery_video_to_store SET video_id = '" . (int)$video_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'video_id=" . (int)$video_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'video_id=" . (int)$video_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('video');
	}

	public function deleteVideo($video_id) {

		$this->db->query("DELETE FROM po_opencart_gallery_video WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM po_opencart_gallery_video_description WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM po_opencart_gallery_video_to_store WHERE video_id = '" . (int)$video_id . "'");

		$this->cache->delete('video');
	} 

	
	public function getVideo($video_id) {
		$query = $this->db->query("SELECT DISTINCT *,  (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'video_id=" . (int)$video_id . "') AS keyword FROM po_opencart_gallery_video v LEFT JOIN po_opencart_gallery_video_description vd ON (v.video_id = vd.video_id) WHERE v.video_id = '" . (int)$video_id . "' AND vd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	} 

	public function getVideos($data = array()) {
		$sql = "SELECT * FROM po_opencart_gallery_video v LEFT JOIN po_opencart_gallery_video_description vd ON (v.video_id = vd.video_id)";

		$sql .= " WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 

		if (!empty($data['filter_name'])) {
			$sql .= " AND vd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY v.video_id";

		$sort_data = array(
			'vd.name',
			'v.sort_order',
			'v.viewed',
		);


		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY vd.name";	
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

	public function getTotalVideos() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM po_opencart_gallery_video");

		return $query->row['total'];
	}	

	public function getVideoDescriptions($video_id) {
		$video_description_data = array();

		$query = $this->db->query("SELECT * FROM po_opencart_gallery_video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($query->rows as $result) {
			$video_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $video_description_data;
	}	

	public function getVideoStores($video_id) {
		$video_store_data = array();

		$query = $this->db->query("SELECT * FROM po_opencart_gallery_video_to_store WHERE video_id = '" . (int)$video_id . "'");

		foreach ($query->rows as $result) {
			$video_store_data[] = $result['store_id'];
		}

		return $video_store_data;
	}

}
?>