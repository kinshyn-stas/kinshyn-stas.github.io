<?php global $config;
$modules_label_stock = true; //$config->get('config_modules_label_stock');
$modules_label_special = true; //$config->get('config_modules_label_special');
?>

<?php if(isset($position) && (($position == 'column_left') || ($position == 'column_right'))) { ?>
        <?php foreach ($products as $product) { ?>
            <div class="row product-thumb-left">
            <div class="col-lg-4 col-md-5">
                <div class="image">
                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="caption">
                    <div class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                    <?php if ($product['price']) { ?>
                        <p class="price">
                            <?php if (!$product['special']) { ?>
                                <?php echo $product['price']; ?>
                            <?php } else { ?>
                                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                            <?php } ?>
                            <?php if ($product['tax']) { ?>
                                <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                            <?php } ?>
                        </p>
                    <?php } ?>
                </div>
                <div class="button-group">
                    <button  type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="<?php echo $button_cart; ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i></button>
                    <button  type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart-o"></i></button>
                    <button  type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-bars"></i></button>
                </div>

            </div>
            </div>
        <?php } ?>
<?php } else { ?>
<div class="row product-row_flex">
  <?php foreach ($products as $product) { ?>
  <div class="<?php echo $class; ?>">
      <div class="product-thumb">
          <div class="inner">
              <div class="button-group labels">
                  <?php if ($product['promo_label_id']) { ?>
                      <span class="label label-<?php echo $product['promo_label_id']; ?>"><?php echo ${'label_' . $product['promo_label_id']}; ?></span><br/>
                  <?php } ?>
                  <?php if (($product['quantity'] <= 0)&&($modules_label_stock)) { ?>
                      <span class="label label-stock"><?php echo $product['stock_status']; ?></span><br/>
                  <?php } ?>
                  <?php if (($product['special'])&&($modules_label_special)) { ?>
                      <span class="label label-special"><?php echo $label_special; ?> -<?php echo $product['percent']; ?>%</span><br/>
                  <?php } ?>
              </div>
              <div class="button-group button-add">
                  <button id="fav-cart_small" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart-o"></i></button>
                  <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-bars"></i></button>
              </div>
              <div class="image">
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
              <div class="caption">
                  <div class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
              </div>

              <div class="product-thumb_bottom">
                  <?php if ($product['price']) { ?>
                      <p class="price">
                          <?php if (!$product['special']) { ?>
                              <?php echo $product['price']; ?>
                          <?php } else { ?>
                              <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                          <?php } ?>
                          <?php if ($product['tax']) { ?>
                              <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                          <?php } ?>
                      </p>
                  <?php } ?>
                <div class="button-group button-cart">
                    <button id="button-cart-small" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>
                </div>
              </div>

              <?php if ($product['rating']) { ?>
                  <div class="rating">
                      <?php for ($i = 1; $i <= 5; $i++) { ?>
                          <?php if ($product['rating'] < $i) { ?>
                              <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <?php } else { ?>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                          <?php } ?>
                      <?php } ?>
                  </div>
              <?php } ?>
              <div class="description_outer">
                <div class="description">
                    <?php if ($product['short_description']) { ?>
                        <?php echo $product['short_description']; ?>
                    <?php } else { ?>
                        <?php echo $product['description']; ?>
                    <?php } ?>
                </div>
              </div>
          </div>
      </div>
  </div>
  <?php } ?>
</div>
<?php } ?>
