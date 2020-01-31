<?php echo $header; ?>
<div id="content">
	<div class="page-header">
	    <div class="container-fluid">
	      <div class="pull-right"></div>
	      <h1><?php echo $column_attributes_bulk; ?></h1>
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
	        	<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $column_attributes; ?></h3>
	    	</div>
	    	<div class="panel-body">
	    		<form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">	  
	    			<ul class="nav nav-tabs">
			            <li class="active"><a href="#tab-attribute" data-toggle="tab"><?php echo $tab_text_insert; ?></a></li>
			            <li><a href="#tab-delete" data-toggle="tab"><?php echo $tab_text_delete; ?></a></li>
			        </ul>  			
	    			<div class="tab-content">
	    				<div class="tab-pane active" id="tab-attribute">
			              <div class="table-responsive">
			                <table id="attribute" class="table table-striped table-bordered table-hover">
			                  <thead>
			                    <tr>
			                      <td class="text-left"><?php echo $entry_attribute; ?></td>
			                      <td class="text-left"><?php echo $entry_text; ?></td>
			                      <td></td>
			                    </tr>
			                  </thead>
			                  <tbody>
			                    <?php $attribute_row = 0; ?>
			                    <?php foreach ($product_attributes as $product_attribute) { ?>
			                    <tr id="attribute-row<?php echo $attribute_row; ?>">
			                      <td class="text-left" style="width: 40%;"><input type="text" name="product_attribute[<?php echo $attribute_row; ?>][name]" value="<?php echo $product_attribute['name']; ?>" placeholder="<?php echo $entry_attribute; ?>" class="form-control" />
			                        <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" /></td>
			                      <td class="text-left"><?php foreach ($languages as $language) { ?>
			                        <div class="input-group"><span class="input-group-addon"><img src="<?php echo $language['flag_url']; ?>" title="<?php echo $language['name']; ?>" /></span>
			                          <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
			                        </div>
			                        <?php } ?></td>
			                      <td class="text-left"><button type="button" onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
			                    </tr>
			                    <?php $attribute_row++; ?>
			                    <?php } ?>
			                  </tbody>
			                  <tfoot>
			                    <tr>
			                      <td colspan="2"></td>
			                      <td class="text-left"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="<?php echo $button_attribute_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
			                    </tr>
			                  </tfoot>
			                </table>
			              </div>
	        				<button type="submit" form="form-product" class="btn btn-primary"><?php echo $button_text_save ?></button>
			            </div>
			            <div class="tab-pane" id="tab-delete">
			            	<?php echo $text_delete_info_attr ?><br /><br />
	        				<button form="form-product" class="btn btn-danger"><?php echo $button_text_delete ?></button>
			            </div>
	    			</div>
	    		</form>
	    	</div>
	    </div>
	</div>
</div>
<script type="text/javascript"><!--
var attribute_row = <?php echo $attribute_row; ?>;

function addAttribute() {
    html  = '<tr id="attribute-row' + attribute_row + '">';
	html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" placeholder="<?php echo $entry_attribute; ?>" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
	html += '  <td class="text-left">';
	<?php foreach ($languages as $language) { ?>
	html += '<div class="input-group"><span class="input-group-addon"><img src="<?php echo $language['flag_url']; ?>" title="<?php echo $language['name']; ?>" /></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" rows="5" placeholder="<?php echo $entry_text; ?>" class="form-control"></textarea></div>';
    <?php } ?>
	html += '  </td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

	$('#attribute tbody').append(html);

	attributeautocomplete(attribute_row);

	attribute_row++;
}

function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
		}
	});
}

$('#attribute tbody tr').each(function(index, element) {
	attributeautocomplete(index);
});
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