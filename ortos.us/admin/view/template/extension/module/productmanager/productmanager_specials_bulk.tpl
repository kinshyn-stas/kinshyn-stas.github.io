<?php echo $header; ?>
<div id="content">
	<div class="page-header">
	    <div class="container-fluid">
	      <div class="pull-right">
	        <button form="form-product" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i></button>
	        <button form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary btn-submit"><i class="fa fa-save"></i></button>
	      </div>
	      <h1><?php echo $column_specials_bulk; ?></h1>
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
			                <table id="special" class="table table-bordered table-hover" style="background-color: #f9f9f9">
			                  <thead>
			                    <tr>
			                      <td class="text-left"><?php echo $entry_customer_group; ?></td>
			                      <td class="text-right"><?php echo $entry_priority; ?></td>
			                      <td class="text-right"><?php echo $entry_price; ?></td>
			                      <td class="text-left"><?php echo $entry_date_start; ?></td>
			                      <td class="text-left"><?php echo $entry_date_end; ?></td>
			                      <td class="text-right"><?php echo $entry_actions; ?></td>
			                    </tr>
			                  </thead>
			                  <tbody id="main-body">
			                    <?php $special_row = 0; ?>
			                    <tr id="special-row<?php echo $special_row; ?>">
			                    	<td class="text-right" style="width: 17%">
					                    <select name="specials[<?php echo $special_row; ?>][customer_group]" class="form-control">
					                    	<option value="0"><?php echo $all_customer_groups; ?></option>
					                    	<?php foreach ($customer_groups as $customer_group) { ?>
					                    		<option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
					                    	<?php } ?>
					                    </select>
				                    </td>
				                    <td class="text-right" style="width: 15%">
					                    	<input type="text" name="specials[<?php echo $special_row; ?>][priority]" pattern="[0-9]+" title="Digits only" placeholder="<?php echo $entry_priority; ?>" class="form-control"/>
				                    </td>
				                    <td class="text-right" style="width: 18%;">
				                    	<div class="input-group">
				                    		<div class="input-group-btn" data-toggle="tooltip" data-original-title="Choose operation for Price edit">
				                    			<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
					                    			<i class="fa fa-caret-down"></i>
					                    		</button>
				                    			<input type="hidden" name="specials[<?php echo $special_row; ?>][price_operation]" value=""/>
					                    		<ul class="dropdown-menu">
					                    			<li>
					                    				<a data="operation_add" class="btn btn-link"><?php echo $operation_add; ?></a>
					                    			</li>
					                    			<li>
					                    				<a data="operation_subtract" class="btn btn-link"><?php echo $operation_subtract; ?></a>
					                    			</li>
					                    			<li>
					                    				<a data="operation_multiply" class="btn btn-link"><?php echo $operation_multiply; ?></a>
					                    			</li>
					                    			<li>
					                    				<a data="operation_divide" class="btn btn-link"><?php echo $operation_divide; ?></a>
					                    			</li>
 					                    		</ul>
				                    		</div>

				                    		<input type="text" name="specials[<?php echo $special_row; ?>][price]" required pattern="[0-9]+" title="Digits only" placeholder="<?php echo $entry_price; ?>" class="form-control" />

				                    		<div class="input-group-btn" data-toggle="tooltip" data-original-title="Choose units for Price edit">
				                    			<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
					                    			<i class="fa fa-caret-down"></i>
					                    		</button>
					                    		<ul class="dropdown-menu pull-right">
					                    			<li>
					                    				<a id="type_percent" class="btn btn-link" style="text-align: left">%</a>
					                    			</li>
					                    			<li>
					                    				<a id="type_fixed" class="btn btn-link" style="text-align: left"><?php echo $currency; ?></a>
					                    			</li>
 					                    		</ul>
				                    		</div>
				                    	</div>
				                    	<input type="hidden" name="specials[<?php echo $special_row; ?>][price_operation_type]" value=""/> 
				                    </td>
				                    <td class="text-right" style="width: 20%;">
				                    	<div class="input-group" data="date-helper">
				                    		<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
				                    		<input type="text" name="specials[<?php echo $special_row; ?>][date_start]" placeholder="<?php echo $entry_date_start; ?>" class="form-control date-time-picker" />
				                    	</div>
				                    </td>
				                    <td class="text-right" style="width: 20%;">
				                    	<div class="input-group" data="date-helper">
				                    		<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
				                    		<input type="text" name="specials[<?php echo $special_row; ?>][date_end]" placeholder="<?php echo $entry_date_end; ?>" class="form-control date-time-picker" />
				                    	</div>
				                    </td>
				                    <td class="text-center">
				                    	<button type="button" data-toggle="tooltip" data-original-title="Remove Row" class="btn btn-danger remove-special"><i class="fa fa-minus-circle"></i></button>
				                    </td>
			                    </tr>
			                  </tbody>
			                    <tr id="empty_row">
			                    	<td style="width: 17%;"></td>
			                    	<td style="width: 15%;"></td>
			                    	<td style="width: 18%;"></td>
			                    	<td style="width: 25%;"></td>
			                    	<td style="width: 25%;"></td>
			                    	<td class="text-center" style=" border: 0"><button type="button" onclick="addSpecial();" data-toggle="tooltip" data-original-title="Add Row" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
			                    </tr>
			                  <td style="vertical-align: top">	
			                  	<strong>Customer groups:</strong><br /><br />
			                  	- Choose the customer group/s you'd like the specials to apply to
			                  </td>
			                  <td style="vertical-align: top">	
			                  	<strong>Priority manipulations:</strong><br /><br />
								- Type the desired value in the textbox (0 by default)
			                  </td>
			                  <td style="vertical-align: top">	
			                  	<strong>Price manipulations:</strong><br /><br />
			                  	- Choose the operation type from the left arrow<br />
			                  	- Choose the units type from the right arrow<br />
			                  	- Type the desired value in the textbox
			                  </td>
			                  <td colspan="2" style="text-align: center; vertical-align: top">	
			                  	<strong>Date manipulations:</strong><br /><br />		      
			                  	- Click in the input field to view the date picker<br /><br />
			                  	<strong> Leave empty to disregard dates</strong>
			                  </td>
			                  <td></td>
			                </table>
			              </div>
			            </div>
	    			</div>
	    		</form>
	    	</div>
	    </div>
	</div>
