<?php
class ModelCustomerLightField extends Model {
	public function addLightField($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "light_field` SET
		type = '" . $this->db->escape($data['type']) . "',
		value = '" . $this->db->escape($data['value']) . "',
		status = '" . (int)$data['status'] . "',
		status_reg = '" . (int)$data['status_reg'] . "',
		status_edit = '" . (int)$data['status_edit'] . "',
		status_cart = '" . (int)$data['status_cart'] . "',
		sort_order = '" . (int)$data['sort_order'] . "'");

		$light_field_id = $this->db->getLastId();

		foreach ($data['light_field_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_description SET
			light_field_id = '" . (int)$light_field_id . "',
			language_id = '" . (int)$language_id . "',
			name = '" . $this->db->escape($value['name']) . "'");
		}

		if (isset($data['light_field_customer_group'])) {
			foreach ($data['light_field_customer_group'] as $light_field_customer_group) {
				if (isset($light_field_customer_group['customer_group_id'])) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_customer_group SET
					light_field_id = '" . (int)$light_field_id . "',
					customer_group_id = '" . (int)$light_field_customer_group['customer_group_id'] . "',
					required = '" . (int)(isset($light_field_customer_group['required']) ? 1 : 0) . "'");
				}
			}
		}

        
        if (isset($data['light_field_to_standart_field'])) {
            foreach ($data['light_field_to_standart_field'] as $light_field_to_standart_field) {
                if (isset($light_field_to_standart_field['standart_field_name'])) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "light_field_to_standart_field SET
                    light_field_id = '" . (int)$light_field_id . "',
                    standart_field_name = '" . $light_field_to_standart_field['standart_field_name'] . "'");
                }
            }
        }
        

