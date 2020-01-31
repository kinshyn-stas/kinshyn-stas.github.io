<table class="table">
    <tr>
		<td class="col-xs-3" style="vertical-align:top;">
        	<h5><strong>Заголовок:</strong></h5>
        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
                <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                      <span class="input-group-addon"><img src="<?php echo $language['flag_url']; ?>" style="margin-top:-3px;" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></span>
                      <input name="<?php echo $moduleName; ?>[WidgetTitle][<?php echo $language['language_id']; ?>]" class="form-control" type="text" value="<?php echo (isset($moduleData['WidgetTitle'][$language['language_id']])) ? $moduleData['WidgetTitle'][$language['language_id']] : 'Check out this bundle:' ?>" />
                    </div>
                    <br />
				<?php } ?>
			</div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Виджет с фоном:</strong></h5>
        </td>
        <td class="col-xs-9">
			<div class="col-xs-4">
                <select name="<?php echo $moduleName; ?>[WrapInWidget]" class="form-control">
                    <option value="yes" <?php echo (isset($moduleData['WrapInWidget']) && ($moduleData['WrapInWidget'] == 'yes')) ? 'selected=selected' : '' ?>>Включено</option>
					<option value="no" <?php echo (isset($moduleData['WrapInWidget']) && ($moduleData['WrapInWidget'] == 'no')) ? 'selected=selected' : '' ?>>Отключено</option>
                </select>
            </div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Комплектов в виджете:</strong></h5>
        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
				<input type="number" name="<?php echo $moduleName; ?>[WidgetLimit]" class="form-control" value="<?php echo (isset($moduleData['WidgetLimit'])) ? $moduleData['WidgetLimit'] : '2' ?>" /> 
			</div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Показ:</strong></h5>
        </td>
        <td class="col-xs-9">
			<div class="col-xs-4">
                <select name="<?php echo $moduleName; ?>[DisplayType]" class="form-control">
                    <option value="default" <?php echo (isset($moduleData['DisplayType']) && ($moduleData['DisplayType'] == 'default')) ? 'selected=selected' : '' ?>>По умолчанию</option>
					<option value="random" <?php echo (isset($moduleData['DisplayType']) && ($moduleData['DisplayType'] == 'random')) ? 'selected=selected' : '' ?>>Случайный</option>
                </select>
            </div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3" style="vertical-align:top;">
        	<h5><strong>Размеры картинок:</strong></h5>
        </td>
		<td class="col-xs-9">
        	<div class="col-xs-4">
                <div class="input-group">
                  <span class="input-group-addon">Ширина:&nbsp;</span>
					<input type="text" name="<?php echo $moduleName; ?>[WidgetWidth]" class="form-control" value="<?php echo (isset($moduleData['WidgetWidth'])) ? $moduleData['WidgetWidth'] : '80' ?>" />
				  <span class="input-group-addon">px</span>
                </div>
                <br />
                <div class="input-group">
                  <span class="input-group-addon">Высота:</span>
					<input type="text" name="<?php echo $moduleName; ?>[WidgetHeight]" class="form-control" value="<?php echo (isset($moduleData['WidgetHeight'])) ? $moduleData['WidgetHeight'] : '80' ?>" />
                  <span class="input-group-addon">px</span>
                </div>
            </div>
		</td>
  </tr>
  <tr>
       <td class="col-xs-3" style="vertical-align:top;">
			<h5><strong>Пользовательский CSS:</strong></h5>
       </td>
       <td class="col-xs-9">
			<div class="col-xs-4">
				<textarea rows="5" name="<?php echo $moduleName; ?>[CustomCSS]" placeholder="Custom CSS" class="form-control"><?php echo (isset($moduleData['CustomCSS'])) ? $moduleData['CustomCSS'] : '' ?></textarea>
            </div>
       </td>
  </tr>
</table>