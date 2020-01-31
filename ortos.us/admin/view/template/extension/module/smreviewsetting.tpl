<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-smreview" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_with_picture; ?></h1>
      <h3><?php echo $text_version; ?></h3>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-account" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-gravatar"><?php echo $entry_gravatar; ?></label>
            <div class="col-sm-10">
              <select name="smreview_gravatar" id="input-gravatar" class="form-control">
                <?php if ($smreview_gravatar) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_display_form; ?></label>
            <div class="col-sm-10">
              <select name="smreview_display_form" class="form-control">
                <?php if ($smreview_display_form) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <?php //Соціальні мережі в розробці ?>
          <div class="form-group hidden">
            <label class="col-sm-2 control-label"><?php echo $entry_social_networks; ?></label>
            <div class="col-sm-10">
              <select name="smreview_social_networks" class="form-control">
                <?php if ($smreview_social_networks) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_comment; ?></label>
            <div class="col-sm-10">
              <select name="smreview_comment" class="form-control">
                <?php if ($smreview_comment) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_picture; ?></label>
            <div class="col-sm-10">
              <select name="smreview_picture" class="form-control" onchange="pictureSelectCheck(this);">
                <?php if ($smreview_picture) { ?>
                <option value="1" selected="selected" id="picture_select"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1" id="picture_select"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
            <div class="form-group" id="smreview_picture_max_size_div" style="background-color: #e5e5e5;">
                <label class="col-sm-2 control-label"><?php echo $entry_picture_max_size; ?></label>
                <div class="col-sm-10">
                    <input name="smreview_picture_max_size" type="number" class="form-control" placeholder="10" value="<?php echo $smreview_picture_max_size?$smreview_picture_max_size:''; ?>" min="0">
                  <p style="color: #ff0707;"><?php echo $text_php_ini_max_size; ?><b><?php echo $php_ini_max_size; ?></b></p>
                </div>
            </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_video; ?></label>
            <div class="col-sm-10">
              <select name="smreview_video" class="form-control" onchange="videoSelectCheck(this);">
                <?php if ($smreview_video) { ?>
                <option value="1" selected="selected" id="video_select"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1" id="video_select"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="smreview_video_max_size_div" style="background-color: #e5e5e5;">
              <label class="col-sm-2 control-label"><?php echo $entry_video_max_size; ?></label>
              <div class="col-sm-10">
                  <input name="smreview_video_max_size" type="number" class="form-control" placeholder="60" value="<?php echo $smreview_video_max_size?$smreview_video_max_size:''; ?>" min="0">
                <p style="color: #ff0707;"><?php echo $text_php_ini_max_size; ?><b><?php echo $php_ini_max_size; ?></b></p>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_rating; ?></label>
            <div class="col-sm-10">
              <select name="smreview_rating" class="form-control">
                <?php if ($smreview_rating) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_like; ?></label>
            <div class="col-sm-10">
              <select name="smreview_like" class="form-control">
                <?php if ($smreview_like) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_add_date; ?></label>
            <div class="col-sm-10">
              <select name="smreview_add_date" class="form-control">
                <?php if ($smreview_add_date) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_add_review_customer; ?></label>
            <div class="col-sm-10">
              <select name="smreview_add_review_customer" class="form-control" onchange="customerSelectCheck(this);">
                <?php if ($smreview_add_review_customer) { ?>
                <option value="1" selected="selected" id="customer_buy"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1" id="customer_buy"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="review_customer_buy" <?php if ($smreview_add_review_customer) { ?>style="background-color: #e5e5e5;"<?php } else { ?>style="background-color: #e5e5e5; display: none;"<?php } ?>>
            <label class="col-sm-2 control-label"><?php echo $entry_add_review_customer_buy; ?></label>
            <div class="col-sm-10">
              <select name="smreview_add_review_customer_buy" class="form-control">
                <?php if ($smreview_add_review_customer_buy) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_required; ?></label>
                <div class="col-sm-10">
                    <span>
                        <input name="smreview_requir_email" type="checkbox" <?php echo $smreview_requir_email?$checked="checked":''; ?> >
                        <label><?php echo $entry_requir_email; ?></label>
                    </span>
                    <br />
                    <span>
                        <input name="smreview_requir_name" type="checkbox" <?php echo $smreview_requir_name?$checked="checked":''; ?> >
                        <label><?php echo $entry_requir_name; ?></label>
                    </span>

                </div>
            </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="smreview_status" id="input-status" class="form-control">
                <?php if ($smreview_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    function customerSelectCheck(nameSelect)
    {
        if(nameSelect){
            customerOptionValue = document.getElementById("customer_buy").value;
            if(customerOptionValue == nameSelect.value){
                document.getElementById("review_customer_buy").style.display = "block";
            }
            else{
                document.getElementById("review_customer_buy").style.display = "none";
            }
        }
        else{
            document.getElementById("review_customer_buy").style.display = "none";
        }
    }
    function pictureSelectCheck(nameSelect)
    {
        if(nameSelect){
            customerOptionValue = document.getElementById("picture_select").value;
            if(customerOptionValue == nameSelect.value){
                document.getElementById("smreview_picture_max_size_div").style.display = "block";
            }
            else{
                document.getElementById("smreview_picture_max_size_div").style.display = "none";
            }
        }
        else{
            document.getElementById("smreview_picture_max_size_div").style.display = "none";
        }
    }
    function videoSelectCheck(nameSelect)
    {
        if(nameSelect){
            customerOptionValue = document.getElementById("video_select").value;
            if(customerOptionValue == nameSelect.value){
                document.getElementById("smreview_video_max_size_div").style.display = "block";
            }
            else{
                document.getElementById("smreview_video_max_size_div").style.display = "none";
            }
        }
        else{
            document.getElementById("smreview_video_max_size_div").style.display = "none";
        }
    }
</script>
<?php echo $footer; ?>