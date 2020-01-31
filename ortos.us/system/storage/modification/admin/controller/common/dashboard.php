<?php
class ControllerCommonDashboard extends Controller {
	public function index() {

        // start: OCdevWizard SMBPP
        if (version_compare(VERSION, '2.3.0.2', '<')) {
          $this->load->model('extension/ocdevwizard/ocdevwizard_setting');
          $smbpp_form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData('smart_blog_pro_plus_form_data', (int)$this->config->get('config_store_id'));

          if (isset($smbpp_form_data['activate']) && $smbpp_form_data['activate'] && $smbpp_form_data['show_on_dashboard']) {
            $data['smbpp_widget'] = $this->load->controller('extension/ocdevwizard/smart_blog_pro_plus/widget');
          }
        }
        // end: OCdevWizard SMBPP
      
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		// Dashboard Extensions
		$dashboards = array();

		$this->load->model('extension/extension');

		// Get a list of installed modules
		$extensions = $this->model_extension_extension->getInstalled('dashboard');
		
		// Add all the modules which have multiple settings for each module

        // start: OCdevWizard SMBPP
        if (version_compare(VERSION, '2.3.0.2', '>=')) {
          $this->load->model('extension/ocdevwizard/ocdevwizard_setting');
          $smbpp_form_data = (array)$this->model_extension_ocdevwizard_ocdevwizard_setting->getSettingData('smart_blog_pro_plus_form_data', (int)$this->config->get('config_store_id'));

          if (isset($smbpp_form_data['activate']) && $smbpp_form_data['activate'] && $smbpp_form_data['show_on_dashboard']) {
            $dashboards[] = array(
              'code'       => 'smart_blog_pro_plus_widget',
              'width'      => 3,
              'sort_order' => 0,
              'output'     => $this->load->controller('extension/ocdevwizard/smart_blog_pro_plus/widget')
            );
          }
        }
        // end: OCdevWizard SMBPP
      
		foreach ($extensions as $code) {
			if ($this->config->get('dashboard_' . $code . '_status') && $this->user->hasPermission('access', 'extension/dashboard/' . $code)) {
				$output = $this->load->controller('extension/dashboard/' . $code . '/dashboard');
				
				if ($output) {
					$dashboards[] = array(
						'code'       => $code,
						'width'      => $this->config->get('dashboard_' . $code . '_width'),
						'sort_order' => $this->config->get('dashboard_' . $code . '_sort_order'),
						'output'     => $output
					);
				}
			}
		}

		$sort_order = array();

		foreach ($dashboards as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $dashboards);
		
		// Split the array so the columns width is not more than 12 on each row.
		$width = 0;
		$column = array();
		$data['rows'] = array();
		
		foreach ($dashboards as $dashboard) {
			$column[] = $dashboard;
			
			$width = ($width + $dashboard['width']);
			
			if ($width >= 12) {
				$data['rows'][] = $column;
				
				$width = 0;
				$column = array();
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		// Run currency update
		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->refresh();
		}

		$this->response->setOutput($this->load->view('common/dashboard', $data));
	}
}