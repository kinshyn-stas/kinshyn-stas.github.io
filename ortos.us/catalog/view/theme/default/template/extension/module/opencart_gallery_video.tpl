<div class="fon_video">
<div class="container">
  <div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


<div class="zag_mod_video"><span><?php echo $heading_title; ?></span>
  <div class="line_video"></div></div>
 
<div id="carouselgal" class="owl-carousel">
    <?php foreach ($videos as $video) { ?>

      <div class="item videolist5">
        
        
                <a href="<?php echo $video['href']; ?>">
                    <img src="<?php echo $video['thumb'] ?>" class="img-responsive" title="<?php echo $video['name'] ?>" alt="<?php echo $video['name'] ?>"/>
                    <div class="play-button play-button-1" style="top:<?php echo $play_btn_top; ?>px; left:<?php echo $play_btn_left; ?>px;"></div>
                  
             
                
               <div class="desc_video0"><?php echo $video['description'] ?></div> 
             </a>   
         
        
        <div class="container-fluid line_soc">          
          <div class="row">            
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
             <div class="soc_text"> <? echo $text_soc;?></div>
            </div>
             <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
             <div class="soc2">
               
             </div>
            </div>            
          </div>          
        </div>
        
  </div>
    
    <?php } ?>
  </div>
</div>
</div>

<div class="row">  
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="all_video5">
    <?if ($language_id=="1"){?>
    <a href="/videogallery">Смотреть все видео компании</a>
    <?} else {?>
      <a href="/videogallery">Дивитися всі відео компанії</a>
    <?}?>
  </div>
  </div>  
</div>

</div>
<script type="text/javascript"><!--
  $('#carouselgal').owlCarousel({
    items: 3,
    autoPlay: false,
    navigation: true,
    navigationText: ['<img src="/image/catalog/left.png">', '<img src="/image/catalog/right.png">'],
    pagination: false
  });
  --></script>
  </div>
