<table class="form">
  <tr>
    <td><span class="required">*</span> Сигулярность <span class="help">Если вы используете сигулярность, слова будут искать как их единственную, так и множественную форму. Этот метод учитывает слова, которые заканчиваются на 'и', 'ы' и 'ов'. Обратите внимание, что если включен режим Строгого совпадения, то не применяется сингулярность.</span></td>
    <td valign="top">
        <div class="col-xs-12">
            <select name="iSearch[UseSingularize]" class="UseSingularize form-control">
                <option value="no" <?php echo (!empty($data['iSearch']['UseSingularize']) && $data['iSearch']['UseSingularize'] == 'no') ? 'selected=selected' : ''?>>Нет</option>
                <option value="yes" <?php echo (!empty($data['iSearch']['UseSingularize']) && $data['iSearch']['UseSingularize'] == 'yes') ? 'selected=selected' : ''?>>Да</option>
            </select>
        </div>    
    </td>
  </tr>
  <tr>
    <td>Исключить условия поиска<span class="help">Введите условия поиска, которые вы хотите исключить из строя. Пример:<br /><strong>и<br />или</strong></span></td>
    <td valign="top">
        <div class="col-xs-4">
            <textarea class="form-control" name="iSearch[ExcludeTerms]" style="width:320px;height:100px;"><?php echo (empty($data['iSearch']['ExcludeTerms'])) ? "" : $data['iSearch']['ExcludeTerms']?></textarea>
        </div>
    </td>
  </tr>
  <tr>
    <td>
        Исключить товары, соответствующие следующим критериям:
    </td>
    <td>
        <table>
            <tbody id="excludeProduct">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="right" style="padding-left: 15px;">
                        <a class="btn btn-primary" id="excludeProductAdd"><i class="fa fa-plus"></i> Добавить правило</a>
                    </td>
                </tr>
            </tfoot>
        </table>
        <script type="text/javascript">
            var exclude_entries = <?php echo !empty($data['iSearch']['ExcludeProducts']) ? json_encode($data['iSearch']['ExcludeProducts']) : '[]' ?>;
            var exclude_entries_index = 0;
            
            var addExclude = function(entry) {
                var html = '<div class="row" style="margin-bottom: 10px; margin-left: 0;">';
                html += '<tr>'
                html += '<td><div style="margin-bottom: 10px;">';
                html += '<div class="col-xs-4">';
                html += '<select class="form-control" name="iSearch[ExcludeProducts][' + exclude_entries_index + '][type]">';
                html += '<option value="quantity"' + (typeof entry.type != 'undefined' && entry.type == 'quantity' ? ' selected="selected"' : '') + '>Количество</option>';
                html += '<option value="status"' + (typeof entry.type != 'undefined' && entry.type == 'status' ? ' selected="selected"' : '') + '>Статус</option>';
                html += '<option value="stock_status_id"' + (typeof entry.type != 'undefined' && entry.type == 'stock_status_id' ? ' selected="selected"' : '') + '>ID статуса наличия</option>';
                html += '<option value="category_status"' + (typeof entry.type != 'undefined' && entry.type == 'category_status' ? ' selected="selected"' : '') + '>Категория</option>';
                html += '</select>';
                html += '</div>';
                html += '<div class="col-xs-3">';
                html += '<select class="form-control" name="iSearch[ExcludeProducts][' + exclude_entries_index + '][operator]" style="margin-left:8px;">';
                html += '<option value="lt"' + (typeof entry.operator != 'undefined' && entry.operator == 'lt' ? ' selected="selected"' : '') + '>&lt;</option>';
                html += '<option value="gt"' + (typeof entry.operator != 'undefined' && entry.operator == 'gt' ? ' selected="selected"' : '') + '>&gt;</option>';
                html += '<option value="eq"' + (typeof entry.operator != 'undefined' && entry.operator == 'eq' ? ' selected="selected"' : '') + '>=</option>';
                html += '</select>';
                html += '</div>';
                html += '</td>';
                html += '<td>';
                html += '<div class="col-xs-3">';
                html += '<input class="form-control" type="number" name="iSearch[ExcludeProducts][' + exclude_entries_index + '][value]" value="' + (typeof entry.value != 'undefined' && entry.value != '' ? entry.value : '') + '" />';
                html += '</div>';
                html += '</td>';
                html += '<td>';
                html += '<div class="col-xs-2">';
                html += '<a class="btn btn-danger ExcludeProductsRemove"><i class="fa fa-times"></i></a>';
                html += '</div>';
                html += '</td>';
                html += '</tr>';
                html += '</div>';
                $('#excludeProduct').append(html);
                
                $('.ExcludeProductsRemove').unbind().click(function() {
                    $(this).closest('.row').remove();
                });
                
                exclude_entries_index++;
            }
            
            for (var i in exclude_entries) {
                var custom_entry = exclude_entries[i];
                addExclude(exclude_entries[i]);
            }
            
            $('#excludeProductAdd').click(function() {
                addExclude({});
            });
        </script>
    </td>
