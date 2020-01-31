<?php echo $header; ?>
<div class="container">
  
		<ul class="breadcrumb">
		<?php $breadlast = array_pop($breadcrumbs); foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		<li><?php echo $breadlast['text']; ?></li>
		</ul>
		
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="zag_cat"> 
          <h1><?php echo $heading_title; ?></h1>
        </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
       
        
        <div class="container">
          
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
              </div>
           
           <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
           
              <?php if ($newsletter) { ?>
              <label class="rad">
                <input type="radio" name="newsletter" value="1" checked="checked" />
                <?php echo $text_yes; ?> 
              </label>
              <label class="rad">
                <input type="radio" name="newsletter" value="0" />
                <?php echo $text_no; ?>
              </label>
              <?php } else { ?>
              <label class="rad">
                <input type="radio" name="newsletter" value="1" />
                <?php echo $text_yes; ?> 
              </label>
              <label class="rad">
                <input type="radio" name="newsletter" value="0" checked="checked" />
                <?php echo $text_no; ?>
              </label>
              <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
              </div>
          </div>
        </div>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="<?php echo $back; ?>" class="prev2"><i class="fa fa-long-arrow-left" aria-hidden="true"></i><?php echo $button_back; ?></a></div>
          <div class="pull-right">
            <input type="submit" value="<?php echo $button_continue; ?>" class="next2" />
          </div>
        </div>
      </form>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>