<div class="box-heading"><?php echo $heading_title; ?></div>
<div class="row information">
    <?php foreach ($informations as $information) { ?>
        <div class="col-lg-6 col-sm-12 col-xs-12 item">
        <div class="">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <a class="thumbnail" href="<?php echo $information['href']; ?>"><img src="<?php echo $information['thumb']; ?>" alt="<?php echo $information['name']; ?>" title="<?php echo $information['name']; ?>" class="img-responsive" /></a>
                </div>
                <div class="col-lg-8 col-sm-8 col-xs-12">
                    <div class="h5"><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></div>
                    <?php if ($information['date']) { ?>
                        <p class="text-muted"><i class="fa fa-calendar"></i> &nbsp;<?php echo $information['date']; ?></p>
                    <?php } ?>
                    <p><?php echo $information['short_description']; ?></p>
                </div>

            </div>
        </div>
        </div>
    <?php } ?>
</div>