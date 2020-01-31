<div class="<?php echo $_code; ?>-comments-block" id="<?php echo $_code; ?>-comments-block-<?php echo $module_id; ?>">
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
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $heading_title; ?></div>
      <div class="list-group">
        <?php if ($results) { ?>
        <?php foreach ($results as $result) { ?>
        <div class="list-group-item <?php echo $_code; ?>-list-group-item">
          <div class="media">
            <?php if ($show_comment_icon) { ?>
            <div class="media-left">
              <img src="<?php echo $result['user_icon']; ?>"/>
            </div>
            <?php } ?>
            <div class="media-body">
              <b><?php echo $result['firstname']; ?></b><br/><?php echo $result['date_added']; ?><br/>
              <?php echo $result['description']; ?><br/>
              <?php echo $text_read_on; ?>
              <a href="<?php echo $result['post_href']; ?>"><?php echo $result['post_name']; ?></a>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
  <?php } else if ($display_type_inner == 2) { ?>
    <?php if ($results) { ?>
  
    <div class="owl-carousel owl-theme">
      <?php foreach ($results as $result) { ?>
      <div class="item">
        <div class="product-thumb transition">
          <div class="caption">
            <div class="media">
              <?php if ($show_comment_icon) { ?>
              <div class="media-left">
                <img src="<?php echo $result['user_icon']; ?>"/>
              </div>
              <?php } ?>
              <div class="media-body">
                <b><?php echo $result['firstname']; ?></b><br/><?php echo $result['date_added']; ?><br/>
                <?php echo $result['description']; ?><br/>
                <?php echo $text_read_on; ?>
                <a href="<?php echo $result['post_href']; ?>"><?php echo $result['post_name']; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <script>
      $(function () {
        $('#<?php echo $_code; ?>-comments-block-<?php echo $module_id; ?> .owl-carousel').owlCarousel({
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
        <div class="product-thumb transition">
          <div class="caption">
            <div class="media">
              <?php if ($show_comment_icon) { ?>
              <div class="media-left">
                <img src="<?php echo $result['user_icon']; ?>"/>
              </div>
              <?php } ?>
              <div class="media-body">
                <b><?php echo $result['firstname']; ?></b><br/><?php echo $result['date_added']; ?><br/>
                <?php echo $result['description']; ?><br/>
                <?php echo $text_read_on; ?>
                <a href="<?php echo $result['post_href']; ?>"><?php echo $result['post_name']; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  <?php } else if ($display_type_inner == 4) { ?>
    <?php if ($results) { ?>
 
    <div class="product-layout owl-carousel owl-theme">
      <?php foreach ($results as $result) { ?>
      <div class="item">
        <div class="product-thumb transition">
          <div class="caption">
            <div class="media">
              <?php if ($show_comment_icon) { ?>
              <div class="media-left">
                <img src="<?php echo $result['user_icon']; ?>"/>
              </div>
              <?php } ?>
              <div class="media-body">
                <b><?php echo $result['firstname']; ?></b><br/><?php echo $result['date_added']; ?><br/>
                <?php echo $result['description']; ?><br/>
                <?php echo $text_read_on; ?>
                <a href="<?php echo $result['post_href']; ?>"><?php echo $result['post_name']; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <script>
      $(function () {
        $('#<?php echo $_code; ?>-comments-block-<?php echo $module_id; ?> .owl-carousel').owlCarousel({
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