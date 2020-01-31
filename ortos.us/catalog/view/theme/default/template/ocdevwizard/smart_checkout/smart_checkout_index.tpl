<div id="smch-modal-body">
<!-- 
@category  : OpenCart
@module    : Smart Checkout
@author    : OCdevWizard <ocdevwizard@gmail.com> 
@copyright : Copyright (c) 2014, OCdevWizard
@license   : http://license.ocdevwizard.com/Licensing_Policy.pdf
-->
<script type="text/javascript" src="catalog/view/javascript/ocdevwizard/smart_checkout/smart_checkout.js"></script>
<?php if ($product_description && $hide_product_description) { ?>
<div class="slide-description">
  <div class="open b-hidden">i</div>
  <div class="content">
  <?php echo $product_description; ?>
  </div>
</div>  
<?php } ?>
<?php if (isset($text_info) && $display_info_text) { ?>
<div class="slide-informer">
  <div class="open b-hidden">?</div>
  <div class="content">
  <?php echo $text_info; ?>
  </div>
</div>  
<?php } ?>
<?php if ($attribute_groups && $hide_product_attributes) { ?>
<div class="slide-attributes">
  <div class="open b-hidden">&equiv;</div>
  <div class="content">
    <?php if ($attribute_groups) { ?>
        <table class="attributes-table">
          <?php foreach ($attribute_groups as $attribute_group) { ?>
          <thead>
            <tr>
              <td colspan="2"><?php echo $attribute_group['name']; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
            <tr>
              <td><?php echo $attribute['name']; ?></td>
              <td><?php echo $attribute['text']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <?php } ?>
        </table>
    <?php } ?>
  </div>
</div>  
<?php } ?>
<div class="modal-heading">
  <?php echo $heading_title; ?>
  <span class="modal-close" onclick="closeModal();"></span>
