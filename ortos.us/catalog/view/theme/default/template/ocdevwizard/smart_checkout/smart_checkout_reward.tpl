<div class="ocdev-smart-checkout-fields">
  <input type="text" name="smch_reward" value="<?php echo $reward; ?>" placeholder="<?php echo $entry_reward; ?>" id="smch-input-reward" />
  <?php if (!empty($reward)) { ?>
  <button type="button" id="smch-button-remove-reward" data-loading-text="<?php echo $text_loading; ?>" class="smch-remove-button"><?php echo $button_remove_reward; ?></button>
  <?php } ?>
  <button type="button" id="smch-button-reward" data-loading-text="<?php echo $text_loading; ?>"  class="next-step-button"><?php echo $button_reward; ?></button>
  <script type="text/javascript"><!--
  $('#smch-button-reward').on('click', function() {
  	$.ajax({
  		url: 'index.php?route=ocdevwizard/smart_checkout/reward',
  		type: 'post',
  		data: 'smch_reward=' + encodeURIComponent($('input[name=\'smch_reward\']').val()),
  		dataType: 'json',
  		beforeSend: function() {
  			$('#smch-button-reward').button('loading');
  		},
  		complete: function() {
  			$('#smch-button-reward').button('reset');
  		},
  		success: function(json) {
  			$('.field-error').remove();
  			if (json['error']) {
  				maskElement('#smch-modal-data', false);
  				$('input[name=\'smch_reward\']').addClass('error-style').after('<span class="error-text field-error">' + json['error'] + '</span>');
  			} else {
  				$.ajax({
            url: 'index.php?route=ocdevwizard/smart_checkout/reward_index',
            dataType: 'html',
            success: function(data) {
              $('input[name=\'smch_reward\']').removeClass('error-style').after('<span id="smch-reward-success">' + json['success'] + '</span>').fadeIn();
              $('#smch-reward-success').delay(3000).fadeOut();
              $('#collapse-reward-information .section').html(html);
              reCalculate();
              maskElement('#smch-modal-data', false); 
            }
          });
  			}
  		}
  	});
  });

  $(document).on('click', '#smch-button-remove-reward', function() {
    $.ajax({
      url: 'index.php?route=ocdevwizard/smart_checkout/remove_reward',
      dataType: 'json',
      beforeSend: function() {
        $('#smch-button-remove-reward').button('loading');
      },
      complete: function() {
        $('#smch-button-remove-reward').button('reset');
      },
      success: function(json) {
        maskElement('#smch-modal-data', true);
        $.ajax({
          url: 'index.php?route=ocdevwizard/smart_checkout/reward_index',
          dataType: 'html',
          success: function(data) {
            $('#collapse-reward-information .section').html(html);
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