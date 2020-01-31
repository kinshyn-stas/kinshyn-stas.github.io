<?php
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
class ControllerApiOcdevwizardSmartBlogProPlus extends Controller {
  private $_name = 'smart_blog_pro_plus';
  private $_code = 'smbpp';
 
  private function getAccessToken() {
    $access_token = '';

    if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.access')) {
      $access_token = file_get_contents(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.access');
    }

    return $access_token;
  }

  private function cleartAccessToken() {
    if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.access')) {
      unlink(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.access');
    }
  }

  public function editSetting() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'extension/ocdevwizard/ocdevwizard_setting'
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['store_id']) && isset($post_data['data'])) {
      $this->cleartAccessToken();
      
      $this->model_extension_ocdevwizard_ocdevwizard_setting->editSetting((string)$this->_name, (array)$post_data['data'], (int)$post_data['store_id']);
    }
  }

  public function deleteSetting() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'extension/ocdevwizard/ocdevwizard_setting'
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['store_id'])) {
      $this->cleartAccessToken();
      
      $this->model_extension_ocdevwizard_ocdevwizard_setting->deleteSetting((string)$this->_name, (int)$post_data['store_id']);
      
      if (file_exists(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.key')) {
        unlink(DIR_SYSTEM.'library/ocdevwizard/'.$this->_name.'/'.$this->_code.'.key');
      }
    }
  }

  public function editSettingValue() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'extension/ocdevwizard/ocdevwizard_setting'
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['store_id']) && isset($post_data['license_key'])) {
      $this->cleartAccessToken();
      
      $this->model_extension_ocdevwizard_ocdevwizard_setting->editSettingValue((string)$this->_name, (string)$this->_name.'_license', (string)$post_data['license_key'], (int)$post_data['store_id']);
    }
  }

  public function add() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }
  
    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data']) && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'add'.(string)$post_data['data_method']}((array)$post_data['data']);
    }
  }

  public function edit() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data']) && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'edit'.(string)$post_data['data_method']}((array)$post_data['data']);
    }
  }

  public function copy() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data']) && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'copy'.(string)$post_data['data_method']}((array)$post_data['data']);
    }
  }

  public function delete() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data']) && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'delete'.(string)$post_data['data_method']}((array)$post_data['data']);
    }
  }

  public function delete_all() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'delete'.(string)$post_data['data_method'].'s'}();
    }
  }

  public function prepare() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );
    
    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'prepare'.(string)$post_data['data_method']}();
    }
  }

  public function import() {
    $post_data = unserialize(file_get_contents('php://input'));

    $models = array(
      'api/ocdevwizard/'.$this->_name
    );

    foreach ($models as $model) {
      $this->load->model($model);
    }

    if (isset($post_data['access_token']) && !empty($this->getAccessToken()) && $this->getAccessToken() == $post_data['access_token'] && isset($post_data['data']) && isset($post_data['data_method'])) {
      $this->cleartAccessToken();
      
      $this->{'model_api_ocdevwizard_'.$this->_name}->{'import'.(string)$post_data['data_method']}((array)$post_data['data']);
    }
  }
}
?>