<?php
class ControllerSitemapSitemap extends Controller {

    public function index() {

        $this->load->model('sitemap/sitemap');
        $data['products'] = $this->model_sitemap_sitemap->getSitemapProductsData();
        $data['categories'] = $this->model_sitemap_sitemap->getSitemapCategoriesData();
        $data['info'] = $this->model_sitemap_sitemap->getSitemapInformationData();
        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($this->load->view('sitemap/small', $data));
    }
}
