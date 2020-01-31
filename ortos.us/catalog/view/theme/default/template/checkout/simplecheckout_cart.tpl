<div class="simplecheckout-block" id="simplecheckout_cart" <?php echo $hide ? 'data-hide="true"' : '' ?> <?php echo $has_error ? 'data-error="true"' : '' ?>>
<?php if ($display_header) { ?>
    <div class="checkout-heading panel-heading"><?php echo $text_cart ?></div>
<?php } ?>
<?php if ($attention) { ?>
    <div class="alert alert-danger simplecheckout-warning-block"><?php echo $attention; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
    <div class="alert alert-danger simplecheckout-warning-block"><?php echo $error_warning; ?></div>
<?php } ?>
        
        <div class="container-fluid">          
         
            <?php foreach ($products as $product) { ?>
                <?php if (!empty($product['recurring'])) { ?>
                    
                              <span style="float:left;line-height:18px; margin-left:10px;">
                            <strong><?php echo $text_recurring_item ?></strong>
                            <?php echo $product['profile_description'] ?>
                            </span>
                        
                    
                <?php } ?>
                <div class="row line_cart55"> 
                   <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3">
                        <div class="img_cart55">
                        <?php if ($product['thumb']) { ?>
                            <div class="image">
                                <a href="<?php echo $product['href']; ?>"><img class="img-responsive" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-9 col-md-9 col-lg-9">
                        <div class="name_cart55">
                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                            <?php if (!$product['stock'] && ($config_stock_warning || !$config_stock_checkout)) { ?>
                                <span class="product-warning">***</span>
                            <?php } ?>
                            <div class="options">
                            <?php foreach ($product['option'] as $option) { ?>
                            &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                            <?php } ?>
                            <?php if (!empty($product['recurring'])) { ?>
                            - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                            <?php } ?>
                            </div>
                            <?php if ($product['reward']) { ?>
                            <small><?php echo $product['reward']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="total"><?php echo $product['total']; ?></div>
                        <div class="remove"></div>
                    </div>
                   
                </div>
              
                <?php } ?>
            </div> 
            <div class="fon_cupon">   
                    <?php if (isset($modules['coupon'])) { ?>
                        <div class="simplecheckout-cart-total">
                            <div class="text_cupon"><?php echo $entry_coupon; ?></div>
                            <span class="inputs"><input class="form-control" type="text" data-onchange="reloadAll" name="coupon" value="<?php echo $coupon; ?>" /></span>
                            <?php if (isset($modules['coupon']) || (isset($modules['reward']) && $points > 0) || isset($modules['voucher'])) { ?>
                                <div class="simplecheckout-cart-total simplecheckout-cart-buttons">
                                    <span class="inputs buttons"><a id="simplecheckout_button_cart" data-onclick="reloadAll" class="button_oc"><span>Пересчитать</span></a></span>
                                </div>
                            <?php } ?>
                        </div>
                       
                    <?php } ?>
                    <?php if (isset($modules['reward']) && $points > 0) { ?>
                        <div class="simplecheckout-cart-total">
                            <span class="inputs"><?php echo $entry_reward; ?>&nbsp;<input class="form-control" type="text" name="reward" data-onchange="reloadAll" value="<?php echo $reward; ?>" /></span>
                        </div>
                    <?php } ?>
                    <?php if (isset($modules['voucher'])) { ?>
                        <div class="simplecheckout-cart-total">
                            <span class="inputs"><?php echo $entry_voucher; ?>&nbsp;<input class="form-control" type="text" name="voucher" data-onchange="reloadAll" value="<?php echo $voucher; ?>" /></span>
                        </div>
                    <?php } ?>
                   
                </div>
          
                <?php foreach ($vouchers as $voucher_info) { ?>
                    
                        <div class="image"></div>
                        <div class="name"><?php echo $voucher_info['description']; ?></div>
                        <div class="model"></div>
                        <div class="quantity">
                            <div class="input-group btn-block" style="max-width: 200px;">
                                <input class="form-control" type="text" value="1" disabled size="1" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" data-onclick="removeGift" data-gift-key="<?php echo $voucher_info['key']; ?>" type="button">
                                        <i class="fa fa-times-circle"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="price"><?php echo $voucher_info['amount']; ?></div>
                        <div class="total"><?php echo $voucher_info['amount']; ?></div>
                        <div class="remove"></div>
                    
                <?php } ?>
           
     
<?php foreach ($totals as $total) { ?>
    <div class="simplecheckout-cart-total" id="total_<?php echo $total['code']; ?>">
        <span><b><?php echo $total['title']; ?>:</b></span>
        <span class="simplecheckout-cart-total-value"><?php echo $total['text']; ?></span>
        <span class="simplecheckout-cart-total-remove">
            <?php if ($total['code'] == 'coupon') { ?>
                <i data-onclick="removeCoupon" title="<?php echo $button_remove; ?>" class="fa fa-times-circle"></i>
            <?php } ?>
            <?php if ($total['code'] == 'voucher') { ?>
                <i data-onclick="removeVoucher" title="<?php echo $button_remove; ?>" class="fa fa-times-circle"></i>
            <?php } ?>
            <?php if ($total['code'] == 'reward') { ?>
                <i data-onclick="removeReward" title="<?php echo $button_remove; ?>" class="fa fa-times-circle"></i>
            <?php } ?>
        </span>
    </div>
<?php } ?>

<input type="hidden" name="remove" value="" id="simplecheckout_remove">
<div style="display:none;" id="simplecheckout_cart_total"><?php echo $cart_total ?></div>
<?php if ($display_weight) { ?>
    <div style="display:none;" id="simplecheckout_cart_weight"><?php echo $weight ?></div>
<?php } ?>
<?php if (!$display_model) { ?>
    <style>
    .simplecheckout-cart col.model,
    .simplecheckout-cart th.model,
    .simplecheckout-cart td.model {
        display: none;
    }
    </style>
<?php } ?>
</div>