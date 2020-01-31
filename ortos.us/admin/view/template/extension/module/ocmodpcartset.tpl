<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">		
      <div class="pull-right" id="control-buttons">
		<a onclick="apply()" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $text_apply; ?>"><i class="fa fa-check"></i></a>
        <button type="submit" form="form-ocmod" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_cancel; ?>" class="btn btn-warning"><i class="fa fa-reply"></i></a>
		</div>
      <h1><?php echo $heading_title; ?></h1>
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
	<?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default alert-helper">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ocmod" class="form-horizontal">
		<ul class="nav nav-tabs" role="tablist" id="revtabs">
			<li class="active"><a href="#tab_settings" role="tab" data-toggle="tab"><?php echo $text_settings; ?></a></li>
			<li><a href="#tab_info" role="tab" data-toggle="tab"><?php echo $text_information; ?></a></li>
		</ul>	
		<div class="tab-content">
		<div class="tab-pane active" id="tab_settings">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
				<div class="col-sm-10">
					<select name="pcart_pcart" id="input-status" class="form-control">
						<?php if ($pcart_pcart) { ?>
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
							<option value="1"><?php echo $text_enabled; ?></option>
							<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab_info">
		<?php echo $text_ocmod_info; ?>
		</div>
		</div>
        </form>
      </div>
    </div>
	<div class="panel-footer"><?php echo $heading_title . ' v.' . $ocmod_version; ?></div>
  </div>
</div>
<script type="text/javascript"><!--
function apply(){
	$(".alert").remove();
	$.post($("#form-ocmod").attr('action'), $("#form-ocmod").serialize(), function(html) {
		var $success = $(html).find(".alert-success, .alert-danger");
		if ($success.length > 0) {
			$(".alert-helper").before($success);
		}
	});
}
//--></script>
<?php echo $footer; ?>