<?php if ($error_warning_shipping) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning_shipping; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<!-- SHIPPING METHODS -->
  <table class="smch-methods-table" id="smch-shipping-table">
    <tbody>
      <?php foreach ($shipping_methods as $shipping_method) { ?>
      <?php if ($hide_shipping_title) { ?>
        <tr>
          <td colspan="3" class="td-heading"><?php echo $shipping_method['title']; ?></td>
        </tr>
      <?php } ?>
      <?php foreach ($shipping_method['quote'] as $quote) { ?>
      <tr>
        <td class="first-td">
          <div>
            <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" <?php echo $quote['code'] == $code ? "checked" : ""; ?> onchange="reMethods();" />
          </div>
        </td>
        <td>
          <label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
        </td>
        <td style="text-align:right;">
          <label for="<?php echo $quote['code']; ?>"><?php echo $quote['text']; ?></label>
        </td>
      </tr>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
  <?php if ($user_button_next) { ?>
  <button type="button" id="button-shipping-method" onclick="smch_shipping();" class="next-step-button"><?php echo $user_button_next; ?> <i class="fa fa-chevron-circle-right"></i></button>
  <?php } ?>
  <script type="text/javascript">
    function reMethods() {
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
                $('#smch-shipping-table').addClass('error-style-table').after('<span class="error-text-table field-error">' + val + '</span>');
              });
            }
          } else {
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
                maskElement('#smch-modal-data', false);
              } 
            });
            $.ajax({
              type: 'post',
              url: 'index.php?route=ocdevwizard/smart_checkout/shipping',
              dataType: 'html',
              data: $('#smch-modal-data input[type=\'text\'], #smch-modal-data input[type=\'hidden\'], #smch-modal-data input[type=\'radio\']:checked, #smch-modal-data input[type=\'checkbox\']:checked, #smch-modal-data select, #smch-modal-data textarea'),
              success: function(html) {
                $('#collapse-shipping-method .section').html(html);
                maskElement('#smch-modal-data', false);
              } 
            });
          }
        }
      });
    }
  </script>
<?php } ?>