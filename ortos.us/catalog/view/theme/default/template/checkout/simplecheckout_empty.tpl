<?php if (!$ajax && !$popup && !$as_module) { ?>
<?php include $simple_header; ?>
<?php } ?>
  <div class="content"><?php echo $text_error; ?></div>
  <div class="simplecheckout-button-block buttons">
     <a href="<?php echo $continue; ?>" class="button btn-primary button_oc btn"><span><?php echo $button_continue; ?></span></a> 
  </div>
<?php if (!$ajax && !$popup && !$as_module) { ?>
<?php include $simple_footer ?>
<?php } ?>