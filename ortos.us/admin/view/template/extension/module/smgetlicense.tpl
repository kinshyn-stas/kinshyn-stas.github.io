<?php echo $header;?><?php echo $column_left; ?>
	<div id="content">
	<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-affiliate" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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

		<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_license; ?></h3>
      </div>
      <div class="panel-body license-text">
		<!--	<form action="<?php //echo $action; ?>" method="post" enctype="multipart/form-data" id="form_license"> -->
				<table class="form">
					<tr>
						<span class="not-successe hidden" style="color:red";><?php echo $text_not_successe; ?> </span>
					</tr>
					<tr>
						<td><?php echo $text_license; ?></td>
						<td style="width: 85%;"><textarea type="text" class="smreview_license" placeholder="<?php echo $entry_license; ?>"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="button send-license" value="<?php echo $button_submit_key; ?>"></td>
					</tr>
					<tr>

					 <td colspan="2"><?php echo $text_license_abow; ?></td>
					</tr>

				</table>
		<!--	</form> -->
			</div>
			<div class="success-license hidden">
				<span><?php echo $text_success_license?></span>
			</div>

		</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $text_sometext;?></h3>
				</div>
				<div class="panel-body send-letter">
					<div class="client-form-holder">
						<form action="" class="client-form">


								<h4><?php echo $text_purchased;?></h4>
								<ol class="wherebuy-list">
									<li><label for="wherebuy-radio1"><?php echo $text_codecan; ?></label><input id="wherebuy-radio1" class="wherebuy-radio"  name="wherebuy_radio" value="<?php echo $text_codecan; ?>" type="radio" required /></li>
									<li><label for="wherebuy-radio2"><?php echo $text_opencart; ?></label><input id="wherebuy-radio2" class="wherebuy-radio"  name="wherebuy_radio" value="<?php echo $text_opencart; ?>" type="radio" required /></li>
									<li><label for="wherebuy-radio3"><?php echo $text_forumopencart; ?></label><input id="wherebuy-radio3" class="wherebuy-radio"  name="wherebuy_radio" value="<?php echo $text_forumopencart; ?>" type="radio" required /></li>
									<li><label for="wherebuy-radio4"><?php echo $text_myopencart; ?></label><input id="wherebuy-radio4" class="wherebuy-radio"  name="wherebuy_radio" value="<?php echo $text_myopencart; ?>" type="radio" required /></li>
								</ol>
								<div class="holder domain-holder">
									<span class="listitem-content-wrapper"><label for="user-data-radio"><?php echo $text_purchased; ?></label><input id="user-data-radio" name="user_data" type="text" required></span>
								</div>
								<div class="holder client-mail-holder">
									<label for="client-mail"><?php echo $text_client_mail;?></label>
									<input id="client-mail" name="client_mail" type="text" value="<?php echo $client_mail ?>" required>
								</div>
								<div class="holder client-domain-holder">
									<label for="client-domain"><?php echo $text_domain;?></label>
									<input id="client-domain" name="client_domain" type="text" val="<?php echo $_SERVER['SERVER_NAME']; ?>" required>
								</div>
								<div class="holder client-domain-holder">
								<label for="client-domain"><?php echo $text_comment;?></label>
								<textarea name="" id="" cols="30" rows="10"></textarea>
									</div>
								<button>Send</button>

						</form>
					</div>
				</div>
			</div>


				<style>

					.panel-default button,.container-fluid input[type="button"],.panel-default input[type="submit"]{
						background: #1e91cf;
						border: 1px solid #1978ab;
						padding: 5px 15px;
						border-radius: 3px;
						color: #fff;
					}

					.panel-default button:hover,.panel-default input[type="button"]:hover,.panel-default input[type="submit"]:hover{
						background-color: #1872a2;
						border-color: #115376;
					}

					input[type="text"], textarea{
						display: block;
				    height: 35px;
				    padding: 8px 13px;
				    font-size: 12px;
				    line-height: 1.42857;
				    color: #555;
				    background-color: #fff;
				    background-image: none;
				    border: 1px solid #ccc;
				    border-radius: 3px;
				    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
				    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
				    -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
				    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
					}

					input[type="text"]:focus, textarea:focus{
						border-color: #66afe9;
						outline: 0;
						-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
						box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
					}

					#content textarea{
						margin-bottom:10px;
					}

					.client-form ol{
						padding-left:15px;
					}

					.client-form .listitem-content-wrapper{
						display: block;
					}

					.client-form label{
						margin-right:10px;
						margin-bottom:10px;
						font-family: 'Open Sans', sans-serif !important;
						font-size: 12px !important;
						color: #666666 !important;
					}

					.client-form input[type="radio"]{
						margin-bottom:-3px;
					}

					.client-form textarea{
						width:300px;
						display: block;
						margin-bottom:10px;
					}

					.client-form .holder{
						max-width:300px;
						margin-bottom:10px;
					}

					.client-form .holder:after{
						content:'';
						display: block;
						clear:both;
					}

					.client-form .holder input[type="text"]{
						float: right;
					}
				</style>
	<script>
	$( document ).on( "click", ".send-license", function() {
        $smreview_license = $(".smreview_license").val();
		$.ajax({
			 url: 'index.php?route=extension/module/smreview/addLicense&token=<?php echo $token;?>', // получаем настройки
			 type: 'post',
            data: 'smreview_license='+encodeURIComponent($smreview_license),
            dataType: 'json',
			 success:function(json){
				 if(json == 'true'){
					 $(".license-text").addClass('hidden');
					 $(".success-license").removeClass('hidden');

					 setTimeout(function(){ location.reload(); }, 4000);
					// console.log(json);
		  	} else {
					 $(".not-successe").removeClass('hidden');
				}
			 }
		 });
	});
	</script>
				<script>
					$(function(){
						$('form.client-form').submit(function(e){
							e.preventDefault();
							var str = $( this ).serialize();
                            $.ajax({
                                url: 'index.php?route=extension/module/smreview/requestKey&token=<?php echo $token;?>', // получаем настройки
                                type: 'post',
                                data: str,
                                dataType: 'json',
                                success:function(json){
                                    if(json == 'true'){
                                        $('.send-letter').html('<?php echo $text_success_send_mail;?>');
                                    }
                                }
						});
                        });
						$('#client-domain').val(window.location.hostname);

						$('form.client-form').change(function(){

							var radioArtray = Array.prototype.slice.call($('input.wherebuy-radio'));

							radioArtray.map(function(elem){

								if($(elem).is(':checked')){

									switch($(elem).attr('id')){
										case 'wherebuy-radio1':
										$('#user-data-radio').prev().text('<?php echo $text_purchased;?>');
										break;
										case 'wherebuy-radio2':
										$('#user-data-radio').prev().text('<?php echo $text_opencart_user;?>');
										break;
										case 'wherebuy-radio3':
										$('#user-data-radio').prev().text('<?php echo $text_forumopencart_user;?>');
										break;
										case 'wherebuy-radio4':
										$('#user-data-radio').prev().text('<?php echo $text_payment_numer;?>');
										break;

									};

									$(elem).prev().css('text-decoration','none');

								}else{

									$(elem).prev().css('text-decoration','line-through');

								}
							});
						});
					});
				</script>


		</div>
	</div>
<style>
textarea {
	width: 100%;
    height: 31px;
    padding: 5px;
}
</style>
<?php echo $footer; ?>