</tr>
  <tr>
    <td>Система проверки орфографии</td>
    <td>
        <div class="col-xs-12">
            <select name="iSearch[ResultsSpellCheckSystem]" class="ResultsSpellCheckSystem form-control">
                <option value="no" <?php echo ($data['iSearch']['ResultsSpellCheckSystem'] == 'no') ? 'selected=selected' : ''?>>Да</option>                       <option value="yes" <?php echo ($data['iSearch']['ResultsSpellCheckSystem'] == 'yes') ? 'selected=selected' : ''?>>Нет</option>
            </select>
         </div>   
    </td>
  </tr>
  <tr>
    <td valign="top">Пользовательские правила проверки орфографии<span class="help">Пример: телифон => телефон. Введите столько альтернатив, сколько вам нужно. Левая часть правила также может содержать регулярное выражение. Например <strong>/тел.*/i</strong> => <strong>телефон</strong> будет соответствовать всем поисковым запросам, содержащим «тел» и заменит их на «телефон». Вы также можете использовать регулярные выражения для соответствия более чем одному слову: <strong>/(тилифон)|(тилефон)|(телифон)/i</strong> => <strong>телефон</strong></span></td>
    <td>
          
        <div class="wordsWrapper">
             <div class="row" style="margin-left: 0;">
                <div class="wordWrapper wordIsDeletable">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="iSearch[SCWords][0][incorrect]" class="incorrect form-control" value="<?php echo (empty($data['iSearch']['SCWords'][0]['incorrect'])) ? 'телифон' : $data['iSearch']['SCWords'][0]['incorrect']?>" /> 
                                <div class="input-group-addon"> &raquo; </div>
                                <input type="text" name="iSearch[SCWords][0][correct]" class="correct form-control" value="<?php echo (empty($data['iSearch']['SCWords'][0]['correct'])) ? 'телефон' : $data['iSearch']['SCWords'][0]['correct']?>" />
                            </div>
                        </div>     
                    </div> 
                </div>
            </div>
       
        <?php if (!empty($data['iSearch']['SCWords'])): $i=0; ?>
            <?php foreach ($data['iSearch']['SCWords'] as $_word): ?>
            <?php if ($i==0) {$i++; continue; }  ?>
                <div class="row" style="margin-left: 0;">
                    <div class="wordWrapper wordIsDeletable">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <div class="input-group"> 
                                    <input type="text" class="incorrect form-control" name="iSearch[SCWords][<?php echo $i?>][incorrect]" value="<?php echo $_word['incorrect']?>" /> 
                                    <div class="input-group-addon"> &raquo; </div>
                                    <input type="text" class="correct form-control" name="iSearch[SCWords][<?php echo $i?>][correct]" value="<?php echo $_word['correct']?>" />
                                </div> 
                            </div>   
                        </div>
                        <div class="col-xs-2"> 
                        <div class="form-group">      
                             <a href="javascript:void(0)" class="btn btn-danger removeWordButton"><i class="fa fa-times"></i></a>
                        </div>   
                        </div>
                    </div>
                </div>    
            <?php $i++; endforeach; ?>
        <?php endif; ?>
        </div> 
        <div style="padding-left: 15px;"><a href="javascript:void(0)" class="addWordButton btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Добавить слово</a></div>
        <script>
            var autonameWords = function() {
                $('.wordsWrapper .wordWrapper').each(function(i, e) {
                    $(this).find('.incorrect').attr('name', 'iSearch[SCWords]['+i+'][incorrect]');
                    $(this).find('.correct').attr('name', 'iSearch[SCWords]['+i+'][correct]');
                });
            }
        
            var bind_remove_buttons = function() {

                $('.removeWordButton').off().on('click',function() {
                    $(this).closest('.row').remove();
                    autonameWords();
                });

            }
            
            bind_remove_buttons();

            $('.addWordButton').click(function() {
                var l = $('.wordsWrapper .wordWrapper').length;
                var wordWrapper  = '<div class="row" style="margin-left: 0;">';
                
                wordWrapper += '    <div class="wordWrapper wordIsDeletable">';
                wordWrapper += '        <div class="col-xs-10">';
                wordWrapper += '            <div class="form-group">';
                wordWrapper += '                <div class="input-group">';
                wordWrapper += '                    <input type="text" class="incorrect form-control" name="iSearch[SCWords]['+l+'][incorrect]" value="" />';
                wordWrapper += '                    <div class="input-group-addon">';
                wordWrapper += '                        &raquo;';
                wordWrapper += '                    </div>';
                wordWrapper += '                    <input type="text" class="correct form-control" name="iSearch[SCWords]['+l+'][correct]" value="" />';
                wordWrapper += '                </div>';
                wordWrapper += '            </div>';
                wordWrapper += '        </div>';
                wordWrapper += '        <div class="col-xs-2"><div class="form-group">';
                wordWrapper += '            <a href="javascript:void(0)" class="btn btn-danger removeWordButton"><i class="fa fa-times"></i></a>';
                wordWrapper += '        </div></div>';
                wordWrapper += '    </div>';
                wordWrapper += '</div>';
                
                $('.wordsWrapper').append(wordWrapper);
                bind_remove_buttons();
            });
        </script>
    </td>
  </tr>
  <!--{HOOK_ADD_CACHING_OPTION}-->
</table>
