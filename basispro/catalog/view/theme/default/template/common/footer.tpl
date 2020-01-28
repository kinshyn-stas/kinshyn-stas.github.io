<footer>
  <div class="container">
    <div class="row">
        <?php if ($footerone_html_module) { ?>
            <?php echo $footerone_html_module; ?>
        <?php } else { ?>
          <div class="col-sm-3">
            <div class="footer-heading"><?php echo $text_information; ?></div>
            <ul class="list-unstyled">
                <?php if ((isset($information_categories))&&($information_categories)&&(count($information_categories) > 1)) { ?>
                    <?php foreach ($information_categories as $category) { ?>
                        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php } ?>
                <?php } ?>
                <?php if ($informations) { ?>
                    <?php foreach ($informations as $information) { ?>
                        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                    <?php } ?>
                <?php } ?>
            </ul>
          </div>
        <?php } ?>

        <?php if ($footertwo_html_module) { ?>
            <?php echo $footertwo_html_module; ?>
        <?php } else { ?>
      <div class="col-sm-3">
        <div class="footer-heading"><?php echo $text_extra; ?></div>
        <ul class="list-unstyled">
          <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
        <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
        <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
      </div>
        <?php } ?>

        <?php if ($footerthree_html_module) { ?>
            <?php echo $footerthree_html_module; ?>
        <?php } else { ?>
      <div class="col-sm-3">
        <div class="footer-heading"><?php echo $text_account; ?></div>
        <ul class="list-unstyled">
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
        <?php } ?>

        <?php if ($footerfour_html_module) { ?>
            <?php echo $footerfour_html_module; ?>
        <?php } else { ?>
        <div class="col-sm-3">
            <div class="footer-heading"><?php echo $text_contact; ?></div>
            <p class="phones">
                <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a><br>
                <?php echo $telephone_add; ?>
            </p>
            <p>
                <a href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%97%D0%B4%D0%BE%D0%BB%D0%B1%D1%83%D0%BD%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F,+7%D0%90,+%D0%9A%D0%B8%D0%B5%D0%B2,+%D0%A3%D0%BA%D1%80%D0%B0%D0%B8%D0%BD%D0%B0,+02000/@50.4128319,30.6045064,17z/data=!3m1!4b1!4m5!3m4!1s0x40d4c59f281ec91d:0x234f561a6e7a598!8m2!3d50.4128319!4d30.6066951">
                    <?php echo $address; ?>
                </a>
            </p>
        </div>
        <?php } ?>

    </div>
    <hr>
      <div class="row">
          <div class="col-sm-6">
              <?php if ($povered_html_module) { ?>
                  <?php echo $povered_html_module; ?>
              <?php } else { ?>
                    <p><?php echo $powered; ?></p>
              <?php } ?>
          </div>
          <div class="col-sm-6">
              <?php if ($footer_banners) { ?>
                  <div class="footer-icons">
                  <?php foreach ($footer_banners as $banner) { ?>

                          <?php if ($banner['link']) { ?>
                              <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
                          <?php } else { ?>
                              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
                          <?php } ?>

                        <?php } ?>
                  </div>
              <?php } ?>
          </div>
      </div>

  </div>
</footer>
 
</div>
<?php  if ($scripts_to_footer) { ?>
    <script defer src="/catalog/view/theme/default/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript" ></script>
    <script defer src="/catalog/view/theme/default/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
    <script defer src="/catalog/view/theme/default/javascript/common.js" type="text/javascript" ></script>
    <?php foreach ($scripts as $script) { ?>
        <script defer src="<?php echo $script; ?>" type="text/javascript" ></script>
    <?php } ?>
<?php } ?>
<?php  if ($show_scrollup) { ?>
<!--scroll to top-->
<script>
    domReady(function(){
        $('body').append('<div id="toTop" class="btn btn-primary"><i class="fa fa-arrow-up"></i></div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    });
</script>
<!--scroll to top-->
<?php } ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
</body></html>