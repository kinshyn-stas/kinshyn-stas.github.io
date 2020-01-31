<div class="zag_mod"><span><?php echo $heading_title; ?></span></div>
<div id="carouselspecial" class="owl-carousel">
  <?php foreach ($products as $product) { ?>
    <div class="item text-center">
        <div class="fon_tov">
            <? if($product['upc']!="") {?>
              <div class="upc"><?echo $product['upc'];?></div>
            <?}?>
            <? if($product['ean']!="") {?>
              <div class="ean"><?echo $product['ean'];?></div>
            <?}?>
            <? if($product['jan']!="") {?>
              <div class="jan"><?echo $product['jan'];?></div>
            <?}?>
            <? if($product['isbn']!="") {?>
              <div class="isbn"><?echo $product['isbn'];?></div>
            <?}?>
            <div class="rating">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($product['rating'] < $i) { ?>
              <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
              <?php } ?>
              <?php } ?>
            </div>
            
        <div class="image">
         
          <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
          </a>
        </div>
          <div class="zag_tov"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?> <span><?php echo $product['model']; ?></span></a></div>
           
         
          <?php if ($product['price']) { ?>
          <div class="price_tov">
            <?php if (!$product['special']) { ?>
            <div class="pr"><?php echo $product['price']; ?></div>
            <?php } else { ?>
            <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
            <?php } ?>
            <?php if ($product['tax']) { ?>
            <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
            <?php } ?>
            </div>
          <?php } ?>
       
           <button type="button" class="add_list" onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></button>
          
      </div>
    
  </div>
  <?php } ?>
</div>
<script type="text/javascript"><!--
  $('#carouselspecial').owlCarousel({
    items: 4,
    autoPlay: false,
    navigation: true,
    navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
    pagination: false
  });
  --></script>