		if (isset($data['light_field_value'])) {
			foreach ($data['light_field_value'] as $light_field_value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_value SET
				light_field_id = '" . (int)$light_field_id . "',
				sort_order = '" . (int)$light_field_value['sort_order'] . "'");

				$light_field_value_id = $this->db->getLastId();

				foreach ($light_field_value['light_field_value_description'] as $language_id => $light_field_value_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_value_description SET
					light_field_value_id = '" . (int)$light_field_value_id . "',
					language_id = '" . (int)$language_id . "',
					light_field_id = '" . (int)$light_field_id . "',
					name = '" . $this->db->escape($light_field_value_description['name']) . "'");
				}
			}
		}
	}

	public function editLightField($light_field_id, $data) {

		$this->db->query("UPDATE `" . DB_PREFIX . "light_field` SET
		type = '" . $this->db->escape($data['type']) . "',
		value = '" . $this->db->escape($data['value']) . "',
		status = '" . (int)$data['status'] . "',
		status_reg = '" . (int)$data['status_reg'] . "',
		status_edit = '" . (int)$data['status_edit'] . "',
		status_cart = '" . (int)$data['status_cart'] . "',
		sort_order = '" . (int)$data['sort_order'] . "'
		WHERE light_field_id = '" . (int)$light_field_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "light_field_description WHERE light_field_id = '" . (int)$light_field_id . "'");

		foreach ($data['light_field_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_description SET
			light_field_id = '" . (int)$light_field_id . "',
			language_id = '" . (int)$language_id . "',
			name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "light_field_customer_group WHERE light_field_id = '" . (int)$light_field_id . "'");

		if (isset($data['light_field_customer_group'])) {
			foreach ($data['light_field_customer_group'] as $light_field_customer_group) {
				if (isset($light_field_customer_group['customer_group_id'])) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_customer_group SET
					light_field_id = '" . (int)$light_field_id . "',
					customer_group_id = '" . (int)$light_field_customer_group['customer_group_id'] . "',
					required = '" . (int)(isset($light_field_customer_group['required']) ? 1 : 0) . "'");
				}
			}
		}

        
        $this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_to_standart_field` WHERE light_field_id = '" . (int)$light_field_id . "'");

        if (isset($data['light_field_to_standart_field'])) {
            foreach ($data['light_field_to_standart_field'] as $light_field_to_standart_field) {
                if (isset($light_field_to_standart_field['standart_field_name'])) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "light_field_to_standart_field SET
                    light_field_id = '" . (int)$light_field_id . "',
                    standart_field_name = '" . $light_field_to_standart_field['standart_field_name'] . "'");
                }
            }
        }
        

		$this->db->query("DELETE FROM " . DB_PREFIX . "light_field_value WHERE light_field_id = '" . (int)$light_field_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "light_field_value_description WHERE light_field_id = '" . (int)$light_field_id . "'");

		if (isset($data['light_field_value'])) {
			foreach ($data['light_field_value'] as $light_field_value) {
				if ($light_field_value['light_field_value_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_value SET
					light_field_value_id = '" . (int)$light_field_value['light_field_value_id'] . "',
					light_field_id = '" . (int)$light_field_id . "',
					sort_order = '" . (int)$light_field_value['sort_order'] . "'");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_value SET
					light_field_id = '" . (int)$light_field_id . "',
					sort_order = '" . (int)$light_field_value['sort_order'] . "'");
				}

				$light_field_value_id = $this->db->getLastId();

				foreach ($light_field_value['light_field_value_description'] as $language_id => $light_field_value_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "light_field_value_description SET
					light_field_value_id = '" . (int)$light_field_value_id . "',
					language_id = '" . (int)$language_id . "',
					light_field_id = '" . (int)$light_field_id . "',
					name = '" . $this->db->escape($light_field_value_description['name']) . "'");
				}
			}
		}
	}

	public function deleteLightField($light_field_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "light_field` WHERE light_field_id = '" . (int)$light_field_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_description` WHERE light_field_id = '" . (int)$light_field_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_customer_group` WHERE light_field_id = '" . (int)$light_field_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_value` WHERE light_field_id = '" . (int)$light_field_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_value_description` WHERE light_field_id = '" . (int)$light_field_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "light_field_to_standart_field` WHERE light_field_id = '" . (int)$light_field_id . "'");

    }

	public function getLightField($light_field_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field` lf LEFT JOIN " . DB_PREFIX . "light_field_description lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lf.light_field_id = '" . (int)$light_field_id . "' AND lfd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getLightFields($data = array()) {
		if (empty($data['filter_customer_group_id'])) {
			$sql = "SELECT * FROM `" . DB_PREFIX . "light_field` lf LEFT JOIN " . DB_PREFIX . "light_field_description lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		} else {
			$sql = "SELECT * FROM " . DB_PREFIX . "light_field_customer_group lfcg LEFT JOIN `" . DB_PREFIX . "light_field` lf ON (lfcg.light_field_id = lf.light_field_id) LEFT JOIN " . DB_PREFIX . "light_field_description lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND lfd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$sql .= " AND lfcg.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}

		$sort_data = array(
			'lfd.name',
			'lf.type',
			'lf.status',
			'lf.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY lfd.name";
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

    public function getCustomerLightFields($customer_group_id = 0) {
        $light_field_data = array();

        if (!$customer_group_id) {
            $light_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field` lf LEFT JOIN `" . DB_PREFIX . "light_field_description` lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lf.status = '1' AND lfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND lf.status = '1' ORDER BY lf.sort_order ASC");
        } else {
            $light_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field_customer_group` lfcg LEFT JOIN `" . DB_PREFIX . "light_field` lf ON (lfcg.light_field_id = lf.light_field_id) LEFT JOIN `" . DB_PREFIX . "light_field_description` lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lf.status = '1' AND lfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND lfcg.customer_group_id = '" . (int)$customer_group_id . "' ORDER BY lf.sort_order ASC");
        }

        foreach ($light_field_query->rows as $light_field) {
            $light_field_value_data = array();

            if ($light_field['type'] == 'select' || $light_field['type'] == 'radio') {
                $light_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_value lfv LEFT JOIN " . DB_PREFIX . "light_field_value_description lfvd ON (lfv.light_field_value_id = lfvd.light_field_value_id) WHERE lfv.light_field_id = '" . (int)$light_field['light_field_id'] . "' AND lfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY lfv.sort_order ASC");

                foreach ($light_field_value_query->rows as $light_field_value) {
                    $light_field_value_data[] = array(
                        'light_field_value_id' => $light_field_value['light_field_value_id'],
                        'name'                  => $light_field_value['name']
                    );
                }
            }

            $light_field_data[] = array(
                'light_field_id'    => $light_field['light_field_id'],
                'light_field_value' => $light_field_value_data,
                'name'               => $light_field['name'],
                'type'               => $light_field['type'],
                'value'              => $light_field['value'],
                'status_reg'              => $light_field['status_reg'],
                'status_edit'              => $light_field['status_edit'],
                'status_cart'              => $light_field['status_cart'],
                'required'           => empty($light_field['required']) || $light_field['required'] == 0 ? false : true,
                'sort_order'         => $light_field['sort_order']
            );
        }

        return $light_field_data;
    }

    public function addCustomerLightField($data, $customer_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "customer SET light_field = '" . $this->db->escape(isset($data['light_field']) ? json_encode($data['light_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");
    }

	public function getLightFieldDescriptions($light_field_id) {
		$light_field_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_description WHERE light_field_id = '" . (int)$light_field_id . "'");

		foreach ($query->rows as $result) {
			$light_field_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $light_field_data;
	}
	
	public function getLightFieldValue($light_field_value_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_value lfv LEFT JOIN " . DB_PREFIX . "light_field_value_description lfvd ON (lfv.light_field_value_id = lfvd.light_field_value_id) WHERE lfv.light_field_value_id = '" . (int)$light_field_value_id . "' AND lfvd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getLightFieldValues($light_field_id) {
		$light_field_value_data = array();

		$light_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_value lfv LEFT JOIN " . DB_PREFIX . "light_field_value_description lfvd ON (lfv.light_field_value_id = lfvd.light_field_value_id) WHERE lfv.light_field_id = '" . (int)$light_field_id . "' AND lfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY lfv.sort_order ASC");

		foreach ($light_field_value_query->rows as $light_field_value) {
			$light_field_value_data[$light_field_value['light_field_value_id']] = array(
				'light_field_value_id' => $light_field_value['light_field_value_id'],
				'name'                  => $light_field_value['name']
			);
		}

		return $light_field_value_data;
	}
	
	public function getLightFieldCustomerGroups($light_field_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field_customer_group` WHERE light_field_id = '" . (int)$light_field_id . "'");

		return $query->rows;
	}

    
    public function getLightFieldToStandartField($light_field_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field_to_standart_field` WHERE light_field_id = '" . (int)$light_field_id . "'");

        return $query->rows;
    }
    

	public function getLightFieldValueDescriptions($light_field_id) {
		$light_field_value_data = array();

		$light_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_value WHERE light_field_id = '" . (int)$light_field_id . "'");

		foreach ($light_field_value_query->rows as $light_field_value) {
			$light_field_value_description_data = array();

			$light_field_value_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "light_field_value_description WHERE light_field_value_id = '" . (int)$light_field_value['light_field_value_id'] . "'");

			foreach ($light_field_value_description_query->rows as $light_field_value_description) {
				$light_field_value_description_data[$light_field_value_description['language_id']] = array('name' => $light_field_value_description['name']);
			}

			$light_field_value_data[] = array(
				'light_field_value_id'          => $light_field_value['light_field_value_id'],
				'light_field_value_description' => $light_field_value_description_data,
				'sort_order'                     => $light_field_value['sort_order']
			);
		}

		return $light_field_value_data;
	}

	public function getTotalLightFields() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "light_field`");

		return $query->row['total'];
	}
}
//to encode