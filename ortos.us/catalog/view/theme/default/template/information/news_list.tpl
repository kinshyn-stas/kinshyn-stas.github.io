<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
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
			<div class="zag_mod"><h1><?php echo $heading_title; ?></h1></div>
			<?php if ($news_list) { ?>
			 
			<div class="row">
				<?php foreach ($news_list as $news_item) { ?>
				
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<div class="fon_new_one">
						<?php if($news_item['thumb']) { ?>
							<div class="image"><a href="<?php echo $news_item['href']; ?>"><img src="<?php echo $news_item['thumb']; ?>" alt="<?php echo $news_item['title']; ?>" title="<?php echo $news_item['title']; ?>" class="img-responsive" /></a></div>
							<?php } ?>
						 
							<div class="blog_title1"><a href="<?php echo $news_item['href']; ?>"><?php echo $news_item['title']; ?></a></div>
							<div class="blog_stats1">
									<?php echo $news_item['posted']; ?>
							</div>
							<div class="desc_blog"><?php echo $news_item['description']; ?></div>
						 
						 
				</div>
			</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center"><?php echo $pagination; ?></div>
				<div class="col-sm-12 text-center"><?php echo $results; ?></div>
			</div>
			 
			<?php } ?>
		<?php echo $content_bottom; ?></div>
	<?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>