<div id="slideshow_extend<?php echo $module; ?>" class="owl-carousel no-border hidden-xs" style="opacity: 1;">
  <?php foreach ($banners as $banner) { ?>
    <?php if (($banner['view'] == 1) || ($banner['view'] == 3) || ($banner['view'] == 5))  { //текст слева ?>
    <div class="item product-banner" style="<?php if ($banner['background_image']) { ?>background-image: url('<?php echo $banner['background_image']; ?>'); <?php } ?> <?php echo $banner['bg_style']; ?>">
            <div class="container">
                <div class="row">
                    <div class="<?php echo $banner['class_text']; ?> text">
                        <div class="v-align-parent <?php if ($banner['text_type'] == 2) { ?>white<?php } ?>">
                            <div class="v-align">
                                <?php if ($banner['title2']) { ?>
                                    <div class="line-1">
                                        <?php echo $banner['title2']; ?>
                                    </div>
                                <?php } ?>
                                <?php if ($banner['title']) { ?>
                                    <div class="line-2">
                                        <?php echo $banner['title']; ?>
                                    </div>
                                <?php } ?>
                                <?php if ($banner['title3']) { ?>
                                    <div class="line-3">
                                        <?php echo $banner['title3']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($banner['show_price'] != 2) { ?>
                        <div class="product-info">
                            <?php if (!$banner['special']) { ?>
                                <span class="price"><?php echo $banner['price']; ?></span>
                            <?php } else { ?>
                                <span class="price"><?php echo $banner['special']; ?></span> <span class="price price-old"><?php echo $banner['price']; ?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if ($banner['image']) { ?>
                        <?php if ($banner['link']) { ?><a href="<?php echo $banner['link']; ?>"><?php } ?>
                            <div class="<?php echo $banner['class_image']; ?> image">
                                <img class="img-responsive lazyOwl" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=" data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
                            </div>
                        <?php if ($banner['link']) { ?></a><?php } ?>
                    <?php } ?>
                </div>
            </div>
    </div>
    <?php } else { //текст справа ?>
          <div class="item product-banner" style="<?php if ($banner['background_image']) { ?>background-image: url('<?php echo $banner['background_image']; ?>'); <?php } ?> <?php echo $banner['bg_style']; ?>">
            <div class="container">
                <div class="row">
                    <?php if ($banner['image']) { ?>
                        <?php if ($banner['link']) { ?><a href="<?php echo $banner['link']; ?>"><?php } ?>
                        <div class="<?php echo $banner['class_image']; ?> image">
                            <img class="img-responsive lazyOwl" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=" data-src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
                        </div>
                        <?php if ($banner['link']) { ?></a><?php } ?>
                    <?php } ?>
                    <div class="<?php echo $banner['class_text']; ?> text">
                        <div class="v-align-parent <?php if ($banner['text_type'] == 2) { ?>white<?php } ?>">
                            <div class="v-align">
                                <?php if ($banner['title2']) { ?>
                                    <div class="line-1">
                                        <?php echo $banner['title2']; ?>
                                    </div>
                                <?php } ?>
                                <?php if ($banner['title']) { ?>
                                    <div class="line-2">
                                        <?php echo $banner['title']; ?>
                                    </div>
                                <?php } ?>
                                <?php if ($banner['title3']) { ?>
                                    <div class="line-3">
                                        <?php echo $banner['title3']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if ($banner['show_price'] != 2) { ?>
                            <div class="product-info">
                                <?php if (!$banner['special']) { ?>
                                    <span class="price"><?php echo $banner['price']; ?></span>
                                <?php } else { ?>
                                    <span class="price"><?php echo $banner['special']; ?></span> <span class="price price-old"><?php echo $banner['price']; ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
  <?php } ?>
</div>
<script type="text/javascript"><!--
domReady(function(){
    $('#slideshow_extend<?php echo $module; ?>').owlCarousel({
        items: 6,
        lazyLoad: true,
        autoPlay: 20000,
        autoHeight:false,
        singleItem: true,
        navigation: true,
        navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
        pagination: true
    });
});
--></script>