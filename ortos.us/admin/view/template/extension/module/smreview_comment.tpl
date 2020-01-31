<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-review">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table_display_comment">
            <thead>
            <tr>
                <td class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                <td class="text-left"><?php if ($sort == 'pd.name' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('pd.name','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('pd.name','DESC');"><?php echo $column_product; ?></a>
                    <?php } ?></td>
                <td class="text-left">
                    <?php echo $entry_text; ?>
                <td class="text-left"><?php if ($sort == 'r.author' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.author','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.author','DESC');"><?php echo $column_author; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.like' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.like','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_like; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.like','DESC');"><?php echo $column_like; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.dslike' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.dslike','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_dslike; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.dslike','DESC');"><?php echo $column_dslike; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.status' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.status','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.status','DESC');"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.date_added' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.date_added','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.date_added','DESC');"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>

                <td class="text-left"><?php echo $column_action; ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($reviews) { ?>
            <?php foreach ($reviews as $review) { ?>

            <tr>
                <td class="text-center"><?php if (in_array($review['id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['id']; ?>" />
                    <?php } ?></td>
                <td class="text-left">
                    <span class="text-show"><textarea class="comennt-readonly" readonly name="product" ><?php echo $review['name']; ?> </textarea>
                    <input type="hidden" name="product_id" value="<?php echo $review['product_id']; ?>" />
                    <input type="hidden" name="id" value="<?php echo $review['id']; ?>" />
                    <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>" />

                </td>
                <td class="text-left"><textarea class="comennt-readonly" name="text" readonly ><?php echo $review['text']; ?> </textarea> </td>
                <td class="text-left"><textarea class="comennt-readonly" readonly name="author"  ><?php echo $review['author']; ?></textarea> </td>
                <td class="text-right"><input  class="comennt-readonly" readonly name="like" value="<?php echo $review['like']; ?>" /></td>
                <td class="text-right"><input  class="comennt-readonly" readonly name="dslike" value="<?php echo $review['dslike']; ?>" /></td>
                <td class="text-left">
                    <div class="switch">
                        <input type="checkbox" name ="status" <?php echo ($review['status'] == 1)?"checked":""; ?>  id="switch-<?php echo $review['id'];?>" data-id="<?php echo $review['id'];?>" class="switch-check" value="">
                        <label for="switch-<?php echo $review['id'];?>" class="switch-label">
                            <span class="switch-slider switch-slider-on"></span>
                            <span class="switch-slider switch-slider-off"></span>
                        </label>
                    </div>
                   </td>
                <td class="text-left">
                    <div class="input-group datetimecoment">
                        <input type="text" class="comennt-readonly"  name="date_added" value="<?php echo $review['date_added']; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD HH:mm:ss" id="input-date-added" class="form-control" />
                     </div>

                </td>
                <td class="text-center">
                   <a href="<?php echo $review['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-info"><i class="fa fa fa-pencil"></i></a>
                </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
                <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</form>

<div class="row">
    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
<style>
    #table_display_comment td{
        padding: 3px;
    }
</style>
<script>

//change statuse
    $('input[name*=status]').change(function () {
    id = $(this).data('id');
    if($(this).is(':checked')){
    statuse = 1;
    } else {
    statuse = 0;
    }
    $.ajax({
    url: "index.php?route=extension/module/smreview/confirm&token=<?php echo $token;?>",
    type: 'post',
    data: 'id=' + id +'&statuse='+statuse,
    // dataType: 'json',
    success: function() {

    },
    error: function(xhr, ajaxOptions, thrownError) {
    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
    });
    });
// show input
$('.smrevcomment-edit').click(function (e) {
    e.preventDefault(e);
    console.log( $(this).closest('td').find('.date-added'));
    // открываем инпуты для редактирования
    $(this).closest('tr').find('input').removeAttr('readonly');
    // делаем их видимыми
    $(this).closest('tr').find('input,textarea').removeClass('comennt-readonly');
    // скрываем текстовые поля
  //  $(this).closest('tr').find('.text-show').hide();
    // отображаем кнопку сохранить
    $(this).closest('td').find('.smrevcomment-save').show();
    $(this).closest('td').find('.date-added').removeClass('comennt-readonly');
    // скрываем кнопку редактировать
    $(this).hide();
});
// change comment
$('.smrevcomment-save').click(function (e) {

    e.preventDefault(e);
    var button = $(this);
    $.ajax({
        url: 'index.php?route=extension/module/smreview/QvickeditReview&token=<?php echo $token; ?>',
        type: 'post',
        dataType: 'json',
        data: $( this ).closest('tr').find('input,textarea').serialize(),
        /* beforeSend: function() {
         $('#send-client-review').button('loading');
         },
         complete: function() {
         $('#send-client-review').button('reset');
         },*/
        success: function(json) {
            if (json['error']) {
                $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }

            if (json['success']) {
            // console.log(button);
                // открываем инпуты для редактирования
                button.closest('tr').find('input').attr('readonly');
                // делаем их видимыми
                button.closest('tr').find('input,textarea').addClass('comennt-readonly');
                // скрываем текстовые поля
                //  $(this).closest('tr').find('.text-show').hide();
                // отображаем кнопку сохранить
                button.closest('td').find('.smrevcomment-edit').show();
                button.closest('td').find('.date-added').hide();
                // скрываем кнопку редактировать
                button.hide();
                button.closest('tr').addClass('green');

                setTimeout(function (){
                    $('.green').removeClass('green');
                }, 10000);
            }
        },

    });
});
$('.datetimecoment').datetimepicker({
    pickDate: true,
    pickTime: true
});
</script>