<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-review">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                <td class="text-left"><?php if ($sort == 'pd.name' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('pd.name','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('pd.name','DESC');"><?php echo $column_product; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.author' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.author','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.author','DESC');"><?php echo $column_author; ?></a>
                    <?php } ?></td>
                <td class="text-right"><?php if ($sort == 'r.rating' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.rating','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_rating; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.rating','DESC');"><?php echo $column_rating; ?></a>
                    <?php } ?></td>
                <td class="text-left"><?php if ($sort == 'r.date_added' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.date_added','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.date_added','DESC');"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>

                <td class="text-left"><?php echo $column_comment; ?>
                </td>
                <td class="text-left"><?php if ($sort == 'r.status' and $order == 'DESC') { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.status','ASC');" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a style="cursor: pointer;" onclick="GetReviewSort('r.status','DESC');"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                <td class="text-right"><?php echo $column_action; ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($reviews) { ?>
            <?php foreach ($reviews as $review) { ?>
            <tr>
                <td class="text-center"><?php if (in_array($review['review_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $review['id']; ?>" />
                    <?php } ?></td>
                <td class="text-left"><?php if ($review['picture'] != 'no image' and $review['picture'] != ''){ ?> <b><i class="fa fa-image" style="font-size: 25px;"></i></b> <?php } ?><?php if ($review['video'] != 'no video' and $review['video'] != ''){ ?> <b><i class="fa fa-video-camera" style="font-size: 25px;"></i></b> <?php } ?><?php echo $review['name']; ?></td>
                <td class="text-left"><?php echo $review['author']; ?></td>
                <td class="text-right"><?php echo $review['rating']; ?></td>
                <td class="text-left"><?php echo $review['date_added']; ?></td>
                <td class="text-left"><?php echo $review['comment']; ?></td>
                <td class="text-left">
                    <?php // echo $review['status']; ?>
                    <div class="switch">
                        <input type="checkbox" name ="status" <?php echo ($review['status'] == 1)?"checked":""; ?>  id="switch-<?php echo $review['id'];?>" data-id="<?php echo $review['id'];?>" class="switch-check" value="">
                        <label for="switch-<?php echo $review['id'];?>" class="switch-label">
                            <span class="switch-slider switch-slider-on"></span>
                            <span class="switch-slider switch-slider-off"></span>
                        </label>
                    </div>
                </td>
                <td class="text-right"><a href="<?php echo $review['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
</script>