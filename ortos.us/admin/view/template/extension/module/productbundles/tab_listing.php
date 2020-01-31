<table class="table">
    <tr>
		<td class="col-xs-3">
        	<h5><strong>URL страницы списка комплектов:</strong></h5>
        </td>
        <td class="col-xs-9">
            <div class="col-xs-12">
                <a href="<?php echo $store['url']."index.php?route=module/productbundles/listing"; ?>" target="_blank"><?php echo $store['url']."index.php?route=module/productbundles/listing"; ?></a>
			</div>
       </td>
    </tr>
	<tr>
		<td class="col-xs-3">
        	<h5><strong>Добавить ссылку в главное меню:</strong></h5>
        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
                <select id="LinkChecker" name="<?php echo $moduleName; ?>[MainLinkEnabled]" class="form-control">
                    <option value="yes" <?php echo (!empty($moduleData['MainLinkEnabled']) && $moduleData['MainLinkEnabled'] == 'yes') ? 'selected=selected' : '' ?>>Включено</option>
                    <option value="no"  <?php echo (empty($moduleData['MainLinkEnabled']) || $moduleData['MainLinkEnabled']== 'no') ? 'selected=selected' : '' ?>>Отключено</option>
                </select>
			</div>
       </td>
    </tr>
    <tbody id="MainLinkOptions">
	<tr>
		<td class="col-xs-3">
        	<h5><strong>Текст на ссылке в меню:</strong></h5>
        	
        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
                <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $language['name']; ?>:</span>
                        <input type="text" class="form-control" name="<?php echo $moduleName; ?>[LinkTitle][<?php echo $language['language_id']; ?>]" value="<?php if(isset($moduleData['LinkTitle'][$language['language_id']])) { echo $moduleData['LinkTitle'][$language['language_id']]; } else { echo "Bundles"; }?>" />
                    </div>
                    <br />
                <?php } ?>
           </div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Порядок сортировки пукнта меню:</strong></h5>
      
        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
				<input type="number" class="form-control" name="<?php echo $moduleName; ?>[LinkSortOrder]" value="<?php if(isset($moduleData['LinkSortOrder'])) { echo $moduleData['LinkSortOrder']; } else { echo "7"; }?>" />
           </div>
       </td>
    </tr>
    </tbody>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Комплектов на странице:</strong></h5>

        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
				<input type="number" name="<?php echo $moduleName; ?>[ListingLimit]" class="form-control" value="<?php echo (isset($moduleData['ListingLimit'])) ? $moduleData['ListingLimit'] : '10' ?>" /> 
			</div>
       </td>
    </tr>
	<tr>
		<td class="col-xs-3" style="vertical-align:top;">
        	<h5><strong>SEO настройки:</strong></h5>
        	<br /><br />
            	<br />
                <br />

        </td>
        <td class="col-xs-9">
            <div class="col-xs-4">
                <ul class="nav nav-tabs" id="langtabs" role="tablist">
                  <?php foreach ($languages as $language) { ?>
                    <li><a href="#lang-<?php echo $language['language_id']; ?>" role="tab" data-toggle="tab"><img src="<?php echo $language['flag_url']; ?>" title="<?php echo $language['name']; ?>"/></a></li>
                  <?php } ?>
                </ul>
                <div class="tab-content">
                  <?php foreach ($languages as $language) { ?>
                  	<div class="tab-pane" id="lang-<?php echo $language['language_id']; ?>">
                   		Title:<br />
						<input name="<?php echo $moduleName; ?>[PageTitle][<?php echo $language['language_id']; ?>]" class="form-control" type="text" value="<?php echo (isset($moduleData['PageTitle'][$language['language_id']])) ? $moduleData['PageTitle'][$language['language_id']] : 'Вместе дешевле'; ?>" />
                        <br />
                        Meta Description:<br />
						<textarea name="<?php echo $moduleName; ?>[MetaDescription][<?php echo $language['language_id']; ?>]" class="form-control" rows="4"><?php echo (isset($moduleData['MetaDescription'][$language['language_id']])) ? $moduleData['MetaDescription'][$language['language_id']] : 'Получите скидку покупая комплекты товаров'; ?></textarea>
                        <br />
                        Meta Keywords:<br />
						<input name="<?php echo $moduleName; ?>[MetaKeywords][<?php echo $language['language_id']; ?>]" class="form-control" type="text" value="<?php echo (isset($moduleData['MetaKeywords'][$language['language_id']])) ? $moduleData['MetaKeywords'][$language['language_id']] : 'Скидки, комлекты'; ?>" />
                        <br/>
                        SEO URL:<br />
                        <input name="<?php echo $moduleName; ?>[SeoURL][<?php echo $language['language_id']; ?>]" class="form-control" type="text" value="<?php echo (isset($moduleData['SeoURL'][$language['language_id']])) ? $moduleData['SeoURL'][$language['language_id']] : 'bundles'; ?>" />
                        <span class="help"><i class="fa fa-info-circle"></i>&nbsp;<em><?php echo HTTP_CATALOG."<strong>bundles</strong>"; ?></em></span>
                    </div>
                  <?php } ?>
                </div>
			</div>
       </td>
    </tr>
    <tr>
		<td class="col-xs-3">
        	<h5><strong>Размеры картинок:</strong></h5>
        </td>
		<td class="col-xs-9">
        	<div class="col-xs-4">
                <div class="input-group">
                  <span class="input-group-addon">Ширина:&nbsp;</span>
					<input type="text" name="<?php echo $moduleName; ?>[ListingPictureWidth]" class="form-control" value="<?php echo (isset($moduleData['ListingPictureWidth'])) ? $moduleData['ListingPictureWidth'] : '120' ?>" />
				  <span class="input-group-addon">px</span>
                </div>
                <br />
                <div class="input-group">
                  <span class="input-group-addon">Высота:</span>
					<input type="text" name="<?php echo $moduleName; ?>[ListingPictureHeight]" class="form-control" value="<?php echo (isset($moduleData['ListingPictureHeight'])) ? $moduleData['ListingPictureHeight'] : '120' ?>" />
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
				<textarea rows="5" name="<?php echo $moduleName; ?>[ListingCustomCSS]" placeholder="Custom CSS..." class="form-control"><?php echo (isset($moduleData['ListingCustomCSS'])) ? $moduleData['ListingCustomCSS'] : '' ?></textarea>
            </div>
       </td>
  </tr>
</table>