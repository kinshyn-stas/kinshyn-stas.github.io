<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
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
      <h2><?php echo $text_my_account; ?></h2>
      <ul class="list-unstyled">
             		
<div class="col-md-3 text-center"><div class="product-thumb"><a href="<?php echo $edit; ?>"><img src="catalog/view/theme/default/image/account-images/edit.svg" alt="<?php echo $text_edit; ?>" >
<p style="margin-top: 20px;"><?php echo $text_edit; ?></p></a></div></div>
<style> .product-thumb { padding-top: 10px; }</style> 
      
             		
<div class="col-md-3 text-center"><div class="product-thumb"><a href="<?php echo $password; ?>"><img src="catalog/view/theme/default/image/account-images/password.svg" alt="<?php echo $text_password; ?>" >
<p><?php echo $text_password; ?></p></a></div></div>
      
             		
<div class="col-md-3 text-center"><div class="product-thumb"><a href="<?php echo $payment; ?>"><img src="catalog/view/theme/default/image/account-images/payment.svg" alt="<?php echo $text_payment; ?>" >
<p><?php echo $text_payment; ?></p></a></div></div>
      
      </ul>
      <h2><?php echo $text_my_tracking; ?></h2>
      <ul class="list-unstyled">
             		
<div class="col-md-3 text-center"><div class="product-thumb"><a href="<?php echo $tracking; ?>"><img src="catalog/view/theme/default/image/account-images/tracking.svg" alt="<?php echo $text_tracking; ?>" >
<p><?php echo $text_tracking; ?></p></a></div></div>
      
      </ul>
      <h2><?php echo $text_my_transactions; ?></h2>
      <ul class="list-unstyled">
             		
<div class="col-md-3 text-center"><div class="product-thumb"><a href="<?php echo $transaction; ?>"><img src="catalog/view/theme/default/image/account-images/trans.svg" alt="<?php echo $text_transaction; ?>" >
<p><?php echo $text_transaction; ?></p></a></div></div>
      
      </ul>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>