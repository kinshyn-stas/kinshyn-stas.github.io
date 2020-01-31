<?php echo $header; ?>
<?php echo $column_left; ?>

<!--
@category  : OpenCart
@module    : Smart Checkout
@author    : OCdevWizard <ocdevwizard@gmail.com>
@copyright : Copyright (c) 2014, OCdevWizard
@license   : http://license.ocdevwizard.com/Licensing_Policy.pdf
 -->
 
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-templates"  formaction="<?php echo $action; ?>" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <?php if (isset($action_plus)) { ?>
        <button type="submit" formaction="<?php echo $action_plus; ?>" form="form-templates" data-toggle="tooltip" title="<?php echo $button_save_and_stay; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
        <?php } ?>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-templates" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#emailhtml-block" data-toggle="tab"><?php echo $tab_emailhtml_setting; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="emailhtml-block">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success <?php echo $status == 1 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="status"
                        value="1"
                        autocomplete="off"
                        <?php echo $status == 1 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_yes; ?>
                    </label>
                    <label class="btn btn-success <?php echo $status == 0 ? 'active' : ''; ?>">
                      <input type="radio"
                        name="status"
                        value="0"
                        autocomplete="off"
                        <?php echo $status == 0 ? 'checked="checked"' : ''; ?>
                      /><?php echo $text_no; ?>
                    </label>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-subject<?php echo $language['language_id']; ?>"><?php echo $entry_subject; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="template_description[<?php echo $language['language_id']; ?>][subject]" value="<?php echo isset($template_description[$language['language_id']]) ? $template_description[$language['language_id']]['subject'] : ''; ?>" placeholder="<?php echo $entry_subject; ?>" id="input-subject<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_subject[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_subject[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-template<?php echo $language['language_id']; ?>"><?php echo $entry_template; ?></label>
                    <div class="col-sm-8">
                      <textarea name="template_description[<?php echo $language['language_id']; ?>][template]" placeholder="<?php echo $entry_template; ?>" id="input-template<?php echo $language['language_id']; ?>"><?php echo isset($template_description[$language['language_id']]) ? $template_description[$language['language_id']]['template'] : ''; ?></textarea>
                      <div class="special_margin_lg"></div>
                      <?php if (isset($action_plus)) { ?>
                      <button type="submit" formaction="<?php echo $action_plus; ?>" form="form-templates" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_quick_save_and_preview; ?></button>
                      <div class="special_margin_lg"></div>
                      <?php } ?>
                      <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-eye"></i> <?php echo $text_preview_result; ?></h3></div>
                        <div class="panel-body"><?php echo (!empty($template_description[$language['language_id']]['template'])) ? html_entity_decode($template_description[$language['language_id']]['template'], ENT_QUOTES, 'UTF-8') : ''; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php echo $text_result_email_sub_h1; ?>
                        </div>
                        <div class="panel-footer"><?php echo $text_result_email_sub_c1; ?></div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php echo $text_result_email_sub_h2; ?>
                        </div>
                        <div class="panel-footer"><?php echo $text_result_email_sub_c2; ?></div>
                      </div>  
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php echo $text_result_email_sub_h3; ?>
                        </div>
                        <div class="panel-footer"><?php echo $text_result_email_sub_c3; ?></div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php echo $text_result_email_sub_h4; ?>
                        </div>
                        <div class="panel-footer"><?php echo $text_result_email_sub_c4; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-template<?php echo $language['language_id']; ?>').summernote({height: 300});
<?php } ?>

$('#language a:first').tab('show');
//--></script>
</div>
<?php echo $footer; ?>
