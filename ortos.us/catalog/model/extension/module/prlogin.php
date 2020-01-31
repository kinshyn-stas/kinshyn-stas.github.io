<?php

class ModelExtensionModulePRLogin extends Model {

    public function addCustomer($data) {

        if (isset($data['customer_group_id'])
            && is_array($this->config->get('config_customer_group_display'))
            && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {

            $customer_group_id = $data['customer_group_id'];
        } else {
            $customer_group_id = $this->config->get('config_customer_group_id');
        }

        $this->load->model('account/customer_group');

        $customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

        $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? serialize($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(),
                true)), 0,
                9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");

        $customer_id = $this->db->getLastId();

        $this->load->language('mail/customer');

        $subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

        $message = sprintf($this->language->get('text_welcome'), $this->config->get('config_name')) . "\n\n";

        if (!$customer_group_info['approval']) {
            $message .= $this->language->get('text_login') . "\n";
        } else {
            $message .= $this->language->get('text_approval') . "\n";
        }

        $message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
        $message .= $this->language->get('text_services') . "\n\n";
        $message .= $this->language->get('text_thanks') . "\n";
        $message .= $this->config->get('config_name');

        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

        $mail->setTo($data['email']);
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject($subject);
        $mail->setText($message);
        $mail->send();

        // Send to main admin email if new account email is enabled
        if ($this->config->get('config_account_mail')) {
            $message = $this->language->get('text_signup') . "\n\n";
            $message .= $this->language->get('text_website') . ' ' . $this->config->get('config_name') . "\n";
            $message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
            $message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
            $message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
            $message .= $this->language->get('text_email') . ' ' . $data['email'] . "\n";
            $message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject($this->language->get('text_new_customer'));
            $mail->setText($message);
            $mail->send();

            // Send to additional alert emails if new account email is enabled
            $emails = explode(',', $this->config->get('config_mail_alert'));

            foreach ($emails as $email) {
                if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                    $mail->setTo($email);
                    $mail->send();
                }
            }
        }

        return $customer_id;
    }
}