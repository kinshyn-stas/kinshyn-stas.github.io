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
      <?php if ($albums) { ?>
      <div class="row ">
        <div class="og-container">
          <?php foreach ($albums as $album) { ?>
          <div class="og-album <?php echo $apr; ?> col-xs-12" style="height:<?php echo $og_album_height; ?>px;">
            <div class="og-album-<?php echo $og_album_image_type; ?>-<?php echo $og_album_size; ?>">
                <a href="<?php echo $album['href']; ?>"><img src="<?php echo $album['thumb'] ?>" title="<?php echo $album['name'] ?>" alt="<?php echo $album['name'] ?>"/></a>
            </div>
            <p><a href="<?php echo $album['href']; ?>" style="font-family: <?php echo $title_font; ?> ; font-size: <?php echo $title_size; ?>px; <?php if($og_title_font_weight) { echo 'font-weight: bold;'; } ?>"><?php echo $album['name'] ?></a></p>
            
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
      </div>
      <?php } ?>
      <?php if (!$albums) { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>