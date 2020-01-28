<?php
class ModelCatalogInformationExtend extends Model {
	public function addInformationExtend($data) {
		$this->event->trigger('pre.admin.information.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "information SET
		sort_order = '" . (int)$data['sort_order'] . "',
		information_category_id = '" . (int)$data['information_category_id'] . "',
		bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "',
		status = '" . (int)$data['status'] . "',
		date_added = NOW()");

		$information_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
        }

		foreach ($data['information_extend_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET
			information_id = '" . (int)$information_id . "',
			language_id = '" . (int)$language_id . "',
			title = '" . $this->db->escape($value['title']) . "',
			description = '" . $this->db->escape($value['description']) . "',
			short_description = '" . $this->db->escape($value['short_description']) . "',
			meta_title = '" . $this->db->escape($value['meta_title']) . "',
			meta_h1 = '" . $this->db->escape($value['meta_h1']) . "',
			meta_description = '" . $this->db->escape($value['meta_description']) . "',
			meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['information_extend_store'])) {
			foreach ($data['information_extend_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['information_extend_layout'])) {
			foreach ($data['information_extend_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('information');

		$this->event->trigger('post.admin.information.add', $information_id);

		return $information_id;
	}

	public function editInformationExtend($information_id, $data) {
		$this->event->trigger('pre.admin.information.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "information SET
		sort_order = '" . (int)$data['sort_order'] . "',
		information_category_id = '" . (int)$data['information_category_id'] . "',
		bottom = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "',
		status = '" . (int)$data['status'] . "' WHERE information_id = '" . (int)$information_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "information SET image = '" . $this->db->escape($data['image']) . "' WHERE information_id = '" . (int)$information_id . "'");
        }

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

		foreach ($data['information_extend_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "information_description SET
			information_id = '" . (int)$information_id . "',
			language_id = '" . (int)$language_id . "',
			title = '" . $this->db->escape($value['title']) . "',
			description = '" . $this->db->escape($value['description']) . "',
			short_description = '" . $this->db->escape($value['short_description']) . "',
			meta_title = '" . $this->db->escape($value['meta_title']) . "',
			meta_h1 = '" . $this->db->escape($value['meta_h1']) . "',
			meta_description = '" . $this->db->escape($value['meta_description']) . "',
			meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_extend_store'])) {
			foreach ($data['information_extend_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_store SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		if (isset($data['information_extend_layout'])) {
			foreach ($data['information_extend_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "information_to_layout SET information_id = '" . (int)$information_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('information');

		$this->event->trigger('post.admin.information.edit', $information_id);
	}

	public function deleteInformationExtend($information_id) {
		$this->event->trigger('pre.admin.information.delete', $information_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		$this->cache->delete('information');

		$this->event->trigger('post.admin.information.delete', $information_id);
	}

	public function getInformationExtend($information_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'information_id=" . (int)$information_id . "') AS keyword FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "'");

		return $query->row;
	}

	public function getInformationExtends($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sort_data = array(
				'id.title',
				'i.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id.title";
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
		} else {
			$information_data = $this->cache->get('information.' . (int)$this->config->get('config_language_id'));

			if (!$information_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.title");

				$information_data = $query->rows;

				$this->cache->set('information.' . (int)$this->config->get('config_language_id'), $information_data);
			}

			return $information_data;
		}
	}

	public function getInformationExtendDescriptions($information_id) {
		$information_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_description WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'          => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'short_description' => $result['short_description'],
				'meta_keyword'     => $result['meta_keyword']
			);
		}

		return $information_description_data;
	}

	public function getInformationExtendStores($information_id) {
		$information_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_store WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_store_data[] = $result['store_id'];
		}

		return $information_store_data;
	}

	public function getInformationExtendLayouts($information_id) {
		$information_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "'");

		foreach ($query->rows as $result) {
			$information_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $information_layout_data;
	}

	public function getTotalInformationExtends() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information");

		return $query->row['total'];
	}

	public function getTotalInformationExtendsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

    public function getTotalInformationCategorys() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "information_category");

        return $query->row['total'];
    }

    public function getInformationCategorys($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "information_category i LEFT JOIN " . DB_PREFIX . "information_category_description id ON (i.information_category_id = id.information_category_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            $sort_data = array(
                'id.name',
                'i.sort_order'
            );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY id.name";
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
        } else {
            $information_category_data = $this->cache->get('information_category.' . (int)$this->config->get('config_language_id'));

            if (!$information_category_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_category i LEFT JOIN " . DB_PREFIX . "information_category_description id ON (i.information_category_id = id.information_category_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.name");

                $information_category_data = $query->rows;

                $this->cache->set('information_category.' . (int)$this->config->get('config_language_id'), $information_category_data);
            }

            return $information_category_data;
        }
    }

    public function addInformationCategory($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "information_category SET
        sort_order = '" . (int)$data['sort_order'] . "',
        status = '" . (int)$data['status'] . "'");

        $information_category_id = $this->db->getLastId();

        foreach ($data['information_category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "information_category_description SET
            information_category_id = '" . (int)$information_category_id . "',
            language_id = '" . (int)$language_id . "',
            name = '" . $this->db->escape($value['name']) . "',
            description = '" . $this->db->escape($value['description']) . "',
            meta_title = '" . $this->db->escape($value['meta_title']) . "',
            meta_h1 = '" . $this->db->escape($value['meta_h1']) . "',
            meta_description = '" . $this->db->escape($value['meta_description']) . "',
            meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }


        if (isset($data['keyword'])) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET
            query = 'information_category_id=" . (int)$information_category_id . "',
            keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('information_category');


        return $information_category_id;
    }

    public function getInformationCategory($information_category_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'information_category_id=" . (int)$information_category_id . "') AS keyword FROM " . DB_PREFIX . "information_category WHERE information_category_id = '" . (int)$information_category_id . "'");

        return $query->row;
    }

    public function getInformationCategoryDescriptions($information_category_id) {
        $information_category_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_category_description WHERE information_category_id = '" . (int)$information_category_id . "'");

        foreach ($query->rows as $result) {
            $information_category_description_data[$result['language_id']] = array(
                'name'            => $result['name'],
                'description'      => $result['description'],
                'meta_title'       => $result['meta_title'],
                'meta_h1'          => $result['meta_h1'],
                'meta_description' => $result['meta_description'],
                'meta_keyword'     => $result['meta_keyword']
            );
        }

        return $information_category_description_data;
    }

    public function editInformationCategory($information_category_id, $data) {
 
        $this->db->query("UPDATE " . DB_PREFIX . "information_category SET
        sort_order = '" . (int)$data['sort_order'] . "',
        status = '" . (int)$data['status'] . "'
        WHERE information_category_id = '" . (int)$information_category_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_category_description WHERE information_category_id = '" . (int)$information_category_id . "'");

        foreach ($data['information_category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "information_category_description SET
            information_category_id = '" . (int)$information_category_id . "',
            language_id = '" . (int)$language_id . "',
            name = '" . $this->db->escape($value['name']) . "',
            description = '" . $this->db->escape($value['description']) . "',
            meta_title = '" . $this->db->escape($value['meta_title']) . "',
            meta_h1 = '" . $this->db->escape($value['meta_h1']) . "',
            meta_description = '" . $this->db->escape($value['meta_description']) . "',
            meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_category_id=" . (int)$information_category_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'information_category_id=" . (int)$information_category_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }

        $this->cache->delete('information_category');

     }

    public function getInformationCategoryId($information_id) {
        $query = $this->db->query("SELECT information_category_id FROM " . DB_PREFIX . "information WHERE information_id = '" . (int)$information_id . "' LIMIT 1");

        return ($query->num_rows ? (int)$query->row['information_category_id'] : 0);
    }

    public function deleteInformationCategory($information_category_id) {

        $this->db->query("DELETE FROM " . DB_PREFIX . "information_category WHERE information_category_id = '" . (int)$information_category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "information_category_description WHERE information_category_id = '" . (int)$information_category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'information_category_id=" . (int)$information_category_id . "'");

        $this->cache->delete('information_category');

    }
}
//to encode