<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<div class="modal-content" id="modal-post-constructor-content">
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
              <li><a href="#modal-post-general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
              <li><a href="#modal-post-basic-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_basic_setting; ?></a></li>
              <li><a href="#modal-post-layout-block" data-toggle="tab"><i class="fa fa-eye"></i> <?php echo $tab_layout_setting; ?></a></li>
              <li><a href="#modal-post-image-block" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo $tab_image_setting; ?></a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i> <?php echo $tab_language_setting; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-post-language-block" data-toggle="tab"><i class="fa fa-flag-o"></i> <?php echo $tab_basic_language_setting; ?></a></li>
            </ul>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="post_id" value="<?php echo $post_id; ?>" />
          <div class="tab-content">
            <!-- TAB General block -->
            <div class="tab-pane fade active in" role="tabpanel" id="modal-post-general-block">
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
                          name="post_store[]"
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
                  <div class="modal-error-block" id="modal-error-post-store"></div>
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
                          name="post_customer_group[]"
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
                  <div class="modal-error-block" id="modal-error-post-customer-group"></div>
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
            </div>
            <!-- TAB Basic block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-post-basic-block">
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_date_available; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="date_available" value="<?php echo $date_available; ?>" placeholder="<?php echo $placeholder_date_available; ?>" class="form-control" />
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                  </div>
                </div>
                <div class="col-sm-offset-6"></div>
              </div>
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
                              <select name="post_layout[<?php echo $store['store_id']; ?>]" class="form-control input-sm">
                                <option value=""></option>
                                <?php foreach ($all_layouts as $layout) { ?>
                                <?php if (isset($post_layout[$store['store_id']]) && $post_layout[$store['store_id']] == $layout['layout_id']) { ?>
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
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_author; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="author" value="<?php echo $author; ?>" placeholder="<?php echo $placeholder_author; ?>" class="form-control" />
                  <input type="hidden" name="author_id" value="<?php echo $author_id; ?>" />
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_post_main_category; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="main_category" value="<?php echo $main_category; ?>" placeholder="<?php echo $placeholder_category; ?>" class="form-control" />
                  <input type="hidden" name="main_category_id" value="<?php echo $main_category_id; ?>"/>
                  <div class="modal-error-block" id="modal-error-main-category-id"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_post_related_category; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="category" value="" placeholder="<?php echo $placeholder_category; ?>" class="form-control" />
                  <?php $row_height = 55; $row = 0; foreach ($post_categories as $post_category) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div id="post-category" class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($post_categories as $post_category) { ?>
                    <div id="post-category<?php echo $post_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $post_category['name']; ?>
                      <input type="hidden" name="post_category[]" value="<?php echo $post_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_post_related; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="related_post" value="" placeholder="<?php echo $placeholder_related_post; ?>" class="form-control" />
                  <?php $row_height = 55; $row = 0; foreach ($post_relateds as $post_related) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div id="post-related" class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($post_relateds as $post_related) { ?>
                    <div id="post-related<?php echo $post_related['post_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $post_related['name']; ?>
                      <input type="hidden" name="post_related[]" value="<?php echo $post_related['post_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_product_related; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="related_product" value="" placeholder="<?php echo $placeholder_product; ?>" class="form-control" />
                  <?php $row_height = 55; $row = 0; foreach ($product_relateds as $product_related) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div id="product-related" class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($product_relateds as $product_related) { ?>
                    <div id="product-related<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                      <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Layout block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-post-layout-block">
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
            </div>
            <!-- TAB Image block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-post-image-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-show_main_image"><?php echo $entry_show_post_main_image; ?></label>
                <div class="col-sm-9">
                  <select name="show_main_image" id="input-show_main_image" class="form-control">
                    <option value="1" <?php if ($show_main_image == 1) { ?>selected="selected"<?php } ?>><?php echo $entry_show_post_main_image_1; ?></option>
                    <option value="2" <?php if ($show_main_image == 2) { ?>selected="selected"<?php } ?>><?php echo $entry_show_post_main_image_2; ?> (<?php echo $text_exclusive; ?>)</option>
                    <option value="0" <?php if (empty($show_main_image)) { ?>selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group required show-main-image-1">
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
              <div class="form-group required show-main-image-1">
                <label class="col-sm-3 control-label"><?php echo $text_dementions_of_main_image_popup; ?></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                    <input value="<?php echo $main_image_popup_width; ?>" type="text" name="main_image_popup_width" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="special-margin"></div>
                  <div class="input-group">
                    <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                    <input value="<?php echo $main_image_popup_height; ?>" type="text" name="main_image_popup_height" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                    <span class="input-group-addon"><?php echo $text_px; ?></span>
                  </div>
                  <div class="modal-error-block" id="modal-error-main-image-popup-width"></div>
                  <div class="modal-error-block" id="modal-error-main-image-popup-height"></div>
                </div>
              </div>
              <div class="form-group show-main-image-1">
                <label class="col-sm-3 control-label"><?php echo $entry_main_image; ?></label>
                <div class="col-sm-9">
                  <a href="" id="thumb-image0" data-toggle="image_post" data-imgid="0" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image0" />
                </div>
              </div>
              <div class="form-group required show-main-image-2 pro-block">
                <label class="col-sm-3 control-label" for="input-video"><?php echo $entry_main_video; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $video; ?>" type="text" name="video" class="form-control" />
                  <div class="modal-error-block" id="modal-error-video"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $entry_main_video_faq; ?></div>
                </div>
              </div>
              <div class="form-group show-main-image-2 pro-block">
                <label class="col-sm-3 control-label" for="input-video_show_type"><?php echo $entry_video_show_type; ?></label>
                <div class="col-sm-9">
                  <select name="video_show_type" id="input-video_show_type" class="form-control">
                    <?php if ($video_show_type == 1) { ?>
                    <option value="1" selected="selected"><?php echo $entry_video_show_type_1; ?></option>
                    <option value="2"><?php echo $entry_video_show_type_2; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $entry_video_show_type_1; ?></option>
                    <option value="2" selected="selected"><?php echo $entry_video_show_type_2; ?></option>
                    <?php } ?>
                  </select>
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
                        <?php foreach ($post_images as $post_image) { ?>
                        <tr id="image-row<?php echo $image_row; ?>">
                          <td class="text-left"><a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image_post" data-imgid="<?php echo $image_row; ?>" class="img-thumbnail"><img src="<?php echo $post_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="post_image[<?php echo $image_row; ?>][image]" value="<?php echo $post_image['image']; ?>" id="input-image<?php echo $image_row; ?>" /></td>
                          <td class="text-right"><input type="text" name="post_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $post_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
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
            <div class="tab-pane fade" role="tabpanel" id="modal-post-language-block">
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_name; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="post_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['name'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-name-<?php echo $language['language_id']; ?>"></div>
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
                    <input type="text" name="post_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['meta_title'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-meta-title-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_meta_title_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_tag; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="post_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['tag'] : ''; ?>" class="form-control" />
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-tag-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_short_description; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="post_description[<?php echo $language['language_id']; ?>][short_description]" id="short_description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['short_description'] : ''; ?></textarea>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#short_description<?php echo $language['language_id']; ?>'});"><?php echo $text_open_texteditor; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#short_description<?php echo $language['language_id']; ?>', start: false, destroy: true});" style="display: none;"><?php echo $text_save_texteditor; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-short-description-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $entry_short_description_faq; ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_description; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="post_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['description'] : ''; ?></textarea>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>'});"><?php echo $text_open_texteditor; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>', start: false, destroy: true});" style="display: none;"><?php echo $text_save_texteditor; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-description-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_meta_description; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="post_description[<?php echo $language['language_id']; ?>][meta_description]" id="meta_description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-meta-description-<?php echo $language['language_id']; ?>"></div>
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
                    <textarea name="post_description[<?php echo $language['language_id']; ?>][meta_keyword]" id="meta_keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-meta-keyword-<?php echo $language['language_id']; ?>"></div>
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
                    <textarea name="post_description[<?php echo $language['language_id']; ?>][main_image_alt]" id="main_image_alt<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($post_description[$language['language_id']]) ? $post_description[$language['language_id']]['main_image_alt'] : ''; ?></textarea>
                  </div>
                  <div class="modal-error-block" id="modal-error-post-description-language-main-image-alt-<?php echo $language['language_id']; ?>"></div>
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
    <button type="button" class="btn btn-info" onclick="submit_post(this, <?php if ($post_id) { ?>'edit'<?php } else { ?>'add'<?php } ?>);"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" <?php if (!$post_id) { ?>style="display: none;"<?php } ?>><?php echo $button_close; ?></button>
  </div>
</div>
<!-- start: code for DateTimePicker -->
<script type="text/javascript">
$('.date').datetimepicker({
  format: 'YYYY-MM-DD',
  pickDate: true,
  pickTime: true
});
</script>
<!-- end: code for DateTimePicker -->
<!-- start: code for tab basic setting -->
<script>
$('input[name=\'author\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_author&<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					author_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
            value: item['author_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'author\']').val(item['label']);
    $('input[name=\'author_id\']').val(item['value']);
  }
});

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
          return {
            label: item['name'],
            value: item['category_id']
          }
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'category\']').val('');
    $('#post-category' + item['value']).remove();
    $('#post-category').append('<div id="post-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="post_category[]" value="' + item['value'] + '" /></div>');
	}
});

$('#post-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('input[name=\'main_category\']').autocomplete({
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
          return {
            label: item['name'],
            value: item['category_id']
          }
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'main_category\']').val(item['label']);
    $('input[name=\'main_category_id\']').val(item['value']);
  }
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
					if (item['post_id'] && item['post_id'] != '<?php echo $post_id; ?>') {
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

$('input[name=\'related_product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_product&<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					product_id: 0,
					name: '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'related_product\']').val('');
    $('#product-related' + item['value']).remove();
    $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
	}
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script>
<!-- end: code for tab general setting -->
<!-- start: code for tab image setting -->
<script>
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '" data-toggle="image_post" data-imgid="' + image_row + '" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="post_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
	html += '  <td class="text-right"><input type="text" name="post_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}

$('select[name=show_main_image]').change(function() {
  var val = $(this).val();

  if (val == 1) {
    $('.show-main-image-1').show();
    $('.show-main-image-2').hide();
  } else if(val == 2) {
    $('.show-main-image-1').hide();
    $('.show-main-image-2').show();
  } else {
    $('.show-main-image-1').hide();
    $('.show-main-image-2').hide();
  }
});

$('select[name=show_main_image]').trigger('change');
</script>
<!-- end: code for tab image setting -->
<!-- start: code for module usability -->
<script>
$(document).on("click", "a.thumbnail", "event", function(e) {
  e.preventDefault();
  set_image(this, $('#modal-image').data('imgid'), 'post');
  return;
});

$(function() {
  if ($('#modal-post-constructor-content .pro-block').length) {
    $('#modal-post-constructor-content .pro-block').each(function(index) {
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
