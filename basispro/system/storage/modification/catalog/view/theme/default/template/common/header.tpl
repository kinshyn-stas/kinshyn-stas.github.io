<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NXVWZ3D');</script>
<!-- End Google Tag Manager -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>

<?php if ($noindex) { ?>
<!-- OCFilter Start -->
<meta name="robots" content="noindex,nofollow" />
<!-- OCFilter End -->
<?php } ?>
      
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" />
<?php if((isset($_GET['page'])) || (stripos($_SERVER['REQUEST_URI'], '?'))){ ?>
<meta name="robots" content="noindex, follow">
<?php } ?>
<?php if ($merge_css) { ?>
    <?php if ($inline_css) { ?>
    <style>
    <?php echo $css_content; ?>
    </style>
    <?php } else { ?>
    <link href="<?php echo $cache_style; ?>" rel="stylesheet" />
    <?php } ?>
<?php } else { ?>
    <link href="/catalog/view/theme/default/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="/catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
    <link href="/catalog/view/theme/default/stylesheet/responsive.css" rel="stylesheet">
    <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
<?php } ?>
<?php if ($maincolor) { ?>
<style>
    .main-color,.btn.btn-primary,.buttons .btn.btn-primary,#search button:hover,.mini-cart:hover,#cart-total:after,.product-thumb:hover .button-group.button-cart button,#phone-widget ul li.active{background-color:<?php echo $maincolor; ?>}
    #content p a,#top a:hover,#search button,#column-left a.list-group-item.active,#column-left a.list-group-item.active:focus,#column-left a.list-group-item:hover,#column-right a.list-group-item.active,#column-right a.list-group-item.active:focus,#column-right a.list-group-item:hover,.product-info .price,.product-thumb .caption .price,.product-thumb-left .price{color:<?php echo $maincolor; ?>}
    .btn.btn-primary,.buttons .btn.btn-primary,#search button:hover,.mini-cart:hover,#content .border .owl-wrapper-outer{border-color:<?php echo $maincolor; ?>}
    .box-heading,.product-info .price-old:after,.product-tabs .nav.nav-tabs > li.active > a,#phone-widget ul li a{border-bottom-color:<?php echo $maincolor; ?>}
</style>
<?php } ?>
<?php if ($mainhovercolor) { ?>
<style>
    .btn.btn-primary:hover,.buttons .btn.btn-primary:hover,#menu .nav > li > a:focus,#menu .nav > li > a:hover,#menu .nav .open > a,#menu .nav .open > a:focus,#menu .nav .open > a:hover,.product-thumb:hover .button-group.button-cart button:hover{background-color:<?php echo $mainhovercolor; ?>}
    #content p a:hover, a:hover,.product-tabs .nav.nav-tabs > li > a:hover{color:<?php echo $mainhovercolor; ?>}
    .btn.btn-primary:hover,.buttons .btn.btn-primary:hover,#menu .nav > li > a:focus,#menu .nav > li > a:hover{border-color:<?php echo $mainhovercolor; ?>}
</style>
<?php } ?>
<style>
     .product-info .price, .product-info .price-old, .price-old, .product-thumb .caption .price, .product-thumb-left .price {color: #008000;}
    .mini-cart:hover #cart-total:after {background: #008000;}
</style>
<?php if ($custom_css) { ?>
<style>
    <?php echo $custom_css; ?>
</style>
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php  if (!$scripts_to_footer) { ?>
    <script src="/catalog/view/theme/default/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript" ></script>
    <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

				<link rel="stylesheet" type="text/css" href="catalog/view/javascript/colorbox/colorbox.css" media="screen" />
				<script type="text/javascript" src="catalog/view/javascript/colorbox/jquery.colorbox.js"></script>
				<link rel="stylesheet" type="text/css" href="catalog/view/javascript/cheaper/cheaper.css" media="screen" />
				<script type="text/javascript" src="catalog/view/javascript/cheaper/jquery.validate.pack.js"></script>
            
    <script src="/catalog/view/theme/default/javascript/common.js" type="text/javascript" ></script>

				<script type="text/javascript"><!--
					$(document).ready(function() {
						$('.colorbox').colorbox({
							overlayClose: true,
							opacity: 0.6,
							rel: false,
							width:"410px",
							height:"560px",
							onLoad:function(){
								$("#cboxNext").remove(0);
								$("#cboxPrevious").remove(0);
								$("#cboxCurrent").remove(0);
							}
						});
						 
					});
				//--></script>
            
<?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>" type="text/javascript" ></script>
<?php } ?>
<?php } ?>
<script>
    var domReady = function(callback) {
        document.readyState === "interactive" || document.readyState === "complete" ? callback() : document.addEventListener("DOMContentLoaded", callback);
    };
</script>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>

</head>
<body class="<?php echo $class; ?>">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXVWZ3D"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="wrapper">
<nav id="top">
  <div class="container">
      <?php if ($topleft_html_module) { ?>
        <?php echo $topleft_html_module; ?>
      <?php } ?>
    <?php echo $currency; ?>
    <?php echo $language; ?>
      <?php if ((isset($information_categories))&&($information_categories)&&($top_info)) { ?>
      <div class="pull-left">
      <div class="btn-group">
          <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
            <span><i class="fa fa-book"></i>
            <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_info; ?></span> <span class="caret"></span></span>
          </button>
          <ul class="dropdown-menu">
            <?php foreach ($information_categories as $category) { ?>
                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
          </ul>
      </div>
      </div>
      <?php } ?>
    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
          <?php echo $top_html_module; ?>
        <li class="dropdown"><a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <?php if ($logged) { ?>
            <li><a href="<?php echo $account; ?>"><i class="fa fa-user"></i> <?php echo $text_account; ?></a></li>
            <li><a href="<?php echo $order; ?>"><i class="fa fa-time"></i> <?php echo $text_order; ?></a></li>
                <li><a href="<?php echo $wishlist; ?>" id="wishlist-total" title="<?php echo $text_wishlist; ?>"><i class="fa fa-heart-o"></i> <?php echo $text_wishlist; ?></a></li>
                <li><a href="<?php echo $logout; ?>"><i class="fa fa-chevron-left"></i> <?php echo $text_logout; ?></a></li>
            <?php } else { ?>
            <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>
            <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
            <?php } ?>
          </ul>
        </li>
        <li><a href="<?php echo $shopping_cart; ?>" title="<?php echo $text_shopping_cart; ?>"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_shopping_cart; ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-sm-6 logo">
        <div id="logo">
          <?php if ($logo) { ?>
            <?php if ($home == $og_url) { ?>
              <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
            <?php } else { ?>
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
            <?php } ?>
          <?php } else { ?>
            <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 phones">
          <?php if ($header_phone) { ?>
            <?php if (!$header_phone_add) { ?><div class="main-phone"><i class="fa fa-phone"></i> <a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a></div><?php } else { ?>
              <?php echo $telephone; ?><br>
              <?php } ?>
          <?php } ?>
          <?php if ($header_phone_add) { ?>
              <?php echo $telephone_add; ?><br>
          <?php } ?>
          <?php if (($header_widget)&&($widget_phones)) { ?>
            <div id="phone-widget">
              <div class="tab-content">
                  <?php $i=1; foreach ($widget_phones as $widget_phone) { ?>
                      <div class="tab-pane fade" id="operator<?php echo $i; ?>"><span class="code"><?php echo $widget_phone['code']; ?></span><span class="phone"> <?php echo $widget_phone['phone']; ?></span></div>
                  <?php $i++; } ?>
              </div>
              <ul class="operator nav-pills">
                  <?php $i=1; foreach ($widget_phones as $widget_phone) { ?>
                      <li><a data-toggle="pill" href="#operator<?php echo $i; ?>"><?php echo $widget_phone['operator']; ?></a></li>
                  <?php $i++; } ?>
              </ul>
            </div>
              <script>
                  domReady(function() {
                      $('.operator.nav-pills li:first a').tab('show');
                  });
              </script>
          <?php } ?>
          <?php echo $header_html_module; ?>
      </div>
      <div class="col-lg-4 col-sm-6 hidden-xs"><?php echo $search; ?></div>
      <div class="col-lg-3 col-sm-6 all-cart"><?php echo $cart; ?></div>
    </div>
  </div>
</header>
<?php if ($categories) { ?>
<div class="navigation main-color width" id="main-nav">
<div class="container">
  <nav id="menu" class="navbar yamm">
    <div class="navbar-header">
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i><span id="category" class="visible-xs"><?php echo $text_category; ?></span></button>
        <div class="pull-right hidden visible-xs">
            <a href="<?php echo $search_link; ?>" class="btn btn-navbar"><i class="fa fa-search"></i></a><a href="<?php echo $checkout; ?>" class="btn btn-navbar"><i class="fa fa-shopping-cart"></i></a>
        </div>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <?php echo $premenu_html_module; ?>
        <?php foreach ($categories as $category) { ?>
        <?php if ($category['children']) { ?>
        <li class="dropdown"><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
          <span class="menu-item-toggle close visible-xs">
            <i class="fa fa-plus"></i>
            <i class="fa fa-minus"></i>
          </span>
          <div class="dropdown-menu">
            <div class="dropdown-inner">
              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
              <ul class="list-unstyled">
                <?php foreach ($children as $child) { ?>
                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                <?php } ?>
              </ul>
              <?php } ?>
            </div>
          </div>
        </li>
        <?php } else { ?>
        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
        <?php } ?>
          <?php echo $aftermenu_html_module; ?>
      </ul>
    </div>
  </nav>
</div>
</div>
<?php } ?>