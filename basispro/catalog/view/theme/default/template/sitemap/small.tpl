<?php
$host = 'https://'.$_SERVER['HTTP_HOST'];
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <?php foreach($categories as $category): ?>
    <url>
        <loc><?= $host . '/' . $category['keyword']. '/'; ?></loc>
        <?php if(isset($category['date_modified'])): ?>
        <lastmod><?php echo gmdate("Y-m-d", strtotime($category['date_modified'])); ?></lastmod>
        <?php endif; ?>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>


    <?php foreach($info as $item): ?>
    <?php if(isset($item['keyword'])): ?>
    <url>
        <loc><?= $host . '/' . $item['keyword']. '/'; ?></loc>
        <?php if(isset($item['date_modified'])): ?>
        <lastmod><?php echo gmdate("Y-m-d", strtotime($item['date_modified'])); ?></lastmod>
        <?php endif; ?>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    <?php endif; ?>
    <?php endforeach; ?>
    <url>
        <loc><?= $host; ?></loc>
        <changefreq>always</changefreq>
        <priority>1</priority>
    </url>

    <?php foreach($products as $product): ?>
    <?php if(iconv_strlen(gmdate("Y-m-d", strtotime($product['date_modified']))) == 10): ?>
    <url>
        <loc><?= $host . '/' . $product['keyword']; ?></loc>
        <?php if(isset($product['date_modified'])): ?>
        <lastmod><?php  echo gmdate("Y-m-d", strtotime($product['date_modified'])); ?></lastmod>
        <?php endif; ?>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    <?php endif; ?>
    <?php endforeach; ?>

</urlset>