<h3><?php echo $heading_title; ?></h3>
<div class="row product-layout">
  <div class="og-container">
    <?php foreach ($albums as $album) { ?>
    <div class="og-album <?php echo $apr; ?> col-xs-12" style="height:<?php echo $mheight; ?>;">
      <div class="og-album-<?php echo $og_album_image_type; ?>-<?php echo $as; ?>">
          <a href="<?php echo $album['href']; ?>"><img src="<?php echo $album['thumb'] ?>" title="<?php echo $album['name'] ?>" alt="<?php echo $album['name'] ?>"/></a>
      </div>
      <p><a href="<?php echo $album['href']; ?>" style="font-family: <?php echo $title_font; ?> ; font-size: <?php echo $title_size; ?>px; <?php if($og_title_font_weight) { echo 'font-weight: bold;'; } ?>"><?php echo $album['name'] ?></a></p>
      
    </div>
    <?php } ?>
  </div>
</div>
