<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<div class="modal-content" id="modal-comment-constructor-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $text_modal_heading; ?></h4>
  </div>
  <div class="modal-body">
    <div id="content" class="row" style="padding-bottom: 0;">
      <div class="panel-body" style="padding-top: 0;padding-bottom: 0;">
        <ul class="nav nav-tabs" id="modal-setting-tabs">
          <li class="active dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <?php echo $tab_control_panel; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-comments-general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
              <li><a href="#modal-comments-basic-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_basic_setting; ?></a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i> <?php echo $tab_language_setting; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#modal-comments-language-block" data-toggle="tab"><i class="fa fa-flag-o"></i> <?php echo $tab_basic_language_setting; ?></a></li>
            </ul>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="comment_id" value="<?php echo $comment_id; ?>" />
          <input type="hidden" style="display:none;" name="respond_id" value="<?php echo $respond_id; ?>" />
          <div class="tab-content">
            <!-- TAB General block -->
            <div class="tab-pane fade active in" role="tabpanel" id="modal-comments-general-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-9">
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
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_stores; ?></label>
                <div class="col-sm-9">
                  <?php $row_height = 55; $row = 0; foreach ($all_stores as $store) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($all_stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="comment_store[]"
                          value="<?php echo $store['store_id']; ?>" <?php echo (!empty($stores) && in_array($store['store_id'], $stores)) ? 'checked' : ''; ?>
                        /> <?php echo $store['name']; ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-comment-store"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_stores_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_customer_groups; ?></label>
                <div class="col-sm-9">
                  <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                  <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                  <?php } ?>
                  <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                    <?php foreach ($all_customer_groups as $customer_group) { ?>
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          name="comment_customer_group[]"
                          value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($customer_groups) && in_array($customer_group['customer_group_id'], $customer_groups)) ? 'checked' : ''; ?>
                        /> <?php echo $customer_group['name']; ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-comment-customer-group"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_customer_groups_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Basic block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-comments-basic-block">
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_assigned_post; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="post" value="<?php echo $post; ?>" placeholder="<?php echo $placeholder_assigned_post; ?>" class="form-control" />
                  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
                  <div class="modal-error-block" id="modal-error-post"></div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_autocomplete_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $firstname; ?>" type="text" name="firstname" placeholder="<?php echo $placeholder_comment_firstname; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-firstname"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $email; ?>" type="text" name="email" placeholder="<?php echo $placeholder_comment_email; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-email"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $entry_notification_on_respond; ?></label>
                <div class="col-sm-9">
                  <div class="btn-group btn-toggle" data-toggle="buttons">
                    <label class="btn <?php echo $notification_on_respond == 1 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="notification_on_respond"
                        value="1"
                        autocomplete="off"
                        <?php echo $notification_on_respond == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn <?php echo $notification_on_respond == 0 ? 'active btn-success' : 'btn-default'; ?>">
                      <input type="radio"
                        name="notification_on_respond"
                        value="0"
                        autocomplete="off"
                        <?php echo $notification_on_respond == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $entry_notification_on_respond_faq; ?></div>
                </div>
              </div>
            </div>
            <!-- TAB Language block -->
            <div class="tab-pane fade" role="tabpanel" id="modal-comments-language-block">
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_comment_text; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="comment_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($comment_description[$language['language_id']]) ? $comment_description[$language['language_id']]['description'] : ''; ?></textarea>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>'});"><?php echo $text_open_texteditor; ?></button>
                    <button type="button" class="btn btn-default btn-xs" onclick="texteditor_action({id: '#description<?php echo $language['language_id']; ?>', start: false, destroy: true});" style="display: none;"><?php echo $text_save_texteditor; ?></button>
                  </div>
                  <div class="modal-error-block" id="modal-error-comment-description-language-description-<?php echo $language['language_id']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="submit_comment(this, <?php if ($comment_id) { ?>'edit'<?php } else { ?>'add'<?php } ?>);"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" <?php if (!$comment_id) { ?>style="display: none;"<?php } ?>><?php echo $button_close; ?></button>
  </div>
</div>
<!-- start: code for tab basic setting -->
<script>
$('input[name=\'post\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/autocomplete_post&<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
          if (item['post_id']) {
            return {
              label: item['name'],
              value: item['post_id']
            }
					} else {
					  return {
              label: '<?php echo $text_none; ?>',
              value: 0
            }
					}
				}));
			}
		});
	},
	'select': function(item) {
    $('input[name=\'post\']').val(item['label']);
    $('input[name=\'post_id\']').val(item['value']);
  }
});
</script>
<!-- end: code for tab general setting -->
</div>
