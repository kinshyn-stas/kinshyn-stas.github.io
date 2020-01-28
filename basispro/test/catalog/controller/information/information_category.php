<?php
class ControllerInformationInformationCategory extends Controller {
	public function index() {
		$this->load->language('information/information_category');

		$this->load->model('catalog/information_category');

        $this->load->model('tool/image');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['information_category_id'])) {
			$information_category_id = (int)$this->request->get['information_category_id'];
		} else {
			$information_category_id = 0;
		}

		$information_category_info = $this->model_catalog_information_category->getInformationCategory($information_category_id);
		$category_informations = $this->model_catalog_information_category->getCategoryInformations($information_category_id);

        $data['informations'] = array();

        foreach($category_informations as $result) {

            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'],  190, 190);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png',  190, 190);
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
                'information_id'    => $result['information_id'],
                'href'              => $this->url->link('information/information', 'information_id=' . $result['information_id']),
                'name'              => $result['title'],
                'date'              => $date,
                'short_description' => $description,
                'thumb'             => $image
            );

        };

		if ($information_category_info) {

			if ($information_category_info['meta_title']) {
				$this->document->setTitle($information_category_info['meta_title']);
			} else {
				$this->document->setTitle($information_category_info['name']);
			}

			$this->document->setDescription($information_category_info['meta_description']);
			$this->document->setKeywords($information_category_info['meta_keyword']);

			$data['breadcrumbs'][] = array(
				'text' => $information_category_info['name'],
				'href' => $this->url->link('information/information_category', 'information_category_id=' .  $information_category_id)
			);

			if ($information_category_info['meta_h1']) {
				$data['heading_title'] = $information_category_info['meta_h1'];
			} else {
				$data['heading_title'] = $information_category_info['name'];
			}

			$data['button_continue'] = $this->language->get('button_continue');

			$data['description'] = html_entity_decode($information_category_info['description'], ENT_QUOTES, 'UTF-8');

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

            $this->response->setOutput($this->load->view('information/information_category', $data));
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/information_category', 'information_category_id=' . $information_category_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

            $this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

}