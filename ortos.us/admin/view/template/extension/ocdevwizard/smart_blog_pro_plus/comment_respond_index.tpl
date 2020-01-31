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
              <li><a href="#modal-general-block" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a></li>
            </ul>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="comment_id" value="<?php echo $comment_id; ?>" />
          <input type="hidden" style="display:none;" name="respond_id" value="<?php echo $comment_id; ?>" />
          <input type="hidden" style="display:none;" name="post_id" value="<?php echo $post_id; ?>" />
          <div class="tab-content">
            <!-- TAB General block -->
            <div class="tab-pane fade active in" role="tabpanel" id="modal-general-block">
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-9">
                  <select name="status" id="input-status" class="form-control">
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-comment_type"><?php echo $entry_comment_type; ?></label>
                <div class="col-sm-9">
                  <select name="comment_type" id="input-comment_type" class="form-control">
                    <option value="1" selected="selected"><?php echo $text_comment_type_1; ?></option>
                    <option value="0"><?php echo $text_comment_type_2; ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group required respond-type-1">
                <label class="col-sm-3 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
                <div class="col-sm-9">
                  <input value="" type="text" name="firstname" placeholder="<?php echo $placeholder_comment_firstname; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-firstname"></div>
                </div>
              </div>
              <div class="form-group required respond-type-1">
                <label class="col-sm-3 control-label" for="input-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-9">
                  <input value="" type="text" name="email" placeholder="<?php echo $placeholder_comment_email; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-email"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-status"><?php echo $entry_notification_on_respond; ?></label>
                <div class="col-sm-9">
                  <select name="notification_on_respond" id="input-status" class="form-control">
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  </select>
                  <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $entry_notification_on_respond_faq; ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label"><?php echo $entry_respond_text; ?></label>
                <div class="col-sm-9">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
                    <textarea name="comment_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" class="form-control"></textarea>
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
    <button type="button" class="btn btn-info" onclick="submit_comment_respond(this, 'add');"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><?php echo $button_close; ?></button>
  </div>
</div>
</div>
<script>
$('select[name=comment_type]').change(function() {
  var val = $(this).val();

  if (val == 1) {
    $('.respond-type-1').hide();
  } else {
    $('.respond-type-1').show();
  }
});
$('select[name=comment_type]').trigger('change');  
</script>