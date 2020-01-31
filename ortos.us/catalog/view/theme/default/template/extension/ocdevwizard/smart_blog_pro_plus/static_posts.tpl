<div class="<?php echo $_code; ?>-posts-block" id="<?php echo $_code; ?>-posts-block-<?php echo $module_id; ?>">
  <!--
  ##==================================================================##
  ## @author    : OCdevWizard                                         ##
  ## @contact   : ocdevwizard@gmail.com                               ##
  ## @support   : http://help.ocdevwizard.com                         ##
  ## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
  ## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
  ##==================================================================##
  -->
  <?php if ($display_type_inner == 1) { ?>
  
     
      <?php if ($results) { ?>
        <div class="zag_post0"><?php echo $heading_title; ?></div>
      <?php foreach ($results as $result) { ?>
       
       
       <div class="container-fluid otst_post">
         
         
       <div class="row">
        
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 nopad">
            <?php if ($show_main_image) { ?>
              <?php if ($result['show_main_image'] == 1) { ?>
              <div class="image0">
                <a href="<?php echo $result['href']; ?>"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>" title="<?php echo $result['name']; ?>" class="img-responsive"/></a>
              </div>
              <?php } ?>
              <?php if ($result['video'] && $result['show_main_image'] == 2) { ?>
              <div class="video">
                <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $result['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $result['video']; ?>/0.jpg');">
                  <div>
                    <i class="fa fa-play"></i>
                    <span></span>
                    <span></span>
                  </div>
                </div>
              </div>
              <?php } ?>
            <?php } ?>
        </div>
        
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 nopad">
          <div class="fon_post_list">
            <div class="zag_post2"><a class="<?php echo $_code; ?>-post-heading" href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a></div>
            <div class="post_dat2"><?php echo $result['date_added']; ?></div>
          </div>
        </div>
        
       
      </div>
        
       
      </div>
      <?php } ?>
      <?php } ?>
   
  
  <?php } else if ($display_type_inner == 2) { ?>
  <?php if ($results) { ?>
 
  <div class="owl-carousel owl-theme">
    <?php foreach ($results as $result) { ?>
    <div class="item">
      <div class="<?php echo $_code; ?>-post-item">
        <?php if ($show_main_image) { ?>
          <?php if ($result['show_main_image'] == 1) { ?>
          <div class="image1">
            <a href="<?php echo $result['href']; ?>"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>" title="<?php echo $result['name']; ?>" class="img-responsive"/></a>
          </div>
          <?php } ?>
          <?php if ($result['video'] && $result['show_main_image'] == 2) { ?>
          <div class="video">
            <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $result['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $result['video']; ?>/0.jpg');">
              <div>
                <i class="fa fa-play"></i>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
        <div class="caption1">
          
          <div class="zag_post"><a class="<?php echo $_code; ?>-post-heading" href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a></div>
          <div class="post_dat"><?php echo $result['date_added']; ?></div>
         
          <?php if ($show_description && $result['short_description']) { ?>
            <div class="desc_post">
          <?php echo $result['short_description']; ?>
          </div> 
          <?php } ?>
          <?php if ($show_read_more_button) { ?>
          <div class="det_post"><a href="<?php echo $result['href']; ?>"><?php echo $text_button_readmore; ?> </a></div>
          <?php } ?>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <script>
    $(function () {
      $('#<?php echo $_code; ?>-posts-block-<?php echo $module_id; ?> .owl-carousel').owlCarousel({
        dots: true,
        items: 1,
        loop: true
      });
    });
  </script>
  <?php } ?>
  <?php } else if ($display_type_inner == 3) { ?>
  <?php if ($results) { ?>
  
  <div class="row product-layout">
    <?php foreach ($results as $result) { ?>
    <div class="col-xl-<?php echo $adaptive_setting_4_bootstrap; ?> col-lg-<?php echo $adaptive_setting_3_bootstrap; ?> col-md-<?php echo $adaptive_setting_2_bootstrap; ?> col-sm-<?php echo $adaptive_setting_1_bootstrap; ?> col-xs-<?php echo $adaptive_setting_0_bootstrap; ?>">
      <div class="<?php echo $_code; ?>-post-item">
        <?php if ($show_main_image) { ?>
          <?php if ($result['show_main_image'] == 1) { ?>
          <div class="image1">
            <a href="<?php echo $result['href']; ?>"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>" title="<?php echo $result['name']; ?>" class="img-responsive"/></a>
          </div>
          <?php } ?>
          <?php if ($result['video'] && $result['show_main_image'] == 2) { ?>
          <div class="video">
            <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $result['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $result['video']; ?>/0.jpg');">
              <div>
                <i class="fa fa-play"></i>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
        <div class="caption1">
          
            <div class="zag_post"><a class="<?php echo $_code; ?>-post-heading" href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a></div>
            <div class="post_dat"><?php echo $result['date_added']; ?></div>
             
            
            <?php if ($show_description && $result['short_description']) { ?>
              <div class="desc_post">
            <?php echo $result['short_description']; ?>
            </div> 
            <?php } ?>
            <?php if ($show_read_more_button) { ?>
            <div class="det_post"><a href="<?php echo $result['href']; ?>"><?php echo $text_button_readmore; ?> </a></div>
            <?php } ?>
            <div class="clearfix"></div>
          </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
  <?php } else if ($display_type_inner == 4) { ?>
  <?php if ($results) { ?>
  
  <div class="owl-carousel owl-theme">
    <?php foreach ($results as $result) { ?>
    <div class="item">
      <div class="<?php echo $_code; ?>-post-item">
        <?php if ($show_main_image) { ?>
          <?php if ($result['show_main_image'] == 1) { ?>
          <div class="image1">
            <a href="<?php echo $result['href']; ?>"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>" title="<?php echo $result['name']; ?>" class="img-responsive"/></a>
          </div>
          <?php } ?>
          <?php if ($result['video'] && $result['show_main_image'] == 2) { ?>
          <div class="video">
            <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $result['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $result['video']; ?>/0.jpg');">
              <div>
                <i class="fa fa-play"></i>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
        <div class="caption1">
          
            <div class="zag_post"><a class="<?php echo $_code; ?>-post-heading" href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a></div>
            <div class="post_dat"><?php echo $result['date_added']; ?></div>
             
            
            <?php if ($show_description && $result['short_description']) { ?>
              <div class="desc_post">
            <?php echo $result['short_description']; ?>
            </div> 
            <?php } ?>
            <?php if ($show_read_more_button) { ?>
            <div class="det_post"><a href="<?php echo $result['href']; ?>"><?php echo $text_button_readmore; ?> </a></div>
            <?php } ?>
            <div class="clearfix"></div>
          </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <script>
    $(function () {
      $('#<?php echo $_code; ?>-posts-block-<?php echo $module_id; ?> .owl-carousel').owlCarousel({
        dots: true,
        loop: false,
        margin: 28,
        responsive: {
          0: {items: <?php echo $adaptive_setting_0; ?>},
          576: {items: <?php echo $adaptive_setting_1; ?>},
          768: {items: <?php echo $adaptive_setting_2; ?>},
          992: {items: <?php echo $adaptive_setting_3; ?>},
          1200: {items: <?php echo $adaptive_setting_4; ?>}
        }
      });
    });
  </script>
  <?php } ?>
  <?php } ?>
</div>