<div class="modal fade" id="prlogin-popup" data-remote="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel"><?php echo $heading_title; ?></h4>
            </div>

            <div class="modal-body">
                <div role="tabpanel" id="prlogin-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active">
                            <a href="#prlogin-tab-login" role="tab" data-toggle="tab">Вход</a>
                        </li>
                        <li>
                            <a href="#prlogin-tab-register" role="tab" data-toggle="tab">Регистрация</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                        <?php echo $ulogin_form_marker;?>
                    <div role="tabpanel" class="tab-pane active" id="prlogin-tab-login">
                           
                        <form id="prlogin-form-login" class="form-horizontal" method="post" action="<?php echo $action; ?>">
                            <div class="form-group required">
                                <label class="control-label col-sm-2"><?php echo $entry_email; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value=""
                                       placeholder="<?php echo $entry_email; ?>" class="form-control"/>
                                </div>
                            </div>
                            
                            <div class="form-group required">
                                <label class="control-label col-sm-2"><?php echo $entry_password; ?></label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value=""
                                       placeholder="<?php echo $entry_password; ?>" class="form-control"/>

                                    <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><?php echo $button_login; ?></button>
                        </form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="prlogin-tab-register">
                            
                        <form id="prlogin-form-register" class="form-horizontal" method="post" action="<?php echo $register; ?>">
                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_lastname; ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="lastname" value="" id="input-lastname"
                                       placeholder="<?php echo $entry_lastname; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_firstname; ?></label>

                                <div class="col-sm-8">
                                    <input type="text" name="firstname" value="" id="input-firstname"
                                           placeholder="<?php echo $entry_firstname; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_telephone; ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="telephone" value="" id="input-telephone"
                                           placeholder="<?php echo $entry_telephone; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_email; ?></label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="" id="input-email"
                                       placeholder="<?php echo $entry_email; ?>" class="form-control"/>
                                </div>
                            </div>

                            <?php foreach ($custom_fields as $custom_field) { ?>
                                <?php if ($custom_field['location'] == 'account') { ?>
                                    <?php if ($custom_field['type'] == 'select') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>">
                                                <?php echo $custom_field['name']; ?>:
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                        id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                        class="form-control">
                                                    <option value=""><?php echo $text_select; ?></option>
                                                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                                                        <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                                                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"
                                                                    selected="selected"><?php echo $custom_field_value['name']; ?></option>
                                                        <?php }
                                                        else { ?>
                                                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'radio') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <div>
                                                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                                                        <div class="radio">
                                                            <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $register_custom_field[$custom_field['custom_field_id']]) { ?>
                                                                <label>
                                                                    <input type="radio"
                                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                                           value="<?php echo $custom_field_value['custom_field_value_id']; ?>"
                                                                           checked="checked"/>
                                                                    <?php echo $custom_field_value['name']; ?></label>
                                                            <?php }
                                                            else { ?>
                                                                <label>
                                                                    <input type="radio"
                                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                                           value="<?php echo $custom_field_value['custom_field_value_id']; ?>"/>
                                                                    <?php echo $custom_field_value['name']; ?></label>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'checkbox') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <div>
                                                    <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                                                        <div class="checkbox">
                                                            <?php if (isset($register_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'],
                                                                                                                                                  $register_custom_field[$custom_field['custom_field_id']])
                                                            ) { ?>
                                                                <label>
                                                                    <input type="checkbox"
                                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]"
                                                                           value="<?php echo $custom_field_value['custom_field_value_id']; ?>"
                                                                           checked="checked"/>
                                                                    <?php echo $custom_field_value['name']; ?></label>
                                                            <?php }
                                                            else { ?>
                                                                <label>
                                                                    <input type="checkbox"
                                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>][]"
                                                                           value="<?php echo $custom_field_value['custom_field_value_id']; ?>"/>
                                                                    <?php echo $custom_field_value['name']; ?></label>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'text') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <input type="text"
                                                       name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                       value="<?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"
                                                       placeholder="<?php echo $custom_field['name']; ?>"
                                                       id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                       class="form-control"/>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'textarea') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <textarea name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                          rows="5"
                                                          placeholder="<?php echo $custom_field['name']; ?>"
                                                          id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                          class="form-control"><?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'file') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <button type="button"
                                                        id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                        data-loading-text="<?php echo $text_loading; ?>"
                                                        class="btn btn-default">
                                                    <i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                                                <input type="hidden"
                                                       name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                       value="<?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : ''); ?>"/>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'date') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input type="text"
                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                           value="<?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"
                                                           placeholder="<?php echo $custom_field['name']; ?>"
                                                           data-date-format="YYYY-MM-DD"
                                                           id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                           class="form-control"/>
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
                                                </div>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'time') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <div class="input-group time">
                                                    <input type="text"
                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                           value="<?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"
                                                           placeholder="<?php echo $custom_field['name']; ?>"
                                                           data-date-format="HH:mm"
                                                           id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                           class="form-control"/>
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
                                                </div>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($custom_field['type'] == 'datetime') { ?>
                                        <div id="custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                             class="form-group custom-field"
                                             data-sort="<?php echo $custom_field['sort_order']; ?>">
                                            <label class="col-sm-4 control-label"
                                                   for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>

                                            <div class="col-sm-8">
                                                <div class="input-group datetime">
                                                    <input type="text"
                                                           name="custom_field[<?php echo $custom_field['location']; ?>][<?php echo $custom_field['custom_field_id']; ?>]"
                                                           value="<?php echo(isset($register_custom_field[$custom_field['custom_field_id']]) ? $register_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>"
                                                           placeholder="<?php echo $custom_field['name']; ?>"
                                                           data-date-format="YYYY-MM-DD HH:mm"
                                                           id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"
                                                           class="form-control"/>
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
                                                </div>
                                                <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                                                    <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>

                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_password; ?></label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" value="" id="input-password"
                                       placeholder="<?php echo $entry_password; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="control-label col-sm-4"><?php echo $entry_confirm; ?></label>
                                <div class="col-sm-8">
                                    <input type="password" name="confirm" value="" id="input-confirm"
                                       placeholder="<?php echo $entry_confirm; ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">
                                    <?php echo $entry_newsletter; ?>
                                </label>
                                <div class="col-sm-6">
                                    <div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="newsletter" value="1" checked="checked"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($text_agree) { ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-6">
                                        <?php echo $text_agree; ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="agree" value="1" checked="checked"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <button type="submit" class="btn btn-primary"><?php echo $button_submit; ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>