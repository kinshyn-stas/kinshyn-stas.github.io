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
      <li><a onclick="delete_all('email-template');"><?php echo $button_delete_all; ?></a></li>
      <li><a onclick="delete_all_selected('email-template');"><?php echo $button_delete_selected; ?></a></li>
    </ul>
  </div>
<?php } ?>
<button type="button" onclick="$('a[href=#email-template-constructor-block]').click();" class="btn btn-primary"><i class="fa fa-refresh"></i> <?php echo $button_update; ?></button>
<button type="button" onclick="open_email_template();" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_add_email_template; ?></button>
<div class="special-margin"></div>
<div class="table-responsive">
  <table class="table table-bordered main-table-data">
    <thead>
      <tr>
        <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('#history-email-template input[name*=\'selected\']').attr('checked', this.checked);" /></td>
        <td class="text-left" width="15%"><?php echo $column_email_template_name; ?></td>
        <td class="text-left"><?php echo $column_email_template_date_added; ?></td>
        <td class="text-left"><?php echo $column_email_template_date_modified; ?></td>
        <td class="text-left"><?php echo $column_email_template_status; ?></td>
        <td class="text-center"><?php echo $column_email_template_action; ?></td>
      </tr>
      <tr>
        <td class="text-center fixed-thead"></td>
        <td class="text-center fixed-thead input-group-sm"><input type="text" name="filter_heading" value="" class="form-control"/></td>
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
          <button class="btn btn-default btn-sm" type="button" id="submit-filter-email-template-form"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
          <button class="btn btn-default btn-sm" type="button" id="clear-filter-email-template-form"><i class="fa fa-eraser"></i> <?php echo $button_clear_filter; ?></button>
        </td>
      </tr>
    </thead>
    <tbody>
      <?php if ($histories) { ?>
      <?php foreach ($histories as $history) { ?>
      <tr>
        <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $history['template_id']; ?>" /></td>
        <td class="text-left"><?php echo $history['name']; ?></td>
        <td class="text-left"><?php echo $history['date_added']; ?></td>
        <td class="text-left"><?php echo $history['date_modified']; ?></td>
        <td class="text-left"><?php echo $history['status']; ?></td>
        <td class="text-center">
          <button type="button" class="btn btn-primary" onclick="open_email_template({id: '<?php echo $history['template_id']; ?>'});" data-toggle="tooltip" title="" data-original-title="<?php echo $button_edit; ?>"><i class="fa fa-pencil"></i></button>
          <a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? delete_selected('email-template', '<?php echo $history['template_id']; ?>') : false;" data-toggle="tooltip" title="" class="btn btn-warning" data-original-title="<?php echo $button_delete; ?>"><i class="fa fa-trash-o"></i></a>
          <button type="button" class="btn btn-default" onclick="confirm('<?php echo $text_are_you_sure; ?>') ? copy_selected('email-template', '<?php echo $history['template_id']; ?>') : false;" data-toggle="tooltip" title="" data-original-title="<?php echo $button_copy; ?>"><i class="fa fa-copy"></i></button>
        </td>
      </tr>
      <?php } ?>
      <?php } else { ?>
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6">
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
  $('#history-email-template input[name=\'filter_heading\']').autocomplete({
    'source': function(request, response) {
      $.ajax({
        url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_email_template&<?php echo $token; ?>&filter_heading='+encodeURIComponent(request),
        dataType: 'json',
        success: function(json) {
          response($.map(json, function(item) {
            return {
              label: item['name'],
              value: item['template_id']
            }
          }));
        }
      });
    },
    'select': function(item) {
      $('#history-email-template input[name=\'filter_heading\']').val(item['label']);
    }
  });

  $('#history-email-template .datetime').datetimepicker({
    format:     'YYYY-MM-DD',
    formatDate: 'YYYY-MM-DD',
  });
</script>