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
      <p><?php echo $text_account_already; ?></p>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend><?php echo $text_your_details; ?></legend>

          <div class="form-group required" style="display: <?php echo (count($customer_groups) > 1 ? 'block' : 'none'); ?>;" >
            <label class="col-sm-2 control-label"><?php echo $entry_customer_group; ?></label>
            <div class="col-sm-10">
              <?php foreach ($customer_groups as $customer_group) { ?>
              <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
              <div class="radio">
                <label>
                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                  <?php echo $customer_group['name']; ?></label>
              </div>
              <?php } else { ?>
              <div class="radio">
                <label>
                  <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" />
                  <?php echo $customer_group['name']; ?></label>
              </div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
           <?php foreach ($light_fields as $light_field) { ?>
               <?php if ($light_field['status_reg'] == 0) { ?>

              <?php if ($light_field['type'] == 'select') { ?>
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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
              <div id="light-field<?php echo $light_field['light_field_id']; ?>" class="form-group light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
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

        <fieldset>
          <legend><?php echo $text_your_password; ?></legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
            <div class="col-sm-10">
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php } ?>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend><?php echo $text_newsletter; ?></legend>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>
            <div class="col-sm-10">
              <?php if ($newsletter) { ?>
              <label class="radio-inline">
                <input type="radio" name="newsletter" value="1" checked="checked" />
                <?php echo $text_yes; ?></label>
              <label class="radio-inline">
                <input type="radio" name="newsletter" value="0" />
                <?php echo $text_no; ?></label>
              <?php } else { ?>
              <label class="radio-inline">
                <input type="radio" name="newsletter" value="1" />
                <?php echo $text_yes; ?></label>
              <label class="radio-inline">
                <input type="radio" name="newsletter" value="0" checked="checked" />
                <?php echo $text_no; ?></label>
              <?php } ?>
            </div>
          </div>
        </fieldset>
        <?php echo $captcha; ?>
        <?php if ($text_agree) { ?>
        <div class="buttons">
          <div class="pull-right"><?php echo $text_agree; ?>
            <?php if ($agree) { ?>
            <input type="checkbox" name="agree" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="agree" value="1" />
            <?php } ?>
            &nbsp;
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
        <?php } else { ?>
        <div class="buttons">
          <div class="pull-right">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
        <?php } ?>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
// Sort the custom fields
/*$('#account .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
		$('#account .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#account .form-group').length) {
		$('#account .form-group:first').before(this);
	}
});

$('#address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
		$('#address .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#address .form-group').length) {
		$('#address .form-group:first').before(this);
	}
});*/



$('input[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/light_register/customfield&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.light-field').hide();
			$('.light-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				light_field = json[i];

				$('#light-field' + light_field['light_field_id']).show();

				if (light_field['required']) {
					$('#light-field' + light_field['light_field_id']).addClass('required');
				}
			}


		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('input[name=\'customer_group_id\']:checked').trigger('change');
//--></script>

<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.time').datetimepicker({
	pickDate: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});
//--></script>

<?php echo $footer; ?>
