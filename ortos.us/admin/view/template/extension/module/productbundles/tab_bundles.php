<table class="table">
  <tbody>
    <tr>
      <td class="col-xs-4">
      	<h5><strong>Показывать случайные комплекты</strong>:</h5>
        <span class="help"><i class="fa fa-info-circle"></i>&nbsp;Если включено, модуль будет отображать комплекты случайно на <strong>макетах </strong>, где модуль выведен. Применяется только на страницах без комплектов.</span>
      </td>
	  <td class="col-xs-9">
		<div class="col-xs-4">
            <select name="<?php echo $moduleName; ?>[ShowRandomBundles]" class="form-control">
                <option value="yes" <?php echo (isset($moduleData['ShowRandomBundles']) && $moduleData['ShowRandomBundles'] == 'yes') ? 'selected=selected' : '' ?>>Включено</option>
               <option value="no" <?php echo (isset($moduleData['ShowRandomBundles']) && $moduleData['ShowRandomBundles'] == 'no') ? 'selected=selected' : '' ?>>Отключено</option>
            </select>
        </div>
      </td>
    </tr>
  </tbody>
</table>
<?php $token = $_GET['token']; ?>
<div class="table-responsive">
<table id="module" class="table table-bordered table-hover" width="100%" >
	<thead>
		<tr class="table-header">
			<td class="left" width="10%" style="vertical-align:top;">
            	<strong>Товары в комплекте:</strong><br /><span style="font-weight:normal;"><i class="icon-info-sign"></i><strong>Заметка:</strong> Если товары имеют значек <i class="fa fa-tags" style="color:#ab9a87;font-size:14px;"></i> - значит у них есть опции.</span>
            </td>
			<td class="left" width="15%" style="vertical-align:top;">
            	<strong>Настройки комлекта:</strong><br/><span style="font-weight:normal;"><i class="icon-info-sign"></i></span>
            </td>
            <td class="left" width="40%" style="vertical-align:top;">
            	<strong>Вывод комплекта:</strong><br/><span style="font-weight:normal;"><i class="icon-info-sign"></i> Выберите товары и категории, где модуль будет выведен <br /><strong>Заметка:</strong> Если имеется более одного комплекта, связанного с товаром / категорией, они будут отображаться случайным образом.</span></td>
            <td width="1%" style="vertical-align:top;">
            </td>
		</tr>
	</thead>
	<?php $module_row = 0; ?>
	<?php if (isset($CustomBundles)) { 
			foreach ($CustomBundles as $module) { ?>
           	 <?php if (!isset($module['id'])) { $module['id']=mt_rand(10000, 99999);} ?>
				<tbody id="module-row<?php echo $module['id']; ?>">
					<tr>
						<td class="left" style="vertical-align:top;">
                       		<input type="hidden" class="bundle_id" name="productbundles_custom[<?php echo $module['id']; ?>][id]" value="<?php echo $module['id']; ?>" />
                            <span style="vertical-align:middle;">Добавить товар:</span> <input type="text" name="productsInput" class="form-control" style="width:240px;display: inline-block;margin-bottom:5px;" value="" />
							<div id="product-bundle_<?php echo $module['id']; ?>" class="scrollbox first" style="width:320px;padding-right:0px;">
								<?php $class1 = 'odd'; ?>
								<?php if (!empty($module['products'])) {
									foreach ($module['products'] as $pr) { ?>
										 <?php $class1 = ($class1 == 'even' ? 'odd' : 'even'); ?>
										 <?php $product = $model_catalog_product->getProduct($pr); ?>
										 <?php $product_options = $model_catalog_product->getProductOptions($pr); ?>
										 <?php $product_specials = $model_catalog_product->getProductSpecials($pr); 
										 $special = false;
										 foreach ($product_specials  as $product_special) {
											if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
												$special = $product_special['price'];
												break;
											}					
									}
								?>
								<?php $final_price = ($special) ? $special : $product['price'] ?>
								<div id="product-bundle_<?php echo $module['id']; ?>_<?php echo $pr; ?>" class="<?php echo $class1; ?>"> 
									<?php if (!empty($product_options)) echo '<i class="fa fa-tags" style="color:#ab9a87;font-size:13px;"></i> '; ?><?php echo $product['name']; ?> - <?php echo $currencyLibrary->format($final_price, $config_currency); ?><i class="fa fa-minus-circle removeIcon" product_price="<?php echo $final_price ?>"></i>
									<input type="hidden" name="productbundles_custom[<?php echo $module['id']; ?>][products][]" value="<?php echo $pr; ?>" />
								</div>
									<?php }
                                } ?>
        					</div>
						</td>
          				<td class="left" style="vertical-align:top;">
                            <ul class="nav nav-tabs" style="margin-bottom:-1px;">
                              <li role="presentation" class="dropdown active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                  Заголовок <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php $i=0; foreach ($languages as $language) { ?>
                                        <li <?php if ($i==0) echo 'class="active"'; ?> ><a role="tab" data-toggle="tab" href="#<?php echo $module['id']; ?>-<?php echo $language['language_id']; ?>"><img src="<?php echo $language['flag_url']; ?>"/> <?php echo $language['name']; ?></a></li>
                                    <?php $i++; } ?>
                                </ul>
                              </li>
                            </ul>
                            <div class="tab-content">
                                <?php $i=0; foreach ($languages as $language) { ?>
                                    <div id="<?php echo $module['id']; ?>-<?php echo $language['language_id']; ?>" class="tab-pane <?php if ($i==0) echo 'active'; ?>">
                                    	<div class="input-group">
                                          <span class="input-group-addon"><img src="<?php echo $language['flag_url']; ?>"/></span>
                                          <input type="text" class="form-control" name="productbundles_custom[<?php echo $module['id']; ?>][name][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['name'][$language['language_id']]) ? $module['name'][$language['language_id']] : ''; ?>" />
                                        </div>
                                        
                                    </div> 
                                <?php $i++; } ?>
                            </div>
	                        <br />
          					<div id="product-bundle-prices_<?php echo $module['id']; ?>">
              					<h5>Общая стоимость: <?php if ($currencyAlignment=="L") {  echo $currency; } ?><span id="product-bundle-totalprice_<?php echo $module['id']; ?>"><?php echo (!empty($module['totalprice'])) ? $module['totalprice'] : '0' ; ?></span><input type="hidden" name="productbundles_custom[<?php echo $module['id']; ?>][totalprice]" value="<?php echo (!empty($module['totalprice'])) ? $module['totalprice'] : '0' ; ?>" /><?php if ($currencyAlignment=="R") {  echo $currency; } ?> </h5>
								<h5>Стомость комплекта: <?php if ($currencyAlignment=="L") {  echo $currency; } ?><span id="product-bundle-price_<?php echo $module['id']; ?>"><?php echo (!empty($module['price'])) ? $module['price'] : '0' ; ?></span><input type="hidden" name="productbundles_custom[<?php echo $module['id']; ?>][price]" value="<?php echo (!empty($module['price'])) ? $module['price'] : '0' ; ?>" /><?php if ($currencyAlignment=="R") {  echo $currency; } ?></h5>
								<br />
                                <h5>Скидка:</h5>
                                 <div class="col-xs-12" style="float:none;margin:0px;padding:0px;">
									<?php if ($currencyAlignment=="L") {  ?>
                                        <div class="input-group">
                                          <span class="input-group-addon"><?php echo $currency; ?></span>
                                          <input class="input-mini voucherPrice form-control" name="productbundles_custom[<?php echo $module['id']; ?>][voucherprice]" id="product-bundle-voucherprice<?php echo $module['id']; ?>" type="text" value="<?php echo (!empty($module['voucherprice'])) ? $module['voucherprice'] : '0' ; ?>">
                                        </div>
                                    <?php } else { ?>
                                        <div class="input-group">
                                          <input class="input-mini voucherPrice form-control" name="productbundles_custom[<?php echo $module['id']; ?>][voucherprice]" id="product-bundle-voucherprice<?php echo $module['id']; ?>" type="text" value="<?php echo (!empty($module['voucherprice'])) ? $module['voucherprice'] : '0' ; ?>">
                                          <span class="input-group-addon"><?php echo $currency; ?></span>
                                        </div>
                                    <?php } ?>
              					</div>
							</div>
   						</td>
   						<td class="left" style="vertical-align:top;">
                        	<div style="float:left;padding-right:15px;padding-bottom:5px;">
                                <span style="vertical-align:middle;">&nbsp;Товар:</span> <input type="text" name="productsShow_Input" class="form-control" style="width:213px;display: inline-block;margin-bottom:5px;" value="" />
                                <div id="product-bundle-productsShow_<?php echo $module['id']; ?>" class="scrollbox second" style="width:265px;">
                                    <?php $class1 = 'odd'; ?>
                                    <?php if (!empty($module['productsShow'])) {
                                        foreach ($module['productsShow'] as $pr) { ?>
                                             <?php $class1 = ($class1 == 'even' ? 'odd' : 'even'); ?>
                                             <?php $product = $model_catalog_product->getProduct($pr); ?>
                                             <?php $product_options = $model_catalog_product->getProductOptions($pr); ?>
                                             <?php $product_specials = $model_catalog_product->getProductSpecials($pr); 
                                             $special = false;
                                             foreach ($product_specials  as $product_special) {
                                                if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
                                                    $special = $product_special['price'];
                                                    break;
                                                }					
                                            }
                                    ?>
                                    <?php $final_price = ($special) ? $special : $product['price'] ?>
									<div id="product-bundle-productsShow_<?php echo $module['id']; ?>_<?php echo $pr; ?>" class="<?php echo $class1; ?>"><?php echo $product['name']; ?><i class="fa fa-minus-circle removeIcon" product_price="<?php echo $final_price ?>"></i>
                                        <input type="hidden" name="productbundles_custom[<?php echo $module['id']; ?>][productsShow][]" value="<?php echo $pr; ?>" />
                                    </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                            <div style="float:left;">
                                <span style="vertical-align:middle;">Категория:</span> <input type="text" name="categoriesShow_Input" class="form-control" style="width:210px;display: inline-block;margin-bottom:5px;" value="" />
								<div id="product-bundle-categoriesShow_<?php echo $module['id']; ?>" class="scrollbox third" style="width:265px;">
									  <?php $class = 'odd'; ?>
                                      <?php if (!empty($module['categoriesShow'])) {
										  foreach ($module['categoriesShow'] as $product_category) { ?>
                                      		<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                                            <?php $category_info = $model_catalog_category->getCategory($product_category);
											$CategoryName = $category_info['path'] ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']; ?>
                                      		<div id="product-bundle-categoriesShow_<?php echo $module['id']; ?>_<?php echo $product_category; ?>" class="<?php echo $class; ?>"><?php echo $CategoryName; ?><i class="fa fa-minus-circle removeIcon"></i>
                                        		<input type="hidden" name="productbundles_custom[<?php echo $module['id']; ?>][categoriesShow][]" value="<?php echo $product_category; ?>" />
                                      		</div>
										  <?php }
									  } ?>
								</div>
                            </div>
   						</td>
         			<td style="vertical-align:bottom;text-align:center"><a onclick="$('#module-row<?php echo $module['id']; ?>').remove();" data-toggle="tooltip" data-original-title="Удалить комплект" class="btn btn-small btn-danger" style="text-decoration:none;"><i class="fa fa-trash"></i></a></td>
       			</tr>
      		</tbody>
			<?php $module_row++; ?>
     		<?php } } ?>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td style="text-align:center"><a onclick="addModule();" data-toggle="tooltip" data-original-title="Добавить новый комплект" class="btn btn-small btn-primary"><i class="fa fa-plus"></i></a></td>
        </tr>
    </tfoot>
