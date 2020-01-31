<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-review" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title_with_picture; ?></h1>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i>
                    <?php if($is_comment == ''){ ?>
                        <?php echo $text_form; ?>
                    <?php }else{ ?>
                        <?php echo $text_edit_comment; ?>
                    <?php } ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php if($text_success_edit){ ?>
                    <?php if($text_success_edit != ''){ ?>
                        <div class="alert alert-success" style="margin-top: 5px;"><i class="fa fa-check-circle"></i><?php echo $text_success_edit; ?></div>
                    <?php } ?>
                <?php } ?>
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_author; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="author" value="<?php echo $author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
                            <?php if ($error_author) { ?>
                            <div class="text-danger"><?php echo $error_author; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
                        <div class="col-sm-10">
                            <input type="text" name="product" value="<?php echo $product; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <input type="hidden" name="review_id" value="<?php echo $review_id; ?>" />
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <?php if ($error_product) { ?>
                            <div class="text-danger"><?php echo $error_product; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?></label>
                        <div class="col-sm-10">
                            <textarea name="text" cols="60" rows="8" placeholder="<?php echo $entry_text; ?>" id="input-text" class="form-control"><?php echo $text; ?></textarea>
                            <?php if ($error_text) { ?>
                            <div class="text-danger"><?php echo $error_text; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if($is_comment != 1){ ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-like"><?php echo $text_picture_to_review; ?></label>
                            <div class="col-sm-8">
                                <?php
                                    if($picture != 'no image' and $picture != ''){
                                ?>
                                    <img src="/image/<?php echo $picture; ?>" style="width: 350px; height: 250px;">
                                <?php
                                    }else{
                                ?>
                                    <p><?php echo $text_no; ?></p>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-like"><?php echo $text_video_to_review; ?></label>
                            <div class="col-sm-8">
                                <?php if($video) { ?>
                                    <?php if($video != 'no video' and $video != '') { ?>
                                        <?php if(strrpos($video, "youtube")) { ?>
                                            <iframe width="500" height="300" src="<?php echo $video;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        <?php } else { ?>
                                            <video class="user-video" width="500" height="300" controls="controls">
                                                <source class="user-source-video" src="<?php echo '/image/'.$video;?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                            </video>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <p><?php echo $text_no; ?></p>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <p><?php echo $text_no; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-like"><?php echo $column_like; ?></label>
                        <div class="col-sm-2">
                            <input type="number" min="0" name="like" value="<?php echo $like; ?>" placeholder="<?php echo $entry_like; ?>" id="input-like" class="form-control hidden" />
                            <p><?php echo $like; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-dslike"><?php echo $column_dslike; ?></label>
                        <div class="col-sm-2">
                            <input type="number" min="0" name="dslike" value="<?php echo $dslike; ?>" placeholder="<?php echo $entry_dslike; ?>" id="input-dslike" class="form-control hidden" />
                            <p><?php echo $dslike; ?></p>
                        </div>
                    </div>

                    <div class="form-group required " <?php echo ($review_id)?"style='display: none;'":""; ?>>
                        <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_rating; ?></label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <?php if ($rating == 1) { ?>
                                <input type="radio" name="rating" value="1" checked="checked" />
                                1
                                <?php } else { ?>
                                <input type="radio" name="rating" value="1" />
                                1
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($rating == 2) { ?>
                                <input type="radio" name="rating" value="2" checked="checked" />
                                2
                                <?php } else { ?>
                                <input type="radio" name="rating" value="2" />
                                2
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($rating == 3) { ?>
                                <input type="radio" name="rating" value="3" checked="checked" />
                                3
                                <?php } else { ?>
                                <input type="radio" name="rating" value="3" />
                                3
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($rating == 4) { ?>
                                <input type="radio" name="rating" value="4" checked="checked" />
                                4
                                <?php } else { ?>
                                <input type="radio" name="rating" value="4" />
                                4
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($rating == 5) { ?>
                                <input type="radio" name="rating" value="5" checked="checked" />
                                5
                                <?php } else { ?>
                                <input type="radio" name="rating" value="5" />
                                5
                                <?php } ?>
                            </label>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                        <div class="col-sm-3">
                            <div class="input-group datetime">
                                <input type="text" name="date_added" value="<?php echo $date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD HH:mm:ss" id="input-date-added" class="form-control" />
                                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
                            </div>
                        </div>
                    </div>
<!--
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_published_date; ?></label>
                <div class="col-sm-10">
                    <input name="smreview_published_date" type="text" class="form-control" value="<?php echo isset($smreview_published_date)?$smreview_published_date:''; ?>">
                </div>
            </div>-->

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-published"><?php echo $entry_published_date; ?></label>
                <div class="col-sm-3">
                    <div class="input-group datetime">
                        <input type="text" name="date_published" value="<?php echo $date_published; ?>" data-date-format="YYYY-MM-DD HH:mm:ss" id="input-date-published" class="form-control" />
                        <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
                    </div>
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
                </form>
                <!-- если это страница коментария то не надо выполяем-->
            <?php if(!$review_id) { ?>
                <h3><?php echo $text_comment; ?> </h3>
                <div class="form-group">
                <button type="button" id="delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> <?php echo $text_delete_review; ?></button>
                </div>
                <div id="comment"></div>


                <button class="open-review-form_button"><?php echo $text_add_text; ?></button>
                <div class="review-form_block collapse"><span class="review-form_title"><?php echo $text_add_text; ?> </span>
                    <button class="close"><span class="first"></span><span class="second"></span></button>
                    <form class="form-horizontal" id="form-review-add">
                        <div class="form-body_block">
                            <div class="custom-input_block">
                                <input  type="hidden" class="custom-field" type="text" id="product" name="product" value="<?php echo $product; ?>">
                                <input  type="hidden" class="custom-field" type="text" id="product-id" name="product_id" value="<?php echo $product_id; ?>">
                                <input  type="hidden" class="custom-field" type="text" id="review-id" name="review_id" value="<?php echo $id; ?>">
                            </div>
                            <!--<?php // Вибирати фото для коментаря не потрібно ?>
                            <div class="add-photo_block"><img class="user-photo" src="/image/user_placeholder.png">
                                <button class="select-photo-trigger" type="button"><?php echo $text_chose_photo; ?></button>
                                <input type="file" name="logo" id="select-user-photo" style="display:none;">
                            </div>
                            -->
                            <div class="custom-input_block" animated-placeholder="<?php echo $text_name; ?>">
                                <input class="custom-field" type="text" id="client-name" name="author" placeholder="<?php echo $text_name; ?>">
                            </div>
                            <div class="custom-input_block" animated-placeholder="<?php echo $text_text; ?>">
                                <textarea class="custom-field" id="client-comment" name="text" placeholder="<?php echo $text_text; ?>"></textarea>
                            </div>
                            <button class="send-form_button" id="send-client-review_button" type="button"><?php echo $text_add_text; ?></button>
                        </div>
                    </form>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>



<!-- если это страница коментария то не надо выполяем-->
<?php if(!$review_id) { ?>
    <script type="text/javascript"><!--
    function GetReview() {
    $('#comment').load('index.php?route=extension/module/smreview/getcomments&token=<?php echo $token; ?>&review_id=<?php echo $id; ?>');
    };
    GetReview();
    function GetReviewSort(column,order){
        $('#comment').load('index.php?route=extension/module/smreview/getcomments&token=<?php echo $token; ?>&review_id=<?php echo $id; ?>&sort='+column+'&order='+order);
    }
    //--></script>
<?php } ?>

    <script type="text/javascript"><!--
        $('.datetime').datetimepicker({
            pickDate: true,
            pickTime: true
        });

// add priduct
        $('input[name=\'product\']').autocomplete({
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
                $('input[name=\'product\']').val(item['label']);
                $('input[name=\'product_id\']').val(item['value']);
            }
        });

// add all comments
    $('#send-client-review_button').on('click', function(e) {
        e.preventDefault(e);
        $.ajax({
            url: 'index.php?route=extension/module/smreview/addreview&token=<?php echo $token; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-review-add").serialize(),
            /* beforeSend: function() {
             $('#send-client-review').button('loading');
             },
             complete: function() {
             $('#send-client-review').button('reset');
             },*/
            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('.client-review_block').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                    $('.review-form_block').hide();
                    $('input[name=\'name\']').val('');
                    $('input[name=\'product\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                    GetReview();
                }
            }
        });
    });

// delere comment
    $("#delete").click(function(e) {
        if (confirm("<?php echo $text_allert_delete;?>")) {
            e.preventDefault();
            var idArray = [];
            $("input[name*=selected]:checked").each(function (index, element) {
                idArray.push($(element).val());
            });

            $.ajax({
                url: "index.php?route=extension/module/smreview/delete&token=<?php echo $token;?>",
                type: 'post',
                data: {idArray:idArray},
            })
                .success(function (json) {
                    //location.reload();
                    //$('a[data-toggle="tab"]').trigger("click");
                    if (json['success']) {
                        $('#comment').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                        // GetReview();
                        if ($('.alert').length > 0) {
                            setTimeout(hideallert, 10000);
                        }
                    } else {
                        $('#comment').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                        if ($('.alert').length > 0) {
                            setTimeout(hideallert, 10000);
                        }
                    }
                    GetReview();

                })
                .error(function (json) {
                    $('#comment').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                    if ($('.alert').length > 0) {
                        setTimeout(hideallert, 10000);
                    }
                });

        }
    });

// show allert
        function hideallert(e){
        $('.alert').fadeOut( "slow");
    };

// open add review form
    function showReviewForm(){
        $('button.open-review-form_button').click(function(){
            $('.review-form_block').slideToggle();
        });
        $('.client-review_block .review-form_block button.close').click(function(){
            $('.review-form_block').slideUp();
        });
    };
    showReviewForm();
    //--></script>
<?php echo $footer; ?>