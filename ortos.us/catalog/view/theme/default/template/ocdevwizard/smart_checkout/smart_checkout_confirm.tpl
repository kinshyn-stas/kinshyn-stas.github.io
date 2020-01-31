<!-- CONFIRM -->
<div class="table-totals">
	<table>
	  <tbody>
	    <?php foreach ($totals as $total) { ?>
	      <tr>
	        <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
	        <td class="text-right"><?php echo $total['text']; ?></td>
	      </tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
<?php echo $payment; ?>
<?php if (!$transfer_payments_status) { ?>
<script type="text/javascript">
	$('.buttons #button-confirm').click(function(event) {
  		event.preventDefault();
  		if (navigator.appName == "Microsoft Internet Explorer") {	
			window.document.execCommand('Stop');
		} else {
			window.stop();
		}
		smch_output();
	});
</script>
<?php } ?>