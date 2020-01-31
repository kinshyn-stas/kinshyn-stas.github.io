<?php echo $header1; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php $b_i = 1; ?>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li>
        <?php if ($b_i < (count($breadcrumbs))) { ?>
          <a href="<?php echo $breadcrumb['href']; ?>"><span><?php echo $breadcrumb['text']; ?></span></a>
        <?php } else { ?>
          <span><?php echo $breadcrumb['text']; ?></span>
        <?php } ?>
      </li>
      <?php $b_i++; ?>
    <?php } ?>
  </ul>
  <div class="row">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> <?php echo $_code; ?>-content">
      <?php echo $content_top; ?>
      <div class="row">
        <div class="col-sm-12">
          <h1><?php echo $heading_title; ?></h1>
       
          <?php if (($thumb && $show_main_image == 1) || ($images && $show_additional_image)) { ?>
          <div class="images-block">
            <?php if ($thumb && $show_main_image == 1) { ?>
              <div class="image-main">
                <a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>">
                  <img src="<?php echo $thumb; ?>" class= img-responsive title="<?php echo $heading_title; ?>" alt="<?php echo $main_image_alt; ?>" />
                </a>
              </div>
            <?php } ?>
            <?php if ($socials) { ?>
              <div class="post-info-share">
                 
                <?php foreach ($socials as $social) { ?>
                  <a href="<?php echo $social['href']; ?>" class="<?php echo $social['class']; ?>" title="<?php echo $social['name']; ?>" target="_blank"><i class="<?php echo $social['icon']; ?>" aria-hidden="true"></i></a>
                <?php } ?>
                <div class="clearfix"></div>
              </div>
              <?php } ?>
            <?php if ($video && $show_main_image == 2) { ?>
              <?php if ($video_show_type == 1) { ?>
                <div class="video-main" >
                  <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $video; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $video; ?>/0.jpg');">
                    <div>
                      <i class="fa fa-play"></i>
                      <span></span>
                      <span></span>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="video-main" >
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              <?php } ?>
            <?php } ?>
            <?php if ($images && $show_additional_image) { ?>
              <div class="image-additionals">
                <div class="inner">
                  <?php foreach ($images as $image) { ?>
                  <div><a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                  <?php } ?>
                  <?php if ($images_other) { ?>
                  <?php foreach ($images_other as $image) { ?>
                  <div class="more-image-additionals"><a class="<?php echo $_code; ?>-post-thumbnail" href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></div>
                  <?php } ?>
                  <div class="show-image-additionals" onclick="$('.more-image-additionals').toggleClass('active');$(this).find('span').toggle();">
                    <div><span>+<?php echo $images_other_total; ?></span><span><i class="fa fa-arrow-left" aria-hidden="true"></i></span></div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          </div>
          <?php } ?>
         
          <?php if ($description && $show_description) { ?>
          <div id="<?php echo $_code; ?>-post-description"><?php echo $description; ?></div>
          <?php } ?>
          <?php if ($show_author || $show_date_added || $show_count_viewed) { ?>
            <div class="post-info-block">
              <?php if ($author && $show_author) { ?>
              <span><i class="fa fa-user" aria-hidden="true"></i> <?php echo $text_author; ?> <a href="<?php echo $authors; ?>"><span><?php echo $author; ?></span></a></span>
              <?php } ?>
              <?php if ($show_date_added) { ?>
              <span><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $text_date_added; ?> <?php echo $date_added; ?></span>
              <?php } ?>
              <?php if ($show_count_viewed) { ?>
              <span><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $text_viewed; ?> <?php echo $viewed; ?></span>
              <?php } ?>
              <?php if ($show_comment_count) { ?>
              <span><i class="fa fa-comments" aria-hidden="true"></i> <?php echo $text_comment; ?> <?php echo $comment_total; ?></span>
              <?php } ?>
              <?php if ($show_post_vote) { ?>  
              <span><?php echo $text_estimates; ?> <i class="fa fa-thumbs-down" aria-hidden="true"></i> <?php echo $post_vote_down; ?> <i class="fa fa-thumbs-up" aria-hidden="true"></i> <?php echo $post_vote_up; ?></span>
              <?php } ?>
            </div>
            <hr/>
            <?php } ?>
       
         
          
          <?php if ($show_comment) { ?>
            <?php if ($comment_see_status) { ?>
            <div id="<?php echo $_code; ?>-comment">
              <?php if ($comments) { ?>
               
              <div class="<?php echo $_code; ?>-post-comments-block">
                <?php foreach ($comments as $comment) { ?>
                  <div>
                    <?php if ($comment['thumb']) { ?>
                    <div class="comment-image">
                      <div>
                        <img src="<?php echo $comment['thumb']; ?>" />
                       
                      </div>
                    </div>
                    <?php } ?>
                    <div class="comment-inner">
                      <div>
                        <div class="comment-name">
                          <?php echo $comment['firstname']; ?>
                          <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $comment['date_added']; ?></div>
                        </div>
                        <div class="comment-description"><?php echo $comment['description']; ?></div>
                      </div>
                      <?php if ($show_comment_vote) { ?>
                      <div class="comment-vote">
                        <div><span id="<?php echo $_code; ?>-vote-down-<?php echo $comment['comment_id']; ?>"><?php echo $comment['total_vote_down']; ?></span> / <span id="<?php echo $_code; ?>-vote-up-<?php echo $comment['comment_id']; ?>"><?php echo $comment['total_vote_up']; ?></span></div>
                        <div>
                          <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $comment['comment_id']; ?>', 'down', 'comment', this)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
                          <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $comment['comment_id']; ?>', 'up', 'comment', this)"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php if ($comment['responds']) { ?>
                    <?php foreach ($comment['responds'] as $respond) { ?>
                      <div class="comment-responds-block">
                        <?php if ($respond['thumb']) { ?>
                        <div class="comment-image">
                          <div>
                            <img src="<?php echo $respond['thumb']; ?>" />
                          </div>
                        </div>
                        <?php } ?>
                        <div class="comment-inner">
                          <div>
                            <div class="comment-name">
                              <?php echo $respond['firstname']; ?>
                              <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $respond['date_added']; ?></div>
                            </div>
                            <div class="comment-description"><?php echo $respond['description']; ?></div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </div>
              <div class="text-center"><?php echo $pagination; ?></div>
              <?php } else { ?>
              <p><?php echo $text_no_comments; ?></p>
              <?php } ?>
            </div>
            <?php } ?>
            <?php if ($comment_write_status) { ?>
            <div id="<?php echo $_code; ?>-comment-form">
              <form class="form-horizontal1" method="post" enctype="multipart/form-data">
                  
                  <div class="container-fluid">                    
                    <div class="row">                      
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                          <div class="zag_com"><?php echo $text_write; ?></div>
                      </div>        
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                          <?php if ($show_post_vote) { ?>  
                            <div class="post-info-vote">
                              <div><?php echo $text_rate_post; ?></div>
                              <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $post_id; ?>', 'down', 'post', this)"><i class="fa fa-thumbs-down" aria-hidden="true"></i><span><?php echo $post_vote_down; ?></span></button>
                              <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $post_id; ?>', 'up', 'post', this)"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span><?php echo $post_vote_up; ?></span></button>
                            </div>
                            <?php } ?>
                      </div>              
                    </div>                    
                  </div>
                  
                
               
                <div>
                  <div id="<?php echo $_code; ?>-comment-alerts"></div>
                  <div class="row">
                    <div class="col-sm-6">
                      
                        <div class="col-sm-12" data-error-name="firstname">
                          <label class="control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
                          <input type="text" name="firstname" value="<?php echo $firstname; ?>" id="input-firstname" class="form-control" />
                        </div>
                     
                      <?php if ($allow_notification_on_respond) { ?>
                       
                        <div class="col-sm-12" >
                          <label class="control-label">
                            <input type="checkbox" name="notification_on_respond" value="1" onchange="$('#<?php echo $_code; ?>-comment-email').toggle();"/>
                            <?php echo $text_notification_on_respond; ?>
                          </label>
                        </div>
                     
                      <div class=" required" id="<?php echo $_code; ?>-comment-email">
                        <div class="col-sm-12" data-error-name="email">
                          <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
                          <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($captcha_status) { ?>
                      <div data-error-name="recaptcha">
                        <script src="https://www.google.com/recaptcha/api.js"></script>
                        <div class="g-recaptcha" data-sitekey="<?php echo $captcha_site_key; ?>" id="comment-captcha"></div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="col-sm-6">
                      
                        <div class="col-sm-12" data-error-name="description">
                          <label class="control-label" for="input-description"><?php echo $entry_comment; ?></label>
                          <textarea name="description" id="input-description" class="form-control"></textarea>
                        </div>
                       
                      <?php if ($comment_require_informations) { ?>
                      <div data-error-name="comment_require_information">
                        <?php echo $comment_require_informations; ?>
                        <input type="checkbox" name="comment_require_information" value="1" />
                      </div>
                      <?php } ?>
                     
                    </div>
                  </div>
                </div>
                <div class="buttons">
                         
                    <button type="button" id="<?php echo $_code; ?>-button-comment" class="but_k"><?php echo $button_submit_comment; ?></button>
                   
                </div>
              </form>
            </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
      <?php if ($related_posts) { ?>
      <h3 class="<?php echo $_code; ?>-h3"><i class="fa fa-file-text-o"></i> <?php echo $text_related_posts; ?></h3>
      <div class="row">
        <?php $i = 0; ?>
        <?php foreach ($related_posts as $result) { ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
        <?php } else { ?>
        <?php $class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <div class="product-thumb transition <?php echo $_code; ?>-post-item">
            <?php if ($post_show_post_image_on_post) { ?>
              <?php if ($result['show_main_image'] == 1) { ?>
              <div class="image">
                <a href="<?php echo $result['href']; ?>"><img src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>" title="<?php echo $result['name']; ?>" class="img-responsive"/></a>
              </div>
              <?php } ?>
              <?php if ($result['video'] && $result['show_main_image'] == 2) { ?>
              <div class="video">
                <div class="video-inner <?php echo $_code; ?>-youtube" onclick="show_youtube('<?php echo $result['video']; ?>', this);" style="background-image:url('https://img.youtube.com/vi/<?php echo $result['video']; ?>/0.jpg');">
                  <div>
                    <i class="fa fa-play"></i>
                    <span></span>
                    <span></span>
                  </div>
                </div>
              </div>
              <?php } ?>
            <?php } ?>
            <div class="caption">
              <a class="<?php echo $_code; ?>-post-heading" href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a>
              <?php if ($result['author'] && $show_author_on_post) { ?><b><?php echo $result['author']; ?></b> - <?php } ?><?php if ($show_date_added_on_post) { ?><?php echo $result['date_added']; ?><br/><?php } ?>
              <?php if ($show_description_on_post && $result['short_description']) { ?>
              <?php echo $result['short_description']; ?><br/>
              <?php } ?>
              <?php if ($show_count_comments_on_post) { ?>
              <i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $result['comments']; ?>&nbsp;&nbsp;
              <?php } ?>
              <?php if ($show_count_viewed_on_post) { ?>
              <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $result['viewed']; ?><br/>
              <?php } ?>
            </div>
            <?php if ($show_read_more_button_on_post) { ?>
            <a href="<?php echo $result['href']; ?>"><?php echo $text_button_readmore; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            <?php } ?>
          </div>
        </div>
        <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
        <div class="clearfix visible-md visible-sm"></div>
        <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
        <div class="clearfix visible-md"></div>
        <?php } elseif (($i + 1) % 4 == 0) { ?>
        <div class="clearfix visible-md"></div>
        <?php } ?>
        <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($related_products) { ?>
      <h3 class="<?php echo $_code; ?>-h3"><i class="fa fa-list"></i> <?php echo $text_related_products; ?></h3>
      <div class="row">
        <?php $i = 0; ?>
        <?php foreach ($related_products as $product) { ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
        <?php } else { ?>
        <?php $class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <div class="product-thumb transition">
            <?php if ($product_show_product_image_on_post) { ?>
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
            <?php } ?>
            <div class="caption">
              <?php if ($product_show_product_name_on_post) { ?>
              <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
              <?php } ?>
              <?php if ($product_show_product_description_on_post) { ?>
              <p><?php echo $product['description']; ?></p>
              <?php } ?>
              <?php if ($product['rating'] && $product_show_product_rating_on_post) { ?>
              <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($product['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if ($product['price'] && $product_show_product_price_on_post) { ?>
              <p class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
                <?php if ($product['tax']) { ?>
                <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                <?php } ?>
              </p>
              <?php } ?>
            </div>
            <?php if ($product_show_product_cart_button_on_post || $product_show_product_wishlist_button_on_post || $product_show_product_compare_button_on_post) { ?>
            <div class="button-group">
              <?php if ($product_show_product_cart_button_on_post) { ?>
              <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span> <i class="fa fa-shopping-cart"></i></button>
              <?php } ?>
              <?php if ($product_show_product_wishlist_button_on_post) { ?>
              <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <?php } ?>
              <?php if ($product_show_product_compare_button_on_post) { ?>
              <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
              <?php } ?>
            </div>
             <?php } ?>
          </div>
        </div>
        <?php if (($column_left && $column_right) && ($i % 2 == 0)) { ?>
        <div class="clearfix visible-md visible-sm"></div>
        <?php } elseif (($column_left || $column_right) && ($i % 3 == 0)) { ?>
        <div class="clearfix visible-md"></div>
        <?php } elseif (($i + 1) % 4 == 0) { ?>
        <div class="clearfix visible-md"></div>
        <?php } ?>
        <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?>
    </div>
    <?php echo $column_right; ?>
  </div>
</div>
<?php if ($comment_see_status) { ?>
<script>
function show_more_comments(page, button) {
  $.ajax({ 
    url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/comments&post_id=<?php echo $post_id; ?>&page='+page,   
    type: 'get',
    dataType: 'html',
    beforeSend: function() {
      $(button).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $(button).remove();
    },
    success: function(html) {
      $('#<?php echo $_code; ?>-comment .<?php echo $_code; ?>-post-comments-block').append(html);
      $(button).next().show();
    }
  });
}
</script>
<?php } ?>
<?php if ($show_post_vote || $show_comment_vote) { ?>
<script>
function <?php echo $_code; ?>_vote(comment_id, rating_type, content_type, block) {
  if (content_type == 'post') {
    var url = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/vote&post_id=<?php echo $post_id; ?>&rating_type='+rating_type+'&content_type='+content_type;
  } else {
    var url = 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/vote&post_id=<?php echo $post_id; ?>&comment_id='+comment_id+'&rating_type='+rating_type+'&content_type='+content_type;
  }
  
  $.ajax({
    url: url,
    type: 'get',
    dataType: 'json',
    success: function(json) {
      $('#<?php echo $_code; ?>-comment .comment-inner-aditional').parent().remove();
      $('.<?php echo $_code; ?>-post-vote-alert').remove();


      if (json['error']) {
        if (content_type == 'post') {
          $(block).parent().after('<div class="alert alert-danger alert-dismissible <?php echo $_code; ?>-post-vote-alert"><i class="fa fa-check-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (content_type == 'comment') {
          $(block).parent().parent().parent().parent().after('<div class="comment-alert-message"><div class="comment-inner-aditional"><div class="alert alert-danger alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div></div></div>');
        }
      } else {
        if (content_type == 'post') {
          if (json['post_vote_down']) {
            $(block).find('span').html(json['post_vote_down']);
          }
          if (json['post_vote_up']) {
            $(block).find('span').html(json['post_vote_up']);
          }

          $(block).parent().after('<div class="alert alert-success alert-dismissible" style="margin-top: 15px;"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }

        if (content_type == 'comment') {
          if (json['comment_vote_down']) {
            $('#<?php echo $_code; ?>-vote-down-'+comment_id).html(json['comment_vote_down']);
            $('#<?php echo $_code; ?>-vote-down-'+comment_id).parent().parent().parent().parent().after('<div class="comment-alert-message"><div class="comment-inner-aditional"><div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div></div></div>');
          }
          if (json['comment_vote_up']) {
            $('#<?php echo $_code; ?>-vote-up-'+comment_id).html(json['comment_vote_up']);
            $('#<?php echo $_code; ?>-vote-up-'+comment_id).parent().parent().parent().parent().after('<div class="comment-alert-message"><div class="comment-inner-aditional"><div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div></div></div>');
          }
        }
      }
    }
  });
}
</script>
<?php } ?>
<?php if ($comment_write_status) { ?>
<script>
function <?php echo $_code; ?>_respond(comment_id, block) {
  $('.<?php echo $_code; ?>-comment-respond').remove();
  $('script[src*="https://www.gstatic.com/recaptcha"]').remove();

  html  = '<div class="<?php echo $_code; ?>-comment-respond" id="<?php echo $_code; ?>-comment-respond-'+comment_id+'">';
  html += ' <div class="comment-image"></div>';
  html += ' <div class="comment-inner-aditional">';
  html += '   <form class="form-horizontal" method="post" enctype="multipart/form-data">';
  html += '     <div id="<?php echo $_code; ?>-comment-respond-alerts"></div>';
  html += '     <div class="row">';
  html += '       <div class="col-sm-6">';
  html += '         <div class="form-group required">';
  html += '           <div class="col-sm-12" data-error-name="firstname">';
  html += '             <label class="control-label"><?php echo $entry_firstname; ?></label>';
  html += '             <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control" />';
  html += '           </div>';
  html += '         </div>';
  <?php if ($captcha_status) { ?>
  html += '         <div data-error-name="recaptcha">';
  html += '           <div class="g-recaptcha" data-sitekey="<?php echo $captcha_site_key; ?>"></div>';
  html += '         </div>';
  <?php } ?>
  html += '       </div>';
  html += '       <div class="col-sm-6">';
  html += '         <div class="form-group required">';
  html += '           <div class="col-sm-12" data-error-name="description">';
  html += '             <label class="control-label"><?php echo $entry_respond; ?></label>';
  html += '             <textarea name="description" class="form-control"></textarea>';
  html += '           </div>';
  html += '         </div>';
  <?php if ($comment_require_informations) { ?>
  html += '         <div data-error-name="comment_require_information">';
  html += '           <?php echo $comment_require_informations; ?>';
  html += '           <input type="checkbox" name="comment_require_information" value="1" />';
  html += '         </div>';
  <?php } ?>
  html += '         <div class="buttons">';
  html += '           <div class="pull-left">';
  html += '             <button type="button" onclick="<?php echo $_code; ?>_send_respond('+comment_id+', this);" class="btn btn-primary"><?php echo $button_submit_respond; ?></button>';
  html += '           </div>';
  html += '         </div>';
  html += '       </div>';
  html += '     </div>';
  html += '   </form>';
  html += ' </div>';
  html += '</div>';

  $.ajax({
    url: 'https://www.google.com/recaptcha/api.js',
    dataType: "script"
  });  

  $(block).parent().parent().parent().after(html);
}

function <?php echo $_code; ?>_send_respond(comment_id, block) {
  $.ajax({
    url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/write_comment&post_id=<?php echo $post_id; ?>&comment_id='+comment_id,
    type: 'post',
    dataType: 'json',
    data: $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' form').serialize(),
    beforeSend: function() {
      $(block).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
    },
    complete: function() {
      $(block).html('<?php echo $button_submit_respond; ?>');
    },
    success: function(json) {
      $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' .text-danger, <?php echo $_code; ?>-comment-respond-'+comment_id+' .alert').remove();
      
      if (json['error']) {
        if (json['error']['field']) {
          for (i in json['error']['field']) {
            var element = $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' [data-error-name='+i+']');
            element.append('<div class="text-danger">'+json['error']['field'][i]+'</div>');
          }
        } else if (json['error']['warning']) {
          for (i in json['error']['warning']) {
            var element = $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' #<?php echo $_code; ?>-comment-respond-alerts');
            element.html('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }
        }
      } else {
        if (json['success']) {
          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' #<?php echo $_code; ?>-comment-respond-alerts').html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' input[name=\'firstname\']').val('');
          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' textarea[name=\'description\']').val('');
          <?php if ($allow_notification_on_respond) { ?>
          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' input[name=\'email\']').val('');
          $('#<?php echo $_code; ?>-comment-respond-email').hide();
          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' input[name=\'notification_on_respond\']:checked').prop('checked', false);
          <?php } ?>
          <?php if ($comment_require_informations) { ?>
          $('#<?php echo $_code; ?>-comment-respond-'+comment_id+' input[name=\'comment_require_information\']:checked').prop('checked', false);
          <?php } ?>

          setTimeout(function(){
            $('.<?php echo $_code; ?>-comment-respond').remove();
          }, 3000);

          if (json['comment']) {
            html = '';
            $.each(json['comment'], function(i,comment) {
              html += '<div class="comment-responds-block">';
              if (comment['thumb']) {
              html += '  <div class="comment-image">';
              html += '    <div><img src="'+comment['thumb']+'" /></div>';
              html += '  </div>';
              }
              html += '  <div class="comment-inner">';
              html += '    <div>';
              html += '      <div class="comment-name">';
              html += '        '+comment['firstname']+' <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> '+comment['date_added']+'</div>';
              html += '      </div>';
              html += '      <div class="comment-description">'+comment['description']+'</div>';
              html += '    </div>';
              html += '  </div>';
              html += '</div>';
            });

            $(block).parents('.smbpp-comment-respond').after(html);
          }
        }
      }
    }
  });
}

$('#<?php echo $_code; ?>-button-comment').on('click', function() {
	$.ajax({
		url: 'index.php?route=extension/ocdevwizard/<?php echo $_name; ?>/write_comment&post_id=<?php echo $post_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $('#<?php echo $_code; ?>-comment-form form').serialize(),
		beforeSend: function() {
			$('#<?php echo $_code; ?>-button-comment').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('#<?php echo $_code; ?>-button-comment').html('<?php echo $button_submit_comment; ?>');
		},
		success: function(json) {
			$('#<?php echo $_code; ?>-comment-form .text-danger, #<?php echo $_code; ?>-comment-form .alert').remove();
			
      if (json['error']) {
        if (json['error']['field']) {
          for (i in json['error']['field']) {
            var element = $('#<?php echo $_code; ?>-comment-form [data-error-name='+i+']');
            element.append('<div class="text-danger">'+json['error']['field'][i]+'</div>');
          }
        } else if (json['error']['warning']) {
          for (i in json['error']['warning']) {
            var element = $('#<?php echo $_code; ?>-comment-form #<?php echo $_code; ?>-comment-alerts');
            element.html('<div class="alert alert-danger">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          }
        }
      } else {
        if (json['success']) {
          $('#<?php echo $_code; ?>-comment-form #<?php echo $_code; ?>-comment-alerts').html('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

          $('#<?php echo $_code; ?>-comment-form input[name=\'firstname\']').val('');
          $('#<?php echo $_code; ?>-comment-form textarea[name=\'description\']').val('');
          <?php if ($allow_notification_on_respond) { ?>
          $('#<?php echo $_code; ?>-comment-form input[name=\'email\']').val('');
          $('#<?php echo $_code; ?>-comment-email').hide();
          $('#<?php echo $_code; ?>-comment-form input[name=\'notification_on_respond\']:checked').prop('checked', false);
          <?php } ?>
          <?php if ($comment_require_informations) { ?>
          $('#<?php echo $_code; ?>-comment-form input[name=\'comment_require_information\']:checked').prop('checked', false);
          <?php } ?>

          if (json['comment']) {
            html = '';
            $.each(json['comment'], function(i,comment) {
              html += '<div>';
              if (comment['thumb']) {
              html += '  <div class="comment-image">';
              html += '    <div>';
              html += '      <img src="'+comment['thumb']+'">';
              html += '      <button type="button" title="<?php echo $button_respond_to_comment; ?>" onclick="<?php echo $_code; ?>_respond(\''+comment['comment_id']+'\', this)"><i class="fa fa-reply" aria-hidden="true"></i></button>';
              html += '    </div>';
              html += '  </div>';
              }
              html += '  <div class="comment-inner">';
              html += '    <div>';
              html += '      <div class="comment-name">';
              html += '        '+comment['firstname']+' <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> '+comment['date_added']+'</div>';
              html += '      </div>';
              html += '      <div class="comment-description">'+comment['description']+'</div>';
              html += '    </div>';
              <?php if ($show_comment_vote) { ?>
              html += '    <div class="comment-vote">';
              html += '      <div><span id="<?php echo $_code; ?>-vote-down-'+comment['comment_id']+'">0</span> / <span id="<?php echo $_code; ?>-vote-up-'+comment['comment_id']+'">0</span></div>';
              html += '      <div>';
              html += '        <button type="button" onclick="<?php echo $_code; ?>_vote(\''+comment['comment_id']+'\', \'down\', \'comment\', this)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>';
              html += '        <button type="button" onclick="<?php echo $_code; ?>_vote(\''+comment['comment_id']+'\', \'up\', \'comment\', this)"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>';
              html += '      </div>';
              html += '    </div>';
              <?php } ?>
              html += '  </div>';
              html += '</div>';
            });

            if ($('.smbpp-post-comments-block').length) {
              $('.smbpp-post-comments-block').prepend(html);
            } else {
              $('#smbpp-comment').html('<div class="smbpp-post-comments-block">'+html+'</div>');
            }
          }
        }
      }
		}
	});
});
</script>
<?php } ?>
<?php if ($show_post_vote || ($thumb && $show_main_image == 1) || ($images && $show_additional_image)) { ?>
<script>
$(document).ready(function() {
	$('.images-block').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});
</script>
<?php } ?>
<?php if ($socials) { ?>
<script>
  $(".post-info-share > a").on("click", function() {
  var social_url = $(this).prop('href');
  window.open(social_url, "_blank", "width=400,height=700,top=200,left=200,toolbar=yes,scrollbars=yes,resizable=yes");
});
</script>
<?php } ?>
<?php if ($allow_schema_on_post) { ?>i
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
    <?php $b_i = 1; ?>
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      {
        "@type": "ListItem",
        "position": <?php echo $b_i; ?>,
        "name": "<?php echo $breadcrumb['text']; ?>",
        "item": "<?php echo $breadcrumb['href']; ?>"
      }<?php if ($b_i < (count($breadcrumbs))) { ?>,<?php } ?>
      <?php $b_i++; ?>
    <?php } ?>
    ]
  }
  </script>
  <?php if ($thumb && $show_main_image == 1) { ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?php echo $canonical; ?>"
    },
    "headline": "<?php echo $heading_title; ?>",
    "image": [
      "<?php echo $thumb; ?>"
    ],
    "datePublished": "<?php echo $real_date_added; ?>",
    "dateModified": "<?php echo $real_date_modified; ?>",
    "author": {
      "@type": "Person",
      "name": "<?php echo $author; ?>"
    },
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo $author; ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $author_logo; ?>"
      }
    },
    "description": "<?php echo $description; ?>"
  }
  </script>
  <?php } ?>
  <?php if ($video && $show_main_image == 2) { ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": "<?php echo $heading_title; ?>",
    "description": "<?php echo $description; ?>",
    "thumbnailUrl": "https://img.youtube.com/vi/<?php echo $video; ?>/0.jpg",
    "uploadDate": "<?php echo $real_date_added; ?>",
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo $author; ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $author_logo; ?>",
        "width": 600,
        "height": 60
      }
    },
    "embedUrl": "https://www.youtube.com/embed/<?php echo $video; ?>?controls=1&rel=0&showinfo=0&autoplay=1&enablejsapi=1&cc_load_policy=1"
  }
  </script>
  <?php } ?>
<?php } ?>
<?php echo $footer; ?>