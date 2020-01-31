<?php if ($options) { ?>
<!-- OPTIONS -->
  <?php foreach ($options as $option) { ?>
    <?php if ($option['type'] == 'select') { ?>
      <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
        <select onchange="reCalculate();" name="option[<?php echo $option['product_option_id']; ?>]" >
          <option value=""><?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?></option>
          <?php foreach ($option['product_option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
              <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
              <?php } ?>
            </option>
          <?php } ?>
        </select>
      </div>
    <?php } ?>
    <?php if ($option['type'] == 'text') { ?>
    <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
      <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" />
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'textarea') { ?>
    <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
      <textarea name="option[<?php echo $option['product_option_id']; ?>]" placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>"><?php echo $option['value']; ?></textarea>
    </div>
    <?php } ?>
    <?php if ($option['type'] == 'radio') { ?>
    <table id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
      <thead>
        <tr>
          <td colspan="3" class="td-heading"><?php echo $option['name']; ?><?php if ($option['required']) { ?><span class="required">*</span><?php } ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($option['product_option_value'] as $option_value) { ?>
        <tr>
          <td class="first-td">
          <input 
            onchange="reCalculate();" 
            type="radio" 
            name="option[<?php echo $option['product_option_id']; ?>]" 
            value="<?php echo $option_value['product_option_value_id']; ?>" 
            id="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>" 
          />
          </td>
          <td>
            <label for="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>">
              <?php echo $option_value['name']; ?>
            </label>
          </td>
          <td style="text-align: right;">
            <?php if ($option_value['price']) { ?>
              <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($option['type'] == 'checkbox') { ?>
    <table id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
      <thead>
        <tr>
          <td colspan="3" class="td-heading"><?php echo $option['name']; ?><?php if ($option['required']) { ?><span class="required">*</span><?php } ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($option['product_option_value'] as $option_value) { ?>
        <tr>
          <td class="first-td">
          <input 
            onchange="reCalculate();" 
            type="checkbox" 
            name="option[<?php echo $option['product_option_id']; ?>][]" 
            value="<?php echo $option_value['product_option_value_id']; ?>" 
            id="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>" 
          />
          </td>
          <td>
            <label for="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>">
              <?php echo $option_value['name']; ?>
            </label>
          </td>
          <td style="text-align: right;">
            <?php if ($option_value['price']) { ?>
              <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($option['type'] == 'image') { ?>
     <table id="smch-option-<?php echo $option['product_option_id']; ?>" class="smch-methods-table">
      <thead>
        <tr>
          <td colspan="4" class="td-heading"><?php echo $option['name']; ?><?php if ($option['required']) { ?><span class="required">*</span><?php } ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($option['product_option_value'] as $option_value) { ?>
        <tr>
          <td class="first-td">
          <input 
            onchange="reCalculate();" 
            type="radio" 
            name="option[<?php echo $option['product_option_id']; ?>]" 
            value="<?php echo $option_value['product_option_value_id']; ?>" 
            id="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>" 
          />
          </td>
          <td style="width:<?php echo !empty($option_images_width) ? $option_images_width : 50; ?>px;">
            <label for="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>">
            <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" />
            </label>
          </td>
          <td>
            <label for="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>" style="float: left;">
              <?php echo $option_value['name']; ?>
            </label>
          </td>
          <td>
            <label for="smch-option-value-<?php echo $option_value['product_option_value_id']; ?>" style="float: right;">
              <?php if ($option_value['price']) { ?>
                <?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>
              <?php } ?>
            </label>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
    <?php if ($option['type'] == 'date') { ?>
      <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
        <input 
          type="text" 
          name="option[<?php echo $option['product_option_id']; ?>]" 
          value="<?php echo $option['value']; ?>" 
          class="date_input" 
          data-date-format="YYYY-MM-DD" 
          placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
          onfocus="$(this).datetimepicker({ pickTime: false });" 
        />
      </div>
    <?php } ?>
    <?php if ($option['type'] == 'datetime') { ?>
      <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
        <input 
          type="text" 
          name="option[<?php echo $option['product_option_id']; ?>]" 
          value="<?php echo $option['value']; ?>" 
          class="datetime_input" 
          data-date-format="YYYY-MM-DD HH:mm" 
          placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
          onfocus="$(this).datetimepicker({ pickDate: true, pickTime: true });" 
        />
      </div>
    <?php } ?>
    <?php if ($option['type'] == 'time') { ?>
    <div id="smch-option-<?php echo $option['product_option_id']; ?>" class="option">
      <input 
        type="text" 
        name="option[<?php echo $option['product_option_id']; ?>]" 
        value="<?php echo $option['value']; ?>" 
        class="time_input" 
        data-date-format="HH:mm" 
        placeholder="<?php echo $option['name']; ?><?php echo $option['required'] ? '*' : ''; ?>" 
        onfocus="$(this).datetimepicker({ pickDate: false });" 
      />
    </div>
    <?php } ?>
  <?php } ?>
  <?php if ($user_button_next) { ?>
  <button type="button" id="product-options" onclick="smch_options();" class="next-step-button"><?php echo $user_button_next; ?> <i class="fa fa-chevron-circle-right"></i></button>
  <?php } ?>
<?php } ?>