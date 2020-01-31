<div class="zag_mod"><span><?php echo $heading_title; ?></span></div>
<div class="row">
  <?php foreach ($products as $product) { ?>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="fon_tov_viewt">
      
      <div class="container-fluid">        
        <div class="row">
         
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="image_viewt"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
         </div>
         
         <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <div class="zag_viewt"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
         
            <?php if ($product['price']) { ?>
            <div class="price">
              <?php if (!$product['special']) { ?>
              <?php echo $product['price']; ?>
              <?php } else { ?>
              <div class="price-new-viewt"><?php echo $product['special']; ?></div> <div class="price-old-viewt"><?php echo $product['price']; ?></div>
              <?php } ?>
              <?php if ($product['tax']) { ?>
              <div class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></div>
              <?php } ?>
              </div>
            <?php } ?>
         </div>
      </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
