<div id="carousel<?php echo $module; ?>" class="owl-carousel border">
  <?php foreach ($banners as $banner) { ?>
  <div class="item text-center">
    <?php if ($banner['link']) { ?>
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
    <?php } else { ?>
    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"  />
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
domReady(function(){
    $('#carousel<?php echo $module; ?>').owlCarousel({
        items: 6,
        autoPlay: 3000,
        navigation: true,
        navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
        pagination: false
    });
});
--></script>