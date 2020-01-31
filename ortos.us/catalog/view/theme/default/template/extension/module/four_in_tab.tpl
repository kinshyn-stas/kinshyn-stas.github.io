<?php if ($module_data) { ?>
<div class="zag_mod"><span><?php echo $heading_title; ?></span></div>
<?php if ($theme == 'tab') { ?>
<div class="four-in-tab row" id="four-in-tab<?php echo $module; ?>">
  <div class="col-xs-12">
    <?php if (count($module_data) == 1) { ?>
    <h3><?php echo $module_data[0]['name']; ?></h3>
    <?php } else { ?>
    <ul class="nav nav-tabs<?php echo $adaptive ? " row" : ""; ?>">
    <?php $active = " active"; ?>
    <?php foreach ($module_data as $data) { ?>
      <li class="<?php echo $data['id']; ?><?php echo $active; ?>"><a href="#<?php echo $data['id']; ?><?php echo $module; ?>" aria-controls="<?php echo $data['id']; ?><?php echo $module; ?>" data-toggle="tab"><?php echo $data['name']; ?></a></li>
      <?php $active = ""; ?>
    <?php } ?>
    </ul>
    <?php } ?>

    <div class="tab-content row">
      <?php $active = " in active"; ?>
      <?php foreach ($module_data as $data) { ?>
      <div class="tab-pane fade<?php echo $active; ?>" id="<?php echo $data['id']; ?><?php echo $module; ?>">
        <div class="<?php echo isset($carousel_status) ? "owl-carousel" : ""; ?>" id="<?php echo $data['id']; ?><?php echo $module; ?>-owl">
          <?php $active = ""; ?>
          <?php foreach ($data['products'] as $product) { ?>
          <div class="<?php echo isset($carousel_status) ? "" : "col-sm-3 "; ?>col-xs-12 item">
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
             
                <div class="clearfix"></div>
                <div class="container-fluid nopad enter">                  
                    <div class="row">                    
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 iconlist">
                          <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22"><image data-name="Vector Smart Object" width="22" height="22" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAMAAADzapwJAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAwFBMVEV7WZ3///97WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ0AAACiVxG3AAAAPnRSTlMAAEey7vCxSAak53MoECd06KPFE8HECnLxJSS+YG26uRL0LSyLthHqV1kWFae7AwzThdQiYjzyTkxYP+2Cxvcuba4AAAABYktHRD8+YzB1AAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH4wgCAwwYe+IpxQAAANlJREFUGNNl0FcSgkAQRdHXMjiCICjmjDknVIzsf1kOIoUw7+vW+esGgJzCAjXPReTVgCk5IgIKml40zJJll8u2VTKNoq4VBGsVB+GcajUMIqemEbgeKVCv48vk6BxKA6kJpoYCZshsMASmzGaAZkvmdhOdrszdDnp9mQc9DN1RlsfuEJhMszydiCtn80WaF/OZYCzt1T+v7WX4KmCz3SW8224o4v3hmPDxtP8xPHaO9cw8ihmXqx+Ff71QwuDu132X0z/jpt6Bu3pDmvF4vl7PB7IM7/32EPMH4BgQkXMUeY0AAAAASUVORK5CYII="/></svg>
                          </button>
                          <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33"><path d="M19.568 7.693a.5.5 0 0 1-.082-.993l10.815-1.805a.5.5 0 0 1 .165.986L19.651 7.686a.457.457 0 0 1-.083.007zM2.615 10.522a.5.5 0 0 1-.082-.993L13.432 7.71a.5.5 0 0 1 .165.986L2.698 10.515a.465.465 0 0 1-.083.007zM26.836 23.305a6.171 6.171 0 0 1-6.163-6.164.5.5 0 0 1 .5-.5H32.5a.5.5 0 0 1 .5.5 6.17 6.17 0 0 1-6.164 6.164zm-5.139-5.664a5.17 5.17 0 0 0 5.139 4.664 5.171 5.171 0 0 0 5.14-4.664H21.697z"/><path d="M21.173 17.641a.501.501 0 0 1-.443-.732l5.663-10.851c.173-.33.714-.33.887 0l5.664 10.851a.501.501 0 0 1-.887.463l-5.22-10.001-5.22 10.001a.502.502 0 0 1-.444.269zM6.164 26.54A6.171 6.171 0 0 1 0 20.376a.5.5 0 0 1 .5-.5h11.327a.5.5 0 0 1 .5.5 6.171 6.171 0 0 1-6.163 6.164zm-5.14-5.664a5.17 5.17 0 0 0 5.14 4.664 5.17 5.17 0 0 0 5.139-4.664H1.024z"/><path d="M11.827 20.876a.502.502 0 0 1-.444-.269l-5.22-10.001-5.22 10.001a.501.501 0 0 1-.887-.463L5.72 9.293c.173-.33.714-.33.887 0l5.663 10.851a.501.501 0 0 1-.443.732zM16.5 11.255a3.555 3.555 0 0 1-3.551-3.551c0-1.957 1.593-3.55 3.551-3.55s3.551 1.593 3.551 3.55a3.554 3.554 0 0 1-3.551 3.551zm0-6.1c-1.407 0-2.551 1.144-2.551 2.55s1.144 2.551 2.551 2.551 2.551-1.145 2.551-2.551-1.144-2.55-2.551-2.55z"/><path d="M16.5 30.059a.5.5 0 0 1-.5-.5V10.755a.5.5 0 0 1 1 0v18.804a.5.5 0 0 1-.5.5zM16.5 5.155a.5.5 0 0 1-.5-.5V3.441a.5.5 0 0 1 1 0v1.214a.5.5 0 0 1-.5.5z"/><path d="M23.096 30.059H9.904a.5.5 0 0 1 0-1h13.192a.5.5 0 0 1 0 1z"/></svg>
                          </button>
                      </div>   
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                          <button type="button" class="add_list2" onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $button_cart; ?></button>
                
                      </div>
                                       
                    </div>                  
                  </div>
                
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } elseif ($theme == 'panel')  { ?>
<div class="panel panel-default four-in-tab<?php echo (count($module_data) == 1) ? " panel-one" : ""; ?>" id="four-in-tab<?php echo $module; ?>">
  <div class="panel-heading">
    <?php if (count($module_data) == 1) { ?>
    <h3 class="panel-title"><?php echo $module_data[0]['name']; ?></h3>
    <?php } else { ?>
    <ul class="pagination">
    <?php $active = " active"; ?>
    <?php foreach ($module_data as $data) { ?>
      <li class="<?php echo $data['id']; ?> <?php echo $active; ?>"><a href="#<?php echo $data['id']; ?><?php echo $module; ?>" aria-controls="<?php echo $data['id']; ?><?php echo $module; ?>" data-toggle="tab"><?php echo $data['name']; ?></a></li>
      <?php $active = ""; ?>
    <?php } ?>
    </ul>
<!--
    <div class="btn-group">
    <?php $active = " active"; ?>
    <?php foreach ($module_data as $data) { ?>
      <a class="btn btn-default <?php echo $active; ?>" role="button" href="#<?php echo $data['id']; ?><?php echo $module; ?>" aria-controls="<?php echo $data['id']; ?><?php echo $module; ?>" data-toggle="tab"><?php echo $data['name']; ?></a>
      <?php $active = ""; ?>
    <?php } ?>
    </div>
-->
    <?php } ?>
  </div>
  <div class="panel-body tab-content">
      <?php $active = " in active"; ?>
      <?php foreach ($module_data as $data) { ?>
      <div class="row tab-pane fade<?php echo $active; ?>" id="<?php echo $data['id']; ?><?php echo $module; ?>">
        <div class="<?php echo isset($carousel_status) ? "owl-carousel" : ""; ?>" id="<?php echo $data['id']; ?><?php echo $module; ?>-owl">
          <?php $active = ""; ?>
          <?php foreach ($data['products'] as $product) { ?>
          <div class="product-layout <?php echo isset($carousel_status) ? "" : "col-sm-3 "; ?>col-xs-12 item">
            <div class="product-thumb transition">
              <div class="image">
                <a href="<?php echo $product['href']; ?>">
                  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
                </a>
              </div>
              <div class="caption">
                <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                <?php if ($description) { ?>
                <p><?php echo $product['description']; ?></p>
                <?php } ?>
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
                <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
  </div>
</div>
<?php } else { ?>
<?php } ?>
<?php } ?>
<a class="all_cat" href="/allcat">Весь  каталог  товаров</a>
<?php if (isset($carousel_status)) { ?>
<script type="text/javascript"><!--
<?php foreach ($module_data as $data) { ?>
$('#<?php echo $data['id']; ?><?php echo $module; ?>-owl').owlCarousel({
	items: <?php echo $carousel_items; ?>,
	autoPlay: <?php echo $carousel_autoplay; ?>,
    stopOnHover : <?php echo $carousel_hover; ?>,
	navigation: <?php echo $carousel_navigation; ?>,
	navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
	pagination: <?php echo $carousel_pagination; ?>
});
<?php } ?>
--></script>
<?php } ?>