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
      <h2 class="gallery-title" style="font-family: <?php echo $heading_title_font; ?> ; font-size: <?php echo $heading_title_size; ?>px;"><?php echo $heading_title; ?></h2>
      
      <?php if ($videos) { ?>
      <div class="row product-layout">
        <div class="og-container">
          <?php foreach ($videos as $video) { ?>

          <div class="<?php echo $apr; ?> col-xs-12 og-vd-md" style="height:<?php echo $og_video_height; ?>px;">
            <div class="og-vd-md-<?php echo $og_video_list_size; ?>">
              <a href="<?php echo $video['href']; ?>">
                <img src="<?php echo $video['thumb'] ?>" title="<?php echo $video['name'] ?>" alt="<?php echo $video['name'] ?>"/>
                <div class="play-button play-button-<?php echo $play_btn_icon; ?>" style="top:<?php echo $play_btn_top; ?>px; left:<?php echo $play_btn_left; ?>px;"></div>
              </a>
            </div>
            <p><a href="<?php echo $video['href']; ?>" style="font-family: <?php echo $title_font; ?> ; font-size: <?php echo $title_size; ?>px; <?php if($og_title_font_weight) { echo 'font-weight: bold;'; } ?> "><?php echo $video['name'] ?></a>
           </p>
          </div>
          
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
      </div>
      <?php } ?>
      <?php if (!$videos) { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>