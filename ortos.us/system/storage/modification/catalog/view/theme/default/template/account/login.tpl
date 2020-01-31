<?php echo $header; ?>
<div class="container">
  
		<ul class="breadcrumb">
		<?php $breadlast = array_pop($breadcrumbs); foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		<li><?php echo $breadlast['text']; ?></li>
		</ul>
		
  <div class="fon_bord_log">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div class="<?php echo $class; ?>"><?php echo $content_top; ?>
    
      <div class="row">
          
        <div class="col-sm-12">
          <div class="well">
         
            
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="example@example.com" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
              </div>
              <input type="submit" value="<?php echo $button_login; ?>" class="but_log" />
              <a href="<?php echo $register; ?>" class="but_log2"><?php echo $button_reg; ?></a>
            
              <div class="clearfix"></div>
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
          </div>
        </div>
       
    </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
  </div>
</div>
<?php echo $footer; ?>