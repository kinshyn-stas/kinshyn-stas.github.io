<?php echo $header; ?>
<div class="container">
  
		<ul class="breadcrumb">
		<?php $breadlast = array_pop($breadcrumbs); foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
		<li><?php echo $breadlast['text']; ?></li>
		</ul>
		
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="zag_cat"><h1><?php echo $heading_title; ?></h1></div>

      <?php if ($products) { ?>
        <div class="row">
        
        
     
         
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <link rel="stylesheet" type="text/css" href="/catalog/view/stylesheet/sha-sort.css" />
            <label class="input-group-addon" for="input-sort"><?php echo $text_sort; ?></label>
            <div id="sha-sort"><!-- <b><?php echo $text_sort; ?></b> -->
  
          
              <?php foreach ($sorts as $sort_key => $sort_val) { ?>
                
                <a sort-class="<?php echo $sort_val['value']; ?>" class="sha-sortitem<?php if ($sort_val['value'] == $sort . '-' . $order) { ?> selected<?php } ?><?php if (!empty($sorts[$sort_key + 1]) && $sorts[$sort_key + 1]['value'] == $sort . '-' . $order) { ?> next-selected<?php } ?>" href="<?php echo $sort_val['href']; ?>"><span></span><?php echo $sort_val['text']; ?></a>
              <?php } ?>
            </div>
           </div>

           
           <td class="text-right"><?php if ($sort == 'p.price') { ?>
            <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
            <?php } else { ?>
            <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
            <?php } ?></td>
         
          <!-- <div class="col-xs-8 col-sm-12 col-md-8 col-lg-4">
            <div class="pag_cat">
              <label class="input-group-addon" for="input-limit"><?php echo $text_limit; ?></label>
              <ul class="pagin5">
            <?php foreach ($limits as $limits) { ?>
              <?php if ($limits['value'] == $limit) { ?>
                <li><a href="<?php echo $limits['href']; ?>" class="active"><?php echo $limits['text']; ?></a> </li>
               <?php } else { ?>
                <li> <a href="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></a> </li>
                <?php } ?>
               <?php } ?>
               </ul>
              </div>
          </div> -->
              
          <div class="col-xs-4 col-sm-12 col-md-4 col-lg-12">
              <div class="btn-group btn-group-sm listgrid0">
                <div class="listgrid">Вид:</div>
                <button type="button" id="list-view" class="" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
                <button type="button" id="grid-view" class="" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th-large" aria-hidden="true"></i></button>
              </div>
            
          </div>        
        </div>
      
      <div class="row" id="b_pag">
        <?php foreach ($products as $product) { ?>
          
          <div class="product-list col-xs-12">
          
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
              <div class="desc_list_mini"><?php echo $product['description']; ?></div>
              <div class="clearfix"></div>
              <div class="container-fluid nopad enter">                  
                  <div class="row">                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 iconlist">
                      <a href="<?php echo $product['remove']; ?>" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class=""><img src="/image/catalog/del5.png"></a> 
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
     
 
      <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
        <?php } ?>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
