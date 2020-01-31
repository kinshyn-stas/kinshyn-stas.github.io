<?php echo $header; ?>
<?php echo $column_left; ?>

<!-- 
@category  : OpenCart
@module    : Smart Checkout
@author    : OCdevWizard <ocdevwizard@gmail.com> 
@copyright : Copyright (c) 2014, OCdevWizard
@license   : http://license.ocdevwizard.com/Licensing_Policy.pdf
 -->

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" formaction="<?php echo $action; ?>" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <button type="submit" formaction="<?php echo $action_plus; ?>" form="form" data-toggle="tooltip" title="<?php echo $button_save_and_stay; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
        <a onclick="confirm('Are you sure?') ? href='<?php echo $uninstall; ?>' : false;" data-toggle="tooltip" title="<?php echo $button_uninstall; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_name; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" id="setting-tabs">
            <li class="active dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <?php echo $tab_control_panel; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
                <li><a href="#layout-block" data-toggle="tab"><i class="fa fa-eye"></i> <?php echo $tab_layout_setting; ?></a></li>
                <li><a href="#fields-block" data-toggle="tab"><i class="fa fa-bars"></i> <?php echo $tab_fields_setting; ?></a></li>
                <li><a href="#popup-block" data-toggle="tab"><i class="fa fa-desktop"></i> <?php echo $tab_popup_setting; ?></a></li>
                <li><a href="#import-export-block" data-toggle="tab"><i class="fa fa-file-archive-o" aria-hidden="true"></i> <?php echo $tab_import_export_setting; ?></a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i> <?php echo $tab_language_setting; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#language-block" data-toggle="tab"><i class="fa fa-flag-o"></i> <?php echo $tab_basic_language_setting; ?></a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-thumbs-o-up"></i> <?php echo $tab_marketing_tools_setting; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#marketing-tools-block" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo $tab_marketing_tools_main_setting; ?></a></li>
                <li><a href="#marketing-analytics-block" data-toggle="tab"><i class="fa fa-line-chart"></i> <?php echo $tab_marketing_analytics_setting; ?></a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-life-ring" aria-hidden="true"></i> <?php echo $tab_support_setting; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#support-general-block" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $tab_support_general_setting; ?></a></li>
                <li><a href="#support-extension-block" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $tab_support_extension_setting; ?></a></li>
                <li><a href="#support-terms-block" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $tab_support_terms_setting; ?></a></li>
                <li><a href="#support-service-block" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $tab_support_service_setting; ?></a></li>
                <li><a href="#support-faq-block" data-toggle="tab"><i class="fa fa-question-circle" aria-hidden="true"></i> <?php echo $tab_support_faq_setting; ?></a></li>
                <li><a href="#promo-block" data-toggle="tab"><i class="fa fa-briefcase"></i> <?php echo $tab_promo_setting; ?></a></li>
              </ul>
            </li>
          </ul>
          <div class="tab-content">
            <!-- TAB General setting -->
            <div class="tab-pane active" id="general-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_activate_module; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $form_data['activate'] == 1 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[activate]" 
                        value="1" 
                        autocomplete="off" 
                        <?php echo $form_data['activate'] == 1 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $form_data['activate'] == 0 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[activate]" 
                        value="0" 
                        autocomplete="off" 
                        <?php echo $form_data['activate'] == 0 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-add_function_selector"><?php echo $text_add_function_selector; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                    <input value="<?php echo $form_data['add_function_selector']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[add_function_selector]" class="form-control" id="input-add_function_selector" placeholder="<?php echo $text_add_function_selector_ph; ?>" />
                  </div>
                  <?php if ($error_add_function_selector) { ?>
                    <div class="alert alert-danger text-danger"><?php echo $error_add_function_selector; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_add_function_selector_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-add_id_selector"><?php echo $text_add_id_selector; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                    <input value="<?php echo $form_data['add_id_selector']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[add_id_selector]" class="form-control" id="input-add_id_selector" placeholder="<?php echo $text_add_id_selector_ph; ?>" />
                  </div>
                  <?php if ($error_add_id_selector) { ?>
                    <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $error_add_id_selector; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_add_id_selector_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-main_product_id_selector"><?php echo $text_main_product_id_selector; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-crosshairs"></i></span>
                    <input value="<?php echo stripslashes($form_data['main_product_id_selector']); ?>" type="text" name="<?php echo $_module_name; ?>_form_data[main_product_id_selector]" class="form-control" id="input-main_product_id_selector" />
                  </div>
                  <?php if ($error_main_product_id_selector) { ?>
                    <div class="alert alert-danger text-danger"><?php echo $error_main_product_id_selector; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_main_product_id_selector_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_stock_check; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $form_data['stock_validate'] == 1 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[stock_validate]" 
                        value="1" 
                        autocomplete="off" 
                        <?php echo $form_data['stock_validate'] == 1 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $form_data['stock_validate'] == 0 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[stock_validate]" 
                        value="0" 
                        autocomplete="off" 
                        <?php echo $form_data['stock_validate'] == 0 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_stock_check_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-alternative_email"><?php echo $text_alternative_email; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input value="<?php echo $form_data['alternative_email']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[alternative_email]" class="form-control" id="input-alternative_email" />
                  </div>
                  <?php if ($error_alternative_email) { ?>
                    <div class="alert alert-danger text-danger"><?php echo $error_alternative_email; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_alternative_email_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_admin_order_email_notify; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $form_data['admin_order_email_notify'] == 1 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[admin_order_email_notify]" 
                        value="1" 
                        autocomplete="off" 
                        <?php echo $form_data['admin_order_email_notify'] == 1 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $form_data['admin_order_email_notify'] == 0 ? 'active' : ''; ?>">
                      <input type="radio" 
                        name="<?php echo $_module_name; ?>_form_data[admin_order_email_notify]" 
                        value="0" 
                        autocomplete="off" 
                        <?php echo $form_data['admin_order_email_notify'] == 0 ? 'checked="checked"' : ''; ?> 
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-admin_email_for_notify"><?php echo $text_admin_email_for_notify; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input value="<?php echo $form_data['admin_email_for_notify']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[admin_email_for_notify]" class="form-control" id="input-admin_email_for_notify" />
                  </div>
                  <?php if ($error_admin_email_for_notify) { ?>
                    <div class="alert alert-danger text-danger"><?php echo $error_admin_email_for_notify; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_admin_email_for_notify_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-prefix_order"><?php echo $text_order_prefix; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input value="<?php echo $form_data['prefix_order']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[prefix_order]" class="form-control" id="input-prefix_order" />
                  </div>
                  <?php if ($error_prefix_order) { ?>
                    <div class="alert alert-danger text-danger"><?php echo $error_prefix_order; ?></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_order_prefix_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_order_status; ?></label>
                <div class="col-sm-10">
                  <select name="<?php echo $_module_name; ?>_form_data[order_status_id]" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                      <?php if (isset($form_data['order_status_id']) && $order_status['status_id'] == $form_data['order_status_id']) { ?>
                        <option value="<?php echo $order_status['status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $order_status['status_id']; ?>"><?php echo $order_status['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_show_in_stores; ?></label>
                <div class="col-sm-10">
                  <?php $row_height = 55; $row = 0; foreach ($all_stores as $store) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php $row = 0; foreach ($all_stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="<?php echo $_module_name; ?>_form_data[stores][<?php echo $row; ?>]" value="<?php echo $store['store_id']; ?>" <?php echo (isset($form_data['stores']) && in_array($store['store_id'], $form_data['stores'])) ? 'checked' : ''; ?> /> <?php echo $store['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('input[type=checkbox]').attr('checked', true);"><?php echo $text_select_all; ?></a>
                  <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':checkbox').removeAttr('checked');"><?php echo $text_unselect_all; ?></a>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_show_in_stores_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_customer_groups; ?></label>
                <div class="col-sm-10">
                  <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="<?php echo $_module_name; ?>_form_data[customer_groups][<?php echo $row; ?>]"
                          value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($form_data['customer_groups'][$row])) ? 'checked' : ''; ?>
                        /> <?php echo $customer_group['name']; ?>
                      </label>
                    </div>
                    <?php $row++; ?>
                    <?php } ?>
                  </div>
                  <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('input[type=checkbox]').attr('checked', true);"><?php echo $text_select_all; ?></a>
                  <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':checkbox').removeAttr('checked');"><?php echo $text_unselect_all; ?></a>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_customer_groups_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Layout setting --> 
            <div class="tab-pane" id="layout-block">
              <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading"><b><?php echo $text_product_information; ?></b></div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_main_product_image; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_main_img'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_main_img]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_main_img'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_main_img'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_main_img]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_main_img'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_dementions_of_main_image; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                            <input value="<?php echo $form_data['main_image_width']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[main_image_width]" class="form-control" placehodler="<?php echo $text_image_width_ph; ?>" />
                          </div>
                          <div class="special_margin"></div>
                          <div class="input-group">
                            <span class="input-group-addon">&nbsp;<i class="fa fa-arrows-v"></i>&nbsp;</span>
                            <input value="<?php echo $form_data['main_image_height']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[main_image_height]" class="form-control" placehodler="<?php echo $text_image_height_ph; ?>" />
                          </div>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_sub_images; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_sub_img'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_sub_img]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_sub_img'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_sub_img'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_sub_img]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_sub_img'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_dementions_of_sub_images; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                            <input value="<?php echo $form_data['sub_images_width']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[sub_images_width]" class="form-control" placehodler="<?php echo $text_image_width_ph; ?>" />
                          </div>
                          <div class="special_margin"></div>
                          <div class="input-group">
                            <span class="input-group-addon">&nbsp;<i class="fa fa-arrows-v"></i>&nbsp;</span>
                            <input value="<?php echo $form_data['sub_images_height']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[sub_images_height]" class="form-control" placehodler="<?php echo $text_image_height_ph; ?>" />
                          </div>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_warning_dementions_of_sub_images; ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label" for="input-count_sub_images"><?php echo $text_count_sub_images; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                            <input value="<?php echo $form_data['count_sub_images']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[count_sub_images]" class="form-control" id="input-count_sub_images" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_dementions_of_option_images; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                            <input value="<?php echo $form_data['option_images_width']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[option_images_width]" class="form-control" placehodler="<?php echo $text_image_width_ph; ?>" />
                          </div>
                          <div class="special_margin"></div>
                          <div class="input-group">
                            <span class="input-group-addon">&nbsp;<i class="fa fa-arrows-v"></i>&nbsp;</span>
                            <input value="<?php echo $form_data['option_images_height']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[option_images_height]" class="form-control" placehodler="<?php echo $text_image_height_ph; ?>" />
                          </div>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_warning_dementions_of_sub_images; ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_use_product_discount; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['discount_status'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[discount_status]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['discount_status'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['discount_status'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[discount_status]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['discount_status'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_product_options; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_options'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_options]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_options'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_options'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_options]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_options'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_product_attributes; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_attributes'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_attributes]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_attributes'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_attributes'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_attributes]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_attributes'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_product_description; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_description'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_description]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_description'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_description'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_description]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_description'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_model; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_model'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_model]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_model'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_model'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_model]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_model'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_ean; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_ean'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_ean]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_ean'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_ean'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_ean]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_ean'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_jan; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_jan'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_jan]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_jan'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_jan'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_jan]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_jan'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_isbn; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_isbn'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_isbn]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_isbn'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_isbn'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_isbn]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_isbn'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_mpn; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_mpn'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_mpn]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_mpn'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_mpn'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_mpn]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_mpn'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_product_location; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_product_location'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_location]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_location'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_product_location'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_product_location]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_product_location'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_shipping_title; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_shipping_title'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_shipping_title]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_shipping_title'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_shipping_title'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_shipping_title]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_shipping_title'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_product_table_info; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_table_info'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_table_info]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_table_info'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_table_info'] == 0 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[hide_table_info]" 
                                value="0" 
                                autocomplete="off" 
                                <?php echo $form_data['hide_table_info'] == 0 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_coupon; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_coupon'] == 1 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_coupon]"
                                value="1"
                                autocomplete="off"
                                <?php echo $form_data['hide_coupon'] == 1 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_coupon'] == 0 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_coupon]"
                                value="0"
                                autocomplete="off"
                                <?php echo $form_data['hide_coupon'] == 0 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_voucher; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_voucher'] == 1 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_voucher]"
                                value="1"
                                autocomplete="off"
                                <?php echo $form_data['hide_voucher'] == 1 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_voucher'] == 0 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_voucher]"
                                value="0"
                                autocomplete="off"
                                <?php echo $form_data['hide_voucher'] == 0 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_show_reward; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['hide_reward'] == 1 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_reward]"
                                value="1"
                                autocomplete="off"
                                <?php echo $form_data['hide_reward'] == 1 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['hide_reward'] == 0 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[hide_reward]"
                                value="0"
                                autocomplete="off"
                                <?php echo $form_data['hide_reward'] == 0 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_display_info_message; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['display_info_text'] == 1 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[display_info_text]"
                                value="1"
                                autocomplete="off"
                                <?php echo $form_data['display_info_text'] == 1 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_yes; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['display_info_text'] == 0 ? 'active' : ''; ?>">
                              <input type="radio"
                                name="<?php echo $_module_name; ?>_form_data[display_info_text]"
                                value="0"
                                autocomplete="off"
                                <?php echo $form_data['display_info_text'] == 0 ? 'checked="checked"' : ''; ?>
                              /><?php echo $text_no; ?>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading"><b><?php echo $text_other_options; ?></b></div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_email_template; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <div class="btn-group-vertical" data-toggle="buttons">
                            <label class="btn btn-success <?php echo $form_data['allow_email_template'] == 1 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[allow_email_template]" 
                                value="1" 
                                autocomplete="off" 
                                <?php echo $form_data['allow_email_template'] == 1 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_custom_html_template; ?>
                            </label>
                            <label class="btn btn-success <?php echo $form_data['allow_email_template'] == 2 ? 'active' : ''; ?>">
                              <input type="radio" 
                                name="<?php echo $_module_name; ?>_form_data[allow_email_template]" 
                                value="2" 
                                autocomplete="off" 
                                <?php echo $form_data['allow_email_template'] == 2 ? 'checked="checked"' : ''; ?> 
                              /><?php echo $text_default_html_template; ?>
                            </label>
                          </div>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_email_template_faq; ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_email_template_by_default; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php if ($templates) { ?>
                          <?php $row_height = 55; $row = 0; foreach ($templates as $template) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php $row = 0; foreach ($templates as $template) { ?>
                            <div class="radio">
                              <label>
                                <input type="radio" name="<?php echo $_module_name; ?>_form_data[email_template_by_default]" value="<?php echo $template['template_id']; ?>" <?php echo (isset($form_data['email_template_by_default']) && $form_data['email_template_by_default'] == $template['template_id']) ? 'checked' : ''; ?> /> <?php echo $template['subject']; ?>
                              </label>
                            </div>
                            <?php $row++; ?>
                            <?php } ?>
                          </div>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':radio').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                          <?php } else { ?>
                            <div class="well well-sm" style="height: 69.3px; overflow: auto;">
                            <?php echo $text_no_templates; ?>
                            </div>
                          <?php } ?>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_email_template_by_default_faq; ?></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_select_payments; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php $row_height = 55; $row = 0; foreach ($payments as $payment) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php foreach ($payments as $payment) { ?>
                            <?php if (!empty($payment['code'])) { ?>
                            <div class="checkbox">
                              <label>
                                <input 
                                  type="checkbox" 
                                  class="payment_code_array" 
                                  name="<?php echo $_module_name; ?>_form_data[payment_code_array][<?php echo $payment['code']; ?>]" 
                                  value="<?php echo $payment['code']; ?>" <?php echo (isset($form_data['payment_code_array']) && in_array($payment['code'], $form_data['payment_code_array'])) ? 'checked' : ''; ?> 
                                /> <?php echo $payment['name']; ?>
                              </label>
                              <div style="float:right;">
                                <input 
                                  type="checkbox" 
                                  name="<?php echo $_module_name; ?>_form_data[transfer_payments][<?php echo $payment['code']; ?>]" 
                                  value="<?php echo $payment['code']; ?>" <?php echo (isset($form_data['transfer_payments']) && in_array($payment['code'], $form_data['transfer_payments'])) ? 'checked' : ''; ?>
                                  data-placement="top" 
                                  data-toggle="tooltip" 
                                  title="<?php echo $transfer_payments_faq; ?>" 
                                />
                              </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                          <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('.payment_code_array').attr('checked', true);"><?php echo $text_select_all; ?></a>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find('.payment_code_array').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_select_shipping; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php $row_height = 55; $row = 0; foreach ($shippings as $shipping) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php foreach ($shippings as $shipping) { ?>
                            <?php if (!empty($shipping['code'])) { ?>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="<?php echo $_module_name; ?>_form_data[shipping_code_array][<?php echo $shipping['code']; ?>]" value="<?php echo $shipping['code']; ?>" <?php echo (isset($form_data['shipping_code_array']) && in_array($shipping['code'], $form_data['shipping_code_array'])) ? 'checked' : ''; ?>  /> <?php echo $shipping['name']; ?>
                              </label>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                          <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('input[type=checkbox]').attr('checked', true);"><?php echo $text_select_all; ?></a>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':checkbox').removeAttr('checked');"><?php echo $text_unselect_all; ?></a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_select_options; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php $row_height = 55; $row = 0; foreach ($product_options as $option) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php foreach ($product_options as $option) { ?>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="<?php echo $_module_name; ?>_form_data[product_options_array][<?php echo $option['option_id']; ?>]" value="<?php echo $option['option_id']; ?>" <?php echo (isset($form_data['product_options_array']) && in_array($option['option_id'], $form_data['product_options_array'])) ? 'checked' : ''; ?> /> <?php echo $option['name']; ?>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                          <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('input[type=checkbox]').attr('checked', true);"><?php echo $text_select_all; ?></a>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':checkbox').removeAttr('checked');"><?php echo $text_unselect_all; ?></a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_select_country; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php $row_height = 55; $row = 0; foreach ($countries_data as $country) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php foreach ($countries_data as $country) { ?>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="<?php echo $_module_name; ?>_form_data[product_countries][<?php echo $country['country_id']; ?>]" value="<?php echo $country['country_id']; ?>" <?php echo (isset($form_data['product_countries']) && in_array($country['country_id'], $form_data['product_countries'])) ? 'checked' : ''; ?> /> <?php echo $country['name']; ?>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                          <a class="btn btn-primary btn-sm" onclick="$(this).parent().find('input[type=checkbox]').attr('checked', true);"><?php echo $text_select_all; ?></a>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':checkbox').removeAttr('checked');"><?php echo $text_unselect_all; ?></a>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-md-5 control-label"><?php echo $text_select_information; ?></label>
                        <div class="col-sm-8 col-md-7">
                          <?php $row_height = 55; $row = 0; foreach ($informations as $information) { ?>
                          <?php if ($row < 5) { $row_height = $row_height*1.29; } $row++; ?>
                          <?php } ?>
                          <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                            <?php foreach ($informations as $information) { ?>
                            <div class="radio">
                              <label>
                                <input type="radio" name="<?php echo $_module_name; ?>_form_data[require_information]" value="<?php echo $information['information_id']; ?>" <?php echo (isset($form_data['require_information']) && $form_data['require_information'] == $information['information_id']) ? 'checked' : ''; ?> /> <?php echo $information['title']; ?>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                          <a class="btn btn-warning btn-sm" onclick="$(this).parent().find(':radio').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                          <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_select_information_faq; ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Fields block -->
            <div class="tab-pane" id="fields-block">
              <div class="row">
                <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="module">
                    <?php $field_row = 1; ?>
                    <?php foreach ($field_data as $field) { ?>
                    <li>
                      <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][sort_order]" />
                      <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][name]" value="field_<?php echo $field_row; ?>" />
                      <a href="#tab-module<?php echo $field_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-module<?php echo $field_row; ?>\']').parent().remove(); $('#tab-module<?php echo $field_row; ?>').remove(); $('#module a:first').tab('show');"></i> <?php echo $text_tab_field; ?> <?php echo '№'. $field_row; ?>
                      <span class="field_title">(<?php echo (isset($field['title'][$language_id])) ? $field['title'][$language_id] : ''; ?>)</span>
                      </a>
                    </li>
                    <?php $field_row++; ?>
                    <?php } ?>
                    <li id="module-add">
                      <a onclick="addField();" class="btn btn-success"><i class="fa fa-plus-circle"></i> <?php echo $button_add_field; ?></a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-10">
                  <div class="tab-content">
                    <?php $field_row = 1; ?>
                    <?php foreach ($field_data as $field) { ?>
                      <div class="tab-pane" id="tab-module<?php echo $field_row; ?>">
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-activate<?php echo $field_row; ?>"><?php echo $text_activate_field; ?></label>
                          <div class="col-sm-10">
                            <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][activate]" class="form-control" id="input-activate<?php echo $field_row; ?>">
                              <?php if ($field['activate'] == 1) { ?>
                                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                <option value="2"><?php echo $text_yes_and_hide; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                              <?php } elseif ($field['activate'] == 2) { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="2" selected="selected"><?php echo $text_yes_and_hide; ?></option>
                                <option value="0"><?php echo $text_no; ?></option>
                              <?php } else { ?>
                                <option value="1"><?php echo $text_yes; ?></option>
                                <option value="2"><?php echo $text_yes_and_hide; ?></option>
                                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group required">
                          <label class="col-sm-2 control-label" for="input-title<?php echo $field_row; ?>"><?php echo $text_heading_field; ?></label>
                          <div class="col-sm-10">
                            <ul class="nav nav-tabs" id="language<?php echo $field_row; ?>">
                              <?php foreach ($languages as $language) { ?>
                                <li>
                                  <a href="#tab-module<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <div class="tab-content">
                            <?php foreach ($languages as $language) { ?>
                              <div class="tab-pane" id="tab-module<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>">
                                <input 
                                type="text" 
                                name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][title][<?php echo $language['language_id']; ?>]" 
                                value="<?php echo (isset($field['title'][$language['language_id']])) ? $field['title'][$language['language_id']] : ''; ?>" 
                                class="form-control" 
                                id="input-title<?php echo $field_row; ?>" 
                                />
                                <?php if (isset($error_data_fields[$field_row]['title'][$language['language_id']])) { ?>
                                  <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[$field_row]['title'][$language['language_id']]; ?></div>
                                <?php } ?>
                              </div>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group required">
                          <label class="col-sm-2 control-label" for="input-view<?php echo $field_row; ?>"><?php echo $text_assign_functionality; ?></label>
                          <div class="col-sm-10">
                            <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][view]" class="form-control" id="input-view<?php echo $field_row; ?>">
                              <option value="0"><?php echo $text_make_a_choice; ?></option>
                              <?php foreach ($field_view_data as $key => $view) { ?>
                              <option value="<?php echo $key; ?>" <?php echo ($field['view'] == $key) ? 'selected="selected"' : ''; ?> ><?php echo $view; ?></option>
                              <?php } ?>
                            </select>
                            <?php if (isset($error_data_fields[$field_row]['view'])) { ?>
                              <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[$field_row]['view']; ?></div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-check<?php echo $field_row; ?>"><?php echo $text_check_type; ?></label>
                          <div class="col-sm-10">
                            <select name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check]" class="form-control" id="input-check<?php echo $field_row; ?>">
                              <option value="0" <?php echo $field['check'] == 0 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_1; ?></option>
                              <option value="1" <?php echo $field['check'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_2; ?></option>
                              <option value="2" <?php echo $field['check'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_3; ?></option>
                              <option value="3" <?php echo $field['check'] == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_validation_type_4; ?></option>
                            </select>
                            <div class="input-group" style="<?php echo $field['check'] == 2 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                              <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                              <input type="text" placeholder="<?php echo $text_validation_type_3_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_rule]" value="<?php echo $field['check_rule']; ?>" class="form-control" />
                            </div>
                            <div class="input-group" style="<?php echo $field['check'] == 3 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                              <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                              <input type="text" placeholder="<?php echo $text_validation_type_4_1_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_min]" value="<?php echo $field['check_min']; ?>" class="form-control" />
                            </div>
                            <div class="input-group" style="<?php echo $field['check'] == 3 ? 'display:table;margin-top:15px;' : 'display:none;margin-top:15px;'; ?>">
                              <span class="input-group-addon"><i class="fa fa-chevron-left"></i></span>
                              <input type="text" placeholder="<?php echo $text_validation_type_4_2_ph; ?>" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][check_max]" value="<?php echo $field['check_max']; ?>" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="form-group" style="<?php echo $field['view'] == 'telephone' ? 'display:block;' : 'display:none;'; ?>" id="field-mask">
                          <label class="col-sm-2 control-label" for="input-mask<?php echo $field_row; ?>"><span data-toggle="tooltip" title="<?php echo $text_mask_faq; ?>"><?php echo $text_mask; ?></span></label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
                              <input value="<?php echo $field['mask']; ?>" type="text" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][mask]" class="form-control" placeholder="<?php echo $text_mask_ph; ?>" id="input-mask<?php echo $field_row; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="form-group required">
                          <label class="col-sm-2 control-label" for="input-error_text<?php echo $field_row; ?>"><?php echo $text_error_text; ?></label>
                          <div class="col-sm-10">
                            <ul class="nav nav-tabs" id="language<?php echo $field_row; ?>">
                              <?php foreach ($languages as $language) { ?>
                                <li>
                                  <a href="#tab-module2<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <div class="tab-content">
                            <?php foreach ($languages as $language) { ?>
                              <div class="tab-pane" id="tab-module2<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>">
                                <input 
                                type="text" 
                                name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][error_text][<?php echo $language['language_id']; ?>]" 
                                value="<?php echo (isset($field['error_text'][$language['language_id']])) ? $field['error_text'][$language['language_id']] : ''; ?>" 
                                class="form-control" 
                                id="input-error_text<?php echo $field_row; ?>" 
                                />
                                <?php if (isset($error_data_fields[$field_row]['error_text'][$language['language_id']])) { ?>
                                  <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[$field_row]['error_text'][$language['language_id']]; ?></div>
                                <?php } ?>
                              </div>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-placeholder_text<?php echo $field_row; ?>"><?php echo $text_placeholder_text; ?></label>
                          <div class="col-sm-10">
                            <ul class="nav nav-tabs" id="language<?php echo $field_row; ?>">
                              <?php foreach ($languages as $language) { ?>
                                <li>
                                  <a href="#tab-module3<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <div class="tab-content">
                            <?php foreach ($languages as $language) { ?>
                              <div class="tab-pane" id="tab-module3<?php echo $field_row; ?>-language<?php echo $language['language_id']; ?>">
                                <input
                                type="text"
                                name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][placeholder_text][<?php echo $language['language_id']; ?>]"
                                value="<?php echo (isset($field['placeholder_text'][$language['language_id']])) ? $field['placeholder_text'][$language['language_id']] : ''; ?>"
                                class="form-control"
                                id="input-placeholder_text<?php echo $field_row; ?>"
                                />
                              </div>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-css_id<?php echo $field_row; ?>"><?php echo $text_css_id; ?></label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon">#</span>
                              <input value="<?php echo $field['css_id']; ?>" type="text" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][css_id]" class="form-control" placeholder="<?php echo $text_css_id_ph; ?>" id="input-css_id<?php echo $field_row; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="input-css_class<?php echo $field_row; ?>"><?php echo $text_css_class; ?></label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <span class="input-group-addon">&#8226;</span>
                              <input value="<?php echo $field['css_class']; ?>" type="text" name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][css_class]" class="form-control" placeholder="<?php echo $text_css_class_ph; ?>" id="input-css_class<?php echo $field_row; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"><?php echo $text_position; ?></label>
                          <div class="col-sm-10">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-success <?php echo $field['position'] == 1 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="1" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 1 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_left_side; ?>
                              </label>
                              <label class="btn btn-success <?php echo $field['position'] == 3 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="3" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 3 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_center; ?>
                              </label>
                              <label class="btn btn-success <?php echo $field['position'] == 2 ? 'active' : ''; ?>">
                                <input type="radio" 
                                  name="<?php echo $_module_name; ?>_field_data[<?php echo $field_row; ?>][position]" 
                                  value="2" 
                                  autocomplete="off" 
                                  <?php echo $field['position'] == 2 ? 'checked="checked"' : ''; ?> 
                                /><?php echo $text_right_side; ?>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php $field_row++; ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Marketing Tools -->
            <div class="tab-pane" id="marketing-tools-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_choose_gift_coupon; ?></label>
                <div class="col-sm-10">
                  <select name="<?php echo $_module_name; ?>_form_data[gift_coupon]" class="form-control">
                    <option value=""><?php echo $text_make_a_choice; ?></option>
                    <?php foreach ($all_coupons as $coupon) { ?>
                      <?php if (isset($form_data['gift_coupon']) && $coupon['coupon_id'] == $form_data['gift_coupon']) { ?>
                        <option value="<?php echo $coupon['coupon_id']; ?>" selected="selected"><?php echo $coupon['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $coupon['coupon_id']; ?>"><?php echo $coupon['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_choose_gift_coupon_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Popup settings -->
            <div class="tab-pane" id="popup-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_background_images; ?></label>
                <div class="col-sm-10">
                  <div class="input-group div_background_images">
                    <?php if ($backgrounds) { ?>
                      <?php $key = 1; foreach ($backgrounds as $background) { ?>
                      <input type="radio" name="<?php echo $_module_name; ?>_form_data[style_background]" id="label_img_<?php echo $key; ?>" value="<?php echo $background['name']; ?>" <?php echo (!empty($form_data['style_background']) && $form_data['style_background'] == $background['name']) ? 'checked' : ''; ?> />
                      <label class="background_for_label" for="label_img_<?php echo $key; ?>" style="background:url(<?php echo $background['src']; ?>);">
                      </label>
                      <?php $key++; } ?>
                    <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_background_images_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_background_opacity; ?></label>
                <div class="col-xs-10 col-sm-3 col-md-2 col-lg-2">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="button" onclick="if(parseInt($(this).parent().next().val())>=1){$(this).parent().next().val(~~$(this).parent().next().val()-1)}">-</button>
                    </span>
                    <input type="text" value="<?php echo (!empty($form_data['background_opacity'])) ? $form_data['background_opacity'] : 0; ?>" name="<?php echo $_module_name; ?>_form_data[background_opacity]" class="form-control" />
                    <span class="input-group-btn">
                      <button class="btn btn-success" type="button" onclick="if(parseInt($(this).parent().prev().val())<=9){$(this).parent().prev().val(~~$(this).parent().prev().val()+1)}">+</button>
                    </span>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_background_opacity_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Import / Export Block -->
            <div class="tab-pane" id="import-export-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_restore; ?></label>
                <div class="col-sm-5">
                  <input type="file" name="import" style="display:none;" id="load-file" />
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button" onclick="$('#load-file').click();"><?php echo $text_select_file; ?></button>
                    </span>
                    <input type="text" name="load_file_mask" id="load-file-mask" class="form-control">
                    <span class="input-group-btn">
                      <button id="button-import-file" type="submit" formaction="<?php echo $action_plus; ?>" form="form" data-toggle="tooltip" class="btn btn-success" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                <div class="col-sm-5">
                  <a href="<?php echo $export_settings_button; ?>" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                </div>
              </div>
            </div>
            <!-- TAB Language setting -->
            <div class="tab-pane" id="language-block">
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_module_heading; ?></label>
                <div class="col-sm-10">
                  <ul class="nav nav-tabs" id="module_heading">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-module_heading-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-module_heading-language<?php echo $language['language_id']; ?>">
                      <input
                        type="text"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][heading]"
                        value="<?php echo (!empty($text_data[$language['language_id']]['heading'])) ? $text_data[$language['language_id']]['heading'] : ''; ?>"
                        class="form-control"
                      />
                      <?php if (isset($error_heading[$language['language_id']])) { ?>
                        <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_heading[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_module_heading_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_module_call_button; ?></label>
                <div class="col-sm-10">
                  <ul class="nav nav-tabs" id="module_call_button">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-module_call_button-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-module_call_button-language<?php echo $language['language_id']; ?>">
                      <input
                        type="text"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][call_button]"
                        value="<?php echo (!empty($text_data[$language['language_id']]['call_button'])) ? $text_data[$language['language_id']]['call_button'] : ''; ?>"
                        class="form-control"
                      />
                      <?php if (isset($error_call_button[$language['language_id']])) { ?>
                        <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_call_button[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_module_call_button_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_module_send_button; ?></label>
                <div class="col-sm-10">
                  <ul class="nav nav-tabs" id="module_send_button">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-module_send_button-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-module_send_button-language<?php echo $language['language_id']; ?>">
                      <input
                        type="text"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][send_button]"
                        value="<?php echo (!empty($text_data[$language['language_id']]['send_button'])) ? $text_data[$language['language_id']]['send_button'] : ''; ?>"
                        class="form-control"
                      />
                      <?php if (isset($error_send_button[$language['language_id']])) { ?>
                        <div class="alert alert-danger text-danger"><?php echo $error_send_button[$language['language_id']]; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_module_send_button_faq; ?></div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_module_continue_shopping_button; ?></label>
                <div class="col-sm-10">
                  <ul class="nav nav-tabs" id="module_continue_shopping_button">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-module_continue_shopping_button-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-module_continue_shopping_button-language<?php echo $language['language_id']; ?>">
                      <input
                        type="text"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][continue_shopping_button]"
                        value="<?php echo (!empty($text_data[$language['language_id']]['continue_shopping_button'])) ? $text_data[$language['language_id']]['continue_shopping_button'] : ''; ?>"
                        class="form-control"
                      />
                      <?php if (isset($error_continue_shopping_button[$language['language_id']])) { ?>
                        <div class="alert alert-danger text-danger"><?php echo $error_continue_shopping_button[$language['language_id']]; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_module_continue_shopping_button_faq; ?></div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_result_message; ?></label>
                <div class="col-sm-8">
                  <ul class="nav nav-tabs" id="success_text">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-success_text-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-success_text-language<?php echo $language['language_id']; ?>">
                      <textarea
                        id="success_text-language<?php echo $language['language_id']; ?>"
                        class="form-control"
                        style="height:auto;resize:vertical;"
                        rows="3"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][success_text]"><?php echo (!empty($text_data[$language['language_id']]['success_text'])) ? $text_data[$language['language_id']]['success_text'] : '';?></textarea>
                        <?php if (isset($error_success_text[$language['language_id']])) { ?>
                          <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_success_text[$language['language_id']]; ?></div>
                        <?php } ?>
                    </div>
                  <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_result_message_faq; ?></div>
                </div>
                <div class="col-sm-2">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <?php echo $text_success_text_sub_h1; ?>
                    </div>
                    <div class="panel-footer"><?php echo $text_success_text_sub_c1; ?></div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <?php echo $text_success_text_sub_h2; ?>
                    </div>
                    <div class="panel-footer"><?php echo $text_success_text_sub_c2; ?></div>
                  </div>  
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $text_info_message; ?></label>
                <div class="col-sm-10">
                  <ul class="nav nav-tabs" id="info_message">
                    <?php foreach ($languages as $language) { ?>
                      <li>
                        <a href="#tab-info_message-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                    <div class="tab-pane" id="tab-info_message-language<?php echo $language['language_id']; ?>">
                      <textarea
                        id="info_message-language<?php echo $language['language_id']; ?>" 
                        class="form-control"
                        style="height:auto;resize:vertical;"
                        rows="3"
                        name="<?php echo $_module_name; ?>_text_data[<?php echo $language['language_id']; ?>][info_message]"><?php echo (!empty($text_data[$language['language_id']]['info_message'])) ? $text_data[$language['language_id']]['info_message'] : '';?></textarea>
                        <?php if (isset($error_info_message[$language['language_id']])) { ?>
                          <div class="alert alert-danger text-danger"><?php echo $error_info_message[$language['language_id']]; ?></div>
                        <?php } ?>
                        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_info_message_faq; ?></div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Marketing Analytics -->
            <div class="tab-pane" id="marketing-analytics-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_allow_google_analytics; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $form_data['allow_google_analytics'] == 1 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="<?php echo $_module_name; ?>_form_data[allow_google_analytics]"
                        value="1"
                        autocomplete="off"
                        <?php echo $form_data['allow_google_analytics'] == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $form_data['allow_google_analytics'] == 0 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="<?php echo $_module_name; ?>_form_data[allow_google_analytics]"
                        value="0"
                        autocomplete="off"
                        <?php echo $form_data['allow_google_analytics'] == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="textarea-google_analytics_script"><?php echo $text_google_analytics_id; ?></label>
                <div class="col-sm-10">
                  <textarea style="resize:vertical;" name="<?php echo $_module_name; ?>_form_data[google_analytics_script]" class="form-control" id="textarea-google_analytics_script"><?php echo $form_data['google_analytics_script']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_allow_google_event; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $form_data['allow_google_event'] == 1 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="<?php echo $_module_name; ?>_form_data[allow_google_event]"
                        value="1"
                        autocomplete="off"
                        <?php echo $form_data['allow_google_event'] == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $form_data['allow_google_event'] == 0 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="<?php echo $_module_name; ?>_form_data[allow_google_event]"
                        value="0"
                        autocomplete="off"
                        <?php echo $form_data['allow_google_event'] == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-google_event_category"><?php echo $text_google_event_category_name; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input value="<?php echo $form_data['google_event_category']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[google_event_category]" class="form-control" id="input-google_event_category" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-google_event_action_name"><?php echo $text_google_event_action_name; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input value="<?php echo $form_data['google_event_action']; ?>" type="text" name="<?php echo $_module_name; ?>_form_data[google_event_action]" class="form-control" id="input-google_event_action_name" />
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Support General block -->
            <div class="tab-pane" id="support-general-block">
              <?php echo $support_info['general']; ?>
            </div>
            <!-- TAB Support Extension block -->
            <div class="tab-pane" id="support-extension-block">
              <div class="panel panel-default">
                <div class="panel-heading"><b><?php echo $tab_support_extension_setting; ?></b></div>
                <table class="table">
                  <?php if ($products) { ?>
                  <?php foreach ($products as $product) { ?>
                  <?php if ($product['extension_id'] == 20548) { ?>
                  <tr>
                    <td width="20%"><?php echo $text_installed_module_name; ?></td>
                    <td><i class="fa fa-external-link" aria-hidden="true"></i> <a href="<?php echo $product['url']; ?>" target="_blank"><?php echo $product['title']; ?></td>
                  </tr>
                  <tr>
                    <td><?php echo $text_installed_module_version; ?></td>
                    <?php $_tmp_module_version = version_compare($_module_version, $product['latest_version']); ?>
                    <td><?php echo $_module_version; ?> <?php if ($_tmp_module_version == "-1") { ?><a class="btn btn-success btn-sm" href="<?php echo $product['url']; ?>" target="_blank"><?php echo $text_new_module_version; ?> <?php echo $product['latest_version']; ?></a><?php } ?></td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                  <tr>
                    <td width="20%"><?php echo $text_opencart_version; ?></td>
                    <td><?php echo $opencart_version; ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- TAB Support General block -->
            <div class="tab-pane" id="support-terms-block">
              <?php echo $support_info['terms']; ?>
            </div>
            <!-- TAB Support Faq block -->
            <div class="tab-pane" id="support-faq-block">
              <?php echo $support_info['faq']; ?>
            </div>
            <!-- TAB Support Service block -->
            <div class="tab-pane" id="support-service-block">
              <?php echo $support_info['service']; ?>
            </div>
            <!-- TAB OCdev Products --> 
            <div class="tab-pane" id="promo-block">
              <?php if ($products) { ?>
              <div class="row">
                <?php foreach ($products as $product) { ?>
                <div class="col-xs-6 col-md-2 col-sm-3">
                  <div class="thumbnail" onclick='$("#extension_id-<?php echo $product['extension_id']; ?>").modal();' data-toggle="tooltip" data-placement="bottom" title="Click to Read more..." >
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['title']; ?>" width="100%" />
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="extension_id-<?php echo $product['extension_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width:450px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel"><?php echo $product['title']; ?></h4>
                        </div>
                        <div class="modal-body">
                          <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#modal-info-<?php echo $product['extension_id']; ?>" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_modal_info; ?></a></li>
                              <li><a href="#modal-opencart-version-<?php echo $product['extension_id']; ?>" data-toggle="tab"><i class="fa fa-check-circle"></i> <?php echo $tab_modal_for_opencart; ?></a></li>
                              <li><a href="#modal-features-<?php echo $product['extension_id']; ?>" data-toggle="tab"><i class="fa fa-star"></i> <?php echo $tab_modal_features; ?></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane active" id="modal-info-<?php echo $product['extension_id']; ?>">
                                <ul class="list-group">
                                  <li class="list-group-item"><?php echo $text_modal_price; ?> <b class="pull-right"><?php echo $product['price']; ?></b></li>
                                  <li class="list-group-item"><?php echo $text_modal_date_added; ?> <b class="pull-right"><?php echo $product['date_added']; ?></b></li>
                                  <li class="list-group-item"><?php echo $text_modal_latest_version; ?> <b class="pull-right"><?php echo $product['latest_version']; ?></b></li>
                                </ul>
                              </div>
                              <div class="tab-pane" id="modal-opencart-version-<?php echo $product['extension_id']; ?>">
                                <ul class="list-group">
                                  <li class="list-group-item">
                                    <div class="row">
                                    <?php $opencart_version_array = explode(',', $product['opencart_version']); ?>
                                    <?php foreach ($opencart_version_array as $value) { ?>
                                      <div class="col-xs-6 col-md-2 col-sm-3"><?php echo $value; ?></div>
                                    <?php } ?>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <div class="tab-pane" id="modal-features-<?php echo $product['extension_id']; ?>">
                                <ul class="list-group">
                                  <li class="list-group-item">
                                    <div class="row">
                                    <?php $opencart_features_array = explode(';', $product['features']); ?>
                                    <?php foreach ($opencart_features_array as $value) { ?>
                                      <div class="col-xs-12 col-md-12 col-sm-12"><?php echo $value; ?></div>
                                    <?php } ?>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <a href="<?php echo $product['url']; ?>" target="blank" class="btn btn-primary" style="width:100%;"><i class="fa fa-external-link"></i> <?php echo $button_visit_sales_page; ?></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>
          <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_form_data[front_module_name]" value="<?php echo str_replace(array('<b>','</b>'), "", $heading_title); ?>" />
          <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_form_data[front_module_version]" value="<?php echo $_module_version; ?>" />
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript"><!--
var field_row = <?php echo $field_row; ?>;

  function addField() {
    html  = '<div class="tab-pane" id="tab-module' + field_row + '">';
    html += '   <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][sort_order]" />';
    html += '   <input type="hidden" style="display:none;" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][name]" value="module_' + field_row + '" />';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-activate' + field_row + '"><?php echo $text_activate_field; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][activate]" class="form-control" id="input-activate' + field_row + '">';
    html += '         <option value="1"><?php echo $text_yes; ?></option><option value="2"><?php echo $text_yes_and_hide; ?></option><option value="0" selected="selected"><?php echo $text_no; ?></option>';
    html += '       </select>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group required">';
    html += '     <label class="col-sm-2 control-label" for="input-title' + field_row + '"><?php echo $text_heading_field; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <ul class="nav nav-tabs" id="language' + field_row + '">';
                      <?php foreach ($languages as $language) { ?>
    html += '         <li>';
    html += '           <a href="#tab-module' + field_row + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    html += '         </li>';
                      <?php } ?>
    html += '       </ul>';
    html += '       <div class="tab-content">';
                      <?php foreach ($languages as $language) { ?>
    html += '         <div class="tab-pane" id="tab-module' + field_row + '-language<?php echo $language['language_id']; ?>">';
    html += '           <input type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][title][<?php echo $language['language_id']; ?>]" value="" class="form-control" id="input-title' + field_row + '" />';
                        <?php if (isset($error_data_fields[$field_row]['title'][$language['language_id']])) { ?>
    html += '           <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[' + field_row + ']['title'][$language['language_id']]; ?></div>';
                        <?php } ?>
    html += '         </div>';
                      <?php } ?>
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group required">';
    html += '     <label class="col-sm-2 control-label" for="input-view' + field_row + '"><?php echo $text_assign_functionality; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][view]" class="form-control" id="input-view' + field_row + '">';
    html += '         <option value="0"><?php echo $text_make_a_choice; ?></option>';
                      <?php foreach ($field_view_data as $key => $view) { ?>
    html += '         <option value="<?php echo $key; ?>"><?php echo $view; ?></option>';
                      <?php } ?>
    html += '       </select>';
                    <?php if (isset($error_data_fields[$field_row]['view'])) { ?>
    html += '       <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[' + field_row + ']['view']; ?></div>';
                    <?php } ?>
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-check' + field_row + '"><?php echo $text_check_type; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <select name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check]" class="form-control" id="input-check' + field_row + '">';
    html += '         <option value="0"><?php echo $text_validation_type_1; ?></option>';
    html += '         <option value="1"><?php echo $text_validation_type_2; ?></option>';
    html += '         <option value="2"><?php echo $text_validation_type_3; ?></option>';
    html += '         <option value="3"><?php echo $text_validation_type_4; ?></option>';
    html += '       </select>';
    html += '       <div class="input-group" style="display:none;margin-top:15px;">';
    html += '         <span class="input-group-addon"><i class="fa fa-filter"></i></span>';
    html += '         <input type="text" placeholder="" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_rule]" value="" class="form-control" />';
    html += '       </div>';
    html += '       <div class="input-group" style="display:none;margin-top:15px;">';
    html += '         <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>';
    html += '         <input type="text" placeholder="<?php echo $text_validation_type_4_1_ph; ?>" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_min]" value="" class="form-control" />';
    html += '       </div>';
    html += '       <div class="input-group" style="display:none;margin-top:15px;">';
    html += '         <span class="input-group-addon"><i class="fa fa-chevron-left"></i></span>';
    html += '         <input type="text" placeholder="<?php echo $text_validation_type_4_2_ph; ?>" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][check_max]" value="" class="form-control" />';
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-mask' + field_row + '"><?php echo $text_mask; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <div class="input-group">';
    html += '         <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>';
    html += '         <input value="" type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][mask]" class="form-control" placeholder="<?php echo $text_mask_ph; ?>" id="input-mask' + field_row + '" />';
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group required">';
    html += '     <label class="col-sm-2 control-label" for="input-error_text' + field_row + '"><?php echo $text_error_text; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <ul class="nav nav-tabs" id="language' + field_row + '">';
                      <?php foreach ($languages as $language) { ?>
    html += '           <li>';
    html += '             <a href="#tab-module2' + field_row + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    html += '           </li>';
                      <?php } ?>
    html += '       </ul>';
    html += '       <div class="tab-content">';
                      <?php foreach ($languages as $language) { ?>
    html += '           <div class="tab-pane" id="tab-module2' + field_row + '-language<?php echo $language['language_id']; ?>">';
    html += '             <input type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][error_text][<?php echo $language['language_id']; ?>]" value="<?php echo $default_error_message; ?>" class="form-control" id="input-error_text' + field_row + '" />';
                          <?php if (isset($error_data_fields[$field_row]['error_text'][$language['language_id']])) { ?>
    html += '               <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $error_data_fields[' + field_row + ']['error_text'][$language['language_id']]; ?></div>';
                          <?php } ?>
    html += '           </div>';
                      <?php } ?>
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-placeholder_text' + field_row + '"><?php echo $text_placeholder_text; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <ul class="nav nav-tabs" id="language' + field_row + '">';
                      <?php foreach ($languages as $language) { ?>
    html += '           <li>';
    html += '             <a href="#tab-module3' + field_row + '-language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
    html += '           </li>';
                      <?php } ?>
    html += '       </ul>';
    html += '       <div class="tab-content">';
                      <?php foreach ($languages as $language) { ?>
    html += '           <div class="tab-pane" id="tab-module3' + field_row + '-language<?php echo $language['language_id']; ?>">';
    html += '             <input type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][placeholder_text][<?php echo $language['language_id']; ?>]" value="" class="form-control" id="input-placeholder_text' + field_row + '" />';
    html += '           </div>';
                      <?php } ?>
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-css_id' + field_row + '"><?php echo $text_css_id; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <div class="input-group">';
    html += '         <span class="input-group-addon">#</span>';
    html += '         <input value="" type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][css_id]" class="form-control" placeholder="<?php echo $text_css_id_ph; ?>" id="input-css_id' + field_row + '" />';
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label" for="input-css_class' + field_row + '"><?php echo $text_css_class; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <div class="input-group">';
    html += '         <span class="input-group-addon">&#8226;</span>';
    html += '         <input value="" type="text" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][css_class]" class="form-control" placeholder="<?php echo $text_css_class_ph; ?>" id="input-css_class' + field_row + '" />';
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';
    html += '   <div class="form-group">';
    html += '     <label class="col-sm-2 control-label"><?php echo $text_position; ?></label>';
    html += '     <div class="col-sm-10">';
    html += '       <div class="btn-group" data-toggle="buttons">';
    html += '         <label class="btn btn-success">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="1" autocomplete="off" /><?php echo $text_left_side; ?>';
    html += '         </label>';
    html += '         <label class="btn btn-success active">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="3" autocomplete="off" checked="checked" /><?php echo $text_center; ?>';
    html += '         </label>';
    html += '         <label class="btn btn-success">';
    html += '           <input type="radio" name="<?php echo $_module_name; ?>_field_data[' + field_row + '][position]" value="2" autocomplete="off" /><?php echo $text_right_side; ?>';
    html += '         </label>';
    html += '       </div>';
    html += '     </div>';
    html += '   </div>';

    $('#fields-block .tab-content:first-child').append(html);

    $('#module-add').before('<li class="no_field_title"><a href="#tab-module' + field_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'a[href=\\\'#tab-module' + field_row + '\\\']\').parent().remove(); $(\'#tab-module' + field_row + '\').remove(); $(\'#module a:first\').tab(\'show\');"></i> <?php echo $text_tab_field; ?> №' + field_row + '</a></li>');
    $('#module a[href=\'#tab-module' + field_row + '\']').tab('show');
    $('#module a[href=\'#tab-module2' + field_row + '\']').tab('show');
    $('#module a[href=\'#tab-module3' + field_row + '\']').tab('show');
    $('#language' + field_row + ' li:first-child a').tab('show');
  
    $('select[name*=check]').change(function() {
      var val = $(this).val();
      if (val == 2) {
        $(this).next().show();
        $(this).next().next().hide();
        $(this).next().next().next().hide();
      } else if(val == 3) {
        $(this).next().hide();
        $(this).next().next().show();
        $(this).next().next().next().show();
      } else {
        $(this).next().hide();
        $(this).next().next().hide();
        $(this).next().next().next().hide();
      }
    });

    $('select[name*=view]').change(function() {
      var val = $(this).val();
      if (val == "telephone") {
        $('#field-mask').show();
      } else {
        $('#field-mask').hide();
      }
    });

    field_row++;
  }

<?php $field_row = 1; foreach ($field_data as $field) { ?>
  $('#language<?php echo $field_row; ?> li:first-child a').tab('show');
<?php $field_row++; } ?>

$('select[name*=check]').change(function() {
  var val = $(this).val();

   if (val == 2) {
    $(this).next().show();
    $(this).next().next().hide();
    $(this).next().next().next().hide();
   } else if(val == 3) {
    $(this).next().hide();
    $(this).next().next().show();
    $(this).next().next().next().show();
   } else {
    $(this).next().hide();
    $(this).next().next().hide();
    $(this).next().next().next().hide();
   }
});

$('select[name*=view]').change(function() {
  var val = $(this).val();
  if (val == "telephone") {
    $('#field-mask').show();
  } else {
    $('#field-mask').hide();
  }
});

<?php foreach ($languages as $language) { ?>
$('#info_message-language<?php echo $language['language_id']; ?>').summernote({
  height: 150
});
$('#success_text-language<?php echo $language['language_id']; ?>').summernote({
  height: 150
});
<?php } ?>

$('#module li:first-child a').tab('show');
$('#module_heading a:first').tab('show');
$('#module_call_button a:first').tab('show');
$('#success_text a:first').tab('show');
$('#info_message a:first').tab('show');
$('#success_text a:first').tab('show');
$('#module_send_button a:first').tab('show');
$('#module_continue_shopping_button a:first').tab('show');

$('#fields-block .nav-pills').sortable({
  forcePlaceholderSize: true,
  items: '> li:not(#module-add)',
  cursor: "move",
  axis: "y",
  placeholder: 'tab-placeholder',
});

if (window.localStorage && window.localStorage['last_active_tab']) {
  $('#setting-tabs a[href=' + window.localStorage['last_active_tab'] + ']').trigger('click');
}
$('#setting-tabs a[data-toggle="tab"]').click(function() {
  if (window.localStorage) {
    window.localStorage['last_active_tab'] = $(this).attr('href');
  }
});
$('#load-file').change(function(){
  $('#load-file-mask').val($(this).val());
  $('#button-import-file').attr('disabled', false);
});
//--></script>
<?php echo $footer; ?>