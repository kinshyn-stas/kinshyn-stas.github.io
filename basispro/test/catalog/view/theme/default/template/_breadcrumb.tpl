<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <?php if($i+1<count($breadcrumbs)) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } else { ?>
            <li><?php echo $breadcrumb['text']; ?></li>
        <?php } ?>
    <?php } ?>
</ul>