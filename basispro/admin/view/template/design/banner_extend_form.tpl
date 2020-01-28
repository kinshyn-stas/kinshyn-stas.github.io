<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-banner" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-banner" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <table id="images" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_title; ?></td>
                <td class="text-left">Основное</td>
                <td class="text-left">Изображения</td>
                <td class="text-right">Дополнительно</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $image_row = 0; ?>
              <?php foreach ($banner_images as $banner_image) { ?>
              <tr id="image-row<?php echo $image_row; ?>">
                <td class="text-left">Заголовок
                <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
                    <input type="text" name="banner_extend_image[<?php echo $image_row; ?>][banner_extend_image_description][<?php echo $language['language_id']; ?>][title2]" value="<?php echo isset($banner_image['banner_extend_image_description'][$language['language_id']]) ? $banner_image['banner_extend_image_description'][$language['language_id']]['title2'] : ''; ?>" placeholder="Заголовок" class="form-control" />
                  </div>
                <?php } ?>
                    <br/>Название
                <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
                    <input type="text" name="banner_extend_image[<?php echo $image_row; ?>][banner_extend_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($banner_image['banner_extend_image_description'][$language['language_id']]) ? $banner_image['banner_extend_image_description'][$language['language_id']]['title'] : ''; ?>" placeholder="Название" class="form-control" />
                  </div>
                <?php } ?>
                    <br/>Описание
                <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> </span>
                    <textarea name="banner_extend_image[<?php echo $image_row; ?>][banner_extend_image_description][<?php echo $language['language_id']; ?>][title3]" placeholder="Описание" class="form-control"><?php echo isset($banner_image['banner_extend_image_description'][$language['language_id']]) ? $banner_image['banner_extend_image_description'][$language['language_id']]['title3'] : ''; ?></textarea>
                  </div>
                <?php } ?>
                </td>
                <td class="text-left" style="width: 30%;">
                    <span data-toggle="tooltip" title="Если выбран товар, то поля Название, Описание, Ссылка, Основное фото - можно не заполнять, они будут взяты с товара">Товар (автозаполнение) (?)</span><input type="text" name="banner_extend_image[<?php echo $image_row; ?>][product_name]" value="<?php echo $banner_image['product_name']; ?>" placeholder="Товар (автозаполнение)" class="form-control product_name" />
                    <input type="hidden" name="banner_extend_image[<?php echo $image_row; ?>][product_id]" value="<?php echo $banner_image['product_id']; ?>" class="form-control product_id" /><br/>
                    Ссылка<input type="text" name="banner_extend_image[<?php echo $image_row; ?>][link]" value="<?php echo $banner_image['link']; ?>" placeholder="Ссылка" class="form-control" /><br/>
                    Вид
                    <select name="banner_extend_image[<?php echo $image_row; ?>][view]" class="form-control">
                        <?php foreach ($views as $view) { ?>
                            <option value="<?php echo $view['id']; ?>" <?php if ($banner_image['view'] == $view['id']) { echo 'selected = "selected"';} ?>><?php echo $view['name']; ?></option>
                        <?php } ?>
                    </select><br/>
                    Стиль текста
                    <select name="banner_extend_image[<?php echo $image_row; ?>][text_type]" class="form-control">
                        <?php foreach ($text_types as $text_type) { ?>
                            <option value="<?php echo $text_type['id']; ?>" <?php if ($banner_image['text_type'] == $text_type['id']) { echo 'selected = "selected"';} ?>><?php echo $text_type['name']; ?></option>
                        <?php } ?>
                    </select><br/>
                    Цена товара
                    <select name="banner_extend_image[<?php echo $image_row; ?>][show_price]" class="form-control">
                        <?php foreach ($show_prices as $show_price) { ?>
                            <option value="<?php echo $show_price['id']; ?>" <?php if ($banner_image['show_price'] == $show_price['id']) { echo 'selected = "selected"';} ?>><?php echo $show_price['name']; ?></option>
                        <?php } ?>
                    </select><br/>
                </td>
                <td class="text-left">
                    <div>
                    Основное
                    <a href="" id="thumb-image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner_image['thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="banner_extend_image[<?php echo $image_row; ?>][image]" value="<?php echo $banner_image['image']; ?>" id="input-image<?php echo $image_row; ?>" />
                    </div>
                    <div>
                    Фон
                    <a href="" id="thumb-background_image<?php echo $image_row; ?>" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner_image['background_thumb']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="banner_extend_image[<?php echo $image_row; ?>][background_image]" value="<?php echo $banner_image['background_image']; ?>" id="input-background_image<?php echo $image_row; ?>" />
                    </div>

                </td>
                <td class="text-left" style="min-width: 175px;">
                    Порядок сортировки<input type="text" name="banner_extend_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $banner_image['sort_order']; ?>" placeholder="Порядок сортировки" class="form-control" /><br>
                    Класс блока с текстом<input type="text" name="banner_extend_image[<?php echo $image_row; ?>][text_css]" value="<?php echo $banner_image['text_css']; ?>" placeholder="Класс блока с текстом" class="form-control" /><br>
                    Класс блока с фото<input type="text" name="banner_extend_image[<?php echo $image_row; ?>][photo_css]" value="<?php echo $banner_image['photo_css']; ?>" placeholder="Класс блока с фото" class="form-control" /><br>
                    Стиль фона<input type="text" name="banner_extend_image[<?php echo $image_row; ?>][bg_style]" value="<?php echo $banner_image['bg_style']; ?>" placeholder="Стиль фона" class="form-control" />
                </td>
                <td class="text-left"><button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              <?php $image_row++; ?>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"></td>
                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="<?php echo $button_banner_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
	html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left">Заголовок';
    <?php foreach ($languages as $language) { ?>
	html += '    <div class="input-group">';
	html += '      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><input type="text" name="banner_extend_image[' + image_row + '][banner_extend_image_description][<?php echo $language['language_id']; ?>][title2]" value="" placeholder="Заголовок" class="form-control" />';
    html += '    </div>';
	<?php } ?>
    html += '<br/>Название';
    <?php foreach ($languages as $language) { ?>
    html += '    <div class="input-group">';
    html += '      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><input type="text" name="banner_extend_image[' + image_row + '][banner_extend_image_description][<?php echo $language['language_id']; ?>][title]" value="" placeholder="Название" class="form-control" />';
    html += '    </div>';
    <?php } ?>
    html += '<br/>Описание';
    <?php foreach ($languages as $language) { ?>
    html += '    <div class="input-group">';
    html += '      <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span><textarea name="banner_extend_image[' + image_row + '][banner_extend_image_description][<?php echo $language['language_id']; ?>][title3]" value="" placeholder="Описание" class="form-control"></textarea>';
    html += '    </div>';
    <?php } ?>
    html += '<br/>';
	html += '  </td>';	
	html += '  <td class="text-left" style="width: 25%;">';
    html += '<span data-toggle="tooltip" title="Если выбран товар, то поля Название, Описание, Ссылка, Основное фото - можно не заполнять, они будут взяты с товара">Товар (автозаполнение) (?)</span><input type="text" name="banner_extend_image[' + image_row + '][product_name]" value="" placeholder="Товар (автозаполнение)" class="form-control product_name" />';
    html += '<input type="hidden" name="banner_extend_image[' + image_row + '][product_id]" value="" class="form-control product_id" /><br>';
    html += 'Ссылка<input type="text" name="banner_extend_image[' + image_row + '][link]" value="" placeholder="Ссылка" class="form-control" /><br>';
    html += 'Вид<select name="banner_extend_image[' + image_row + '][view]" class="form-control">';
    <?php foreach ($views as $view) { ?>
    html += '    <option value="<?php echo $view['id']; ?>" <?php if ($view['selected']) { echo 'selected = "selected"';} ?>><?php echo $view['name']; ?></option>';
    <?php } ?>
    html += '  </select><br>';
    html += 'Стиль текста<select name="banner_extend_image[' + image_row + '][text_type]" class="form-control">';
    <?php foreach ($text_types as $type) { ?>
    html += '    <option value="<?php echo $type['id']; ?>" <?php if ($type['selected']) { echo 'selected = "selected"';} ?>><?php echo $type['name']; ?></option>';
    <?php } ?>
    html += '  </select><br>';
    html += 'Цена товара<select name="banner_extend_image[' + image_row + '][show_price]" class="form-control">';
    <?php foreach ($show_prices as $show_price) { ?>
    html += '    <option value="<?php echo $show_price['id']; ?>" <?php if ($show_price['selected']) { echo 'selected = "selected"';} ?>><?php echo $show_price['name']; ?></option>';
    <?php } ?>
    html += '  </select>';
    html += '</td>';
	html += '  <td class="text-left">';
    html += '   <div>Основное';
    html += '   <a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
    html += '   <input type="hidden" name="banner_extend_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" />';
    html += '   </div><div>Фон';
    html += '   <a href="" id="thumb-background_image' + image_row + '" data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
    html += '   <input type="hidden" name="banner_extend_image[' + image_row + '][background_image]" value="" id="input-background_image' + image_row + '" /></div>';
    html += ' </td>';
	html += '  <td class="text-left" style="min-width: 175px;">';
    html += ' Порядок сортировки<input type="text" name="banner_extend_image[' + image_row + '][sort_order]" value="" placeholder="Порядок сортировки" class="form-control" /><br>';
    html += ' Класс блока с текстом<input type="text" name="banner_extend_image[' + image_row + '][text_css]" value="" placeholder="Класс блока с текстом" class="form-control" /><br>';
    html += ' Класс блока с фото<input type="text" name="banner_extend_image[' + image_row + '][photo_css]" value="" placeholder="Класс блока с фото" class="form-control" /><br>';
    html += ' Стиль фона<input type="text" name="banner_extend_image[' + image_row + '][bg_style]" value="" placeholder="Стиль фона" class="form-control" />';
    html += ' </td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';

	$('#images tbody').append(html);

    auto_added(image_row);
	
	image_row++;
}
//--></script>
    <script>
        $('input.product_name').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['product_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $(this).val(item['label']);
                $(this).next().next('input').val(item['value']);
            }
        });

        function auto_added(image_row) {
            $('input[name=\'banner_extend_image[' + image_row + '][product_name]\']').autocomplete({
                'source': function(request, response) {
                    $.ajax({
                        url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                        dataType: 'json',
                        success: function(json) {
                            response($.map(json, function(item) {
                                return {
                                    label: item['name'],
                                    value: item['product_id']
                                }
                            }));
                        }
                    });
                },
                'select': function(item) {
                    $(this).val(item['label']);
                    $(this).next().next('input').val(item['value']);
                }
            });
        }

        $('.product_name').on('change', function(){
            var v = $(this).val();
            if (v === '') {
                $(this).next().next('input').val(v);
            }
        });

    </script>

</div>
<?php echo $footer; ?>
