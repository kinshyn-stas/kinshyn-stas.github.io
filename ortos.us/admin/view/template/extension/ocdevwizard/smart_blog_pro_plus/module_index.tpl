<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<div class="modal-content" id="modal-module-constructor-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $text_modal_heading; ?></h4>
  </div>
  <div class="modal-body">
    <div id="content" class="row" style="padding-bottom: 0;">
      <div class="panel-body" style="padding-top: 0;padding-bottom: 0;">
        <ul class="nav nav-tabs" id="modal-setting-tabs">
          <li class="active dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <?php echo $tab_control_panel; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i> <?php echo $tab_language_setting; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-language-block" data-toggle="tab"><i class="fa fa-flag-o"></i> <?php echo $tab_basic_language_setting; ?></a></li>
            </ul>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="module_id" value="<?php echo $module_id; ?>" />
          <div class="tab-content">
            <!-- TAB General block -->
            <div class="tab-pane fade active in" role="tabpanel" id="modal-general-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-9">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_stores; ?></label>
                <div class="col-sm-9">
                  <?php $row_height = 55; $row = 0; foreach ($all_stores as $store) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($all_stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="stores[]"
                          value="<?php echo $store['store_id']; ?>" <?php echo (!empty($stores) && in_array($store['store_id'], $stores)) ? 'checked' : ''; ?>
                        /> <?php echo $store['name']; ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-stores"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_stores_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_customer_groups; ?></label>
                <div class="col-sm-9">
                  <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($all_customer_groups as $customer_group) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="customer_groups[]"
                          value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($customer_groups) && in_array($customer_group['customer_group_id'], $customer_groups)) ? 'checked' : ''; ?>
                        /> <?php echo $customer_group['name']; ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-customer-groups"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_customer_groups_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $text_display_type; ?></label>
                <div class="col-sm-9">
                  <select name="display_type" class="form-control">
                    <?php if ($display_type == 1) { ?>
                      <option value="1" selected="selected"><?php echo $text_archive_module; ?></option>
                      <option value="2"><?php echo $text_category_module; ?></option>
                      <option value="3"><?php echo $text_comment_module; ?></option>
                      <option value="4"><?php echo $text_search_module; ?></option>
                      <option value="5"><?php echo $text_tag_module; ?></option>
                      <option value="6"><?php echo $text_post_module; ?></option>
                    <?php } elseif ($display_type == 2) { ?>
                      <option value="1"><?php echo $text_archive_module; ?></option>
                      <option value="2" selected="selected"><?php echo $text_category_module; ?></option>
                      <option value="3"><?php echo $text_comment_module; ?></option>
                      <option value="4"><?php echo $text_search_module; ?></option>
                      <option value="5"><?php echo $text_tag_module; ?></option>
                      <option value="6"><?php echo $text_post_module; ?></option>
                    <?php } elseif ($display_type == 3) { ?>
                      <option value="1"><?php echo $text_archive_module; ?></option>
                      <option value="2"><?php echo $text_category_module; ?></option>
                      <option value="3" selected="selected"><?php echo $text_comment_module; ?></option>
                      <option value="4"><?php echo $text_search_module; ?></option>
                      <option value="5"><?php echo $text_tag_module; ?></option>
                      <option value="6"><?php echo $text_post_module; ?></option>
                    <?php } elseif ($display_type == 4) { ?>
                      <option value="1"><?php echo $text_archive_module; ?></option>
                      <option value="2"><?php echo $text_category_module; ?></option>
                      <option value="3"><?php echo $text_comment_module; ?></option>
                      <option value="4" selected="selected"><?php echo $text_search_module; ?></option>
                      <option value="5"><?php echo $text_tag_module; ?></option>
                      <option value="6"><?php echo $text_post_module; ?></option>
                    <?php } elseif ($display_type == 5) { ?>
                      <option value="1"><?php echo $text_archive_module; ?></option>
                      <option value="2"><?php echo $text_category_module; ?></option>
                      <option value="3"><?php echo $text_comment_module; ?></option>
                      <option value="4"><?php echo $text_search_module; ?></option>
                      <option value="5" selected="selected"><?php echo $text_tag_module; ?></option>
                      <option value="6"><?php echo $text_post_module; ?></option>
                    <?php } else { ?>
                      <option value="1"><?php echo $text_archive_module; ?></option>
                      <option value="2"><?php echo $text_category_module; ?></option>
                      <option value="3"><?php echo $text_comment_module; ?></option>
                      <option value="4"><?php echo $text_search_module; ?></option>
                      <option value="5"><?php echo $text_tag_module; ?></option>
                      <option value="6" selected="selected"><?php echo $text_post_module; ?></option>
                    <?php } ?>
                  </select>
                  <div class="alert alert-info display-type-1" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_archive_module_faq; ?></div>
                  <div class="alert alert-info display-type-2" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_category_module_faq; ?></div>
                  <div class="alert alert-info display-type-3" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_comment_module_faq; ?></div>
                  <div class="alert alert-info display-type-4" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_search_module_faq; ?></div>
                  <div class="alert alert-info display-type-5" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_tag_module_faq; ?></div>
                  <div class="alert alert-info display-type-6" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_post_module_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $text_layout; ?></label>
                <div class="col-sm-9">
                  <?php $row_height = 55; $row = 0; foreach ($all_layouts as $layout) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($all_layouts as $layout) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="module_layout[]"
                          value="<?php echo $layout['layout_id']; ?>" <?php echo (!empty($module_layout) && in_array($layout['layout_id'], $module_layout)) ? 'checked' : ''; ?>
                        /> <?php echo $layout['name']; ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_layout_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $text_static_position; ?></label>
                <div class="col-sm-9">
                  <select name="position" class="form-control">
                    <?php if ($position == 'column_left') { ?>
                      <option value="column_left" selected="selected"><?php echo $text_static_position_1; ?></option>
                      <option value="column_right"><?php echo $text_static_position_2; ?></option>
                      <option value="content_top"><?php echo $text_static_position_3; ?></option>
                      <option value="content_bottom"><?php echo $text_static_position_4; ?></option>
                    <?php } elseif ($position == 'column_right') { ?>
                      <option value="column_left"><?php echo $text_static_position_1; ?></option>
                      <option value="column_right" selected="selected"><?php echo $text_static_position_2; ?></option>
                      <option value="content_top"><?php echo $text_static_position_3; ?></option>
                      <option value="content_bottom"><?php echo $text_static_position_4; ?></option>
                    <?php } elseif ($position == 'content_top') { ?>
                      <option value="column_left"><?php echo $text_static_position_1; ?></option>
                      <option value="column_right"><?php echo $text_static_position_2; ?></option>
                      <option value="content_top" selected="selected"><?php echo $text_static_position_3; ?></option>
                      <option value="content_bottom"><?php echo $text_static_position_4; ?></option>
                    <?php } else { ?>
                      <option value="column_left"><?php echo $text_static_position_1; ?></option>
                      <option value="column_right"><?php echo $text_static_position_2; ?></option>
                      <option value="content_top"><?php echo $text_static_position_3; ?></option>
                      <option value="content_bottom" selected="selected"><?php echo $text_static_position_4; ?></option>
                    <?php } ?>
                  </select>
                  <div class="modal-error-block" id="modal-error-position"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_static_position_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-sort_order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $sort_order; ?>" type="text" name="sort_order" class="form-control" />
                  <div class="modal-error-block" id="modal-error-sort-order"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_sort_order_faq; ?></div>
                </div>
              </div>
              <div class="form-group required limit-block">
                <label class="col-sm-3 control-label" for="input-limit"><?php echo $entry_limit; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $limit; ?>" type="text" name="limit" class="form-control" />
                  <div class="modal-error-block" id="modal-error-limit"></div>
                </div>
              </div>
              <div class="form-group show-comment-block">
                <label class="col-sm-3 control-label"><?php echo $entry_show_comment_icon; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_comment_icon == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_comment_icon"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_comment_icon == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_comment_icon == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_comment_icon"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_comment_icon == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group show-main-image-block">
                <label class="col-sm-3 control-label"><?php echo $entry_show_main_image; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_main_image == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_main_image"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_main_image == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_main_image == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_main_image"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_main_image == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group required dementions-of-main-image-block">
                <label class="col-sm-3 control-label"><?php echo $text_dementions_of_module_main_image; ?></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                    <input value="<?php echo $main_image_width; ?>" type="text" name="main_image_width" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="special-margin"></div>
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                    <input value="<?php echo $main_image_height; ?>" type="text" name="main_image_height" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="modal-error-block" id="modal-error-main-image-width"></div>
                  <div class="modal-error-block" id="modal-error-main-image-height"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_module_dementions_of_main_image; ?></div>
                </div>
              </div>
              <div class="form-group show-description-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_description; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_description == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_description"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_description == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_description == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_description"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_description == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group required description-limit-block">
                <label class="col-sm-3 control-label" for="input-description_limit"><?php echo $entry_description_limit; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $description_limit; ?>" type="text" name="description_limit" class="form-control" />
                  <div class="modal-error-block" id="modal-error-description-limit"></div>
                </div>
              </div>
              <div class="form-group show-count-viewed-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_count_viewed; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_count_viewed == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_count_viewed"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_count_viewed == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_count_viewed == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_count_viewed"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_count_viewed == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group show-count-comments-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_count_comments; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_count_comments == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_count_comments"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_count_comments == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_count_comments == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_count_comments"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_count_comments == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group show-author-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_author; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_author == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_author"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_author == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_author == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_author"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_author == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group show-read-more-button-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_read_more_button; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_read_more_button == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_read_more_button"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_read_more_button == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_read_more_button == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_read_more_button"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_read_more_button == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group show-date-added-block">
                <label class="col-sm-3 control-label"><?php echo $text_show_date_added; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $show_date_added == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_date_added"
                        value="1"
                        autocomplete="off"
                        <?php echo $show_date_added == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $show_date_added == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="show_date_added"
                        value="0"
                        autocomplete="off"
                        <?php echo $show_date_added == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group display-type-inner-block">
                <label class="col-sm-3 control-label"><?php echo $text_display_type_inner; ?></label>
                <div class="col-sm-9">
                  <select name="display_type_inner" class="form-control">
                    <option value="1" <?php echo $display_type_inner == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_display_type_inner_1; ?></option>
                    <option value="2" <?php echo $display_type_inner == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_display_type_inner_2; ?></option>
	                  <option value="3" <?php echo $display_type_inner == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_display_type_inner_3; ?></option>
	                  <option value="4" <?php echo $display_type_inner == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_display_type_inner_4; ?></option>
                  </select>
                  <div class="alert alert-info display-type-inner-1" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_display_type_inner_1_faq; ?></div>
                  <div class="alert alert-info display-type-inner-2" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_display_type_inner_2_faq; ?></div>
                  <div class="alert alert-info display-type-inner-3" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_display_type_inner_3_faq; ?></div>
                  <div class="alert alert-info display-type-inner-4" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_display_type_inner_4_faq; ?></div>
                </div>
              </div>
              <div class="form-group adaptive-setting-block required">
                <label class="col-sm-3 control-label"><?php echo $text_adaptive_setting; ?></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon">0 &#8680;</span>
                    <input value="<?php echo $adaptive_setting_0; ?>" type="text" name="adaptive_setting_0" class="form-control" />
                    <span class="input-group-addon">&#8678; 576 &#8680;</span>
                    <input value="<?php echo $adaptive_setting_1; ?>" type="text" name="adaptive_setting_1" class="form-control" />
                    <span class="input-group-addon">&#8678; 768 &#8680;</span>
                    <input value="<?php echo $adaptive_setting_2; ?>" type="text" name="adaptive_setting_2" class="form-control" />
                    <span class="input-group-addon">&#8678; 992 &#8680;</span>
                    <input value="<?php echo $adaptive_setting_3; ?>" type="text" name="adaptive_setting_3" class="form-control" />
                    <span class="input-group-addon">&#8678; 1200 &#8680;</span>
                    <input value="<?php echo $adaptive_setting_4; ?>" type="text" name="adaptive_setting_4" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-adaptive-setting-0"></div>
                  <div class="modal-error-block" id="modal-error-adaptive-setting-1"></div>
                  <div class="modal-error-block" id="modal-error-adaptive-setting-2"></div>
                  <div class="modal-error-block" id="modal-error-adaptive-setting-3"></div>
                  <div class="modal-error-block" id="modal-error-adaptive-setting-4"></div>
                </div>
              </div>
              <div class="form-group related-type-block">
                <label class="col-sm-3 control-label"><?php echo $text_related_type; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $related_type == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="related_type"
                        value="1"
                        autocomplete="off"
                        <?php echo $related_type == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_related_type_1; ?>
                    </label>
                    <label class="btn <?php echo $related_type == 2 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="related_type"
                        value="2"
                        autocomplete="off"
                        <?php echo $related_type == 2 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_related_type_2; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group module-related-post-block">
                <label class="col-sm-3 control-label"><?php echo $entry_module_related_post; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="related_post" value="" placeholder="<?php echo $placeholder_related_post; ?>" class="form-control" />
                  <?php $row_height = 55; $row = 0; foreach ($module_posts as $module_post) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div id="post-related" class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($module_posts as $module_post) { ?>
                    <div id="post-related<?php echo $module_post['post_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $module_post['name']; ?>
                      <input type="hidden" name="post_related[]" value="<?php echo $module_post['post_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-related"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group module-related-category-block">
                <label class="col-sm-3 control-label"><?php echo $entry_module_related_category; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="category" value="" placeholder="<?php echo $placeholder_category; ?>" class="form-control" />
                  <?php $row_height = 55; $row = 0; foreach ($module_categories as $module_category) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div id="post-category" class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($module_categories as $module_category) { ?>
                    <div id="post-category<?php echo $module_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $module_category['name']; ?>
                      <input type="hidden" name="category_related[]" value="<?php echo $module_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="modal-error-block" id="modal-error-category-related"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group sort-method-block">
                <label class="col-sm-3 control-label"><?php echo $text_sort_method; ?></label>
                <div class="col-sm-9">
                  <select name="sort_method" class="form-control">
                    <option value=""><?php echo $text_make_a_choice; ?></option>
                    <option value="1" id="sort-method-option-1" <?php echo $sort_method == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_1; ?></option>
                    <option value="2" id="sort-method-option-2" <?php echo $sort_method == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_2; ?></option>
	                  <option value="3" id="sort-method-option-3" <?php echo $sort_method == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_3; ?></option>
	                  <option value="4" id="sort-method-option-4" <?php echo $sort_method == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_4; ?></option>
	                  <option value="5" id="sort-method-option-5" <?php echo $sort_method == 5 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_5; ?></option>
	                  <option value="6" id="sort-method-option-6" <?php echo $sort_method == 6 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_6; ?></option>
	                  <option value="7" id="sort-method-option-7" <?php echo $sort_method == 7 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_7; ?></option>
	                  <option value="8" id="sort-method-option-8" <?php echo $sort_method == 8 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_8; ?></option>
	                  <option value="9" id="sort-method-option-9" <?php echo $sort_method == 9 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_9; ?></option>
	                  <option value="10" id="sort-method-option-10" <?php echo $sort_method == 10 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_10; ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- TAB Language block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-language-block">
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_name; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="module_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($module_description[$language['language_id']]) ? $module_description[$language['language_id']]['name'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-module-description-language-name-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group required read-more-language">
                <label class="col-sm-3 control-label"><?php echo $entry_read_more; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="module_description[<?php echo $language['language_id']; ?>][read_more]" value="<?php echo isset($module_description[$language['language_id']]) ? $module_description[$language['language_id']]['read_more'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-module-description-language-read-more-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="submit_module(this, <?php if ($module_id) { ?>'edit'<?php } else { ?>'add'<?php } ?>);"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" <?php if (!$module_id) { ?>style="display: none;"<?php } ?>><?php echo $button_close; ?></button>
  </div>
</div>
<script>
$('select[name=display_type]').change(function() {
  var val = $(this).val();

  if (val == 1) {
    $('.display-type-1').show();
    $('.display-type-2').hide();
    $('.display-type-3').hide();
    $('.display-type-4').hide();
    $('.display-type-5').hide();
    $('.display-type-6').hide();
    $('.limit-block').hide();
    $('.show-comment-block').hide();
    $('.show-main-image-block').hide();
    $('.dementions-of-main-image-block').hide();
    $('.show-description-block').hide();
    $('.description-limit-block').hide();
    $('.show-count-viewed-block').hide();
    $('.show-count-comments-block').hide();
    $('.show-author-block').hide();
    $('.show-read-more-button-block').hide();
    $('.show-date-added-block').hide();
    $('.display-type-inner-block').hide();
    $('.adaptive-setting-block').hide();
    $('.related-type-block').hide();
    $('.module-related-post-block').hide();
    $('.module-related-category-block').hide();
    $('.read-more-language').hide();
    $('.sort-method-block').show();
    $('#sort-method-option-1').hide();
    $('#sort-method-option-2').hide();
    $('#sort-method-option-3').hide();
    $('#sort-method-option-4').hide();
    $('#sort-method-option-5').show();
    $('#sort-method-option-6').show();
    $('#sort-method-option-7').hide();
    $('#sort-method-option-8').hide();
    $('#sort-method-option-9').hide();
    $('#sort-method-option-10').hide();
  } else if(val == 2) {
    $('.display-type-1').hide();
    $('.display-type-2').show();
    $('.display-type-3').hide();
    $('.display-type-4').hide();
    $('.display-type-5').hide();
    $('.display-type-6').hide();
    $('.limit-block').show();
    $('.show-comment-block').hide();
    $('.show-main-image-block').show();
    $('.dementions-of-main-image-block').show();
    $('.show-description-block').hide();
    $('.description-limit-block').hide();
    $('.show-count-viewed-block').hide();
    $('.show-count-comments-block').hide();
    $('.show-author-block').hide();
    $('.show-read-more-button-block').hide();
    $('.show-date-added-block').hide();
    $('.display-type-inner-block').hide();
    $('.adaptive-setting-block').hide();
    $('.related-type-block').show();
    $('.module-related-post-block').hide();
    if ($('input[name=related_type]:checked').val() == 2) {
      $('.module-related-category-block').show();
    } else {
      $('.module-related-category-block').hide();
    }
    $('.read-more-language').hide();
    $('.sort-method-block').show();
    $('#sort-method-option-1').show();
    $('#sort-method-option-2').show();
    $('#sort-method-option-3').show();
    $('#sort-method-option-4').show();
    $('#sort-method-option-5').show();
    $('#sort-method-option-6').show();
    $('#sort-method-option-7').hide();
    $('#sort-method-option-8').hide();
    $('#sort-method-option-9').hide();
    $('#sort-method-option-10').hide();
  } else if(val == 3) {
    $('.display-type-1').hide();
    $('.display-type-2').hide();
    $('.display-type-3').show();
    $('.display-type-4').hide();
    $('.display-type-5').hide();
    $('.display-type-6').hide();
    $('.limit-block').show();
    $('.show-comment-block').show();
    $('.show-main-image-block').hide();
    $('.dementions-of-main-image-block').hide();
    $('.show-description-block').hide();
    $('.description-limit-block').show();
    $('.show-count-viewed-block').hide();
    $('.show-count-comments-block').hide();
    $('.show-author-block').hide();
    $('.show-read-more-button-block').hide();
    $('.show-date-added-block').hide();
    $('.display-type-inner-block').show();
    if ($('select[name=display_type_inner]').val() == 3 || $('select[name=display_type_inner]').val() == 4) {
      $('.adaptive-setting-block').show();
    } else {
      $('.adaptive-setting-block').hide();
    }
    $('.related-type-block').hide();
    $('.module-related-post-block').hide();
    $('.module-related-category-block').hide();
    $('.read-more-language').hide();
    $('.sort-method-block').show();
    $('#sort-method-option-1').hide();
    $('#sort-method-option-2').hide();
    $('#sort-method-option-3').hide();
    $('#sort-method-option-4').hide();
    $('#sort-method-option-5').show();
    $('#sort-method-option-6').show();
    $('#sort-method-option-7').hide();
    $('#sort-method-option-8').hide();
    $('#sort-method-option-9').hide();
    $('#sort-method-option-10').hide();
  } else if(val == 4) {
    $('.display-type-1').hide();
    $('.display-type-2').hide();
    $('.display-type-3').hide();
    $('.display-type-4').show();
    $('.display-type-5').hide();
    $('.display-type-6').hide();
    $('.limit-block').hide();
    $('.show-comment-block').hide();
    $('.show-main-image-block').hide();
    $('.dementions-of-main-image-block').hide();
    $('.show-description-block').hide();
    $('.description-limit-block').hide();
    $('.show-count-viewed-block').hide();
    $('.show-count-comments-block').hide();
    $('.show-author-block').hide();
    $('.show-read-more-button-block').hide();
    $('.show-date-added-block').hide();
    $('.display-type-inner-block').hide();
    $('.adaptive-setting-block').hide();
    $('.related-type-block').hide();
    $('.module-related-post-block').hide();
    $('.module-related-category-block').hide();
    $('.read-more-language').hide();
    $('.sort-method-block').hide();
  } else if(val == 5) {
    $('.display-type-1').hide();
    $('.display-type-2').hide();
    $('.display-type-3').hide();
    $('.display-type-4').hide();
    $('.display-type-5').show();
    $('.display-type-6').hide();
    $('.limit-block').show();
    $('.show-comment-block').hide();
    $('.show-main-image-block').hide();
    $('.dementions-of-main-image-block').hide();
    $('.show-description-block').hide();
    $('.description-limit-block').hide();
    $('.show-count-viewed-block').hide();
    $('.show-count-comments-block').hide();
    $('.show-author-block').hide();
    $('.show-read-more-button-block').hide();
    $('.show-date-added-block').hide();
    $('.display-type-inner-block').hide();
    $('.adaptive-setting-block').hide();
    $('.related-type-block').hide();
    $('.module-related-post-block').hide();
    $('.module-related-category-block').hide();
    $('.read-more-language').hide();
    $('.sort-method-block').show();
    $('#sort-method-option-1').show();
    $('#sort-method-option-2').show();
    $('#sort-method-option-3').hide();
    $('#sort-method-option-4').hide();
    $('#sort-method-option-5').hide();
    $('#sort-method-option-6').hide();
    $('#sort-method-option-7').hide();
    $('#sort-method-option-8').hide();
    $('#sort-method-option-9').hide();
    $('#sort-method-option-10').hide();
  } else if(val == 6) {
    $('.display-type-1').hide();
    $('.display-type-2').hide();
    $('.display-type-3').hide();
    $('.display-type-4').hide();
    $('.display-type-5').hide();
    $('.display-type-6').show();
    $('.limit-block').show();
    $('.show-comment-block').hide();
    $('.show-main-image-block').show();
    $('.dementions-of-main-image-block').show();
    $('.show-description-block').show();
    $('.description-limit-block').show();
    $('.show-count-viewed-block').show();
    $('.show-count-comments-block').show();
    $('.show-author-block').show();
    $('.show-read-more-button-block').show();
    $('.show-date-added-block').show();
    $('.display-type-inner-block').show();
    if ($('select[name=display_type_inner]').val() == 3 || $('select[name=display_type_inner]').val() == 4) {
      $('.adaptive-setting-block').show();
    } else {
      $('.adaptive-setting-block').hide();
    }
    $('.related-type-block').show();
    if ($('input[name=related_type]:checked').val() == 2) {
      $('.module-related-post-block').show();
    } else {
      $('.module-related-post-block').hide();
    }
    $('.module-related-category-block').hide();
    $('.read-more-language').show();
    $('.sort-method-block').show();
    $('#sort-method-option-1').show();
    $('#sort-method-option-2').show();
    $('#sort-method-option-3').show();
    $('#sort-method-option-4').show();
    $('#sort-method-option-5').show();
    $('#sort-method-option-6').show();
    $('#sort-method-option-7').show();
    $('#sort-method-option-8').show();
    $('#sort-method-option-9').show();
    $('#sort-method-option-10').show();
  }
});

$('input[name=related_type]').change(function() {
  var val = $(this).val();
  
  if ($('select[name=display_type]').val() == 6) {
    if (val == 1) {
      $('.module-related-post-block').hide();
    } else {
      $('.module-related-post-block').show();
    }
  }

  if ($('select[name=display_type]').val() == 2) {
    if (val == 1) {
      $('.module-related-category-block').hide();
    } else {
      $('.module-related-category-block').show();
    }
  }
});

$('select[name=display_type_inner]').change(function() {
  var val = $(this).val();

  if (val == 1) {
    $('.display-type-inner-1').show();
    $('.display-type-inner-2').hide();
    $('.display-type-inner-3').hide();
    $('.display-type-inner-4').hide();
    $('.adaptive-setting-block').hide();
  } else if (val == 2) {
    $('.display-type-inner-1').hide();
    $('.display-type-inner-2').show();
    $('.display-type-inner-3').hide();
    $('.display-type-inner-4').hide();
    $('.adaptive-setting-block').hide();
  } else if (val == 3) {
    $('.display-type-inner-1').hide();
    $('.display-type-inner-2').hide();
    $('.display-type-inner-3').show();
    $('.display-type-inner-4').hide();
    $('.adaptive-setting-block').show();
  } else if (val == 4) {
    $('.display-type-inner-1').hide();
    $('.display-type-inner-2').hide();
    $('.display-type-inner-3').hide();
    $('.display-type-inner-4').show();
    $('.adaptive-setting-block').show();
  }
});

$('select[name=display_type_inner]').trigger('change');

$('select[name=display_type]').trigger('change');

$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_category&<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					category_id: 0,
					name: '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
          if (item['category_id']) {
            return {
              label: item['name'],
              value: item['category_id']
            }
          }
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'category\']').val('');
    $('#post-category' + item['value']).remove();
    $('#post-category').append('<div id="post-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#post-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('input[name=\'related_post\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_post&<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					post_id: 0,
					name: '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
					if (item['post_id']) {
            return {
              label: item['name'],
              value: item['post_id']
            }
          }
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'related_post\']').val('');
    $('#post-related' + item['value']).remove();
    $('#post-related').append('<div id="post-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="post_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#post-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script>
<!-- start: code for module usability -->
<script>
$('.btn-toggle').on('click', '.btn', function() {
  if(!$(this).hasClass('disabled')){
    $(this).addClass('btn-success').siblings().removeClass('btn-success').addClass('btn-default');
  }
});

$('.btn-toggle').on('click', '.disabled', function() {
  return false;
});
</script>
<!-- end: code for module usability -->
</div>
