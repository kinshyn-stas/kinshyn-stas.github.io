<?php if ($error_warning_payment) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning_payment; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<!-- PAYMENT METHODS -->
  <table class="smch-methods-table" id="smch-payment-table">
    <tbody>
      <?php foreach ($payment_methods as $payment_method) { ?>
      <tr>
        <td class="first-td">
          <div>
            <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" <?php echo ($payment_method['code'] == $code) ? "checked" : ""; ?> />
            <?php $code = $payment_method['code']; ?>
          </div>
        </td>
        <td>
          <label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></label>
          <?php if ($payment_method['terms']) { ?>
          (<?php echo $payment_method['terms']; ?>)
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <button type="button" id="button-payment-method" onclick="smch_payment();" class="next-step-button"><?php echo $button_go_to_confirm; ?> <i class="fa fa-chevron-circle-right"></i></button>
<?php } ?>