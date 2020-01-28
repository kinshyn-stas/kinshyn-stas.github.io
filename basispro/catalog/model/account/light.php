<?php
class ModelAccountLight extends Model {

    public function getLightFieldToStandartField($light_field_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field_to_standart_field` WHERE light_field_id = '" . (int)$light_field_id . "'");
        return $query->rows;
    }

    public function getLightFieldToEmailField() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field_to_standart_field` WHERE standart_field_name = 'email'");
        return $query->rows;
    }

    public function getLightField($light_field_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "light_field` lf LEFT JOIN `" . DB_PREFIX . "light_field_description` lfd ON (lf.light_field_id = lfd.light_field_id) WHERE lf.status = '1' AND lf.light_field_id = '" . (int)$light_field_id . "' AND lfd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }

    public function getLightFields($customer_group_id = 0) {
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

    public function addOrderLightField($data, $order_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "order SET light_field = '" . $this->db->escape(isset($data) ? json_encode($data) : '') . "' WHERE order_id = '" . (int)$order_id . "'");
    }
}
