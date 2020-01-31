<?php
class ModelGalleryVideo extends Model {
	public function updateViewed($video_id) {
		$this->db->query("UPDATE po_opencart_gallery_video SET viewed = (viewed + 1) WHERE video_id = '" . (int)$video_id . "'");
	}

	public function getVideo($video_id) {
		
		$query = $this->db->query("SELECT DISTINCT *, vd.name AS name, v.image, v.sort_order FROM po_opencart_gallery_video v LEFT JOIN po_opencart_gallery_video_description vd ON (v.video_id = vd.video_id) LEFT JOIN po_opencart_gallery_video_to_store v2s ON (v.video_id = v2s.video_id) WHERE v.video_id = '" . (int)$video_id . "' AND vd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND v.status = '1' AND v2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'video_id'         => $query->row['video_id'],
				'name'             => $query->row['name'],
				'image'             => $query->row['image'],
				'video'            => $query->row['video'],
				'description'      => $query->row['description'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'viewed'           => $query->row['viewed']
			);
		} else {
			return false;
		}
	}

	public function getVideos($data = array()) {

		$sql = "SELECT v.video_id "; 

		
		$sql .= " FROM po_opencart_gallery_video v";
		

		$sql .= " LEFT JOIN po_opencart_gallery_video_description vd ON (v.video_id = vd.video_id) LEFT JOIN po_opencart_gallery_video_to_store v2s ON (v.video_id = v2s.video_id) WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND v.status = '1' AND v2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "vd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR vd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			$sql .= ")";
		}

		$sql .= " GROUP BY v.video_id";

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " ORDER BY v.sort_order DESC";
		} else {
			$sql .= " ORDER BY v.sort_order ASC";
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

		$video_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$video_data[$result['video_id']] = $this->getVideo($result['video_id']);
		}

		return $video_data;
	}

	public function getTotalVideos($data = array()) {
		
		$sql = "SELECT COUNT(DISTINCT v.video_id) AS total"; 

		$sql .= " FROM po_opencart_gallery_video v";

		$sql .= " LEFT JOIN po_opencart_gallery_video_description vd ON (v.video_id = vd.video_id) LEFT JOIN po_opencart_gallery_video_to_store v2s ON (v.video_id = v2s.video_id) WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND v.status = '1' AND v2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";


		if (!empty($data['filter_name'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "vd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR vd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			$sql .= ")";				
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getImage($image_id) {

		$query = $this->db->query("SELECT DISTINCT *, id.name AS name, i.image, i.sort_order FROM po_opencart_gallery_image i LEFT JOIN  po_opencart_gallery_image_description id ON (i.image_id = id.image_id) LEFT JOIN po_opencart_gallery_image_to_store i2s ON (i.image_id = i2s.image_id) WHERE i.image_id = '" . (int)$image_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return array(
				'image_id'       => $query->row['image_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'image'            => $query->row['image'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
			);
		} else {
			return false;
		}
	}

	public function getImages($data = array()) {
		
		$sql = "SELECT i.image_id"; 

		if (!empty($data['filter_video_id'])) {
			
			$sql .= " FROM po_opencart_gallery_image_to_video i2a LEFT JOIN po_opencart_gallery_image i ON (i2a.image_id = i.image_id)";

		} else {

			$sql .= " FROM po_opencart_gallery_image i";

		}

		$sql .= " LEFT JOIN po_opencart_gallery_image_description id ON (i.image_id = id.image_id) LEFT JOIN po_opencart_gallery_image_to_store i2s ON (i.image_id = i2s.image_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_video_id'])) {
			
			$sql .= " AND i2v.video_id = '" . (int)$data['filter_video_id'] . "'";			
		
		}	

		
		if (!empty($data['filter_name'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "ad.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}	

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}		

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}		

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sql .= " GROUP BY p.product_id";

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$product_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getAlbumImages($video_id) {
		$query = $this->db->query("SELECT * FROM po_opencart_gallery_image i LEFT JOIN po_opencart_gallery_image_to_video i2a ON (i.image_id = i2a.image_id) LEFT JOIN po_opencart_gallery_image_description ad ON (i.image_id = ad.image_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i.status = '1' AND i2a.video_id = '" . (int)$video_id . "' ORDER BY i.sort_order ASC");

		return $query->rows;
	}

}
?>