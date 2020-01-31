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
      <div class="zag_uspeh"><?php echo $heading_title; ?></div>
      <div class="uspeh1"><?php echo $text_customer; ?></div>
     
      <div align="center"><img src="/image/catalog/uspeh.jpg" class="img-responsive" alt=""></div>
      <div class="uspeh2"><?php echo $text_guest; ?></div>
      <a href="<?php echo $continue; ?>" class="but_uspeh">Вернутся в магазин</a>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>