</table>
</div>
 
<script type="text/javascript">
function addModule() {
	var module_row=Math.floor(Math.random() * 99999) + 10000;
	html  = '<tbody style="display:none;" id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left" style="vertical-align:top;">';
	html += '<input type="hidden" class="bundle_id" name="productbundles_custom[' + module_row + '][id]" value="' + module_row + '" />';
	html += '<span style="vertical-align:middle;">Добавить товар:</span> <input type="text" name="productsInput" class="form-control" style="width:240px;display: inline-block;margin-bottom:5px;" value="" />';
	html += '<div id="product-bundle_' + module_row + '" class="scrollbox first" style="width:320px;">';
	html += '</div>';	
	html += ' ';
	html += '    </td>';
	html += '    <td class="left" style="vertical-align:top;">';
	html += '<ul class="nav nav-tabs" style="margin-bottom:-1px;"><li role="presentation" class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Заголовок <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';
    <?php $i=0; foreach ($languages as $language) { ?>
    html += '<li <?php if ($i==0) echo 'class="active"'; ?> ><a role="tab" data-toggle="tab" href="#' + module_row + '-<?php echo $language['language_id']; ?>"><img src="<?php echo $language['flag_url']; ?>"/> <?php echo $language['name']; ?></a></li>';                          
    <?php $i++; } ?>
   	html += '</ul></li></ul><div class="tab-content">';                             
    <?php $i=0; foreach ($languages as $language) { ?>                          
    html += '<div id="' + module_row + '-<?php echo $language['language_id']; ?>" class="tab-pane <?php if ($i==0) echo 'active'; ?>"><div class="input-group"><span class="input-group-addon"><img src="<?php echo $language['flag_url']; ?>"/></span>';
	html += '<input type="text" class="form-control" name="productbundles_custom[' + module_row + '][name][<?php echo $language['language_id']; ?>]" value="" /></div></div>';
    <?php $i++; } ?>
	html += '</div><br />';
	html += '<h5>Общая стоимость: <?php if ($currencyAlignment=="L") {  echo $currency; } ?><span id="product-bundle-totalprice_' + module_row + '">0.0</span><input type="hidden" name="productbundles_custom[' + module_row + '][totalprice]" value="0.0" /><?php if ($currencyAlignment=="R") {  echo $currency; } ?></h5>';
	html += '<h5>Стоимость комплекта: <?php if ($currencyAlignment=="L") {  echo $currency; } ?><span id="product-bundle-price_' + module_row + '">0.0</span><input type="hidden" name="productbundles_custom[' + module_row + '][price]" value="0" /><?php if ($currencyAlignment=="R") {  echo $currency; } ?></h5>';
	html += '<br /><h5>Скидка:</h5>';
	<?php if ($currencyAlignment=="L") {  ?>
	html += '<div class="input-group">';
	html += '<span class="input-group-addon"><?php echo $currency; ?></span>';
	html += '<input class="input-mini voucherPrice form-control" name="productbundles_custom[' + module_row + '][voucherprice]" id="product-bundle-voucherprice' + module_row + '" type="text" value="0">';
	html += '</div>';
<?php } else { ?>
	html += '<div class="input-group">';
	html += '<input class="input-mini voucherPrice form-control" name="productbundles_custom[' + module_row + '][voucherprice]" id="product-bundle-voucherprice' + module_row + '" type="text" value="0">';
	html += '<span class="input-group-addon"><?php echo $currency; ?></span>';
	html += '</div>';
<?php } ?>
	html += '    </td>';
	html += '    <td class="left" style="vertical-align:top;">';
	html += '		<div style="float:left;padding-right:15px;padding-bottom:5px;"><span style="vertical-align:middle;">Товар:</span> <input type="text" name="productsShow_Input" class="form-control" style="width:213px;display: inline-block;margin-bottom:5px;" value="" />';
	html += '			<div id="product-bundle-productsShow_' + module_row + '" class="scrollbox second" style="width:265px;"></div>';
	html += '		</div>';	
	html += '		<div style="float:left;padding-right:12px;padding-bottom:5px;"><span style="vertical-align:middle;">Категория:</span> <input type="text" name="categoriesShow_Input" class="form-control" style="width:210px;display: inline-block;margin-bottom:5px;" value="" />';
	html += '			<div id="product-bundle-categoriesShow_' + module_row + '" class="scrollbox third" style="width:265px;"></div>';
	html += '		</div>';	
	html += '    </td>';
	html += '    <td style="vertical-align:bottom;text-align:center;"><a onclick="$(\'#module-row' + module_row + '\').remove();" data-toggle="tooltip" data-original-title="Удалить комплект" class="btn btn-small btn-danger"><i class="fa fa-trash"></i></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	$('#module-row' + module_row).fadeIn();
	initializeAutocomplete();
}

