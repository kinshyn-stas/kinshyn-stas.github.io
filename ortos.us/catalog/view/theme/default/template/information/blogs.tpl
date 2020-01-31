<?php echo $header1; ?>
<div class="container ">
    <div class="row">
    
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $content_top; ?>
        </div>
        
      </div>
  
  <br /><br />
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
   
       
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<div class="container">
  
  <div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php echo $content_ban1; ?>
    </div>
    
  </div>
  
</div>

<?php echo $footer; ?>