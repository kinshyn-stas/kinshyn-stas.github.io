<?php if ($fields_data) { ?>
<!-- FIELDS DATA -->
  <div class="ocdev-smart-checkout-fields" >
    <?php foreach ($fields_data as $field) { ?>
      <?php if($field['type'] == 'textarea') { ?>
        <div <?php echo ($field['css_id']) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ($field['css_class']) ? $field['css_class'] : "" ; ?>" <?php echo ($field['activate'] == 2) ? 'style="display:none;"' : "" ; ?>>
          <textarea name="<?php echo $field['name']; ?>" placeholder="<?php echo $field['placeholder_text']; ?>"><?php echo $input_value[$field['name']]; ?></textarea>
        </div>
      <?php } elseif ($field['type'] == 'select') { ?>
        <div <?php echo ($field['css_id']) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ($field['css_class']) ? $field['css_class'] : "" ; ?>" <?php echo ($field['activate'] == 2) ? 'style="display:none;"' : "" ; ?>>
          <?php if($field['name'] == 'country_id') { ?>
          <select name="<?php echo $field['name']; ?>">
            <option value=""><?php echo $text_select; ?></option>
            <?php if ($countries) { ?>
              <?php foreach ($countries as $country) { ?>
                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <?php } elseif ($field['name'] == 'zone_id') { ?>
            <select name="zone_id"></select>
          <?php } else { ?>
            <select name="<?php echo $field['name']; ?>"></select>
          <?php } ?>
        </div>
      <?php } else { ?>
        <div <?php echo ($field['css_id']) ? 'id="'.$field['css_id'].'"' : "" ; ?> class="<?php echo $field['position'].' '; echo ($field['css_class']) ? $field['css_class'] : "" ; ?>" <?php echo ($field['activate'] == 2) ? 'style="display:none;"' : "" ; ?>>
          <input name="<?php echo $field['name']; ?>" value="<?php echo $input_value[$field['name']]; ?>" type="<?php echo $field['type']; ?>" placeholder="<?php echo $field['placeholder_text']; ?>" />
        </div>
      <?php } ?>
      <?php if ($field['mask']) { ?>
        <script type="text/javascript">
          $("#smch-modal-data [name='<?php echo $field['name']; ?>']").inputmask('<?php echo $field['mask']; ?>');
        </script>
      <?php } ?>
    <?php } ?>
  </div>
  <?php if ($informations) { ?>
    <div id="require-information"><?php echo $informations; ?> <input type="checkbox" name="require_information" value="<?php echo $require_information ? 1 : 0; ?>" /></div>
  <?php } ?>
  <?php if ($user_button_next) { ?>
  <button type="button" id="button-guest" onclick="smch_user();" class="next-step-button"><?php echo $user_button_next; ?> <i class="fa fa-chevron-circle-right"></i></button>
  <?php } ?>
<?php } ?>

<script type="text/javascript"><!--
<?php if ($countries) { ?>
$('#collapse-user-information select[name=\'country_id\']').on('change', function() {
  $.ajax({
    url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('#collapse-user-information select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(json) {
      html = '<option value=""><?php echo $text_select; ?></option>';

      if (json['zone'] && json['zone'] != '') {
        for (i = 0; i < json['zone'].length; i++) {
          html += '<option value="' + json['zone'][i]['zone_id'] + '"';
          <?php if (isset($zone_id)) { ?>
          if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
            html += ' selected="selected"';
          }
          <?php } ?>
          html += '>' + json['zone'][i]['name'] + '</option>';
        }
      } else {
        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
      }

      $('#collapse-user-information select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#collapse-user-information select[name=\'country_id\']').trigger('change');
<?php } ?>
//--></script>