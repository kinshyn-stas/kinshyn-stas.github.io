<?php echo $header; ?>
<div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
    </div>
</div>

<?php if (!empty($orders)) { ?>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
	  <thead>
	    <tr>
	      <td class="text-right" style="width: 8%"><?php echo $text_order_id; ?></td>
	      <td class="text-left"><?php echo $text_customer; ?></td>
	      <td class="text-left"><?php echo $column_status; ?></td>
	      <td class="text-right"><?php echo $column_total; ?></td>
	      <td class="text-left"><?php echo $column_date_added; ?></td>
	      <td class="text-right"><?php echo $column_action; ?></td>
	    </tr>
	  </thead>

	  <tbody>
	    <?php foreach ($orders as $order) { ?>	
	    <tr>
	      <td class="text-right" style="text-align: center"><?php echo $order['order_id']; ?></td>
	      <td class="text-left"><?php echo $order['firstname'] . ' ' . $order['lastname']; ?></td>
	      <td class="text-left"><?php echo $order['order_status']; ?></td>
	      <td class="text-right"><?php echo $order['total']; ?></td>
	      <td class="text-left"><?php echo $order['date_added']; ?></td>
	      <td class="text-right">
	      	<a href="<?php echo HTTP_SERVER . 'index.php?route=sale/order/info&amp;token=' . $token . '&amp;order_id=' . $order['order_id']; ?>" target="_blank" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<?php } else { ?>
<h1 style="text-align: center"> There are no orders associated with this product </h1>
<?php } ?> 

<script type="text/javascript ">
	$(window).load(function() {
		$('#header').hide();
	})
</script>