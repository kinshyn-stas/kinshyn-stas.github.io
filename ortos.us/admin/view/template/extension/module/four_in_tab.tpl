<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#featured" data-toggle="tab"><?php echo $module_featured; ?></a></li>
            <li><a href="#bestseller" data-toggle="tab"><?php echo $module_bestseller; ?></a></li>
            <li><a href="#latest" data-toggle="tab"><?php echo $module_latest; ?></a></li>
            <li><a href="#special" data-toggle="tab"><?php echo $module_special; ?></a></li>
            <li><a href="#carousel" data-toggle="tab">Owl Carousel</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-general">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status">
                    <?php if ($status) { ?>
                    <label class="btn btn-success on active" for="status">
                      <input type="radio" name="status" id="status-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status">
                      <input type="radio" name="status" id="status-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status">
                      <input type="radio" name="status" id="status-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status">
                      <input type="radio" name="status" id="status-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>                            
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                  <?php if ($error_name) { ?>
                  <div class="text-danger"><?php echo $error_name; ?></div>
                  <?php } ?>
                </div>
              </div>          
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-width"><?php echo $entry_width; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="width" value="<?php echo $width; ?>" placeholder="<?php echo $entry_width; ?>" id="input-width" class="form-control" />
                  <?php if ($error_width) { ?>
                  <div class="text-danger"><?php echo $error_width; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                  <?php if ($error_height) { ?>
                  <div class="text-danger"><?php echo $error_height; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-description">
                    <?php if ($description) { ?>
                    <label class="btn btn-success on active" for="description-1">
                      <input type="radio" name="description" id="description-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="description-0">
                      <input type="radio" name="description" id="description-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="description-1">
                      <input type="radio" name="description" id="description-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="description-0">
                      <input type="radio" name="description" id="description-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-limit-description"><?php echo $entry_limit_description; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="limit_description" value="<?php echo $limit_description; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit-description" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-adaptive"><?php echo $entry_adaptive; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-adaptive">
                    <?php if ($adaptive) { ?>
                    <label class="btn btn-success on active" for="adaptive-1">
                      <input type="radio" name="adaptive" id="adaptive-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="adaptive-0">
                      <input type="radio" name="adaptive" id="adaptive-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="adaptive-1">
                      <input type="radio" name="adaptive" id="adaptive-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="adaptive-0">
                      <input type="radio" name="adaptive" id="adaptive-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-theme"><?php echo $entry_theme; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-theme">
                    <label class="btn btn-success on <?php echo ($theme == 'tab')? 'active' : ''; ?>" for="input-theme-tab">
                      <input type="radio" name="theme" id="input-theme-tab" value="tab" autocomplete="off" <?php echo ($theme == 'tab')? 'checked' : ''; ?>><?php echo $entry_tab; ?>
                    </label>
                    <label class="btn btn-success on <?php echo ($theme == 'panel')? 'active' : ''; ?>" for="input-theme-panel">
                      <input type="radio" name="theme" id="input-theme-panel" value="panel" autocomplete="off" <?php echo ($theme == 'panel')? 'checked' : ''; ?>><?php echo $entry_panel; ?>
                    </label>
                    <label class="btn btn-success on <?php echo ($theme == 'site')? 'active' : ''; ?>" for="input-theme-site">
                      <input type="radio" name="theme" id="input-theme-site" value="site" autocomplete="off" <?php echo ($theme == 'site')? 'checked' : ''; ?>><?php echo $entry_site_theme; ?>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="featured">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status-featured"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status-featured">
                    <?php if ($status_featured) { ?>
                    <label class="btn btn-success on active" for="status-featured-1">
                      <input type="radio" name="status_featured" id="status-featured-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status-featured-0">
                      <input type="radio" name="status_featured" id="status-featured-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status-featured-1">
                      <input type="radio" name="status_featured" id="status-featured-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status-featured-0">
                      <input type="radio" name="status_featured" id="status-featured-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name-featured"><?php echo $entry_name_tab; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"> <span class="input-group-addon"><img  src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="name_featured[<?php echo $language['language_id']; ?>]" value="<?php echo isset($name_featured[$language['language_id']]) ? $name_featured[$language['language_id']] : ''; ?>"  placeholder="<?php echo $entry_name_tab; ?>" id="input-name-featured" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-limit-featured"><?php echo $entry_limit; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="limit_featured" value="<?php echo $limit_featured; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit-featured" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-featured"><?php echo $entry_sort; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_featured" value="<?php echo $sort_featured; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort-featured" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-featured-adaptive"><?php echo $entry_adaptive; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile fa-lg"></i></span>
                        <span class="input-group-addon">col-xs-</span>
                        <select name="featured_xs" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($featured_xs == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg"></i></span>
                        <span class="input-group-addon">col-sm-</span>
                        <select name="featured_sm" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($featured_sm == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg fa-rotate-270"></i></span>
                        <span class="input-group-addon">col-md-</span>
                        <select name="featured_md" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($featured_md == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop fa-lg"></i></span>
                        <span class="input-group-addon">col-lg-</span>
                        <select name="featured_lg" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($featured_lg == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category-featured"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-category-featured">
                    <?php if ($category_featured) { ?>
                    <label class="btn btn-success on active" for="category-featured-1">
                      <input type="radio" name="category_featured" id="category-featured-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="category-featured-0">
                      <input type="radio" name="category_featured" id="category-featured-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="category-featured-1">
                      <input type="radio" name="category_featured" id="category-featured-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="category-featured-0">
                      <input type="radio" name="category_featured" id="category-featured-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                  <div id="featured-product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($products as $product) { ?>
                    <div id="featured-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                      <input type="hidden" name="product[]" value="<?php echo $product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="bestseller">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status-bestseller"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status-bestseller">
                    <?php if ($status_bestseller) { ?>
                    <label class="btn btn-success on active" for="status-bestseller-1">
                      <input type="radio" name="status_bestseller" id="status-bestseller-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status-bestseller-0">
                      <input type="radio" name="status_bestseller" id="status-bestseller-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status-bestseller-1">
                      <input type="radio" name="status_bestseller" id="status-bestseller-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status-bestseller-0">
                      <input type="radio" name="status_bestseller" id="status-bestseller-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name-bestseller"><?php echo $entry_name_tab; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"> <span class="input-group-addon"><img  src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="name_bestseller[<?php echo $language['language_id']; ?>]" value="<?php echo isset($name_bestseller[$language['language_id']]) ? $name_bestseller[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_name_tab; ?>" id="input-name-bestseller" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-limit-bestseller"><?php echo $entry_limit; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="limit_bestseller" value="<?php echo $limit_bestseller; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit-bestseller" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-bestseller"><?php echo $entry_sort; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_bestseller" value="<?php echo $sort_bestseller; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort-bestseller" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-bestseller-adaptive"><?php echo $entry_adaptive; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile fa-lg"></i></span>
                        <span class="input-group-addon">col-xs-</span>
                        <select name="bestseller_xs" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($bestseller_xs == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg"></i></span>
                        <span class="input-group-addon">col-sm-</span>
                        <select name="bestseller_sm" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($bestseller_sm == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg fa-rotate-270"></i></span>
                        <span class="input-group-addon">col-md-</span>
                        <select name="bestseller_md" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($bestseller_md == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop fa-lg"></i></span>
                        <span class="input-group-addon">col-lg-</span>
                        <select name="bestseller_lg" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($bestseller_lg == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category-bestseller"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-category-bestseller">
                    <?php if ($category_bestseller) { ?>
                    <label class="btn btn-success on active" for="category-bestseller-1">
                      <input type="radio" name="category_bestseller" id="category-bestseller-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="category-bestseller-0">
                      <input type="radio" name="category_bestseller" id="category-bestseller-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="category-bestseller-1">
                      <input type="radio" name="category_bestseller" id="category-bestseller-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="category-bestseller-0">
                      <input type="radio" name="category_bestseller" id="category-bestseller-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="latest">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status-latest"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status-latest">
                    <?php if ($status_latest) { ?>
                    <label class="btn btn-success on active" for="status-latest-1">
                      <input type="radio" name="status_latest" id="status-latest-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status-latest-0">
                      <input type="radio" name="status_latest" id="status-latest-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status-latest-1">
                      <input type="radio" name="status_latest" id="status-latest-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status-latest-0">
                      <input type="radio" name="status_latest" id="status-latest-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name-latest"><?php echo $entry_name_tab; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"> <span class="input-group-addon"><img  src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="name_latest[<?php echo $language['language_id']; ?>]" value="<?php echo isset($name_latest[$language['language_id']]) ? $name_latest[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_name_tab; ?>" id="input-name-latest" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-limit-latest"><?php echo $entry_limit; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="limit_latest" value="<?php echo $limit_latest; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit-latest" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-latest"><?php echo $entry_sort; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_latest" value="<?php echo $sort_latest; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort-latest" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-latest-adaptive"><?php echo $entry_adaptive; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile fa-lg"></i></span>
                        <span class="input-group-addon">col-xs-</span>
                        <select name="latest_xs" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($latest_xs == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg"></i></span>
                        <span class="input-group-addon">col-sm-</span>
                        <select name="latest_sm" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($latest_sm == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg fa-rotate-270"></i></span>
                        <span class="input-group-addon">col-md-</span>
                        <select name="latest_md" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($latest_md == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop fa-lg"></i></span>
                        <span class="input-group-addon">col-lg-</span>
                        <select name="latest_lg" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($latest_lg == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category-latest"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-category-latest">
                    <?php if ($category_latest) { ?>
                    <label class="btn btn-success on active" for="category-latest-1">
                      <input type="radio" name="category_latest" id="category-latest-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="category-latest-0">
                      <input type="radio" name="category_latest" id="category-latest-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="category-latest-1">
                      <input type="radio" name="category_latest" id="category-latest-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="category-latest-0">
                      <input type="radio" name="category_latest" id="category-latest-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="special">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status-special"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status-special">
                    <?php if ($status_special) { ?>
                    <label class="btn btn-success on active" for="status-special-1">
                      <input type="radio" name="status_special" id="status-special-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status-special-0">
                      <input type="radio" name="status_special" id="status-special-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status-special-1">
                      <input type="radio" name="status_special" id="status-special-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status-special-0">
                      <input type="radio" name="status_special" id="status-special-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-name-special"><?php echo $entry_name_tab; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"> <span class="input-group-addon"><img  src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="name_special[<?php echo $language['language_id']; ?>]" value="<?php echo isset($name_special[$language['language_id']]) ? $name_special[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_name_tab; ?>" id="input-name-special" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-limit-special"><?php echo $entry_limit; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="limit_special" value="<?php echo $limit_special; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit-special" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-special"><?php echo $entry_sort; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_special" value="<?php echo $sort_special; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort-special" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-special-adaptive"><?php echo $entry_adaptive; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile fa-lg"></i></span>
                        <span class="input-group-addon">col-xs-</span>
                        <select name="special_xs" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($special_xs == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg"></i></span>
                        <span class="input-group-addon">col-sm-</span>
                        <select name="special_sm" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($special_sm == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-tablet fa-lg fa-rotate-270"></i></span>
                        <span class="input-group-addon">col-md-</span>
                        <select name="special_md" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($special_md == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-desktop fa-lg"></i></span>
                        <span class="input-group-addon">col-lg-</span>
                        <select name="special_lg" class="form-control">
                          <?php $count = 1; ?>
                          <?php while ($count <= 12) { ?>
                          <option value="<?php echo $count; ?>"<?php echo ($special_lg == $count)? ' selected' : ''; ?>><?php echo $count; ?></option>
                          <?php $count++; ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category-special"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-category-special">
                    <?php if ($category_special) { ?>
                    <label class="btn btn-success on active" for="category-special-1">
                      <input type="radio" name="category_special" id="category-special-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="category-special-0">
                      <input type="radio" name="category_special" id="category-special-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="category-special-1">
                      <input type="radio" name="category_special" id="category-special-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="category-special-0">
                      <input type="radio" name="category_special" id="category-special-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="tab-pane fade" id="carousel">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status-carousel"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-status-carousel">
                    <?php if ($status_carousel) { ?>
                    <label class="btn btn-success on active" for="status-carousel-1">
                      <input type="radio" name="status_carousel" id="status-carousel-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="status-carousel-0">
                      <input type="radio" name="status_carousel" id="status-carousel-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="status-carousel-1">
                      <input type="radio" name="status_carousel" id="status-carousel-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="status-carousel-0">
                      <input type="radio" name="status_carousel" id="status-carousel-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-items"><?php echo $entry_limit; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="items" value="<?php echo $items; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-items" class="form-control" />
                </div>
              </div>          
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-autoplay"><?php echo $entry_autoplay; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="autoplay" value="<?php echo $autoplay; ?>" placeholder="<?php echo $entry_autoplay; ?>" id="input-autoplay" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-hover-carousel"><?php echo $entry_hover; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-hover-carousel">
                    <?php if ($hover) { ?>
                    <label class="btn btn-success on active" for="hover-carousel-1">
                      <input type="radio" name="hover" id="hover-carousel-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="hover-carousel-0">
                      <input type="radio" name="hover" id="hover-carousel-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="hover-carousel-1">
                      <input type="radio" name="hover" id="hover-carousel-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="hover-carousel-0">
                      <input type="radio" name="hover" id="hover-carousel-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2 text-right"><?php echo $entry_navigation; ?></div>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if ($navigation) { ?>
                    <label class="btn btn-success on active" for="navigation-carousel-1">
                      <input type="radio" name="navigation" id="navigation-carousel-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="navigation-carousel-0">
                      <input type="radio" name="navigation" id="navigation-carousel-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="navigation-carousel-1">
                      <input type="radio" name="navigation" id="navigation-carousel-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="navigation-carousel-0">
                      <input type="radio" name="navigation" id="navigation-carousel-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-prev"><?php echo $entry_prev; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="prev" value="<?php echo $prev; ?>" placeholder="<?php echo $entry_prev; ?>" id="input-prev" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-next"><?php echo $entry_next; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="next" value="<?php echo $next; ?>" placeholder="<?php echo $entry_next; ?>" id="input-next" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-pagination-carousel"><?php echo $entry_pagination; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons" id="input-pagination-carousel">
                    <?php if ($pagination) { ?>
                    <label class="btn btn-success on active" for="pagination-carousel-1">
                      <input type="radio" name="pagination" id="pagination-carousel-1" value="1" autocomplete="off" checked><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off" for="pagination-carousel-0">
                      <input type="radio" name="pagination" id="pagination-carousel-0" value="0" autocomplete="off"><?php echo $text_disabled; ?>
                    </label>
                    <?php } else { ?>
                    <label class="btn btn-success on" for="pagination-carousel-1">
                      <input type="radio" name="pagination" id="pagination-carousel-1" value="1" autocomplete="off"><?php echo $text_enabled; ?>
                    </label>
                    <label class="btn btn-danger off active" for="pagination-carousel-0">
                      <input type="radio" name="pagination" id="pagination-carousel-0" value="0" autocomplete="off" checked><?php echo $text_disabled; ?>
                    </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
	select: function(item) {
		$('input[name=\'product\']').val('');
		
		$('#featured-product' + item['value']).remove();
		
		$('#featured-product').append('<div id="featured-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product[]" value="' + item['value'] + '" /></div>');	
	}
});
	
$('#featured-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script></div>
<style>
.btn-success.on,
.btn-danger.off {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.btn-success.on:hover,
.btn-danger.off:hover {
    color: #333;
    background-color: #e6e6e6;
    border-color: #adadad;
}
.btn-success.on:active, .btn-success.on.active{
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn-success.on:active:hover, .btn-success.on.active:hover, .btn-success.on:active:focus, .btn-success.on.active:focus, .btn-success.on.focus:active, .btn-success.on.active.focus {
    color: #fff;
    background-color: #449d44;
    border-color: #398439;
}
.btn-danger.off:active, .btn-danger.off.active {
    color: #fff;
    background-color: #f23b3b;
    border-color: #ea1010;
}
.btn-danger.off:active:hover, .btn-danger.off.active:hover, .btn-danger.off:active:focus, .btn-danger.off.active:focus, .btn-danger.off.focus:active, .btn-danger.off.active.focus {
    color: #fff;
    background-color: #f01a1a;
    border-color: #ac0c0c;
}
</style>
<?php echo $footer; ?>