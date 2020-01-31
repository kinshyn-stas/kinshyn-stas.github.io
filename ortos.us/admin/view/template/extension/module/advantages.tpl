<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-advantages" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-advantages" class="form-horizontal">

          <div class="form-group">
            <label class="col-sm-3 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-9">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>

      <ul class="nav nav-tabs" id="language">
        <?php foreach ($languages as $language) { ?>
        <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
        <?php } ?>
      </ul>

      <div class="tab-content">
        <?php foreach ($languages as $language) { ?>
        <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

          <div class="form-group required">
            <label class="col-sm-3 control-label"><?php echo $entry_title_module; ?></label>
            <div class="col-sm-9">
                <input type="text" name="title[<?php echo $language['language_id']; ?>]" value="<?php echo isset($title[$language['language_id']]) ? $title[$language['language_id']] : ''; ?>" placeholder="<?php echo $entry_title_module; ?>" class="form-control" />
              <?php if (isset($error_title[$language['language_id']])) { ?>
              <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
              <?php } ?>
            </div>
          </div>

	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-default">
	
			<div class="panel-heading">  
		                <div class="icon-block text-center input-group-btn">
				<?php if (!$icon1) { ?>
				<a href="" id="thumb-image-1-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb1; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
				<?php } else { ?>
				<a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-<?php echo $icon1; ?>" aria-hidden="true"></i></a>
				<?php } ?>
		
				<input type="hidden" name="image1[]" value="<?php echo $image1; ?>" id="input-image-1-<?php echo $language['language_id']; ?>" />
		
				<input type="text" id="1" name="icon1[]" value="<?php echo $icon1; ?>" placeholder="<?php echo $entry_icon; ?>" class="form-control text-center input-icon" />
		                </div>
			</div>
	
			<div class="panel-heading"> 	 
				<input type="text" name="module_description[<?php echo $language['language_id']; ?>][title_1]" value="<?php echo isset($module_description[$language['language_id']]['title_1']) ? $module_description[$language['language_id']]['title_1'] : ''; ?>" id="input-title-1<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
			</div>
	
			<div class="panel-body">
				<textarea rows=7 name="module_description[<?php echo $language['language_id']; ?>][description_1]" placeholder="<?php echo $entry_description; ?>" id="input-description-1<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_1']) ? $module_description[$language['language_id']]['description_1'] : ''; ?></textarea>
			</div>
	
			<div class="panel-footer">
				<input type="text" name="module_description[<?php echo $language['language_id']; ?>][link_1]" value="<?php echo isset($module_description[$language['language_id']]['link_1']) ? $module_description[$language['language_id']]['link_1'] : ''; ?>" id="input-link-1<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
			</div>
	             </div>
		</div>
	
		<div class="col-sm-3">
		<div class="panel panel-default">
	
		<div class="panel-heading">  
	                <div class="icon-block text-center input-group-btn">
			<?php if (!$icon2) { ?>
			<a href="" id="thumb-image-2-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb2; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
			<?php } else { ?>
			<a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-<?php echo $icon2; ?>" aria-hidden="true"></i></a>
			<?php } ?>
	
			<input type="hidden" name="image2[]" value="<?php echo $image2; ?>" id="input-image-2-<?php echo $language['language_id']; ?>" />
	
			<input type="text" id="2" name="icon2[]" value="<?php echo $icon2; ?>" placeholder="<?php echo $entry_icon; ?>" class="form-control text-center input-icon" />
	                </div>
		</div>
	
		<div class="panel-heading">
	            <input type="text" name="module_description[<?php echo $language['language_id']; ?>][title_2]" value="<?php echo isset($module_description[$language['language_id']]['title_2']) ? $module_description[$language['language_id']]['title_2'] : ''; ?>" id="input-title-2<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
		</div>
	
	        <div class="panel-body">
	              <textarea rows=7 name="module_description[<?php echo $language['language_id']; ?>][description_2]" placeholder="<?php echo $entry_description; ?>" id="input-description-2<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_2']) ? $module_description[$language['language_id']]['description_2'] : ''; ?></textarea>
		</div>
	
	        <div class="panel-footer">
	            <input type="text" name="module_description[<?php echo $language['language_id']; ?>][link_2]" value="<?php echo isset($module_description[$language['language_id']]['link_2']) ? $module_description[$language['language_id']]['link_2'] : ''; ?>" id="input-link-2<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
	       </div>
	    </div>
	</div>
	
		<div class="col-sm-3">
		<div class="panel panel-default">
	
		<div class="panel-heading">  
	                <div class="icon-block text-center input-group-btn">
			<?php if (!$icon3) { ?>
			<a href="" id="thumb-image-3-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb3; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
			<?php } else { ?>
			<a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-<?php echo $icon3; ?>" aria-hidden="true"></i></a>
			<?php } ?>
	
			<input type="hidden" name="image3[]" value="<?php echo $image3; ?>" id="input-image-3-<?php echo $language['language_id']; ?>" />
	
			<input type="text" id="3" name="icon3[]" value="<?php echo $icon3; ?>" placeholder="<?php echo $entry_icon; ?>" class="form-control text-center input-icon" />
	                </div>
		</div>
	
		<div class="panel-heading">
		    <input type="text" name="module_description[<?php echo $language['language_id']; ?>][title_3]" value="<?php echo isset($module_description[$language['language_id']]['title_3']) ? $module_description[$language['language_id']]['title_3'] : ''; ?>" id="input-title-3<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
		</div>
	
	        <div class="panel-body">
	              <textarea rows=7 name="module_description[<?php echo $language['language_id']; ?>][description_3]" placeholder="<?php echo $entry_description; ?>" id="input-description-3<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_3']) ? $module_description[$language['language_id']]['description_3'] : ''; ?></textarea>
	       </div>
	
	       <div class="panel-footer">
	            <input type="text" name="module_description[<?php echo $language['language_id']; ?>][link_3]" value="<?php echo isset($module_description[$language['language_id']]['link_3']) ? $module_description[$language['language_id']]['link_3'] : ''; ?>" id="input-link-3<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
	      </div>
	          </div>
		</div>
	
		<div class="col-sm-3">
		<div class="panel panel-default">
	
		<div class="panel-heading">  
	                <div class="icon-block text-center input-group-btn">
			<?php if (!$icon4) { ?>
			<a href="" id="thumb-image-4-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb4; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
			<?php } else { ?>
			<a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-<?php echo $icon4; ?>" aria-hidden="true"></i></a>
			<?php } ?>
	
			<input type="hidden" name="image4[]" value="<?php echo $image4; ?>" id="input-image-4-<?php echo $language['language_id']; ?>" />
	
			<input type="text" id="4" name="icon4[]" value="<?php echo $icon4; ?>" placeholder="<?php echo $entry_icon; ?>" class="form-control text-center input-icon" />
	                </div>
		</div>
	
		<div class="panel-heading">
	            <input type="text" name="module_description[<?php echo $language['language_id']; ?>][title_4]" value="<?php echo isset($module_description[$language['language_id']]['title_4']) ? $module_description[$language['language_id']]['title_4'] : ''; ?>" id="input-title-4<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
		</div>
	
	        <div class="panel-body">
	              <textarea rows=7 name="module_description[<?php echo $language['language_id']; ?>][description_4]" placeholder="<?php echo $entry_description; ?>" id="input-description-4<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_4']) ? $module_description[$language['language_id']]['description_4'] : ''; ?></textarea>
	       </div>
	
	       <div class="panel-footer">
	            <input type="text" name="module_description[<?php echo $language['language_id']; ?>][link_4]" value="<?php echo isset($module_description[$language['language_id']]['link_4']) ? $module_description[$language['language_id']]['link_4'] : ''; ?>" id="input-link-4<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
	      </div>
	      </div>
	   </div>
     <div class="col-sm-3">
      <div class="panel panel-default">
    
      <div class="panel-heading">  
                    <div class="icon-block text-center input-group-btn">
        <?php if (!$icon5) { ?>
        <a href="" id="thumb-image-5-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb5; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
        <?php } else { ?>
        <a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-<?php echo $icon5; ?>" aria-hidden="true"></i></a>
        <?php } ?>
    
        <input type="hidden" name="image5[]" value="<?php echo $image5; ?>" id="input-image-5-<?php echo $language['language_id']; ?>" />
    
        <input type="text" id="5" name="icon5[]" value="<?php echo $icon5; ?>" placeholder="<?php echo $entry_icon; ?>" class="form-control text-center input-icon" />
                    </div>
      </div>
    
      <div class="panel-heading">
                <input type="text" name="module_description[<?php echo $language['language_id']; ?>][title_5]" value="<?php echo isset($module_description[$language['language_id']]['title_5']) ? $module_description[$language['language_id']]['title_5'] : ''; ?>" id="input-title-5<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_title; ?>" class="form-control" />
      </div>
    
            <div class="panel-body">
                  <textarea rows=7 name="module_description[<?php echo $language['language_id']; ?>][description_5]" placeholder="<?php echo $entry_description; ?>" id="input-description-5<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($module_description[$language['language_id']]['description_5']) ? $module_description[$language['language_id']]['description_5'] : ''; ?></textarea>
           </div>
    
           <div class="panel-footer">
                <input type="text" name="module_description[<?php echo $language['language_id']; ?>][link_5]" value="<?php echo isset($module_description[$language['language_id']]['link_5']) ? $module_description[$language['language_id']]['link_5'] : ''; ?>" id="input-link-5<?php echo $language['language_id']; ?>" placeholder="<?php echo $entry_link; ?>" class="form-control" />
          </div>
          </div>
       </div>
	    </div>
</div>
        <?php } ?>
      </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-image-width"><?php echo $entry_size_image; ?></label>
            <div class="col-sm-9">
		<div class="row">
		<div class="col-sm-6">
		<input type="text" name="image_width" value="<?php echo $image_width; ?>" id="input-image-width" class="form-control" placeholder="<?php echo $entry_image_width; ?>" /></div>		 
		<div class="col-sm-6"><input type="text" name="image_height" value="<?php echo $image_height; ?>" id="input-image-height" class="form-control" placeholder="<?php echo $entry_image_height; ?>" /></div>
		</div>
            </div>
          </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-icon-size"><?php echo $entry_icon_size; ?></label>
            <div class="col-sm-9">
		<input type="text" name="icon_size" value="<?php echo $icon_size; ?>" id="input-icon-size" class="form-control" placeholder="<?php echo $help_icon_size; ?>" /></div>
		 
            </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-icon-color"><?php echo $entry_icon_color; ?></label>
            <div class="col-sm-9">
		<input type="text" name="icon_color" value="<?php echo $icon_color; ?>" id="input-icon-color" class="form-control" placeholder="<?php echo $help_icon_color; ?>" /></div>
            </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-title-size"><?php echo $entry_title_size; ?></label>
            <div class="col-sm-9">
		<input type="text" name="title_size" value="<?php echo $title_size; ?>" id="input-title-size" class="form-control" /></div>
            </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-title-color"><?php echo $entry_title_color; ?></label>
            <div class="col-sm-9">
		<input type="text" name="title_color" value="<?php echo $title_color; ?>" id="input-title-color" class="form-control" /></div>
         </div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-text-color"><?php echo $entry_text_color; ?></label>
            <div class="col-sm-9">
		<input type="text" name="text_color" value="<?php echo $text_color; ?>" id="input-text-color" class="form-control" /></div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="input-image-position"><?php echo $entry_image_position; ?></label>
            <div class="col-sm-9">
              <select name="image_position" id="input-image-position" class="form-control">
                <?php foreach ($image_positions as $type_id => $name) { ?>
                <?php if ($type_id == $image_position) { ?>
                <option value="<?php echo $type_id; ?>" selected="selected"><?php echo $name; ?></option>
                <?php } else { ?>
                <option value="<?php echo $type_id; ?>"><?php echo $name; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="input-title-show"><?php echo $entry_title_show; ?></label>
            <div class="col-sm-9">
              <select name="title_show" id="input-title-show" class="form-control">
                <?php if ($title_show) { ?>
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
            <label class="col-sm-3 control-label" for="input-readmore-show"><?php echo $entry_readmore_show; ?></label>
            <div class="col-sm-9">
              <select name="readmore_show" id="input-readmore-show" class="form-control">
                <?php if ($readmore_show) { ?>
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
            <label class="col-sm-3 control-label" for="input-blocks-inline"><?php echo $entry_blocks_inline; ?></label>
            <div class="col-sm-9">
                    <select name="blocks_inline" id="input-blocks-inline" class="form-control">
		      <option value="3">4</option>
                      <?php foreach ($blocks as $col => $name) { ?>
                      <?php if ($col == $blocks_inline) { ?>
                      <option value="<?php echo $col; ?>" selected="selected"><?php echo $name; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $col; ?>"><?php echo $name; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
            </div>
          </div>

	 <div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $entry_background; ?></label>
		<div class="col-sm-9"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
		  <input type="hidden" name="background" value="<?php echo $background; ?>" id="input-image" />
		</div>
	</div>

	  <div class="form-group">
            <label class="col-sm-3 control-label" for="input-background-color"><?php echo $entry_background_color; ?></label>
            <div class="col-sm-9">
		<input type="text" name="background_color" value="<?php echo $background_color; ?>" id="input-background-color" placeholder="#FFFFFF" class="form-control" /></div>
         </div>

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
      </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript"><!--
$('#language a:first').tab('show');
$('body').on('change', '.input-icon', function() {
	var icon_value = $(this).val();
	var id = this.id;
	if (icon_value) {
		$(this).prevAll('.image-select').remove();
		$(this).prevAll('.icon-select').remove();
		$(this).parent().prepend('<a href="javascript:void(0);" data-toggle="image" class="icon-select"><i style="height: 110px; font-size: 100px" class="fa fa-' + icon_value + ' img-thumbnail col-sm-12 icon-select" aria-hidden="true"></i></a>');
	}else{
		$(this).prev('.image-select').remove();
		$(this).prevAll('.icon-select').remove();
if (id == 1){
		$(this).parent().prepend('<a href="" id="thumb-image-1-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb1; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 2) {
		$(this).parent().prepend('<a href="" id="thumb-image-2-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb2; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 3) {
		$(this).parent().prepend('<a href="" id="thumb-image-3-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb3; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 4) {
		$(this).parent().prepend('<a href="" id="thumb-image-4-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb4; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
		$(this).prev('.image-select').remove();
	}
});

$('body').on('click', '.icon-select', function() {
		$(this).nextAll('.input-icon').val('');
		var id = $(this).nextAll('.input-icon').attr('id');
if (id == 1){
	$(this).replaceWith('<a href="" id="thumb-image-1-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb1; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 2){
	$(this).replaceWith('<a href="" id="thumb-image-2-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb2; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 3){
	$(this).replaceWith('<a href="" id="thumb-image-3-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb3; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
if (id == 4){
	$(this).replaceWith('<a href="" id="thumb-image-4-<?php echo $language['language_id']; ?>" data-toggle="image" class="img-thumbnail  text-center input-group-btn image-select"><img src="<?php echo $thumb4; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>');
}
});
//--></script>
<?php echo $footer; ?>