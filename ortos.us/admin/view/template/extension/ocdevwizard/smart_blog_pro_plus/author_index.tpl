<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<div class="modal-content" id="modal-author-constructor-content">
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
              <li><a href="#modal-author-general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
              <li><a href="#modal-author-basic-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_basic_setting; ?></a></li>
              <li><a href="#modal-author-layout-block" data-toggle="tab"><i class="fa fa-eye"></i> <?php echo $tab_layout_setting; ?></a></li>
              <li><a href="#modal-author-image-block" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo $tab_image_setting; ?></a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i> <?php echo $tab_language_setting; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-author-language-block" data-toggle="tab"><i class="fa fa-flag-o"></i> <?php echo $tab_basic_language_setting; ?></a></li>
            </ul>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="author_id" value="<?php echo $author_id; ?>" />
          <div class="tab-content">
            <!-- TAB General block -->
            <div class="tab-pane fade active in" role="tabpanel" id="modal-author-general-block">
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
                          name="author_store[]"
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
                  <div class="modal-error-block" id="modal-error-author-store"></div>
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
                          name="author_customer_group[]"
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
                  <div class="modal-error-block" id="modal-error-author-customer-group"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_customer_groups_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label" for="input-keyword"><?php echo $entry_keyword; ?></label>
                <div class="col-sm-9">
                  <?php if ($is_opencart_3000) { ?>
                    <?php foreach ($all_stores as $store) { ?>
                      <?php foreach ($languages as $language) { ?>
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo $store['name']; ?></span>
                          <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                          <input type="text" name="keyword[<?php echo $store['store_id']; ?>][<?php echo $language['language_id']; ?>]" value="<?php if (isset($keyword[$store['store_id']][$language['language_id']]) && $keyword[$store['store_id']][$language['language_id']]) { ?><?php echo $keyword[$store['store_id']][$language['language_id']]; ?><?php } ?>" class="form-control" />
                        </div>
                        <div class="modal-error-block" id="modal-error-keyword-<?php echo $store.store_id; ?>-<?php echo $language['language_id']; ?>"></div>
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    <input value="<?php echo $keyword; ?>" type="text" name="keyword" class="form-control" />
                    <div class="modal-error-block" id="modal-error-keyword"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_keyword_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-sort_order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $sort_order; ?>" type="text" name="sort_order" class="form-control" />
                  <div class="modal-error-block" id="modal-error-sort-order"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $text_sort_method; ?></label>
                <div class="col-sm-9">
                  <select name="sort_method" class="form-control">
                    <option value=""><?php echo $text_make_a_choice; ?></option>
                    <option value="1" <?php echo $sort_method == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_1; ?></option>
                    <option value="2" <?php echo $sort_method == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_2; ?></option>
                    <option value="3" <?php echo $sort_method == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_3; ?></option>
                    <option value="4" <?php echo $sort_method == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_4; ?></option>
                    <option value="5" <?php echo $sort_method == 5 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_5; ?></option>
                    <option value="6" <?php echo $sort_method == 6 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_6; ?></option>
                    <option value="7" <?php echo $sort_method == 7 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_7; ?></option>
                    <option value="8" <?php echo $sort_method == 8 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_8; ?></option>
                    <option value="9" <?php echo $sort_method == 9 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_9; ?></option>
                    <option value="10" <?php echo $sort_method == 10 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_10; ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- TAB Basic block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-author-basic-block">
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_design; ?></label>
                <div class="col-sm-9">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <td class="text-left"><?php echo $entry_store; ?></td>
                          <td class="text-left"><?php echo $entry_layout; ?></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($all_stores as $store) { ?>
                          <tr>
                            <td class="text-left"><?php echo $store['name']; ?></td>
                            <td class="text-left">
                              <select name="author_layout[<?php echo $store['store_id']; ?>]" class="form-control input-sm">
                                <option value=""></option>
                                <?php foreach ($all_layouts as $layout) { ?>
                                <?php if (isset($author_layout[$store['store_id']]) && $author_layout[$store['store_id']] == $layout['layout_id']) { ?>
                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Layout block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-author-layout-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-show_description"><?php echo $entry_show_description; ?></label>
                <div class="col-sm-9">
                  <select name="show_description" id="input-show_description" class="form-control">
                    <?php if ($show_description) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-description_position"><?php echo $entry_description_position; ?></label>
                <div class="col-sm-9">
                  <select name="description_position" id="input-description_position" class="form-control">
                    <?php if ($description_position == 1) { ?>
                    <option value="1" selected="selected"><?php echo $text_description_position_1; ?></option>
                    <option value="2"><?php echo $text_description_position_2; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_description_position_1; ?></option>
                    <option value="2" selected="selected"><?php echo $text_description_position_2; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- TAB Image block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-author-image-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-show_main_image"><?php echo $entry_show_main_image; ?></label>
                <div class="col-sm-9">
                  <select name="show_main_image" id="input-show_main_image" class="form-control">
                    <?php if ($show_main_image) { ?>
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
                <label class="col-sm-3 control-label"><?php echo $text_dementions_of_main_image; ?></label>
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
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_main_image; ?></label>
                <div class="col-sm-9">
                  <a href="" id="thumb-image0" data-toggle="image_author" data-imgid="0" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image0" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $text_dementions_of_main_image_popup; ?></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                    <input value="<?php echo $additional_image_popup_width; ?>" type="text" name="additional_image_popup_width" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="special-margin"></div>
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                    <input value="<?php echo $additional_image_popup_height; ?>" type="text" name="additional_image_popup_height" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="modal-error-block" id="modal-error-additional-image-popup-width"></div>
                  <div class="modal-error-block" id="modal-error-additional-image-popup-height"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-show_additional_image"><?php echo $entry_show_additional_image; ?></label>
                <div class="col-sm-9">
                  <select name="show_additional_image" id="input-show_additional_image" class="form-control">
                    <?php if ($show_additional_image) { ?>
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
                <label class="col-sm-3 control-label"><?php echo $text_dementions_of_additional_image; ?></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                    <input value="<?php echo $additional_image_width; ?>" type="text" name="additional_image_width" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="special-margin"></div>
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                    <input value="<?php echo $additional_image_height; ?>" type="text" name="additional_image_height" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="modal-error-block" id="modal-error-additional-image-width"></div>
                  <div class="modal-error-block" id="modal-error-additional-image-height"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_additional_image; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_additional_image; ?></label>
                <div class="col-sm-9">
                  <div class="table-responsive">
                    <table id="images" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <td class="text-left"><?php echo $column_image; ?></td>
                          <td class="text-right"><?php echo $column_sort_order; ?></td>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                         <tr><td colspan="3" style="padding: 0"></td></tr>
                        <?php $image_row = 1; ?>
                        <?php foreach ($author_images as $author_image) { ?>
                        <tr id="image-row<?php echo $image_row; ?>">
                          <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image_author" data-imgid="<?php echo $image_row; ?>" class="img-thumbnail"><img src="<?php echo $author_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="author_image[<?php echo $image_row; ?>][image]" value="<?php echo $author_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                          <td class="text-right"><input type="text" name="author_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $author_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                          <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <?php $image_row++; ?>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2"></td>
                          <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_image_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- TAB Language block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-author-language-block">
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_name; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="author_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['name'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-name-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_name_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_meta_title; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="author_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['meta_title'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-meta-title-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_meta_title_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_description; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="author_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['description'] : ''; ?></textarea>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>'});"><?php echo $text_open_texteditor; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>', start: false, destroy: true});" style="display: none;"><?php echo $text_save_texteditor; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-description-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_meta_description; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="author_description[<?php echo $language['language_id']; ?>][meta_description]" id="meta_description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-meta-description-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_meta_description_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_meta_keyword; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="author_description[<?php echo $language['language_id']; ?>][meta_keyword]" id="meta_keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-meta-keyword-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_meta_keyword_faq; ?></div>
                </div>
              </div>
              <div class="form-group pro-block">
                <label class="col-sm-3 control-label"><?php echo $entry_main_image_alt; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="author_description[<?php echo $language['language_id']; ?>][main_image_alt]" id="main_image_alt<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($author_description[$language['language_id']]) ? $author_description[$language['language_id']]['main_image_alt'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-author-description-language-main-image-alt-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_main_image_alt_faq; ?></div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="submit_author(this, <?php if ($author_id) { ?>'edit'<?php } else { ?>'add'<?php } ?>);"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" <?php if (!$author_id) { ?>style="display: none;"<?php } ?>><?php echo $button_close; ?></button>
  </div>
</div>
<!-- start: code for tab image setting -->
<script>
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image_author" data-imgid="' + image_row + '" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="author_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="author_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}
</script>
<!-- end: code for tab image setting -->
<!-- start: code for module usability -->
<script>
$(document).on("click", "a.thumbnail", "event", function(e) {
  e.preventDefault();
  set_image(this, $('#modal-image').data('imgid'), 'author');
  return;
});

$(function() {
  if ($('#modal-author-constructor-content .pro-block').length) {
    $('#modal-author-constructor-content .pro-block').each(function(index) {
      $(this).find('.control-label').append('<div class="clear"></div><div class="label label-info" style="text-transform: uppercase;"><?php echo $text_exclusive; ?></div>');
      // $(this).find('input[type=\'radio\'], input[type=\'checkbox\'], select, button').attr('disabled', true);
      // $(this).find('input[type=\'text\'], textarea').on('focus', function(){ alert('<?php echo $text_exclusive; ?>'); });
      // $(this).find('label').addClass('disabled');
      // $(this).addClass('pro-version-only');
    });
  }
});
</script>
<!-- end: code for module usability -->
</div>
