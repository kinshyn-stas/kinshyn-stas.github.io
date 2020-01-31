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
      <div class="blog">
		<h1><?php echo $heading_title; ?></h1>
  		
        <?php if ($blog_category_description) { ?>
		<div class="main_description">
		<?php echo $blog_category_description; ?>
		</div>
		<?php } ?>
        
  	<?php if($blogs){ ?>
	
  <div class="container">
<div class="row">  
            <?php foreach ($blogs as $blog) { ?>
              <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                  <div class="fon_rel_blog">
                  <?php if($blog['image']){ ?>
                    <div class="image">
            <a href="<?php echo $blog['href']; ?>"><img src="<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" title="<?php echo $blog['title']; ?>" /></a>
                    </div>
            <?php } ?>
           <?php echo $blog['short_description']; ?>
           <div class="line_sale"></div>
                <div class="blog_title"><a href="<?php echo $blog['href']; ?>"><?php echo $blog['title']; ?></a></div>
            
                </div>
               </div>
			<?php } ?>
    </div>       
          </div>
		<div class="row">
       
        <div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
      </div>
 
	<?php } ?>
    </div>
      </div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 