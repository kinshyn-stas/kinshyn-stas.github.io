<?php echo $header; ?>
<div class="container">
  
		<ul class="breadcrumb">
		<?php $breadlast = array_pop($breadcrumbs); foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		<li><?php echo $breadlast['text']; ?></li>
		</ul>
		
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="zag_ac"><?php echo $text_my_account; ?></div>
      <ul class="list-unstyled">
             		
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 nopad">
                <div class="product-thumb1">
                    <a href="<?php echo $edit; ?>">
                        <div class="zag_im_acc">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M45 393.2c38.9 0 70.5-38.3 70.5-85.6S105.1 222 45 222s-70.5 38.3-70.5 85.6S6.1 393.2 45 393.2zM177.9 520.4c-1.3-82.3-12.1-105.8-94.4-120.7 0 0-11.6 14.8-38.6 14.8S6.3 399.7 6.3 399.7c-81.4 14.7-92.8 37.8-94.3 118-.1 6.5-.2 6.9-.2 6.1v8.7S-68.6 572 44.9 572 178 532.5 178 532.5v-6.4c.1.5 0-.4-.1-5.7z"/></svg>
                        </div>
                        <div class="linkak"><?php echo $text_edit; ?></div>
                    </a>
                </div>
            </div>
      
             
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $password; ?>">
                            <div class="zag_im_acc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M189.4 252.6c-39.4-39.4-103.3-39.4-142.7 0-31.5 31.5-37.8 78.7-18.9 116.5l-156.7 156.7-.1 45.1 87.6.1v-42.6H1.2v-42.6h42.6v-42.6l29-29c37.8 18.9 85 12.6 116.5-18.9 39.5-39.4 39.5-103.3.1-142.7zm-32.1 75.2c-11.9 11.9-31.2 11.9-43.2 0-12-11.9-11.9-31.2 0-43.2s31.2-11.9 43.2 0c11.9 12 11.9 31.3 0 43.2z"/></svg>
                            </div>
                            <div class="linkak"><?php echo $text_password; ?></div>
                        </a>
                    </div>
                </div>		
 
      
             		
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="product-thumb1">
                        <a href="<?php echo $address; ?>">
                        <div class="zag_im_acc">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M-13.6 327.7v70.7h25.7v-45c0-3.5 2.9-6.4 6.4-6.4H57c3.5 0 6.4 2.9 6.4 6.4v45h25.7v-70.7c0-3.5 2.9-6.4 6.4-6.4h6.8l-64.6-49.7-64.6 49.7h6.8c3.6 0 6.5 2.9 6.5 6.4z"/><path d="M24.9 359.9h25.7v38.6H24.9v-38.6z"/><path d="M45 570.7C68.7 541.1 170.9 410 170.9 347.8 170.9 278.4 114.5 222 45 222S-80.9 278.4-80.9 347.9C-80.9 410 21.3 541.2 45 570.7zM-40.7 324l81.8-62.9c2.3-1.7 5.4-1.7 7.7 0l81.8 62.9c2.1 1.7 3 4.5 2.1 7s-3.2 4.3-5.9 4.3h-18.9v69.2c0 3.5-2.8 6.3-6.3 6.3H-11.6c-3.5 0-6.3-2.8-6.3-6.3v-69.2h-18.9c-2.7 0-5.1-1.7-6-4.3-.8-2.5 0-5.3 2.1-7z"/></svg>
                        </div>
                        <div class="linkak"><?php echo $text_address; ?></div>
                    </a>
                </div>
            </div>		
 
      
          
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $wishlist; ?>">
                            <div class="zag_im_acc">
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M45 562l-24.5-24.5C-70.5 457-130 402.7-130 336.2c0-54.2 42-96.2 96.3-96.2 29.8 0 59.5 14 78.8 36.8C64.2 254 94 240 123.8 240c54.2 0 96.2 42 96.2 96.2 0 66.5-59.5 120.7-150.5 201.3L45 562z"/></svg>
                            </div>
                            <div class="linkak"><?php echo $text_wishlist; ?></div>
                        </a>
                    </div>
                </div>		   		
		
      
      </ul>
      <?php if ($credit_cards) { ?>
      <div class="zag_ac"><?php echo $text_credit_card; ?></div>
      <ul class="list-unstyled">
        <?php foreach ($credit_cards as $credit_card) { ?>
        <li><a href="<?php echo $credit_card['href']; ?>"><?php echo $credit_card['name']; ?></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
      <div class="zag_ac"><?php echo $text_my_orders; ?></div>
      <ul class="list-unstyled">
             
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $order; ?>">
                            <div class="zag_im_acc">
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M-107.1 572H130v-92.6l-51.8 51.8c-.5.4-.9.8-1.5 1.1l-57.3 30.9c-2.4 1.3-5.4.9-7.4-1.1s-2.4-5-1.1-7.4l30.9-57.4c.3-.5.7-1 1.1-1.5l87.1-87.1V222.6H-26v74.9c0 3.4-2.8 6.2-6.2 6.2h-74.9V572zm87.4-18.7h-12.5v-12.5h12.5v12.5zm24.9 0H-7.3v-12.5H5.2v12.5zm12.5-280.8h25v-25h37.4v25h25v37.4h-25v25H42.7v-25h-25v-37.4zM-44.7 391h149.8v12.5H-44.7V391zm0 37.5H73.9V441H-44.7v-12.5zm0 37.4h81.1v12.5h-81.1v-12.5zm0 87.4h-12.5v-12.5h12.5v12.5zM-82.1 391h25v12.5h-25V391zm0 37.5h25V441h-25v-12.5zm0 37.4h25v12.5h-25v-12.5zm0 74.9h12.5v12.5h-12.5v-12.5z"/><path d="M55.2 322.4h12.5v-25h25V285h-25v-25H55.2v25h-25v12.5h25v24.9zM-98.2 291.2h59.8v-59.8l-59.8 59.8zM184 407.7l8.9-8.9-17.7-17.7-8.9 8.9 17.7 17.7zM206.2 385.6c1.2-1.2 1.8-2.8 1.8-4.4 0-1.7-.7-3.2-1.8-4.4l-8.8-8.8c-2.5-2.4-6.4-2.4-8.8 0l-4.4 4.4 17.7 17.7 4.3-4.5zM157.6 398.9L56.2 500.3l17.6 17.6 101.4-101.4c-4.3-4.2-16.6-16.6-17.6-17.6zM63.5 525.2l-14.6-14.6-17 31.6 31.6-17z"/></svg>
                            </div>
                            <div class="linkak"><?php echo $text_order; ?></div>
                        </a>
                    </div>
                </div>		   
            

      
             	
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $download; ?>">
                            <div class="zag_im_acc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M213.5 460.1c-3.9-4.1-8.7-6.2-14.3-6.2h-97.4l-28.6 30.2c-8.1 8.3-17.6 12.5-28.6 12.5-10.9 0-20.4-4.1-28.6-12.5l-28.3-30.2h-97.5c-5.6 0-10.4 2.1-14.3 6.2-3.9 4.2-5.9 9.2-5.9 15.2v71.1c0 5.9 2 11 5.9 15.1s8.7 6.2 14.3 6.2h309c5.6 0 10.4-2.1 14.3-6.2s5.9-9.2 5.9-15.1v-71.1c-.1-6-2-11-5.9-15.2zm-78.8 75c-2.7 2.8-5.8 4.2-9.5 4.2-3.6 0-6.8-1.4-9.4-4.2-2.7-2.8-4-6.2-4-10 0-3.9 1.3-7.2 4-10s5.8-4.2 9.4-4.2c3.6 0 6.8 1.4 9.5 4.2 2.7 2.8 4 6.2 4 10s-1.3 7.2-4 10zm53.8 0c-2.7 2.8-5.8 4.2-9.4 4.2s-6.8-1.4-9.4-4.2c-2.7-2.8-4-6.2-4-10 0-3.9 1.3-7.2 4-10s5.8-4.2 9.4-4.2 6.8 1.4 9.4 4.2c2.7 2.8 4 6.2 4 10s-1.4 7.2-4 10z"/><path d="M35.2 463.9c2.5 2.8 5.7 4.2 9.4 4.2 3.8 0 6.9-1.4 9.4-4.2l94.1-99.6c4.3-4.3 5.3-9.5 2.9-15.6-2.4-5.8-6.5-8.7-12.4-8.7H85v-99.5c0-3.9-1.3-7.2-4-10s-5.8-4.2-9.4-4.2H17.8c-3.6 0-6.8 1.4-9.4 4.2-2.7 2.8-4 6.2-4 10v99.6h-53.8c-5.9 0-10 2.9-12.4 8.7-2.4 6.1-1.4 11.3 2.9 15.6l94.1 99.5z"/></svg>
                            </div>
                            <div class="linkak ddd"><?php echo $text_download; ?></div>
                        </a>
                    </div>
                </div>		      
            
 
      
        <?php if ($reward) { ?>
             
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $reward; ?>">
                            <div class="zag_im_acc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M213.5 460.1c-3.9-4.1-8.7-6.2-14.3-6.2h-97.4l-28.6 30.2c-8.1 8.3-17.6 12.5-28.6 12.5-10.9 0-20.4-4.1-28.6-12.5l-28.3-30.2h-97.5c-5.6 0-10.4 2.1-14.3 6.2-3.9 4.2-5.9 9.2-5.9 15.2v71.1c0 5.9 2 11 5.9 15.1s8.7 6.2 14.3 6.2h309c5.6 0 10.4-2.1 14.3-6.2s5.9-9.2 5.9-15.1v-71.1c-.1-6-2-11-5.9-15.2zm-78.8 75c-2.7 2.8-5.8 4.2-9.5 4.2-3.6 0-6.8-1.4-9.4-4.2-2.7-2.8-4-6.2-4-10 0-3.9 1.3-7.2 4-10s5.8-4.2 9.4-4.2c3.6 0 6.8 1.4 9.5 4.2 2.7 2.8 4 6.2 4 10s-1.3 7.2-4 10zm53.8 0c-2.7 2.8-5.8 4.2-9.4 4.2s-6.8-1.4-9.4-4.2c-2.7-2.8-4-6.2-4-10 0-3.9 1.3-7.2 4-10s5.8-4.2 9.4-4.2 6.8 1.4 9.4 4.2c2.7 2.8 4 6.2 4 10s-1.4 7.2-4 10z"/><path d="M35.2 463.9c2.5 2.8 5.7 4.2 9.4 4.2 3.8 0 6.9-1.4 9.4-4.2l94.1-99.6c4.3-4.3 5.3-9.5 2.9-15.6-2.4-5.8-6.5-8.7-12.4-8.7H85v-99.5c0-3.9-1.3-7.2-4-10s-5.8-4.2-9.4-4.2H17.8c-3.6 0-6.8 1.4-9.4 4.2-2.7 2.8-4 6.2-4 10v99.6h-53.8c-5.9 0-10 2.9-12.4 8.7-2.4 6.1-1.4 11.3 2.9 15.6l94.1 99.5z"/></svg>
                            </div>
                            <div class="linkak"><?php echo $text_reward; ?></div>
                        </a>
                    </div>
                </div>		     
 
      
        <?php } ?>
             		
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $return; ?>">
                            <div class="zag_im_acc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M132.5 330.8H52v-65.9c0-12.3-14.4-18.9-23.7-10.9L-125 385.4c-6.7 5.7-6.7 16.1 0 21.8L28.3 538.6c9.3 8 23.7 1.4 23.7-10.9v-65.9h80.5c24 0 40.5 10.2 50.3 31 8 17 8.3 34.8 8.3 35 0 7.9 6.5 14.3 14.4 14.3s14.4-6.4 14.4-14.4V418.2c0-48.2-39.2-87.4-87.4-87.4z"/></svg>
                            </div>
                            <div class="linkak"><?php echo $text_return; ?></div>
                        </a>
                    </div>
                </div>		    
 
      
             		
 
      
             		
 
      
      </ul>
      <div class="zag_ac"><?php echo $text_my_newsletter; ?></div>
      <ul class="list-unstyled">
             		
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="product-thumb1">
                            <a href="<?php echo $newsletter; ?>">
                            <div class="zag_im_acc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-130 222 350 350"><path d="M-96.4 348.8c4.4 3.1 17.8 12.4 40 27.8 22.3 15.4 39.3 27.3 51.2 35.6 1.3.9 4.1 2.9 8.3 6s7.7 5.5 10.5 7.4 6.2 4 10.2 6.3c4 2.3 7.7 4.1 11.2 5.3s6.8 1.8 9.8 1.8h.4c3 0 6.3-.6 9.8-1.8s7.3-2.9 11.2-5.3c4-2.3 7.4-4.5 10.2-6.3 2.8-1.9 6.3-4.4 10.5-7.4 4.2-3.1 7-5 8.3-6 12-8.3 42.4-29.5 91.4-63.5 9.5-6.6 17.4-14.6 23.8-24s9.6-19.2 9.6-29.5c0-8.6-3.1-16-9.3-22.1-6.2-6.1-13.5-9.2-22-9.2H-98.8c-10 0-17.7 3.4-23.1 10.2s-8.1 15.3-8.1 25.4c0 8.2 3.6 17.1 10.7 26.7 7.2 9.6 14.8 17.1 22.9 22.6z"/><path d="M200.5 369.7c-42.7 28.9-75.1 51.4-97.3 67.4-7.4 5.5-13.4 9.7-18.1 12.8-4.6 3.1-10.8 6.2-18.5 9.4-7.7 3.2-14.8 4.8-21.5 4.8H44.8c-6.6 0-13.8-1.6-21.5-4.8-7.7-3.2-13.8-6.3-18.5-9.4-4.6-3.1-10.6-7.3-18.1-12.8-17.6-12.9-49.9-35.4-97.1-67.4-7.4-4.9-14-10.6-19.7-17v155.1c0 8.6 3.1 16 9.2 22.1s13.5 9.2 22.1 9.2h287.5c8.6 0 15.9-3.1 22.1-9.2 6.1-6.1 9.2-13.5 9.2-22.1V352.7c-5.6 6.2-12.1 11.9-19.5 17z"/></svg>
                            </div>
                            <div class="linkak ddd"><?php echo $text_newsletter; ?></div>
                        </a>
                    </div>
                </div>		 
 
      
      </ul>
     
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<br><br>
<div class="container">
  
        <a class="btn btn-primary" style="font-size: 20px;" href="/logout">Выход</a>  
 
   
</div>

<?php echo $footer; ?> 