</div>
<script type="text/javascript">
	$('header').hide();
</script>
<script type="text/javascript">
$(document).on('click', '.remove-special', function(e) {
	$(e.target).parents('tr:nth(0)').remove();
});

$(document).ready(function() {
	hookToButtons();

	$('.date-time-picker').datetimepicker({
		icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
        },
        pickTime: false,
        dateFormat: 'yy-mm-dd'
	});
});
</script>
<script type="text/javascript">
var special_row = 1;

function addSpecial() {
	var html = '';

	html += "<tr id='special-row" + special_row + "'>";

	html += '<td class="text-right" style="width: 17%"><select name="specials[' + special_row + '][customer_group]" class="form-control"><option value="0"><?php echo $all_customer_groups; ?></option><?php foreach ($customer_groups as $customer_group) { ?><option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option><?php } ?></select></td>';

	html += '<td class="text-right" style="width: 15%"><input type="text" name="specials[' + special_row + '][priority]" pattern="[0-9]+" title="Digits only" placeholder="<?php echo $entry_priority; ?>" class="form-control"/></td>';

	html += '<td class="text-right" style="width: 18%;"><div class="input-group"><div class="input-group-btn" data-toggle="tooltip" data-original-title="Choose operation for Price edit"><button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-caret-down"></i></button><input type="hidden" name="specials[' + special_row + '][price_operation]" value=""/><ul class="dropdown-menu"><li><a data="operation_add" class="btn btn-link"><?php echo $operation_add; ?></a></li><li><a data="operation_subtract" class="btn btn-link"><?php echo $operation_subtract; ?></a></li><li><a data="operation_multiply" class="btn btn-link"><?php echo $operation_multiply; ?></a></li><li><a data="operation_divide" class="btn btn-link"><?php echo $operation_divide; ?></a></li></ul></div><input type="text" name="specials[' + special_row + '][price]" required pattern="[0-9]+" title="Digits only" placeholder="<?php echo $entry_price; ?>" class="form-control" /><div class="input-group-btn" data-toggle="tooltip" data-original-title="Choose units for Price edit"><button data-toggle="dropdown" class="btn btn-default dropdown-toggle"><i class="fa fa-caret-down"></i></button><ul class="dropdown-menu pull-right"><li><a id="type_percent" class="btn btn-link" style="text-align: left">%</a></li><li><a id="type_fixed" class="btn btn-link" style="text-align: left"><?php echo $currency; ?></a></li></ul></div></div><input type="hidden" name="specials[' + special_row + '][price_operation_type]" value=""/></td>';

	html += '<td class="text-right" style="width: 25%;"><div class="input-group" data="date-helper"><span class="input-group-addon"><i class="fa fa-calendar-o"></i></span><input type="text" name="specials[' + special_row + '][date_start]" placeholder="<?php echo $entry_date_start; ?>" class="form-control date-time-picker" /></div></td>';

	html += '<td class="text-right" style="width: 25%;"><div class="input-group" data="date-helper"><span class="input-group-addon"><i class="fa fa-calendar-o"></i></span><input type="text" name="specials[' + special_row + '][date_end]" placeholder="<?php echo $entry_date_end; ?>" class="form-control date-time-picker" /></div></td>';

	html += '<td class="text-center"><button type="button" data-toggle="tooltip" data-original-title="Remove Row" class="btn btn-danger remove-special"><i class="fa fa-minus-circle"></i></button></td>';

	html += '</tr>';

	$('#main-body').append(html);
	hookToButtons();
	special_row++;
}
</script>
<script type="text/javascript">
// Price change operation dropdown
function hookToButtons() {

	$("a[data^=operation_]").on('click', function() {
		var operation  = $(this).attr('data').match(/[a-z]*$/i).toString();		
		var ul = $(this).parent().parent();
		var button = ul.parent().find('button');
		$(this).parent().parent().parent().parent().find('input[type=\'hidden\']').val(operation);

		switch(operation) {
			case 'multiply': operation = '*'; 		 break;
			case 'add'     : operation = 'plus';	 break;
			case 'subtract': operation = 'minus';	 break;
			case 'divide'  : operation = '/';     	 break;
			default: operation = 'caret-down';
		}

		if (operation.indexOf('*') == -1 && operation.indexOf('/') == -1) {
			ul.siblings().html('<i></i>');
			ul.parent().find('i').html('').removeClass().addClass('fa fa-' + operation);
		}
		else {
			ul.parent().find('i').removeClass().addClass('fa');
			ul.siblings().html(operation);
		}

		if (button.hasClass('btn-danger')) {
			button.removeClass('btn-danger');
		}
	});

	// Type of change dropdown
	$("a[id^='type_']").on('click', function() {
		var type  = $(this).attr('id').match(/[a-z]*$/i).toString();	
		var ul = $(this).parent().parent();
		var button = ul.parent().find('button');
		$(this).parent().parent().parent().parent().parent().find("input[name$='operation_type]']").val(type);

		switch(type) {
			case 'percent': type = '%'; break;
			case 'fixed'  : type = "<?php echo $currency; ?>";  break;
			default: type = 'caret-down';
		}

		if (button.hasClass('btn-danger')) {
			button.removeClass('btn-danger');
		}

		ul.siblings().html(type);
	});

	$('.date-time-picker').datetimepicker({
		icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
        },
        pickTime: false,
        dateFormat: 'yy-mm-dd'
	});

	$('[data-toggle=\'tooltip\']').tooltip();
}
</script>