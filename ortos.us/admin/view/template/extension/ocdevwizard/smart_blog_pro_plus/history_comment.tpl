<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<?php if ($histories) { ?>
  <div class="btn-group">
    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-trash-o"></i> <?php echo $button_delete_menu; ?> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a onclick="delete_all('comment');"><?php echo $button_delete_all; ?></a></li>
      <li><a onclick="delete_all_selected('comment');"><?php echo $button_delete_selected; ?></a></li>
    </ul>
  </div>
<?php } ?>
<button type="button" onclick="$('a[href=#comment-constructor-block]').click();" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $button_update; ?></button>
<button type="button" onclick="open_comment();" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_add_comment; ?></button>
<div class="special-margin"></div>
<div class="table-responsive">
  <table class="table table-bordered main-table-data">
    <thead>
      <tr>
        <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('#history-comment input[name*=\'selected\']').attr('checked', this.checked);" /></td>
        <td class="text-left" width="15%"><?php echo $column_comment_firstname; ?></td>
        <td class="text-left" width="15%"><?php echo $column_comment_email; ?></td>
        <td class="text-left" width="15%"><?php echo $column_post_heading; ?></td>
        <td class="text-left"><?php echo $column_date_added; ?></td>
        <td class="text-left"><?php echo $column_date_modified; ?></td>
        <td class="text-left"><?php echo $column_status; ?></td>
        <td class="text-center"><?php echo $column_action; ?></td>
      </tr>
      <tr>
        <td class="text-center fixed-thead"></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_firstname" value="" class="form-control"/></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_email" value="" class="form-control"/></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_post" value="" class="form-control"/></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_date_added" value="" class="form-control datetime"/></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_date_modified" value="" class="form-control datetime"/></td>
        <td class="text-center fixed-thead input-group-sm">
          <select name="filter_status" class="form-control">
            <option value="*"></option>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
          </select>
        </td>
        <td class="text-center fixed-thead">
          <button class="btn btn-default btn-sm" type="button" id="submit-filter-comment-form"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
          <button class="btn btn-default btn-sm" type="button" id="clear-filter-comment-form"><i class="fa fa-eraser"></i> <?php echo $button_clear_filter; ?></button>
        </td>
      </tr>
    </thead>
    <tbody>
    <?php if ($histories) { ?>
      <?php foreach ($histories as $history) { ?>
      <tr>
        <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $history['comment_id']; ?>" /></td>
        <td class="text-left"><?php echo $history['firstname']; ?></td>
        <td class="text-left"><?php echo $history['email']; ?></td>
        <td class="text-left"><a onclick="open_post({id: '<?php echo $history['post_id']; ?>'});" style="cursor: pointer;"><?php echo $history['post']; ?></a></td>
        <td class="text-left"><?php echo $history['date_added']; ?></td>
        <td class="text-left"><?php echo $history['date_modified']; ?></td>
        <td class="text-left"><?php echo $history['status']; ?></td>
        <td class="text-center">
          <button type="button" class="btn btn-primary" onclick="open_comment({id: '<?php echo $history['comment_id']; ?>'});" data-toggle="tooltip" title="" data-original-title="<?php echo $button_edit; ?>"><i class="fa fa-pencil"></i></button>
          <?php if ($history['respond_id']) { ?>
          <button type="button" class="btn btn-primary button-disabled" data-toggle="tooltip" title="" data-original-title="<?php echo $button_respond_error; ?>"><i class="fa fa-reply"></i></button>
          <?php } else { ?>
          <button type="button" class="btn btn-primary" onclick="respond_comment('<?php echo $history['comment_id']; ?>');" data-toggle="tooltip" title="" data-original-title="<?php echo $button_respond; ?>"><i class="fa fa-reply"></i></button>
          <?php } ?>
          <a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? delete_selected('comment', '<?php echo $history['comment_id']; ?>') : false;" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="<?php echo $button_delete; ?>"><i class="fa fa-trash-o"></i></a>
          <button type="button" class="btn btn-default" onclick="confirm('<?php echo $text_are_you_sure; ?>') ? copy_selected('comment', '<?php echo $history['comment_id']; ?>') : false;" data-toggle="tooltip" title="" data-original-title="<?php echo $button_copy; ?>"><i class="fa fa-copy"></i></button>
        </td>
      </tr>
      <?php } ?>
      <?php } else { ?>
        <tr>
          <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="8">
          <div class="row">
            <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
            <div class="col-sm-6 text-right fixed-pagination-results"><?php echo $results; ?></div>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
<script type="text/javascript">
  $('#history-comment input[name=\'filter_firstname\']').autocomplete({
    'source': function (request, response) {
      $.ajax({
        url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_comment&<?php echo $token; ?>&filter_firstname=' + encodeURIComponent(request),
        dataType: 'json',
        success: function (json) {
          response($.map(json, function (item) {
            if (item['comment_id']) {
              return {
                value: item['comment_id'],
                label: item['firstname']
              }
            }
          }));
        }
      });
    },
    'select': function (item) {
      $('#history-comment input[name=\'filter_firstname\']').val(item['label']);
    }
  });
  
  $('#history-comment input[name=\'filter_email\']').autocomplete({
    'source': function (request, response) {
      $.ajax({
        url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_comment&<?php echo $token; ?>&filter_email=' + encodeURIComponent(request),
        dataType: 'json',
        success: function (json) {
          response($.map(json, function (item) {
            if (item['comment_id']) {
              return {
                value: item['comment_id'],
                label: item['email']
              }
            }
          }));
        }
      });
    },
    'select': function (item) {
      $('#history-comment input[name=\'filter_email\']').val(item['label']);
    }
  });
  
  $('#history-comment input[name=\'filter_post\']').autocomplete({
    'source': function (request, response) {
      $.ajax({
        url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_comment&<?php echo $token; ?>&filter_post=' + encodeURIComponent(request),
        dataType: 'json',
        success: function (json) {
          response($.map(json, function (item) {
            if (item['post_id']) {
              return {
                value: item['post_id'],
                label: item['name']
              }
            }
          }));
        }
      });
    },
    'select': function (item) {
      $('#history-comment input[name=\'filter_post\']').val(item['label']);
    }
  });

  $(document).on("focus", '#history-comment .datetime', function() {
    $(document).not('.bootstrap-datetimepicker-widget:first').remove();
    
    $('.datetime').datetimepicker({
      format:     'YYYY-MM-DD',
      formatDate: 'YYYY-MM-DD',
    });
  });
</script>