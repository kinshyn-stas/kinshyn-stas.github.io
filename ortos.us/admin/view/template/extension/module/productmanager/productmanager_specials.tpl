<?php echo $header; ?>
<div id="content">
	<div class="page-header">
	    <div class="container-fluid">
	      <div class="pull-right">
	        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button></div>
	      <h1><?php echo $column_specials; ?></h1>
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
	        	<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $column_specials; ?></h3>
	    	</div>
	    	<div class="panel-body">
	    		<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">	    			
	    			<div class="tab-content">
	    				<div class="tab-pane active" id="tab-special">
			              <div class="table-responsive">
			                <table id="special" class="table table-striped table-bordered table-hover">
			                  <thead>
			                    <tr>
			                      <td class="text-left"><?php echo $entry_customer_group; ?></td>
			                      <td class="text-right"><?php echo $entry_priority; ?></td>
			                      <td class="text-right"><?php echo $entry_price; ?></td>
			                      <td class="text-left"><?php echo $entry_date_start; ?></td>
			                      <td class="text-left"><?php echo $entry_date_end; ?></td>
			                      <td></td>
			                    </tr>
			                  </thead>
			                  <tbody>
			                    <?php $special_row = 0; ?>
			                    <?php foreach ($product_specials as $product_special) { ?>
			                    <tr id="special-row<?php echo $special_row; ?>">
			                      <td class="text-left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]" class="form-control">
			                          <?php foreach ($customer_groups as $customer_group) { ?>
			                          <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
			                          <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
			                          <?php } else { ?>
			                          <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
			                          <?php } ?>
			                          <?php } ?>
			                        </select></td>
			                      <td class="text-right"><input type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>
			                      <td class="text-right"><input type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['price']; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>
			                      <td class="text-left" style="width: 20%;"><div class="input-group date">
			                          <input type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
			                          <span class="input-group-btn">
			                          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
			                          </span></div></td>
			                      <td class="text-left" style="width: 20%;"><div class="input-group date">
			                          <input type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" />
			                          <span class="input-group-btn">
			                          <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
			                          </span></div></td>
			                      <td class="text-left"><button type="button" onclick="$('#special-row<?php echo $special_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
			                    </tr>
			                    <?php $special_row++; ?>
			                    <?php } ?>
			                  </tbody>
			                  <tfoot>
			                    <tr>
			                      <td colspan="5"></td>
			                      <td class="text-left"><button type="button" onclick="addSpecial();" data-toggle="tooltip" title="<?php echo $button_special_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
			                    </tr>
			                  </tfoot>
			                </table>
			              </div>
			            </div>
	    			</div>
	    		</form>
	    	</div>
	    </div>
	</div>
</div>
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;

function addSpecial() {
	html  = '<tr id="special-row' + special_row + '">';
    html += '  <td class="text-left"><select name="product_special[' + special_row + '][customer_group_id]" class="form-control">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo addslashes($customer_group['name']); ?></option>';
    <?php } ?>
    html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][priority]" value="" placeholder="<?php echo $entry_priority; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="<?php echo $entry_price; ?>" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_start]" value="" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_end]" value="" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#special tbody').append(html);

	$('.date').datetimepicker({
		pickTime: false
	});

	special_row++;
}
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
<script>
	$('header').hide();
</script>