<footer>
<div class="container">
sendf
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
</body></html>