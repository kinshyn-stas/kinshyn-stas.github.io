<?php
class ControllerExtensionModuleSmreviewdisp extends Controller {
	public function index($setting) {

		$this->load->language('extension/module/smreviewdisp');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_author'] = $this->language->get('text_author');
		$data['text_text'] = $this->language->get('text_text');
		$data['text_date'] = $this->language->get('text_date');

        $this->load->model('catalog/smreview');

        $data['smreviewdisp_status'] = $setting['status'];
        $data['smreviewdisp_title'] = $setting['name'];
        $data['smreviewdisp_display'] = $setting['smreviewdisp_display'];
        $data['smreviewdisp_quantity'] = $setting['smreviewdisp_quantity'];
        $data['smreviewdisp_date'] = $setting['smreviewdisp_date'];
        $data['smreviewdisp_min'] = $setting['smreviewdisp_min'];
        $data['smreviewdisp_max'] = $setting['smreviewdisp_max'];
        $data['smreviewdisp_view'] = $setting['smreviewdisp_view'];

        $data['smreviews'] = $this->model_catalog_smreview->getReviewsForSmReviewDisplay($data);

        //Якщо вибраний вигляд відгуків - Карусель підлючаємо файли для каруселі
        if($data['smreviewdisp_view'] == 'carousel'){
            $this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
            $this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
        }

//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';


		return $this->load->view('extension/module/smreviewdisp', $data);
	}
}