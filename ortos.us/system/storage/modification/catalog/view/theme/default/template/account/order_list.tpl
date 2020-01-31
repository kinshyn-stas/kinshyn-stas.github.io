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
      <div class="zag_cat"> 
          <h1><?php echo $heading_title; ?></h1>
        </div>
      <?php if ($orders) { ?>
      
          <div class="container-fluid">            
              <div class="row">            
                <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">
                    <div class="im_hart"><?php echo $column_order_id; ?></div>
                </div>
                <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                    <div class="name_hart1"><?php echo $column_customer; ?></div>
                </div>
                <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
                    <div class="model_hart text-center"><?php echo $column_product; ?></div>
                </div>
                <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
                    <div class="stock_hart text-center"><?php echo $column_status; ?></div>
                </div>
                <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">
                    <div class="pr_hart text-center"><?php echo $column_total; ?></div>
                </div>
                <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
                    <div class="del_hart text-center"><?php echo $column_date_added; ?></div>
                </div>
                <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">

                </div>
              </div>
             
              
            <?php foreach ($orders as $order) { ?>
              <div class="row fon_wish">
                  <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 ">
                      <div class="im_tov_hart2"><?php echo $order['order_id']; ?></div>
                  </div>
                  <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
                      <div class="name_tov_hart2"><?php echo $order['name']; ?></div>
                  </div>
                  <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2">
                      <div class="model_tov_hart2"><?php echo $order['products']; ?></div>
                  </div>
                  <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                      <div class="stock_tov_hart2"><?php echo $order['status']; ?></div>
                  </div>  
                  <div class="col-xs-4 col-sm-1 col-md-1 col-lg-1">
                      <div class="pr_tov_hart2"><?php echo $order['total']; ?></div>
                  </div>  
                  <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                      <div class="del_hart2"><?php echo $order['date_added']; ?></div>
                  </div> 
                  <div class="col-xs-3 col-sm-1 col-md-1 col-lg-1">
                    <?php if (!empty($order['ocstore_payeer_onpay'])) { ?><a rel="nofollow" onclick="location='<?php echo $order['ocstore_payeer_onpay']; ?>'" data-toggle="tooltip" title="<?php echo $button_ocstore_payeer_onpay; ?>" class="btn btn-info"><i class="fa fa-usd"></i></a>&nbsp;&nbsp;<?php } ?><?php if (!empty($order['ocstore_yk_onpay'])) { ?><a rel="nofollow" onclick="location='<?php echo $order['ocstore_yk_onpay']; ?>'" data-toggle="tooltip" title="<?php echo $button_ocstore_yk_onpay; ?>" class="btn btn-info" ><i class="fa fa-usd"></i></a>&nbsp;&nbsp;<?php } ?><a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="view5"><i class="fa fa-eye"></i></a> 
                  </div>
                </div>
            <?php } ?>
          
      </div>
      <br><br>
      <div class="row">
        <div class="col-sm-12 text-right"><?php echo $pagination; ?></div>
        <div class="col-sm-12 text-right"><?php echo $results; ?></div>
      </div>
      
      <?php } ?>
       
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
