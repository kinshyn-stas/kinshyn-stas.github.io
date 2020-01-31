<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-opencart-gallery-album" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-opencart-gallery-album" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-album"><span data-toggle="tooltip" title="<?php echo $help_album; ?>"><?php echo $entry_album; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="album" value="" placeholder="<?php echo $entry_album; ?>" id="input-album" class="form-control" />
              <div id="featured-album" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($albums as $album) { ?>
                <div id="featured-album<?php echo $album['album']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $album['name']; ?>
                  <input type="hidden" value="<?php echo $album['album_id']; ?>" />
                </div>
                <?php } ?>
              </div>
              <input type="hidden" name="opencart_gallery_album_featured" value="<?php echo $featured_album; ?>" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="opencart_gallery_album_status" id="input-status" class="form-control">
                <?php if ($opencart_gallery_album_status) { ?>
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
                <td class="text-left"><?php echo $entry_as; ?></td>
                <td class="left"><?php echo $entry_sort_by; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr id="module-row">
                <td class="text-left"><input type="text" name="opencart_gallery_album_module[limit]" value="<?php echo $opencart_gallery_album_module['limit']; ?>" placeholder="<?php echo $entry_limit; ?>" class="form-control" /></td>
                <td class="text-left">
                  <select name="opencart_gallery_album_module[apr]" class="form-control">
                    <option value="1" <?php if ($opencart_gallery_album_module['apr'] == 1) { ?>selected="selected"<?php } ?>>1</option>
                    <option value="2" <?php if ($opencart_gallery_album_module['apr'] == 2) { ?>selected="selected"<?php } ?>>2</option>
                    <option value="3" <?php if ($opencart_gallery_album_module['apr'] == 3) { ?>selected="selected"<?php } ?>>3</option>
                    <option value="4" <?php if ($opencart_gallery_album_module['apr'] == 4) { ?>selected="selected"<?php } ?>>4</option>
                    <option value="6" <?php if ($opencart_gallery_album_module['apr'] == 6) { ?>selected="selected"<?php } ?>>6</option>
                  </select>
                </td>
                <td>
                  <select name="opencart_gallery_album_module[as]" class="form-control">
                    <option value="1" <?php if ($opencart_gallery_album_module['as'] == 1) { ?>selected="selected"<?php } ?>>Маленькие</option>
                    <option value="2" <?php if ($opencart_gallery_album_module['as'] == 2) { ?>selected="selected"<?php } ?>>Средние</option>
                    <option value="3" <?php if ($opencart_gallery_album_module['as'] == 3) { ?>selected="selected"<?php } ?>>Большие</option>
                  </select>
                </td>
                <td class="left"><select name="opencart_gallery_album_module[sb]" class="form-control">
                  <option value="1" <?php if ($opencart_gallery_album_module['sb'] == 1) { ?>selected="selected"<?php } ?>>Последние</option>
                  <option value="2" <?php if ($opencart_gallery_album_module['sb'] == 2) { ?>selected="selected"<?php } ?>>По кол-ву просмотров</option>
                  <!--<option value="3" <?php if ($opencart_gallery_album_module['sb'] == 3) { ?>selected="selected"<?php } ?>>Рейтингу</option>-->
                  <option value="4" <?php if ($opencart_gallery_album_module['sb'] == 4) { ?>selected="selected"<?php } ?>>По порядку</option>
                  <option value="5" <?php if ($opencart_gallery_album_module['sb'] == 5) { ?>selected="selected"<?php } ?>>По названию</option>
                  <option value="6" <?php if ($opencart_gallery_album_module['sb'] == 6) { ?>selected="selected"<?php } ?>>Рекомендуемые</option>
                </select></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'album\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=opencart_gallery/album/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['album_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('#featured-album' + item['value']).remove();
    
    $('#featured-album').append('<div id="featured-album' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" value="' + item['value'] + '" /></div>'); 
  
    data = $.map($('#featured-album input'), function(element) {
      return $(element).attr('value');
    });
            
    $('input[name=\'opencart_gallery_album_featured\']').attr('value', data.join()); 
  } 
});

$('#featured-album').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();

  data = $.map($('#featured-album input'), function(element) {
    return $(element).attr('value');
  });
          
  $('input[name=\'opencart_gallery_album_featured\']').attr('value', data.join()); 
});
//--></script> 
</div>
<?php echo $footer; ?>