// Add Products
var initializeAutocomplete = function () {
	// Calculate Bundle Price
	$('.voucherPrice').on('keyup',function(){
		var bundle_id = $(this).parents('tr').find('.bundle_id').val();
		if ($('#product-bundle-voucherprice' + bundle_id).val) {
			var VoucherPrice = parseFloat( $('#product-bundle-totalprice_' + bundle_id).html() ) - parseFloat($('#product-bundle-voucherprice'+ bundle_id).val()).toFixed(2);
			$('#product-bundle-price_' + bundle_id).html(parseFloat(VoucherPrice).toFixed(2));
			$('input[name=\'productbundles_custom['+bundle_id+'][price]\']').val(VoucherPrice);
		}
	});
	
	var currentProductsInputObject;
	$('input[name=\'productsInput\']').keydown(function() {
		currentProductsInputObject = $(this);
	});
	$('input[name=\'productsInput\']').click(function() {
		currentProductsInputObject = $(this);
	});
	
	var currentProductsShowObject;
	$('input[name=\'productsShow_Input\']').keydown(function() {
		currentProductsShowObject = $(this);
	});
	$('input[name=\'productsShow_Input\']').click(function() {
		currentProductsShowObject = $(this);
	});
	
	var currentcategoriesShowObject;
	$('input[name=\'categoriesShow_Input\']').keydown(function() {
		currentcategoriesShowObject = $(this);
	});
	$('input[name=\'categoriesShow_Input\']').click(function() {
		currentcategoriesShowObject = $(this);
	});

	$('input[name=\'productsInput\']').autocomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&store_id=<?php echo $store['store_id']; ?>&filter_name=' +  encodeURIComponent(request) ,
				dataType: 'json',
				success: function(json) {		
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['product_id'],
							price: item['price'],
							special: item['special'],
							option: item['option']
						}
					}));
				}
			});
		}, 
		select: function(item) {
			var bundle_id = currentProductsInputObject.parents('tr').find('.bundle_id').val();
			
			var textOption="";
			if (item['option']!="")
			{
				textOption = '<i class="fa fa-tags" style="color:#ab9a87;font-size:13px;"></i> ';	
			}
			var real_price=0;
			if (item['special']==0) { real_price=item['price'] } else { real_price=item['special']; }
					
			currentProductsInputObject.parent().find('.scrollbox').append('<div id="product-bundle_' + bundle_id + '_' + item['value'] + '">' + textOption + item['label'] + ' - <?php if ($currencyAlignment=="L") {  echo $currency; } ?>' + parseFloat(real_price).toFixed(2) + '<?php if ($currencyAlignment=="R") {  echo $currency; } ?><i class="fa fa-minus-circle removeIcon" product_price="' + real_price + '"></i><input type="hidden" name="productbundles_custom['+bundle_id+'][products][]" value="' + item['value'] +'" /></div>');
			
			var TotalPrice = ( parseFloat( $('#product-bundle-totalprice_' + bundle_id).html() ) + parseFloat(real_price) ).toFixed(2);
			$('#product-bundle-totalprice_' + bundle_id).html(TotalPrice);
			$('input[name=\'productbundles_custom[' + bundle_id + '][totalprice]\']').val(TotalPrice);
			
			currentProductsInputObject.parent().find('#product-bundle_' + bundle_id + ' div:odd').attr('class', 'odd');
			currentProductsInputObject.parent().find('#product-bundle_' + bundle_id + ' div:even').attr('class', 'even');	
		}
	});
	
	$('.scrollbox.first').delegate('.fa-minus-circle', 'click', function() {
		var bundle_id = $(this).parents('tr').find('.bundle_id').val();
		var remove_price = ($(this).attr("product_price"));
		$(this).parent().remove();
		var RemovePrice = ( parseFloat( $('#product-bundle-totalprice_' + bundle_id).html() )-parseFloat(remove_price) ).toFixed(2);
		$('#product-bundle-totalprice_' + bundle_id).html(RemovePrice);
		$('input[name=\'productbundles_custom[' + bundle_id + '][totalprice]\']').val(RemovePrice);
	});
	
	// Show in Products
	$('input[name=\'productsShow_Input\']').autocomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&store_id=<?php echo $store['store_id']; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {		
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['product_id'],
							price: item['price'],
							special: item['special']
						}
					}));
				}
			});
		}, 
		select: function(item) {
			var bundle_id = currentProductsShowObject.parents('tr').find('.bundle_id').val();
			currentProductsShowObject.parent().find('#product-bundle-productsShow_' + bundle_id + '_' + item['value']).remove();
			currentProductsShowObject.parent().find('.second').append('<div id="product-bundle-productsShow_' + bundle_id + '_' + item['value'] + '">' + item['label'] + '<i class="fa fa-minus-circle removeIcon"></i><input type="hidden" name="productbundles_custom[' + bundle_id + '][productsShow][]" value="' + item['value'] +'" /></div>');
			
			currentProductsShowObject.parent().find('#product-bundle-productsShow_' + bundle_id + ' div:odd').attr('class', 'odd');
			currentProductsShowObject.parent().find('#product-bundle-productsShow_' + bundle_id + ' div:even').attr('class', 'even');		
		}
	});
	
	$('.scrollbox.second').delegate('.fa-minus-circle', 'click', function() {
		var bundle_id = $(this).parents('tr').find('.bundle_id').val();
		$(this).parent().remove();
		$(this).parent().find('#product-bundle-productsShow_' + bundle_id + ' div:odd').attr('class', 'odd');
		$(this).parent().find('#product-bundle-productsShow_' + bundle_id + ' div:even').attr('class', 'even');	
	});
	
	// Show in Categories
	$('input[name=\'categoriesShow_Input\']').autocomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {		
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['category_id']
						}
					}));
				}
			});
		}, 
		select: function(item) {
			var bundle_id = currentcategoriesShowObject.parents('tr').find('.bundle_id').val();
			currentcategoriesShowObject.parent().find('#product-bundle-categoriesShow_' + bundle_id + '_' + item['value']).remove();
			currentcategoriesShowObject.parent().find('.third').append('<div id="product-bundle-categoriesShow_' + bundle_id + '_' + item['value'] + '">' + item['label'] + '<i class="fa fa-minus-circle removeIcon"></i><input type="hidden" name="productbundles_custom[' + bundle_id + '][categoriesShow][]" value="' + item['value'] +'" /></div>');

			currentcategoriesShowObject.parent().find('#product-bundle-categoriesShow_' + bundle_id + ' div:odd').attr('class', 'odd');
			currentcategoriesShowObject.parent().find('#product-bundle-categoriesShow_' + bundle_id + ' div:even').attr('class', 'even');	
		}
	});
	
	$('.scrollbox.third, .scrollbox.second').delegate('.fa-minus-circle', 'click', function() {
		var bundle_id = $(this).parents('tr').find('.bundle_id').val();
		$(this).parent().remove();
		$(this).parent().find('#product-bundle-categoriesShow_' + bundle_id + ' div:odd').attr('class', 'odd');
		$(this).parent().find('#product-bundle-categoriesShow_' + bundle_id + ' div:even').attr('class', 'even');
	});
}
initializeAutocomplete();
</script>