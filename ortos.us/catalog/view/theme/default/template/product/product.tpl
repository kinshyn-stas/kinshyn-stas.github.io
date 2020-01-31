<?php echo $header; ?>
<div class="container det55">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
   
    <?php echo $content_top; ?>
    
    <div class="row">      
      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
          <h1><?php echo $heading_title; ?></h1>
      </div>     
      <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <?php if ($review_status) { ?>
            <div class="rating">
              <p>
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($rating < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } ?>
                <?php } ?>
                </p>
             
            </div>
            <?php } ?>
        </div>    
    </div>
    
    <div class="row" id="bord_det">
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <? if($upc!="") {?>
              <div class="upc"><?echo $upc;?></div>
            <?}?>
            <? if($ean!="") {?>
              <div class="ean"><?echo $ean;?></div>
            <?}?>
            <? if($jan!="") {?>
              <div class="jan"><?echo $jan;?></div>
            <?}?>
            <? if($isbn!="") {?>
              <div class="isbn"><?echo $isbn;?></div>
            <?}?>
            <?php if ($thumb || $images) { ?>
              <ul class="thumbnails">
                <?php if ($thumb) { ?>
                <li><a class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
                <?php } ?>
                <?php if ($images) { ?>
                <?php foreach ($images as $image) { ?>
                <li class="image-additional"><a class="thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
                <?php } ?>
                <?php } ?>
              </ul>
              <?php } ?>
        </div>
        
         
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          
            <div id="product">
         <div class="container-fluid">                    
         <div class="row">
           
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
         
         
              
                <ul class="list_det">
                   
                    
                      
              
                    <?php if ($options) { ?>
                    
                    <?php foreach ($options as $option) { ?>
                    <?php if ($option['type'] == 'select') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                        <option value=""><?php echo $text_select; ?></option>
                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                        <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                        <?php if ($option_value['price']) { ?>
                        (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                        <?php } ?>
                        </option>
                        <?php } ?>
                      </select>
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'radio') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <div id="input-option<?php echo $option['product_option_id']; ?>">
                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                            <?php if ($option_value['image']) { ?>
                            <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>"  /> 
                            <?php } ?>                    
                            <nn><?php echo $option_value['name']; ?></nn>
                            
                          </label>
                        </div>
                        <?php } ?>
                      </div>
                     
                    </div>
                    <?if($option['product_option_id']=="3") {?>
                      <a href="/size_tabl" class="size_table"><img src="/image/catalog/size_table.png" alt="">Посмотреть размерную таблицу</a>
                      <?}?>
                    <?php } ?>
                    <?php if ($option['type'] == 'checkbox') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label"><?php echo $option['name']; ?></label>
                      <div id="input-option<?php echo $option['product_option_id']; ?>">
                        <?php foreach ($option['product_option_value'] as $option_value) { ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                            <?php if ($option_value['image']) { ?>
                            <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> 
                            <?php } ?>
                            <?php echo $option_value['name']; ?>
                            <?php if ($option_value['price']) { ?>
                            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                            <?php } ?>
                          </label>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'text') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'textarea') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'file') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label"><?php echo $option['name']; ?></label>
                      <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                      <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'date') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <div class="input-group date">
                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                        </span></div>
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'datetime') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <div class="input-group datetime">
                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                    </div>
                    <?php } ?>
                    <?php if ($option['type'] == 'time') { ?>
                    <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
                      <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
                      <div class="input-group time">
                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span></div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>

                      <div class="clearfix"></div>
                
                          <?php foreach ($attribute_groups as $attribute_group) { ?>                      
                            <div class="container-fluid nopad har0">
                            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>                                                            
                              <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
                                  <span class="zag_atr"><?php echo $attribute['name']; ?>:</span>
                             
                                  <span class="val_atr"><?php echo $attribute['text']; ?></span>
                                </div>
                                </div>                               
                            <?php } ?>
                          </div>
                          <?php } ?>
                       
                 
                
               
          </div>
          <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
              <div class="sku"><?php echo $text_model; ?> <span><?php echo $model; ?></span> </div>
              <?php if ($price) { ?>
                <ul class="list-unstyled">
                  <?php if (!$special) { ?>
                  <li>
                    <h2><?php echo $price; ?></h2>
                  </li>
                  <?php } else { ?>
                    <div class="pr_det_new">
                        <?php echo $special; ?>
                    </div>
                    <div class="pr_det_old"><?php echo $price; ?></div>
                 
                  <?php } ?>
                  <?php if ($tax) { ?>
                  <li><?php echo $text_tax; ?> <?php echo $tax; ?></li>
                  <?php } ?>
                  <?php if ($points) { ?>
                  <li><?php echo $text_points; ?> <?php echo $points; ?></li>
                  <?php } ?>
                  <?php if ($discounts) { ?>
                  <li>
                    <hr>
                  </li>
                  <?php foreach ($discounts as $discount) { ?>
                  <li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>
                  <?php } ?>
                  <?php } ?>
                </ul>
                <?php } ?>
              <div class="form-group">
                      
                  <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                  
                  <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>
                </div>
                <?php if ($minimum > 1) { ?>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
                <?php } ?>
                <div class="iconlist_det">
                    <button type="button" data-toggle="tooltip" class="" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22"><image data-name="Vector Smart Object" width="22" height="22" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAMAAADzapwJAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAwFBMVEV7WZ3///97WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ17WZ0AAACiVxG3AAAAPnRSTlMAAEey7vCxSAak53MoECd06KPFE8HECnLxJSS+YG26uRL0LSyLthHqV1kWFae7AwzThdQiYjzyTkxYP+2Cxvcuba4AAAABYktHRD8+YzB1AAAACXBIWXMAAAsSAAALEgHS3X78AAAAB3RJTUUH4wgCAwwYe+IpxQAAANlJREFUGNNl0FcSgkAQRdHXMjiCICjmjDknVIzsf1kOIoUw7+vW+esGgJzCAjXPReTVgCk5IgIKml40zJJll8u2VTKNoq4VBGsVB+GcajUMIqemEbgeKVCv48vk6BxKA6kJpoYCZshsMASmzGaAZkvmdhOdrszdDnp9mQc9DN1RlsfuEJhMszydiCtn80WaF/OZYCzt1T+v7WX4KmCz3SW8224o4v3hmPDxtP8xPHaO9cw8ihmXqx+Ff71QwuDu132X0z/jpt6Bu3pDmvF4vl7PB7IM7/32EPMH4BgQkXMUeY0AAAAASUVORK5CYII="/></svg>
                    </button>
                    <button type="button" data-toggle="tooltip" class="" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 33"><path d="M19.568 7.693a.5.5 0 0 1-.082-.993l10.815-1.805a.5.5 0 0 1 .165.986L19.651 7.686a.457.457 0 0 1-.083.007zM2.615 10.522a.5.5 0 0 1-.082-.993L13.432 7.71a.5.5 0 0 1 .165.986L2.698 10.515a.465.465 0 0 1-.083.007zM26.836 23.305a6.171 6.171 0 0 1-6.163-6.164.5.5 0 0 1 .5-.5H32.5a.5.5 0 0 1 .5.5 6.17 6.17 0 0 1-6.164 6.164zm-5.139-5.664a5.17 5.17 0 0 0 5.139 4.664 5.171 5.171 0 0 0 5.14-4.664H21.697z"/><path d="M21.173 17.641a.501.501 0 0 1-.443-.732l5.663-10.851c.173-.33.714-.33.887 0l5.664 10.851a.501.501 0 0 1-.887.463l-5.22-10.001-5.22 10.001a.502.502 0 0 1-.444.269zM6.164 26.54A6.171 6.171 0 0 1 0 20.376a.5.5 0 0 1 .5-.5h11.327a.5.5 0 0 1 .5.5 6.171 6.171 0 0 1-6.163 6.164zm-5.14-5.664a5.17 5.17 0 0 0 5.14 4.664 5.17 5.17 0 0 0 5.139-4.664H1.024z"/><path d="M11.827 20.876a.502.502 0 0 1-.444-.269l-5.22-10.001-5.22 10.001a.501.501 0 0 1-.887-.463L5.72 9.293c.173-.33.714-.33.887 0l5.663 10.851a.501.501 0 0 1-.443.732zM16.5 11.255a3.555 3.555 0 0 1-3.551-3.551c0-1.957 1.593-3.55 3.551-3.55s3.551 1.593 3.551 3.55a3.554 3.554 0 0 1-3.551 3.551zm0-6.1c-1.407 0-2.551 1.144-2.551 2.55s1.144 2.551 2.551 2.551 2.551-1.145 2.551-2.551-1.144-2.55-2.551-2.55z"/><path d="M16.5 30.059a.5.5 0 0 1-.5-.5V10.755a.5.5 0 0 1 1 0v18.804a.5.5 0 0 1-.5.5zM16.5 5.155a.5.5 0 0 1-.5-.5V3.441a.5.5 0 0 1 1 0v1.214a.5.5 0 0 1-.5.5z"/><path d="M23.096 30.059H9.904a.5.5 0 0 1 0-1h13.192a.5.5 0 0 1 0 1z"/></svg>
                    </button>
                  </div>
          </div> 
          
        
          </div>
        </div>
        <hr>
        <div class="container-fluid nopad">          
            <div class="row">              
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div class="b1"><?php echo $content_det1; ?></div> 
                </div>    
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="b2"><?php echo $content_det2; ?></div> 
                  </div>           
            </div>          
        </div>
        
      </div>
      </div>
      <hr>
      
      



        </div>
      
      
      <div class="row">
        
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
                  <?php if ($attribute_groups) { ?>
                  <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
                  <?php } ?>
                  <li><a href="#tab-poh-tov" data-toggle="tab"><?php echo $text_dehevle; ?></a></li>
                  <?php if ($review_status) { ?>
                  <li><a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a></li>
                  <?php } ?>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab-description"><?php echo $description; ?></div>
                  <?php if ($attribute_groups) { ?>
                  <div class="tab-pane" id="tab-specification">
                        <div class="container-fluid">
                          <?php foreach ($attribute_groups as $attribute_group) { ?>                      
                          <div class="row">
                            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>                              
                              <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                  <div class="zag_atr"><?php echo $attribute['name']; ?></div>
                              </div>                              
                              <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                                  <div class="val_atr"><?php echo $attribute['text']; ?></div>
                              </div>
                           
                            <?php } ?>
                          </div>
                          <?php } ?>
                        </div>
                     
                  </div>
                  <?php } ?>


                  
                    <div class="tab-pane" id="tab-poh-tov">
                        <div class="zag_tabpane"><?php echo $text_dehevle; ?></div>
                        <?php echo $content_bottom; ?>
                    </div>
                    



                  <?php if ($review_status) { ?>
                  <div class="tab-pane" id="tab-review">
                    <form class="form-horizontal" id="form-review">
                      <div id="review"></div>
                      <h2><?php echo $text_write; ?></h2>
                      <?php if ($review_guest) { ?>
                      <div class="form-group required">
                        <div class="col-sm-12">
                          <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                          <input type="text" name="name" value="<?php echo $customer_name; ?>" id="input-name" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group required">
                        <div class="col-sm-12">
                          <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                          <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                          <div class="help-block"><?php echo $text_note; ?></div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <div class="col-sm-12">
                          <label class="control-label"><?php echo $entry_rating; ?></label>
                          &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                          <input type="radio" name="rating" value="1" />
                          &nbsp;
                          <input type="radio" name="rating" value="2" />
                          &nbsp;
                          <input type="radio" name="rating" value="3" />
                          &nbsp;
                          <input type="radio" name="rating" value="4" />
                          &nbsp;
                          <input type="radio" name="rating" value="5" />
                          &nbsp;<?php echo $entry_good; ?></div>
                      </div>
                      <?php echo $captcha; ?>
                      <div class="buttons clearfix">
                        <div class="pull-right">
                          <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                        </div>
                      </div>
                      <?php } else { ?>
                      <?php echo $text_login; ?>
                      <?php } ?>
                    </form>
                  </div>
                  <?php } ?>
                </div>
          </div>
          
        </div>



        <div class="row">        
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
        <div class="zag_mod"><span><?php echo $text_related; ?></span></div>
        <div id="carouselrel5" class="owl-carousel">
          
          <?php foreach ($products as $product) { ?>
           
          <div class="item text-center">
              <div class="fon_tov">
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
              <div class="fon_list">
  
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
          </div>
           
          <?php } ?>
        </div>
      </div>
    </div>
 
      
    </div>
    
    <div class="container">
      
      <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php echo $content_viewt; ?>
        </div>
        
      </div>
      
    </div>
    
    <script type="text/javascript"><!--
      $('#carouselrel5').owlCarousel({
        items: 4,
        autoPlay: false,
        navigation: true,
        navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
        pagination: false
      });
      --></script>  
<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart > ul').load('index.php?route=common/cart/info ul li');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script>
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
    grecaptcha.reset();
});

$(document).ready(function() {
	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});

$(document).ready(function() {
	var hash = window.location.hash;
	if (hash) {
		var hashpart = hash.split('#');
		var  vals = hashpart[1].split('-');
		for (i=0; i<vals.length; i++) {
			$('#product').find('select option[value="'+vals[i]+'"]').attr('selected', true).trigger('select');
			$('#product').find('input[type="radio"][value="'+vals[i]+'"]').attr('checked', true).trigger('click');
			$('#product').find('input[type="checkbox"][value="'+vals[i]+'"]').attr('checked', true).trigger('click');
		}
	}
})
//--></script>
<?php echo $footer; ?>
