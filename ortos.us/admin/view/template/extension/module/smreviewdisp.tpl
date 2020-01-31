<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_with_picture; ?></h1>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-smreviewdisp" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
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
            <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
            <div class="col-sm-10">
              <input name="name" type="text" id="input-title" class="form-control" placeholder="<?php echo $entry_title; ?>" value="<?php echo $name?$name:''; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-display"><?php echo $entry_display; ?></label>
            <div class="col-sm-10">
              <select name="smreviewdisp_display" id="input-display" class="form-control">
                <?php if ($smreviewdisp_display == 'first') { ?>
                <option value="random"><?php echo $text_random; ?></option>
                <option value="last"><?php echo $text_last; ?></option>
                <option value="first" selected="selected"><?php echo $text_first; ?></option>
                <?php } elseif ($smreviewdisp_display == 'last') { ?>
                <option value="random"><?php echo $text_random; ?></option>
                <option value="last" selected="selected"><?php echo $text_last; ?></option>
                <option value="first"><?php echo $text_first; ?></option>
                <?php } else { ?>
                <option value="random" selected="selected"><?php echo $text_random; ?></option>
                <option value="last"><?php echo $text_last; ?></option>
                <option value="first"><?php echo $text_first; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-quantity"><?php echo $text_quantity; ?></label>
            <div class="col-sm-10">
              <input name="smreviewdisp_quantity" type="number" id="input-quantity" class="form-control" placeholder="5" value="<?php echo $smreviewdisp_quantity?$smreviewdisp_quantity:''; ?>" min="0">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-date"><?php echo $text_date; ?></label>
            <div class="col-sm-10">
              <select name="smreviewdisp_date" id="input-date" class="form-control">
                <?php if ($smreviewdisp_date) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-min"><?php echo $text_min; ?></label>
            <div class="col-sm-10">
              <input name="smreviewdisp_min" type="number" id="input-min" class="form-control" placeholder="5" value="<?php echo $smreviewdisp_min?$smreviewdisp_min:''; ?>" max="5" min="0">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-max"><?php echo $text_max; ?></label>
            <div class="col-sm-10">
              <input name="smreviewdisp_max" type="number" id="input-max" class="form-control" placeholder="5" value="<?php echo $smreviewdisp_max?$smreviewdisp_max:''; ?>" max="5" min="0">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-view"><?php echo $text_view; ?></label>
            <div class="col-sm-10">
              <select name="smreviewdisp_view" id="input-view" class="form-control">
                <?php if ($smreviewdisp_view == 'carousel') { ?>
                <option value="list"><?php echo $text_list; ?></option>
                <option value="table"><?php echo $text_table; ?></option>
                <option value="carousel" selected="selected"><?php echo $text_carousel; ?></option>
                <?php } elseif ($smreviewdisp_view == 'table') { ?>
                <option value="list"><?php echo $text_list; ?></option>
                <option value="table" selected="selected"><?php echo $text_table; ?></option>
                <option value="carousel"><?php echo $text_carousel; ?></option>
                <?php } else { ?>
                <option value="list" selected="selected"><?php echo $text_list; ?></option>
                <option value="table"><?php echo $text_table; ?></option>
                <option value="carousel"><?php echo $text_carousel; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>