<?php echo $header; ?>
<?php echo $column_left; ?>

<!--
##==================================================================##
## @author    : OCdevWizard                                         ##
## @contact   : ocdevwizard@gmail.com                               ##
## @support   : http://help.ocdevwizard.com                         ##
## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
##==================================================================##
-->

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right" id="top-nav-line">
        <button type="submit" formaction="<?php echo $action; ?>" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <button type="submit" formaction="<?php echo $action_plus; ?>" form="form" data-toggle="tooltip" title="<?php echo $button_save_and_stay; ?>" class="btn btn-primary"><i class="fa fa-save"></i> + <i class="fa fa-refresh"></i></button>
        <div class="btn-group">
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;<span class="caret"></span></button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $uninstall; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_uninstall; ?></a></li>
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $uninstall_and_remove; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_uninstall_and_remove; ?></a></li>
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $cache; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_cache; ?></a></li>
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $cache_backup; ?>' : false;"><i class="fa fa-trash"></i> <?php echo $button_cache_backup; ?></a></li>
            <li><a onclick="confirm('<?php echo $text_are_you_sure; ?>') ? href='<?php echo $restore; ?>' : false;"><i class="fa fa-repeat"></i> <?php echo $button_restore; ?></a></li>
          </ul>
        </div>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb-module">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <?php if ($breadcrumb['href']) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } elseif (empty($breadcrumb['href']) && $breadcrumb['dropdown']) { ?>
            <li>
              <div class="btn-group dropdown-on-hover">
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $breadcrumb['text']; ?> <span class="caret"></span></button>
                <?php if ($breadcrumb['dropdown']) { ?>
                  <ul class="dropdown-menu">
                    <?php foreach ($breadcrumb['dropdown'] as $dropdown) { ?>
                      <li><a href="<?php echo $dropdown['href']; ?>"><?php if ($dropdown['active']) { ?><i class="fa fa-check-square-o"></i><?php } else { ?><i class="fa fa-square-o"></i><?php } ?> <?php echo $dropdown['text']; ?></a></li>
                    <?php } ?>
                  </ul>
                <?php } ?>
              </div>
            </li>
          <?php } else { ?>
            <li><a><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid" id="top-alerts">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-3 col-md-3 col-lg-2">
        <div class="btn-group" style="width: 100%;margin-bottom: 10px;">
          <button type="button" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> <?php echo $text_select_store; ?> <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <?php foreach ($all_stores as $store) { ?>
              <li><a href="<?php echo $store['href']; ?>"><?php if ($store_id == $store['store_id']) { ?><i class="fa fa-check-square-o"></i><?php } else { ?><i class="fa fa-square-o"></i><?php } ?> <?php echo $store['name']; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <!-- Nav tabs -->
        <div class="list-group list-group-root well" id="setting-tabs">
          <a class="list-group-item list-group-item-info"><i class="fa fa-cog"></i><?php echo $tab_control_panel; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#general-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_general_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#basic-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_basic_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#layout-block" role="tab"><i class="fa fa-eye"></i> <?php echo $tab_layout_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#css-block" role="tab"><i class="fa fa-css3"></i> <?php echo $tab_css_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#feed-block" role="tab"><i class="fa fa-sitemap"></i> <?php echo $tab_feed_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#config-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_config_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-list-alt"></i><?php echo $tab_module_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#module-constructor-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_module_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#module-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_module_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-list-alt"></i><?php echo $tab_category_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#category-constructor-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_category_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#category-page-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_category_page_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#category-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_category_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-list-alt"></i><?php echo $tab_post_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#post-constructor-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_post_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#post-page-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_post_page_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#post-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_post_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-list-alt"></i><?php echo $tab_author_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#author-constructor-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_author_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#author-page-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_author_page_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#author-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_author_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-list-alt"></i><?php echo $tab_search_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#search-page-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_search_page_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-bars"></i><?php echo $tab_comment_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#comment-constructor-block" role="tab"><i class="fa fa-list-alt"></i> <?php echo $tab_comment_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#comment-list-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_comment_list_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#comment-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_comment_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-bars"></i><?php echo $tab_vote_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#vote-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_vote_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-bars"></i><?php echo $tab_banned_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#banned-constructor-block" role="tab"><i class="fa fa-ban"></i> <?php echo $tab_banned_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#banned-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_banned_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-bars"></i><?php echo $tab_email_template_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#email-template-constructor-block" role="tab"><i class="fa fa-cogs"></i> <?php echo $tab_email_template_constructor_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#email-template-import-export-block" role="tab"><i class="fa fa-file-archive-o"></i> <?php echo $tab_email_template_import_export_setting; ?></a>
          </div>
          <a class="list-group-item list-group-item-info"><i class="fa fa-life-ring"></i><?php echo $tab_support_setting; ?></a>
          <div class="list-group">
            <a class="list-group-item" data-toggle="tab" href="#support-extension-block" role="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_support_extension_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#support-general-block" role="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_support_general_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#support-terms-block" role="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_support_terms_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#support-faq-block" role="tab"><i class="fa fa-question-circle"></i> <?php echo $tab_support_faq_setting; ?></a>
            <a class="list-group-item" data-toggle="tab" href="#promo-block" role="tab"><i class="fa fa-briefcase"></i> <?php echo $tab_promo_setting; ?></a>
          </div>
        </div>
      </div>
      <div class="col-sm-9 col-md-9 col-lg-10">
        <div class="panel panel-default">
          <div class="panel-body">
            <form method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
              <div class="tab-content">
                <!-- TAB General block -->
                <div class="tab-pane fade active in" role="tabpanel" id="general-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_activate_module; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['activate'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['activate'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['activate'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['activate'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- TAB Basic block -->
                <div class="tab-pane fade" role="tabpanel" id="basic-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_direction_type; ?></label>
                    <div class="col-sm-10">
                      <?php foreach ($languages as $language) { ?>
                      <div class="btn-group-vertical btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo (isset($form_data['direction_type'][$language['language_id']]) && $form_data['direction_type'][$language['language_id']] == 1) ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[direction_type][<?php echo $language['language_id']; ?>]"
                            value="1"
                            autocomplete="off"
                            <?php echo (isset($form_data['direction_type'][$language['language_id']]) && $form_data['direction_type'][$language['language_id']] == 1) ? 'checked="checked"' : ''; ?>
                          /><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $text_direction_type_1; ?>
                        </label>
                        <label class="btn <?php echo (isset($form_data['direction_type'][$language['language_id']]) && $form_data['direction_type'][$language['language_id']] == 2) ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[direction_type][<?php echo $language['language_id']; ?>]"
                            value="2"
                            autocomplete="off"
                            <?php echo (isset($form_data['direction_type'][$language['language_id']]) && $form_data['direction_type'][$language['language_id']] == 2) ? 'checked="checked"' : ''; ?>
                          /><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $text_direction_type_2; ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_minify_main_js; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[minify_main_js]" class="form-control">
                        <option value="0" <?php echo $form_data['minify_main_js'] == 0 ? 'selected="selected"' : ''; ?> ><?php echo $text_no; ?></option>
                        <option value="1" <?php echo $form_data['minify_main_js'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_minify_main_js_1; ?></option>
                        <option value="2" <?php echo $form_data['minify_main_js'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_minify_main_js_2; ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- TAB Layout block -->
                <div class="tab-pane fade" role="tabpanel" id="layout-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_on_dashboard; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_on_dashboard'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_on_dashboard]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_on_dashboard'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_on_dashboard'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_on_dashboard]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_on_dashboard'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                      <button class="btn btn-default" type="button" data-faq-target="faq_1" data-toggle="tooltip" title="<?php echo $text_open_example; ?>"><i class="fa fa-info-circle"></i></button>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_on_top_notification; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_on_top_notification'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_on_top_notification]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_on_top_notification'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_on_top_notification'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_on_top_notification]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_on_top_notification'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                      <button class="btn btn-default" type="button" data-faq-target="faq_2" data-toggle="tooltip" title="<?php echo $text_open_example; ?>"><i class="fa fa-info-circle"></i></button>
                    </div>
                  </div>
                </div>
                <!-- TAB CSS block -->
                <div class="tab-pane fade" role="tabpanel" id="css-block">
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_edit_css; ?></label>
                    <div class="col-sm-10">
                      <textarea id="edit-css-block-0"><?php echo $stylesheet_code; ?></textarea>
                      <br/>
                      <button type="button" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save_css; ?>" onclick="save_css('0', 'stylesheet');"><i class="fa fa-save"></i></button>
                      <button type="button" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_restore_css; ?>" onclick="confirm('<?php echo $text_are_you_sure; ?>') ? restore_css('0', 'stylesheet', 'stylesheet_default') : false;"><i class="fa fa-refresh"></i></button>
                      <br/><br/>
                      <div id="result-css-block-0"></div>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_edit_css_rtl; ?></label>
                    <div class="col-sm-10">
                      <textarea id="edit-css-block-1"><?php echo $stylesheet_code_rtl; ?></textarea>
                      <br/>
                      <button type="button" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save_css; ?>" onclick="save_css('1', 'stylesheet_rtl');"><i class="fa fa-save"></i></button>
                      <button type="button" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_restore_css; ?>" onclick="confirm('<?php echo $text_are_you_sure; ?>') ? restore_css('1', 'stylesheet_rtl', 'stylesheet_rtl_default') : false;"><i class="fa fa-refresh"></i></button>
                      <br/><br/>
                      <div id="result-css-block-1"></div>
                    </div>
                  </div>
                </div>
                <!-- TAB Feed block -->
                <div class="tab-pane fade" role="tabpanel" id="feed-block">
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_activate_xml_feed; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['activate_xml_feed'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate_xml_feed]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['activate_xml_feed'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['activate_xml_feed'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate_xml_feed]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['activate_xml_feed'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_post_frequency; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_post_frequency]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="always" <?php echo $form_data['xml_feed_post_frequency'] == 'always' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_1; ?></option>
                        <option value="hourly" <?php echo $form_data['xml_feed_post_frequency'] == 'hourly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_2; ?></option>
                        <option value="daily" <?php echo $form_data['xml_feed_post_frequency'] == 'daily' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_3; ?></option>
                        <option value="weekly" <?php echo $form_data['xml_feed_post_frequency'] == 'weekly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_4; ?></option>
                        <option value="monthly" <?php echo $form_data['xml_feed_post_frequency'] == 'monthly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_5; ?></option>
                        <option value="yearly" <?php echo $form_data['xml_feed_post_frequency'] == 'yearly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_6; ?></option>
                        <option value="never" <?php echo $form_data['xml_feed_post_frequency'] == 'never' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_7; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_category_frequency; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_category_frequency]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="always" <?php echo $form_data['xml_feed_category_frequency'] == 'always' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_1; ?></option>
                        <option value="hourly" <?php echo $form_data['xml_feed_category_frequency'] == 'hourly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_2; ?></option>
                        <option value="daily" <?php echo $form_data['xml_feed_category_frequency'] == 'daily' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_3; ?></option>
                        <option value="weekly" <?php echo $form_data['xml_feed_category_frequency'] == 'weekly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_4; ?></option>
                        <option value="monthly" <?php echo $form_data['xml_feed_category_frequency'] == 'monthly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_5; ?></option>
                        <option value="yearly" <?php echo $form_data['xml_feed_category_frequency'] == 'yearly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_6; ?></option>
                        <option value="never" <?php echo $form_data['xml_feed_category_frequency'] == 'never' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_7; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_author_frequency; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_author_frequency]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="always" <?php echo $form_data['xml_feed_author_frequency'] == 'always' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_1; ?></option>
                        <option value="hourly" <?php echo $form_data['xml_feed_author_frequency'] == 'hourly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_2; ?></option>
                        <option value="daily" <?php echo $form_data['xml_feed_author_frequency'] == 'daily' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_3; ?></option>
                        <option value="weekly" <?php echo $form_data['xml_feed_author_frequency'] == 'weekly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_4; ?></option>
                        <option value="monthly" <?php echo $form_data['xml_feed_author_frequency'] == 'monthly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_5; ?></option>
                        <option value="yearly" <?php echo $form_data['xml_feed_author_frequency'] == 'yearly' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_6; ?></option>
                        <option value="never" <?php echo $form_data['xml_feed_author_frequency'] == 'never' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_frequency_7; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_post_priority; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_post_priority]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="0.0" <?php echo $form_data['xml_feed_post_priority'] == '0.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_1; ?></option>
                        <option value="0.1" <?php echo $form_data['xml_feed_post_priority'] == '0.1' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_2; ?></option>
                        <option value="0.2" <?php echo $form_data['xml_feed_post_priority'] == '0.2' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_3; ?></option>
                        <option value="0.3" <?php echo $form_data['xml_feed_post_priority'] == '0.3' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_4; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_post_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_5; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_post_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_6; ?></option>
                        <option value="0.6" <?php echo $form_data['xml_feed_post_priority'] == '0.6' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_7; ?></option>
                        <option value="0.7" <?php echo $form_data['xml_feed_post_priority'] == '0.7' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_8; ?></option>
                        <option value="0.8" <?php echo $form_data['xml_feed_post_priority'] == '0.8' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_9; ?></option>
                        <option value="0.9" <?php echo $form_data['xml_feed_post_priority'] == '0.9' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_10; ?></option>
                        <option value="1.0" <?php echo $form_data['xml_feed_post_priority'] == '1.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_11; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_category_priority; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_category_priority]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="0.0" <?php echo $form_data['xml_feed_category_priority'] == '0.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_1; ?></option>
                        <option value="0.1" <?php echo $form_data['xml_feed_category_priority'] == '0.1' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_2; ?></option>
                        <option value="0.2" <?php echo $form_data['xml_feed_category_priority'] == '0.2' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_3; ?></option>
                        <option value="0.3" <?php echo $form_data['xml_feed_category_priority'] == '0.3' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_4; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_category_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_5; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_category_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_6; ?></option>
                        <option value="0.6" <?php echo $form_data['xml_feed_category_priority'] == '0.6' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_7; ?></option>
                        <option value="0.7" <?php echo $form_data['xml_feed_category_priority'] == '0.7' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_8; ?></option>
                        <option value="0.8" <?php echo $form_data['xml_feed_category_priority'] == '0.8' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_9; ?></option>
                        <option value="0.9" <?php echo $form_data['xml_feed_category_priority'] == '0.9' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_10; ?></option>
                        <option value="1.0" <?php echo $form_data['xml_feed_category_priority'] == '1.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_11; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_xml_feed_author_priority; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[xml_feed_author_priority]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="0.0" <?php echo $form_data['xml_feed_author_priority'] == '0.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_1; ?></option>
                        <option value="0.1" <?php echo $form_data['xml_feed_author_priority'] == '0.1' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_2; ?></option>
                        <option value="0.2" <?php echo $form_data['xml_feed_author_priority'] == '0.2' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_3; ?></option>
                        <option value="0.3" <?php echo $form_data['xml_feed_author_priority'] == '0.3' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_4; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_author_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_5; ?></option>
                        <option value="0.4" <?php echo $form_data['xml_feed_author_priority'] == '0.4' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_6; ?></option>
                        <option value="0.6" <?php echo $form_data['xml_feed_author_priority'] == '0.6' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_7; ?></option>
                        <option value="0.7" <?php echo $form_data['xml_feed_author_priority'] == '0.7' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_8; ?></option>
                        <option value="0.8" <?php echo $form_data['xml_feed_author_priority'] == '0.8' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_9; ?></option>
                        <option value="0.9" <?php echo $form_data['xml_feed_author_priority'] == '0.9' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_10; ?></option>
                        <option value="1.0" <?php echo $form_data['xml_feed_author_priority'] == '1.0' ? 'selected="selected"' : ''; ?> ><?php echo $text_xml_feed_priority_11; ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label" for="input-xml_feed_page_url"><?php echo $text_xml_feed_page_url; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $config_store_url; ?></span>
                        <input value="index.php?route=extension/ocdevwizard/smart_blog_pro_plus/xml_feed" type="text" name="xml_feed_page_url" class="form-control" readonly/>
                      </div>
                      <div class="modal-error-block" id="modal-error-page-url"></div>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_xml_feed_page_url_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label"><?php echo $text_activate_rss_feed; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['activate_rss_feed'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate_rss_feed]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['activate_rss_feed'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['activate_rss_feed'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[activate_rss_feed]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['activate_rss_feed'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group pro-block">
                    <label class="col-sm-2 control-label" for="input-rss_feed_page_url"><?php echo $text_rss_feed_page_url; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $config_store_url; ?></span>
                        <input value="index.php?route=extension/ocdevwizard/smart_blog_pro_plus/rss_feed" type="text" name="rss_feed_page_url" class="form-control" readonly/>
                      </div>
                      <div class="modal-error-block" id="modal-error-page-url"></div>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_rss_feed_page_url_faq; ?></div>
                    </div>
                  </div>
                </div>
                <!-- TAB Import/Export config block -->
                <div class="tab-pane fade" role="tabpanel" id="config-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="config_import" style="display:none;" id="config-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#config-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="config_load_file_mask" id="config-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="config-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="config_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($config_backup_files) { ?>
                          <?php foreach ($config_backup_files as $config_backup_file) { ?>
                          <option value="<?php echo $config_backup_file['name']; ?>"><?php echo $config_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="config-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#config-import-export-block', '<?php echo $export_config_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Module constructor block -->
                <div class="tab-pane fade" role="tabpanel" id="module-constructor-block">
                  <div id="history-module"></div>
                </div>
                <!-- TAB Import/Export module block -->
                <div class="tab-pane fade" role="tabpanel" id="module-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="module_import" style="display:none;" id="module-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#module-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="module_load_file_mask" id="module-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="module-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="module_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($module_backup_files) { ?>
                          <?php foreach ($module_backup_files as $module_backup_file) { ?>
                          <option value="<?php echo $module_backup_file['name']; ?>"><?php echo $module_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="module-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#module-import-export-block', '<?php echo $export_module_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Category constructor block -->
                <div class="tab-pane fade" role="tabpanel" id="category-constructor-block">
                  <div id="history-category"></div>
                </div>
                <!-- TAB Category page block -->
                <div class="tab-pane fade" role="tabpanel" id="category-page-block">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-limit_post_on_category"><?php echo $text_limit_post_on_category; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['limit_post_on_category']; ?>" type="text" name="form_data[limit_post_on_category]" class="form-control" id="input-limit_post_on_category" />
                      <?php if (isset($error_limit_post_on_category)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_post_on_category; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label"><?php echo $text_dementions_of_post_image_on_category; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_width_on_category']; ?>" type="text" name="form_data[post_image_width_on_category]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <div class="special-margin"></div>
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_height_on_category']; ?>" type="text" name="form_data[post_image_height_on_category]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <?php if (isset($error_post_image_width_on_category)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_width_on_category; ?></div>
                      <?php } ?>
                      <?php if (isset($error_post_image_height_on_category)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_height_on_category; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_description; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_description_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_description_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required description-limit-block">
                    <label class="col-sm-2 control-label" for="input-description_limit"><?php echo $entry_description_limit; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['description_limit_on_category']; ?>" type="text" name="form_data[description_limit_on_category]" class="form-control" />
                      <div class="modal-error-block" id="modal-error-description-limit-on-category"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_viewed; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_viewed_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_viewed_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_comments; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_comments_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_comments_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_author; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_author_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_author_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_read_more_button; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_read_more_button_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_read_more_button_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_image; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_image_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_image_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_additional_image_on_category; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_additional_image_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_additional_image_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_additional_image_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_additional_image_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_additional_image_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_additional_image_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label"><?php echo $text_dementions_of_additional_category_image_on_category; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                        <input value="<?php echo $form_data['additional_image_width_on_category']; ?>" type="text" name="form_data[additional_image_width_on_category]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <div class="special-margin"></div>
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                        <input value="<?php echo $form_data['additional_image_height_on_category']; ?>" type="text" name="form_data[additional_image_height_on_category]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <?php if (isset($error_additional_image_width_on_category)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_additional_image_width_on_category; ?></div>
                      <?php } ?>
                      <?php if (isset($error_additional_image_height_on_category)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_additional_image_height_on_category; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_date_added; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_date_added_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_date_added_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_pagination_results; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_pagination_results_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_pagination_results_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_disaply_view; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_disaply_view_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_disaply_view_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_limit; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_limit_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_limit_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_sort; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_sort_on_category'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_category]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_category'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_sort_on_category'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_category]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_category'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group sort-method-block">
                    <label class="col-sm-2 control-label"><?php echo $text_sort_method; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[sort_method_on_category]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="1" id="sort-method-option-1" <?php echo $form_data['sort_method_on_category'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_1; ?></option>
                        <option value="2" id="sort-method-option-2" <?php echo $form_data['sort_method_on_category'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_2; ?></option>
                        <option value="3" id="sort-method-option-3" <?php echo $form_data['sort_method_on_category'] == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_3; ?></option>
                        <option value="4" id="sort-method-option-4" <?php echo $form_data['sort_method_on_category'] == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_4; ?></option>
                        <option value="5" id="sort-method-option-5" <?php echo $form_data['sort_method_on_category'] == 5 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_5; ?></option>
                        <option value="6" id="sort-method-option-6" <?php echo $form_data['sort_method_on_category'] == 6 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_6; ?></option>
                        <option value="7" id="sort-method-option-7" <?php echo $form_data['sort_method_on_category'] == 7 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_7; ?></option>
                        <option value="8" id="sort-method-option-8" <?php echo $form_data['sort_method_on_category'] == 8 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_8; ?></option>
                        <option value="9" id="sort-method-option-9" <?php echo $form_data['sort_method_on_category'] == 9 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_9; ?></option>
                        <option value="10" id="sort-method-option-10" <?php echo $form_data['sort_method_on_category'] == 10 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_10; ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- TAB Import/Export category block -->
                <div class="tab-pane fade" role="tabpanel" id="category-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="category_import" style="display:none;" id="category-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#category-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="category_load_file_mask" id="category-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="category-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="category_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($category_backup_files) { ?>
                          <?php foreach ($category_backup_files as $category_backup_file) { ?>
                          <option value="<?php echo $category_backup_file['name']; ?>"><?php echo $category_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="category-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#category-import-export-block', '<?php echo $export_category_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Post constructor block -->
                <div class="tab-pane fade" role="tabpanel" id="post-constructor-block">
                  <div id="history-post"></div>
                </div>
                <!-- TAB Post page block -->
                <div class="tab-pane " role="tabpanel" id="post-page-block">
                  <fieldset>
                    <legend><?php echo $text_legend_other; ?></legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_tags; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_tags'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_tags]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_tags'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_tags'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_tags]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_tags'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_author; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_author]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_author'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_author]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_author'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_date_added; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_date_added'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_date_added]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_date_added'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_date_added'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_date_added]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_date_added'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_count_viewed; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_count_viewed'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_viewed]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_count_viewed'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_count_viewed'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_viewed]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_count_viewed'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_comment_count; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_comment_count'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_comment_count]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_comment_count'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_comment_count'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_comment_count]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_comment_count'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_sicials; ?></label>
                      <div class="col-sm-10">
                        <?php $row_height = 55; $row = 0; foreach ($all_socials as $social) { ?>
                        <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                        <?php } ?>
                        <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                          <?php $row = 0; foreach ($all_socials as $social) { ?>
                          <div class="checkbox">
                            <label>
                              <input
                                type="checkbox"
                                name="form_data[post_socials][]"
                                value="<?php echo $social['value']; ?>" <?php echo (!empty($form_data['post_socials']) && in_array($social['value'], $form_data['post_socials'])) ? 'checked' : ''; ?>
                              /> <?php echo $social['name']; ?>
                            </label>
                          </div>
                          <?php $row++; ?>
                          <?php } ?>
                        </div>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                          <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                        </div>
                        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_show_sicials_faq; ?></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_allow_open_graph; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['allow_open_graph_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_open_graph_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['allow_open_graph_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['allow_open_graph_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_open_graph_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['allow_open_graph_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_allow_twitter_card; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['allow_twitter_card_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_twitter_card_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['allow_twitter_card_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['allow_twitter_card_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_twitter_card_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['allow_twitter_card_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_allow_schema; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['allow_schema_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_schema_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['allow_schema_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['allow_schema_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[allow_schema_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['allow_schema_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend><?php echo $text_legend_vote; ?></legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_post_vote; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_post_vote'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_post_vote]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_post_vote'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_post_vote'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_post_vote]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_post_vote'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_comment_vote; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_comment_vote'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_comment_vote]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_comment_vote'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_comment_vote'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_comment_vote]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_comment_vote'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_vote_customer_groups; ?></label>
                      <div class="col-sm-10">
                        <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                        <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                        <?php } ?>
                        <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                          <?php $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                          <div class="checkbox">
                            <label>
                              <input
                                type="checkbox"
                                name="form_data[vote_customer_groups][]"
                                value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($form_data['vote_customer_groups']) && in_array($customer_group['customer_group_id'], $form_data['vote_customer_groups'])) ? 'checked' : ''; ?>
                              /> <?php echo $customer_group['name']; ?>
                            </label>
                          </div>
                          <?php $row++; ?>
                          <?php } ?>
                        </div>
                        <div class="btn-group">
                          <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                          <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                        </div>
                        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_vote_customer_groups_faq; ?></div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend><?php echo $text_legend_related_post; ?></legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_related_posts; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_related_posts'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_related_posts]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_related_posts'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_related_posts'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_related_posts]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_related_posts'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label" for="input-limit_post_on_post"><?php echo $text_limit_post_on_post; ?></label>
                      <div class="col-sm-10">
                        <input value="<?php echo $form_data['limit_post_on_post']; ?>" type="text" name="form_data[limit_post_on_post]" class="form-control" id="input-limit_post_on_post" />
                        <?php if (isset($error_limit_post_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_post_on_post; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_post_show_post_image_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['post_show_post_image_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[post_show_post_image_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['post_show_post_image_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['post_show_post_image_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[post_show_post_image_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['post_show_post_image_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label"><?php echo $text_dementions_of_post_image_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                          <input value="<?php echo $form_data['post_image_width_on_post']; ?>" type="text" name="form_data[post_image_width_on_post]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                          <span class="input-group-addon"><?php echo $text_px; ?></span>
                        </div>
                        <div class="special-margin"></div>
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                          <input value="<?php echo $form_data['post_image_height_on_post']; ?>" type="text" name="form_data[post_image_height_on_post]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                          <span class="input-group-addon"><?php echo $text_px; ?></span>
                        </div>
                        <?php if (isset($error_post_image_width_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_width_on_post; ?></div>
                        <?php } ?>
                        <?php if (isset($error_post_image_height_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_height_on_post; ?></div>
                        <?php } ?>
                        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_description_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_description_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_description_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_description_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_description_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_description_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_description_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required description-limit-block">
                      <label class="col-sm-2 control-label" for="input-description_limit"><?php echo $entry_description_limit_on_post; ?></label>
                      <div class="col-sm-10">
                        <input value="<?php echo $form_data['description_limit_on_post']; ?>" type="text" name="form_data[description_limit_on_post]" class="form-control" />
                        <div class="modal-error-block" id="modal-error-description-limit-on-category"></div>
                        <?php if (isset($error_description_limit_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_description_limit_on_post; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_count_viewed_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_count_viewed_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_viewed_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_count_viewed_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_count_viewed_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_viewed_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_count_viewed_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_count_comments_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_count_comments_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_comments_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_count_comments_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_count_comments_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_count_comments_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_count_comments_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_author_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_author_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_author_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_author_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_author_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_author_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_author_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_read_more_button_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_read_more_button_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_read_more_button_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_read_more_button_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_read_more_button_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_read_more_button_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_read_more_button_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_date_added_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_date_added_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_date_added_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_date_added_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_date_added_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_date_added_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_date_added_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_post_randomize_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['post_randomize_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[post_randomize_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['post_randomize_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['post_randomize_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[post_randomize_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['post_randomize_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend><?php echo $text_legend_related_product; ?></legend>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_show_related_products; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['show_related_products'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_related_products]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['show_related_products'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['show_related_products'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[show_related_products]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['show_related_products'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label"><?php echo $text_limit_product_on_post; ?></label>
                      <div class="col-sm-10">
                        <input value="<?php echo $form_data['limit_product_on_post']; ?>" type="text" name="form_data[limit_product_on_post]" class="form-control" />
                        <?php if (isset($error_limit_product_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_product_on_post; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_image_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_image_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_image_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_image_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_image_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_image_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_image_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label"><?php echo $text_dementions_of_product_image_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                          <input value="<?php echo $form_data['product_main_image_width_on_post']; ?>" type="text" name="form_data[product_main_image_width_on_post]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                          <span class="input-group-addon"><?php echo $text_px; ?></span>
                        </div>
                        <div class="special-margin"></div>
                        <div class="input-group">
                          <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                          <input value="<?php echo $form_data['product_main_image_height_on_post']; ?>" type="text" name="form_data[product_main_image_height_on_post]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                          <span class="input-group-addon"><?php echo $text_px; ?></span>
                        </div>
                        <?php if (isset($error_product_main_image_width_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_product_main_image_width_on_post; ?></div>
                        <?php } ?>
                        <?php if (isset($error_product_main_image_height_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_product_main_image_height_on_post; ?></div>
                        <?php } ?>
                        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_price_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_price_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_price_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_price_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_price_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_price_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_price_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_name_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_name_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_name_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_name_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_name_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_name_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_name_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_description_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_description_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_description_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_description_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_description_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_description_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_description_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-sm-2 control-label"><?php echo $text_product_description_limit_on_post; ?></label>
                      <div class="col-sm-10">
                        <input value="<?php echo $form_data['product_description_limit_on_post']; ?>" type="text" name="form_data[product_description_limit_on_post]" class="form-control" />
                        <?php if (isset($error_product_description_limit_on_post)) { ?>
                          <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_product_description_limit_on_post; ?></div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_rating_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_rating_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_rating_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_rating_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_rating_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_rating_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_rating_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_cart_button_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_cart_button_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_cart_button_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_cart_button_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_cart_button_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_cart_button_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_cart_button_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_wishlist_button_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_wishlist_button_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_wishlist_button_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_wishlist_button_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_wishlist_button_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_wishlist_button_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_wishlist_button_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_show_product_compare_button_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_show_product_compare_button_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_compare_button_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_compare_button_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_show_product_compare_button_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_show_product_compare_button_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_show_product_compare_button_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"><?php echo $text_product_randomize_on_post; ?></label>
                      <div class="col-sm-10">
                        <div class="btn-group btn-toggle" data-toggle="buttons">
                          <label class="btn <?php echo $form_data['product_randomize_on_post'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_randomize_on_post]"
                              value="1"
                              autocomplete="off"
                              <?php echo $form_data['product_randomize_on_post'] == 1 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_yes; ?>
                          </label>
                          <label class="btn <?php echo $form_data['product_randomize_on_post'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                            <input type="radio"
                              name="form_data[product_randomize_on_post]"
                              value="0"
                              autocomplete="off"
                              <?php echo $form_data['product_randomize_on_post'] == 0 ? 'checked="checked"' : ''; ?>
                            /><?php echo $text_no; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <!-- TAB Import/Export post block -->
                <div class="tab-pane fade" role="tabpanel" id="post-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="post_import" style="display:none;" id="post-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#post-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="post_load_file_mask" id="post-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="post-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="post_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($post_backup_files) { ?>
                          <?php foreach ($post_backup_files as $post_backup_file) { ?>
                          <option value="<?php echo $post_backup_file['name']; ?>"><?php echo $post_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="post-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#post-import-export-block', '<?php echo $export_post_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Author constructor block -->
                <div class="tab-pane fade" role="tabpanel" id="author-constructor-block">
                  <div id="history-author"></div>
                </div>
                <!-- TAB Author page block -->
                <div class="tab-pane fade" role="tabpanel" id="author-page-block">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-limit_post_on_author"><?php echo $text_limit_post_on_author; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['limit_post_on_author']; ?>" type="text" name="form_data[limit_post_on_author]" class="form-control" id="input-limit_post_on_author" />
                      <?php if (isset($error_limit_post_on_author)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_post_on_author; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label"><?php echo $text_dementions_of_post_image_on_author; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_width_on_author']; ?>" type="text" name="form_data[post_image_width_on_author]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <div class="special-margin"></div>
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_height_on_author']; ?>" type="text" name="form_data[post_image_height_on_author]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <?php if (isset($error_post_image_width_on_author)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_width_on_author; ?></div>
                      <?php } ?>
                      <?php if (isset($error_post_image_height_on_author)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_height_on_author; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_description; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_description_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_description_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required description-limit-block">
                    <label class="col-sm-2 control-label" for="input-description_limit"><?php echo $entry_description_limit; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['description_limit_on_author']; ?>" type="text" name="form_data[description_limit_on_author]" class="form-control" />
                      <div class="modal-error-block" id="modal-error-description-limit-on-author"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_viewed; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_viewed_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_viewed_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_comments; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_comments_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_comments_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_author; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_author_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_author_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_read_more_button; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_read_more_button_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_read_more_button_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_image; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_image_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_image_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_date_added; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_date_added_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_date_added_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_pagination_results; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_pagination_results_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_pagination_results_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_disaply_view; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_disaply_view_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_disaply_view_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_limit; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_limit_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_limit_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_sort; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_sort_on_author'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_author]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_author'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_sort_on_author'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_author]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_author'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group sort-method-block">
                    <label class="col-sm-2 control-label"><?php echo $text_sort_method; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[sort_method_on_author]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="1" id="sort-method-option-1" <?php echo $form_data['sort_method_on_author'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_1; ?></option>
                        <option value="2" id="sort-method-option-2" <?php echo $form_data['sort_method_on_author'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_2; ?></option>
                        <option value="3" id="sort-method-option-3" <?php echo $form_data['sort_method_on_author'] == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_3; ?></option>
                        <option value="4" id="sort-method-option-4" <?php echo $form_data['sort_method_on_author'] == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_4; ?></option>
                        <option value="5" id="sort-method-option-5" <?php echo $form_data['sort_method_on_author'] == 5 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_5; ?></option>
                        <option value="6" id="sort-method-option-6" <?php echo $form_data['sort_method_on_author'] == 6 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_6; ?></option>
                        <option value="7" id="sort-method-option-7" <?php echo $form_data['sort_method_on_author'] == 7 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_7; ?></option>
                        <option value="8" id="sort-method-option-8" <?php echo $form_data['sort_method_on_author'] == 8 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_8; ?></option>
                        <option value="9" id="sort-method-option-9" <?php echo $form_data['sort_method_on_author'] == 9 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_9; ?></option>
                        <option value="10" id="sort-method-option-10" <?php echo $form_data['sort_method_on_author'] == 10 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_10; ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- TAB Import/Export author block -->
                <div class="tab-pane fade" role="tabpanel" id="author-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="author_import" style="display:none;" id="author-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#author-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="author_load_file_mask" id="author-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="author-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="author_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($author_backup_files) { ?>
                          <?php foreach ($author_backup_files as $author_backup_file) { ?>
                          <option value="<?php echo $author_backup_file['name']; ?>"><?php echo $author_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="author-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#author-import-export-block', '<?php echo $export_author_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Search page block -->
                <div class="tab-pane fade" role="tabpanel" id="search-page-block">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-limit_post_on_search"><?php echo $text_limit_post_on_search; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['limit_post_on_search']; ?>" type="text" name="form_data[limit_post_on_search]" class="form-control" id="input-limit_post_on_search" />
                      <?php if (isset($error_limit_post_on_search)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_post_on_search; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label"><?php echo $text_dementions_of_post_image_on_search; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_width_on_search']; ?>" type="text" name="form_data[post_image_width_on_search]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <div class="special-margin"></div>
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                        <input value="<?php echo $form_data['post_image_height_on_search']; ?>" type="text" name="form_data[post_image_height_on_search]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <?php if (isset($error_post_image_width_on_search)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_width_on_search; ?></div>
                      <?php } ?>
                      <?php if (isset($error_post_image_height_on_search)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_post_image_height_on_search; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_main_image; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_description; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_description_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_description_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_description_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_description_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required description-limit-block">
                    <label class="col-sm-2 control-label" for="input-description_limit"><?php echo $entry_description_limit; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['description_limit_on_search']; ?>" type="text" name="form_data[description_limit_on_search]" class="form-control" />
                      <div class="modal-error-block" id="modal-error-description-limit-on-search"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_viewed; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_viewed_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_viewed_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_viewed_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_viewed_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_count_comments; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_count_comments_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_count_comments_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_count_comments_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_count_comments_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_author; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_author_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_author_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_author_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_author_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_read_more_button; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_read_more_button_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_read_more_button_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_read_more_button_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_read_more_button_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_image; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_image_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_image_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_image_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_image_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_date_added; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_date_added_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_date_added_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_date_added_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_date_added_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_pagination_results; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_pagination_results_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_pagination_results_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_pagination_results_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_pagination_results_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_disaply_view; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_disaply_view_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_disaply_view_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_disaply_view_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_disaply_view_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_limit; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_limit_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_limit_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_limit_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_limit_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_sort; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_sort_on_search'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_search]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_search'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_sort_on_search'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_sort_on_search]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_sort_on_search'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group sort-method-block">
                    <label class="col-sm-2 control-label"><?php echo $text_sort_method; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[sort_method_on_search]" class="form-control">
                        <option value=""><?php echo $text_make_a_choice; ?></option>
                        <option value="1" id="sort-method-option-1" <?php echo $form_data['sort_method_on_search'] == 1 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_1; ?></option>
                        <option value="2" id="sort-method-option-2" <?php echo $form_data['sort_method_on_search'] == 2 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_2; ?></option>
                        <option value="3" id="sort-method-option-3" <?php echo $form_data['sort_method_on_search'] == 3 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_3; ?></option>
                        <option value="4" id="sort-method-option-4" <?php echo $form_data['sort_method_on_search'] == 4 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_4; ?></option>
                        <option value="5" id="sort-method-option-5" <?php echo $form_data['sort_method_on_search'] == 5 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_5; ?></option>
                        <option value="6" id="sort-method-option-6" <?php echo $form_data['sort_method_on_search'] == 6 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_6; ?></option>
                        <option value="7" id="sort-method-option-7" <?php echo $form_data['sort_method_on_search'] == 7 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_7; ?></option>
                        <option value="8" id="sort-method-option-8" <?php echo $form_data['sort_method_on_search'] == 8 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_8; ?></option>
                        <option value="9" id="sort-method-option-9" <?php echo $form_data['sort_method_on_search'] == 9 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_9; ?></option>
                        <option value="10" id="sort-method-option-10" <?php echo $form_data['sort_method_on_search'] == 10 ? 'selected="selected"' : ''; ?> ><?php echo $text_sort_method_10; ?></option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- TAB Saved comments -->
                <div class="tab-pane fade" role="tabpanel" id="comment-constructor-block">
                  <div id="history-comment"></div>
                </div>
                <!-- TAB Comment list setting -->
                <div class="tab-pane fade" role="tabpanel" id="comment-list-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_show_comment; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['show_comment'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_comment]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['show_comment'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['show_comment'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[show_comment]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['show_comment'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-limit_comment"><?php echo $text_limit_comment; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['limit_comment']; ?>" type="text" name="form_data[limit_comment]" class="form-control" id="input-limit_comment" />
                      <?php if (isset($error_limit_comment)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_limit_comment; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_comment_customer_groups_write; ?></label>
                    <div class="col-sm-10">
                      <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                      <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                      <?php } ?>
                      <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                        <?php $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                        <div class="checkbox">
                          <label>
                            <input
                              type="checkbox"
                              name="form_data[comment_customer_groups_write][]"
                              value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($form_data['comment_customer_groups_write']) && in_array($customer_group['customer_group_id'], $form_data['comment_customer_groups_write'])) ? 'checked' : ''; ?>
                            /> <?php echo $customer_group['name']; ?>
                          </label>
                        </div>
                        <?php $row++; ?>
                        <?php } ?>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                        <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                      </div>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_comment_customer_groups_write_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_comment_customer_groups_see; ?></label>
                    <div class="col-sm-10">
                      <?php $row_height = 55; $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                      <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                      <?php } ?>
                      <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                        <?php $row = 0; foreach ($all_customer_groups as $customer_group) { ?>
                        <div class="checkbox">
                          <label>
                            <input
                              type="checkbox"
                              name="form_data[comment_customer_groups_see][]"
                              value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo (!empty($form_data['comment_customer_groups_see']) && in_array($customer_group['customer_group_id'], $form_data['comment_customer_groups_see'])) ? 'checked' : ''; ?>
                            /> <?php echo $customer_group['name']; ?>
                          </label>
                        </div>
                        <?php $row++; ?>
                        <?php } ?>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').trigger('click').attr('checked', true);"><?php echo $text_select_all; ?></button>
                        <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                      </div>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_comment_customer_groups_see_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_captcha_status; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['captcha_status'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[captcha_status]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['captcha_status'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['captcha_status'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[captcha_status]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['captcha_status'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_captcha_status_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-captcha_site_key"><?php echo $text_captcha_site_key; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input value="<?php echo $form_data['captcha_site_key']; ?>" type="text" name="form_data[captcha_site_key]" class="form-control" id="input-captcha_site_key" />
                      </div>
                      <?php if (isset($error_captcha_site_key)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_captcha_site_key; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-captcha_secret_key"><?php echo $text_captcha_secret_key; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input value="<?php echo $form_data['captcha_secret_key']; ?>" type="text" name="form_data[captcha_secret_key]" class="form-control" id="input-captcha_secret_key" />
                      </div>
                      <?php if (isset($error_captcha_secret_key)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_captcha_secret_key; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_comment_select_terms; ?></label>
                    <div class="col-sm-10">
                      <select name="form_data[comment_require_information]" class="form-control">
                        <option value=""><?php echo $text_no; ?></option>
                        <?php foreach ($all_informations as $information) { ?>
                          <option value="<?php echo $information['information_id']; ?>" <?php echo (!empty($form_data['comment_require_information']) && $form_data['comment_require_information'] == $information['information_id']) ? 'selected' : ''; ?>><?php echo $information['title']; ?></option>
                        <?php } ?>
                      </select>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $text_comment_select_terms_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_comment_premoderation; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['comment_premoderation'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[comment_premoderation]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['comment_premoderation'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['comment_premoderation'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[comment_premoderation]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['comment_premoderation'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-admin_nickname"><?php echo $text_admin_nickname; ?></label>
                    <div class="col-sm-10">
                      <input value="<?php echo $form_data['admin_nickname']; ?>" type="text" name="form_data[admin_nickname]" class="form-control" id="input-admin_nickname" />
                      <?php if (isset($error_admin_nickname)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_admin_nickname; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-admin_email"><?php echo $text_admin_email; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input value="<?php echo $form_data['admin_email']; ?>" type="text" name="form_data[admin_email]" class="form-control" id="input-admin_email" />
                      </div>
                      <?php if (isset($error_admin_email)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_admin_email; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-admin_icon"><?php echo $text_admin_icon; ?></label>
                    <div class="col-sm-10">
                      <a href="" id="thumb-admin_icon" data-toggle="image" class="img-thumbnail">
                        <img src="<?php echo $admin_icon_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                      </a>
                      <input type="hidden" name="form_data[admin_icon]" value="<?php echo $form_data['admin_icon']; ?>" id="input-admin_icon" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-admin_icon"><?php echo $text_user_icon; ?></label>
                    <div class="col-sm-10">
                      <a href="" id="thumb-user_icon" data-toggle="image" class="img-thumbnail">
                        <img src="<?php echo $user_icon_image; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                      </a>
                      <input type="hidden" name="form_data[user_icon]" value="<?php echo $form_data['user_icon']; ?>" id="input-user_icon" />
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label"><?php echo $text_dementions_of_icon_image; ?></label>
                    <div class="col-sm-10">
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_width_indicator; ?></span>
                        <input value="<?php echo $form_data['icon_image_width']; ?>" type="text" name="form_data[icon_image_width]" class="form-control" placeholder="<?php echo $text_image_width_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <div class="special-margin"></div>
                      <div class="input-group">
                        <span class="input-group-addon"><?php echo $text_height_indicator; ?></span>
                        <input value="<?php echo $form_data['icon_image_height']; ?>" type="text" name="form_data[icon_image_height]" class="form-control" placeholder="<?php echo $text_image_height_ph; ?>" />
                        <span class="input-group-addon"><?php echo $text_px; ?></span>
                      </div>
                      <?php if (isset($error_icon_image_width)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_icon_image_width; ?></div>
                      <?php } ?>
                      <?php if (isset($error_icon_image_height)) { ?>
                        <div class="alert alert-danger text-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_icon_image_height; ?></div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_warning_dementions_of_icon_image; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_comment_icon_status; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['comment_icon_status'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[comment_icon_status]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['comment_icon_status'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['comment_icon_status'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[comment_icon_status]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['comment_icon_status'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_allow_notification_on_respond; ?></label>
                    <div class="col-sm-10">
                      <div class="btn-group btn-toggle" data-toggle="buttons">
                        <label class="btn <?php echo $form_data['allow_notification_on_respond'] == 1 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[allow_notification_on_respond]"
                            value="1"
                            autocomplete="off"
                            <?php echo $form_data['allow_notification_on_respond'] == 1 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_yes; ?>
                        </label>
                        <label class="btn <?php echo $form_data['allow_notification_on_respond'] == 0 ? 'active btn-success' : 'btn-default'; ?>">
                          <input type="radio"
                            name="form_data[allow_notification_on_respond]"
                            value="0"
                            autocomplete="off"
                            <?php echo $form_data['allow_notification_on_respond'] == 0 ? 'checked="checked"' : ''; ?>
                          /><?php echo $text_no; ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_email_template_by_default; ?></label>
                    <div class="col-sm-10">
                      <?php if ($templates) { ?>
                      <?php $row_height = 55; $row = 0; foreach ($templates as $template) { ?>
                      <?php if ($row < 5) { $row_height = $row_height*1.26; } $row++; ?>
                      <?php } ?>
                      <div class="well well-sm" style="height: <?php echo $row_height; ?>px; overflow: auto;">
                        <?php foreach ($templates as $template) { ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="form_data[email_template_by_default]" value="<?php echo $template['template_id']; ?>" <?php echo (isset($form_data['email_template_by_default']) && $form_data['email_template_by_default'] == $template['template_id']) ? 'checked' : ''; ?> /> <?php echo $template['name']; ?> <b><a style="cursor:pointer;" onclick="open_email_template({id: '<?php echo $template['template_id']; ?>'});">[<?php echo $text_edit_template; ?>]</a></b>
                          </label>
                        </div>
                        <?php } ?>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs" onclick="$(this).parent().parent().find(':radio').attr('checked', false);"><?php echo $text_unselect_all; ?></button>
                      </div>
                      <?php } else { ?>
                        <div class="well well-sm" style="height: 69.3px; overflow: auto;">
                        <?php echo $text_no_templates; ?>
                        </div>
                      <?php } ?>
                      <div class="alert alert-info" role="alert"><?php echo $text_email_template_by_default_faq; ?></div>
                    </div>
                  </div>
                </div>
                <!-- TAB Import/Export comment block -->
                <div class="tab-pane fade" role="tabpanel" id="comment-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="comment_import" style="display:none;" id="comment-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#comment-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="comment_load_file_mask" id="comment-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="comment-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="comment_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($comment_backup_files) { ?>
                          <?php foreach ($comment_backup_files as $comment_backup_file) { ?>
                          <option value="<?php echo $comment_backup_file['name']; ?>"><?php echo $comment_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="comment-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#comment-import-export-block', '<?php echo $export_comment_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Import/Export vote block -->
                <div class="tab-pane fade" role="tabpanel" id="vote-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="vote_import" style="display:none;" id="vote-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#vote-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="vote_load_file_mask" id="vote-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="vote-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="vote_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($vote_backup_files) { ?>
                          <?php foreach ($vote_backup_files as $vote_backup_file) { ?>
                          <option value="<?php echo $vote_backup_file['name']; ?>"><?php echo $vote_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="vote-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#vote-import-export-block', '<?php echo $export_vote_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Banned list setting -->
                <div class="tab-pane fade" role="tabpanel" id="banned-constructor-block">
                  <div id="history-banned"></div>
                </div>
                <!-- TAB Import/Export banned block -->
                <div class="tab-pane fade" role="tabpanel" id="banned-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="banned_import" style="display:none;" id="banned-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#banned-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="banned_load_file_mask" id="banned-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="banned_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($banned_backup_files) { ?>
                          <?php foreach ($banned_backup_files as $banned_backup_file) { ?>
                          <option value="<?php echo $banned_backup_file['name']; ?>"><?php echo $banned_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#banned-import-export-block', '<?php echo $export_banned_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Email template constructor block -->
                <div class="tab-pane fade" role="tabpanel" id="email-template-constructor-block">
                  <div id="history-email-template"></div>
                </div>
                <!-- TAB Import/Export email template block -->
                <div class="tab-pane fade" role="tabpanel" id="email-template-import-export-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_external_file; ?></label>
                    <div class="col-sm-5">
                      <input type="file" name="email_template_import" style="display:none;" id="email-template-load-file" />
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="button" onclick="$('#email-template-load-file').click();"><?php echo $text_select_file; ?></button>
                        </span>
                        <input type="text" name="email_template_load_file_mask" id="email-template-load-file-mask" class="form-control">
                        <span class="input-group-btn">
                          <button id="email-template-button-import-file-1" type="submit" formaction="<?php echo $action_plus; ?>" form="form" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_restore_from_local_file; ?></label>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <select name="email_template_backup_file_name" class="form-control">
                          <option value=""><?php echo $text_make_a_choice; ?></option>
                          <?php if ($email_template_backup_files) { ?>
                          <?php foreach ($email_template_backup_files as $email_template_backup_file) { ?>
                          <option value="<?php echo $email_template_backup_file['name']; ?>"><?php echo $email_template_backup_file['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <span class="input-group-btn">
                          <button id="email-template-button-import-file-2" type="button" class="btn btn-primary" disabled="disabled"><i class="fa fa-download"></i> <?php echo $button_import; ?></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_export; ?></label>
                    <div class="col-sm-5">
                      <a onclick="make_export_action(this, '#email-template-import-export-block', '<?php echo $export_email_template_settings_button; ?>');" class="btn btn-primary"><i class="fa fa-upload"></i> <?php echo $button_export; ?></a>
                    </div>
                  </div>
                </div>
                <!-- TAB Support General block -->
                <div class="tab-pane fade" role="tabpanel" id="support-general-block">
                  <?php if (isset($support_info['general'])) { ?>
                    <?php echo $support_info['general']; ?>
                  <?php } else { ?>
                    <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> <?php echo $error_data_load_error; ?></div>
                  <?php } ?>
                </div>
                <!-- TAB Support Extension block -->
                <div class="tab-pane fade" role="tabpanel" id="support-extension-block">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_license_text; ?></label>
                    <div class="col-sm-10">
                      <p style="margin-top: 9px;"><?php echo $license_type; ?></p>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_license_text_faq; ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_license_holder; ?></label>
                    <div class="col-sm-10">
                      <p style="margin-top: 9px;"><?php echo $license_holder; ?></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_license_expires; ?></label>
                    <div class="col-sm-10">
                      <p style="margin-top: 9px;"><?php echo $license_expire; ?> <?php if ($license_expire_status == 0) { ?><i class="fa fa-refresh fa-spin fa-fw"></i> <b><a href="http://help.ocdevwizard.com" target="_blank">[<?php echo $text_renew_my_license; ?>]</a></b><?php } ?></p>
                      <?php if ($license_expire_status == 0) { ?>
                      <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_license_expires_faq_0; ?></div>
                      <?php } elseif ($license_expire_status == 1) { ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_license_expires_faq_1; ?></div>
                      <?php } elseif ($license_expire_status == 2) { ?>
                      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> <?php echo $text_license_expires_faq_2; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php if ($products) { ?>
                  <?php foreach ($products as $product) { ?>
                  <?php if ($product['short_name'] == $_code) { ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_installed_module_name; ?></label>
                    <div class="col-sm-10">
                      <p style="margin-top: 9px;"><i class="fa fa-external-link"></i> <a href="<?php echo $product['url']; ?>" target="_blank"><?php echo $product['title']; ?></a></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_installed_module_version; ?></label>
                    <div class="col-sm-10">
                      <?php $_tmp_module_version = version_compare($_version, $product['latest_version']); ?>
                      <p style="margin-top: 9px;"><?php echo $_version; ?> <?php if ($_tmp_module_version == "-1") { ?><i class="fa fa-refresh fa-spin fa-fw"></i> <b><a href="<?php echo $product['url']; ?>" target="_blank">[<?php echo $text_new_module_version; ?> <?php echo $product['latest_version']; ?>]</a></b><?php } ?></p>
                    </div>
                  </div>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $text_opencart_version; ?></label>
                    <div class="col-sm-10">
                      <p style="margin-top: 9px;"><?php echo $opencart_version; ?></p>
                    </div>
                  </div>
                </div>
                <!-- TAB Support General block -->
                <div class="tab-pane fade" role="tabpanel" id="support-terms-block">
                  <?php if (isset($support_info['terms'])) { ?>
                    <?php echo $support_info['terms']; ?>
                  <?php } else { ?>
                    <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> <?php echo $error_data_load_error; ?></div>
                  <?php } ?>
                </div>
                <!-- TAB Support Faq block -->
                <div class="tab-pane fade" role="tabpanel" id="support-faq-block">
                  <?php if (isset($support_info['faq'])) { ?>
                    <?php echo $support_info['faq']; ?>
                  <?php } else { ?>
                    <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> <?php echo $error_data_load_error; ?></div>
                  <?php } ?>
                </div>
                <!-- TAB OCdev Products -->
                <div class="tab-pane fade" role="tabpanel" id="promo-block">
                  <?php if ($products) { ?>
                  <div class="row">
                    <?php foreach ($products as $product) { ?>
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                      <button type="button" class="thumbnail" data-promo-product-id="<?php echo $product['extension_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_read_more; ?>" >
                        <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['title']; ?>" width="100%" />
                      </button>
                    </div>
                    <?php } ?>
                  </div>
                  <?php } else { ?>
                  <div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> <?php echo $error_data_load_error; ?></div>
                  <?php } ?>
                </div>
              </div>
              <div>
                <input type="hidden" style="display:none;" name="<?php echo $_name; ?>_license" value="<?php echo $license_key; ?>" />
                <input type="hidden" style="display:none;" name="form_data[front_module_name]" value="<?php echo $heading_title; ?>" />
                <input type="hidden" style="display:none;" name="form_data[front_module_version]" value="<?php echo $_version; ?>" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- start: code for tab OCdev products -->
<script>
$(document).delegate('button[data-promo-product-id]', 'click', function(e) {
  e.preventDefault();

  $('#modal-promo-product').remove();

  var element = this;

  $(element).tooltip('hide');

  $.ajax({
    url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/get_promo_products&<?php echo $token; ?>&extension_id='+$(element).attr('data-promo-product-id'),
    type: 'get',
    dataType: 'json',
    success: function(json) {
      html = '';
      if (json['product']) {
        html += '<div id="modal-promo-product" class="modal fade">';
        html += '  <div class="modal-dialog modal-mf" style="max-width:450px;">';
        html += '    <div class="modal-content">';
        html += '      <div class="modal-header">';
        html += '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>';
        html += '        <h4 class="modal-title" id="myModalLabel">'+json['product']['title']+'</h4>';
        html += '      </div>';
        html += '      <div class="modal-body">';
        html += '        <div role="tabpanel">';
        html += '          <ul class="nav nav-tabs" role="tablist">';
        html += '            <li class="active"><a href="#modal-info" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo $tab_modal_info; ?></a></li>';
        html += '            <li><a href="#modal-opencart-version" data-toggle="tab"><i class="fa fa-check-circle"></i> <?php echo $tab_modal_for_opencart; ?></a></li>';
        html += '            <li><a href="#modal-features" data-toggle="tab"><i class="fa fa-star"></i> <?php echo $tab_modal_features; ?></a></li>';
        html += '          </ul>';
        html += '          <div class="tab-content">';
        html += '            <div class="tab-pane active" id="modal-info">';
        html += '              <ul class="list-group">';
        html += '                <li class="list-group-item"><?php echo $text_modal_price; ?> <b class="pull-right">'+json['product']['price']+'</b></li>';
        html += '                <li class="list-group-item"><?php echo $text_modal_date_added; ?> <b class="pull-right">'+json['product']['date_added']+'</b></li>';
        html += '                <li class="list-group-item"><?php echo $text_modal_latest_version; ?> <b class="pull-right">'+json['product']['latest_version']+'</b></li>';
        html += '              </ul>';
        html += '            </div>';
        html += '            <div class="tab-pane" id="modal-opencart-version">';
        html += '              <ul class="list-group">';
        html += '                <li class="list-group-item">';
        html += '                  <div class="row">';
                                   $.each(json['opencart_version_array'], function(i,value) {
        html += '                    <div class="col-xs-6 col-md-2 col-sm-3">'+value+'</div>';
                                   });
        html += '                  </div>';
        html += '                </li>';
        html += '              </ul>';
        html += '            </div>';
        html += '            <div class="tab-pane" id="modal-features">';
        html += '              <ul class="list-group">';
        html += '                <li class="list-group-item">';
        html += '                  <div class="row">';
                                   $.each(json['opencart_features_array'], function(i,value) {
        html += '                    <div class="col-xs-12 col-md-12 col-sm-12">'+value+'</div>';
                                   });
        html += '                  </div>';
        html += '                </li>';
        html += '              </ul>';
        html += '            </div>';
        html += '          </div>';
        html += '        </div>';
        html += '        <a href="'+json['product']['url']+'" target="_blank" class="btn btn-primary" style="width:100%;"><i class="fa fa-external-link"></i> <?php echo $button_visit_sales_page; ?></a>';
        html += '      </div>  ';
        html += '    </div';
        html += '  </div>';
        html += '</div>';
      }
      
      $('body').append(html);

      $('#modal-promo-product').modal('show'); 
    }
  });
});
</script>
<!-- end: code for tab OCdev products -->
<!-- start: code for tab CSS setting -->
<script>
var codemirror = CodeMirror.fromTextArea(document.querySelector('#edit-css-block-0'), {
  mode : "css",
  height: '500px',
  lineNumbers: true,
  autofocus: true,
  theme: 'monokai',
  lineWrapping: true
});

var codemirror2 = CodeMirror.fromTextArea(document.querySelector('#edit-css-block-1'), {
  mode : "css",
  height: '500px',
  lineNumbers: true,
  autofocus: true,
  theme: 'monokai',
  lineWrapping: true
});

$('a[href=\'#css-block\']').on('click', function() {
  setTimeout(function() {
    $(this).click();
    codemirror.refresh();
    codemirror2.refresh();
  }, 500);
});

function save_css(id, stylesheet) {
  if (id == '0') {
    var codemirror_code = codemirror;
  } else {
    var codemirror_code = codemirror2;
  }
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/save_css&<?php echo $token; ?>',
    data: 'code='+encodeURIComponent(codemirror_code.getValue())+'&stylesheet='+stylesheet,
    dataType: 'json',
    success: function(json) {
      if (json['error']) {
        $('#result-css-block-'+id).html('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
      if (json['success']) {
        $('#result-css-block-'+id).html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function restore_css(id, stylesheet, stylesheet_default) {
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/restore_css&<?php echo $token; ?>',
    data: 'stylesheet='+stylesheet+'&stylesheet_default='+stylesheet_default,
    dataType: 'json',
    success: function(json) {
      if (json['error']) {
        $('#result-css-block-'+id).html('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
      if (json['success']) {
        $('#result-css-block-'+id).html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
}
</script>
<!-- end: code for tab CSS setting -->
<!-- start: code for tab Language setting -->
<script>
function texteditor_action({id = '', destroy = false, start = true} = {}) {
  if (start) {
    $(id).summernote({focus: true});

    $(id).parent().next().find('button:eq(1)').show();

    if ($(id).summernote('isEmpty')) {
      $(id).val('');
    }
  }

  if (destroy) {
    $(id).summernote('destroy');
    $(id).parent().next().find('button:eq(1)').hide();
  }
}
</script>
<!-- end: code for tab Language setting -->
<!-- start: code for tab Module constructor setting -->
<script>
$(function() {
  if ($('#module-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>');
  }
});

function submit_module(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-module-constructor input[type=\'text\'], #modal-module-constructor input[type=\'hidden\'], #modal-module-constructor input[type=\'radio\']:checked, #modal-module-constructor input[type=\'checkbox\']:checked, #modal-module-constructor select, #modal-module-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-module-constructor-content .alert-danger, #modal-module-constructor-content .alert-success').remove();
      $('#modal-module-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-module-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'module-description-language') {
            if (json['error'][i].length) {
              $('#modal-module-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#module-constructor-block]').click();
        $('#modal-module-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function module_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>';
  filter_data += '&filter_name=' + encodeURIComponent($('#history-module input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-module input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-module input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-module select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-module table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-module table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-module', function() {
  module_filter();
});

$(document).on('click', '#clear-filter-module', function() {
  $('#history-module input[name=\'filter_name\']').val('');
  $('#history-module input[name=\'filter_date_added\']').val('');
  $('#history-module input[name=\'filter_date_modified\']').val('');
  $('#history-module select[name=\'filter_status\']').val('*');

  module_filter();
});

$('#history-module').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_name=' + encodeURIComponent($('#history-module input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-module input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-module input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-module select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-module table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-module table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#module-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#module-constructor-block').find('li.active span').length ? $('#module-constructor-block').find('li.active span').html() : '1');
  $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>'+page);
  $('#module-constructor-block .alert, #module-constructor-block .text-danger').remove();
});

function open_module({id = 0} = {}) {
  html = '';

  html += '<div id="modal-module-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-module-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-module-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module&<?php echo $token; ?>&module_id='+id);
  } else {
    $('#modal-module-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module&<?php echo $token; ?>');
  }

  $('#modal-module-constructor').modal('show');
}
</script>
<!-- end: code for tab Module constructor setting -->
<!-- start: code for tab Category constructor setting -->
<script>
$(function() {
  if ($('#category-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>');
  }
});

function submit_category(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-category-constructor input[type=\'text\'], #modal-category-constructor input[type=\'hidden\'], #modal-category-constructor input[type=\'radio\']:checked, #modal-category-constructor input[type=\'checkbox\']:checked, #modal-category-constructor select, #modal-category-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-category-constructor-content .alert-danger, #modal-category-constructor-content .alert-success').remove();
      $('#modal-category-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-category-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'category-description-language') {
            if (json['error'][i].length) {
              $('#modal-category-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else if (i.replace(/_/g, '-') == 'keyword') {
            if (json['error'][i].length) {
              $('#modal-category-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#category-constructor-block]').click();
        $('#modal-category-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function category_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>';
  filter_data += '&filter_name=' + encodeURIComponent($('#history-category input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-category input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-category input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-category select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-category table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-category table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-category', function() {
  category_filter();
});

$(document).on('click', '#clear-filter-category', function() {
  $('#history-category input[name=\'filter_name\']').val('');
  $('#history-category input[name=\'filter_date_added\']').val('');
  $('#history-category input[name=\'filter_date_modified\']').val('');
  $('#history-category select[name=\'filter_status\']').val('*');

  category_filter();
});

$('#history-category').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_name=' + encodeURIComponent($('#history-category input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-category input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-category input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-category select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-category table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-category table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#category-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#category-constructor-block').find('li.active span').length ? $('#category-constructor-block').find('li.active span').html() : '1');
  $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>'+page);
  $('#category-constructor-block .alert, #category-constructor-block .text-danger').remove();
});

function open_category({id = 0} = {}) {
  html = '';

  html += '<div id="modal-category-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-category-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-category-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category&<?php echo $token; ?>&category_id='+id);
  } else {
    $('#modal-category-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category&<?php echo $token; ?>');
  }

  $('#modal-category-constructor').modal('show');
}

$(document).delegate('a[data-toggle=\'image_category\']', 'click', function(e) {
  e.preventDefault();

  var element = this;

  $(element).popover({
    html: true,
    placement: 'right',
    trigger: 'manual',
    content: function() {
      return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
    }
  });

  $(element).popover('toggle');

  $('#button-image').on('click', function() {
    $('#modal-image').remove();

    $.ajax({
      url: 'index.php?route=common/filemanager&<?php echo $token; ?>&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
      dataType: 'html',
      beforeSend: function() {
        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $('#button-image').prop('disabled', true);
      },
      complete: function() {
        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
        $('#button-image').prop('disabled', false);
      },
      success: function(html) {
        $('body').append('<div id="modal-image" data-imgid="'+$(element).data('imgid')+'" class="modal">' + html + '</div>');

        $('#modal-image').modal('show');
      }
    });

    $(element).popover('hide');
  });

  $('#button-clear').on('click', function() {
    $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
    
    $(element).parent().find('input').attr('value', '');

    $(element).popover('hide');
  });
});
</script>
<!-- end: code for tab Category constructor setting -->
<!-- start: code for tab Post constructor setting -->
<script>
$(function() {
  if ($('#post-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>');
  }
});

function submit_post(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-post-constructor input[type=\'text\'], #modal-post-constructor input[type=\'hidden\'], #modal-post-constructor input[type=\'radio\']:checked, #modal-post-constructor input[type=\'checkbox\']:checked, #modal-post-constructor select, #modal-post-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-post-constructor-content .alert-danger, #modal-post-constructor-content .alert-success').remove();
      $('#modal-post-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-post-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'post-description-language') {
            if (json['error'][i].length) {
              $('#modal-post-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else if (i.replace(/_/g, '-') == 'keyword') {
            if (json['error'][i].length) {
              $('#modal-post-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#post-constructor-block]').click();
        $('#modal-post-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function post_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>';
  filter_data += '&filter_name=' + encodeURIComponent($('#history-post input[name=\'filter_name\']').val());
  filter_data += '&filter_category=' + encodeURIComponent($('#history-post input[name=\'filter_category\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-post input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-post input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_date_available=' + encodeURIComponent($('#history-post input[name=\'filter_date_available\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-post select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-post table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-post table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-post-form', function() {
  post_filter();
});

$(document).on('click', '#clear-filter-post-form', function() {
  $('#history-post input[name=\'filter_name\']').val('');
  $('#history-post input[name=\'filter_category\']').val('');
  $('#history-post input[name=\'filter_date_added\']').val('');
  $('#history-post input[name=\'filter_date_modified\']').val('');
  $('#history-post input[name=\'filter_date_available\']').val('');
  $('#history-post select[name=\'filter_status\']').val('*');

  post_filter();
});

$('#history-post').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_name=' + encodeURIComponent($('#history-post input[name=\'filter_name\']').val());
  filter_data += '&filter_category=' + encodeURIComponent($('#history-post input[name=\'filter_category\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-post input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-post input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_date_available=' + encodeURIComponent($('#history-post input[name=\'filter_date_available\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-post select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-post table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-post table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#post-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#post-constructor-block').find('li.active span').length ? $('#post-constructor-block').find('li.active span').html() : '1');
  $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>'+page);
  $('#post-constructor-block .alert, #post-constructor-block .text-danger').remove();
});

function open_post({id = 0} = {}) {
  html = '';

  html += '<div id="modal-post-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-post-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-post-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post&<?php echo $token; ?>&post_id='+id);
  } else {
    $('#modal-post-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post&<?php echo $token; ?>');
  }

  $('#modal-post-constructor').modal('show');
}

$(document).delegate('a[data-toggle=\'image_post\']', 'click', function(e) {
  e.preventDefault();

  var element = this;

  $(element).popover({
    html: true,
    placement: 'right',
    trigger: 'manual',
    content: function() {
      return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
    }
  });

  $(element).popover('toggle');

  $('#button-image').on('click', function() {
    $('#modal-image').remove();

    $.ajax({
      url: 'index.php?route=common/filemanager&<?php echo $token; ?>&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
      dataType: 'html',
      beforeSend: function() {
        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $('#button-image').prop('disabled', true);
      },
      complete: function() {
        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
        $('#button-image').prop('disabled', false);
      },
      success: function(html) {
        $('body').append('<div id="modal-image" data-imgid="'+$(element).data('imgid')+'" class="modal">' + html + '</div>');

        $('#modal-image').modal('show');
      }
    });

    $(element).popover('hide');
  });

  $('#button-clear').on('click', function() {
    $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
    
    $(element).parent().find('input').attr('value', '');

    $(element).popover('hide');
  });
});
</script>
<!-- end: code for tab Post constructor setting -->
<!-- start: code for tab Author constructor setting -->
<script>
$(function() {
  if ($('#author-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>');
  }
});

function submit_author(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-author-constructor input[type=\'text\'], #modal-author-constructor input[type=\'hidden\'], #modal-author-constructor input[type=\'radio\']:checked, #modal-author-constructor input[type=\'checkbox\']:checked, #modal-author-constructor select, #modal-author-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-author-constructor-content .alert-danger, #modal-author-constructor-content .alert-success').remove();
      $('#modal-author-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-author-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'author-description-language') {
            if (json['error'][i].length) {
              $('#modal-author-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else if (i.replace(/_/g, '-') == 'keyword') {
            if (json['error'][i].length) {
              $('#modal-author-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#author-constructor-block]').click();
        $('#modal-author-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function author_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>';
  filter_data += '&filter_name=' + encodeURIComponent($('#history-author input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-author input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-author input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-author select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-author table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-author table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-author-form', function() {
  author_filter();
});

$(document).on('click', '#clear-filter-author-form', function() {
  $('#history-author input[name=\'filter_name\']').val('');
  $('#history-author input[name=\'filter_date_added\']').val('');
  $('#history-author input[name=\'filter_date_modified\']').val('');
  $('#history-author select[name=\'filter_status\']').val('*');

  author_filter();
});

$('#history-author').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_name=' + encodeURIComponent($('#history-author input[name=\'filter_name\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-author input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-author input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-author select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-author table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-author table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#author-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#author-constructor-block').find('li.active span').length ? $('#author-constructor-block').find('li.active span').html() : '1');
  $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>'+page);
  $('#author-constructor-block .alert, #author-constructor-block .text-danger').remove();
});

function open_author({id = 0} = {}) {
  html = '';

  html += '<div id="modal-author-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-author-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-author-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author&<?php echo $token; ?>&author_id='+id);
  } else {
    $('#modal-author-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author&<?php echo $token; ?>');
  }

  $('#modal-author-constructor').modal('show');
}

$(document).delegate('a[data-toggle=\'image_author\']', 'click', function(e) {
  e.preventDefault();

  var element = this;

  $(element).popover({
    html: true,
    placement: 'right',
    trigger: 'manual',
    content: function() {
      return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
    }
  });

  $(element).popover('toggle');

  $('#button-image').on('click', function() {
    $('#modal-image').remove();

    $.ajax({
      url: 'index.php?route=common/filemanager&<?php echo $token; ?>&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
      dataType: 'html',
      beforeSend: function() {
        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $('#button-image').prop('disabled', true);
      },
      complete: function() {
        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
        $('#button-image').prop('disabled', false);
      },
      success: function(html) {
        $('body').append('<div id="modal-image" data-imgid="'+$(element).data('imgid')+'" class="modal">' + html + '</div>');

        $('#modal-image').modal('show');
      }
    });

    $(element).popover('hide');
  });

  $('#button-clear').on('click', function() {
    $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
    
    $(element).parent().find('input').attr('value', '');

    $(element).popover('hide');
  });
});
</script>
<!-- end: code for tab Author constructor setting -->
<!-- start: code for tab Saved comments -->
<script>
$(function() {
  if ($('#comment-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>');
  }
});

function submit_comment(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-comment-constructor input[type=\'text\'], #modal-comment-constructor input[type=\'hidden\'], #modal-comment-constructor input[type=\'radio\']:checked, #modal-comment-constructor input[type=\'checkbox\']:checked, #modal-comment-constructor select, #modal-comment-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-comment-constructor-content .alert-danger, #modal-comment-constructor-content .alert-success').remove();
      $('#modal-comment-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-comment-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'comment-description-language') {
            if (json['error'][i].length) {
              $('#modal-comment-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#comment-constructor-block]').click();
        $('#modal-comment-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function submit_comment_respond(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_respond_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-comment-constructor input[type=\'text\'], #modal-comment-constructor input[type=\'hidden\'], #modal-comment-constructor input[type=\'radio\']:checked, #modal-comment-constructor input[type=\'checkbox\']:checked, #modal-comment-constructor select, #modal-comment-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-comment-constructor-content .alert-danger, #modal-comment-constructor-content .alert-success').remove();
      $('#modal-comment-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-comment-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'comment-description-language') {
            if (json['error'][i].length) {
              $('#modal-comment-constructor-content .panel-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
        }
        $('a[href=#comment-constructor-block]').click();
        $('#modal-comment-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function comment_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>';
  filter_data += '&filter_firstname=' + encodeURIComponent($('#history-comment input[name=\'filter_firstname\']').val());
  filter_data += '&filter_email=' + encodeURIComponent($('#history-comment input[name=\'filter_email\']').val());
  filter_data += '&filter_post=' + encodeURIComponent($('#history-comment input[name=\'filter_post\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-comment input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-comment input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-comment select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-comment table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-comment table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-comment-form', function() {
  comment_filter();
});

$(document).on('click', '#clear-filter-comment-form', function() {
  $('#history-comment input[name=\'filter_firstname\']').val('');
  $('#history-comment input[name=\'filter_email\']').val('');
  $('#history-comment input[name=\'filter_post\']').val('');
  $('#history-comment input[name=\'filter_date_added\']').val('');
  $('#history-comment input[name=\'filter_date_modified\']').val('');
  $('#history-comment select[name=\'filter_status\']').val('*');

  comment_filter();
});

$('#history-comment').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_firstname=' + encodeURIComponent($('#history-comment input[name=\'filter_firstname\']').val());
  filter_data += '&filter_email=' + encodeURIComponent($('#history-comment input[name=\'filter_email\']').val());
  filter_data += '&filter_post=' + encodeURIComponent($('#history-comment input[name=\'filter_post\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-comment input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-comment input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-comment select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-comment table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-comment table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#comment-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#comment-constructor-block').find('li.active span').length ? $('#comment-constructor-block').find('li.active span').html() : '1');
  $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>'+page);
  $('#comment-constructor-block .alert, #comment-constructor-block .text-danger').remove();
});

function open_comment({id = 0} = {}) {
  html = '';

  html += '<div id="modal-comment-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-comment-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-comment-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment&<?php echo $token; ?>&comment_id='+id);
  } else {
    $('#modal-comment-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment&<?php echo $token; ?>');
  }

  $('#modal-comment-constructor').modal('show');
}

function respond_comment(id) {
  html = '';

  html += '<div id="modal-comment-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-comment-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  $('#modal-comment-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_respond&<?php echo $token; ?>&comment_id='+id);

  $('#modal-comment-constructor').modal('show');
}
</script>
<!-- end: code for tab Saved comments -->
<!-- start: code for tab Banned list -->
<script>
$(function() {
  if ($('#banned-constructor-block').hasClass('active')) {
    $('.bootstrap-datetimepicker-widget').remove();
    $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>');
  }
});

function submit_banned(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-banned input[type=\'text\'], #modal-banned input[type=\'hidden\'], #modal-banned input[type=\'radio\']:checked, #modal-banned input[type=\'checkbox\']:checked, #modal-banned select, #modal-banned textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-banned-content .alert-danger, #modal-banned-content .alert-success').remove();
      $('#modal-banned-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-banned-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#banned-constructor-block]').click();
        $('#modal-banned-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function banned_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>';
  filter_data += '&filter_ip=' + encodeURIComponent($('#history-banned input[name=\'filter_ip\']').val());
  filter_data += '&filter_email=' + encodeURIComponent($('#history-banned input[name=\'filter_email\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-banned input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-banned input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-banned select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-banned table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-banned table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-banned-form', function() {
  banned_filter();
});

$(document).on('click', '#clear-filter-banned-form', function() {
  $('#history-banned input[name=\'filter_ip\']').val('');
  $('#history-banned input[name=\'filter_email\']').val('');
  $('#history-banned input[name=\'filter_date_added\']').val('');
  $('#history-banned input[name=\'filter_date_modified\']').val('');
  $('#history-banned select[name=\'filter_status\']').val('*');

  banned_filter();
});

$('#history-banned').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_ip=' + encodeURIComponent($('#history-banned input[name=\'filter_ip\']').val());
  filter_data += '&filter_email=' + encodeURIComponent($('#history-banned input[name=\'filter_email\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-banned input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-banned input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-banned select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-banned table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-banned table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#banned-constructor-block]').on('click', function() {
  $('.bootstrap-datetimepicker-widget').remove();
  var page = '&page='+($('#banned-constructor-block').find('li.active span').length ? $('#banned-constructor-block').find('li.active span').html() : '1');
  $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>'+page);
  $('#banned-constructor-block .alert, #banned-constructor-block .text-danger').remove();
});

function open_banned({id = 0} = {}) {
  html = '';

  html += '<div id="modal-banned" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-banned-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-banned-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned&<?php echo $token; ?>&banned_id='+id);
  } else {
    $('#modal-banned-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned&<?php echo $token; ?>');
  }

  $('#modal-banned').modal('show');
}
</script>
<!-- end: code for tab Banned list -->
<!-- start: code for tab Email template constructor setting -->
<script>
$(function() {
  if ($('#email-template-constructor-block').hasClass('active')) {
    $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>');
  }
});

function submit_email_template(element, action) {
  $.ajax({
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_action&<?php echo $token; ?>',
    type: 'post',
    data: $('#modal-email-template-constructor input[type=\'text\'], #modal-email-template-constructor input[type=\'hidden\'], #modal-email-template-constructor input[type=\'radio\']:checked, #modal-email-template-constructor input[type=\'checkbox\']:checked, #modal-email-template-constructor select, #modal-email-template-constructor textarea'),
    dataType: 'json',
    success: function(json) {
      $('#modal-email-template-constructor-content .alert-danger, #modal-email-template-constructor-content .alert-success').remove();
      $('#modal-email-template-constructor-content .form-group').removeClass('has-error');

      if (json['error']) {
        for (i in json['error']) {
          if (i.replace(/_/g, '-') == 'warning') {
            $('#modal-email-template-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
          } else if (i.replace(/_/g, '-') == 'template-description-language') {
            if (json['error'][i].length) {
              $('#modal-email-template-constructor-content .panel-body').append('<div class="alert alert-danger" style="margin-bottom: 0px;"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            }

            for (b in json['error'][i]) {
              for (c in json['error'][i][b]) {
                $('#modal-error-'+i.replace(/_/g, '-')+'-'+b.replace(/_/g, '-')+'-'+c).append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i][b][c] + '</div>');
              }
            }
          } else {
            $('#modal-error-' + i.replace(/_/g, '-')).html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'][i] + '</div>');
            $('#modal-error-' + i.replace(/_/g, '-')).parent().parent().addClass('has-error');
          }
        }
      }

      if (json['success']) {
        if (action == 'add') {
          $(element).attr('disabled', true);
          $(element).next().show();
        }
        $('a[href=#email-template-constructor-block]').click();
        $('#modal-email-template-constructor-content > div > div >.panel-body').append('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    }
  });
}

function preview_email_template(template_id, language_id) {
  $('#modal-template').remove();
  
  $('[role=\'tooltip\']').tooltip('destroy');
  
  $.ajax({
    url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/preview_template&<?php echo $token; ?>&template_id='+template_id+'&language_id='+language_id,
    type: 'post',
    data: $('#modal-form input[type=\'text\'], #modal-form input[type=\'hidden\'], #modal-form select, #modal-form textarea'),
    dataType: 'json',
    success: function(json) {
      html = '';
      html += '<div id="modal-template" class="modal fade bs-example-modal-lg">';
      html += '  <div class="modal-dialog modal-lg">';
      html += '    <div class="modal-content">';
      html += '      <div class="modal-header">';
      html += '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>';
      html += '        <h4 class="modal-title" id="myModalLabel">'+json['name']+'</h4>';
      html += '      </div>';
      html += '      <div class="modal-body">'+json['template']+'</div>';
      html += '      <div class="modal-footer">';
      html += '        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><?php echo $button_close; ?></button>';
      html += '      </div>';
      html += '    </div>';
      html += '  </div>';
      html += '</div>';
      
      $('body').append(html);

      $('#modal-template').modal('show');
    }
  });
}

function email_template_filter() {
  filter_data = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>';
  filter_data += '&filter_heading=' + encodeURIComponent($('#history-email-template input[name=\'filter_heading\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-email-template input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-email-template input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-email-template select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-email-template table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-email-template table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
}

$(document).on('click', '#submit-filter-email-template-form', function() {
  email_template_filter();
});

$(document).on('click', '#clear-filter-email-template-form', function() {
  $('#history-email-template input[name=\'filter_heading\']').val('');
  $('#history-email-template input[name=\'filter_date_added\']').val('');
  $('#history-email-template input[name=\'filter_date_modified\']').val('');
  $('#history-email-template select[name=\'filter_status\']').val('*');

  email_template_filter();
});

$('#history-email-template').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  filter_data = this.href;
  filter_data += '&filter_heading=' + encodeURIComponent($('#history-email-template input[name=\'filter_heading\']').val());
  filter_data += '&filter_date_added=' + encodeURIComponent($('#history-email-template input[name=\'filter_date_added\']').val());
  filter_data += '&filter_date_modified=' + encodeURIComponent($('#history-email-template input[name=\'filter_date_modified\']').val());
  filter_data += '&filter_status=' + encodeURIComponent($('#history-email-template select[name=\'filter_status\']').val());

  $.ajax({
    url: filter_data,
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $('#history-email-template table.main-table-data > tbody').html($(data).find('table.main-table-data > tbody > *'));
      $('#history-email-template table.main-table-data > tfoot').html($(data).find('table.main-table-data > tfoot > *'));
    }
  });
});

$('a[href=#email-template-constructor-block]').on('click', function() {
  var page = '&page='+($('#email-template-constructor-block').find('li.active span').length ? $('#email-template-constructor-block').find('li.active span').html() : '1');
  $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>'+page);
  $('#email-template-constructor-block .alert, #email-template-constructor-block .text-danger').remove();
});

function open_email_template({id = 0} = {}) {
  html = '';

  html += '<div id="modal-email-template-constructor" class="modal fade">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div id="modal-email-template-constructor-list"></div>';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  if (id > 0) {
    $('#modal-email-template-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template&<?php echo $token; ?>&template_id='+id);
  } else {
    $('#modal-email-template-constructor-list').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template&<?php echo $token; ?>');
  }

  $('#modal-email-template-constructor').modal('show');
}
</script>
<!-- end: code for tab Email template constructor setting -->
<!-- start: code for tab Import/Export config setting -->
<script>
$('#config-load-file').change(function(){
  $('#config-load-file-mask').val($(this).val());
  $('#config-button-import-file-1').attr('disabled', false);
});

$('select[name=\'config_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#config-button-import-file-2').attr('disabled', false);
  } else {
    $('#config-button-import-file-2').attr('disabled', true);
  }
});

$('#config-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_config_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'config_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export config setting -->
<!-- start: code for tab Import/Export module setting -->
<script>
$('#module-load-file').change(function(){
  $('#module-load-file-mask').val($(this).val());
  $('#module-button-import-file-1').attr('disabled', false);
});

$('select[name=\'module_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#module-button-import-file-2').attr('disabled', false);
  } else {
    $('#module-button-import-file-2').attr('disabled', true);
  }
});

$('#module-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_module_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'module_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export module setting -->
<!-- start: code for tab Import/Export category setting -->
<script>
$('#category-load-file').change(function(){
  $('#category-load-file-mask').val($(this).val());
  $('#category-button-import-file-1').attr('disabled', false);
});

$('select[name=\'category_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#category-button-import-file-2').attr('disabled', false);
  } else {
    $('#category-button-import-file-2').attr('disabled', true);
  }
});

$('#category-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_category_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'category_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export category setting -->
<!-- start: code for tab Import/Export post setting -->
<script>
$('#post-load-file').change(function(){
  $('#post-load-file-mask').val($(this).val());
  $('#post-button-import-file-1').attr('disabled', false);
});

$('select[name=\'post_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#post-button-import-file-2').attr('disabled', false);
  } else {
    $('#post-button-import-file-2').attr('disabled', true);
  }
});

$('#post-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_post_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'post_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export post setting -->
<!-- start: code for tab Import/Export author setting -->
<script>
$('#author-load-file').change(function(){
  $('#author-load-file-mask').val($(this).val());
  $('#author-button-import-file-1').attr('disabled', false);
});

$('select[name=\'author_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#author-button-import-file-2').attr('disabled', false);
  } else {
    $('#author-button-import-file-2').attr('disabled', true);
  }
});

$('#author-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_author_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'author_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export author setting -->
<!-- start: code for tab Import/Export comment setting -->
<script>
$('#comment-load-file').change(function(){
  $('#comment-load-file-mask').val($(this).val());
  $('#comment-button-import-file-1').attr('disabled', false);
});

$('select[name=\'comment_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#comment-button-import-file-2').attr('disabled', false);
  } else {
    $('#comment-button-import-file-2').attr('disabled', true);
  }
});

$('#comment-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_comment_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'comment_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export comment setting -->
<!-- start: code for tab Import/Export comment banned setting -->
<script>
$('#banned-load-file').change(function(){
  $('#banned-load-file-mask').val($(this).val());
  $('#button-import-file-1').attr('disabled', false);
});

$('select[name=\'banned_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#button-import-file-2').attr('disabled', false);
  } else {
    $('#button-import-file-2').attr('disabled', true);
  }
});

$('#button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_banned_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'banned_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export comment banned setting -->
<!-- start: code for tab Import/Export email template setting -->
<script>
$('#email-template-load-file').change(function(){
  $('#email-template-load-file-mask').val($(this).val());
  $('#email-template-button-import-file-1').attr('disabled', false);
});

$('select[name=\'email_template_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#email-template-button-import-file-2').attr('disabled', false);
  } else {
    $('#email-template-button-import-file-2').attr('disabled', true);
  }
});

$('#email-template-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_email_template_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'email_template_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export email template setting -->
<!-- start: code for tab Import/Export vote setting -->
<script>
$('#vote-load-file').change(function(){
  $('#vote-load-file-mask').val($(this).val());
  $('#vote-button-import-file-1').attr('disabled', false);
});

$('select[name=\'vote_backup_file_name\']').change(function(){
  if ($(this).val()) {
    $('#vote-button-import-file-2').attr('disabled', false);
  } else {
    $('#vote-button-import-file-2').attr('disabled', true);
  }
});

$('#vote-button-import-file-2').on('click', function(){
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/import_vote_settings&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    data: 'file_name='+$('select[name=\'vote_backup_file_name\']').val(),
    dataType: 'json',
    success: function(json) {
      if (json['success']) {
        $('#top-alerts').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        setTimeout(function() {
          location.reload();
        }, 2000);
      }
    }
  });
});
</script>
<!-- end: code for tab Import/Export vote setting -->
<script>
function delete_selected(type, id) {
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/delete_selected&<?php echo $token; ?>&type='+type+'&delete='+id,
    dataType: 'json',
    success: function(json) {
      hide_alerts();
      
      if (json['error']) {
        if (type == 'category') {
          $('#history-category').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      if (json['success']) {
        if (type == 'module') {
          $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>');
          $('#history-module').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>');
          $('#history-category').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>');
          $('#history-post').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>');
          $('#history-author').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>');
          $('#history-comment').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>');
          $('#history-banned').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>');
          $('#history-email-template').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      $('[role=\'tooltip\']').tooltip('destroy');
    }
  });
}

function delete_all(type) {
  $.ajax({
    type: 'get',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/delete_all&<?php echo $token; ?>&type='+type,
    dataType: 'json',
    success: function(json) {
      hide_alerts();
      
      if (json['error']) {
        if (type == 'module') {
          $('#history-module').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      if (json['success']) {
        if (type == 'module') {
          $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>');
          $('#history-module').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>');
          $('#history-category').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>');
          $('#history-post').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>');
          $('#history-author').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>');
          $('#history-comment').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>');
          $('#history-banned').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>');
          $('#history-email-template').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      $('[role=\'tooltip\']').tooltip('destroy');
    }
  });
}

function delete_all_selected(type) {
  if (type == 'module') {
    var checkbox_data = $('#history-module input[type=\'checkbox\']:checked');
  } else if (type == 'category') {
    var checkbox_data = $('#history-category input[type=\'checkbox\']:checked');
  } else if (type == 'post') {
    var checkbox_data = $('#history-post input[type=\'checkbox\']:checked');
  } else if (type == 'author') {
    var checkbox_data = $('#history-author input[type=\'checkbox\']:checked');
  } else if (type == 'comment') {
    var checkbox_data = $('#history-comment input[type=\'checkbox\']:checked');
  } else if (type == 'banned') {
    var checkbox_data = $('#history-banned input[type=\'checkbox\']:checked');
  } else if (type == 'email-template') {
    var checkbox_data = $('#history-email-template input[type=\'checkbox\']:checked');
  }

  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/delete_all_selected&<?php echo $token; ?>&type='+type,
    data: checkbox_data,
    dataType: 'json',
    success: function(json) {
      hide_alerts();
      
      if (json['error']) {
        if (type == 'module') {
          $('#history-module').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').before('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      if (json['success']) {
        if (type == 'module') {
          $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>');
          $('#history-module').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>');
          $('#history-category').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>');
          $('#history-post').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>');
          $('#history-author').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>');
          $('#history-comment').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>');
          $('#history-banned').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>');
          $('#history-email-template').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      $('[role=\'tooltip\']').tooltip('destroy');
    }
  });
}

function copy_selected(type, id) {
  $.ajax({
    type: 'post',
    url:  'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/copy_selected&<?php echo $token; ?>&copy='+id+'&type='+type,
    dataType: 'json',
    success: function(json) {
      hide_alerts();
      
      if (json['error']) {
        if (type == 'module') {
          $('#history-module').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+json['error']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      if (json['success']) {
        if (type == 'module') {
          $('#history-module').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_module_list&<?php echo $token; ?>');
          $('#history-module').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'category') {
          $('#history-category').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_category_list&<?php echo $token; ?>');
          $('#history-category').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'post') {
          $('#history-post').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_post_list&<?php echo $token; ?>');
          $('#history-post').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'author') {
          $('#history-author').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_author_list&<?php echo $token; ?>');
          $('#history-author').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'comment') {
          $('#history-comment').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_comment_list&<?php echo $token; ?>');
          $('#history-comment').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'banned') {
          $('#history-banned').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_banned_list&<?php echo $token; ?>');
          $('#history-banned').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        } else if (type == 'email-template') {
          $('#history-email-template').load('index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/history_email_template_list&<?php echo $token; ?>');
          $('#history-email-template').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+json['success']+' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }
      }
      $('[role=\'tooltip\']').tooltip('destroy');
    }
  });
}
</script>
<!-- start: code for module usability -->
<script>
if (window.localStorage && window.localStorage['last_active_tab']) {
  $('#setting-tabs a[href='+window.localStorage['last_active_tab']+']').trigger('click').addClass('list-group-item-warning').prepend('<i class="fa fa-chevron-right"></i>');
  $('body,html').animate({
    scrollTop: 0
  }, 800);
}

$('#setting-tabs a[data-toggle="tab"]').click(function() {
  if (window.localStorage) {
    window.localStorage['last_active_tab'] = $(this).attr('href');
  }
  $('#setting-tabs a[data-toggle="tab"]').removeClass('list-group-item-warning').find('i[class=\'fa fa-chevron-right\']').remove();
  $(this).addClass('list-group-item-warning').prepend('<i class="fa fa-chevron-right"></i>');
  $('body, html').animate({
    scrollTop: 0
  }, 800);
});

$('.btn-toggle').on('click', '.btn', function() {
  if(!$(this).hasClass('disabled')){
    $(this).addClass('btn-success').siblings().removeClass('btn-success').addClass('btn-default');
  }
});

$('.btn-toggle').on('click', '.disabled', function() {
  return false;
});

$('body').on('hidden.bs.modal', function () {
  if ($('.modal.in').length > 0) {
    $('body').addClass('modal-open');
  }
});

$(document).delegate('button[data-faq-target]', 'click', function(e) {
  e.preventDefault();

  $('#modal-faq').remove();

  var element = this;

  html  = '<div id="modal-faq" class="modal fade bs-example-modal-lg">';
  html += '  <div class="modal-dialog modal-lg">';
  html += '    <div class="modal-content">';
  html += '      <div class="modal-header">';
  html += '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>';
  html += '        <h4 class="modal-title" id="myModalLabel"><?php echo $text_preview_image; ?></h4>';
  html += '      </div>';
  html += '      <div class="modal-body">';
  html += '        <img src="http://images.ocdevwizard.com/<?php echo $_name; ?>/'+$(element).attr('data-faq-target')+'.gif" width="100%" />';
  html += '      </div>';
  html += '      <div class="modal-footer">';
  html += '        <a href="http://images.ocdevwizard.com/<?php echo $_name; ?>/'+$(element).attr('data-faq-target')+'.gif" class="btn btn-info" target="_blank"><?php echo $button_open_image_in_original_size; ?></a>';
  html += '      </div>';
  html += '    </div';
  html += '  </div>';
  html += '</div>';

  $('body').append(html);

  $('#modal-faq').modal('show');
});

function hide_alerts() {
  $('#email-template-constructor-block .alert, #email-template-constructor-block .text-danger, #form-constructor-block .alert, #form-constructor-block .text-danger, #campaign-constructor-block .alert, #campaign-constructor-block .text-danger').fadeOut(2000).remove();
}

function make_export_action(block, main_block, href) {
  location = href;
  
  $(block).removeClass('btn-success').addClass('btn-primary').html('<i class="fa fa-refresh fa-spin fa-fw"></i> <?php echo $text_processing; ?>');
  
  $.ajax({
    url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>&<?php echo $token; ?>&store_id=<?php echo $store_id; ?>',
    type: 'get',
    dataType: 'html',
    success: function(data) {
      $(block).addClass('btn-success').html('<i class="fa fa-check"></i> <?php echo $text_success_processing; ?>');
      $(main_block+' select').html($(data).find(main_block+' select option'));
      $(main_block+' select').next().find('button').removeAttr('disabled');
    }
  });
}

$(document).on('hidden.bs.modal', '#modal-category-constructor, #modal-post-constructor, #modal-author-constructor', function () {
  $('.modal.fade, .modal-backdrop.fade').remove();
});

$(document).on('hidden.bs.modal', '#modal-image', function () {
  $('#modal-image').remove();
});

function set_image(block, id, type) {
  $('#thumb-image'+id).find('img').attr('src', $(block).find('img').attr('src'));

	var sel = window.getSelection();
	
	if (sel.rangeCount) {
		$('#input-image'+id).val($(block).next().find('input').val());
	}
	
	$('#modal-'+type+'-constructor > img').remove();
	
	$('#modal-image').modal('hide');
}

$(function() {
  if ($('.pro-block').length) {
    $('.pro-block').each(function(index) {
      $(this).find('.control-label').append('<div class="clear"></div><div class="label label-info" style="text-transform: uppercase;"><?php echo $text_exclusive; ?></div>');
      // $(this).find('input[type=\'radio\'], input[type=\'checkbox\'], select, button').attr('disabled', true);
      // $(this).find('input[type=\'text\'], textarea').on('focus', function(){ alert('<?php echo $text_exclusive; ?>'); });
      // $(this).find('label').addClass('disabled');
      // $(this).addClass('pro-version-only');
    });
  }
});
</script>
<!-- end: code for module usability -->
<?php echo $footer; ?>