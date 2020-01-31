<?php echo $header; ?>
<?php echo $column_left; ?>

<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right" id="top-nav-line">
        <div class="btn-group">
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $uninstall; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_uninstall; ?></a></li>
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $uninstall_and_remove; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_uninstall_and_remove; ?></a></li>
          </ul>
        </div>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb-module">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <?php if ($breadcrumb['href']) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } elseif (empty($breadcrumb['href']) && $breadcrumb['dropdown']) { ?>
            <li>
              <div class="btn-group dropdown-on-hover">
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $breadcrumb['text']; ?> <span class="caret"></span></button>
                <?php if ($breadcrumb['dropdown']) { ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($breadcrumb['dropdown'] as $dropdown) { ?>
                      <li><a href="<?php echo $dropdown['href']; ?>"><?php if ($dropdown['active']) { ?><i class="fa fa-check-square-o"></i><?php } else { ?><i class="fa fa-square-o"></i><?php } ?> <?php echo $dropdown['text']; ?></a></li>
                    <?php } ?>
                  </ul>
                <?php } ?>
              </div>
            </li>
          <?php } else { ?>
            <li><a><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid" id="top-alerts">
  	<?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-3 col-md-3 col-lg-2">
        <!-- Nav tabs -->
        <div class="list-group list-group-root well" id="setting-tabs">
          <a class="list-group-item list-group-item-info"><i class="fa fa-life-ring" aria-hidden="true"></i><?php echo $tab_support_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#support-extension-block" role="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_support_extension_setting; ?></a>
          </div>
        </div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-10">
        <div class="panel panel-default">
          <div class="panel-body">
            <form method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
              <div class="tab-content">
                <!-- TAB Support Extension block -->
                <div class="tab-pane fade active in" role="tabpanel" id="support-extension-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-license_key"><?php echo $text_license_key; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="text" name="<?php echo $_name; ?>_license" value="<?php echo $license_key; ?>" class="form-control" id="input-license_key" placeholder="XXXXXXXX-XXXXXXXX-XXXXXXXX-XXXXXXXX" />
                        <div class="input-group-btn"><button type="submit" formaction="<?php echo $action; ?>" form="form" class="btn btn-primary"><?php echo $button_apply_license_code; ?></button></div>
                      </div>
                      <?php if ($error_license_key) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $error_license_key; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-license_key"><?php echo $text_request_license_code; ?>:</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="input-group warning-style-license">
                            <span class="input-group-addon alert-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                            <div class="alert alert-warning">
                              <?php echo $text_request_license_code_left_side; ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="input-group default-style-license">
                            <span class="input-group-addon alert-default"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                            <div class="alert alert-default">
                              <?php echo $text_request_license_code_right_side_1; ?>
                              <p>
                                <div class="two-sites-block">
                                  <div>
                                    ❏ <a href="https://www.opencart.com/index.php?route=marketplace/extension&filter_member=OCdevWizard" target="_blank">Opencart.com</a><br/>
                                    ❏ <a href="https://opencartforum.com/profile/794219-ocdevwizard/content/?type=downloads_file" target="_blank">Opencartforum.com</a><br/>
                                    ❏ <a href="https://liveopencart.ru/ocdevwizard" target="_blank">Liveopencart.ru</a><br/>
                                  </div>
                                  <div>
                                    ❏ <a href="https://shop.opencart-russia.ru/ocdevwizard" target="_blank">Opencart-russia.ru</a><br/>
                                    ❏ <a href="https://prodelo.biz/ocdevwizard" target="_blank">Prodelo.biz</a>
                                  </div>
                                </div>
                              </p>
                              <hr>
                              <?php echo $text_request_license_code_right_side_2; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- start: code for module usability -->
<script>
$(function(){
  $('#setting-tabs a[href=\'#support-extension-block\']').trigger('click').addClass('list-group-item-warning').prepend('<i class="fa fa-chevron-right"></i>');
});

$(document).delegate('#open-license-request', 'click', function(e) {
  e.preventDefault();

  $('#license-request').remove();

  var element = this;

  html  = '<div id="license-request" class="modal fade bs-example-modal-md">';
  html += '  <div class="modal-dialog modal-md">';
  html += '    <div class="modal-content">';
  html += '      <div class="modal-header">';
  html += '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>';
  html += '        <h4 class="modal-title" id="myModalLabel"><?php echo $text_request_license_code; ?></h4>';
  html += '      </div>';
  html += '      <div class="modal-body">';
  html += '        <div class="form-group">';
  html += '          <div>';
  html += '            <input type="text" name="email" value="" class="form-control" required autocomplete="off"/>';
  html += '            <label class="form-control-placeholder"><?php echo $text_request_license_code_email_field; ?> <span class="required-indicator">*</span></label>';
  html += '            <div class="alert alert-info" style="display: none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $text_request_license_code_email_field_faq; ?></div>';
  html += '            <div class="modal-error-block" id="modal-license-request-email"></div>';
  html += '          </div>';
  html += '          <div>';
  html += '            <input type="text" name="order_id" value="" class="form-control" required autocomplete="off"/>';
  html += '            <label class="form-control-placeholder"><?php echo $text_request_license_code_order_id_field; ?> <span class="required-indicator">*</span></label>';
  html += '            <div class="alert alert-info" style="display: none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $text_request_license_code_order_id_field_faq; ?></div>';
  html += '            <div class="modal-error-block" id="modal-license-request-order-id"></div>';
  html += '          </div>';
  html += '          <div>';
  html += '            <input type="text" name="marketplace" value="" class="form-control" required autocomplete="off"/>';
  html += '            <label class="form-control-placeholder"><?php echo $text_request_license_code_marketplace_field; ?> <span class="required-indicator">*</span></label>';
  html += '            <div class="alert alert-info" style="display: none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $text_request_license_code_marketplace_field_faq; ?></div>';
  html += '            <div class="modal-error-block" id="modal-license-request-site"></div>';
  html += '          </div>';
  html += '          <div>';
  html += '            <input type="text" name="domain" value="" class="form-control" required autocomplete="off"/>';
  html += '            <label class="form-control-placeholder"><?php echo $text_request_license_code_domain_field; ?> <span class="required-indicator">*</span></label>';
  html += '            <div class="alert alert-info" style="display: none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $text_request_license_code_domain_field_faq; ?></div>';
  html += '            <div class="modal-error-block" id="modal-license-request-domain"></div>';
  html += '          </div>';
  html += '          <div>';
  html += '            <label><input type="checkbox" name="test_domain_status" onchange="$(this).parent().parent().next().toggle();"/> <?php echo $text_request_license_code_test_domain_field_faq_2; ?></label>';
  html += '          </div>';
  html += '          <div style="display: none;">';
  html += '            <input type="text" name="test_domain" value="" class="form-control" required autocomplete="off"/>';
  html += '            <label class="form-control-placeholder"><?php echo $text_request_license_code_test_domain_field; ?></label>';
  html += '            <div class="alert alert-info" style="display: none;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $text_request_license_code_test_domain_field_faq_1; ?></div>';
  html += '          </div>';
  html += '        </div>';
  html += '      </div>';
  html += '      <div class="modal-footer">';
  html += '        <button type="button" onclick="send_request();" class="btn btn-info pull-left"><?php echo $text_request_license_code_buttin; ?></button>';
  html += '      </div>';
  html += '    </div';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  $('#license-request').modal('show');
});

function send_request() {
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/send_license_code_request&<?php echo $token; ?>',
    data: $('#license-request input[type=\'text\'], #license-request input[type=\'checkbox\']:checked'),
    dataType: 'json',
    success: function(json) {
      $('#license-request .text-danger').remove();
      
      if (json['error']) {
        for (i in json['error']) {
          $('#modal-license-request-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
        }
      }
      
      if (json['success']) {
        $('#license-request .modal-body').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        
        setTimeout(function() {
          $('#license-request').modal('hide');
        }, 2000);
        
        setTimeout(function() {
        $('#license-request').remove();
        }, 2500);
      }
    }
  });
}
</script>
<!-- end: code for module usability -->
<?php echo $footer; ?>
