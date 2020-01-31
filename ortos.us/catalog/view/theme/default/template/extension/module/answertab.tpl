<div class="lead">
   
    <div class="col-md-12 text-center">
        <button class="" id="answertab_add"><? echo $submit_btn; ?></button>
    </div>
</div>
<div class="clearfix"></div>
 

<? foreach ($answers as $answer) { ?>
    <div class="answer_item">
        <div class="col-md-2">
            <div class="author"><? echo $answer['author']; ?></div>
            <div><? echo date("d " . $months[date('n',strtotime($answer['date_added'])) - 1] . " Y", strtotime($answer['date_added'])); ?></div>
        </div>
        <div class="col-md-10">
            <div class="ask"><? echo $answer['text']; ?></div>
        </div>
        <div class="clearfix"></div>
        <div class="answer">
            <div class="col-md-2"></div>
            <div class="col-md-2 answer_logo"><img src="<? echo $logo; ?>" class="img-responsive"></div>
            <div class="col-md-8">
                <div class="ans"><? echo $answer['text_answer']; ?></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
<? } ?>

<div class="modal fade" id="answer_add" tabindex="-1" role="dialog" aria-labelledby="answer_add_label" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" id="answer_add_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="answer_add_label"><? echo $new_answer; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-6">
                            <input name="author" type="text" class="form-control" id="inputName" placeholder="<? echo $inputName; ?>">
                        </div>
                        <div class="col-md-6">
                            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="<? echo $inputEmail; ?>">
                            <div class="text-muted col-md-12" style="font-size: 9px;"><? echo $inputEmail_text; ?></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea name="text" id="inputAsk" class="form-control" placeholder="<? echo $inputAsk; ?>"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><? echo $close_btn; ?></button>
                    <button type="submit" class="btn btn-primary"><? echo $submit_btn; ?></button>
                </div>
            </div>
            <input type="hidden" name="product_id" value="<? echo $product_id; ?>">
        </form>
    </div>
</div>

<? if (isset($answertab_show_text_after) && $answertab_show_text_after == 1) { ?>
    <div class="modal fade" id="answertab_text_after" tabindex="-1" role="dialog" aria-labelledby="answertab_text_after_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <br />
                </div>

                <div class="modal-body">
                    <p><? echo $answertab_text_after; ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><? echo $close_btn; ?></button>
                </div>
            </div>
        </div>
    </div>
<? } ?>

<script>
    $(document).ready(function () {

        $('#answertab_add').on('click', function () {
            $('#answer_add').modal('show');
        });

        $('#answer_add_form').on('submit', function () {

            $('#inputName').removeClass('error');
            if ($('#inputName').val() === '') {
                $('#inputName').addClass('error');
                return false;
            }

            $('#inputEmail').removeClass('error');
            if ($('#inputEmail').val() === '') {
                $('#inputEmail').addClass('error');
                return false;
            }

            $('#inputAsk').removeClass('error');
            if ($('#inputAsk').val() === '') {
                $('#inputAsk').addClass('error');
                return false;
            }

            $.ajax({
                url: 'index.php?route=extension/module/answertab/addask',
                type: 'POST',
                data: new FormData($('#answer_add_form')[0]),
                contentType: false,
                processData: false,
                success: function (json) {
                    $('#answer_add').modal('hide');
                    <? if (isset($answertab_show_text_after)  && $answertab_show_text_after == 1) { ?>
                    $('#answertab_text_after').modal('show');
                    <? } ?>
                }
            });

            return false;
        });

    });
</script>

<style type="text/css">

    .error {
        animation: anierror 2s infinite alternate;
    }

    @keyframes anierror {
        0% {
            box-shadow: none;
        }

        20% {
            box-shadow: 0 0 15px rgb(255, 0, 0);
            border-color: #ff5151;
        }

        100% {
            box-shadow: 0 0 5px rgb(255, 0, 0);
            border-color: #ff5151;
        }
    }

    .modal-body .form-group {
        padding-bottom: 58px;
        padding-top: 10px;
    }

    .modal {
        text-align: center;
    }

    @media screen and (min-width: 768px) {
        .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
        }
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }

    .ask {
        min-height: 40px; /*min height of DIV should be set to at least 2x the width of the arrow*/
        background: #ececec;
        color: black;
        position: relative;
        word-wrap: break-word;
        -moz-border-radius: 5px; /*add some nice CSS3 round corners*/
        -webkit-border-radius: 5px;
        border-radius: 5px;
        margin-bottom: 2em;
        border: 1px solid #dadada;
        padding: 10px;
    }

    .ask:after {
        content: '';
        display: block;
        position: absolute;
        top: 10px;
        left: -20px; /*should be set to -border-width x 2 */
        width: 0;
        height: 0;
        border-color: transparent #ececec transparent transparent;
        border-style: solid;
        border-width: 10px;
    }

    .answer_item {
        padding: 25px 0 25px 0;
    }

    .answer_item .author {
        font-weight: bold;
    }

    .ans {
        min-height: 40px; /*min height of DIV should be set to at least 2x the width of the arrow*/
        background: #f9f9f9;
        color: black;
        position: relative;
        word-wrap: break-word;
        -moz-border-radius: 5px; /*add some nice CSS3 round corners*/
        -webkit-border-radius: 5px;
        border-radius: 5px;
        margin-bottom: 2em;
        border: 1px solid #eaeaea;
        padding: 10px;
    }

    .ans:after {
        content: '';
        display: block;
        position: absolute;
        top: -20px; /*should be set to -border-width x 2 */
        left: 30px;
        width: 0;
        height: 0;
        border-color: transparent transparent #f6f6f6 transparent;
        border-style: solid;
        border-width: 10px;
    }

    .answer_logo {
        padding: 5px 13px 5px 14px;
    }

</style>