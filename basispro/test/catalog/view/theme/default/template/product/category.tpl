<?php echo $header; ?>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <?php if ($category_show_image) { ?>
    <?php $category_description_class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $category_description_class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
      <?php include DIR_APPLICATION . '/view/theme/default/template/_breadcrumb.tpl'; ?>
        <?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>

        <?php if ($category_description_top) { ?>
            <?php if (($thumb && $category_show_image) || $description) { ?>
                <div class="row">
                    <?php if ($description) { ?>
                        <div class="<?php echo $category_description_class; ?>"><?php echo $description; ?></div>
                    <?php } ?>
                    <?php if ($thumb && $category_show_image) { ?>
                        <div class="col-sm-3"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

      <?php if ($categories) { ?>
        <?php if ($show_text_refine) { ?>
          <h3><?php echo $text_refine; ?></h3>
        <?php } ?>

        <?php if ($subcat_text_view) { ?>
              <?php if (count($categories) <= 5) { ?>
              <div class="row">
                <div class="col-sm-3">
                  <ul>
                    <?php foreach ($categories as $category) { ?>
                    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <?php } else { ?>
              <div class="row">
                <?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
                <div class="col-sm-3">
                  <ul>
                    <?php foreach ($categories as $category) { ?>
                    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
        <?php } else { ?>
            <div class="row  category-list">
                <?php foreach ($categories as $category) { ?>
                    <div class="col-lg-2 col-sm-3 col-xs-6">
                        <div class="subcat-thumb">
                            <a href="<?php echo $category['href']; ?>"><img class="img-responsive" src="<?php echo $category['thumb']; ?>" alt=""><?php echo $category['name']; ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
      <?php } ?>
      <?php if ($products) { ?>
          <?php include DIR_APPLICATION . '/view/theme/default/template/product/_product_controls.tpl'; ?>
          <?php include DIR_APPLICATION . '/view/theme/default/template/product/_product_array.tpl'; ?>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } ?>

        <?php if (!$category_description_top) { ?>
            <?php if (($thumb && $category_show_image) || $description) { ?>
                <br>
                <hr>
                <div class="row">
                    <?php if ($description) { ?>
                        <div class="<?php echo $category_description_class; ?>"><?php echo $description; ?></div>
                    <?php } ?>
                    <?php if ($thumb && $category_show_image) { ?>
                        <div class="col-sm-3"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-responsive" /></div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

      <?php if (!$categories && !$products) { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>