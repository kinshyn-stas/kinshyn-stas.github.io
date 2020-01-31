<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php $b_i = 1; ?>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li>
        <?php if ($b_i < (count($breadcrumbs))) { ?>
          <a href="<?php echo $breadcrumb['href']; ?>"><span><?php echo $breadcrumb['text']; ?></span></a>
        <?php } else { ?>
          <span><?php echo $breadcrumb['text']; ?></span>
        <?php } ?>
      </li>
      <?php $b_i++; ?>
    <?php } ?>
  </ul>
  <div class="row">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> <?php echo $_code; ?>-content">
      <?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php if (($thumb && $show_main_image) || ($images && $show_additional_image)) { ?>
      <div class="images-block">
        <?php if ($thumb && $show_main_image) { ?>
          <div class="image-main"><a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
        <?php } ?>
        <?php if ($images && $show_additional_image) { ?>
          <div class="image-additionals">
            <div class="inner">
              <?php foreach ($images as $image) { ?>
              <div><a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
              <?php } ?>
              <?php if ($images_other) { ?>
                <?php foreach ($images_other as $image) { ?>
                <div class="more-image-additionals"><a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                <?php } ?>
                <div class="show-image-additionals" onclick="$('.more-image-additionals').toggleClass('active');$(this).find('span').toggle();">
                  <div><span>+<?php echo $images_other_total; ?></span><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($description && $show_description && $description_position == 1) { ?>
      <div id="<?php echo $_code; ?>-category-description"><?php echo $description; ?></div>
      <br/>
      <?php } ?>
      <?php if ($posts) { ?>
      <div class="row">
        <div class="col-md-7" <?php if (!$show_disaply_view_on_author) { ?>style="display:none;"<?php } ?>>
          <div class="btn-group">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
          </div>
        </div>
        <?php if ($show_sort_on_author) { ?>
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon"><?php echo $text_sort; ?></span>
            <select id="input-sort" class="form-control col-sm-3" onchange="location = this.value;">
              <?php foreach ($sorts as $sorts) { ?>
                <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                  <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <?php } ?>
        <?php if ($show_limit_on_author) { ?>
        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon"><?php echo $text_limit; ?></span>
            <select id="input-limit" class="form-control" onchange="location = this.value;">
              <?php foreach ($limits as $limits) { ?>
                <?php if ($limits['value'] == $limit) { ?>
                  <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <?php } ?>
      </div>
      <br />
      <div class="row">
        <?php foreach ($posts as $post) { ?>
          <div class="product-layout product-list col-xs-12">
            <div class="product-thumb transition <?php echo $_code; ?>-post-item">
              <?php if ($show_image_on_author) { ?>
                <?php if ($post['show_main_image'] == 1) { ?>
                <div class="image">
                  <a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" alt="<?php echo $post['name']; ?>" title="<?php echo $post['name']; ?>" class="img-responsive"/></a>
                </div>
                <?php } ?>
                <?php if ($post['video'] && $post['show_main_image'] == 2) { ?>
                <div class="video">
                  <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $post['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $post['video']; ?>/0.jpg');">
                    <div>
                      <i class="fa fa-play"></i>
                      <span></span>
                      <span></span>
                    </div>
                  </div>
                </div>
                <?php } ?>
              <?php } ?>
              <div class="caption">
                <a class="<?php echo $_code; ?>-post-heading" href="<?php echo $post['href']; ?>"><?php echo $post['name']; ?></a>
                <?php if ($post['author'] && $show_author_on_author) { ?><b><?php echo $post['author']; ?></b> - <?php } ?><?php if ($show_date_added_on_author) { ?><?php echo $post['date_added']; ?><br/><?php } ?>
                <?php if ($show_description_on_author && $post['short_description']) { ?>
                  <div class="description"><?php echo $post['short_description']; ?></div>
                <?php } ?>
                <?php if ($show_count_comments_on_author) { ?>
                <i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $post['comments']; ?>&nbsp;&nbsp;
                <?php } ?>
                <?php if ($show_count_viewed_on_author) { ?>
                <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $post['viewed']; ?><br/>
                <?php } ?>
              </div>
              <?php if ($show_read_more_button_on_author) { ?>
              <a href="<?php echo $post['href']; ?>"><?php echo $text_button_readmore; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="row">
        <?php if ($show_pagination_results_on_author) { ?>
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        <?php } else { ?>
        <div class="col-sm-12 text-left"><?php echo $pagination; ?></div>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($description && $show_description && $description_position == 2) { ?>
      <br/>
      <div id="<?php echo $_code; ?>-author-description"><?php echo $description; ?></div>
      <?php } ?>
      <?php if (!$posts) { ?>
      <p><?php echo $text_empty_author; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php if (($thumb && $show_main_image) || ($images && $show_additional_image)) { ?>
  <script>
  $(document).ready(function() {
    $('.images-block').magnificPopup({
      type:'image',
      delegate: 'a',
      gallery: {
        enabled:true
      }
    });
  });
  </script>
<?php } ?>
<?php if ($allow_schema_on_post) { ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
    <?php $b_i = 1; ?>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      {
        "@type": "ListItem",
        "position": <?php echo $b_i; ?>,
        "name": "<?php echo $breadcrumb['text']; ?>",
        "item": "<?php echo $breadcrumb['href']; ?>"
      }<?php if ($b_i < (count($breadcrumbs))) { ?>,<?php } ?>
      <?php $b_i++; ?>
    <?php } ?>
    ]
  }
  </script>
  <?php if ($posts) { ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ItemList",
    "itemListElement": [
    <?php $p_i = 1; ?>
      <?php foreach ($posts as $post) { ?>
      {
        "@type":"ListItem",
        "position": "<?php echo $p_i; ?>",
        "url":"<?php echo $post['href']; ?>",
        "name": "<?php echo $post['name']; ?>"
      }<?php if ($p_i < (count($posts))) { ?>,<?php } ?>
      <?php $p_i++; ?>
      <?php } ?>
    ]
  }
  </script>
  <?php } ?>
<?php } ?>
<?php echo $footer; ?>