<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a onclick="apply();" data-toggle="tooltip" title="<?php echo $button_apply; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
        <button type="submit" form="form-yummenu" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" style="right:0; left:auto;">
            <li><a href="<?php echo $setting_export; ?>"><i class="fa fa-download"></i> <?php echo $button_export; ?></a></li>
            <li><a onclick="setting();"><i class="fa fa-upload"></i> <?php echo $button_import; ?></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo $delete_module; ?>"><i class="fa fa-times" style="color:#d9534f" aria-hidden="true"></i> <?php echo $button_delete; ?></a></li>
          </ul>
        </div>
        </div>
      <h1><?php echo $heading_title; ?></h1>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?>
        <?php if (!empty($name)) { ?>
        <?php echo '"'.$name.'"'; ?>
        <?php } ?>
        </h3>
        <h4 class="apply-fb pull-right"></h4>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-yummenu" class="form-horizontal">
          <ul class="nav nav-tabs" id="tablist" role="tablist">
            <li><a href="#tab-menu-structure" role="tab" data-toggle="tab"><i class="fa fa-bars" aria-hidden="true"></i><span><?php echo $tab_menu_structure; ?></span></a></li>
            <li><a href="#tab-menu-options" role="tab" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i><span><?php echo $tab_menu_options; ?></span></a></li>
            <li><a href="#tab-module-setting" role="tab" data-toggle="tab"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><span><?php echo $tab_setting; ?></span></a></li>
          </ul>
          <div class="tab-content">
            <div id="tab-menu-structure" class="tab-pane output-forms">
              <div class="form-group" style="margin-bottom: 10px;">
                <label class="col-md-3 col-lg-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_html; ?>"><?php echo $entry_title; ?></span></label>
                <div class="col-md-9 col-lg-10">
                  <?php foreach ($languages as $language) { ?>
                  <?php if ($language['status']) { ?>
                  <div class="input-group">
                      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                      <input type="text" name="menu[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($menu[$language['language_id']]['title']) ? $menu[$language['language_id']]['title'] : $entry_title; ?>" class="form-control" />
                      <span class="input-group-addon">
                          <?php if (!empty($menu[$language['language_id']]['title_status'])) { ?>
                          <input type="checkbox" name="menu[<?php echo $language['language_id']; ?>][title_status]" value="1" checked="checked" />
                          <?php } else { ?>
                          <input type="checkbox" name="menu[<?php echo $language['language_id']; ?>][title_status]" value="1" />
                          <?php } ?>
                      </span>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group" style="padding-top: 20px;">
                <label class="col-md-3 col-lg-2 control-label"><?php echo $entry_menu_items; ?></label>
                <div class="col-md-9 col-lg-10" id="menu-items">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default arrow-bottom">
                    <input type="radio" name="structure[items]" value="categories" <?php echo empty($structure['items']) || $structure['items'] == 'categories' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-option').show().siblings('.item-option').hide();}" />
                      <?php echo $text_categories; ?> </label>
                    <label class="btn btn-default arrow-bottom">
                      <input type="radio" name="structure[items]" value="manufacturers" <?php echo isset($structure['items']) && $structure['items'] == 'manufacturers' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#manufacturers-option').show().siblings('.item-option').hide();}" />
                      <?php echo $text_manufacturers; ?> </label>
                    <label class="btn btn-default arrow-bottom">
                      <input type="radio" name="structure[items]" value="informations" <?php echo isset($structure['items']) && $structure['items'] == 'informations' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#informations-option').show().siblings('.item-option').hide();}" />
                      <?php echo $text_informations; ?> </label>
                    <label class="btn btn-default arrow-bottom">
                      <input type="radio" name="structure[items]" value="products" <?php echo isset($structure['items']) && $structure['items'] == 'products' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#products-option').show().siblings('.item-option').hide();}" />
                      <?php echo $text_products; ?> </label>
                    <label class="btn btn-default arrow-bottom">
                      <input type="radio" name="structure[items]" value="custom" <?php echo isset($structure['items']) && $structure['items'] == 'custom' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#custom-option').show().siblings('.item-option').hide();}" />
                      <?php echo $text_custom; ?> </label>
                  </div>
                </div>
              </div>
              <div class="item-option" id="categories-option" <?php echo isset($structure['items']) && $structure['items'] == 'categories' ? '' : 'style="display:none;"'; ?>>
                <div class="form-group">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-default arrow-bottom">
                        <input type="radio" name="structure[cat_option]" value="selective" <?php echo empty($structure['cat_option']) || $structure['cat_option'] == 'selective' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-selective').show().siblings('.cat-options').hide(); $('#nesting-levels').hide(); $('#combine-selected').show();}" />
                        <?php echo $text_selective; ?>
                      </label>
                      <label class="btn btn-default arrow-bottom">
                        <input type="radio" name="structure[cat_option]" value="parent" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'parent' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-parent').show().siblings('.cat-options').hide();$('#nesting-levels').show(); $('#combine-selected').hide();}" />
                        <?php echo $text_parent; ?>
                      </label>
                      <label class="btn btn-default arrow-bottom">
                        <input type="radio" name="structure[cat_option]" value="current" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'current' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-current').show().siblings('.cat-options').hide();$('#nesting-levels').show(); $('#combine-selected').hide();}" />
                        <?php echo $text_current; ?>
                      </label>
                      <label class="btn btn-default arrow-bottom">
                        <input type="radio" name="structure[cat_option]" value="subcurrent" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'subcurrent' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-subcurrent').show().siblings('.cat-options').hide();$('#nesting-levels').show(); $('#combine-selected').hide();}" />
                        <?php echo $text_subcurrent; ?>
                      </label>
                      <label class="btn btn-default arrow-bottom">
                        <input type="radio" name="structure[cat_option]" value="levels" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'levels' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#categories-levels').show().siblings('.cat-options').hide();$('#nesting-levels').hide(); $('#combine-selected').hide();}" />
                        <?php echo $text_range; ?>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="menu[hide_empty_cats]" value="1" id="cats-hide" onchange="if($(this).prop('checked')){$('#custom-cats-hide').prop('checked', true);} else {$('#custom-cats-hide').prop('checked',false);}" <?php echo isset($menu['hide_empty_cats']) ? 'checked="checked"' : ''; ?> />
                      <?php echo $text_hide_empty_cats; ?> </label>
                    <label class="checkbox-inline" id="combine-selected" <?php echo $structure['cat_option'] == 'selective' ? '' : 'style="display:none;"'; ?>>
                      <input type="checkbox" name="menu[combine_selected]" value="1" <?php echo isset($menu['combine_selected']) ? 'checked="checked"' : ''; ?> />
                      <?php echo $text_combine_selected; ?> </label>
                  </div>
                </div>
                <div id="nesting-levels" class="row" <?php echo empty($structure['cat_option']) || $structure['cat_option'] == 'selective' || $structure['cat_option'] == 'levels' ? 'style="display:none;"' : ''; ?>>
                  <div class="col-xs-4 col-md-2 col-md-offset-3 col-lg-offset-2">
                    <input type="text" name="menu[nesting_levels]" value="<?php echo !empty($menu['nesting_levels']) ? $menu['nesting_levels'] : ''; ?>" class="form-control" style="margin: 10px 0;">
                  </div>
                  <div class="col-xs-6">
                    <span style="line-height: 55px; margin-left: -15px;"><?php echo $text_nesting; ?></span>
                  </div>
                </div>
                <div class="form-group cat-options" id="categories-selective" <?php echo empty($structure['cat_option']) || $structure['cat_option'] == 'selective' || $structure['cat_option'] == 'all' ? 'style="border-top:none;"' : 'style="display:none; border-top:none;"'; ?>>
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_select; ?></div>
                    <div class="well well-sm">
                      <div id="categories-tree">
                          <ul>
                            <li id="all-categories" <?php echo $structure['all_categories'] ? 'data-jstree=\'{"opened":true,"selected":true}\'' : 'data-jstree=\'{"opened":true,"selected":false}\''; ?>>
                              <?php echo $text_allcats; ?>
                              <?php echo $categories; ?>
                            </li>
                          </ul>
                      </div>
                      <input type="hidden" name="structure[categories]" value="" />
                      <input type="hidden" name="structure[all_categories]" value="" />
                    </div>
                    <br>
                    <div class="btn-group btn-group-sm" role="group" data-toggle="buttons">
                      <button type="button" class="btn btn-default select-all"><?php echo $text_select_all; ?></button>
                      <button type="button" class="btn btn-default deselect-all"><?php echo $text_unselect_all; ?></button>
                      <label class="btn btn-default btn-sm auto-select">
                        <input type="checkbox" value="" />
                        <?php echo $text_auto_select; ?> </label>
                    </div>
                  </div>
                </div>
                <div class="form-group cat-options" id="categories-parent" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'parent' ? 'style="border-top:none;"' : 'style="display:none; border-top:none;"'; ?>>
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_parent; ?></div>
                  </div>
                </div>
                <div class="form-group cat-options" id="categories-current" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'current' ? 'style="border-top:none;"' : 'style="display:none; border-top:none;"'; ?>>
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_current; ?></div>
                  </div>
                </div>
                <div class="form-group cat-options" id="categories-subcurrent" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'subcurrent' ? 'style="border-top:none;"' : 'style="display:none; border-top:none;"'; ?>>
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_subcurrent; ?></div>
                  </div>
                </div>
                <div class="form-group cat-options" id="categories-levels" <?php echo isset($structure['cat_option']) && $structure['cat_option'] == 'levels' ? 'style="border-top:none;"' : 'style="display:none; border-top:none;"'; ?>>
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_range; ?></div>
                  </div>
                  <label class="col-md-3 col-lg-2 control-label"><?php echo $entry_range; ?></label>
                  <div class="col-md-9 col-lg-10">
                    <div class="row">
                      <div class="col-sm-3 col-lg-2"><input type="text" name="menu[start_level]" value="<?php echo !empty($menu['start_level']) ? $menu['start_level'] : ''; ?>" class="form-control" /></div>
                      <div class="col-sm-3 col-lg-2"><input type="text" name="menu[end_level]" value="<?php echo !empty($menu['end_level']) ? $menu['end_level'] : ''; ?>" class="form-control" /></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item-option" id="manufacturers-option" <?php echo isset($structure['items']) && $structure['items'] == 'manufacturers' ? '' : 'style="display:none;"'; ?>>
                <div class="row">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="menu[hide_empty_brands]" value="1" id="brands-hide" onchange="if($(this).prop('checked')){$('#custom-brands-hide').prop('checked', true);} else {$('#custom-brands-hide').prop('checked',false);}" <?php echo isset($menu['hide_empty_brands']) ? 'checked="checked"' : ''; ?> />
                      <?php echo $text_hide_empty_brands; ?> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_select; ?></div>
                    <div class="well well-sm">
                      <div id="manufacturers-tree">
                        <ul>
                          <li id="all-manufacturers" <?php echo $structure['all_manufacturers'] ? 'data-jstree=\'{"opened":true,"selected":true}\'' : 'data-jstree=\'{"opened":true,"selected":false}\''; ?>>
                            <?php echo $text_allbrands; ?>
                            <?php echo $manufacturers; ?>
                          </li>
                        </ul>
                      </div>
                      <input type="hidden" name="structure[manufacturers]" value="" />
                      <input type="hidden" name="structure[all_manufacturers]" value="" />
                    </div>
                    <br>
                    <div class="btn-group btn-group-sm" role="group">
                      <button type="button" class="btn btn-default select-all"><?php echo $text_select_all; ?></button>
                      <button type="button" class="btn btn-default deselect-all"><?php echo $text_unselect_all; ?></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item-option" id="informations-option" <?php echo isset($structure['items']) && $structure['items'] == 'informations' ? '' : 'style="display:none;"'; ?>>
                <div class="form-group">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_select; ?></div>
                    <div class="well well-sm">
                      <div id="informations-tree" class="nodots">
                        <?php echo $informations; ?>
                      </div>
                      <input type="hidden" name="structure[informations]" value="" />
                    </div>
                    <br>
                    <div class="btn-group btn-group-sm" role="group">
                      <button type="button" class="btn btn-default select-all"><?php echo $text_select_all; ?></button>
                      <button type="button" class="btn btn-default deselect-all"><?php echo $text_unselect_all; ?></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item-option" id="products-option" <?php echo isset($structure['items']) && $structure['items'] == 'products' ? '' : 'style="display:none;"'; ?>>
                <div class="row">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="menu[product_price]" value="1" id="product-price" onchange="if($(this).prop('checked')){$('#custom-product-price').prop('checked', true);} else {$('#custom-product-price').prop('checked',false);}" <?php echo isset($menu['product_price']) ? 'checked="checked"' : ''; ?> />
                    <?php echo $text_product_price; ?> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-9 col-lg-10 col-md-offset-3 col-lg-offset-2">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_select; ?></div>
                    <input type="text" value="" id="product-input" placeholder="<?php echo $text_select_product; ?>" class="form-control" />
                    <div class="well well-sm">
                      <ul id="product-list" class="list-unstyled sortable-list">
                        <?php foreach ($products as $product) { ?>
                        <li id="<?php echo $product['product_id']; ?>">
                          <i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                        </li>
                        <?php } ?>
                      </ul>
                      <input type="hidden" name="structure[products]" value="<?php echo $selected_products; ?>" />
                    </div>
                    <br>
                    <button type="button" class="btn btn-default btn-sm clear-list" id="clear-product-list"><?php echo $button_clear; ?></button>
                  </div>
                </div>
              </div>
              <div class="item-option" id="custom-option" <?php echo isset($structure['items']) && $structure['items'] == 'custom' ? '' : 'style="display:none;"'; ?>>
                <br>
                <h3><?php echo $entry_custom; ?></h3>
                <div class="form-group">
                  <div class="col-md-6 col-lg-5" id="items-select">
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_add; ?></div>
                    <ul class="nav nav-tabs" id="custom-items-tabs" role="tablist" style="margin-bottom: 16px;">
                      <li class="active"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab"><?php echo $text_categories; ?></a></li>
                      <li><a href="#manufacturers" aria-controls="manufacturers" role="tab" data-toggle="tab"><?php echo $text_manufacturers; ?></a></li>
                      <li><a href="#informations" aria-controls="informations" role="tab" data-toggle="tab"><?php echo $text_informations; ?></a></li>
                      <li><a href="#products" aria-controls="products" role="tab" data-toggle="tab"><?php echo $text_products; ?></a></li>
                      <li><a href="#custom" aria-controls="custom" role="tab" data-toggle="tab"><?php echo $text_custom; ?></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="categories">
                        <div style="margin: -6px 0 10px 0;">
                          <label class="checkbox-inline">
                            <input type="checkbox" value="1" id="custom-cats-hide" onchange="if($(this).prop('checked')){$('#cats-hide').prop('checked', true);} else {$('#cats-hide').prop('checked',false);}" <?php echo isset($menu['hide_empty_cats']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_hide_empty_cats; ?> </label>
                        </div>
                        <div class="well well-sm">
                          <div id="category-selection">
                            <?php echo $custom_categories; ?>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" data-toggle="buttons" style="margin-top: -2px;">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm select-all"><?php echo $text_select_all; ?></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm deselect-all"><?php echo $text_unselect_all; ?></button>
                          </div>
                          <label class="btn btn-default btn-sm auto-select">
                            <input type="checkbox" value="" />
                            <?php echo $text_auto_select; ?> </label>
                        </div>
                        <br>
                        <a onclick="addItems('category');" class="btn btn-primary btn-block"><?php echo $button_add; ?>&nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="tab-pane" id="manufacturers">
                        <div style="margin: -6px 0 10px 0;">
                          <label class="checkbox-inline">
                            <input type="checkbox" value="1" id="custom-brands-hide" onchange="if($(this).prop('checked')){$('#brands-hide').prop('checked', true);} else {$('#brands-hide').prop('checked',false);}" <?php echo isset($menu['hide_empty_brands']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_hide_empty_brands; ?> </label>
                        </div>
                        <div class="well well-sm">
                          <div id="manufacturer-selection" class="nodots">
                            <?php echo $custom_manufacturers; ?>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" style="margin-top: -2px;">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm select-all"><?php echo $text_select_all; ?></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm deselect-all"><?php echo $text_unselect_all; ?></button>
                          </div>
                        </div>
                        <br>
                        <a onclick="addItems('manufacturer');" class="btn btn-primary btn-block"><?php echo $button_add; ?>&nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="tab-pane" id="informations">
                        <div class="well well-sm">
                          <div id="information-selection" class="nodots">
                            <?php echo $custom_informations; ?>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" style="margin-top: -2px;">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm select-all"><?php echo $text_select_all; ?></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm deselect-all"><?php echo $text_unselect_all; ?></button>
                          </div>
                        </div>
                        <br>
                        <a onclick="addItems('information');" class="btn btn-primary btn-block"><?php echo $button_add; ?>&nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="tab-pane" id="products">
                        <div style="margin: -6px 0 10px 0;">
                          <label class="checkbox-inline">
                            <input type="checkbox" value="1" id="custom-product-price" onchange="if($(this).prop('checked')){$('#product-price').prop('checked', true);} else {$('#product-price').prop('checked',false);}" <?php echo isset($menu['product_price']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_product_price; ?> </label>
                        </div>
                        <input type="text" value="" id="custom-product-input" placeholder="<?php echo $text_select_product; ?>" class="form-control" />
                        <div class="well well-sm">
                          <ul id="custom-list" class="list-unstyled sortable-list"></ul>
                        </div>
                        <button type="button" class="btn btn-default btn-sm btn-block clear-list" style="margin-top: -2px;"><?php echo $button_clear; ?></button>
                        <br>
                        <a onclick="addItems('product');" class="btn btn-primary btn-block"><?php echo $button_add; ?>&nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="tab-pane notoutput-forms" id="custom">
                        <ul class="lang-nav nav nav-tabs" id="lang-sel">
                          <?php foreach ($languages as $language) { ?>
                          <?php if ($language['status']) { ?>
                          <li><a href="#lang-sel-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                        <div class="tab-content">
                          <?php foreach ($languages as $language) { ?>
                          <?php if ($language['status']) { ?>
                          <div class="tab-pane" id="lang-sel-<?php echo $language['language_id']; ?>">

                            <div class="row">
                              <p class="col-sm-9">
                                <label><?php echo $entry_item_name; ?>&nbsp;
                                  <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                </label>
                                <input type="text" name="name<?php echo $language['language_id']; ?>" data-default-value="<?php echo $text_item ?>" value="" class="form-control" />
                              </p>
                              <div class="col-sm-3">
                                <label><?php echo $entry_item_class; ?>&nbsp;
                                  <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                </label>
                                <input type="text" name="class<?php echo $language['language_id']; ?>" class="form-control" />
                              </div>
                            </div>

                            <label><?php echo $entry_item_url; ?>&nbsp;
                              <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                            </label>
                            <div class="row">
                              <p class="col-sm-9">
                                <input type="text" name="url<?php echo $language['language_id']; ?>" value="" class="form-control" />
                              </p>
                              <p class="col-sm-3">
                                <select name="target<?php echo $language['language_id']; ?>" class="form-control">
                                  <option value="" selected="selected">self</option>
                                  <option value="_blank">blank</option>
                                </select>
                              </p>
                            </div>

                            <div class="row">
                              <p class="col-sm-3">
                              <label><?php echo $entry_item_icon; ?>&nbsp;
                                <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                              </label>
                                <select name="icon<?php echo $language['language_id']; ?>" class="form-control" onchange="if($(this).val() == 'code') {$(this).parent().parent().find('.code-icon-sel-<?php echo $language['language_id']; ?>').show().next().hide();} else {$(this).parent().parent().find('.code-icon-sel-<?php echo $language['language_id']; ?>').hide().next().show();}">
                                    <option value="code" selected="selected"><?php echo $text_icon_html; ?></option>
                                    <option value="img"><?php echo $text_icon_image; ?></option>
                                </select>
                              </p>
                              <p class="col-sm-6 code-icon-sel-<?php echo $language['language_id']; ?>">
                              <label>&nbsp;</label>
                                <input type="text" name="code<?php echo $language['language_id']; ?>" class="form-control" />
                              </p>
                              <p class="col-sm-6 img-icon-sel-<?php echo $language['language_id']; ?>" style="display: none;">
                              <label>&nbsp;</label>
                                <a href="" data-toggle="image" class="img-upload-sel-<?php echo $language['language_id']; ?>" id="icon-sel-<?php echo $language['language_id']; ?>">
                                  <img src="../image/no_image.png" alt="" style="height:34px" class="img-thumbnail" />
                                </a>
                                <input type="hidden" name="img<?php echo $language['language_id']; ?>" id="input-icon-sel-<?php echo $language['language_id']; ?>" />
                              </p>
                              <p class="col-sm-3">
                                <label><?php echo $entry_column; ?>&nbsp;
                                  <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                </label>
                                <input type="text" name="col<?php echo $language['language_id']; ?>" class="form-control" />
                              </p>
                            </div>

                          </div>
                          <?php } ?>
                          <?php } ?>
                        </div>
                        <input type="hidden" name="type" value="custom" />
                        <input type="hidden" name="status" value="1" />
                        <hr>
                        <a onclick="addItems('custom');" class="btn btn-primary btn-block"><?php echo $button_add; ?>&nbsp; <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                      </div>
                      <hr class="hidden-lg hidden-md">
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-7 notoutput-forms" id="items-nestable">
                    <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; <?php echo $text_info_nestable; ?></div>
                    <div class="cm" id="items">
                      <div style="margin-bottom: 20px;">
                        <button type="button" class="btn btn-default active" id="item-select-btn"><?php echo $button_view; ?></button>
                        <div class="pull-right">
                          <button type="button" class="cm-new-item btn btn-primary" data-toggle="tooltip" title="<?php echo $button_add; ?>"><i class="fa fa-plus"></i></button>
<!--                           <button type="button" class="cm-new-group btn btn-primary" data-toggle="tooltip" title="<?php echo $button_add_group; ?>" style="margin-right: 5px"><i class="fa fa-object-ungroup"></i></button> -->
                          <a href="<?php echo $export; ?>" data-toggle="tooltip" title="<?php echo $button_export; ?>" class="btn btn-default"><i class="fa fa-download"></i></a>
                          <a onclick="structure();" data-toggle="tooltip" title="<?php echo $button_import; ?>" class="btn btn-default"><i class="fa fa-upload"></i></a>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" style="right:0; left:auto;">
                              <li><a onclick="menu.expandAll();"><i class="fa fa-chevron-down"></i> <?php echo $text_expand_all; ?></a></li>
                              <li><a onclick="menu.collapseAll();"><i class="fa fa-chevron-up"></i> <?php echo $text_collapse_all; ?></a></li>
                              <li role="separator" class="divider"></li>
                              <li><a onclick="$('#items').find('.cm-list').children().remove(); output(menu.toJson());"><i class="fa fa-times" style="color:#d9534f" aria-hidden="true"></i> <?php echo $text_remove_all; ?></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <li class="cm-item-blueprint">
                        <button type="button" class="collapse" data-action="collapse" type="button" style="display: none;"><i class="fa fa-minus"></i></button>
                        <button type="button" class="expand" data-action="expand" type="button" style="display: none;"><i class="fa fa-plus"></i></button>
                        <div class="item-wrapper">
                          <div class="cm-handle cm3-handle">&nbsp;</div>
                          <div class="cm3-content">
                            <span class="item-name">[item_name]</span>
                            <div class="cm-button-container">
                              <button type="button" class="item-edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                              <button type="button" class="item-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                              <button type="button" class="item-status status-on"><i class="fa fa-power-off" aria-hidden="true"></i></button>
                              <button type="button" class="item-remove" data-confirm-class="item-remove-confirm"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="cm-edit-box">
                          <div class="options-panel">
                            <ul class="lang-nav nav nav-tabs" style="margin-bottom: 20px;">
                              <?php foreach ($languages as $language) { ?>
                              <?php if ($language['status']) { ?>
                              <li><a href="#lang-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                              <?php } ?>
                              <?php } ?>
                            </ul>
                            <div class="tab-content">
                              <?php foreach ($languages as $language) { ?>
                              <?php if ($language['status']) { ?>
                              <div class="tab-pane" id="lang-<?php echo $language['language_id']; ?>">
                                <div class="item-options">
                                  <div class="row">
                                    <p class="col-sm-9">
                                      <label><?php echo $entry_item_name; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <input type="text" name="name<?php echo $language['language_id']; ?>" data-default-value="<?php echo $text_item ?>" value="" class="form-control" />
                                    </p>
                                    <div class="col-sm-3">
                                      <label><?php echo $entry_item_class; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <input type="text" name="class<?php echo $language['language_id']; ?>" class="form-control" />
                                    </div>
                                  </div>
                                  <div class="url-options">
                                    <label><?php echo $entry_item_url; ?>&nbsp;
                                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                    </label>
                                    <div class="row">
                                      <p class="col-sm-9">
                                        <input type="text" name="url<?php echo $language['language_id']; ?>" value="" class="form-control" />
                                      </p>
                                      <p class="col-sm-3">
                                        <select name="target<?php echo $language['language_id']; ?>" class="form-control">
                                          <option value="" selected="selected">self</option>
                                          <option value="_blank">blank</option>
                                        </select>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-9">
                                      <label><?php echo $entry_item_icon; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <div class="row">
                                        <div class="col-sm-5 col-lg-4">
                                          <select name="icon<?php echo $language['language_id']; ?>" class="form-control" onchange="if($(this).val() == 'code') {$(this).parent().parent().parent().find('.code-icon-<?php echo $language['language_id']; ?>').show().next().hide();} else {$(this).parent().parent().parent().find('.code-icon-<?php echo $language['language_id']; ?>').hide().next().show();}">
                                            <option value="code" selected="selected"><?php echo $text_icon_html; ?></option>
                                            <option value="img"><?php echo $text_icon_image; ?></option>
                                          </select>
                                        </div>
                                        <div class="col-sm-7 col-lg-8 code-icon-<?php echo $language['language_id']; ?>">
                                          <input type="text" name="code<?php echo $language['language_id']; ?>" class="form-control" />
                                        </div>
                                        <div class="col-sm-7 col-lg-8 img-icon-<?php echo $language['language_id']; ?>" style="display: none;">
                                          <a href="" data-toggle="image" class="img-upload-<?php echo $language['language_id']; ?>">
                                            <img src="../image/no_image.png" alt="" style="height:34px" class="img-thumbnail" />
                                          </a>
                                          <input type="hidden" name="img<?php echo $language['language_id']; ?>" class="form-control" />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <label><?php echo $entry_column; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <input type="text" name="col<?php echo $language['language_id']; ?>" class="form-control" />
                                    </div>
                                  </div>
                                </div>
                                <div class="group-options">
                                  <p>
                                    <label><?php echo $entry_group_name; ?>&nbsp;
                                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                    </label>
                                    <input type="text" name="name<?php echo $language['language_id']; ?>" data-default-value="<?php echo $text_group ?>" value="" class="form-control" />
                                  </p>
                                  <div class="row">
                                    <p class="col-sm-6">
                                      <label><?php echo $entry_group_id; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <input type="text" name="gid<?php echo $language['language_id']; ?>" class="form-control" />
                                    </p>
                                    <p class="col-sm-6">
                                      <label><?php echo $entry_group_class; ?>&nbsp;
                                        <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                      </label>
                                      <input type="text" name="gclass<?php echo $language['language_id']; ?>" class="form-control" />
                                    </p>
                                  </div>
                                  <p>
                                    <label><?php echo $entry_column; ?>&nbsp;
                                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                    </label>
                                    <input type="text" name="gcol<?php echo $language['language_id']; ?>" class="form-control" />
                                  </p>
                                </div>
                                <div class="html-options">
                                  <p>
                                    <label><?php echo $entry_item_name; ?>&nbsp;
                                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                    </label>
                                    <input type="text" name="name<?php echo $language['language_id']; ?>" data-default-value="<?php echo $text_html ?>" value="" class="form-control" />
                                  </p>
                                  <p>
                                    <label><?php echo $entry_html_block; ?>&nbsp;
                                      <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" />
                                    </label>
                                    <textarea name="html<?php echo $language['language_id']; ?>" class="form-control summernote" id="custom-html-block-<?php echo $language['language_id']; ?>"></textarea>
                                  </p>
                                </div>
                              </div>
                              <?php } ?>
                              <?php } ?>
                            </div>
                            <hr>
                            <button type="button" class="stop-edit btn btn-default"><?php echo $button_cancel; ?></button>
                            <button type="button" class="end-edit btn btn-primary pull-right"><?php echo $button_save; ?></button>
                          </div>
                        </div>
                      </li>
                      <ol class="cm-list"></ol>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-menu-options" class="tab-pane output-forms">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_menu_type; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default arrow-bottom">
                          <input type="radio" name="menu[type]" value="vertical" id="vertical-type-input" <?php echo empty($menu['type']) || $menu['type'] == 'vertical' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#vertical-type').show().siblings('.menu-types').hide(); $('#column-setting').show();} if ($('#columns-input').val()<2) {$('#single-design').show();}" />
                          <?php echo $text_vertical; ?> </label>
                        <label class="btn btn-default arrow-bottom">
                          <input type="radio" name="menu[type]" value="horizontal" id="horizontal-type-input" <?php echo isset($menu['type']) && $menu['type'] == 'horizontal' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#horizontal-type').show().siblings('.menu-types').hide(); $('#column-setting').show();} if ($('#columns-input').val()<2) {$('#single-design').hide();}" />
                          <?php echo $text_horizontal; ?> </label>
                        <label class="btn btn-default arrow-bottom">
                          <input type="radio" name="menu[type]" value="showcase" <?php echo isset($menu['type']) && $menu['type'] == 'showcase' ? 'checked="checked"' : ''; ?> onchange="if($(this).prop('checked')) {$('#showcase-type').show().siblings('.menu-types').hide(); $('#column-setting').hide();}" />
                          <?php echo $text_showcase; ?> </label>
                      </div>
                    </div>
                  </div>
                  <div id="vertical-type" class="menu-types" <?php echo empty($menu['type']) || $menu['type'] == 'vertical' ? '' : 'style="display:none;"'; ?>>
                    <div class="form-group" style="border-top: 1px solid #ededed;">
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_menu_design; ?></label>
                      <div class="col-md-9 col-lg-8">
                        <select name="menu[design]" class="form-control" onchange="if ($(this).val()=='fm') {$('#column-setting').show();} else {$('#column-setting').hide();}">
                          <?php if (isset($menu['design']) && $menu['design'] == 'am') { ?>
                          <option value="am" selected="selected"><?php echo $text_am; ?></option>
                          <?php } else { ?>
                          <option value="am"><?php echo $text_am; ?></option>
                          <?php } ?>
                          <?php if (isset($menu['design']) && $menu['design'] == 'fm') { ?>
                          <option value="fm" selected="selected"><?php echo $text_fm; ?></option>
                          <?php } else { ?>
                          <option value="fm"><?php echo $text_fm; ?></option>
                          <?php } ?>
                          <?php if (isset($menu['design']) && $menu['design'] == 'pm') { ?>
                          <option value="pm" selected="selected"><?php echo $text_pm; ?></option>
                          <?php } else { ?>
                          <option value="pm"><?php echo $text_pm; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_minimized; ?></label>
                      <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="radio" name="menu[minimized]" value="1" <?php echo isset($menu['minimized']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_yes; ?> </label>
                        <label class="btn btn-default">
                          <input type="radio" name="menu[minimized]" value="0" <?php echo empty($menu['minimized']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_no; ?> </label>
                      </div>
                      </div>
                    </div>

                    <div id="accordion-config" <?php echo empty($menu['design']) || $menu['design'] == 'am' ? '' : 'style="display:none;"'; ?>>              </div>
                    <div id="flyout-config" <?php echo isset($menu['design']) && $menu['design'] == 'fm' ? '' : 'style="display:none;"'; ?>>                 </div>

                  </div>
                  <div id="horizontal-type" class="menu-types" <?php echo isset($menu['type']) && $menu['type'] == 'horizontal' ? '' : 'style="display:none;"'; ?>>
                    <div class="form-group" style="border-top: 1px solid #ededed;">
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_menu_design; ?></label>
                      <div class="col-md-9 col-lg-8">
                        <select name="menu[design_hm]" class="form-control">
                          <?php if (isset($menu['design_hm']) && $menu['design_hm'] == 'default') { ?>
                          <option value="default" selected="selected"><?php echo $text_default; ?></option>
                          <?php } else { ?>
                          <option value="default"><?php echo $text_default; ?></option>
                          <?php } ?>
                          <?php if (isset($menu['design_hm']) && $menu['design_hm'] == 'amazon') { ?>
                          <option value="amazon" selected="selected">Amazon</option>
                          <?php } else { ?>
                          <option value="amazon">Amazon</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" style="border-top: 1px solid #ededed;">
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_main; ?></label>
                      <div class="col-md-9 col-lg-8">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="main" value="1" onchange="if($(this).prop('checked')) {$('#main-sort').show();}" <?php echo isset($main) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_yes; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="main" value="0" onchange="if($(this).prop('checked')) {$('#main-sort').hide();}" <?php echo empty($main) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_no; ?> </label>
                        </div>
                      </div>
                    </div>
                    <div id="main-sort" <?php echo !empty($main) ? '' : 'style="display:none;"'; ?>>
                      <div class="form-group">
                        <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_sort; ?></label>
                        <div class="col-md-9 col-lg-8">
                          <input type="text" name="main_sort" value="<?php echo !empty($main_sort) ? $main_sort : ''; ?>" class="form-control" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="showcase-type" class="menu-types" <?php echo isset($menu['type']) && $menu['type'] == 'showcase' ? '' : 'style="display:none;"'; ?>>    </div>

                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_string; ?></label>
                    <div class="col-md-9 col-lg-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <div class="input-group-addon"><?php echo $text_limit; ?></div>
                                    <input type="text" name="menu[mainlimit]" value="<?php echo !empty($menu['mainlimit']) ? $menu['mainlimit'] : ''; ?>" class="form-control text-center" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="checkbox-inline" />
                                <input type="checkbox" name="menu[main_more_btn]" value="1" <?php echo isset($menu['main_more_btn']) ? 'checked="checked"' : ''; ?> />
                                <?php echo $text_more_btn; ?> </label>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-9 col-lg-8 col-md-offset-3 col-lg-offset-4"><br><h4><?php echo $entry_subitems; ?></h4></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_status; ?></label>
                    <div class="col-md-9 col-lg-8">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="menu[sub_status]" value="1" <?php echo isset($menu['sub_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_yes; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[sub_status]" value="0" <?php echo empty($menu['sub_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_no; ?> </label>
                        </div>
                    </div>
                    <div class="col-sm-12"><br></div>
                    <div id="column-setting" <?php echo isset($menu['type']) && $menu['type'] == 'vertical' && isset($menu['design']) && ($menu['design'] == 'am' || $menu['design'] == 'pm') || isset($menu['type']) && $menu['type'] == 'showcase' ? 'style="display:none;"' : ''; ?>>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_column; ?></label>
                      <div class="col-md-9 col-lg-8">
                          <div class="row">
                            <div class="col-sm-6">
                              <input type="text" name="menu[columns]" value="<?php echo !empty($menu['columns']) ? $menu['columns'] : '1'; ?>" class="form-control" id="columns-input" onkeyup="if ($(this).val()<2 && $('#vertical-type-input').parent().is('.active')) {$('#single-design').show();} else if ($(this).val()>1 && $('#horizontal-type-input').parent().is('.active')) {$('#full-width').show();} else {$('#single-design').hide();}" />
                            </div>
                            <div class="col-sm-6">
                              <div id="full-width">
                                <label class="checkbox-inline">
                                  <input type="checkbox" name="menu[full_width]" value="1" id="full-width-input" <?php echo isset($menu['full_width']) ? 'checked="checked"' : ''; ?> />
                                  <?php echo $text_full_width; ?> </label>
                              </div>
                              <div id="single-design" <?php echo isset($menu['columns']) && $menu['columns'] < 2 && isset($menu['type']) && $menu['type'] == 'vertical' ? '' : 'style="display:none;"'; ?>>
                                <select name="menu[single_design]" class="form-control">
                                  <?php if (isset($menu['single_design']) && $menu['single_design'] == 'flyout') { ?>
                                    <option value="flyout" selected="selected"><?php echo $text_fly_design; ?></option>
                                  <?php } else { ?>
                                    <option value="flyout"><?php echo $text_fly_design; ?></option>
                                  <?php } ?>
                                  <?php if (isset($menu['single_design']) && $menu['single_design'] == 'push') { ?>
                                    <option value="push" selected="selected"><?php echo $text_push_design; ?></option>
                                  <?php } else { ?>
                                    <option value="push"><?php echo $text_push_design; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-12"><br></div>
                    </div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_string; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="input-group">
                            <div class="input-group-addon"><?php echo $text_limit; ?></div>
                            <input type="text" name="menu[sublimit]" value="<?php echo !empty($menu['sublimit']) ? $menu['sublimit'] : ''; ?>" class="form-control text-center" />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <label class="checkbox-inline" />
                          <input type="checkbox" name="menu[more_btn]" value="1" <?php echo isset($menu['more_btn']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_more_btn; ?> </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-9 col-lg-8 col-md-offset-3 col-lg-offset-4"><br><h4><?php echo $entry_adaptability; ?></h4></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_status; ?></label>
                    <div class="col-md-9 col-lg-8">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="menu[detect_status]" value="1" <?php echo isset($menu['detect_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_yes; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[detect_status]" value="0" <?php echo empty($menu['detect_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_no; ?> </label>
                        </div>
                    </div>
                    <div class="col-sm-12"><br></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_mobile; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="radio" name="menu[mobile]" value="1" <?php echo isset($menu['mobile']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_yes; ?> </label>
                        <label class="btn btn-default">
                          <input type="radio" name="menu[mobile]" value="0" <?php echo empty($menu['mobile']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_no; ?> </label>
                      </div>
                    </div>
                    <div class="col-sm-12"><br></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_menu_design; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <select name="menu[mobile_design]" class="form-control">
                        <?php if (isset($menu['mobile_design']) && $menu['mobile_design'] == 'am') { ?>
                        <option value="am" selected="selected"><?php echo $text_am; ?></option>
                        <?php } else { ?>
                        <option value="am"><?php echo $text_am; ?></option>
                        <?php } ?>
                        <?php if (isset($menu['mobile_design']) && $menu['mobile_design'] == 'pm') { ?>
                        <option value="pm" selected="selected"><?php echo $text_pm; ?></option>
                        <?php } else { ?>
                        <option value="pm"><?php echo $text_pm; ?></option>
                        <?php } ?>
                        <?php if (isset($menu['mobile_design']) && $menu['mobile_design'] == 'sm') { ?>
                        <option value="sm" selected="selected"><?php echo $text_sm; ?></option>
                        <?php } else { ?>
                        <option value="sm"><?php echo $text_sm; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-12"><br></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_tablet; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="radio" name="menu[tablet]" value="1" <?php echo isset($menu['tablet']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_yes; ?> </label>
                        <label class="btn btn-default">
                          <input type="radio" name="menu[tablet]" value="0" <?php echo empty($menu['tablet']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_no; ?> </label>
                      </div>
                    </div>
                    <div class="col-sm-12"><br></div>
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_desktop; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="radio" name="menu[desktop]" value="1" <?php echo isset($menu['desktop']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_yes; ?> </label>
                        <label class="btn btn-default">
                          <input type="radio" name="menu[desktop]" value="0" <?php echo empty($menu['desktop']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_no; ?> </label>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                      <div class="col-md-9 col-lg-8 col-md-offset-3 col-lg-offset-4"><br><h4><?php echo $entry_images; ?></h4></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_status; ?></label>
                      <div class="col-md-9 col-lg-8">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_status]" value="1" <?php echo isset($menu['img_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_yes; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_status]" value="0" <?php echo empty($menu['img_status']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_no; ?> </label>
                        </div>
                      </div>
                      <div class="col-sm-12"><br></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_position; ?></label>
                      <div class="col-md-9 col-lg-8">
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_position]" value="top" <?php echo empty($menu['img_position']) || $menu['img_position'] == 'top' ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_top; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_position]" value="bottom" <?php echo isset($menu['img_position']) && $menu['img_position'] == 'bottom' ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_bottom; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_position]" value="left" <?php echo isset($menu['img_position']) && $menu['img_position'] == 'left' ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_left; ?> </label>
                          <label class="btn btn-default">
                            <input type="radio" name="menu[img_position]" value="right" <?php echo isset($menu['img_position']) && $menu['img_position'] == 'right' ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_right; ?> </label>
                        </div>
                      </div>
                      <div class="col-sm-12"><br></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_dimensions; ?></label>
                      <div class="col-md-9 col-lg-8">
                         <div class="row">
                           <div class="col-sm-6">
                            <div class="input-group">
                              <div class="input-group-addon"><?php echo $entry_width; ?></div>
                              <input type="text" name="menu[img_width]" value="<?php echo !empty($menu['img_width']) ? $menu['img_width'] : '170'; ?>" class="form-control text-center" />
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="input-group">
                              <div class="input-group-addon"><?php echo $entry_height; ?></div>
                              <input type="text" name="menu[img_height]" value="<?php echo !empty($menu['img_height']) ? $menu['img_height'] : '100'; ?>" class="form-control text-center" />
                            </div>
                          </div>
                         </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-9 col-lg-8 col-md-offset-3 col-lg-offset-4"><br><h4><?php echo $entry_count; ?></h4></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_status; ?></label>
                      <div class="col-md-9 col-lg-8">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default">
                              <input type="radio" name="menu[count]" value="1" <?php echo isset($menu['count']) ? 'checked="checked"' : ''; ?> />
                              <?php echo $text_yes; ?> </label>
                            <label class="btn btn-default">
                              <input type="radio" name="menu[count]" value="0" <?php echo empty($menu['count']) ? 'checked="checked"' : ''; ?> />
                              <?php echo $text_no; ?> </label>
                          </div>
                      </div>
                      <div class="col-sm-12"><br></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_nestable_count; ?></label>
                      <div class="col-md-9 col-lg-8">
                          <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn btn-default">
                              <input type="radio" name="menu[nestable_count]" value="1" <?php echo isset($menu['nestable_count']) ? 'checked="checked"' : ''; ?> />
                              <?php echo $text_yes; ?> </label>
                            <label class="btn btn-default">
                              <input type="radio" name="menu[nestable_count]" value="0" <?php echo empty($menu['nestable_count']) ? 'checked="checked"' : ''; ?> />
                              <?php echo $text_no; ?> </label>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-9 col-lg-8 col-md-offset-3 col-lg-offset-4"><br><h4><?php echo $entry_classes; ?></h4></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_box_class; ?></label>
                      <div class="col-md-9 col-lg-8">
                      <input type="text" name="menu[box_class]" value="<?php echo !empty($menu['box_class']) ? $menu['box_class'] : ''; ?>" class="form-control" />
                      </div>
                      <div class="col-sm-12"><br></div>
                      <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_title_class; ?></label>
                      <div class="col-md-9 col-lg-8">
                      <input type="text" name="menu[title_class]" value="<?php echo !empty($menu['title_class']) ? $menu['title_class'] : ''; ?>" class="form-control" />
                      <span class="help-block"><?php echo $help_classes; ?></span>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div id="tab-module-setting" class="tab-pane output-forms">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group required">
                    <label class="col-md-3 col-lg-4 control-label" for="input-name"><?php echo $entry_name; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                      <input type="hidden" name="module_id" value="<?php echo $module_id; ?>" />
                      <?php if ($error_name) { ?>
                      <div class="text-danger"><?php echo $error_name; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_status; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="btn-group btn-group-justified" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="radio" name="status" value="1" <?php echo isset($status) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_enabled; ?> </label>
                        <label class="btn btn-default">
                          <input type="radio" name="status" value="0" <?php echo empty($status) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_disabled; ?> </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_store; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="well well-sm">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="module[store_id][]" value="0" <?php echo isset($module['store_id']) && in_array(0, $module['store_id']) ? 'checked="checked" ' : ''; ?> />
                            <?php echo $default_store; ?>
                          </label>
                        </div>
                        <?php foreach ($stores as $store) { ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="module[store_id][]" value="<?php echo $store['store_id']; ?>" <?php echo isset($module['store_id']) && in_array($store['store_id'], $module['store_id']) ? 'checked="checked" ' : ''; ?> />
                            <?php echo $store['name']; ?>
                          </label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_customers; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <div class="well well-sm">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="module[all_customers]" value="1" <?php echo isset($module['all_customers']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_customers; ?> </label>
                        </div>
                        <?php foreach ($customer_groups as $customer_group) { ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="module[customer_group_id][]" value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo isset($module['customer_group_id']) && in_array($customer_group['customer_group_id'], $module['customer_group_id']) ? 'checked="checked" ' : ''; ?> />
                            <?php echo $customer_group['name']; ?> </label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_layout; ?>"><?php echo $entry_layout; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <input type="text" name="module[menu_layout]" placeholder="extension/module/yumenu/custom.tpl" value="<?php echo !empty($module['menu_layout']) ? $module['menu_layout'] : ''; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_style; ?>"><?php echo $entry_css_url; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <input type="text" name="module[css_url]" placeholder="catalog/view/theme/default/stylesheet/style.css" value="<?php echo !empty($module['css_url']) ? $module['css_url'] : ''; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_script; ?>"><?php echo $entry_js_url; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <input type="text" name="module[js_url]" placeholder="catalog/view/javascript/script.js" value="<?php echo !empty($module['js_url']) ? $module['js_url'] : ''; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><?php echo $entry_css; ?></label>
                    <div class="col-md-9 col-lg-8">
                      <select name="module[style_status]" class="form-control">
                        <?php if (!empty($module['style_status'])) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                      <textarea  name="style" placeholder="<?php echo '#any-id {font-size: 22px; color: #FFF}'; echo "\n"; echo '.any-class {color: #555; padding: 15px;}'; ?>" class="form-control"><?php echo $style; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_categories; ?>"><?php echo $entry_categories; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <select name="module[cat_invert]" class="form-control">
                        <?php if ($module['cat_invert']) { ?>
                        <option value="1" selected="selected"><?php echo $text_show; ?></option>
                        <option value="0"><?php echo $text_hide; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_show; ?></option>
                        <option value="0" selected="selected"><?php echo $text_hide; ?></option>
                        <?php } ?>
                      </select>
                      <div class="well well-sm" style="min-height: 106px;">
                        <div id="category-layout">
                          <ul>
                            <li id="all-layout-cats" <?php echo $module['all_layout_cats'] ? 'data-jstree=\'{"opened":false,"selected":true}\'' : ''; ?>>
                              <?php echo $text_allcats; ?>
                              <?php echo $category_layouts; ?>
                            </li>
                          </ul>
                        </div>
                        <input type="hidden" name="module[clid]" value="" />
                        <input type="hidden" name="module[all_layout_cats]" value="" />
                      </div>
                      <div class="btn-group btn-group-justified" role="group" data-toggle="buttons" style="margin-top: -2px;">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-default btn-sm select-all"><?php echo $text_select_all; ?></button>
                        </div>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-default btn-sm deselect-all"><?php echo $text_unselect_all; ?></button>
                        </div>
                        <label class="btn btn-default btn-sm auto-select">
                          <input type="checkbox" value="" />
                          <?php echo $text_auto_select; ?> </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_manufacturers; ?>"><?php echo $entry_manufacturers; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <select name="module[brand_invert]" class="form-control">
                        <?php if ($module['brand_invert']) { ?>
                        <option value="1" selected="selected"><?php echo $text_show; ?></option>
                        <option value="0"><?php echo $text_hide; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_show; ?></option>
                        <option value="0" selected="selected"><?php echo $text_hide; ?></option>
                        <?php } ?>
                      </select>
                      <div class="well well-sm" style="min-height: 106px;">
                        <div id="manufacturer-layout">
                          <ul>
                            <li id="all-layout-brands" <?php echo $module['all_layout_brands'] ? 'data-jstree=\'{"opened":false,"selected":true}\'' : ''; ?>>
                              <?php echo $text_allbrands; ?>
                              <?php echo $manufacturer_layouts; ?>
                            </li>
                          </ul>
                        </div>
                        <input type="hidden" name="module[mlid]" value="" />
                        <input type="hidden" name="module[all_layout_brands]" value="" />
                      </div>
                      <div class="btn-group btn-group-justified" role="group" style="margin-top: -2px;">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-default btn-sm select-all"><?php echo $text_select_all; ?></button>
                        </div>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-default btn-sm deselect-all"><?php echo $text_unselect_all; ?></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 col-lg-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_products; ?>"><?php echo $entry_products; ?></span></label>
                    <div class="col-md-9 col-lg-8">
                      <input type="text" name="module[fpid]" value="" placeholder="<?php echo $text_select_product; ?>" id="product-layout-input" class="form-control" />
                      <br>
                      <select name="module[prod_invert]" class="form-control">
                        <?php if ($module['prod_invert']) { ?>
                        <option value="1" selected="selected"><?php echo $text_show; ?></option>
                        <option value="0"><?php echo $text_hide; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_show; ?></option>
                        <option value="0" selected="selected"><?php echo $text_hide; ?></option>
                        <?php } ?>
                      </select>
                      <div class="well well-sm" style="min-height: 90px;">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="module[all_layout_products]" value="1" <?php echo isset($module['all_layout_products']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_allprods; ?> </label>
                        </div>
                        <ul class="list-unstyled sortable-list" id="product-layout">
                          <?php foreach ($product_layouts as $product) { ?>
                          <li id="product-layout-<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                            <input type="hidden" name="module[fpid][]" value="<?php echo $product['product_id']; ?>" />
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                      <button type="button" class="btn btn-default btn-sm btn-block clear-list" style="margin-top: -2px;"><?php echo $button_clear; ?></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="footer">
      <ul class="list-inline pull-right">
        <li><a href="<?php echo $text_author_link; ?>" onclick="return !window.open(this.href)"><?php echo $text_more; ?></a></li>
      </ul>
      <p><?php echo $heading_title; ?> <?php echo $version; ?> <?php echo $text_author; ?> <a href="<?php echo $text_author_link; ?>" onclick="return !window.open(this.href)">iDiY</a></p>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('.lang-nav').each(function() {
  $(this).find('a:first').tab('show');
});

$('#item-select-btn').on('click', function() {
  if ($('#items-select').hasClass('invisible-block')) {
    sessionStorage.setItem('items-block-<?php echo $module_id; ?>', 'open');
    $(this).addClass('active');
  } else {
    sessionStorage.setItem('items-block-<?php echo $module_id; ?>', 'close');
    $(this).removeClass('active');
  }

  $('#items-select').toggleClass('col-md-6 col-lg-5 invisible-block');
  $('#items-nestable').toggleClass('col-md-12 col-md-6 col-lg-7');
});

if (sessionStorage.getItem('items-block-<?php echo $module_id; ?>') == 'close') {
  $('#items-select').toggleClass('col-md-6 col-lg-5 invisible-block');
  $('#items-nestable').toggleClass('col-md-12 col-md-6 col-lg-7');
  $('#item-select-btn').removeClass('active');
}

$('#product-input').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=extension/module/yumenu/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('#product-input').val('');
    $('#product-list #' + item['value']).remove();
    $('#product-list').append('<li id="' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '</li>');
    products();
  }
});

$('#custom-product-input').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=extension/module/yumenu/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('#custom-product-input').val('');
    $('#custom-list #' + item['value']).remove();
    $('#custom-list').append('<li id="' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '</li>');
  }
});

$('#product-layout-input').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=extension/module/yumenu/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
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
    $('#product-layout-input').val('');
    $('#product-layout-' + item['value']).remove();
    $('#product-layout').append('<li id="product-layout-' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="module[fpid][]" value="' + item['value'] + '" /></li>');
  }
});

$('.sortable-list').sortable();
$('.sortable-list').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('.clear-list').on('click', function() {
  $(this).parent().find('.sortable-list').children().remove();
});

$('#product-list').sortable({
  stop: function() {products();}
});

$('#product-list').delegate('.fa-minus-circle', 'click', function() {products();});
$('#clear-product-list').on('click', function() {products();});

$('#categories-tree')
.on("init.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = '';
})
.on("ready.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = 'down';
})
.on("changed.jstree", function () {
  var result = $('#categories-tree').jstree('get_selected');
  var all = $('#all-categories').attr('aria-selected');

  if (all == 'true') {
    $('input[name=\'structure[all_categories]\']').val('1');
    $('input[name=\'structure[categories]\']').val('');
  } else {
    $('input[name=\'structure[all_categories]\']').val('');
    $('input[name=\'structure[categories]\']').val(result);
  }
})
.jstree({
  'checkbox' : {"keep_selected_style" : false, 'three_state' : true, 'cascade': 'down'},
  'plugins' : ["checkbox", "changed"],
  'core' : {"expand_selected_onload": false}
});

$('#manufacturers-tree')
.on('changed.jstree', function (e, data) {
  var result = $('#manufacturers-tree').jstree('get_selected');
  var all = $('#all-manufacturers').attr('aria-selected');

  if (all == 'true') {
    $('input[name=\'structure[all_manufacturers]\']').val('1');
    $('input[name=\'structure[manufacturers]\']').val('');
  } else {
    $('input[name=\'structure[all_manufacturers]\']').val('');
    $('input[name=\'structure[manufacturers]\']').val(result);
  }
})
.jstree({
  'checkbox' : {"keep_selected_style" : false},
  'plugins': ["checkbox", "changed"],
  'core' : {"expand_selected_onload": false}
});

$('#informations-tree')
.on('changed.jstree', function (e, data) {
  var result = $('#informations-tree').jstree('get_selected');
  $('input[name=\'structure[informations]\']').val(result);
})
.jstree({
  'checkbox' : {"keep_selected_style" : false},
  'plugins': ["checkbox", "changed"]
});

$('#category-selection')
.on("init.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = '';
})
.on("ready.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = 'down';
})
.jstree({
  'checkbox' : {"keep_selected_style" : false, 'three_state' : true, 'cascade': 'down'},
  'plugins' : ["checkbox", "changed"]
});

$('#manufacturer-selection, #information-selection')
.jstree({
  'checkbox' : {"keep_selected_style" : false},
  'plugins': ["checkbox", "changed"]
});

$('#category-layout')
.on("init.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = '';
})
.on("ready.jstree", function (e, data) {
  data.instance.settings.checkbox.cascade = 'down';
})
.on('changed.jstree', function () {
  var result = $('#category-layout').jstree('get_selected');
  var all = $('#all-layout-cats').attr('aria-selected');
  if (all == 'true') {
    $('input[name=\'module[all_layout_cats]\']').val('1');
    $('input[name=\'module[clid]\']').val('');
  } else {
    $('input[name=\'module[all_layout_cats]\']').val('');
    $('input[name=\'module[clid]\']').val(result);
  }
})
.jstree({
  'checkbox' : {"keep_selected_style" : false, 'three_state' : true, 'cascade': 'down'},
  'plugins' : ["checkbox", "changed"],
  'core' : {"expand_selected_onload": false}
});

$('#manufacturer-layout')
.on('changed.jstree', function () {
  var result = $('#manufacturer-layout').jstree('get_selected');
  var all = $('#all-layout-brands').attr('aria-selected');
  if (all == 'true') {
    $('input[name=\'module[all_layout_brands]\']').val('1');
    $('input[name=\'module[mlid]\']').val('');
  } else {
    $('input[name=\'module[all_layout_brands]\']').val('');
    $('input[name=\'module[mlid]\']').val(result);
  }
})
.jstree({
  'checkbox' : {"keep_selected_style" : false, 'three_state' : true},
  'plugins' : ["checkbox", "changed"],
  'core' : {"expand_selected_onload": false}
});

$('.select-all').on('click', function() {
  $(this).parent().parent().parent().find('.jstree').jstree('select_all');
});
$('.deselect-all').on('click', function() {
  $(this).parent().parent().parent().find('.jstree').jstree('deselect_all');
});
$('.auto-select').on('click', function() {
  var jstr = $(this).parent().parent().parent().find('.jstree');
  if (jstr.is('.inheritance')) {
    jstr.jstree(true).trigger('ready');
  } else {
    jstr.jstree(true).trigger('init');
  }

  jstr.toggleClass('inheritance');
});

<?php if ($module_id) { ?>
  $('#tablist a').on('click', function(){
    sessionStorage.setItem('active-tab-<?php echo $module_id; ?>', $(this).attr('href'));
  });
  $('#custom-items-tabs a').on('click', function(){
    sessionStorage.setItem('active-sub-tab-<?php echo $module_id; ?>', $(this).attr('href'));
  });
<?php } ?>

if (!sessionStorage.getItem('active-tab-<?php echo $module_id; ?>')) {
  $('#tablist a:first').tab('show');
} else {
  $('#tablist a[href=\'' + sessionStorage.getItem('active-tab-<?php echo $module_id; ?>') + '\']').tab('show');
}
if (!sessionStorage.getItem('active-sub-tab-<?php echo $module_id; ?>')) {
  $('#custom-items-tabs a:first').tab('show');
} else {
  $('#custom-items-tabs a[href=\'' + sessionStorage.getItem('active-sub-tab-<?php echo $module_id; ?>') + '\']').tab('show');
}

$('label.btn input').each(function() {
  if ($(this).prop('checked')) {
    $(this).parent('.btn').addClass('active');
  };
});
//--></script>
<script type="text/javascript"><!--
var $menu = $('#items'), menu = $('#items').domenu();
$menu.domenu({data: '<?php echo $menu_data; ?>'})
.onItemAdded(function(item) {
  var type = item.data('type');
  if (!type) {
    item.data('type','custom');
  }
  var status = item.data('status');
  if (!status) {
    item.data('status','1');
  }
})
.onCreateItem(function(item) {
  var add = $(item).find('>.item-wrapper .item-add');
  var edit = $(item).find('>.item-wrapper .item-edit');
  var stop = $(item).find('>.cm-edit-box .stop-edit');
  var status_btn = $(item).find('>.item-wrapper .item-status');

  $(add).on('click', function() {
    $(item).removeClass('cm-collapsed');
    $(item).find('>.cm-list').children().show();
  });
  $(edit).on('click', function() {
    $(this).parent().prev().click();
  });
  $(stop).on('click', function() {
    $(this).closest('.cm-edit-box').prev().find('.item-name').click();
  });

  var id = item.data('id');
  item.find('.lang-nav a').each(function() {
    $(this).attr('href', $(this).attr('href')+'-'+id);
  });
  item.find('.tab-pane').each(function() {
    $(this).attr('id', $(this).attr('id')+'-'+id);
  });

  var type = item.data('type');
  if (type == 'category' || type == 'manufacturer' || type == 'information' || type == 'product') {
    item.find('.url-options').remove();
  }

  var status = item.data('status');
  if (status == '0') {
    $(item).find('>.item-wrapper .item-status').toggleClass('status-on status-off');
    $(item).find('>.item-wrapper .item-name').toggleClass('disabled');
  }

  $(status_btn).on('click', function() {
    if ($(this).is('.status-off')) {
      item.data('status','1');
    } else if($(this).is('.status-on')) {
      item.data('status','0');
    }

    $(this).toggleClass('status-on status-off');
    $(this).closest('.cm3-content').find('>.item-name').toggleClass('disabled');
    output(menu.toJson());
  });

  <?php foreach ($languages as $language) { ?>
  <?php if ($language['status']) { ?>
  item.find('a.img-upload-<?php echo $language['language_id']; ?>').attr('id', 'icon-<?php echo $language['language_id']; ?>'+'-'+id).next('input').attr('id', 'input-icon-<?php echo $language['language_id']; ?>'+'-'+id);

  var icontype<?php echo $language['language_id']; ?> = item.data('icon<?php echo $language['language_id']; ?>');
  if (icontype<?php echo $language['language_id']; ?> == 'code') {
    item.find('.code-icon-<?php echo $language['language_id']; ?>').show().next().hide();
  } else {
    item.find('.code-icon-<?php echo $language['language_id']; ?>').hide().next().show();
  }

  var imgicon<?php echo $language['language_id']; ?> = item.data('img<?php echo $language['language_id']; ?>');
  if (imgicon<?php echo $language['language_id']; ?>) {
    var src = '../image/'+imgicon<?php echo $language['language_id']; ?>;
    item.find('a.img-upload-<?php echo $language['language_id']; ?> > img').attr('src', src);
  }
  <?php } ?>
  <?php } ?>
})
.onItemStartEdit(function(item) {
  var el = $(item).find('>.item-wrapper .item-edit');
  itemedit(item,el);

  <?php foreach ($languages as $language) { ?>
  <?php if ($language['status']) { ?>
  $(item).find('.img-icon-<?php echo $language['language_id']; ?>').on('click', function(e){
    var target = $(e.target);
    if (target.hasClass('btn-danger')) {
      item.find('a.img-upload-<?php echo $language['language_id']; ?> > img').attr('src','../image/no_image.png');
      item.data('img<?php echo $language['language_id']; ?>','');
    }
  });
  <?php } ?>
  <?php } ?>
})
.onItemEndEdit(function(item) {
  var el = item.find('>.item-wrapper .item-edit');
  itemedit(item,el);
})
.parseJson()
.on(['onItemAdded', 'onItemRemoved', 'onItemDrop', 'onItemEndEdit'], function() {
  output(menu.toJson());
});

$('.cm-new-group').on('click', function() {
  $('.cm-new-item').trigger('click', ['group']);
});

function itemedit(item,el) {
  el.toggleClass('active');
  var wrap = $(item).find('>.item-wrapper');
  var box =  $(item).find('>.cm-edit-box');
  wrap.toggleClass('item-edit-active');
  box.slideToggle(300);
}
//--></script>
<script type="text/javascript"><!--
$("#form-yummenu").submit(function() {
  $('.notoutput-forms').remove();
});
function apply() {
  var data = $('.output-forms').find('input,select,textarea').not('.notoutput-forms input,.notoutput-forms select,.notoutput-forms textarea').serialize();
  $('.apply-fb').css({'opacity': '0'});
  $.ajax({
    url: 'index.php?route=extension/module/yumenu/apply&token=<?php echo $token; ?>',
    type: 'post',
    data: data +'&module_id=<?php echo $module_id; ?>',
    dataType: 'json',
    success: function(json) {
      $('input[name=\'name\']').closest('.form-group').removeClass('has-error');
      $('input[name=\'name\']').next('.text-danger').remove();
      if (json['error']) {
        if (json['error']['name']) {
          $('input[name=\'name\']').after('<div class="text-danger">' + json['error']['name'] + '</div>');
          $('input[name=\'name\']').closest('.form-group').addClass('has-error');
          $('#tablist a[href=#tab-module-setting]').tab('show');
          $('.apply-fb').html('<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['name'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
        }
        if (json['error']['permission']) {
          $('.apply-fb').html('<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['permission'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
        }
      }
      if (json['success']) {
        $('.apply-fb').html('<span class="text-success"><i class="fa fa-check"></i> ' + json['success'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}

function addItems($type) {
  if ($type == 'custom') {
    var fields = $('#custom :input, #custom select').serializeArray();
    var form_data =  objectifyForm(fields);
    menu.parseJson(JSON.stringify([form_data]));
    output(menu.toJson());

    $('#custom input.form-control').val('');
  } else {
    if ($type == 'product') {
      var result = $('#custom-list').sortable('toArray');
    } else {
      var result = $('#'+$type+'-selection').jstree('get_selected');
    }

    $.ajax({
      url: 'index.php?route=extension/module/yumenu/add&token=<?php echo $token; ?>',
      type: 'post',
      data: 'items='+ result + '&type='+ $type + '&module_id=<?php echo $module_id; ?>',
      dataType: 'json',
      success: function(json) {
        if (json['success']) {
          if (json['added'] =='[]') {
            console.log('empty');
          } else {
            menu.parseJson(json['added']);
            output(menu.toJson());
          }
          $('#items-select .deselect-all, #items-select .clear-list').trigger('click');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
}

function objectifyForm(formArray) {
  var result = {};
  for (var i = 0; i < formArray.length; i++){
    result[formArray[i]['name']] = formArray[i]['value'];
  }
  return result;
}

function products() {
  var ids = $('#product-list').sortable('toArray');
  $('input[name=\'structure[products]\']').val(ids);
}

function structure() {
  $('#form-upload').remove();
  $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="import" /></form>');
  $('#form-upload input[name=\'import\']').trigger('click');

  if (typeof timer != 'undefined') {
      clearInterval(timer);
  }

  timer = setInterval(function() {
    if ($('#form-upload input[name=\'import\']').val() != '') {
      clearInterval(timer);

      $.ajax({
        url: 'index.php?route=extension/module/yumenu/import&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        data: new FormData($('#form-upload')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
          if (json['error']) {
            if (json['error']['import']) {
              $('.apply-fb').html('<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['import'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
            }
          }
          if (json['success']) {
            menu.parseJson(json['import']);
            output(menu.toJson());
            $('.apply-fb').html('<span class="text-success"><i class="fa fa-check"></i> ' + json['success'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }
  }, 500);
}

function setting() {
  $('#form-upload').remove();
  $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="setting_import" /></form>');
  $('#form-upload input[name=\'setting_import\']').trigger('click');

  if (typeof timer != 'undefined') {
      clearInterval(timer);
  }

  timer = setInterval(function() {
    if ($('#form-upload input[name=\'setting_import\']').val() != '') {
      clearInterval(timer);

      $.ajax({
        url: 'index.php?route=extension/module/yumenu/setting_import&token=<?php echo $token; ?>&module_id=<?php echo $module_id; ?>',
        type: 'post',
        dataType: 'json',
        data: new FormData($('#form-upload')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function(json) {
          if (json['error']) {
            if (json['error']['import']) {
              $('.apply-fb').html('<span class="text-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['import'] + '</span>').animate({'opacity': '1'}, 300).delay(3000).animate({'opacity': '0'}, 300);
            }
          }
          if (json['success']) {
            $('.apply-fb').html('<span class="text-success"><i class="fa fa-check"></i> ' + json['success'] + '</span>').animate({'opacity': '1'}, 300).delay(1400).animate({'opacity': '0'}, 300);
            setTimeout(function() {location.reload();}, 2000);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }
  }, 500);
}

function output($data) {
  $.ajax({
    type: 'post',
    url: 'index.php?route=extension/module/yumenu/output&token=<?php echo $token; ?>',
    data: {output: $data, module_id: '<?php echo $module_id; ?>'},
    dataType: 'json',
    success: function(json) {},
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}
//--></script>
<?php echo $footer; ?>