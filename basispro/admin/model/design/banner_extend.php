<?php
class ModelDesignBannerExtend extends Model {
	public function addBanner($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "banner_extend SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "'");

		$banner_extend_id = $this->db->getLastId();

		if (isset($data['banner_extend_image'])) {
			foreach ($data['banner_extend_image'] as $banner_extend_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "banner_extend_image
				SET banner_extend_id = '" . (int)$banner_extend_id . "',
				link = '" .  $this->db->escape($banner_extend_image['link']) . "',
				product_id = '" . (int)$banner_extend_image['product_id'] . "',
				view = '" .  (int)$banner_extend_image['view'] . "',
				text_type = '" .  (int)$banner_extend_image['text_type'] . "',
				show_price = '" .  (int)$banner_extend_image['show_price'] . "',
				image = '" .  $this->db->escape($banner_extend_image['image']) . "',
				background_image = '" .  $this->db->escape($banner_extend_image['background_image']) . "',
				sort_order = '" . (int)$banner_extend_image['sort_order'] . "',
				text_css = '" . $this->db->escape($banner_extend_image['text_css']) . "',
				photo_css = '" . $this->db->escape($banner_extend_image['photo_css']) . "',
				bg_style = '" . $this->db->escape($banner_extend_image['bg_style']) . "'");

				$banner_extend_image_id = $this->db->getLastId();

				foreach ($banner_extend_image['banner_extend_image_description'] as $language_id => $banner_extend_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "banner_extend_image_description
					SET banner_extend_image_id = '" . (int)$banner_extend_image_id . "',
					language_id = '" . (int)$language_id . "',
					banner_extend_id = '" . (int)$banner_extend_id . "',
					title = '" .  $this->db->escape($banner_extend_image_description['title']) . "',
					title2 = '" .  $this->db->escape($banner_extend_image_description['title2']) . "',
					title3 = '" .  $this->db->escape($banner_extend_image_description['title3']) . "'");
				}
			}
		}

		return $banner_extend_id;
	}

	public function editBanner($banner_extend_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "banner_extend SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "' WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_extend_image WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_extend_image_description WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");

        if (isset($data['banner_extend_image'])) {
            foreach ($data['banner_extend_image'] as $banner_extend_image) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "banner_extend_image
				SET banner_extend_id = '" . (int)$banner_extend_id . "',
				link = '" .  $this->db->escape($banner_extend_image['link']) . "',
				product_id = '" . (int)$banner_extend_image['product_id'] . "',
				view = '" .  (int)$banner_extend_image['view'] . "',
				text_type = '" .  (int)$banner_extend_image['text_type'] . "',
				show_price = '" .  (int)$banner_extend_image['show_price'] . "',
				image = '" .  $this->db->escape($banner_extend_image['image']) . "',
				background_image = '" .  $this->db->escape($banner_extend_image['background_image']) . "',
				sort_order = '" . (int)$banner_extend_image['sort_order'] . "',
				text_css = '" . $this->db->escape($banner_extend_image['text_css']) . "',
				photo_css = '" . $this->db->escape($banner_extend_image['photo_css']) . "',
				bg_style = '" . $this->db->escape($banner_extend_image['bg_style']) . "'");

                $banner_extend_image_id = $this->db->getLastId();

                foreach ($banner_extend_image['banner_extend_image_description'] as $language_id => $banner_extend_image_description) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "banner_extend_image_description
					SET banner_extend_image_id = '" . (int)$banner_extend_image_id . "',
					language_id = '" . (int)$language_id . "',
					banner_extend_id = '" . (int)$banner_extend_id . "',
					title = '" .  $this->db->escape($banner_extend_image_description['title']) . "',
					title2 = '" .  $this->db->escape($banner_extend_image_description['title2']) . "',
					title3 = '" .  $this->db->escape($banner_extend_image_description['title3']) . "'");
                }
            }
        }

    }

	public function deleteBanner($banner_extend_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_extend WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_extend_image WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "banner_extend_image_description WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");

	}

	public function getBanner($banner_extend_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "banner_extend WHERE banner_extend_id = '" . (int)$banner_extend_id . "'");

		return $query->row;
	}

	public function getBanners($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "banner_extend";

		$sort_data = array(
			'name',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

	public function getBannerImages($banner_extend_id) {
		$banner_extend_image_data = array();

		$banner_extend_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_extend_image WHERE banner_extend_id = '" . (int)$banner_extend_id . "' ORDER BY sort_order ASC");

		foreach ($banner_extend_image_query->rows as $banner_extend_image) {
			$banner_extend_image_description_data = array();

			$banner_extend_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "banner_extend_image_description WHERE banner_extend_image_id = '" . (int)$banner_extend_image['banner_extend_image_id'] . "' AND banner_extend_id = '" . (int)$banner_extend_id . "'");

			foreach ($banner_extend_image_description_query->rows as $banner_extend_image_description) {
				$banner_extend_image_description_data[$banner_extend_image_description['language_id']] = array('title' => $banner_extend_image_description['title'],'title2' => $banner_extend_image_description['title2'],'title3' => $banner_extend_image_description['title3']);
			}

			$banner_extend_image_data[] = array(
				'banner_extend_image_description'   => $banner_extend_image_description_data,
				'link'                              => $banner_extend_image['link'],
                'product_id'                        => $banner_extend_image['product_id'],
                'view'                              => $banner_extend_image['view'],
                'text_type'                         => $banner_extend_image['text_type'],
                'show_price'                        => $banner_extend_image['show_price'],
				'image'                             => $banner_extend_image['image'],
				'background_image'                  => $banner_extend_image['background_image'],
				'sort_order'                        => $banner_extend_image['sort_order'],
                'text_css'                          => $banner_extend_image['text_css'],
                'photo_css'                         => $banner_extend_image['photo_css'],
                'bg_style'                          => $banner_extend_image['bg_style']
			);
		}

		return $banner_extend_image_data;
	}

	public function getTotalBanners() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "banner_extend");

		return $query->row['total'];
	}
}
//to encode