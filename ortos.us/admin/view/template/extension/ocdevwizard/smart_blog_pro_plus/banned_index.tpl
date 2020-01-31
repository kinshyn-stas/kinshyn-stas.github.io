<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->
<div class="modal-content" id="modal-banned-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $text_modal_heading; ?></h4>
  </div>
  <div class="modal-body">
    <div id="content" class="row" style="padding-bottom: 0;">
      <div class="panel-body" style="padding-top: 0;padding-bottom: 0;">
        <ul class="nav nav-tabs" id="modal-setting-tabs">
          <li class="active dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> <?php echo $tab_control_panel; ?></a>
          </li>
        </ul>
        <form method="post" enctype="multipart/form-data" id="modal-form" class="form-horizontal">
          <input type="hidden" style="display:none;" name="banned_id" value="<?php echo $banned_id; ?>" />
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
                <label class="col-sm-3 control-label" for="input-ip"><?php echo $entry_ip; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $ip; ?>" type="text" name="ip" placeholder="<?php echo $placeholder_comment_ip; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-ip"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="input-email"><?php echo $entry_email; ?></label>
                <div class="col-sm-9">
                  <input value="<?php echo $email; ?>" type="text" name="email" placeholder="<?php echo $placeholder_comment_email; ?>" class="form-control" />
                  <div class="modal-error-block" id="modal-error-email"></div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-info" onclick="submit_banned(this, <?php if ($banned_id) { ?>'edit'<?php } else { ?>'add'<?php } ?>);"><?php echo $button_submit; ?></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" <?php if (!$banned_id) { ?>style="display: none;"<?php } ?>><?php echo $button_close; ?></button>
  </div>
</div>
</div>
