<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
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
      <h1><?php echo $heading_title; ?></h1>
      <label class="control-label" for="input-search"><?php echo $entry_search; ?></label>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_keyword; ?>" id="input-search" class="form-control" />
        </div>
        <div class="col-sm-3">
          <select name="category_id" class="form-control">
            <option value="0"><?php echo $text_category; ?></option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-3">
          <label class="checkbox-inline">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" value="1" checked="checked" />
            <?php } else { ?>
            <input type="checkbox" name="sub_category" value="1" />
            <?php } ?>
            <?php echo $text_sub_category; ?></label>
        </div>
      </div>
      <p>
        <label class="checkbox-inline">
          <?php if ($description) { ?>
          <input type="checkbox" name="description" value="1" id="description" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="description" value="1" id="description" />
          <?php } ?>
          <?php echo $entry_description; ?></label>
      </p>
      <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary" />
      <h2><?php echo $text_search; ?></h2>
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
          
          
        
         <div class="col-xs-8 col-sm-12 col-md-8 col-lg-4">
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
         </div>
             
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
       <div class="row" id="pag5">
         <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
         
       </div>
      
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--
$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';

	var search = $('#content input[name=\'search\']').prop('value');

	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');

	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}

	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

	if (sub_category) {
		url += '&sub_category=true';
	}

	var filter_description = $('#content input[name=\'description\']:checked').prop('value');

	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
--></script>
<?php echo $footer; ?>