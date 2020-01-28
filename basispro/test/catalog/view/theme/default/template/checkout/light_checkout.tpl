<?php echo $header; ?>
<div class="container">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
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
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-7">
                <form class="form-horizontal" id="light-fields">
                    <?php foreach ($light_fields as $light_field) { ?>
                        <?php if ($light_field['status_cart'] == 0) { ?>
                            <?php if ($light_field['type'] == 'select') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <select name="light_field[<?php echo $light_field['light_field_id']; ?>]" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control">
                                            <option value=""><?php echo $text_select; ?></option>
                                            <?php foreach ($light_field['light_field_value'] as $light_field_value) { ?>
                                                <?php if (isset($light_field['value']) && $light_field_value['light_field_value_id'] == $light_field['value']) { ?>
                                                    <option value="<?php echo $light_field_value['name']; ?>" selected="selected"><?php echo $light_field_value['name']; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $light_field_value['name']; ?>"><?php echo $light_field_value['name']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'radio') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <div id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>">
                                            <?php foreach ($light_field['light_field_value'] as $light_field_value) { ?>
                                                <div class="radio">
                                                    <?php if (isset($light_field['value']) && $light_field_value['light_field_value_id'] == $light_field['value']) { ?>
                                                        <label>
                                                            <input type="radio" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field_value['name']; ?>" checked="checked"/>
                                                            <?php echo $light_field_value['name']; ?>
                                                        </label>
                                                    <?php } else { ?>
                                                        <label>
                                                            <input type="radio" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field_value['name']; ?>" />
                                                            <?php echo $light_field_value['name']; ?>
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'text') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field['value']; ?>" placeholder="<?php echo $light_field['name']; ?>" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'textarea') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <textarea name="light_field[<?php echo $light_field['light_field_id']; ?>]" rows="3" placeholder="<?php echo $light_field['name']; ?>" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control"><?php echo $light_field['value']; ?></textarea>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'date') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field['value']; ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'time') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <div class="input-group time">
                                            <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field['value']; ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="HH:mm" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($light_field['type'] == 'datetime') { ?>
                                <div class="form-group<?php echo ($light_field['required'] ? ' required' : ''); ?> light-field" data-sort="<?php echo $light_field['sort_order']; ?>">
                                    <label class="col-sm-4 control-label" for="input-payment-light-field<?php echo $light_field['light_field_id']; ?>"><?php echo $light_field['name']; ?></label>
                                    <div class="col-sm-8">
                                        <div class="input-group datetime">
                                            <input type="text" name="light_field[<?php echo $light_field['light_field_id']; ?>]" value="<?php echo $light_field['value']; ?>" placeholder="<?php echo $light_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-payment-light-field<?php echo $light_field['light_field_id']; ?>" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </form>
            </div>
            <div class="col-lg-7 col-md-6 col-sm-5">
                <div class="table-responsive">
                    <table class="table">

                        <thead>
                        <tr>
                            <td class="text-center  hidden-sm"><?php echo $column_image; ?></td>
                            <td class="text-left"><?php echo $column_name; ?></td>
                            <td class="text-left hidden-sm"><?php echo $column_model; ?></td>
                            <td class="text-left"><?php echo $column_quantity; ?></td>
                            <td class="text-right"><?php echo $column_total; ?></td>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td class="text-center hidden-sm"><?php if ($product['thumb']) { ?>
                                        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a>
                                    <?php } ?></td>
                                <td class="text-left">
                                    <?php if ($product['thumb']) { ?>
                                        <a class="hidden-lg visible-sm" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a>
                                    <?php } ?>
                                    <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                    <?php if (!$product['stock']) { ?>
                                        <span class="text-danger">***</span>
                                    <?php } ?>
                                    <?php if ($product['option']) { ?>
                                        <?php foreach ($product['option'] as $option) { ?>
                                            <br />
                                            <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($product['reward']) { ?>
                                        <br />
                                        <small><?php echo $product['reward']; ?></small>
                                    <?php } ?>
                                    <?php if ($product['recurring']) { ?>
                                        <br />
                                        <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                                    <?php } ?></td>
                                <td class="text-left hidden-sm"><?php echo $product['model']; ?></td>
                                <td class="text-left"><?php echo $product['quantity']; ?></td>
                                <td class="text-right"><?php echo $product['total']; ?></td>
                             </tr>
                        <?php } ?>
                        <?php foreach ($vouchers as $vouchers) { ?>
                            <tr>
                                <td class="hidden-sm"></td>
                                <td class="text-left"><?php echo $vouchers['description']; ?></td>
                                <td class="text-left hidden-sm"></td>
                                <td class="text-left">1</td>
                                 <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <table class="table">
                        <?php foreach ($totals as $total) { ?>
                            <tr id="code_<?php echo $total['code']; ?>" data-cost="<?php echo $total['value']; ?>">
                                <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
                                <td class="text-right"><?php echo $total['text']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="buttons clearfix">
                    <div class="pull-left">
                        <a href="<?php echo $edit_order; ?>" class="btn btn-dashed"><?php echo $button_edit_order; ?></a>
                    </div>
                    <div class="pull-right">
                        <input type="button" value="<?php echo $text_checkout_confirm; ?>" id="button-light" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
                    </div>
                </div>
            </div>
        </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
    <script>

        $(document).ready(function() {
            if ($('#code_sub_total').data('cost') === $('#code_total').data('cost')) {
                $('#code_sub_total').hide();
            }
        });

        $(document).delegate('#button-light', 'click', function() {
            $.ajax({
                url: 'index.php?route=checkout/light_checkout/light_checkout',
                type: 'post',
                data: $('#light-fields input[type=\'text\'], #light-fields input[type=\'date\'], #light-fields input[type=\'datetime-local\'], #light-fields input[type=\'time\'], #light-fields input[type=\'password\'], #light-fields input[type=\'radio\']:checked, #light-fields input[type=\'hidden\'], #light-fields textarea, #light-fields select'),
                dataType: 'json',
                beforeSend: function() {
                    $('#button-light').button('loading');
                },
                complete: function() {
                    $('#button-light').button('reset');
                },
                success: function(json) {
                    $('.text-danger').parent().parent().removeClass('has-error');
                    $('.alert, .text-danger').remove();
                    if (json['redirect']) {
                        location = json['redirect'];
                    } else if (json['error']) {

                        if (json['error']['warning']) {
                            $('#light-fields').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        }
                        for (i in json['error']) {
                            var element = $('#input-payment-' + i.replace('_', '-'));

                            if ($(element).parent().hasClass('input-group')) {
                                $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                            } else {
                                $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
                            }
                        }
                        // Highlight any found errors
                        $('.text-danger').parent().parent().addClass('has-error');
                    } else {
                        location = json['success_link'];
                    }
                }
            });
        });
    </script>
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
        <?php /* //TODO
        <style>
            #menu, footer, #search, #cart, #top {display: none;}
        </style>
        */ ?>
 <?php echo $footer; ?>