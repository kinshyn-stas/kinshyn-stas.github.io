<style>
#cboxLoadedContent{
    overflow: inherit !important;
}
</style>
<div id="cheaper"></div>
<script type="text/javascript">
$(function (){
	//define the new for the plugin ans how to call it	
	$.fn.cheaper = function(options) {
		//set default options  
		var defaults = {
			url: 'index.php?route=extension/module/cheaper/cheapermailsend&product_id=<?php echo $product_id; ?>',
			namer: '<?php echo $name_msg; ?>',
			number: '<?php echo $telefon; ?>',
			desired_price : '<?php echo $text_desired_price; ?>',
			search_cheaper : '<?php echo $text_search_cheaper; ?>',
			subject : '<?php echo $subject; ?>',
			submit : '<?php echo $send; ?>',
			recievedMsg : '<?php echo $recievedMsg; ?>',
			notRecievedMsg : '<?php echo $notRecievedMsg; ?>',
			hideOnSubmit: false
		};
		
		//call in the default otions
		var options = $.extend(defaults, options);
		//act upon the element that is passed into the design    
		return this.each(function() {
			//construct the form
			var this_id_prefix = '#'+this.id+' ';
			$(this).html('<div id="cheaper_block"><form enctype="multipart/form-data" method="post" id="cheaper_tovar"><div id="loading"></div><div id="quick_cheaper"><h1 class="text_h1_quick"><?php echo $text_cheaper; ?></h1><h4 class="text_h4_quick"><?php echo $help_text_cheaper; ?></h4><div class="image_block"><div class="image"><a href="<?php echo $href_tovar; ?>"><img src="<?php echo $image; ?>" alt=""  title="" /></a></div><div class="name"><a href="<?php echo $href_tovar; ?>"><?php echo $name; ?></a></div><?php if ($price) { ?><span class="price"><?php if (!$special) { ?><?php echo $price; ?><?php } else { ?><span class="price-new"><?php echo $special; ?></span><span class="price-old"><?php echo $price; ?></span><?php } ?></span><?php } ?></div><div class="clearboth"></div><h1 class="line_bottom"> </h1><div class="form-group required"><label data-icon="u" class="col-sm-4 control-label uname" for="namer">'+options.namer+'</label><div class="col-sm-8"><input type="text" placeholder="" required="required" name="namer" id="namer"></div></div><div class="clearboth"></div><div class="form-group required"><label data-icon="u" class="col-sm-4 control-label uname" for="number">'+options.number+'</label><div class="col-sm-8"><input type="text" placeholder="" required="required" name="number" id="number"></div></div><div class="clearboth"></div><div class="form-group required"><label data-icon="u" class="col-sm-4 control-label uname" for="desired_price">'+options.desired_price+'</label><div class="col-sm-8"><input type="text" placeholder="" required="required" name="desired_price" id="desired_price"></div></div><div class="clearboth"></div><div class="form-group required"><label data-icon="u" class="col-sm-4 control-label uname" for="search_cheaper">'+options.search_cheaper+'</label><div class="col-sm-8"><input type="text" placeholder="Ссылка на товар в интернете" required="required" name="search_cheaper" id="search_cheaper"></div></div><div class="clearboth"></div><br />	<p class="cheaper button"><input type="submit" value="'+options.submit+'" name="quick1" class="btn-primary"></p></div></form></div>');

			//validate the form 
			$(this_id_prefix+"#cheaper_tovar").validate({
				//set the rules for the fild names
				rules: {
					namer: {
						required: true,
						minlength: 2
					},
					number: {
						required: true,
						minlength: 3
					},
					desired_price: {
						required: false
					},
					search_cheaper: {
						required: false
					}
				}, 
				//set messages to appear inline
				messages: {
					namer: "",
					number: "",
					desired_price: "",
					search_cheaper: ""
				},
				
				submitHandler: function() {
					$(this_id_prefix+'#quick_cheaper').hide();
					$(this_id_prefix+'#loading').show();
					$('#colorbox').css({display: 'block'});
				$.ajax({
				  type: 'POST',
				  url: options.url,
				  data: {subject:options.subject, namer:$(this_id_prefix+'#namer').val(), number:$(this_id_prefix+'#number').val(), desired_price:$(this_id_prefix+'#desired_price').val(),search_cheaper:$(this_id_prefix+'#search_cheaper').val()},
				  success: function(data){
						$(this_id_prefix+'#loading').css({display:'none'}); 
						if( data == 'success') {
							$(this_id_prefix+'#quick_cheaper').show().append(options.recievedMsg);
							$(this_id_prefix+'.line_bottom').hide();
							$(this_id_prefix+'h4').hide();
							$(this_id_prefix+'.form-group').hide();
							$(this_id_prefix+'.image_block').hide();
							$(this_id_prefix+'.cheaper').hide();
							$("#quick_cheaper").addClass("mess");
							setTimeout(function(){
								$('#cboxClose').click();
							},3000);
						} else {
							$(this_id_prefix+'#quick_cheaper').show().append(options.notRecievedMsg);
							$(this_id_prefix+'.line_bottom').hide();
							$(this_id_prefix+'h4').hide();
							$(this_id_prefix+'.form-group').hide();
							$(this_id_prefix+'.image_block').hide();
							$(this_id_prefix+'.cheaper').hide();
							$("#quick_cheaper").addClass("mess");
							setTimeout(function(){
								$('#cboxClose').click();
							},3000);
						}
					},
					error:function(){
						$(this_id_prefix+'#quick_cheaper').show().append(options.notRecievedMsg);
						$(this_id_prefix+'.line_bottom').hide();
						$(this_id_prefix+'h4').hide();
						$(this_id_prefix+'.form-group').hide();
						$(this_id_prefix+'.image_block').hide();
						$(this_id_prefix+'.cheaper').hide();
						$("#quick_cheaper").addClass("mess");
						setTimeout(function(){
							$('#cboxClose').click();
						},3000);
					}
				});	
				}
			});
		});
	};
 
});
$(function (){
    $('#cheaper').cheaper({
    subject: 'feedback URL:'+location.href});
});
</script>