<?php  
class ControllerExtensionModulePopupProductSV extends Controller {
  private $_templateData = array();
  
	public function index($exec_opt) {
    $settings = $this->config->get('popup_product_sv');
    if ($settings['status']) {
      $product_info = $exec_opt[0];
      $type = $exec_opt[1];
      $select_options = isset($exec_opt[2]) ? $exec_opt[2] : array();
      $product_options = isset($exec_opt[3]) ? $exec_opt[3] : array();
      
      $this->load->language('extension/module/popup_product_sv');
      $this->load->model('tool/image');
      
      $this->_templateData['heading_title'] = $this->language->get('heading_title_' . $type);
      $this->_templateData['button_continue'] = $this->language->get('button_continue_' . $type);
      $this->_templateData['button_action'] = $this->language->get('button_action_' . $type);
      
      $this->_templateData['product_name'] = $product_info['name'];
      if ($product_info['image']) {
        $this->_templateData['product_image'] = $this->model_tool_image->resize($product_info['image'], $settings['image_width'], $settings['image_height']);
      } else {
        if (version_compare(VERSION, '2.0', '<')) {
          $this->_templateData['product_image'] = $this->model_tool_image->resize('no_image.jpg', $settings['image_width'], $settings['image_height']);
        } else {
          $this->_templateData['product_image'] = $this->model_tool_image->resize('no_image.png', $settings['image_width'], $settings['image_height']);
        }
      }
      
      $this->_templateData['product_options'] = false;
      if ($type == 'cart') {
        $options = false;
      	if (version_compare(VERSION, '2.0', '<')) {
      		$opt_val_key = 'option_value';
      	} else {
					$opt_val_key = 'product_option_value';				
				}
      		
        foreach ($select_options as $key => $value) {
          foreach ($product_options as $product_option) {
            if ($product_option['product_option_id'] == $key) {
              foreach ($product_option[$opt_val_key] as $pv) {
                if ($pv['product_option_value_id'] == $value) {
                  $options[] = $product_option['name'] . ': ' . $pv['name'];
                }
              }
            }
          }
        }
        $this->_templateData['product_options'] = $options;
        $this->_templateData['action'] = $this->url->link('checkout/checkout', '', 'SSL');
      } elseif ($type == "wishlist") {
        if (!$this->customer->isLogged()) {			
          $this->_templateData['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));				
        }
        $this->_templateData['action'] = $this->url->link('account/wishlist');
      } else { //compare
        $this->_templateData['action'] = $this->url->link('product/compare');
      }
          
          
      return $this->load->view('extension/module/popup_product_sv', $this->_templateData);
    }
	}
  
  public function addScript() {
    $settings = $this->config->get('popup_product_sv');
    if ($settings['status']) {
      $this->document->addScript('catalog/view/javascript/popup_product_sv.js');
    }
  }
}
?>