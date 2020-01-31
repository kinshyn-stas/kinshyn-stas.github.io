<div class="fon_video">
<div class="zag_mod_video"><span><?php echo $heading_title; ?></span></div>
<div id="carouselgal" class="owl-carousel">
    <?php foreach ($videos as $video) { ?>

      <div class="item text-center videolist5">
        <a href="<?php echo $video['href']; ?>">
          <img src="<?php echo $video['thumb'] ?>" title="<?php echo $video['name'] ?>" alt="<?php echo $video['name'] ?>"/>
          <div class="play-button play-button-1" style="top:<?php echo $play_btn_top; ?>px; left:<?php echo $play_btn_left; ?>px;"></div>
        </a>
     
      <div class="zag_video"><a href="<?php echo $video['href']; ?>"><?php echo $video['name'] ?></a></div>  
      
    </div>
    
    <?php } ?>
  </div>

<script type="text/javascript"><!--
  $('#carouselgal').owlCarousel({
    items: 3,
    autoPlay: false,
    navigation: true,
    navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
    pagination: false
  });
  --></script>
  </div>
