<?php if($show_title) { ?>
 
<div class="zag_mod"><span><?php echo $heading_title; ?></span></div>
<?php } ?>
<div id="carouselnewlist" class="owl-carousel">
	<?php foreach ($news as $news_item) { ?>
		<div class="item">
		 	<?php if($news_item['thumb']) { ?>
			<div class="image"><a href="<?php echo $news_item['href']; ?>"><img src="<?php echo $news_item['thumb']; ?>" alt="<?php echo $news_item['title']; ?>" title="<?php echo $news_item['title']; ?>" class="img-responsive" /></a></div>
			<?php } ?>
		 
			<div class="blog_title1"><a href="<?php echo $news_item['href']; ?>"><?php echo $news_item['title']; ?></a></div>
			<div class="blog_stats1">
					<?php echo $news_item['posted']; ?>
			</div>
			<div class="desc_blog"><?php echo $news_item['description']; ?></div>
		 
		 
		 
	</div>
	<?php } ?>
</div>
<script type="text/javascript"><!--
	$('#carouselnewlist').owlCarousel({
		items: 3,
		autoPlay: false,
		navigation: true,
		navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
		pagination: false
	});
	--></script>