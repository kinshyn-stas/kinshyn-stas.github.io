<table class="table">
    <tr>
		<td class="col-xs-3" style="vertical-align:top;">
        	<h5><strong>Размеры картинки:</strong></h5>
        </td>
		<td class="col-xs-9">
        	<div class="col-xs-4">
                <div class="input-group">
                  <span class="input-group-addon">Ширина:&nbsp;</span>
					<input type="text" name="<?php echo $moduleName; ?>[ViewWidth]" class="form-control" value="<?php echo (isset($moduleData['ViewWidth'])) ? $moduleData['ViewWidth'] : '80' ?>" />
				  <span class="input-group-addon">px</span>
                </div>
                <br />
                <div class="input-group">
                  <span class="input-group-addon">Высота:</span>
					<input type="text" name="<?php echo $moduleName; ?>[ViewHeight]" class="form-control" value="<?php echo (isset($moduleData['ViewHeight'])) ? $moduleData['ViewHeight'] : '80' ?>" />
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
				<textarea rows="5" name="<?php echo $moduleName; ?>[ViewCustomCSS]" placeholder="Custom CSS" class="form-control"><?php echo (isset($moduleData['ViewCustomCSS'])) ? $moduleData['ViewCustomCSS'] : '' ?></textarea>
            </div>
       </td>
  </tr>
</table>