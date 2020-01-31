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
<script src="catalog/view/javascript/modernizr.custom.js"></script>

<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet"> 
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<link href="catalog/view/theme/default/stylesheet/swiper.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/component.css" />
	
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
<body class="<?php echo $class; ?>">
<div class="fon_top">
<div class="container">  
  <div class="row">    
      <div class="col-xs-2 hidden-sm hidden-md hidden-lg mob_menu">
          <button id="showLeft"> 
              <img class="gam1" src="/image/catalog/gamburg.png" alt="">
              <img class="gam2" src="/image/catalog/del_mob_menu.png" alt="">
          </button>
          <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <div class="fon_mob_menu5">
              <div class="lang_mob"><?php echo $language; ?></div>
              <div id="logo_mob">
                  <?if($language_id=="1") {?>
                   
                        <?php if ($logo) { ?>
                          <?php if ($home == $og_url) { ?>
                            <img src="/image/catalog/logo_rus_mob.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
                          <?php } else { ?>
                            <a href="<?php echo $home; ?>"><img src="/image/catalog/logo_rus_mob.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                          <?php } ?>
                        <?php } else { ?>
                           
                        <?php } ?>
                           
                  <?} else {?>
                    <?php if ($logo) { ?>
                      <?php if ($home == $og_url) { ?>
                        <img src="/image/catalog/logo_ukr_mob.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
                      <?php } else { ?>
                        <a href="<?php echo $home; ?>"><img src="/image/catalog/logo_ukr_mob.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                      <?php } ?>
                    <?php } else { ?>
                      
                    <?php } ?>
                  <?}?>
                </div>
                    <ul class="mob_login">
                      <?php if ($logged) { ?>
                      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>                     
                      <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                      <?php } else { ?>
                      <li><a href="<?php echo $login; ?>"><?php echo $text_login; ?></a></li>
                      <li><a href="<?php echo $register; ?>"><?php echo $text_register; ?></a></li>                    
                      <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>    
                <div class="fon_megmenu_mob">megamenu55</div>
              
              <div class="kont_mob2">
                <div><?php echo $text_help1; ?> </div>
                <div class="tel_mob"><?php echo $telephone; ?> </div>             
                <div><?php echo $text_open; ?></div> 
                <div><?php echo html_entity_decode($open); ?></div>
              </div>
               
          </nav>
             
          
      </div>       
      <div class="hidden-xs col-sm-1 col-md-6 col-lg-6">
          <div class="megmenu10">
          megamenu55
          </div>
      </div> 
      
      
    
        <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
            <ul class="iconh">     
               
               
                
                         
              <?php if ($logged) { ?>
              <li>
                
                  <a href="<?php echo $account; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="-294 386.2 21.8 21.8"><path d="M-283 386.3c-6 0-10.8 4.8-10.8 10.8s4.8 10.8 10.8 10.8 10.8-4.8 10.8-10.8-4.9-10.8-10.8-10.8zm0 20.6c-2.4 0-4.7-.9-6.4-2.4 1.3-1.2 2-1.5 3.4-2.1 1.7-.7 2.3-2.1 1.6-3.6-.1-.3-.3-.5-.4-.8-.6-1-1.2-2-1.2-4.5 0-2.9 1.4-2.9 2.5-2.9.8 0 1.1-.1 1.5-.3.1 0 .3-.1.5-.1.9 0 1.9.9 1.9 3.4s-.4 3.2-1 4.2c-.2.3-.3.6-.5.9-.3.7-.4 1.3-.2 1.9.3.7.9 1.4 2.1 1.9 1 .5 2 1.4 2.6 1.9-1.7 1.6-3.9 2.5-6.4 2.5zm7.1-3.1c-.6-.6-1.7-1.6-2.8-2.1-.9-.4-1.5-.9-1.6-1.4-.1-.3-.1-.7.2-1.2.2-.3.3-.6.5-.9.6-1.1 1.1-1.9 1.1-4.7-.1-4.1-2.5-4.3-3-4.3-.4 0-.6.1-.9.2-.3.1-.5.2-1.1.2-1.1 0-3.4.1-3.4 3.9 0 2.7.7 3.9 1.3 4.9.1.3.3.5.4.7.5 1.1.1 1.8-1.1 2.3-1.5.7-2.2 1-3.7 2.3-1.7-1.8-2.7-4.1-2.7-6.8 0-5.4 4.4-9.8 9.8-9.8s9.8 4.4 9.8 9.8c-.1 2.8-1.1 5.1-2.8 6.9z" /></svg>
                    <span class="hidden-sm hidden-xs"><?echo $text_account;?></span>
                </a>
              </li>           
              <?php } else { ?>
              <li>   
                               
                  <a href="<?php echo $login; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="-294 386.2 21.8 21.8"><path d="M-283 386.3c-6 0-10.8 4.8-10.8 10.8s4.8 10.8 10.8 10.8 10.8-4.8 10.8-10.8-4.9-10.8-10.8-10.8zm0 20.6c-2.4 0-4.7-.9-6.4-2.4 1.3-1.2 2-1.5 3.4-2.1 1.7-.7 2.3-2.1 1.6-3.6-.1-.3-.3-.5-.4-.8-.6-1-1.2-2-1.2-4.5 0-2.9 1.4-2.9 2.5-2.9.8 0 1.1-.1 1.5-.3.1 0 .3-.1.5-.1.9 0 1.9.9 1.9 3.4s-.4 3.2-1 4.2c-.2.3-.3.6-.5.9-.3.7-.4 1.3-.2 1.9.3.7.9 1.4 2.1 1.9 1 .5 2 1.4 2.6 1.9-1.7 1.6-3.9 2.5-6.4 2.5zm7.1-3.1c-.6-.6-1.7-1.6-2.8-2.1-.9-.4-1.5-.9-1.6-1.4-.1-.3-.1-.7.2-1.2.2-.3.3-.6.5-.9.6-1.1 1.1-1.9 1.1-4.7-.1-4.1-2.5-4.3-3-4.3-.4 0-.6.1-.9.2-.3.1-.5.2-1.1.2-1.1 0-3.4.1-3.4 3.9 0 2.7.7 3.9 1.3 4.9.1.3.3.5.4.7.5 1.1.1 1.8-1.1 2.3-1.5.7-2.2 1-3.7 2.3-1.7-1.8-2.7-4.1-2.7-6.8 0-5.4 4.4-9.8 9.8-9.8s9.8 4.4 9.8 9.8c-.1 2.8-1.1 5.1-2.8 6.9z" /></svg>
                    <span class="hidden-sm hidden-xs"><?echo $text_account;?></span>
                  </a>
              </li>           
              <?php } ?>
              <li>
                  <div class="but_ic">         
                      <a href="<?php echo $wishlist; ?>" id="wishlist-total" >  
                         <?echo $text_wishlist;?> 
                     </a>  
                      
                  </div>
                 
              </li>
              <li>
                  <div class="but_ic">         
                      <a href="<?php echo $compare; ?>" id="compare-total" >                      
                          <?echo $text_compare;?>                     
                        </a> 
                  </div>
                  
              </li>  
              <li class="iconhli_mob"><?php echo $cart; ?></li>            
            </ul>       
          <div class="lang"><?php echo $language; ?></div>
    </div>
  </div>  
</div>
</div>
 
<header>
  <div class="container">
    <div class="row">      
       
      <div class="col-xs-12 hidden-sm col-md-2 col-lg-2">
        
        <div id="logo">
          <?if($language_id=="1") {?>
            
                <?php if ($logo) { ?>
                  <?php if ($home == $og_url) { ?>
                    <img src="/image/catalog/logo_rus.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
                  <?php } else { ?>
                    <a href="<?php echo $home; ?>"><img src="/image/catalog/logo_rus.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                  <?php } ?>
                <?php } else { ?>
                  <h1><a href="/image/catalog/logo_rus.svg"><?php echo $name; ?></a></h1>
                <?php } ?>
                      
          <?} else {?>
            <?php if ($logo) { ?>
              <?php if ($home == $og_url) { ?>
                <img src="/image/catalog/logo_ukr.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
              <?php } else { ?>
                <a href="<?php echo $home; ?>"><img src="/image/catalog/logo_ukr.svg" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
              <?php } ?>
            <?php } else { ?>
              <h1><a href="/image/catalog/logo_ukr.svg"><?php echo $name; ?></a></h1>
            <?php } ?>
          <?}?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <div class="sss"><?php echo $search; ?></div>
       </div>    
       <div class="hidden-xs hidden-sm col-md-5 col-lg-5">
          <div class="headcont">
         
            <div class="text_tel"><?php echo $text_help1; ?></div>
            <div class="tel"><?php echo $telephone; ?></div>
          <div class="clock">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.941 188.276c-1.461-5.342-6.985-8.488-12.315-7.027-5.342 1.46-8.489 6.974-7.028 12.315 5.54 20.265 8.349 41.271 8.349 62.435 0 130.102-105.845 235.947-235.947 235.947S20.053 386.102 20.053 256 125.898 20.053 256 20.053c71.284 0 138.517 32.33 183.149 87.245h-15.392c-5.539 0-10.027 4.489-10.027 10.027 0 5.537 4.488 10.027 10.027 10.027h38.792c5.539 0 10.027-4.489 10.027-10.027V78.534c0-5.537-4.488-10.027-10.027-10.027-5.539 0-10.027 4.489-10.027 10.027v13.441C404.108 34.021 332.182 0 256 0 114.841 0 0 114.841 0 256s114.841 256 256 256 256-114.841 256-256c0-22.95-3.048-45.736-9.059-67.724z"/><path d="M234.738 350.919h-80.74l50.725-50.725c25.821-25.821 40.041-60.15 40.041-96.666 0-34.462-28.037-62.499-62.499-62.499s-62.499 28.037-62.499 62.499c0 5.537 4.488 10.027 10.027 10.027 5.539 0 10.027-4.489 10.027-10.027 0-23.405 19.041-42.446 42.446-42.446 23.405 0 42.446 19.041 42.446 42.446 0 31.16-12.134 60.454-34.168 82.487l-67.842 67.842a10.022 10.022 0 0 0-2.172 10.926 10.025 10.025 0 0 0 9.263 6.19h104.945c5.539 0 10.027-4.489 10.027-10.027s-4.488-10.027-10.027-10.027zM395.577 282.069h-27.819V151.055a10.027 10.027 0 0 0-18.636-5.141l-84.224 141.041a10.023 10.023 0 0 0-.111 10.089 10.024 10.024 0 0 0 8.719 5.077h74.197v58.823c0 5.537 4.488 10.027 10.027 10.027 5.539 0 10.027-4.489 10.027-10.027v-58.823h27.819c5.539 0 10.028-4.489 10.028-10.027s-4.488-10.025-10.027-10.025zm-47.872 0h-56.531l56.531-94.667v94.667zM256 35.845c-5.539 0-10.027 4.489-10.027 10.027v13.071c0 5.537 4.489 10.027 10.027 10.027 5.539 0 10.027-4.489 10.027-10.027V45.871c0-5.537-4.488-10.026-10.027-10.026zM256 443.031c-5.539 0-10.027 4.489-10.027 10.027v13.071c0 5.537 4.488 10.027 10.027 10.027s10.027-4.489 10.027-10.027v-13.071c0-5.537-4.488-10.027-10.027-10.027zM468.216 245.973h-15.158c-5.539 0-10.027 4.489-10.027 10.027s4.488 10.027 10.027 10.027h15.158c5.539 0 10.027-4.489 10.027-10.027s-4.489-10.027-10.027-10.027zM58.942 245.973H43.784c-5.539 0-10.027 4.489-10.027 10.027s4.488 10.027 10.027 10.027h15.158c5.537 0 10.027-4.489 10.027-10.027s-4.488-10.027-10.027-10.027z"/><circle cx="440.022" cy="149.758" r="10.027"/><circle cx="362.242" cy="71.977" r="10.027"/><circle cx="149.744" cy="71.977" r="10.027"/><circle cx="71.969" cy="149.758" r="10.027"/><circle cx="71.969" cy="362.256" r="10.027"/><circle cx="149.744" cy="440.035" r="10.027"/><circle cx="362.242" cy="440.022" r="10.027"/><circle cx="440.022" cy="362.242" r="10.027"/></svg> 
            <?php echo $text_open; ?><span><?php echo html_entity_decode($open); ?></span>
          </div>
        </div>
         
      </div> 
      
      <div class="hidden-xs col-sm-12 col-md-1 col-lg-1">
          <?php echo $cart; ?>
      </div>
      
    </div>
  </div>
</header>
<div class="fon_menu2">
<?php if ($categories) { ?> 
<?php } ?>
</div>
