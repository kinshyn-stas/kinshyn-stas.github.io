<?php echo $header; ?>
<div class="container">

  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <?php include DIR_APPLICATION . '/view/theme/default/template/_breadcrumb.tpl'; ?>
      <h1><?php echo $heading_title; ?></h1>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <legend><?php echo $text_your_details; ?></legend>
            <?php foreach ($light_fields as $light_field) { ?>
              <?php if ($light_field['status_edit'] == 0) { ?>
                  <?php if ($light_field['type'] == 'select') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <select name="light_field[<?php echo $light_field['light_field_id']; ?>]" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($light_field['light_field_value'] as $light_field_value) { ?>
                        <?php if (isset($post_light_field[$light_field['light_field_id']]) && $light_field_value['light_field_value_id'] == $post_light_field[$light_field['light_field_id']]) { ?>
                        <option value="<?php echo $light_field_value['light_field_value_id']; ?>" selected="selected"><?php echo $light_field_value['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $light_field_value['light_field_value_id']; ?>"><?php echo $light_field_value['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'radio') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <div>
                        <?php foreach ($light_field['light_field_value'] as $light_field_value) { ?>
                        <div class="radio">
                          <?php if (isset($post_light_field[$light_field['light_field_id']]) && $light_field_value['light_field_value_id'] == $post_light_field[$light_field['light_field_id']]) { ?>
                          <label>
                            <input type="radio" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field_value['light_field_value_id']; ?>" checked="checked" />
                            <?php echo $light_field_value['name']; ?></label>
                          <?php } else { ?>
                          <label>
                            <input type="radio" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field_value['light_field_value_id']; ?>" />
                            <?php echo $light_field_value['name']; ?></label>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'text') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo (isset($post_light_field[$light_field['light_field_id']]) ? $post_light_field[$light_field['light_field_id']] : $light_field['value']); ?>" placeholder="<?php echo $light_field['name']; ?>" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'textarea') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <textarea name="light_field[<?php echo $light_field['light_field_id']; ?>]" rows="5" placeholder="<?php echo $light_field['name']; ?>" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control"><?php echo (isset($post_light_field[$light_field['light_field_id']]) ? $post_light_field[$light_field['light_field_id']] : $light_field['value']); ?></textarea>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'date') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group date">
                        <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo (isset($post_light_field[$light_field['light_field_id']]) ? $post_light_field[$light_field['light_field_id']] : $light_field['value']); ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'time') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group time">
                        <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo (isset($post_light_field[$light_field['light_field_id']]) ? $post_light_field[$light_field['light_field_id']] : $light_field['value']); ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="HH:mm" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if ($light_field['type'] == 'datetime') { ?>
                  <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                    <label class="col-sm-2 control-label" for="input-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group datetime">
                        <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo (isset($post_light_field[$light_field['light_field_id']]) ? $post_light_field[$light_field['light_field_id']] : $light_field['value']); ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                      <?php if (isset($error_light_field[$light_field['light_field_id']])) { ?>
                      <div class="text-danger"><?php echo $error_light_field[$light_field['light_field_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>
              <?php } ?>
          <?php } ?>
         </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
          <div class="pull-right">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php /*
<script type="text/javascript"><!--
// Sort the custom fields
$('.form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('.form-group').length) {
		$('.form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('.form-group').length) {
		$('.form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('.form-group').length) {
		$('.form-group:first').before(this);
	}
});
//--></script>
*/ ?>
 <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});
//--></script>
<?php echo $footer; ?>