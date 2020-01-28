<ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <?php if($i+1<count($breadcrumbs)) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } else { ?>
            <li><?php echo $breadcrumb['text']; ?></li>
        <?php } ?>
    <?php } ?>
</ul>

<?php
    $str = '';
    foreach ($breadcrumbs as $i=> $breadcrumb){
        $itr = $i + 1;
        if($i+1<count($breadcrumbs)){
            if($i == 0){
                $str .= '  {
                "@type": "ListItem",
                "position": '.$itr.',
                "item":
                {
                "@id": "'.$breadcrumb['href'].'",
                "name": "Главная"
                }
                },';
            }else{
                $str .= '  {
                "@type": "ListItem",
                "position": '.$itr.',
                "item":
                {
                "@id": "'.$breadcrumb['href'].'",
                "name": "'.$breadcrumb['text'].'"
                }
                },';
            }
        }else {
            $str .= '            {
            "@type": "ListItem",
            "position": '.$itr.',
            "item":
            {
            "@id": "'.$breadcrumb['href'].'",
            "name": "'.$breadcrumb['text'].'"
            }
            }';
        }
    }
?>

<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement":
        [
            <?= $str; ?>
        ]
    }
</script>