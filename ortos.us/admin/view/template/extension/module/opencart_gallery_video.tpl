<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-opencart-gallery-video" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-opencart-gallery-video" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-video"><span data-toggle="tooltip" title="<?php echo $help_video; ?>"><?php echo $entry_video; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="video" value="" placeholder="<?php echo $entry_video; ?>" id="input-video" class="form-control" />
              <div id="featured-video" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($videos as $video) { ?>
                <div id="featured-video<?php echo $video['video']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $video['name']; ?>
                  <input type="hidden" value="<?php echo $video['video_id']; ?>" />
                </div>
                <?php } ?>
              </div>
              <input type="hidden" name="opencart_gallery_video_featured" value="<?php echo $featured_video; ?>" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="opencart_gallery_video_status" id="input-status" class="form-control">
                <?php if ($opencart_gallery_video_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>          
          <table id="module" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_limit; ?></td>
                <td class="text-left"><?php echo $entry_apr; ?></td>
                <td class="text-left"><?php echo $entry_vs; ?></td>
                <td class="left"><?php echo $entry_sort_by; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr id="module-row">
                <td class="text-left"><input type="text" name="opencart_gallery_video_module[limit]" value="<?php echo $opencart_gallery_video_module['limit']; ?>" placeholder="<?php echo $entry_limit; ?>" class="form-control" /></td>
                <td class="text-left">
                  <select name="opencart_gallery_video_module[apr]" class="form-control">
                    <option value="1" <?php if ($opencart_gallery_video_module['apr'] == 1) { ?>selected="selected"<?php } ?>>1</option>
                    <option value="2" <?php if ($opencart_gallery_video_module['apr'] == 2) { ?>selected="selected"<?php } ?>>2</option>
                    <option value="3" <?php if ($opencart_gallery_video_module['apr'] == 3) { ?>selected="selected"<?php } ?>>3</option>
                    <option value="4" <?php if ($opencart_gallery_video_module['apr'] == 4) { ?>selected="selected"<?php } ?>>4</option>
                    <option value="6" <?php if ($opencart_gallery_video_module['apr'] == 6) { ?>selected="selected"<?php } ?>>6</option>
                  </select>
                </td>
                <td>
                  <select name="opencart_gallery_video_module[vs]" class="form-control">
                    <option value="1" <?php if ($opencart_gallery_video_module['vs'] == 1) { ?>selected="selected"<?php } ?>>Маленькие</option>
                    <option value="2" <?php if ($opencart_gallery_video_module['vs'] == 2) { ?>selected="selected"<?php } ?>>Средние</option>
                    <option value="3" <?php if ($opencart_gallery_video_module['vs'] == 3) { ?>selected="selected"<?php } ?>>Большие</option>
                  </select>
                </td>
                <td class="left"><select name="opencart_gallery_video_module[sb]" class="form-control">
                  <option value="1" <?php if ($opencart_gallery_video_module['sb'] == 1) { ?>selected="selected"<?php } ?>>Последние</option>
                  <option value="2" <?php if ($opencart_gallery_video_module['sb'] == 2) { ?>selected="selected"<?php } ?>>По кол-ву просмотров</option>
                  <!--<option value="3" <?php if ($opencart_gallery_video_module['sb'] == 3) { ?>selected="selected"<?php } ?>>Рейтингу</option>-->
                  <option value="4" <?php if ($opencart_gallery_video_module['sb'] == 4) { ?>selected="selected"<?php } ?>>По порядку</option>
                  <option value="5" <?php if ($opencart_gallery_video_module['sb'] == 5) { ?>selected="selected"<?php } ?>>По названию</option>
                  <option value="6" <?php if ($opencart_gallery_video_module['sb'] == 6) { ?>selected="selected"<?php } ?>>Рекомендуемые</option>
                </select></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'video\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=opencart_gallery/video/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['video_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('#featured-video' + item['value']).remove();
    
    $('#featured-video').append('<div id="featured-video' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" value="' + item['value'] + '" /></div>'); 
  
    data = $.map($('#featured-video input'), function(element) {
      return $(element).attr('value');
    });
            
    $('input[name=\'opencart_gallery_video_featured\']').attr('value', data.join()); 
  } 
});

$('#featured-video').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();

  data = $.map($('#featured-video input'), function(element) {
    return $(element).attr('value');
  });
          
  $('input[name=\'opencart_gallery_video_featured\']').attr('value', data.join()); 
});
//--></script> 
</div>
<?php echo $footer; ?>