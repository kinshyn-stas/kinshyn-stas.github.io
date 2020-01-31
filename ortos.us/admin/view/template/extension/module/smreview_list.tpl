<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">

            <h1><?php echo $heading_title_with_picture; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <form id="filter-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                                <input type="text" name="filter_product" value="<?php echo $filter_product; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-author"><?php echo $entry_author; ?></label>
                                <input type="text" name="filter_author" value="<?php echo $filter_author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                                <select name="filter_status" id="input-status" class="form-control">
                                    <option value="*"></option>
                                    <?php if ($filter_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <?php } ?>
                                    <?php if (!$filter_status && !is_null($filter_status)) { ?>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                                    <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                    </form>

                    <button type="button" class="open-review-form_button btn btn-primary"><i class="fa fa-plus"></i> <?php echo $text_write_review; ?></button>
                    <button type="button" id="delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> <?php echo $text_delete_review; ?></button>
                    <div class="review-form_block collapse"><span class="review-form_title"><?php echo $text_write_review; ?> </span>
                        <button class="close"><span class="first"></span><span class="second"></span></button>
                        <form class="form-horizontal" id="form-review-add" enctype="multipart/form-data">
                            <div class="form-body_block">
                                <div class="custom-input_block" animated-placeholder="<?php echo $text_name; ?>">
                                    <input class="custom-field" type="text" id="product" name="product" placeholder="<?php echo $column_product; ?>">
                                    <input class="custom-field hidden" type="text" id="product_id" name="product_id">
                                </div>
                                <div class="add-photo_block"><img class="user-photo" src="/image/user_placeholder.png">
                                    <button class="select-photo-trigger" type="button"><?php echo $text_chose_photo; ?></button>
                                    <input type="file" name="logo" id="select-user-photo" style="display:none;">
                                </div>
                                <div class="custom-input_block" animated-placeholder="<?php echo $text_name; ?>">
                                    <input class="custom-field" type="text" id="client-name" name="author" placeholder="<?php echo $text_name; ?>">
                                </div>
                                <div class="custom-input_block" animated-placeholder="<?php echo $text_review; ?>">
                                    <textarea class="custom-field" id="client-comment" name="text" placeholder="<?php echo $text_review; ?>"></textarea>
                                </div>
                                <div class="review-rating_block"><span class="rating_title"><?php echo $text_rating; ?></span>
                                    <ul>
                                        <li class="current-rating">
                                            <input type="radio" id="review_rating_1" value="1" name="rating">
                                            <label for="review_rating_1"></label>
                                        </li>
                                        <li class="current-rating">
                                            <input type="radio" id="review_rating_2" value="2" name="rating">
                                            <label for="review_rating_2"></label>
                                        </li>
                                        <li class="current-rating">
                                            <input type="radio" id="review_rating_3" value="3" name="rating">
                                            <label for="review_rating_3"></label>
                                        </li>
                                        <li class="current-rating">
                                            <input type="radio" id="review_rating_4" value="4" name="rating">
                                            <label for="review_rating_4"></label>
                                        </li>
                                        <li class="current-rating">
                                            <input type="radio" id="review_rating_5" value="5" name="rating" checked>
                                            <label for="review_rating_5"></label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add-photo_block"><img class="user-picture hidden" src="../image/user_placeholder.png" style="width: 150px; height: 150px;">
                                    <button class="select-picture-trigger" type="button"><?php echo $text_chose_photo ?></button>
                                    <input type="file" name="picture" id="select-user-picture" style="display:none;">
                                </div>
                                <div class="add-photo_block">
                                    <video class="user-video hidden" width="400" height="300" controls="controls">
                                        <source class="user-source-video" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                    </video>
                                    <button class="select-video-trigger" type="button"><?php echo $text_chose_video ?></button>
                                    <input type="file" name="video" id="select-user-video" style="display:none;">
                                    <b><?php echo $text_chose_video_yt ?></b>
                                    <input type="text" style="width:300px" name="video_yt" placeholder="https://www.youtube.com/watch?v=XXXXXXX">
                                </div>
                                <button class="send-form_button" id="send-client-review_button" type="button"><?php echo $text_write_review; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="review"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript"><!--
        $('.date').datetimepicker({
            pickTime: false
        });
        //--></script></div>


<script type="text/javascript"><!--

    $("#button-filter").click(function(e) {
        url = 'index.php?route=extension/module/smreview/GetComments&token=<?php echo $token; ?>';

        var filter_product = $('input[name=\'filter_product\']').val();

        if (filter_product) {
            url += '&filter_product=' + encodeURIComponent(filter_product);
        }

        var filter_author = $('input[name=\'filter_author\']').val();

        if (filter_author) {
            url += '&filter_author=' + encodeURIComponent(filter_author);
        }

        var filter_status = $('select[name=\'filter_status\']').val();

        if (filter_status != '*') {
            url += '&filter_status=' + encodeURIComponent(filter_status);
        }

        var filter_date_added = $('input[name=\'filter_date_added\']').val();

        if (filter_date_added) {
            url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
        }
      //  console.log(filter);
        $('#review').load(url);
        });
<!-- -add all review -->
    function GetReview() {
        $('#review').load('index.php?route=extension/module/smreview/getreviews&token=<?php echo $token; ?>');
    };
    GetReview();
    function GetReviewSort(column,order){
        $('#review').load('index.php?route=extension/module/smreview/getreviews&token=<?php echo $token; ?>&sort='+column+'&order='+order);
    }

<!-- open add review form-->
    function showReviewForm(){
        $('button.open-review-form_button').click(function(){
            $('.review-form_block').slideToggle();
        });
        $('.review-form_block button.close').click(function(){
            $('.review-form_block').slideUp();
        });
    };
    showReviewForm();
    // ahimate rating stars --start
    function ratingAnimation(){
        var checkedInput = $('.review-rating_block li input[type="radio"]:checked');
        checkedInput.parent().addClass("current-rating").prevAll().addClass("current-rating");
        $('.review-rating_block li').hover(function(){
            $(this).addClass("current-rating");
            $(this).prevAll().addClass("current-rating");
            $(this).nextAll().removeClass("current-rating");
        }, function(){
            checkedInput = $('.review-rating_block li input[type="radio"]:checked');
            checkedInput.parent().nextAll().removeClass("current-rating");
            checkedInput.parent().prevAll().addClass("current-rating");
            checkedInput.parent().addClass("current-rating");
        })
    };
    ratingAnimation();

<!-- add review -->

    $('#send-client-review_button').on('click', function(e) {
        e.preventDefault();
        var forma = $('#form-review-add');;
        var files = forma[0];
        console.log(files);
        var formdata = new FormData (files);
        console.log(formdata);
        $.ajax({
            url: 'index.php?route=extension/module/smreview/addreview&token=<?php echo $token; ?>',
            type: 'post',
            dataType: 'json',
            async: false,
            //data: $("#form-review").serialize(),
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('#form-review-add').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                    if($('.alert').length > 0) {
                        setTimeout(hideallert,10000);
                    }
                }

                if (json['success']) {

                    $('#review').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                    $('.review-form_block').hide();
                    $('input[name=\'name\']').val('');
                    $('input[name=\'product\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                    GetReview();
                    if($('.alert').length > 0) {
                        setTimeout(hideallert,10000);
                    }
                }
            }
        });
    });

    $(".select-picture-trigger").click(function(){
        $("#select-user-picture").trigger("click");
    });
    $(".select-video-trigger").click(function(){
        $("#select-user-video").trigger("click");
    });

    $("#delete").click(function(e) {
        if (confirm("<?php echo $text_allert_delete;?>")) {
            e.preventDefault();
            var idArray = [];
            $("input[name*=selected]:checked").each(function (index, element) {
                idArray.push($(element).val());
            });

            $.ajax ({
                url: "index.php?route=extension/module/smreview/delete&token=<?php echo $token;?>",
                type: 'post',
                data: {idArray:idArray},
                success: function(json) {
                    if (json['success']) {
                        $('#review').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                        if ($('.alert').length > 0) {
                            setTimeout(hideallert, 10000);
                        }
                    } else {
                        $('#review').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                        if ($('.alert').length > 0) {
                            setTimeout(hideallert, 10000);
                        }
                    }
                    GetReview();                }
                });
            }
        });

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

    $(".select-photo-trigger").click(function(){
        $("#select-user-photo").trigger("click");
    });
    function selectUserPhoto(e) {
        var files = e.target.files;

        for (var i = 0, f; f = files[i]; i++) {

            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();


            reader.onload = (function(theFile) {
                return function(e) {
                    $(".user-photo").attr("src", e.target.result);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
    document.getElementById('select-user-photo').addEventListener('change', selectUserPhoto, false);



    function hideallert(){

        $('.alert').fadeOut( "slow");
    };
    //--></script>

</div>
<style>
    .review-form_block {
        width: 100%;
        max-width: 1270px;
        border: 2px solid #d9d9d9;
        margin: 40px auto 0px;
        text-align: center;
        padding: 40px 0px;
        position: relative;
    }
    .review-form_block button.close {
        width: 26px;
        height: 26px;
        display: block;
        position: absolute;
        opacity: 1;
        background: url(../image/modal_close_ico.png);
        background-size: contain;
        right: 25px;
        top: 50px;
        outline: none;
    }
    .review-form_block .review-form_title {
        color: #222;
        font-family: "OpenSansSemibold";
        text-transform: uppercase;
        font-size: 30px;
        margin-bottom: 30px;
        display: block;
    }
    .review-form_block .form-body_block {
        width: 100%;
        max-width: 770px;
        margin: 0 auto;
        text-align: left;
    }
    .review-form_block .form-body_block .add-photo_block .user-photo {
        width: 65px;
        height: 65px;
        border-radius: 50%;
    }
    .review-form_block .form-body_block .select-photo-trigger {
        border: none;
        background: none;
        color: green;
        outline: none;
        margin-left: 10px;
        font-family: "OpenSans";
        font-size: 16px;
    }
    .review-form_block .form-body_block #client-name {
        width: 100%;
    }
    .review-form_block .form-body_block #client-comment {
        width: 100%;
    }
    .review-form_block .form-body_block .send-form_button {
        width: 200px;
        height: 60px;
        background: url(../image/review_form_open_ico.png) no-repeat green;
        border-radius: 30px;
        line-height: 60px;
        border: none;
        font-size: 16px;
        color: white;
        font-family: "OpenSans";
        background-position: 30px;
        padding-right: 40px;
        text-align: right;
        outline: none;
        margin: 50px auto 0px;
        display: block;
    }
    .review-rating_block ul li {
        float: left;
        padding-right: 10px;
        position: relative;
        width: 32px;
        height: 32px;
        margin-right: 10px;
        padding: 0;
        list-style: none;

    }
    .review-rating_block input[type=radio] {
        display: none;
    }
    </style>
<script>
    function loadSmreviews(page){
        event.preventDefault();
        $('#review').load('index.php?route=extension/module/smreview/getreviews&token=<?php echo $token; ?>&page='+page);
    }
</script>
<?php echo $footer; ?>
