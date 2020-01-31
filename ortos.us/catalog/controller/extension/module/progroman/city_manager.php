<?php
use \progroman\CityManager\CityManager;
use progroman\CityManager\Driver\Sypex;

/**
 * Class ControllerExtensionModuleProgromanCityManager
 * @property CityManager $progroman_city_manager
 * @property ModelProgromanFias $model_progroman_fias
 * @property ModelProgromanCityManager $model_progroman_city_manager
 */
class ControllerExtensionModuleProgromanCityManager extends Controller {

    public function index() {
        $this->language->load('extension/module/progroman/city_manager');
        $city = $this->getCityName();
        $data['city'] = $city ? $city : $this->language->get('text_unknown');
        $data['text_zone'] = $this->language->get('text_zone');

        return $this->loadView('content', $data);
    }

    public function init() {
        $this->language->load('extension/module/progroman/city_manager');
        $city = $this->getCityName();
        $data['city'] = $city ? $city : $this->language->get('text_unknown');
        $data['text_zone'] = $this->language->get('text_zone');

        $json = [];
        $json['content'] = $this->loadView('content', $data);
        $json['messages'] = $this->progroman_city_manager->getMessages();

        $key = $this->progroman_city_manager->getSessionKey();
        $cookieKey = $this->progroman_city_manager->getCookieKey('confirm');

        if (!empty($this->session->data[$key]['show_confirm']) || !empty($this->request->cookie[$cookieKey])) {
            $confirm_region = false;
        } else {
            $confirm_region = true;
            $settings = $this->config->get('progroman_cm_setting');
            $time = !empty($settings['popup_cookie_time']) ? time() + $settings['popup_cookie_time'] : null;
            $this->session->data[$key]['show_confirm'] = 1;
            setcookie($cookieKey, 1, $time, '/', $this->progroman_city_manager->getCookieDomain());
        }

        if ($confirm_region && $city) {
            $data = [
                'city' => $city,
                'text_your_city' => $this->language->get('text_your_city'),
                'text_guessed' => $this->language->get('text_guessed'),
                'text_yes' => $this->language->get('text_yes'),
                'text_no' => $this->language->get('text_no'),
            ];
            $json['confirm'] = $this->loadView('confirm', $data);
            $json['confirm_redirect'] = $this->progroman_city_manager->getRedirectUrlForManual($this->request->get['url']);
        }

        $this->response->setOutput(json_encode($json));
    }

    public function cities() {
        $this->language->load('extension/module/progroman/city_manager');
        $data['text_search'] = $this->language->get('text_search');
        $data['text_search_placeholder'] = $this->language->get('text_search_placeholder');
        $data['text_choose_region'] = $this->language->get('text_choose_region');

        $this->load->model('progroman/city_manager');
        $cities = $this->model_progroman_city_manager->getCities();
        $count_columns = 3;
        $data['columns'] = $cities ? array_chunk($cities, ceil(count($cities) / $count_columns)) : [];

        $this->response->setOutput($this->loadView('cities', $data));
    }

    public function search() {
        $json = [];
        if (!empty($this->request->get['term'])) {
            $this->load->model('progroman/fias');
            $search = preg_replace('#^(город|село|поселок)\s#', '', $this->request->get['term']);
            $json = $this->model_progroman_fias->findFiasByName($search);
        }

        $this->response->setOutput(json_encode($json));
    }

    public function save() {
        $fias_id = isset($this->request->get['fias_id']) ? $this->request->get['fias_id'] : 0;
        $success = $fias_id && $this->progroman_city_manager->setFias($fias_id) ? 1 : 0;
        $this->response->setOutput(json_encode(['success' => $success]));
    }

    private function getCityName() {
        if ($popup_city_name = $this->progroman_city_manager->getPopupCityName()) {
            return $popup_city_name;
        }

        if ($short_city_name = $this->progroman_city_manager->getShortCityName()) {
            return $short_city_name;
        }

        if ($city_name = $this->progroman_city_manager->getCityName()) {
            return $city_name;
        }

        if ($zone_name = $this->progroman_city_manager->getZoneName()) {
            return $zone_name;
        }

        if ($country_name = $this->progroman_city_manager->getCountryName()) {
            return $country_name;
        }

        return false;
    }

    private function loadView($name, $data = []) {
        return $this->load->view('extension/module/progroman/city_manager/' . $name, $data);
    }

    public function startup() {
        if ($this->config->get('progroman_cm_status')) {
            $this->enableGeoIp();
            $city_manager = CityManager::instance($this->registry);
            $city_manager->saveInSession();
            $this->registry->set('progroman_city_manager', $city_manager);
        }
    }

    private function enableGeoIp() {
        $settings = $this->config->get('progroman_cm_setting');
        if (!empty($settings['use_geoip'])) {
            // Для теста: IP Тамбов 193.34.14.221, IP Воронеж 217.118.95.92
            $sypex = new Sypex($this->registry);
            $sypex->setSxgeoPath(CityManager::getSxgeoPath());
            CityManager::addDriver($sypex);
        }
    }
}
