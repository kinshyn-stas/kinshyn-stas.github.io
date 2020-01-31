<div class="modal fade" id="product_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="product_popup_label"><?php echo $heading_title; ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <img src="<?php echo $product_image; ?>" class="img-responsive">
          </div>
          <div class="col-sm-8">
            <h3><?php echo $product_name; ?></h3>
            <?php if ($product_options) { ?>
            <ul class="list-unstyled">
              <?php foreach ($product_options as $option) { ?>
              <li><?php echo $option; ?></li>  
              <?php } ?>
            </ul>
            <?php } ?>
          </div>
        </div>
        <?php if (isset($text_login)) { ?>
        <div class="alert alert-warning"><?php echo $text_login; ?></div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button_continue; ?></button>
        <a href="<?php echo $action; ?>" class="btn btn-success"><?php echo $button_action; ?></a>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $('#product_popup').on('hidden.bs.modal', function (e) {
    $('#product_popup').detach();
  });
  </script>
</div>