<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
      <?php $last_crumb = array_pop($breadcrumbs); ?>
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
      <li><?php echo $last_crumb['text']; ?></li>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
    
    <div class="container-fluid border_blog">      
      <div class="row blogs">        
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1><?php echo $heading_title; ?></h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <div class="date_sale_det"><?php echo $date_added_full; ?></div>  
        </div>
            
            
           
                  
                 
                  
        </div>    
        
        <div class="row">
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="main_description">
                  <?php echo $description; ?>
                    </div>
          </div>
          
        </div>
         
      </div>
  
     
    
    
      </div>
    <?php echo $column_right; ?></div>
</div>

<div class="container">
  
  <div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php echo $content_bottom; ?> 
    </div>
    
  </div>
  
</div>


<script type="text/javascript"><!--

$('#comment').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
	$("html,body").animate({scrollTop:(($("#comment").offset().top)-50)},500);
    $('#comment').fadeOut(50);

    $('#comment').load(this.href);

    $('#comment').fadeIn(500);
	
});

$('#comment').load('index.php?route=blog/blog/comment&blog_id=<?php echo $blog_id; ?>');
//--></script>

<script type="text/javascript"><!--

$('#button-comment').on('click', function() {
	$.ajax({
		url: 'index.php?route=blog/blog/write&blog_id=<?php echo $blog_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#comment_form").serialize(),
		
		complete: function() {
			$('#button-comment').button('reset');
			$('#captcha_comment').attr('src', 'index.php?route=blog/blog/captcha#'+new Date().getTime());
			$('input[name=\'captcha_comment\']').val('');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();
			
			if (json['error']) {
				$('#comment').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}
			
			if (json['success']) {
				$('#comment').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
				
				$('input[name=\'name\']').val('');
				$('input[name=\'email\']').val('');
				$('textarea[name=\'comment\']').val('');
				$('input[name=\'captcha_comment\']').val('');
			}
		}
	});
});    

</script>
<?php echo $footer; ?> 