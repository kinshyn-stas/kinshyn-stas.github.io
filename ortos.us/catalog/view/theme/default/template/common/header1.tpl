<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title;  ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" />
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/swiper.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap-hover-dropdown.js" type="text/javascript"></script>
<script src="catalog/view/javascript/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>


<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet"> 
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/swiper.min.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?> blogs5">
        <div class="container">
                <div class="row">      
                  
                  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <?if($language_id=="1") {?>
                            <a class="nextshop" href="<?php echo $home; ?>">Перейти в магазин</a>
                        <?} else {?>
                            <a class="nextshop" href="<?php echo $home; ?>">Вернутися в магазин</a>
                        <?}?>
                  </div>
                   
                 
                 <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6 text-center">
                        <div id="logo" >
                      <?if($language_id=="1") {?>
                       
                       
                            <div class="blog_home">Блог</div>
                            <?php if ($logo) { ?>
                              <?php if ($home == $og_url) { ?>
                                <img src="/image/catalog/logo_rus.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
                              <?php } else { ?>
                                <a href="/blogs"><img src="/image/catalog/logo_rus.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                              <?php } ?>
                            <?php } else { ?>
                              <h1><a href="/image/catalog/logo_rus.svg"><?php echo $name; ?></a></h1>
                            <?php } ?>
                                 
                      <?} else {?>
                        <div class="blog_home">Блог</div>
                        <?php if ($logo) { ?>
                          <?php if ($home == $og_url) { ?>
                            <img src="/image/catalog/logo_ukr.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
                          <?php } else { ?>
                            <a href="/blogs"><img src="/image/catalog/logo_ukr.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                          <?php } ?>
                        <?php } else { ?>
                          <h1><a href="/image/catalog/logo_ukr.svg"><?php echo $name; ?></a></h1>
                        <?php } ?>
                      <?}?>
                    </div> 
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                        <div class="lang"><?php echo $language; ?></div> 
                    </div>    
                  
                  
                  
                  
                </div>
              </div>