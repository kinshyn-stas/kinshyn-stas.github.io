<div class="modal fade" id="bulk-image-upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $bulk_modal_heading; ?></h4>
      </div>
      <div class="modal-body">

        <form enctype="multipart/form-data" id="bulk-image-upload-form" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="80000" />
            
            <div class="container-fluid">
                <select name="upload_type" class="form-control">
                  <option value="" selected>Choose the type of image upload</option>
                  <option value="add_as_mains">Add new main images for products</option>
                  <option value="add_to_each">Add new images to each selected product</option>
                </select>

                <div class="form-content" style="margin-top: 10px;">

                    <div class="add_as_mains" style="display: none;">
                        <div class="well well-sm" style="margin-top: 20px; margin-bottom: 20px; font-size: 13px;">
                            This option allows you to bulk upload new main images for all of your products. Follow the instructions below to find out how.<br/><br/>
                            <strong>*</strong> <?php echo $bulk_image_help_all; ?>
                        </div>
                        <h4><?php echo $bulk_modal_text; ?></h4>
                        <div class="additional-info">
                            <br /><?php echo $bulk_image_structured; ?><br />
                            <ul>
                              <li><strong>images.zip</strong></li>
                                <ul>
                                    <li>456.png</li>
                                    <li>52.jpg</li>
                                    <li>123.jpg</li>
                                    <li>7653.png</li>
                                    <li>...</li>
                                </ul>
                            </ul>
                            <div class="well well-sm">
                                <strong>*</strong> <span style="font-size: 13px;"><?php echo $bulk_image_structured2; ?></span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-9" style="padding-top: 7px;">
                                <input name="userfile" type="file" />
                            </div>
                            <div class="col-xs-3">
                                <input type="submit" class="btn btn-primary" value="<?php echo $upload_file; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="add_to_each" style="display: none;">
                        <div class="well well-sm" style="margin-top: 20px; margin-bottom: 20px; font-size: 13px;">
                            This option allows you to bulk upload new additional images for all of the checked products. Simply upload a zip containing images and they will be added to all checked products.
                        </div>

                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-9" style="padding-top: 7px;">
                                <input name="userfile" type="file" />
                            </div>
                            <div class="col-xs-3">
                                <input type="submit" class="btn btn-primary" value="<?php echo $upload_file; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="modalResult" style="display:none;"></div>
        <div id="modalErrors" style="display:none;"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $modal_close; ?></button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      $('select[name=\'upload_type\']').on('change', function(event) {
          var target = $(event.target);

          if (target.val().length == 0) {
              $('div.form-content > div').fadeOut();
          } else {
              $('div.form-content > div').each(function() {
                $(this).hide();
              });

              if (target.val().length > 0) {
                $('div.' + target.val()).fadeIn();
              }
          }
      });
  });
</script>