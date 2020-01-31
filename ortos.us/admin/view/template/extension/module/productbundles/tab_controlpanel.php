<table class="table">
  <tr>
    <td class="col-xs-3">
    	<h5><span class="required">*</span> <strong>Статус:</strong></h5>
    </td>
    <td class="col-xs-9">
		<div class="col-xs-4">
            <select id="Checker" name="<?php echo $moduleName; ?>[Enabled]" class="form-control">
                  <option value="yes" <?php echo (!empty($moduleData['Enabled']) && $moduleData['Enabled'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
                  <option value="no"  <?php echo (empty($moduleData['Enabled']) || $moduleData['Enabled']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
   </td>
  </tr>
  <tr>
    <td class="col-xs-3">
        <h5><strong>Если один комплект добавлен несколько раз в корзину::</strong></h5>
    </td>
    <td class="col-xs-9">
        <div class="col-xs-4">
			<select name="<?php echo $moduleName; ?>[MultipleBundles]" class="form-control">
                  <option value="no"  <?php echo (empty($moduleData['MultipleBundles']) || $moduleData['MultipleBundles']== 'no') ? 'selected=selected' : '' ?>>Добавить скидку один раз</option>
                  <option value="yes" <?php echo (!empty($moduleData['MultipleBundles']) && $moduleData['MultipleBundles'] == 'yes') ? 'selected=selected' : '' ?>>Добавить скидку каждый раз</option>
            </select>
        </div>
   </td>
 </tr>
 <tr>
    <td class="col-xs-3">
        <h5><span class="required">*</span> <strong>Скидка на комплект включает стоимость НДС</strong></h5> 
    </td>
    <td class="col-xs-9">
        <div class="col-xs-4">
			<select name="<?php echo $moduleName; ?>[DiscountTaxation]" class="form-control">
                  <option value="no"  <?php echo (empty($moduleData['DiscountTaxation']) || $moduleData['DiscountTaxation']== 'no') ? 'selected=selected' : '' ?>>Да</option>
                  <option value="yes" <?php echo (!empty($moduleData['DiscountTaxation']) && $moduleData['DiscountTaxation'] == 'yes') ? 'selected=selected' : '' ?>>Нет</option>
            </select>
        </div>
   </td>
 </tr>
</table>