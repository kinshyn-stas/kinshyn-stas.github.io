<?php
use progroman\CityManager\CityManager;

/**
 * Class ControllerExtensionModuleProgromanCityManager
 * @property \ModelSettingSetting model_setting_setting
 * @property \ModelProgromanCityManager model_progroman_city_manager
 */
class ControllerExtensionModuleProgromanCityManager extends Controller {
    private $error = [];

    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language('extension/module/progroman_city_manager');
        $this->load->model('progroman/city_manager');
    }

    public function index() {
        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title') . ' ' . CityManager::VERSION;

        $data['text_none'] = $this->language->get('text_none');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_popup_cities'] = $this->language->get('text_popup_cities');
        $data['text_regions_info'] = $this->language->get('text_regions_info');
        $data['text_customer_groups_info'] = $this->language->get('text_customer_groups_info');
        $data['text_sxgeo_upload'] = $this->language->get('text_sxgeo_upload');
        $data['text_sxgeo_manual_upload'] = sprintf($this->language->get('text_sxgeo_manual_upload'), dirname(CityManager::getSxgeoPath()) . '/');
        $data['text_sxgeo_upload_success'] = $this->language->get('text_sxgeo_upload_success');
        $data['text_license'] = $this->language->get('text_license');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_add'] = $this->language->get('button_add');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_default_city'] = $this->language->get('entry_default_city');
        $data['entry_key'] = $this->language->get('entry_key');
        $data['entry_zone'] = $this->language->get('entry_zone');
        $data['entry_city'] = $this->language->get('entry_city');
        $data['entry_sort'] = $this->language->get('entry_sort');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_subdomain'] = $this->language->get('entry_subdomain');
        $data['entry_popup_cookie_time'] = $this->language->get('entry_popup_cookie_time');
        $data['entry_popup_view'] = $this->language->get('entry_popup_view');
        $data['entry_currency'] = $this->language->get('entry_currency');
        $data['entry_country'] = $this->language->get('entry_country');
        $data['entry_disable_autoredirect'] = $this->language->get('entry_disable_autoredirect');
        $data['entry_domain'] = $this->language->get('entry_domain');
        $data['entry_uid'] = $this->language->get('entry_uid');
        $data['entry_license'] = $this->language->get('entry_license');
        $data['entry_use_geoip'] = $this->language->get('entry_use_geoip');
        $data['entry_sub_enabled'] = $this->language->get('entry_sub_enabled');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_popup'] = $this->language->get('tab_popup');
        $data['tab_messages'] = $this->language->get('tab_messages');
        $data['tab_redirects'] = $this->language->get('tab_redirects');
        $data['tab_currencies'] = $this->language->get('tab_currencies');
        $data['tab_regions'] = $this->language->get('tab_regions');
        $data['tab_groups'] = $this->language->get('tab_groups');

        $data['error_license'] = $this->language->get('error_license');
        $data['error_sxgeo'] = $this->language->get('error_sxgeo');
        $data['error_unknown'] = $this->language->get('error_unknown');
        $data['error_unique_regions'] = $this->language->get('error_unique_regions');

        $this->load->model('localisation/currency');
        $data['currencies'] = $this->model_localisation_currency->getCurrencies();

        $this->load->model('localisation/country');
        $data['countries'] = $this->model_localisation_country->getCountries();

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/progroman_city_manager', 'token=' . $this->session->data['token'], 'SSL')
        ];

        $data['action_general'] = $this->url->link('extension/module/progroman_city_manager/savegeneral', 'token=' . $this->session->data['token'], 'SSL');
        $data['action_popups'] = $this->url->link('extension/module/progroman_city_manager/savepopups', 'token=' . $this->session->data['token'], 'SSL');
        $data['action_messages'] = $this->url->link('extension/module/progroman_city_manager/savemessages', 'token=' . $this->session->data['token'], 'SSL');
        $data['action_redirects'] = $this->url->link('extension/module/progroman_city_manager/saveredirects', 'token=' . $this->session->data['token'], 'SSL');
        $data['action_currencies'] = $this->url->link('extension/module/progroman_city_manager/savecurrencies', 'token=' . $this->session->data['token'], 'SSL');
        $data['action_regions'] = $this->url->link('extension/module/progroman_city_manager/saveregions', 'token=' . $this->session->data['token'], 'SSL');
        $data['url_module'] = 'index.php?route=extension/module/progroman_city_manager';

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
        $data['token'] = $this->session->data['token'];

        $data['settings'] = $this->config->get('progroman_cm_setting');
        $data['status'] = $this->config->get('progroman_cm_status');

        if (isset($data['settings']['default_city'])) {
            $data['settings']['default_city_name'] = $this->model_progroman_city_manager->getFiasName($data['settings']['default_city']);
        }

        $data['messages'] = $this->model_progroman_city_manager->getMessages();
        foreach ($data['messages'] as & $message) {
            $message['fias_name'] = $this->model_progroman_city_manager->getFiasName($message['fias_id']);
        }

        $data['cm_currencies'] = $this->model_progroman_city_manager->getCurrencies();

        $data['redirects'] = $this->model_progroman_city_manager->getRedirects();
        foreach ($data['redirects'] as & $redirect) {
            $redirect['fias_name'] = $this->model_progroman_city_manager->getFiasName($redirect['fias_id']);
        }

        $data['cities'] = $this->model_progroman_city_manager->getCities();
        $data['country_fias'] = $this->model_progroman_city_manager->getFiasCountries();
        $data['zone_fias'] = $this->model_progroman_city_manager->getFiasRegions();

        $data['country_zones'] = [];
        foreach ($data['zone_fias'] as $row) {
            $country_id = (int)$row['country_id'];
            $data['country_zones'][$country_id] = $this->model_progroman_city_manager->getZonesForCountry($country_id);
        }

        $data['valid_license'] = !empty($data['settings']['geoip_license']) && CityManager::validLicense($data['settings']['geoip_license']);
        $data['exists_sxgeo'] = file_exists(CityManager::getSxgeoPath());

        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['module_dir'] = DIR_TEMPLATE . 'extension/module/progroman/';

        $data['sxgeo_steps'] = [
            [
                'text' => $this->language->get('text_sxgeo_step_upload'),
                'url' => str_replace('&amp;', '&', $this->url->link('extension/module/progroman_city_manager/uploadsxgeo', 'token=' . $this->session->data['token'], 'SSL'))
            ],
            [
                'text' => $this->language->get('text_sxgeo_step_unzip'),
                'url' => str_replace('&amp;', '&', $this->url->link('extension/module/progroman_city_manager/unzipsxgeo', 'token=' . $this->session->data['token'], 'SSL'))
            ]
        ];

        $this->response->setOutput($this->load->view('extension/module/progroman/city_manager/index.tpl', $data));
	}

    public function search() {
        $json = [];
        if (isset($this->request->get['term'])) {
            $json = $this->model_progroman_city_manager->findFiasByName($this->request->get['term'], !empty($this->request->get['short']));
        }

        $this->sendJson($json);
    }

    public function saveGeneral() {
        $json = [];
        if ($this->validate()) {
            if (!empty($this->request->post['progroman_cm_setting']['popup_cookie_time'])) {
                $this->request->post['progroman_cm_setting']['popup_cookie_time'] = (int)$this->request->post['progroman_cm_setting']['popup_cookie_time'];
            }

            $this->request->post['progroman_cm_setting']['geoip_license'] = preg_replace('#\s#u', '', $this->request->post['progroman_cm_setting']['geoip_license']);
            $this->request->post['progroman_cm_setting']['main_domain'] = preg_replace('#^http(s)?://#', '', rtrim($this->request->post['progroman_cm_setting']['main_domain'], '/'));

            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('progroman_cm', $this->request->post);
        } else {
            $json['warning'] = $this->error['warning'];
        }

        $json['license'] = !empty($this->request->post['progroman_cm_setting']['geoip_license'])
            && CityManager::validLicense($this->request->post['progroman_cm_setting']['geoip_license']);

        $this->sendJson($json);
    }

    public function savePopups() {
        $json = [];
        if ($this->validate()) {
            if (isset($this->request->post['popup_cities'])) {
                foreach ($this->request->post['popup_cities'] as $key => $value) {
                    if (!(int)$value['fias_id']) {
                        $json['errors']['cities'][$key] = $this->language->get('error_fias');
                    }
                }

                if (empty($json['errors'])) {
                    $this->model_progroman_city_manager->clearCities();

                    if (!empty($this->request->post['popup_cities'])) {
                        $this->model_progroman_city_manager->editCities($this->request->post['popup_cities']);
                    }
                }
            } else {
                $this->model_progroman_city_manager->clearCities();
            }
        }

        $this->sendJson($json);
    }

    public function saveMessages() {
        $json = [];
        if ($this->validate()) {
            if (isset($this->request->post['messages'])) {
                foreach ($this->request->post['messages'] as $key => $value) {
                    if (!$value['key'] || !preg_match('#^[a-zA-Z0-9_-]*$#', $value['key'])) {
                        $json['errors']['key'][$key] = $this->language->get('error_key');
                    }

                    if (!(int)$value['fias_id']) {
                        $json['errors']['fias'][$key] = $this->language->get('error_fias');
                    }
                }

                if (empty($json['errors'])) {
                    $this->model_progroman_city_manager->clearMessages();

                    if (!empty($this->request->post['messages'])) {
                        $this->model_progroman_city_manager->editMessages($this->request->post['messages']);
                    }
                }
            } else {
                $this->model_progroman_city_manager->clearMessages();
            }
        }

        $this->sendJson($json);
    }

    public function saveRedirects() {
        $json = [];
        if ($this->validate()) {
            if (isset($this->request->post['redirects'])) {
                $urlRegex = '#^http(s)?://([a-zа-яё0-9]+([\-a-zа-яё0-9]*[a-zа-яё0-9]+)?\.){0,}([a-zа-яё0-9]+([\-a-zа-яё0-9]*[a-zа-яё0-9]+)?){1,63}(\.[a-zа-яё0-9]{2,7})+/(.*/)*$#u';
                foreach ($this->request->post['redirects'] as $key => & $value) {
                    if (!$value['url']) {
                        $json['errors']['subdomain'][$key] = $this->language->get('error_subdomain');
                    } else {
                        $value['url'] = $this->prepareDomainForRedirect($value['url']);
                        if (!preg_match($urlRegex, $value['url'])) {
                            $json['errors']['subdomain'][$key] = $this->language->get('error_subdomain');
                        }
                    }

                    if (!(int)$value['fias_id']) {
                        $json['errors']['fias'][$key] = $this->language->get('error_fias');
                    }
                }

                if (empty($json['errors'])) {
                    $this->model_progroman_city_manager->clearRedirects();

                    if (!empty($this->request->post['redirects'])) {
                        $this->model_progroman_city_manager->editRedirects($this->request->post['redirects']);
                    }
                }
            } else {
                $this->model_progroman_city_manager->clearRedirects();
            }
        }

        $this->sendJson($json);
    }

    public function saveCurrencies() {
        $json = [];
        if ($this->validate()) {
            if (isset($this->request->post['currencies'])) {
                foreach ($this->request->post['currencies'] as $key => $value) {
                    if (!(int)$value['country_id']) {
                        $json['errors']['country'][$key] = $this->language->get('error_currency_country');
                    }

                    if (!$value['code']) {
                        $json['errors']['code'][$key] = $this->language->get('error_currency_code');
                    }
                }

                if (empty($json['errors'])) {
                    $this->model_progroman_city_manager->clearCurrencies();

                    if (!empty($this->request->post['currencies'])) {
                        $this->model_progroman_city_manager->editCurrencies($this->request->post['currencies']);
                    }
                }
            } else {
                $this->model_progroman_city_manager->clearCurrencies();
            }
        }

        $this->sendJson($json);
    }

    public function saveRegions() {
        $json = [];
        if ($this->validate()) {
            if (!empty($this->request->post['country_fias'])) {
                $this->model_progroman_city_manager->clearCountryToFias();
                $this->model_progroman_city_manager->editCountryToFias($this->request->post['country_fias']);
            }

            if (!empty($this->request->post['zone_fias'])) {
                $this->model_progroman_city_manager->clearZoneToFias();
                $this->model_progroman_city_manager->editZoneToFias($this->request->post['zone_fias']);
            }
        }

        $json['success'] = $this->language->get('text_success');
        $this->sendJson($json);
    }

    private function prepareDomainForRedirect($domain) {
        $domain = strtolower($domain);

        if (strpos($domain, 'http') !== 0) {
            $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
                || stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true || $_SERVER['SERVER_PORT'] == 443
                || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on');

            $domain = 'http' . ($ssl ? 's' : '') . '://' . $domain;
        }

        return rtrim($domain, '/') . '/';
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/progroman_city_manager')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function country() {
        $this->load->model('localisation/zone');
        $json['zones'] = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);

        $this->sendJson($json);
    }

    public function uploadSxgeo() {
        $json = ['success' => 0];

        if (!$this->validate()) {
            $json['error'] = $this->error['warning'];
            return $this->sendJson($json);
        }

        if (empty($this->request->get['license'])) {
            $json['error'] = $this->language->get('text_license');
            return $this->sendJson($json);
        }

        $sxgeo_path = CityManager::getSxgeoPath();
        $sxgeo_dir = dirname($sxgeo_path);
        if (!is_dir($sxgeo_dir)) {
            mkdir($sxgeo_dir, 0777);
        }

        set_time_limit(0);
        $zip_file = fopen($sxgeo_dir . '/sxgeocity.zip', 'w+');
        if (!$zip_file) {
            $json['error'] = $this->language->get('error_create_file');
            return $this->sendJson($json);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://opencart.progroman.ru/download/sypex/?module=geoip&v=' . CityManager::VERSION
            . '&host=' . $this->request->server['HTTP_HOST'] . '&license=' . preg_replace('#\s#u', '', $this->request->get['license']));
        curl_setopt($curl, CURLOPT_FILE, $zip_file);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_exec($curl);

        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
            fclose($zip_file);
            unlink($sxgeo_dir . '/sxgeocity.zip');
            $json['error'] = $this->language->get('error_upload');
            return $this->sendJson($json);
        }

        curl_close($curl);
        fclose($zip_file);
        $json['success'] = 1;

        return $this->sendJson($json);
    }

    public function unzipSxgeo() {
        $json['success'] = 0;

        if (!$this->validate()) {
            $json['error'] = $this->error['warning'];
            return $this->sendJson($json);
        }

        $sxgeo_path = CityManager::getSxgeoPath();
        $sxgeo_dir = dirname($sxgeo_path);
        $zip_file = $sxgeo_dir . '/sxgeocity.zip';

        if (!file_exists($zip_file)) {
            $json['error'] = $this->language->get('error_unzip');
            return $this->sendJson($json);
        }

        $zip = new ZipArchive();
        if (!$zip->open($zip_file)) {
            $json['error'] = $this->language->get('error_unzip');
            return $this->sendJson($json);
        }

        $zip->extractTo($sxgeo_dir);
        $zip->close();
        unlink($zip_file);

        if (!file_exists($sxgeo_path)) {
            $json['error'] = $this->language->get('error_unzip');
            return $this->sendJson($json);
        }

        $json['success'] = 1;

        return $this->sendJson($json);
    }

    private function sendJson($json) {
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
        return;
    }}