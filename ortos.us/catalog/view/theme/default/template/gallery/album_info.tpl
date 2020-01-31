<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
      <?php echo $content_top; ?>
      
      <h1 class="album-title" style="font-family: <?php echo $heading_title_font; ?> ; font-size: <?php echo $heading_title_size; ?>px;"><?php echo $heading_title; ?></h1>
        
        <?php if ($thumb || $images) { ?>
          <div class="album-wall row">
            <?php if ($thumb) { ?>
              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                <div class="og-album-0-3">
                    <a class="popup-pict" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
                </div>
              </div>
            <?php } ?>
            <?php if ($images) { ?>
              <?php foreach ($images as $image) { ?>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                  <div class="og-album-0-3">
                      <a class="popup-pict" href="<?php echo $image['popup']; ?>" title="<?php echo $image['name']; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $image['name']; ?>" alt="<?php echo $image['name']; ?>" /></a>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        <?php } ?>
        
      <div class="album-description"><?php echo $description; ?></div>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div> 
<script type="text/javascript"><!--
$(document).ready(function() {
  $('.album-wall').magnificPopup({
    type:'image',
    delegate: 'a',
    gallery: {
      enabled:true
    }
  });
});
//--></script> 
<?php echo $footer; ?>