<?= $header; ?><?= $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" data-toggle="tooltip" title="<?= $button_save; ?>" class="btn btn-primary submit-forms">
          <i class="fa fa-save"></i></button>
        <a href="<?= $cancel; ?>" data-toggle="tooltip" title="<?= $button_cancel; ?>" class="btn btn-default">
          <i class="fa fa-reply"></i></a>
      </div>
      <h1><?= $heading_title; ?></h1>
      <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li>
              <a href="<?= $breadcrumb['href']; ?>"><?= $breadcrumb['text']; ?></a>
            </li>
          <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div id="warning" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle"></i>
      <span></span>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div id="success" class="alert alert-success hidden"><i class="fa fa-exclamation-circle"></i>
      <span></span>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="alert alert-danger<?= $valid_license ? ' hidden' : '' ?>" id="alert-license">
      <i class="fa fa-exclamation-circle"></i> <?= $error_license; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="alert alert-danger<?= $exists_sxgeo ? ' hidden' : '' ?>" id="alert-sxgeo">
      <i class="fa fa-exclamation-circle"></i> <?= $error_sxgeo; ?>
      <a class="btn btn-primary" id="upload-sxgeo"><?= $text_sxgeo_upload ?></a>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="alert hidden" id="alert-sxgeo-status"></div>

    <ul id="tabs" class="nav nav-tabs">
      <li class="active">
        <a href="#tab-general" data-toggle="tab"><?= $tab_general; ?></a>
      </li>
      <li>
        <a href="#tab-popups" data-toggle="tab"><?= $tab_popup; ?></a>
      </li>
      <li>
        <a href="#tab-messages" data-toggle="tab"><?= $tab_messages; ?></a>
      </li>
      <li>
        <a href="#tab-redirects" data-toggle="tab"><?= $tab_redirects; ?></a>
      </li>
      <li>
        <a href="#tab-currencies" data-toggle="tab"><?= $tab_currencies; ?></a>
      </li>
      <li>
        <a id="tab-regions-btn" href="#tab-regions" data-toggle="tab"><?= $tab_regions; ?></a>
      </li>
      <li>
        <a href="#tab-customer-group" data-toggle="tab"><?= $tab_groups; ?></a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab-general">
          <?php include($module_dir . 'city_manager/general.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-popups">
          <?php include($module_dir . 'city_manager/popup.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-messages">
          <?php include($module_dir . 'city_manager/messages.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-redirects">
          <?php include($module_dir . 'city_manager/redirects.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-currencies">
          <?php include($module_dir . 'city_manager/currencies.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-regions">
          <?php include($module_dir . 'city_manager/zone_fias.tpl'); ?>
      </div>
      <div class="tab-pane" id="tab-customer-group">
          <?= $text_customer_groups_info; ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
    function savePopups() {
        var form = $('#tab-popups').find('form');
        form.find('.text-danger').remove();
        $.post(form.attr('action'), form.serialize(),
            function(json) {
                if (json.errors) {
                    for (i in json.errors.cities) {
                        $('#city-row' + i).find('input[name="popup_cities\[' + i + '\]\[name\]"]')
                            .after('<p class="text-danger">' + json.errors.cities[i] + '</p>');
                    }
                    $('#tabs').find('a[href="#tab-popups"]').tab('show');
                    return;
                }

                saveMessages();
            }, 'json');
    }

    function saveMessages() {
        var form = $('#tab-messages').find('form');
        form.find('.text-danger').remove();
        $.post(form.attr('action'), form.serialize(),
            function(json) {
                if (json.errors) {
                    for (i in json.errors.key) {
                        $('#message-row' + i).find('input[name="messages\[' + i + '\]\[key\]"]')
                            .after('<p class="text-danger">' + json.errors.key[i] + '</p>');
                    }
                    for (i in json.errors.fias) {
                        $('#message-row' + i).find('.row-fias-name').after('<p class="text-danger">' + json.errors.fias[i] + '</p>');
                    }
                    $('#tabs').find('a[href="#tab-messages"]').tab('show');
                    return;
                }

                saveRedirects();
            }, 'json');
    }

    function saveRedirects() {
        var form = $('#tab-redirects').find('form');
        form.find('.text-danger').remove();
        $.post(form.attr('action'), form.serialize(),
            function(json) {
                if (json.errors) {
                    for (i in json.errors.fias) {
                        $('#redirect-row' + i).find('.row-fias-name').after('<p class="text-danger">' + json.errors.fias[i] + '</p>');
                    }
                    for (i in json.errors.subdomain) {
                        $('#redirect-row' + i).find('input[name="redirects\[' + i + '\]\[url\]"]')
                            .after('<p class="text-danger">' + json.errors.subdomain[i] + '</p>');
                    }
                    $('#tabs').find('a[href="#tab-redirects"]').tab('show');
                    return;
                }

                saveCurrencies();
            }, 'json');
    }

    function saveCurrencies() {
        var form = $('#tab-currencies').find('form');
        form.find('.text-danger').remove();
        $.post(form.attr('action'), form.serialize(),
            function(json) {
                if (json.errors) {
                    for (i in json.errors.country) {
                        $('#currency-row' + i).find('select[name="currencies\[' + i + '\]\[country_id\]"]')
                            .after('<p class="text-danger">' + json.errors.country[i] + '</p>');
                    }
                    for (i in json.errors.code) {
                        $('#currency-row' + i).find('select[name="currencies\[' + i + '\]\[code\]"]')
                            .after('<p class="text-danger">' + json.errors.code[i] + '</p>');
                    }
                    $('#tabs').find('a[href="#tab-currencies"]').tab('show');
                    return;
                }

                saveRegions();
            }, 'json');
    }

    function saveRegions() {
        var form = $('#tab-regions').find('form');
        form.find('.text-danger').remove();
        $.post(form.attr('action'), form.serialize(),
            function(json) {
                if (json.errors) {
                    for (i in json.errors.country) {
                        $('#zone-fias-row' + i).find('.country-fias-country-id').after('<p class="text-danger">' + json.errors.country[i] + '</p>');
                    }
                    $('#tabs').find('a[href="#tab-regions"]').tab('show');
                    return;
                }

                $('#success').removeClass('hidden').find('span').text(json.success);
            }, 'json');
    }

    $(function() {
        $('.submit-forms').click(function() {
            if (!validate()) {
                return false;
            }
            $('#warning, #success').addClass('hidden').find('span').text('');
            var form = $('#tab-general').find('form');
            $.post(form.attr('action'), form.serialize() + '&' + $('.for-general-form :input').serialize(),
                function(json) {
                    if (json.warning) {
                        $('#warning').removeClass('hidden').find('span').text(json.warning);
                        $('#tabs').find('a[href="#tab-general"]').tab('show');
                        return;
                    }

                    if (json.license) {
                        $('#alert-license').addClass('hidden');
                    } else {
                        $('#alert-license').removeClass('hidden');
                    }

                    savePopups();
                }, 'json');
        });

        $('form').submit(function(e) {
            e.preventDefault();
        });

        $('#messages, #redirects, #tab-general').on('focus', '.row-fias-name', function() {
            if (!$(this).data('autocomplete')) {
                addAutocomplete($(this));
            }
        }).find('.row-fias-name').each(function() {
            addAutocomplete($(this));
        });

        $('#cities').on('focus', '.row-fias-name', function() {
            if (!$(this).data('autocomplete')) {
                addAutocomplete($(this), true);
            }
        }).find('.row-fias-name').each(function() {
            addAutocomplete($(this), true);
        });

        $('#upload-sxgeo').click(function() {
            if ($(this).data('disabled')) {
                return;
            }

            $(this).data('disabled', true);
            $('#alert-sxgeo-status').removeClass('hidden');
            sxgeo_step(0);
        });
    });

    var xhr;

    function addAutocomplete(el, short) {
        el.autocomplete({
            'source': function(request, response) {
                if (xhr) {
                    xhr.abort();
                }

                request = $.trim(request);
                if (request && request.length > 2) {
                    xhr = $.get(
                        '<?= $url_module; ?>/search&term=' + encodeURIComponent(request) + '&token=<?= $token; ?>&short=' + (short ? 1 : 0),
                        function(json) {
                            response(json);
                        },
                        'json'
                    );
                } else {
                    response([]);
                }
            },
            'select': function(item) {
                el.val(item.name);
                el.siblings('.row-fias-id').val(item.value);
            }
        });
        el.data('autocomplete', true);
    }

    function validate() {
        var c = {}, z = {}, bad = false, error = '<?= $error_unique_regions; ?>';
        $('#country-fias').find('.country-fias-country-id').each(function(i, el) {
            var val = $(this).val();
            if (val > 0) {
                if (c[val] != undefined) {
                    bad = true;
                    error += ' "' + $.trim($(this).parents('.row:first').find('div:first').text()) + '"';
                    return false;
                }
                c[val] = 1;
            }
        });
        if (!bad) {
            $('#zone-fias').find('.zone-fias-zone-id').each(function(i, el) {
                var val = $(this).val();
                if (val > 0) {
                    if (z[val] != undefined) {
                        bad = true;
                        error += ' "' + $.trim($(this).parents('.row:first').find('div:first').text()) + '"';
                        return false;
                    }
                    z[val] = 1;
                }
            });
        }

        if (bad) {
            $('#warning').removeClass('hidden').find('span').text(error);
            $('#tabs').find('a[href="#tab-regions"]').tab('show');
        }

        return !bad;
    }

    var sxgeo_steps = <?= json_encode($sxgeo_steps) ?>;

    function sxgeo_step(step) {
        var license = $('#license').val();
        if (!license) {
            $('#alert-sxgeo-status').text('<?= $text_license ?>');
            $('#upload-sxgeo').removeData('disabled');
            return;
        }

        $('#alert-sxgeo-status').text(sxgeo_steps[step]['text']);

        $.ajax({
            url: sxgeo_steps[step]['url'],
            type: 'get',
            data: {license: license},
            dataType: 'json',
            success: function(json) {
                if (json && json.success) {
                    step++;

                    if (sxgeo_steps[step]) {
                        sxgeo_step(step);
                    } else {
                        $('#alert-sxgeo-status').addClass('alert-success').html('<?= $text_sxgeo_upload_success ?>');
                        setTimeout(function() {
                            $('#alert-sxgeo-status, #alert-sxgeo').remove();
                        }, 3000);
                    }
                } else if (json && json.error) {
                    $('#alert-sxgeo-status').addClass('alert-danger').html(json.error + '<br><?= $text_sxgeo_manual_upload ?>');
                } else {
                    $('#alert-sxgeo-status').addClass('alert-danger').html('<?= $error_unknown, '<br>', $text_sxgeo_manual_upload ?>');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
//--></script>
<?= $footer; ?>
