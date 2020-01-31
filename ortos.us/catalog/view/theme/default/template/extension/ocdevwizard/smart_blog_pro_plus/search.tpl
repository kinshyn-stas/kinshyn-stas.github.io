<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php $b_i = 1; ?>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li>
      <?php if ($b_i < (count($breadcrumbs))) { ?><a href="<?php echo $breadcrumb['href']; ?>"><span><?php echo $breadcrumb['text']; ?></span></a><?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?>
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
      <label class="control-label" for="input-search"><?php echo $entry_search; ?></label>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $entry_search; ?>" id="input-search" class="form-control"/>
          <label class="checkbox-inline">
            <?php if ($sub_category) { ?>
            <input type="checkbox" name="sub_category" value="1" checked="checked"/>
            <?php } else { ?>
            <input type="checkbox" name="sub_category" value="1"/>
            <?php } ?>
            <?php echo $text_sub_category; ?>
          </label>
          <br/>
          <label class="checkbox-inline">
            <?php if ($description) { ?>
            <input type="checkbox" name="description" value="1" id="description" checked="checked"/>
            <?php } else { ?>
            <input type="checkbox" name="description" value="1" id="description"/>
            <?php } ?>
            <?php echo $entry_description; ?>
          </label>
        </div>
        <div class="col-sm-3">
          <select name="category_id" class="form-control">
            <option value="0"><?php echo $text_category; ?></option>
            <?php foreach ($categories as $category_1) { ?>
            <?php if ($category_1['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_1['children'] as $category_2) { ?>
            <?php if ($category_2['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
            <?php } ?>
            <?php foreach ($category_2['children'] as $category_3) { ?>
            <?php if ($category_3['category_id'] == $category_id) { ?>
            <option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-3">
          <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="btn btn-primary"/>
        </div>
      </div>
      <h2><?php echo $text_search; ?></h2>
      <?php if ($posts) { ?>
        <div class="row">
          <div class="col-md-7" <?php if (!$show_disaply_view_on_search) { ?>style="display:none;"<?php } ?>>
          <div class="btn-group">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
          </div>
        </div>
        <?php if ($show_sort_on_search) { ?>
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
        <?php } ?><?php if ($show_limit_on_search) { ?>
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
      <br/>
      <div class="row">
        <?php foreach ($posts as $post) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb transition <?php echo $_code; ?>-post-item">
            <?php if ($show_image_on_search) { ?>
              <?php if ($post['show_main_image'] == 1) { ?>
                <div class="image">
                  <a href="<?php echo $post['href']; ?>"><img src="<?php echo $post['image']; ?>" title="<?php echo $post['name']; ?>" alt="<?php echo $post['main_image_alt']; ?>" class="img-responsive"/></a>
                </div>
              <?php } elseif ($post['show_main_image'] == 2) { ?>
                <div class="video">
                  <div class="video-inner" onclick="<?php echo $_code; ?>_open_video({a:this,b:'<?php echo $post['post_id']; ?>'});">
                    <img src="<?php echo $post['image']; ?>" title="<?php echo $post['name']; ?>" alt="<?php echo $post['main_image_alt']; ?>" class="img-responsive"/>
                    <div><i class="fa fa-play"></i><span></span><span></span></div>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
            <div class="caption">
              <a class="<?php echo $_code; ?>-post-heading" href="<?php echo $post['href']; ?>"><?php echo $post['name']; ?></a>
              <?php if ($post['author'] && $show_author_on_search) { ?>
              <b><?php echo $post['author']; ?></b> - <?php } ?><?php if ($show_date_added_on_search) { ?><?php echo $post['date_added']; ?><br/><?php } ?>
              <?php if ($show_description_on_search && $post['short_description']) { ?>
              <div class="description"><?php echo $post['short_description']; ?></div>
              <?php } ?>
              <?php if ($show_count_comments_on_search) { ?>
              <i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $post['comments']; ?>&nbsp;&nbsp;
              <?php } ?>
              <?php if ($show_count_viewed_on_search) { ?>
              <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $post['viewed']; ?><br/>
              <?php } ?>
              <?php if ($show_read_more_button_on_search) { ?>
              <a href="<?php echo $post['href']; ?>"><?php echo $text_button_readmore; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="row">
        <?php if ($show_pagination_results_on_search) { ?>
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        <?php } else { ?>
        <div class="col-sm-12 text-left"><?php echo $pagination; ?></div>
        <?php } ?>
      </div>
    <?php } else { ?>
      <p><?php echo $text_empty_search; ?></p>
    <?php } ?>
    <?php echo $content_bottom; ?>
  </div>
  <?php echo $column_right; ?>
</div>
</div>
<script>
$('#button-search').bind('click', function() {
	url = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/search';

	var search = $('#content input[name=\'search\']').prop('value');

	if (search) {
		url += '&<?php echo $_code; ?>_search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').prop('value');

	if (category_id > 0) {
		url += '&<?php echo $_code; ?>_category_id=' + encodeURIComponent(category_id);
	}

	var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

	if (sub_category) {
		url += '&<?php echo $_code; ?>_sub_category=true';
	}

	var filter_description = $('#content input[name=\'description\']:checked').prop('value');

	if (filter_description) {
		url += '&<?php echo $_code; ?>_description=true';
	}

	location = url;
});

$('#content input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').on('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').prop('disabled', true);
	} else {
		$('input[name=\'sub_category\']').prop('disabled', false);
	}
});

$('select[name=\'category_id\']').trigger('change');
</script>
<?php if ($allow_schema_on_search) { ?>
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