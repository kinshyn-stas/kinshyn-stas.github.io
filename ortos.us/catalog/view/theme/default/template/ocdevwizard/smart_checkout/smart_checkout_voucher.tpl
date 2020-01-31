<div class="ocdev-smart-checkout-fields">
  <input type="text" name="smch_voucher" value="<?php echo $voucher; ?>" placeholder="<?php echo $entry_voucher; ?>" id="smch-input-voucher" />
  <?php if (!empty($voucher)) { ?>
  <button type="button" id="smch-button-remove-voucher" data-loading-text="<?php echo $text_loading; ?>" class="smch-remove-button"><?php echo $button_remove_voucher; ?></button>
  <?php } ?>
  <button type="button" id="smch-button-voucher" data-loading-text="<?php echo $text_loading; ?>" class="next-step-button"><?php echo $button_voucher; ?></button>
  <script type="text/javascript"><!--
  $('#smch-button-voucher').on('click', function() {
    maskElement('#smch-modal-data', true);
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/voucher',
      type: 'post',
      data: 'smch_voucher=' + encodeURIComponent($('input[name=\'smch_voucher\']').val()),
      dataType: 'json',
      beforeSend: function() {
        $('#smch-button-voucher').button('loading');
      },
      complete: function() {
        $('#smch-button-voucher').button('reset');
      },
      success: function(json) {
        $('.field-error').remove();
        if (json['error']) {
          maskElement('#smch-modal-data', false);
          $('input[name=\'smch_voucher\']').addClass('error-style').after('<span class="error-text field-error">' + json['error'] + '</span>');
        } else {
          $.ajax({
            url: 'index.php?route=ocdevwizard/smart_checkout/voucher_index',
            dataType: 'html',
            success: function(html) {
              $('input[name=\'smch_voucher\']').removeClass('error-style').after('<span id="smch-voucher-success">' + json['success'] + '</span>').fadeIn();
              $('#smch-voucher-success').delay(3000).fadeOut();
              $('#collapse-voucher-information .section').html(html);
              reCalculate();
              maskElement('#smch-modal-data', false); 
            }
          });
        }
      }
    });
  });

  $(document).on('click', '#smch-button-remove-voucher', function() {
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/remove_voucher',
      dataType: 'json',
      beforeSend: function() {
        $('#smch-button-remove-voucher').button('loading');
      },
      complete: function() {
        $('#smch-button-remove-voucher').button('reset');
      },
      success: function(json) {
        maskElement('#smch-modal-data', true);
        $.ajax({
          url: 'index.php?route=ocdevwizard/smart_checkout/voucher_index',
          dataType: 'html',
          success: function(html) {
            $('#collapse-voucher-information .section').html(html);
            reCalculate();
            maskElement('#smch-modal-data', false);
          }
        });
      }
    });
  });
  //-->
  </script>
</div>