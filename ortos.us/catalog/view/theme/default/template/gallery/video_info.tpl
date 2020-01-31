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
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
        
        <h1 class="album-title" style="font-family: <?php echo $heading_title_font; ?> ; font-size: <?php echo $heading_title_size; ?>px;"><?php echo $heading_title; ?></h1>
        
        <div class="video-container">
          <?php if($video_type == 'youtube') { ?>
            <iframe width="<?php echo $v_width; ?>" height="<?php echo $v_height; ?>" src="//www.youtube.com/embed/<?php echo $video_code; ?>" frameborder="0" allowfullscreen></iframe><br /><br />
          <?php } else if($video_type == 'vimeo') { ?>
            <iframe src="//player.vimeo.com/video/<?php echo $video_code; ?>" width="<?php echo $v_width; ?>" height="<?php echo $v_height; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><br /><br />
          <?php } ?>
        </div>
        
        <div class="album-description"><?php echo $description; ?></div>
        
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div> 
<?php echo $footer; ?>