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
    <div id="content" class="<?php echo $class; ?> information"><?php echo $content_top; ?>
      <?php include DIR_APPLICATION . '/view/theme/default/template/_breadcrumb.tpl'; ?>
      <h1><?php echo $heading_title; ?></h1>

        <?php foreach ($informations as $information) { ?>
        <div class="row">

                    <div class="col-lg-2 col-sm-3 col-xs-12">
                        <a class="thumbnail" href="<?php echo $information['href']; ?>"><img src="<?php echo $information['thumb']; ?>" alt="<?php echo $information['name']; ?>" title="<?php echo $information['name']; ?>" class="img-responsive" /></a>
                    </div>
                    <div class="col-lg-10 col-sm-9 col-xs-12">
                        <div class="h5"><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></div>
                        <?php if ($information['date']) { ?>
                            <p class="text-muted"><i class="fa fa-calendar"></i> &nbsp;<?php echo $information['date']; ?></p>
                        <?php } ?>
                        <p><?php echo $information['short_description']; ?></p>
                    </div>

        </div>
        <?php } ?>

      <?php echo $description; ?><?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php /*
    <script>
        $( document ).ready(function() {
            cols = $('#column-right, #column-left').length;

            if (cols == 2) {
                $('#content .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
            } else if (cols == 1) {
                $('#content .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
            } else {
                $('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
            }
        });
    </script>
    */ ?>
<?php echo $footer; ?>