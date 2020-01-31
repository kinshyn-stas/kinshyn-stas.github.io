<?php echo $header; ?>
<?php if(!empty($moduleData['ViewCustomCSS'])): ?>
    <style>
        <?php echo htmlspecialchars_decode($moduleData['ViewCustomCSS']); ?>
    </style>
<?php endif; ?>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        	<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
	<h2 class="heading-title"><?php echo $heading_title; ?></h2>
	<div class="row"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-12'; ?>
        <?php } ?>
    	<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
        	<div class="pbListing-content">
            	<?php if (isset($Bundle)) { ?>
                	<div class="pbListing-box box-productbundles">
                    	<div class="box-content">
                         	<?php $i=0; ?>
                        	<div class="box-products">
                            	<?php foreach ($Bundle['products'] as $product) { ?>
                                	<?php if ($i!=0) { ?> 
                                    	<div class="PB_plusbutton">+</div>
                                	<?php } ?>
                                	<div class="PB_product">
                                    	<?php if ($product['quantity'] > 1) { ?>
                                        	<span class="pb_quantity"><?php echo $product['quantity']; ?>x</span>
                                        <?php } ?>
                                    	<?php if ($product['thumb']) { ?>
                                        	<div class="PB_image"><a href="<?php echo $product['href']; ?>"><img class="PB_options_image" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                                    	<?php } ?>
                                        <div class="pb_name">
                                        	<a class="PB_product_name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                            <div class="pb_price">
                                                <?php if ($product['price']) { ?>
                                                    <?php if (!$product['special']) { ?>
                                                        <?php $Pprice = $product['price']; ?>
                                                    <?php } else { ?>
                                                        <?php $Pprice = $product['special']; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                                <strong><?php echo $Pprice; ?></strong>
                                       		</div>
                                        </div>
                                	</div>
                            	<?php $i++; } ?>
                                <div class="PB_bundle_info">
                                    <strong><span class="PB_bundle_total_price"><?php echo $ProductBundles_BundlePrice; ?> <?php echo $Bundle['FinalPrice']; ?></span></strong>
                                    <br />
                                    <strong><span><?php echo $ProductBundles_YouSave; ?> <?php echo $Bundle['VoucherPrice']; ?>!</span></strong>
                                    <br /><br />
                                    <center><a id="ProductBundlesSubmitButton" class="btn btn-primary btn-lg btn-block"><?php echo $ProductBundles_AddBundleToCart; ?></a></center>
                                    <form method="post" id="ProductBundlesForm">
                                        <input id="ProductBundlesOptions" type="hidden" name="products" value="<?php echo $Bundle['productOptions']; ?>" />
                                        <input id="ProductBundlesProducts" type="hidden" name="products" value="<?php echo $Bundle['BundleProducts']; ?>" />
                                        <input id="ProductBundlesDiscount" type="hidden" name="discount" value="<?php echo $Bundle['VoucherData']; ?>" />
                                        <input id="ProductBundlesBundleID" type="hidden" name="bundle" value="<?php echo $Bundle['BundleNumber']; ?>" />
                                    </form>                    
                                </div>
                        	</div>
                		</div>
            		</div> 
            	<?php } ?>
        	</div>
    	</div>
  		<?php echo $content_bottom; ?>
	</div>
  	<?php echo $column_right; ?>
</div>
<script>
jQuery(window).load(function () {
	$('.pbListing-box').delegate('#ProductBundlesSubmitButton', 'click', function(){
		if ($(this).parents('.PB_bundle_info').find('#ProductBundlesOptions').val()==true) {
			$.fancybox.open({
				href : 'index.php?route=<?php echo $modulePath; ?>/bundleproductoptions&bundle=' + $(this).parents('.PB_bundle_info').find('#ProductBundlesBundleID').val(),
				type : 'ajax',
				padding : 20,
				openEffect : 'elastic',
				openSpeed  : 150,
				fitToView   : true,
				closeBtn  : <?php echo $CloseButton; ?>
			});
	} else { 
		 $.ajax({
			url: 'index.php?route=<?php echo $modulePath; ?>/bundletocart',
			type: 'post',
			data: $(this).parents('.PB_bundle_info').find('#ProductBundlesForm').serialize(),
			dataType: 'json',
			success: function(json) {
				if (json['error']) {
					alert("There is a problem with the form. Please try again later.");
				}
				if (json['success']) {
					window.location = "<?php echo html_entity_decode($cart_url); ?>";	
				}
			}
		});
	}
});
});
</script>
<?php echo $footer; ?>