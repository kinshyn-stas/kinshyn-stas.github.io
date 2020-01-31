<footer>
<div class="container">
<div class="row">
                     
                      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        
                        </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"> 
<div  id="error-msg"></div>
									<div class="zag_send"><?php echo $text_subcribe; ?></div>
	<div class="podzag_send"><?php echo $text_podzag; ?></div>
						<div class="fon_send">
                        <input type="text" class="form-control" id="input-newsletter" placeholder="<?php echo $text_newsletter_text; ?>" value="" name="newsletter">
                   
                        <input type="button" id="subcribe" class="btn btn-primary" value="<?php echo $text_subcribe; ?>">
</div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        
                    </div>
                    
                </div>
</div>
  <div class="container">
    <div class="row">
        <div class="hidden-xs hidden-sm col-md-3 col-lg-3">
           <div class="line_vert"><?php echo $content_f1; ?></div>
          </div>
      
        <div class="hidden-xs hidden-sm col-md-3 col-lg-3">
            <div class="line_vert">
              <h5><?php echo $text_information; ?></h5>
              <ul class="list-unstyled">
                <?php foreach ($informations as $information) { ?>
                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="f2"><?php echo $content_f2; ?></div>
            </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="line_vert"> 
            <?php echo $content_f3; ?>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="line_vert2">  
            <?php echo $content_f4; ?>
          </div>
      </div>
      
    </div>
    
  </div>
</footer>
 <div class="copy">
   
   <div class="container">     
     <div class="row">       
        <div class="col-xs-5 col-sm-3 col-md-3 col-lg-3">
          <div class="logo_f"><img src="/image/catalog/logo_f.svg" alt=""></div>
          </div>
       <div class="col-xs-7 col-sm-5 col-md-5 col-lg-5">
         <div class="copy2"><?echo $powered; ?></div>
       </div>    
       <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
          <div class="help"><?echo $text_help; ?><span>0 800 750 - 060</span></div>          
        </div>    
     </div>     
   </div>
   
 </div>

 <script src="catalog/view/javascript/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeft' );
			};


			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}

			}
		</script>

				<!-- ocmodpcart start //-->
				<?php if ($ocmodpcart) { ?>
				<link href="catalog/view/javascript/ocmod/magnific-popup.css" rel="stylesheet" media="screen"/>
				<link href="catalog/view/theme/default/stylesheet/ocmodpcart.css" rel="stylesheet" media="screen"/>
				<script src="catalog/view/javascript/ocmod/jquery.magnific-popup.min.js" type="text/javascript"></script>
				<script type="text/javascript"><!--
				$(function() {
					$.each($("[onclick^='cart.add']"), function() {
						var product_id = $(this).attr('onclick').match(/[0-9]+/);
						$(this).attr('onclick', 'get_ocmodpcart(\'' + $(this).attr('onclick').match(/[0-9]+/) + '\',\'' + 'catalog' + '\');');
					});
					var main_product_id = $('input[name=\'product_id\']').val();
					$('#button-cart').unbind('click').attr('onclick', 'get_ocmodpcart(\'' + main_product_id + '\',\'' + 'product' + '\');');
					$('#cart > button').removeAttr('data-toggle').attr('onclick', 'get_ocmodpcart(false,\'' + 'show_cart' + '\');');
				});
				function get_ocmodpcart(product_id, action, quantity) {
					quantity = typeof(quantity) != 'undefined' ? quantity : 1;
					if (action == "catalog") {
						$.ajax({
							url: 'index.php?route=checkout/cart/add',
							type: 'post',
							data: 'product_id=' + product_id + '&quantity=' + quantity,
							dataType: 'json',
							success: function(json) {
								$('.alert, .text-danger').remove();
								if (json['redirect']) {
									location = json['redirect'];
								}
								if (json['success']) {
									$.magnificPopup.open({
									removalDelay: 300,
									callbacks: {
										beforeOpen: function() {
										   this.st.mainClass = 'mfp-zoom-in';
										}
									},
									tLoading: '',
									items: {
										src: 'index.php?route=extension/module/ocmodpcart',
										type: 'ajax'
									}
									});
									$('#cart-total').html(json['total']);
									$('#cart-total-popup').html(json['total']);
									$('#cart > ul').load('index.php?route=common/cart/info ul li');
								}
							}
						});
					}
					if (action == "product") {
						$.ajax({
							url: 'index.php?route=checkout/cart/add',
							type: 'post',
							data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
							dataType: 'json',
							success: function(json) {
							$('.alert, .text-danger').remove();
							$('.form-group').removeClass('has-error');
							$('.success, .warning, .attention, information, .error').remove();							
								if (json['error']) {
									if (json['error']['option']) {
										for (i in json['error']['option']) {
											$('#input-option' + i).before('<span class="error bg-danger">' + json['error']['option'][i] + '</span>');
										}
									}
								}
								if (json['success']) {
									$.magnificPopup.open({
										removalDelay: 300,
										callbacks: {
											beforeOpen: function() {
											   this.st.mainClass = 'mfp-zoom-in';
											}
										},
										tLoading: '',
										items: {
											src: 'index.php?route=extension/module/ocmodpcart',
											type: 'ajax'
										}
									});
									$('#cart-total').html(json['total']);
									$('#cart-total-popup').html(json['total']);
									$('#cart > ul').load('index.php?route=common/cart/info ul li');
								}
							}
						});
					}
					if (action == "show_cart") {
						$.magnificPopup.open({
							removalDelay: 300,
							callbacks: {
								beforeOpen: function() {
								   this.st.mainClass = 'mfp-zoom-in';
								}
							},
							tLoading: '',
							items: {
								src: 'index.php?route=extension/module/ocmodpcart',
								type: 'ajax'
							}
						});
					}
				}
				//--></script>
				<?php } ?>
				<!-- ocmodpcart stop //-->
			

        <?php if ($smch_status == 1) { ?>
        <!-- <?php echo $smch_form_data['front_module_name'].':'.$smch_form_data['front_module_version']; ?> -->
        <script type="text/javascript">
          $(function() {
            $('body').after("<input name='smch_product_ids' value='' type='hidden' style='display:none;' />");
            
            var smch_product_ids_array = [];
            
            <?php foreach ($smch_add_function_selectors as $add_function_selector) { ?>
              $.each($("[onclick^='<?php echo $add_function_selector; ?>']"), function() {
                smch_product_ids_array.push($(this).attr('onclick').match(/[0-9]+/));
              });
            <?php } ?>

            var product_id_in_page = $("<?php echo $smch_form_data['main_product_id_selector']; ?>").val();
            if (typeof(product_id_in_page) != 'undefined') {
              smch_product_ids_array.push(product_id_in_page);
            }

            var smch_product_id = smch_product_ids_array;
            $("input[name='smch_product_ids']").attr('value', smch_product_id);

            $.ajax({
              type: 'post',
              url:  'index.php?route=ocdevwizard/smart_checkout/getProducts&smch_product_ids=' + $("input[name='smch_product_ids']").val(),
              dataType: 'json',
              success: function(json) {
                if (json['products']) {
                  var product_id_in_page = $("<?php echo $smch_form_data['main_product_id_selector']; ?>").val();

                  $.each(json['products'], function(v_i,value) {
                    $.each(json['add_function_selectors'], function(f_i,f_selector) {                     
                      $('[onclick^="'+f_selector+'(\''+value+'\'"]').before("<div onclick='getOCwizardModal_smch(" + value + ")' class='button-group'><button class='smch-call-button'><i class='fa fa-lightbulb-o'></i> "+json['call_button']+"</button></div>");
                    });
                    
                    if (typeof(product_id_in_page) != 'undefined') {
                      $.each(json['add_id_selectors'], function(i,i_selector) {
                        if (product_id_in_page == value) {
                          $(i_selector).before("<button onclick='getOCwizardModal_smch(" + product_id_in_page + ")' class='smch-call-button btn btn-primary btn-lg btn-block'>"+json['call_button']+"</button>");
                        }
                      });
                    }
                  });
                }
              }
            });
          });

          function getOCwizardModal_smch(product_id) {
            $.magnificPopup.open({
              tLoading: '<img src="catalog/view/theme/default/stylesheet/ocdevwizard/smart_checkout/loading.svg" alt="" />',
              items: {
                src: 'index.php?route=ocdevwizard/smart_checkout&product_id='+product_id,
                type: 'ajax'
              },
              showCloseBtn: false
            });
            $('.mfp-bg').css({
              'background': 'url(image/ocdevwizard/smart_checkout/background/<?php echo $smch_form_data['style_background']; ?>)',
              'opacity': '<?php echo ($smch_form_data['background_opacity'] == 0) ? $smch_form_data['background_opacity'] : $smch_form_data['background_opacity']/10; ?>'
            });
          }
        </script>
        <!-- <?php echo $smch_form_data['front_module_name'].':'.$smch_form_data['front_module_version']; ?> -->
        <?php } ?>
      

						 <style type="text/css">
							#ToTopHover {
							cursor: pointer;
							background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAABmCAYAAABm4qluAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OThENzgzMjVCNzRCMTFFM0EzRDU5MjlENjBGMTBDRUEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OThENzgzMjZCNzRCMTFFM0EzRDU5MjlENjBGMTBDRUEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5OEQ3ODMyM0I3NEIxMUUzQTNENTkyOUQ2MEYxMENFQSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OEQ3ODMyNEI3NEIxMUUzQTNENTkyOUQ2MEYxMENFQSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pl4ggucAAAtuSURBVHjazFwLcBbV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) no-repeat left -51px;width: 51px;height: 51px;display: block;overflow: hidden;float: left;opacity: 0;-moz-opacity: 0;filter: alpha(opacity=0);}
							#ToTop {display: none;text-decoration: none;position: fixed;bottom: 20px;right: 20px;overflow: hidden;width: 51px;height: 51px;border: none;text-indent: -999px;background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAABmCAYAAABm4qluAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OThENzgzMjVCNzRCMTFFM0EzRDU5MjlENjBGMTBDRUEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OThENzgzMjZCNzRCMTFFM0EzRDU5MjlENjBGMTBDRUEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5OEQ3ODMyM0I3NEIxMUUzQTNENTkyOUQ2MEYxMENFQSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OEQ3ODMyNEI3NEIxMUUzQTNENTkyOUQ2MEYxMENFQSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pl4ggucAAAtuSURBVHjazFwLcBbV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) no-repeat left top;}
						</style>
						<script type="text/javascript">
						/* UItoTop jQuery */
						jQuery(document).ready(function(){$().UItoTop({easingType:'easeOutQuint'});});
						(function($){
							$.fn.UItoTop = function(options) {
								var defaults = {
									text: 'To Top',
									min: 200,
									inDelay:600,
									outDelay:400,
									containerID: 'ToTop',
									containerHoverID: 'ToTopHover',
									scrollSpeed: 1600,
									easingType: 'linear'
								};
								var settings = $.extend(defaults, options);
								var containerIDhash = '#' + settings.containerID;
								var containerHoverIDHash = '#'+settings.containerHoverID;
								$('body').append('<span id="'+settings.containerID+'">'+settings.text+'</span>');
								$(containerIDhash).hide().click(function(event){
									$('html, body').animate({scrollTop: 0}, settings.scrollSpeed);
									event.preventDefault();
								})
								.prepend('<span id="'+settings.containerHoverID+'"></span>')
								.hover(function() {
										$(containerHoverIDHash, this).stop().animate({
											'opacity': 1
										}, 600, 'linear');
									}, function() { 
										$(containerHoverIDHash, this).stop().animate({
											'opacity': 0
										}, 700, 'linear');
									});			
								$(window).scroll(function() {
									var sd = $(window).scrollTop();
									if(typeof document.body.style.maxHeight === "undefined") {
										$(containerIDhash).css({
											'position': 'absolute',
											'top': $(window).scrollTop() + $(window).height() - 50
										});
									}
									if ( sd > settings.min ) 
										$(containerIDhash).fadeIn(settings.inDelay);
									else 
										$(containerIDhash).fadeOut(settings.Outdelay);
								});
						};
						})(jQuery);
						</script>
                        
</body></html>