</div>
<div class="modal-body" id="check-data">
  <div id="smch-modal-data">
    <input name="product_id" type="hidden" value="<?php echo $product_id ?>" />
    <?php if ($hide_main_img || $hide_sub_img) { ?>

    <!-- IMAGE and SUB IMAGES -->
      <div class="image_block">
        <?php if ($hide_main_img) { ?>
          <div class="image<?php echo (!$hide_sub_img || !$images) ? " no_images" : ""; ?>">
            <img 
              src="<?php echo $thumb; ?>" 
              title="<?php echo $product_name; ?>" 
              alt="<?php echo $product_name; ?>" 
              id="smch-modal-image" 
            />
          </div>
        <?php } ?>
        <?php if ($hide_sub_img) { ?>
          <div class="images">
            <?php foreach ($images as $image) { ?>
              <img 
                src="<?php echo $image['thumb']; ?>" 
                title="<?php echo $product_name; ?>" 
                alt="<?php echo $product_name; ?>" 
                rel="<?php echo $image['popup']; ?>" 
                onclick="changeImage(this);" 
              />
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <!-- PROCESSING -->
    <div class="processing">

    <!-- NAME and ANOTHER DATA -->
      <div class="name">
        <span class="name_main"><?php echo $product_name; ?></span>
        <?php if ($product_model && $hide_product_model) { ?><span><b><?php echo $text_model; ?></b> <?php echo $product_model; ?></span><?php } ?>
        <?php if ($product_ean && $hide_product_ean) { ?><span><b><?php echo $text_ean; ?></b> <?php echo $product_ean; ?></span><?php } ?>
        <?php if ($product_jan && $hide_product_jan) { ?><span><b><?php echo $text_jan; ?></b> <?php echo $product_jan; ?></span><?php } ?>
        <?php if ($product_isbn && $hide_product_isbn) { ?><span><b><?php echo $text_isbn; ?></b> <?php echo $product_isbn; ?></span><?php } ?>
        <?php if ($product_mpn && $hide_product_mpn) { ?><span><b><?php echo $text_mpn; ?></b> <?php echo $product_mpn; ?></span><?php } ?>
        <?php if ($product_location && $hide_product_location) { ?><span><b><?php echo $text_location; ?></b> <?php echo $product_location; ?></span><?php } ?>
      </div>

      <!-- QUANTITY -->
      <div class="quantity" id="smch-quantity">
        <div>
          <button type="button" onclick="$(this).next().val(~~$(this).next().val()+1); update_quantity('<?php echo $product_id; ?>');" id="increase-quantity">+</button>
          <input 
            type="text" 
            name="quantity" 
            value="1" 
            onchange="reCalculate(); return validate_input(this);" 
            onkeyup="reCalculate(); return validate_input(this);" 
            class="input-quantity" 
          />
          <button type="button" onclick="$(this).prev().val(~~$(this).prev().val()-1); update_quantity('<?php echo $product_id; ?>');" id="decrease-quantity">&mdash;</button>
        </div>
      </div>

      <!-- TOTALS -->
      <div class="totals">
        <?php if ($price) { ?>
          <?php if ($special) { ?>
            <div id="ocdev-special"><?php echo $special; ?></div> 
            <div id="ocdev-price" class="old-price"><?php echo $price; ?></div>
          <?php } else { ?>
            <div id="ocdev-price"><?php echo $price; ?></div>
          <?php } ?>  
          <?php if ($tax) { ?><div class="tax"><span><?php echo $text_tax; ?></span> <div id="ocdev-tax"><?php echo $tax; ?></div></div><?php } ?>
        <?php } ?>
        <?php if ($discounts && $discount_status) { ?>
          <div class="discount">
            <?php foreach ($discounts as $discount) { ?>
            <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div>
    <div id="smch-data-accordion-sub">
      <?php if ($hide_voucher) { ?>
      <div>
        <div class="heading"><?php echo $tab_voucher; ?></div>
        <div class="collapse" id="collapse-voucher-information">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
      <?php if ($hide_coupon) { ?>
      <div>
        <div class="heading"><?php echo $tab_coupon; ?></div>
        <div class="collapse" id="collapse-coupon-information">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
      <?php if ($hide_reward && $reward) { ?>
      <div>
        <div class="heading"><?php echo $tabreward; ?></div>
        <div class="collapse" id="collapse-reward-information">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
    </div>
    <div id="smch-data-accordion">
      <div>
        <div class="heading"><?php echo $tab_user; ?></div>
        <div class="collapse" id="collapse-user-information">
          <div class="section"></div>
        </div>
      </div>
      <?php if ($product_options && isset($product_options_array) && $hide_product_options) { ?>
      <div>
        <div class="heading"><?php echo $tab_options; ?></div>
        <div class="collapse" id="collapse-product-options">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
      <?php if (isset($shipping_code_array)) { ?>
      <div>
        <div class="heading"><?php echo $tab_shipping; ?></div>
        <div class="collapse" id="collapse-shipping-method">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
      <?php if (isset($payment_code_array)) { ?>
      <div>
        <div class="heading"><?php echo $tab_payment; ?></div>
        <div class="collapse" id="collapse-payment-method">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
      <?php if (isset($payment_code_array) || isset($shipping_code_array)) { ?>
      <div>
        <div class="heading"><?php echo $tab_confirm; ?></div>
        <div class="collapse" id="collapse-checkout-confirm">
          <div class="section"></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>  
</div>
<?php if ((!isset($payment_code_array) && isset($shipping_code_array)) || (!isset($payment_code_array) && !isset($shipping_code_array))) { ?>
<!-- TOTALS COUNT and CHECKOUT BUTTON -->
<div class="modal-footer">
  <div class="totals"><span><?php echo $text_total_bottom; ?></span> <div id="total-order"><?php echo $total; ?></div></div>
  <input type="button" onclick="smch_output_simplified();" value="<?php echo $button_send; ?>" />
</div>
<?php } ?>

<script type="text/javascript"><!--
// loadmask function
function maskElement(element, status) {
  if (status == true) {
    $('<div/>')
    .attr('class', 'smch-modal-loadmask')
    .prependTo(element);
    $('<div class="smch-modal-loadmask-loading" />').insertAfter($('.smch-modal-loadmask'));
  } else {
    $('.smch-modal-loadmask').remove();
    $('.smch-modal-loadmask-loading').remove();
  }
}

function validate_input(input) {
  input.value = input.value.replace(/[^\d,]/g, '');
}

function changeImage(image_id) {
  $('#smch-modal-image').attr('src', $(image_id).attr('rel'));
  return false;
}

$(function() {
  <?php if ($hide_voucher) { ?>
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/voucher_index',
      dataType: 'html',
      success: function(html) {
        $('#collapse-voucher-information .section').html(html);

        $('#collapse-voucher-information').parent().find('.heading').html('<a href="#collapse-voucher-information" data-toggle="collapse" data-parent="#smch-data-accordion-sub"><?php echo $tab_voucher; ?> <i class="fa fa-caret-down"></i></a>');
      }
    });
  <?php } ?>
  <?php if ($hide_coupon) { ?>
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/coupon_index',
      dataType: 'html',
      success: function(html) {
        $('#collapse-coupon-information .section').html(html);

        $('#collapse-coupon-information').parent().find('.heading').html('<a href="#collapse-coupon-information" data-toggle="collapse" data-parent="#smch-data-accordion-sub"><?php echo $tab_coupon; ?> <i class="fa fa-caret-down"></i></a>');
      }
    });
  <?php } ?>
  <?php if ($hide_reward && $reward) { ?>
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/reward_index',
      dataType: 'html',
      success: function(html) {
        $('#collapse-reward-information .section').html(html);

        $('#collapse-reward-information').parent().find('.heading').html('<a href="#collapse-reward-information" data-toggle="collapse" data-parent="#smch-data-accordion-sub"><?php echo $tab_reward; ?> <i class="fa fa-caret-down"></i></a>');
      }
    });
  <?php } ?>
  
  $.ajax({
    url: 'index.php?route=ocdevwizard/smart_checkout/user',
    dataType: 'html',
    success: function(html) {
      $('#collapse-user-information .section').html(html);

      $('#collapse-user-information').parent().find('.heading').html('<a href="#collapse-user-information" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_user; ?> <i class="fa fa-caret-down"></i></a>');

      $('a[href=\'#collapse-user-information\']').trigger('click');
    }
  });
});

// User
function smch_user() {
  maskElement('#smch-modal-data', true);

  $.ajax({
      type: 'post',
      url: 'index.php?route=ocdevwizard/smart_checkout/user_save',
      data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
      dataType: 'json',
      success: function(json) {

        if (json['error']) {
          $('.field-error').remove();
          $('.ocdev-smart-checkout-fields input, .ocdev-smart-checkout-fields textarea, .ocdev-smart-checkout-fields select').removeClass('error-style error-style-table');
         
          if (json['error']['field']) {
            maskElement('#smch-modal-data', false);
            $.each(json['error']['field'], function(i, val) {
              $('[name="'+i+'"]').addClass('error-style').after('<span class="error-text field-error">'+val+'</span>');
            });
          }
        } else {
          $('.field-error').remove();
          $('.ocdev-smart-checkout-fields input, .ocdev-smart-checkout-fields textarea, .ocdev-smart-checkout-fields select').removeClass('error-style error-style-table');
          maskElement('#smch-modal-data', false);

          <?php if ($product_options && isset($product_options_array) && $hide_product_options) { ?>
            $.ajax({
              url: 'index.php?route=ocdevwizard/smart_checkout/options',
              dataType: 'html',
              success: function(html) {
                $('#collapse-product-options .section').html(html);

                $('a[href=\'#collapse-user-information\']').trigger('click');

                $('#collapse-product-options').parent().find('.heading').html('<a href="#collapse-product-options" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_options; ?> <i class="fa fa-caret-down"></i></a>');

                $('a[href=\'#collapse-product-options\']').trigger('click');
              }
            });
          <?php } else { ?>
            <?php if (!isset($shipping_code_array) && isset($payment_code_array)) { ?>
              $.ajax({
                url: 'index.php?route=ocdevwizard/smart_checkout/payment',
                dataType: 'html',
                success: function(html) {
                  $('#collapse-payment-method .section').html(html);

                  $('a[href=\'#collapse-user-information\']').trigger('click');

                  $('#collapse-payment-method').parent().find('.heading').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_payment; ?> <i class="fa fa-caret-down"></i></a>');

                  $('a[href=\'#collapse-payment-method\']').trigger('click');
                }
              });
            <?php } else { ?>
              $.ajax({
                url: 'index.php?route=ocdevwizard/smart_checkout/shipping',
                dataType: 'html',
                success: function(html) {
                  $('#collapse-shipping-method .section').html(html);

                  $('a[href=\'#collapse-user-information\']').trigger('click');

                  $('#collapse-shipping-method').parent().find('.heading').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_shipping; ?> <i class="fa fa-caret-down"></i></a>');

                  $('a[href=\'#collapse-shipping-method\']').trigger('click');
                }
              });
            <?php } ?>
          <?php } ?>  
        }
      }
  });
}

// Options
function smch_options() {
  maskElement('#smch-modal-data', true);

  $.ajax({
      type: 'post',
      url: 'index.php?route=ocdevwizard/smart_checkout/options_save',
      data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
      dataType: 'json',
      success: function(json) {
        if (json['error']) {
          $('.option-error').remove();
          $('.option').removeClass('error-style-table-option');
          
          if (json['error']['option']) {
            maskElement('#smch-modal-data', false);
            $.each(json['error']['option'], function(i, val) {
              $('#smch-option-'+i).addClass('error-style-table-option').after('<span class="error-text-table-option option-error">'+val+'</span>');
            });
          }
        } else {
          $('.option-error').remove();
          $('.option').removeClass('error-style-table-option');

          maskElement('#smch-modal-data', false);

          <?php if (!isset($shipping_code_array) && isset($payment_code_array)) { ?>
            $.ajax({
              url: 'index.php?route=ocdevwizard/smart_checkout/payment',
              dataType: 'html',
              success: function(html) {
                $('#collapse-payment-method .section').html(html);

                $('a[href=\'#collapse-product-options\']').trigger('click');

                $('#collapse-payment-method').parent().find('.heading').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_payment; ?> <i class="fa fa-caret-down"></i></a>');

                $('a[href=\'#collapse-payment-method\']').trigger('click');
              }
            });
          <?php } else { ?>
            $.ajax({
              url: 'index.php?route=ocdevwizard/smart_checkout/shipping',
              dataType: 'html',
              success: function(html) {
                $('#collapse-shipping-method .section').html(html);

                $('a[href=\'#collapse-product-options\']').trigger('click');

                $('#collapse-shipping-method').parent().find('.heading').html('<a href="#collapse-shipping-method" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_shipping; ?> <i class="fa fa-caret-down"></i></a>');

                $('a[href=\'#collapse-shipping-method\']').trigger('click');
              }
            });
          <?php } ?>
        }
      }
  });
}

// Shipping
function smch_shipping() {
  maskElement('#smch-modal-data', true);

  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/shipping_save',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
    dataType: 'json',
    success: function(json) {
      if (json['error']) {
        $('.field-error').remove();
        $('.ocdev-smart-checkout-fields input').removeClass('error-style error-style-table');
       
        if (json['error']['field']) {
          maskElement('#smch-modal-data', false);
          $.each(json['error']['field'], function(i, val) {
            $('#smch-shipping-table').addClass('error-style-table').after('<span class="error-text-table field-error">'+val+'</span>');
          });
        }
      } else {
        $('.field-error').remove();
        $('.ocdev-smart-checkout-fields input, .ocdev-smart-checkout-fields textarea, .ocdev-smart-checkout-fields select').removeClass('error-style error-style-table');
        
        maskElement('#smch-modal-data', false);

        <?php if (isset($shipping_code_array) && !isset($payment_code_array)) { ?>
          $.ajax({
            type: 'post',
            url: 'index.php?route=ocdevwizard/smart_checkout/confirm',
            data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
            dataType: 'html',
            success: function(html) {
              $('#collapse-checkout-confirm .section').html(html);
              
              $('a[href=\'#collapse-shipping-method\']').trigger('click');

              $('#collapse-checkout-confirm').parent().find('.heading').html('<a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_confirm; ?> <i class="fa fa-caret-down"></i></a>');

              $('a[href=\'#collapse-checkout-confirm\']').trigger('click');
            }
          });
        <?php } else { ?>
          $.ajax({
            url: 'index.php?route=ocdevwizard/smart_checkout/payment',
            dataType: 'html',
            success: function(html) {
              $('#collapse-payment-method .section').html(html);

              $('a[href=\'#collapse-shipping-method\']').trigger('click');

              $('#collapse-payment-method').parent().find('.heading').html('<a href="#collapse-payment-method" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_payment; ?> <i class="fa fa-caret-down"></i></a>');

              $('a[href=\'#collapse-payment-method\']').trigger('click');
            }
          });
        <?php } ?>
      }
    }
  });
}

// Payment
function smch_payment() {
  maskElement('#smch-modal-data', true);

  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/payment_save',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
    dataType: 'json',
    success: function(json) {
      if (json['error']) {
        $('.field-error').remove();
        $('.ocdev-smart-checkout-fields input').removeClass('error-style error-style-table');
       
        if (json['error']['field']) {
          maskElement('#smch-modal-data', false);
          $.each(json['error']['field'], function(i, val) {
            $('#smch-payment-table').addClass('error-style-table').after('<span class="error-text-table field-error">'+val+'</span>');
          });
        }
      } else {
        $('.field-error').remove();
        $('.ocdev-smart-checkout-fields input, .ocdev-smart-checkout-fields textarea, .ocdev-smart-checkout-fields select').removeClass('error-style error-style-table');
        maskElement('#smch-modal-data', false);

        $.ajax({
            type: 'post',
            url: 'index.php?route=ocdevwizard/smart_checkout/confirm',
            data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
            dataType: 'html',
            success: function(html) {
              $('#collapse-checkout-confirm .section').html(html);

              $('a[href=\'#collapse-payment-method\']').trigger('click');

              $('#collapse-checkout-confirm').parent().find('.heading').html('<a href="#collapse-checkout-confirm" data-toggle="collapse" data-parent="#smch-data-accordion"><?php echo $tab_confirm; ?> <i class="fa fa-caret-down"></i></a>');

              $('a[href=\'#collapse-checkout-confirm\']').trigger('click');
            }
        });
      }
    }
  });
}

function smch_output() {
  var $button_send = $('#smch-modal-body > .modal-footer > input');
  $button_send.attr("disabled", true);
  maskElement('#smch-modal-data', true);

  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/confirm_save_complete',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
    dataType: 'json',
    success: function(json) {
      if (json['output']) {
        maskElement('#smch-modal-data', false);
        $('#smch-modal-body .slide-description, #smch-modal-body .slide-informer, #smch-modal-body .slide-attributes, #smch-modal-body > .modal-footer > .totals').remove();
        $('#smch-modal-data').parent().after("<div class='modal-footer'><input type='button' value='"+json['button_go_back']+"' class='close-button-bottom' onclick='closeModal();'/></div>");
        $('#smch-modal-data').html(json['output']);
      }

      if (json['google_analytics']) {
        ga('require', 'ecommerce');
        ga('ecommerce:addTransaction', {
          'id': json['google_analytics']['transaction_id'],
          'affiliation': json['google_analytics']['affiliation'],
          'revenue': json['google_analytics']['revenue'],
          'shipping': json['google_analytics']['shipping'],
          'tax': json['google_analytics']['tax'],
          'currency': json['google_analytics']['currency']
        });
        ga('ecommerce:addItem', {
          'id': json['google_analytics']['product_id'],
          'name': json['google_analytics']['name'],
          'sku': json['google_analytics']['sku'],
          'price': json['google_analytics']['price'],
          'quantity': json['google_analytics']['quantity']
        });
        ga('ecommerce:send');
      }

      if (json['google_event']) {
        ga('send', 'event', json['google_event']['сategory'], json['google_event']['action'], json['google_event']['name'], json['google_event']['product_id']);
      }
    }
  });
}

