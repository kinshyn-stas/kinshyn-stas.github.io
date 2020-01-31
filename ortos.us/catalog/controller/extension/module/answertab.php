<?php
class ControllerExtensionModuleAnswertab extends Controller {
	public function index($arg = array()) {

        $this->load->language('extension/module/answertab');

        $this->load->model('extension/module/answertab');

        $data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
	    $data['answers'] = $this->model_extension_module_answertab->getAnswers($arg['product_id']);
	    $data['product_id'] = $arg['product_id'];

	    $data['answertab_show_text_after'] = $this->config->get('answertab_show_text_after');
        $data['answertab_text_after'] = html_entity_decode( $this->config->get('answertab_text_after') );

        $data['heading_title'] = $this->language->get('heading_title');
        $data['months'] = preg_split('/,\s+/',$this->language->get('months'));
        $data['new_answer'] = $this->language->get('new_answer');
        $data['inputName'] = $this->language->get('inputName');
        $data['inputEmail'] = $this->language->get('inputEmail');
        $data['inputEmail_text'] = $this->language->get('inputEmail_text');
        $data['inputAsk'] = $this->language->get('inputEmail_text');
        $data['close_btn'] = $this->language->get('close_btn');
        $data['submit_btn'] = $this->language->get('submit_btn');

		return $this->load->view('extension/module/answertab', $data);
	}

	public function addask(){

	    $data = array();

        $data['product_id'] = $this->request->post['product_id'];
	    $data['author'] = $this->request->post['author'];
        $data['email'] = $this->request->post['email'];
        $data['text'] = $this->request->post['text'];

        $this->load->model('catalog/product');
        $product_info = $this->model_catalog_product->getProduct($data['product_id']);

        $data['text_answer'] = '';
        $data['status'] = 0;
        $data['date_added'] = date("Y-m-d H:i:s");

        $this->load->model('extension/module/answertab');

        $this->model_extension_module_answertab->addAsk($data);


        $subject = sprintf('Новый вопрос на сайте '.html_entity_decode($this->config->get('config_name')), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

        $message = "Вопрос по товару \"".$product_info['name']."\":\n";
        $message .= $this->request->post['text'];
        $message .= "\n\n";
        $message .= "Автор:\n";
        $message .= $this->request->post['author'];

        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
        $mail->send();

        $respone = array(
            'success' => true
        );

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($respone));

        exit;

    }
}