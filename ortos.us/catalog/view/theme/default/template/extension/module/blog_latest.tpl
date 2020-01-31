<div class="blog-module latest blog">

<div class="zag_mod"><span><?php echo $heading_title_latest; ?></span></div>
    <?php if(!empty($posts)){ ?>
	<div class="blog_grid_holder latest column-<?php echo $columns; ?> carousel-<?php echo $carousel; ?> <?php echo $module; ?>">
    <?php foreach ($posts as $blog) { ?>
				<div class="blog_item1">
                
                
                
                <?php if($blog['image'] && $thumb){ ?>
                <div class="image">
				<a href="<?php echo $blog['href']; ?>"><img src="<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" title="<?php echo $blog['title']; ?>" /></a>
                </div>
                <?php } ?>
                <div class="blog_title1"><a href="<?php echo $blog['href']; ?>"><?php echo $blog['title']; ?></a></div>
                <div class="blog_stats1">
                
                        <?php if($date_added_status){ ?><?php echo $blog['date_added_full']; ?><?php } ?>
                         
                        </div>
                <?php if(!$characters == '0'){ ?>
            	<div class="desc_blog"><?php echo $blog['description']; ?></div>
                <?php } ?>
                
               </div>
			<?php } ?>
		</div>
	<?php } ?>
</div>

<?php if($carousel) { ?>
<script type="text/javascript">
$(document).ready(function() {
$('.blog_grid_holder.carousel-1.<?php echo $module; ?>').owlCarousel({
itemsCustom: [ [0, 1], [767, 2], [992, <?php echo $columns;?>]],
pagination: false,
navigation:true,
navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
slideSpeed:500
}); });
</script>
<?php } ?>