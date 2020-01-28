<div class="box-heading"><?php echo $heading_title; ?></div>
<div class="list-group">
  <?php foreach ($categories as $category) { ?>
      <?php if ($category['category_id'] == $category_id) { ?>
          <a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a>
      <?php } else { ?>
          <a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a>
      <?php } ?>
  <?php } ?>
</div>