function smch_output_simplified() {
  var $button_send = $('#smch-modal-body > .modal-footer > input');
  $button_send.attr('disabled', true);
  maskElement('#smch-modal-data', true);

  $.ajax({
      type: 'post',
      url: 'index.php?route=ocdevwizard/smart_checkout/confirm_save_simple',
      dataType: 'json',
      data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
      success: function(json) {
        if (json['error']) {
          $('.field-error').remove();
          $('.option-error').remove();
          $('.ocdev-smart-checkout-fields input, .ocdev-smart-checkout-fields textarea, .ocdev-smart-checkout-fields select').removeClass('error-style error-style-table');
          $('.option').removeClass('error-style-table-option');

          if (json['error']['field']) {
            maskElement('#smch-modal-data', false);
            $.each(json['error']['field'], function(i, val) {
              $('[name="'+i+'"]').addClass('error-style').after('<span class="error-text field-error">'+val+'</span>');
            });
          }
          if (json['error']['option']) {
            maskElement('#smch-modal-data', false);
            $.each(json['error']['option'], function(i, val) {
              $('#smch-option-'+i).addClass('error-style-table-option').after('<span class="error-text-table-option option-error">'+val+'</span>');
            });
          }
          $button_send.attr('disabled', false);
        } else {
          if (json['output']) {
            maskElement('#smch-modal-data', false);
            $('#smch-modal-body .slide-description, #smch-modal-body .slide-informer, #smch-modal-body .slide-attributes, #smch-modal-body > .modal-footer > .totals').remove();
            $button_send.attr({'value': json['button_go_back'], "disabled": false, 'class': 'close-button-bottom' }).removeAttr('onclick').on('click', this, function() {
              closeModal();
            });
            $('#smch-modal-data').html(json['output']);
          }
          if (json['google_analytics']) {
            ga('require', 'ecommerce');
            ga('ecommerce:addTransaction', {
              'id': json['google_analytics']['transaction_id'],
              'affiliation': json['google_analytics']['affiliation'],
              'revenue': json['google_analytics']['revenue'],
              'shipping': json['google_analytics']['shipping'],
              'tax': json['google_analytics']['tax'],
              'currency': json['google_analytics']['currency']
            });
            ga('ecommerce:addItem', {
              'id': json['google_analytics']['product_id'],
              'name': json['google_analytics']['name'],
              'sku': json['google_analytics']['sku'],
              'price': json['google_analytics']['price'],
              'quantity': json['google_analytics']['quantity']
            });
            ga('ecommerce:send');
          }
          if (json['google_event']) {
            ga('send', 'event', json['google_event']['сategory'], json['google_event']['action'], json['google_event']['name'], json['google_event']['product_id']);
          }
        }
      }
  });
}
//--></script>
<script type="text/javascript"><!--
function update_quantity(product_id) {
  maskElement('#smch-modal-data', true);
  var input_val = $('#smch-quantity').find('input[name=quantity]').val(),
      quantity  = parseInt(input_val);

  if (quantity == 0) {
    quantity = $('#smch-quantity').find('input[name=quantity]').val(1);
    maskElement('#smch-modal-data', false);
    return;
  }

  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/processing&product_id='+product_id+'&quantity='+quantity,
    dataType: 'json',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data select, #smch-modal-data textarea'),
    success: function(json) {
      $('#ocdev-price').html(json['price']);
      $('#ocdev-special').html(json['special']);
      $('#ocdev-tax').html(json['tax']);
      $('#total-order').html(json['total']);
      reMethods();
      update();
      maskElement('#smch-modal-data', false);
    } 
  });
}

