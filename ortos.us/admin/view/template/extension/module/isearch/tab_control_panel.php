<table class="form">
  <tr>
    <td><span class="required">*</span> <?php echo $entry_code; ?></td>
    <td valign="top">
        <div class="">
            <select name="iSearch[Enabled]" class="iSearchEnabled form-control">
                <option value="yes" <?php echo ($data['iSearch']['Enabled'] == 'yes') ? 'selected=selected' : ''?>>Включено</option>
                <option value="no" <?php echo ($data['iSearch']['Enabled'] == 'no') ? 'selected=selected' : ''?>>Отключено</option>
            </select>
        </div>    
   </td>
  </tr>
  <tr>
    <td valign="top"><span class="required">*</span> Искать в: <span class="help">Выберите только нужные параметры.</span></td>
    <td>
    <div>    
        <div class="searchInSpan">
            <input type="checkbox" id="searchIn1" name="iSearch[SearchIn][ProductName]" <?php if(!empty($data['iSearch']['SearchIn']['ProductName'])) { echo ($data['iSearch']['SearchIn']['ProductName'] == 'on') ? 'checked=checked' : ''; } else { echo ''; } ?> /><label class="checkbox-inline lbl" for="searchIn1">Наименование товара</label>
        </div>
        <div class="searchInSpan">
            <input type="checkbox" id="searchIn2" name="iSearch[SearchIn][ProductModel]"  <?php if(!empty($data['iSearch']['SearchIn']['ProductModel'])) echo ($data['iSearch']['SearchIn']['ProductModel'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn2">Модель товара</label>
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn3" name="iSearch[SearchIn][UPC]" <?php if(!empty($data['iSearch']['SearchIn']['UPC'])) echo ($data['iSearch']['SearchIn']['UPC'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn3">UPC</label>        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn10" name="iSearch[SearchIn][SKU]" <?php if(!empty($data['iSearch']['SearchIn']['SKU'])) echo ($data['iSearch']['SearchIn']['SKU'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn10">SKU</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn15" name="iSearch[SearchIn][EAN]" <?php if(!empty($data['iSearch']['SearchIn']['EAN'])) echo ($data['iSearch']['SearchIn']['EAN'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn15">EAN</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn16" name="iSearch[SearchIn][JAN]" <?php if(!empty($data['iSearch']['SearchIn']['JAN'])) echo ($data['iSearch']['SearchIn']['JAN'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn16">JAN</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn17" name="iSearch[SearchIn][ISBN]" <?php if(!empty($data['iSearch']['SearchIn']['ISBN'])) echo ($data['iSearch']['SearchIn']['ISBN'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn17">ISBN</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn18" name="iSearch[SearchIn][MPN]" <?php if(!empty($data['iSearch']['SearchIn']['MPN'])) echo ($data['iSearch']['SearchIn']['MPN'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn18">MPN</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn4" name="iSearch[SearchIn][Manufacturer]" <?php if(!empty($data['iSearch']['SearchIn']['Manufacturer'])) echo ($data['iSearch']['SearchIn']['Manufacturer'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn4">Производитель</label>        
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn7" name="iSearch[SearchIn][AttributeNames]" <?php if(!empty($data['iSearch']['SearchIn']['AttributeNames'])) echo ($data['iSearch']['SearchIn']['AttributeNames'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn7">Атрибуты (название)</label>       </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn7_1" name="iSearch[SearchIn][AttributeValues]" <?php if(!empty($data['iSearch']['SearchIn']['AttributeValues'])) echo ($data['iSearch']['SearchIn']['AttributeValues'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn7_1">Атрибуты (значение)</label>       </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn8" name="iSearch[SearchIn][Categories]" <?php if(!empty($data['iSearch']['SearchIn']['Categories'])) echo ($data['iSearch']['SearchIn']['Categories'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn8">Категории</label>        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn19" name="iSearch[SearchIn][Filters]" <?php if(!empty($data['iSearch']['SearchIn']['Filters'])) echo ($data['iSearch']['SearchIn']['Filters'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn19">Фильтры</label>      </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn9" name="iSearch[SearchIn][Description]" <?php if(!empty($data['iSearch']['SearchIn']['Description'])) echo ($data['iSearch']['SearchIn']['Description'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn9">Описание</label>        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn5" name="iSearch[SearchIn][Tags]" <?php if(!empty($data['iSearch']['SearchIn']['Tags'])) echo ($data['iSearch']['SearchIn']['Tags'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn5">Теги</label>        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn6" name="iSearch[SearchIn][Location]" <?php if(!empty($data['iSearch']['SearchIn']['Location'])) echo ($data['iSearch']['SearchIn']['Location'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn6">Расположение</label>        
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn11" name="iSearch[SearchIn][OptionName]" <?php if(!empty($data['iSearch']['SearchIn']['OptionName'])) echo ($data['iSearch']['SearchIn']['OptionName'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn11">Опции (название)</label>     
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn12" name="iSearch[SearchIn][OptionValue]" <?php if(!empty($data['iSearch']['SearchIn']['OptionValue'])) echo ($data['iSearch']['SearchIn']['OptionValue'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn12">Опции (значение)</label>     
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn13" name="iSearch[SearchIn][MetaDescription]" <?php if(!empty($data['iSearch']['SearchIn']['MetaDescription'])) echo ($data['iSearch']['SearchIn']['MetaDescription'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn13">Meta Description</label>     
        </div>
        <div class="searchInSpan onlyUseAJAX">
            <input type="checkbox" id="searchIn14" name="iSearch[SearchIn][MetaKeyword]" <?php if(!empty($data['iSearch']['SearchIn']['MetaKeyword'])) echo ($data['iSearch']['SearchIn']['MetaKeyword'] == 'on') ? 'checked=checked' : ''?> /><label class="checkbox-inline lbl" for="searchIn14">Meta Keyword</label>     
        </div>
    </div>   
    </td>
  </tr>
  <tr>
    <td><span class="required">*</span> Адаптивная ширина <span class="help">Выберите &quot;Да&quot; если вы хотите, чтобы ширина результатов поиска соответствовала вашему шаблону.</span></td>
    <td valign="top">
        <div class="">
            <select name="iSearch[ResponsiveDesign]" class="ResponsiveDesign form-control">
                <option value="no" <?php echo ($data['iSearch']['ResponsiveDesign'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
                <option value="yes" <?php echo ($data['iSearch']['ResponsiveDesign'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
            </select>
        </div>    
   </td>
  </tr>
  <tr>
    <td><span class="required">*</span> Использовать AJAX <span class="help">Выберите &quot;Да&quot; если вы хотите загрузить результаты поиска без перезагрузки страницы при вводе. Если выбрать «Нет» чтобы кэшировать результаты поиска (некоторые функции будут ограничены в режиме без AJAX из-за соображений производительности)</span></td>
    <td valign="top">
        <div class="">
            <select name="iSearch[UseAJAX]" class="UseAJAX form-control">
                <option value="yes" <?php echo ($data['iSearch']['UseAJAX'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
                <option value="no" <?php echo ($data['iSearch']['UseAJAX'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
            </select>
        </div>    
        
        <script>
        $('select.UseAJAX').change(function() {
            if($(this).val() == 'no') {
                $('.onlyUseAJAX').slideUp();
            } else { 
                $('.onlyUseAJAX').slideDown();
            }
        });
        
        var useAJAX = '<?php echo $data['iSearch']['UseAJAX']; ?>';
        if (useAJAX == 'no') {
            $('.onlyUseAJAX').hide();
        }
        
        </script>
   </td>
  </tr>
  <tr>
    <td><span class="required">*</span> Строгое совпадение<span class="help">Строгое совпадение выполняет поиск по вашему запросу строго всей фразы так как задано (пример: «синие джинсы» будут соответствовать всем продуктам с полной фразой «синие джинсы»). Если установлено значение «Нет», оно будет искать всю фразу, а также отдельные слова (например: «голубые джинсы» будут соответствовать всем продуктам, которые имеют тексты «синий» и / или «джинсы»).</span></td>
    <td valign="top">
        <div class="">
            <select name="iSearch[UseStrictSearch]" class="UseStrictSearch form-control">
                <option value="yes" <?php echo ($data['iSearch']['UseStrictSearch'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
                <option value="no" <?php echo ($data['iSearch']['UseStrictSearch'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
            </select>
        </div>
   </td>
  </tr>
  <tr>
    <td><span class="required">*</span> Система поиска <span class="help">Выберите ту поисковую систему, которую вы предпочитаете использовать. Если вы выберете поисковую систему Opencart по умолчанию, модуль выполнит родной поиск, а вы получите результаты поиска Opencart.</span></td>
    <td valign="top">
       <div class="row" style="margin-left:0;">
        <div class="">
            <select name="iSearch[AfterHittingEnter]" class="AfterHittingEnter form-control">
                <option value="isearchengine2000" <?php echo ($data['iSearch']['AfterHittingEnter'] == 'isearchengine1551') ? 'selected=selected' : ''?>>Умный поиск</option>
                <option value="default" <?php echo ($data['iSearch']['AfterHittingEnter'] == 'default') ? 'selected=selected' : ''?>>По умолчанию</option>
            </select>
            <p class="help"><strong>Заметьте:</strong> Если ваш шаблон сильно изменен и вы выбрали "Умный поиск", могут возникнуть конфликты между файлами модуля и файлами темы.</p>
        </div>
      </div>
        
   </td>
  </tr>
  <tr>
    <td><span class="required">*</span> <?php echo $entry_highlightcolor; ?></td>
    <td>
        <div class="">
            <input class="form-control" type="text" name="iSearch[HighlightColor]" value="<?php echo (empty($data['iSearch']['HighlightColor'])) ? '#F7FF8C' : $data['iSearch']['HighlightColor']?>" />
        </div>
    </td>
  </tr>
  <tr>
    <td><span class="required">*</span> Количество результатов <span class="help">Укажите, на каком результате обрезать мгновенный поиск</span></td>
    <td>
        <div class="">
            <input class="form-control" type="text" name="iSearch[ResultsLimit]" value="<?php echo (!isset($data['iSearch']['ResultsLimit'])) ? '5' : $data['iSearch']['ResultsLimit']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Ширина блока результатов (px)<span class="help">Ширина всплывающего блока в пикселях. По умолчанию &quot;370px&quot;.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="text" name="iSearch[ResultsBoxWidth]" value="<?php echo (empty($data['iSearch']['ResultsBoxWidth'])) ? '370px' : $data['iSearch']['ResultsBoxWidth']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Высота блока результатов (px)<span class="help">Высота всплывающего блока в пикселях. Оставьте пустым, если &quot;auto&quot;.</span></td>
    <td>
    <div class="">
        <input class="form-control" type="text" name="iSearch[ResultsBoxHeight]" value="<?php echo (empty($data['iSearch']['ResultsBoxHeight'])) ? '' : $data['iSearch']['ResultsBoxHeight']?>" />
    </div>
    </td>
  </tr>
  <tr>
    <td>Ширина изображения (px)<span class="help">Ширина изображений мгновенного результата поиска в пикселях. Значение по умолчанию - 80.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="number" name="iSearch[InstantResultsImageWidth]" value="<?php echo (empty($data['iSearch']['InstantResultsImageWidth'])) ? '80' : $data['iSearch']['InstantResultsImageWidth']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Высота изображения (px)<span class="help">Высота изображений мгновенного результата поиска в пикселях. Значение по умолчанию - 80.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="number" name="iSearch[InstantResultsImageHeight]" value="<?php echo (empty($data['iSearch']['InstantResultsImageHeight'])) ? '80' : $data['iSearch']['InstantResultsImageHeight']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Ширина названия в результатах<span class="help">Ширина названия товара в результатах в %.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="text" name="iSearch[ResultsBoxTitleWidth]" value="<?php echo (empty($data['iSearch']['ResultsBoxTitleWidth'])) ? '42%' : $data['iSearch']['ResultsBoxTitleWidth']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Размер шрифта (px)<span class="help">Оставьте поле пустым для размера шрифта вашего сайта по умолчанию.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="text" name="iSearch[ResultsTitleFontSize]" value="<?php echo (empty($data['iSearch']['ResultsTitleFontSize'])) ? '' : $data['iSearch']['ResultsTitleFontSize']?>" /></td>
        </div>
  </tr>
  <tr>
    <td>Начертание шрифта<span class="help">Выберите один из вариантов</span></td>
    <td>
        <div class="">
            <select class="form-control" name="iSearch[ResultsTitleFontWeight]" class="ResultsTitleFontWeight">
                <option value="bold" <?php echo ($data['iSearch']['ResultsTitleFontWeight'] == 'bold') ? 'selected=selected' : ''?>>Жирное</option>
                <option value="normal" <?php echo ($data['iSearch']['ResultsTitleFontWeight'] == 'normal') ? 'selected=selected' : ''?>>Нормальное</option>
            </select>
        </div>
    </td>
  </tr>
  <tr>
    <td>Показывать изображения<span class="help">Показать изображения товаров в блоке результатов</span></td>
    <td>
        <div class="">
            <select class="form-control" name="iSearch[ResultsShowImages]" class="ResultsShowImages">
                <option value="yes" <?php echo ($data['iSearch']['ResultsShowImages'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
                <option value="no" <?php echo ($data['iSearch']['ResultsShowImages'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
            </select>
        </div>
    </td>
  </tr>
  <tr>
    <td>Показывать Модель<span class="help">Показать модель / артикул товаров в блоке результатов</span></td>
    <td>
        <div class="">
            <select class="form-control" name="iSearch[ResultsShowModels]" class="ResultsShowModels">
                <option value="no" <?php echo ($data['iSearch']['ResultsShowModels'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
                <option value="yes" <?php echo ($data['iSearch']['ResultsShowModels'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
            </select>
        </div>
    </td>
  </tr>
  <tr>
    <td>Показывать цены<span class="help">Показать цены товаров в блоке результатов</span></td>
    <td>
        <div class="">
            <select class="form-control" name="iSearch[ResultsShowPrices]" class="ResultsShowPrices">
                <option value="no" <?php echo ($data['iSearch']['ResultsShowPrices'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
                <option value="yes" <?php echo ($data['iSearch']['ResultsShowPrices'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
            </select>
        </div>
    </td>
  </tr>
    <tr id="default_sorting_of_results">
      <td>Сортировка результатов<span class="help">Пример: вы ищете «cat», а Умнный поиск возвращает товары «Cute cat pillow» и «Educative»,<br /><br /><strong>Полное совпадение слов</strong> поместит «Cute cat pillow» в верхней части результатов, потому что «cat» - это полное совпадение слов<br /><br /><strong>Длина названия товара</strong> - поместит «Educative» наверху, потому что он короче, чем «Cute cat pillow».</span></td>
      <td>
          <div class="">
              <select name="iSearch[DefaultSorting]" class="form-control">
                  <option value="name_length" <?php echo (!empty($data['iSearch']['DefaultSorting']) && $data['iSearch']['DefaultSorting'] == 'name_length') ? 'selected=selected' : ''?>>Длина названия товара</option>
                  <option value="full_match" <?php echo (!empty($data['iSearch']['DefaultSorting']) && $data['iSearch']['DefaultSorting'] == 'full_match') ? 'selected=selected' : ''?>>Полное совпадение слов</option>
              </select>
          </div>    
      </td>
    </tr>
  <tr>
    <td>
      Заголовок предложений поисковых запросов
    </td>
    <td>
      <div>
        <?php foreach ($languages as $language) : ?>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></div>
            <input class="form-control" type="text" name="iSearch[<?php echo $language['language_id']; ?>][SuggestionHeadingInstant]" value="<?php echo (!isset($data['iSearch'][$language['language_id']]['SuggestionHeadingInstant'])) ? 'Поисковые запросы' : $data['iSearch'][$language['language_id']]['SuggestionHeadingInstant']; ?>" />
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </td>
  </tr>
  <tr>
    <td>Количество предложений поисковых запросов<span class="help">Установите значение 0, чтобы отключить предложения поисковых запросов.</span></td>
    <td>
        <div class="">
            <input class="form-control" type="number" name="iSearch[SuggestionCount]" value="<?php echo (empty($data['iSearch']['SuggestionCount'])) ? '5' : $data['iSearch']['SuggestionCount']?>" />
        </div>
    </td>
  </tr>
  <tr>
    <td>Очистить предложения поисковых запросов<span class="help">Используйте это, чтобы удалить предложения поисковых запросов из своей базы данных.</span></td>
    <td>
        <a href="<?php echo $href_clear_suggestions; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Очистить</a>
    </td>
  </tr>
  <tr>
    <td>
      Заголовок результатов поиска
    </td>
    <td>
      <div>
        <?php foreach ($languages as $language) : ?>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></div>
            <input class="form-control" type="text" name="iSearch[<?php echo $language['language_id']; ?>][ProductHeadingInstant]" value="<?php echo (!isset($data['iSearch'][$language['language_id']]['ProductHeadingInstant'])) ? 'Результаты поиска' : $data['iSearch'][$language['language_id']]['ProductHeadingInstant']; ?>" />
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </td>
  </tr>
  <tr>
    <td>Текст "всех результатов"<span class="help">Это ссылка, которая отображается, если найдено больше результатов, чем лимит результатов.</span></td>
    <td>
        <div class="">
            <?php foreach ($languages as $language) : ?>
            <div class="form-group">
                <div class="input-group">
                   <div class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></div>
                   <input class="form-control" type="text" name="iSearch[<?php echo $language['language_id']; ?>][ResultsMoreResultsLabel]" value="<?php echo (empty($data['iSearch'][$language['language_id']]['ResultsMoreResultsLabel'])) ? 'Смотреть все результаты' : $data['iSearch'][$language['language_id']]['ResultsMoreResultsLabel']; ?>" /><br />
                </div>
            </div>   
            <?php endforeach; ?>
        </div>
    </td>
  </tr>
  <tr>
    <td>Текст "не найдено"<span class="help">Текст, который появляется, когда результатов поиска нет.</span></td>
    <td>
        <div class="">
            <?php foreach ($languages as $language) : ?>
            <div class="form-group">
                <div class="input-group">
                   <div class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></div>
                   <input class="form-control" type="text" name="iSearch[<?php echo $language['language_id']; ?>][ResultsNoResultsLabel]" value="<?php echo (empty($data['iSearch'][$language['language_id']]['ResultsNoResultsLabel'])) ? 'Нет результатов' : $data['iSearch'][$language['language_id']]['ResultsNoResultsLabel']; ?>" /><br />
                </div>
            </div>   
            <?php endforeach; ?>
        </div>
    </td>
  </tr>
  <tr>
    <td valign="top">Пользовательский CSS<span class="help">Поместите свои собственные CSS-стили здесь</span></td>
    <td>
        <div class="">
            <textarea class="form-control" name="iSearch[CustomCSS]" style="width:320px; height:200px;"><?php echo (empty($data['iSearch']['CustomCSS'])) ? '' : $data['iSearch']['CustomCSS']?></textarea>
        </div>                    
    </td>
  </tr>
</table>
<script>
$('.iSearchLayout input[type=checkbox]').change(function() {
    if ($(this).is(':checked')) { 
        $('.iSearchItemStatusField', $(this).parent()).val(1);
    } else {
        $('.iSearchItemStatusField', $(this).parent()).val(0);
    }
});

$('.iSearchEnabled').change(function() {
    toggleiSearchActive(true);
});

var toggleiSearchActive = function(animated) {
    if ($('.iSearchEnabled').val() == 'yes') {
        if (animated) 
            $('.iSearchActiveTR').fadeIn();
        else 
            $('.iSearchActiveTR').show();
    } else {
        if (animated) 
            $('.iSearchActiveTR').fadeOut();
        else 
            $('.iSearchActiveTR').hide();
    }
}

toggleiSearchActive(false);
</script>
