<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-product">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-productManager">
          <thead>
            <tr class="sorting">
              <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
              <?php foreach ($tableData as $key => $tData) { ?>
              	<?php if ((empty($tData['sort']) || empty($tData['url'])) && $key!='image') { ?>
					<td class="text-center" data-toggle="true" data-key="<?php echo $key; ?>"><?php echo $tData['name']; ?>
                   		<?php if ($tData['bulk']) { ?>
							<div style="float:right;" data-toggle="tooltip" title="<? echo $bulk_edit."&nbsp;&nbsp;'".$tData['name']."'"; ?>" ><i class="fa fa-pencil-square bulk-edit" data-key="<?php echo $key; ?>"></i></div>
                        <?php } ?>
                    </td>
                <?php } else if ($key == 'image') { ?>    
                  	<td class="text-center" data-toggle="true" data-key="<?php echo $key; ?>"><?php echo $tData['name']; ?>
                    	<div style="float:right;" data-toggle="tooltip" title="<? echo $bulk_edit."&nbsp;&nbsp;'".$tData['name']."'"; ?>" ><i data-toggle="modal" data-target="#bulk-image-upload" class="fa fa-pencil-square"></i></div>
                    </td>
                <?php } else { ?>
                    <td class="text-left" data-toggle="true" data-key="<?php echo $key; ?>"><?php if ($sort == $tData['sort']) { ?>
                        <a href="<?php echo $tData['url']; ?>" class="<?php echo strtolower($order); ?>"><?php echo $tData['name']; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $tData['url']; ?>"><?php echo $tData['name']; ?></a>
                        <?php } ?>
                        <?php if ($tData['bulk']) { ?>
                         <div style="float:right;" data-toggle="tooltip" title="<? echo $bulk_edit."&nbsp;&nbsp;'".$tData['name']."'"; ?>" ><i class="fa fa-pencil-square bulk-edit" data-key="<?php echo $key; ?>"></i></div>
                        <?php } ?>
                    </td>
                <?php } ?>
              <?php } ?>    
              <td class="text-right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($products) { ?>
                <?php foreach ($products as $product) { ?>
                <tr class="edit-tr" data-id="<?php echo $product['product_id']; ?>">
                    <td class="text-center"><?php if (in_array($product['product_id'], $selected)) { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                    <?php } else { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                    <?php } ?>
                    </td>
                    <?php foreach ($tableData as $key => $value) { ?>
                        <?php if ($key == 'image') { ?>
                            <td class="text-center edit-td" data-key="<?php echo $key; ?>">
                                <?php if ($product['image']) { ?>
                                    <a href="" id="thumb-image<?php echo $product['product_id']; ?>" data-toggle="image-manager" class="img-thumbnail"><img data-placeholder="<?php echo $placeholder; ?>" width="40" height="40" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"/></a>
                                <?php } else { ?>
                                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                                <?php } ?>
                            </td>
                        <?php } else if ($key == 'quantity') { ?>
                            <td class="text-right edit-td" data-key="<?php echo $key; ?>">
                                <?php if ($product['quantity'] <= 0) { ?>
                                    <span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?> label label-warning"><?php echo $product['quantity']; ?></span>
                                <?php } elseif ($product['quantity'] <= 5) { ?>
                                    <span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?> label label-danger"><?php echo $product['quantity']; ?></span>
                                <?php } else { ?>
                                    <span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?> label label-success"><?php echo $product['quantity']; ?></span>
                                <?php } ?>
                            </td>
                        <?php } else if ($key == 'price') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>">
                                <?php if ($product['special']) { ?>
                                    <span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>" style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                                    <div class="text-danger"><?php echo $product['special']; ?></div>
                                <?php } else { ?>
                                    <span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product['price']; ?></span>
                                <?php } ?>
                            </td>
                        <?php } else if($key == 'specials') { ?>
                            <td class="text-left" data-key="<?php echo $key; ?>">
                            <?php if (!empty($product['specials_count'])) { ?>
                                <?php if($product['specials_count'] == 1) { ?>
                                <span class="popup-specials editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_special_cnt,$product['specials_count']) ?></a></span>
                                <?php } else { ?>
                                <span class="popup-specials editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_special_cnt_plu,$product['specials_count']) ?></a></span>
                                <?php } ?>
                            <?php } else { ?>
                                <span class="popup-specials editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo $text_notset ?></a></span>
                            <?php } ?>
                            </td>
                        <?php } else if ($key == 'attributes') { ?>
                            <td class="text-left" data-key="<?php echo $key; ?>">
                            <?php if (!empty($product['attributes_count'])) { ?>
                                <?php if($product['attributes_count'] == 1) { ?>
                                <span class="popup-attributes editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_attr_cnt,$product['attributes_count']) ?></a></span>
                                <?php } else { ?>
                                <span class="popup-attributes editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_attr_cnt_plu,$product['attributes_count']) ?></a></span>
                                <?php } ?>
                            <?php } else { ?>
                                <span class="popup-attributes editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo $text_notset ?></a></span>
                            <?php } ?>
                            </td>
                        <?php } else if ($key == 'options') { ?>
                            <td class="text-left" data-key="<?php echo $key; ?>">
                            <?php if (!empty($product['options_count'])) { ?>
                                <?php if($product['options_count'] == 1) { ?>
                                <span class="popup-options editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_opts_cnt,$product['options_count']) ?></a></span>
                                <?php } else { ?>
                                <span class="popup-options editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo sprintf($text_opts_cnt_plu,$product['options_count']) ?></a></span>
                                <?php } ?>
                            <?php } else { ?>
                                <span class="popup-options editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><a href="#" onclick="javascript:void(0)"><?php echo $text_notset ?></a></span>
                            <?php } ?>
                            </td>
                        <?php } else if ($key == 'status') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-status="<?php echo $product['status_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td> 
						<?php } else if ($key == 'subtract') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-subtract="<?php echo $product['subtract_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td> 
                        <?php } else if ($key == 'shipping') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-shipping="<?php echo $product['shipping_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td>
						<?php } else if ($key == 'tax_class') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-tax_class="<?php echo $product['tax_class_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo (!empty($product[$key]) ? $product[$key] : '--- None ---'); ?></span></td> 
						<?php } else if ($key == 'stock_status') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-stock_status="<?php echo $product['stock_status_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td> 
						<?php } else if ($key == 'weight_class') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-weight_class="<?php echo $product['weight_class_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td>  
                        <?php } else if ($key == 'shipping') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-shipping="<?php echo $product['shipping_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td>
                        <?php } else if ($key == 'manufacturer') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span data-manufacturer="<?php echo $product['manufacturer_code']; ?>" class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo (!empty($product[$key]) ? $product[$key] : '--- None ---'); ?></span></td>  
                        <?php } else if ($key == 'category') { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>">
                            	<?php if (sizeof($product[$key])>0) { ?>
                                    <ul>
                                    <?php foreach ($product[$key] as $category) { ?>
                                        <li><?php echo $category['name']; ?></li>
                                    <?php } ?>
                                    </ul> 
                                <?php } else { ?>
                                	<center>- - -</center>
                                <?php } ?>
                            </td> 
                        <?php } else { ?>
                            <td class="text-left edit-td" data-key="<?php echo $key; ?>"><span class="editable <?php echo $product['product_id']; ?> <?php echo $key; ?>"><?php echo $product[$key]; ?></span></td> 
                        <?php } ?>
                    <?php } ?>  
                    <td class="text-right">
                    	<a href="<?php echo $product['edit']; ?>" target="_black" data-toggle="tooltip" title="<?php echo $quick_edit; ?>" class="btn btn-warning module-edit"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="<?php echo $product['edit']; ?>" target="_black" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo $product['orders']; ?>" target="_black" data-toggle="tooltip" title="<?php echo $button_orders; ?>" class="btn btn-info view-orders"><i class="fa fa-list-alt"></i></a>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                  	<td class="text-center" colspan="35"><?php echo $text_no_results; ?></td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-left pagination"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	 $('#productsWrapper .pagination a').click(function(e){
			e.preventDefault();
			$.ajax({
				url: this.href,
				type: 'get',
				dataType: 'html',
				success: function(data) {				
					$("#productsWrapper").html(data);
					updateTable();
				}
			});
	 });		 

	$('#productsWrapper .sorting a').click(function(e){
		e.preventDefault();
		$.ajax({
			url: this.href,
			type: 'get',
			dataType: 'html',
			success: function(data) {				
				$("#productsWrapper").html(data);
				updateTable();
			}
		});
	});
	
	editable();
});
</script>