function reCalculate() { 
  maskElement('#smch-modal-data', true);
  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/processing',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data select, #smch-modal-data textarea'),
    dataType: 'json',
    success: function(json) {
      $('#ocdev-price').html(json['price']);
      $('#ocdev-special').html(json['special']);
      $('#ocdev-tax').html(json['tax']);
      $('#total-order').html(json['total']);
      reMethods();
      update();
      maskElement('#smch-modal-data', false);
    } 
  });
}

function updateConfirmTable() {
  maskElement('#smch-modal-data', true);
  $.ajax({
    type: 'post',
    url: 'index.php?route=ocdevwizard/smart_checkout/confirm',
    data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data textarea, #smch-modal-data select'),
    dataType: 'html',
    success: function(html) {
      $('#collapse-checkout-confirm .section').html(html);
      maskElement('#smch-modal-data', false);
    }
  });
}

function reMethods() {
  return false;
}

function closeModal() {
  $.ajax({url: 'index.php?route=ocdevwizard/smart_checkout/close'});
  $.magnificPopup.close();
}

function update() {
  if($('#smch-data-accordion > div:eq(1)').find('.heading > *').is('a') == false) {
    $('#smch-data-accordion > div:not(:eq(0))').children('.in').parent().find('.heading a').click();
  } else {
    $('#smch-data-accordion > div:not(:eq(1))').children('.in').parent().find('.heading a').click();
  }
  if ($('#smch-data-accordion > div:eq(1)').find('.in').length == 0) {
    $('#smch-data-accordion > div:eq(1)').find('.heading a').click();
  }
  $('#collapse-checkout-confirm').parent().find('.heading').html('<?php echo $tab_confirm; ?>');
}
//--></script>
</div>