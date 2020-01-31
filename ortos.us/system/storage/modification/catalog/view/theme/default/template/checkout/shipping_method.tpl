<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<p><?php echo $text_shipping_method; ?></p>
<?php foreach ($shipping_methods as $shipping_method) { ?>
<p><strong><?php echo $shipping_method['title']; ?></strong></p>
<?php if (!$shipping_method['error']) { ?>

                <?php foreach ($shipping_method['quote'] as $quote) {
                    if (isset($quote['error']) and $quote['error'] == true) {
                        $local_class = ' class="" disabled="disabled" ';
                    }
                    else {
                        $local_class = "";
                    }
                ?>
                
<div class="radio">
  <label>
    <?php if ($quote['code'] == $code || !$code) { ?>
    <?php $code = $quote['code']; ?>
    
                <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" <?php echo $local_class; ?> />
            
    <?php } else { ?>
    
                <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" <?php echo $local_class; ?> />
            
    <?php } ?>
    
                <?php if (isset($quote['image']) and !empty($quote['image']) ) { ?>
                    <img src="<?php echo $quote['image'];?>" />
                <?php
                }

                echo $quote['title'];

                if (isset($quote['error']) and $quote['error'] != false and $quote['error'] != true) {
                    echo '<br/>'.$quote['error'];
                }
                ?>
             - <?php echo $quote['text']; ?>
    <?php if (isset($quote['description'])) { ?>
    <br /><small><?php echo $quote['description']; ?></small>
    <?php } ?>
  </label>
</div>
<?php } ?>
<?php } else { ?>
<div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
<?php } ?>
<?php } ?>
<?php } ?>
<p><strong><?php echo $text_comments; ?></strong></p>
<p>
  <textarea name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
</p>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
  </div>
</div>
