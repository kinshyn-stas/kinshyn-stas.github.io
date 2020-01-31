<div class="ocdev-smart-checkout-fields">
  <input type="text" name="smch_coupon" value="<?php echo $coupon; ?>" placeholder="<?php echo $entry_coupon; ?>" id="smch-input-coupon" />
  <?php if (!empty($coupon)) { ?>
  <button type="button" id="smch-button-remove-coupon" data-loading-text="<?php echo $text_loading; ?>" class="smch-remove-button"><?php echo $button_remove_coupon; ?></button>
  <?php } ?>
  <button type="button" id="smch-button-coupon" data-loading-text="<?php echo $text_loading; ?>" class="next-step-button"><?php echo $button_coupon; ?></button>
  <script type="text/javascript"><!--
  $('#smch-button-coupon').on('click', function() {
  	maskElement('#smch-modal-data', true);
  	$.ajax({
  		url: 'index.php?route=ocdevwizard/smart_checkout/coupon',
  		type: 'post',
  		data: 'smch_coupon=' + encodeURIComponent($('input[name=\'smch_coupon\']').val()),
  		dataType: 'json',
  		beforeSend: function() {
  			$('#smch-button-coupon').button('loading');
  		},
  		complete: function() {
  			$('#smch-button-coupon').button('reset');
  		},
  		success: function(json) {
  			$('.field-error').remove();
  			if (json['error']) {
  				maskElement('#smch-modal-data', false);
  				$('input[name=\'smch_coupon\']').addClass('error-style').after('<span class="error-text field-error">' + json['error'] + '</span>');
  			} else {
  				$.ajax({
            url: 'index.php?route=ocdevwizard/smart_checkout/coupon_index',
            dataType: 'html',
            success: function(html) {
              $('input[name=\'smch_coupon\']').removeClass('error-style').after('<span id="smch-coupon-success">' + json['success'] + '</span>').fadeIn();
              $('#smch-coupon-success').delay(3000).fadeOut();
              $('#collapse-coupon-information .section').html(html);
              reCalculate();
              maskElement('#smch-modal-data', false); 
            }
          });
  			}
  		}
  	});
  });

  $(document).on('click', '#smch-button-remove-coupon', function() {
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/remove_coupon',
      dataType: 'json',
      beforeSend: function() {
        $('#smch-button-remove-coupon').button('loading');
      },
      complete: function() {
        $('#smch-button-remove-coupon').button('reset');
      },
      success: function(json) {
        maskElement('#smch-modal-data', true);
        $.ajax({
          url: 'index.php?route=ocdevwizard/smart_checkout/coupon_index',
          dataType: 'html',
          success: function(html) {
            $('#collapse-coupon-information .section').html(html);
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