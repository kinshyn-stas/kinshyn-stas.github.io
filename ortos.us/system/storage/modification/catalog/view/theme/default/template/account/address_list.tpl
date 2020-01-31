<?php echo $header; ?>
<div class="container">
  
		<ul class="breadcrumb">
		<?php $breadlast = array_pop($breadcrumbs); foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		<li><?php echo $breadlast['text']; ?></li>
		</ul>
		
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="podzag5"><?php echo $text_address_book; ?></div>
      <?php if ($addresses) { ?>
       
       <div class="container-fluid">  
          <?php foreach ($addresses as $result) { ?>          
          <div class="row fon_adr">
            
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                <div class="zag_ad"><?php echo $result['address']; ?></div>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="regedit5"><a href="<?php echo $result['update']; ?>" class=""><?php echo $button_edit; ?></a></div> 
                <div class="del5"><a href="<?php echo $result['delete']; ?>" class=""><img src="/image/catalog/del5.png"></a></div>
            </div>
            
             
             
          </div>
          <?php } ?>
       </div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-left"><a href="<?php echo $back; ?>" class="prev2"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><?php echo $button_back; ?></a></div>
        <div class="pull-right"><a href="<?php echo $add; ?>" class="next2"><?php echo $button_new_address; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>