<?php
class ControllerExtensionModuleInformationExtend extends Controller {
	public function index($setting) {
		$this->load->language('module/information');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('catalog/information_category');
        $this->load->model('tool/image');

		$data['informations'] = array();

        if ($setting['information_category_id'] != 0) {
            $information_category_info = $this->model_catalog_information_category->getInformationCategory($setting['information_category_id']);
            if ($information_category_info) {
            $data['heading_title'] = $information_category_info['name'];
            } else {
                $data['heading_title'] = '';
            }

        }

		foreach ($this->model_catalog_information_category->getCategoryInformations($setting['information_category_id']) as $result) {
            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
            }

            if ($result['short_description']) {
                $description = html_entity_decode($result['short_description']);
            } else {
                $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..';
            }
            if ($result['date_added'] != '0000-00-00 00:00:00') {
                $date = date($this->language->get('date_format_short'), strtotime($result['date_added']));
            } else {
                $date = false;
            }



			$data['informations'][] = array(
                'information_id'  => $result['information_id'],
                'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id']),
                'name'        => $result['title'],
                'date'        => $date,
                'short_description' => $description,
                'thumb' => $image
			);
		}

        $data['informations'] = array_slice($data['informations'], 0, $setting['limit']);

        return $this->load->view('extension/module/information_extend', $data);
	}
}