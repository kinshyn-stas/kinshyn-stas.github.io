 
 <div class="clearfix"></div>
<div class="fon_search_blog">
      <div id="<?php echo $_code; ?>-search" class="input-group">
        <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search; ?>" class="form-control"/>
        <span class="input-group-btn">
          <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </div>        
  <script>
    $('#<?php echo $_code; ?>-search-block-<?php echo $module_id; ?> input[name=\'search\']').parent().find('button').on('click', function () {
      url = $('base').attr('href') + 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/search';

      var value = $('#<?php echo $_code; ?>-search-block-<?php echo $module_id; ?> input[name=\'search\']').val();

      if (value) {
        url += '&<?php echo $_code; ?>_search=' + encodeURIComponent(value);
      }

      location = url;
    });

    $('#<?php echo $_code; ?>-search-block-<?php echo $module_id; ?> input[name=\'search\']').on('keydown', function (e) {
      if (e.keyCode == 13) {
        $('#<?php echo $_code; ?>-search-block-<?php echo $module_id; ?> input[name=\'search\']').parent().find('button').trigger('click');
      }
    });
  </script>
 