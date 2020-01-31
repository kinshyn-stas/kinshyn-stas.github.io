<link href="catalog/view/theme/default/stylesheet/smreview.css" rel="stylesheet">
<div class="col-xlg-60 col-lg-60 col-md-60 col-sm-60 col-xs-60">
        <div class="col-xlg-60">
                <div class="comments_holder">
                    <!-- Змінна для ідентифікування елементів форми коментарія -->
                    <?php $comment_form_row = 0; ?>
                
                    <?php if($reviews) { ?>
                    <?php foreach($reviews as $review){ ?>
                        <script type="application/ld+json">
                            {
                              "@context": "http://schema.org/",
                              "@type": "Review",
                              "itemReviewed": {
                                "@type": "Thing",
                                "name": "<?php echo $review['name'] ?>"
                              },
                              "author": {
                                "@type": "Person",
                                "name": "<?php echo $review['author'] ?>"
                              },
                              "reviewRating": {
                                "@type": "Rating",
                                "ratingValue": "<?php echo $review['rating'] ?>",
                                "bestRating": "<?php echo $smreview_maxrating ?>"
                              },
                              "publisher": {
                                "@type": "Organization",
                                "name": "<?php echo $review['author'] ?>"
                              }
                            }
                            </script>
                    <div class="main-comment_block">
                        <div>
                            <div class="review_block">
                                
                                <div class="container-fluid">                    
                                    <div class="row">                        
                                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                                <?php if($setting_picture == 1) { ?>
                                                    <?php if($review['picture']) { ?>
                                                        <?php if(($review['picture'] != 'no image') and ($review['picture'] != '')) { ?>
                                                            <img class="hidden-markup smreview_picture image_sm" src="<?php echo '/image/'.$review['picture'];?>" style="height: 50px;">
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                        </div>      
                                        
                                        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
                                                <span><span class="client-name"><b><?php echo $review['author'];?></b></span></span>
                                                <?php if($setting_add_date == 1) { ?>
                                                    <div class="published-date_block">
                                                        <span><?php echo $review['date_added'];?></span>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="rating_block smrating">
                                                            <?php if($setting_rating == 1) { ?>
                                                            <ul>
                                                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                                <?php if ($review['rating'] < $i) { ?>
                                                                <li >
                                                                    <div></div>
                                                                </li>
                                                                <?php } else { ?>
                                                                <li class="marked">
                                                                    <div></div>
                                                                </li>
                                                                <?php } ?>
                                        
                                                                <?php } ?>
                                                            </ul>
                                                            <?php } ?>
                                                           
                                                        </div>
                                                    <div class="review-text_block">
                                                        <p><?php echo $review['text'];?></p>
                                                    </div>
                                                    <div class="data_block">
                                   
                                   
                                        
                                   
                                  
                                                            <?php if($setting_video == 1) { ?>
                                                                <?php if($review['video']) { ?>
                                                                    <?php if(($review['video'] != 'no video') and ($review['video'] != '')) { ?>
                                                                        <?php if(strrpos($review['video'], "youtube")) { ?>
                                                                            <img class="hidden-markup smreview_picture image_sm_yt" src="/image/smreview/yt.png" style="width: 80px; height: 50px;">
                                                                            <iframe width="500" height="300" class="hidden" src="<?php echo $review['video'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                        <?php } else { ?>
                                                                            <img class="hidden-markup smreview_picture image_sm_video" src="/image/smreview/video.png" style="width: 80px; height: 50px;">
                                                                            <video class="user-video hidden" width="500" height="300" controls="controls">
                                                                                <source class="user-source-video" src="<?php echo '/image/'.$review['video'];?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                                                                            </video>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php if($setting_like == 1) { ?>
                                                                <?php if(isset($allow_customer)) { ?>
                                                                    <?php if($allow_customer == 1) { ?>
                                                                    <div class="likes_block">
                                                                        <div class="like">
                                                                            <?php // Якщо користувач ставив лайки або дізлайки на відгуки даного товару
                                                                            if($info_custom_like != array()){ ?>
                                                                                <?php // Якщо користувач ставив лайк або дізлайк на даний відгук
                                                                                 if(array_key_exists($review['id'], $info_custom_like)){ ?>
                                                                                    <?php // Якщо користувач ставив лайк на даний відгук - виділяємо лайк
                                                                                     if($info_custom_like[$review['id']]['like'] == 1 and $info_custom_like[$review['id']]['dslike'] == 0){ ?>
                                                                                        <button type="button" onclick="addlike.like(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $review['id'];?>" class="like-button btn_like_dslike_active"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                                        <!--
                                                                                        </div>
                                                                                        <div class="dislike">
                                                                                        -->
                                                                                        <button  type="button" onclick="addlike.dslike(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $review['id'];?>" class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                                    <?php } // Якщо  ж користувач ставив дізлайк на даний відгук - виділяємо дізлайк
                                                                                     elseif($info_custom_like[$review['id']]['dslike'] == 1 and $info_custom_like[$review['id']]['like'] == 0){ ?>
                                                                                        <button type="button" onclick="addlike.like(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $review['id'];?>" class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                                        <button  type="button" onclick="addlike.dslike(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $review['id'];?>" class="dislike-button btn_like_dslike_active"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                                    <?php } // Якщо  ж користувач нічого не ставив на даний відгук - нічого не виділяємо
                                                                                    else{ ?>
                                                                                        <button type="button" onclick="addlike.like(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $review['id'];?>" class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                                        <button  type="button" onclick="addlike.dslike(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $review['id'];?>" class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                                    <?php } ?>
                                                                                <?php }else{ ?>
                                                                                    <button type="button" onclick="addlike.like(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $review['id'];?>" class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                                    <button  type="button" onclick="addlike.dslike(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $review['id'];?>" class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                                <?php } ?>
                                                                            <?php }else{ ?>
                                                                                <button type="button" onclick="addlike.like(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $review['id'];?>" class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                                <button  type="button" onclick="addlike.dslike(<?php echo $review['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $review['id'];?>" class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                <?php }else{ ?>
                                                                    <div class="likes_block">
                                                                        <div class="like">
                                                                            <button type="button" onclick="itguest();" id="like-<?php echo $review['id'];?>" class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span><?php echo $review['like'];?></span>
                                                                            <button  type="button" onclick="itguest();" id="dslike-<?php echo $review['id'];?>" class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span><?php echo $review['dslike'];?></span>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php if($setting_comment == 1) { ?>
                                                            <div class="review-text_block">
                                                                <button class="wright-answer wright-answer-<?php echo $comment_form_row;?> btn btn-primary"><?php echo $text_reply;?></button>
                                                            </div>
                                                            <?php } ?>
                                                            <?php // Якщо на відгук є коментарі - виводимо кнопку "Показати/приховати"
                                                            if(!empty($review['comment'])){ ?>
                                                            <div class="review-text_block">
                                                                <p class="hide_show_comment"><?php echo $text_show_hide_comments .' ('. count($review['comment']) .')';?></p>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                        </div>
                                                          
                                    </div>                    
                                </div>
                                
                                   
                
                                
                
                
                               
                            </div>
                        </div>
                        <?php if(!empty($review['comment'])){ ?>
                        <div class="subcomment_block">
                            <div><!--<img class="hidden-markup" src="<?php echo $review['image'];?>" alt="Кастрюля с крышкой Bergner"><span class="hidden-markup"><?php echo $review['name'];?></span>-->
                                <?php foreach($review['comment'] as $comment){ ?>
                                <div class="review_block">
                                    <?php if($setting_add_date == 1) { ?>
                                    <div class="published-date_block" style="float: right;">
                                        <span><?php echo $comment['date_added'];?></span>
                                        <meta content="<?php echo $comment['date_added'];?>">
                                    </div>
                                    <?php } ?>
                                    <div class="image_block"><img src="<?php echo $comment['image'];?>"></div>
                                    <div class="data_block"><span><span class="client-name"><b><?php echo $comment['author'];?></b></span></span><span class="hidden-markup"></span>
                                        <div class="review-text_block">
                                            <?php echo $comment['text'];?>
                                        </div>
                                        <?php if($setting_like == 1) { ?>
                                            <?php if(isset($allow_customer)) { ?>
                                                <?php if($allow_customer == 1) { ?>
                                                <div class="likes_block">
                                                    <div class="like">
                                                        <?php // Якщо користувач ставив лайки або дізлайки на відгуки даного товару
                                                        if($info_custom_like != array()){ ?>
                                                            <?php // Якщо користувач ставив лайк або дізлайк на даний відгук
                                                             if(array_key_exists($comment['id'], $info_custom_like)){ ?>
                                                                <?php // Якщо користувач ставив лайк на даний відгук - виділяємо лайк
                                                                 if($info_custom_like[$comment['id']]['like'] == 1 and $info_custom_like[$comment['id']]['dslike'] == 0){ ?>
                                                                    <button type="button" onclick="addlike.like(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $comment['id'];?>"  class="like-button btn_like_dslike_active"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                                    <!--
                                                                    </div>
                                                                    <div class="dislike">
                                                                    -->
                                                                    <button type="button" onclick="addlike.dslike(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                                <?php } // Якщо  ж користувач ставив дізлайк на даний відгук - виділяємо дізлайк
                                                                 elseif($info_custom_like[$comment['id']]['dslike'] == 1 and $info_custom_like[$comment['id']]['like'] == 0){ ?>
                                                                    <button type="button" onclick="addlike.like(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $comment['id'];?>"  class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                                    <button type="button" onclick="addlike.dslike(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button btn_like_dslike_active"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                                <?php } // Якщо  ж користувач нічого не ставив на даний відгук - нічого не виділяємо
                                                                    else{ ?>
                                                                    <button type="button" onclick="addlike.like(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $comment['id'];?>"  class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                                    <button type="button" onclick="addlike.dslike(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <button type="button" onclick="addlike.like(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $comment['id'];?>"  class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                                <button type="button" onclick="addlike.dslike(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                            <?php } ?>
                                                        <?php }else{ ?>
                                                            <button type="button" onclick="addlike.like(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="like-<?php echo $comment['id'];?>"  class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                            <button type="button" onclick="addlike.dslike(<?php echo $comment['id'];?>,<?php echo $product_id; ?>);" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            <?php }else{ ?>
                                            <div class="likes_block">
                                                <div class="like">
                                                    <button type="button" onclick="itguest();" id="like-<?php echo $comment['id'];?>"  class="like-button"><i class="fa fa-thumbs-o-up"></i></button><span> <?php echo $comment['like'];?></span>
                                                    <button  type="button" onclick="itguest();" id="dslike-<?php echo $comment['id'];?>"  class="dislike-button"><i class="fa fa-thumbs-down"></i></button><span> <?php echo $comment['dslike'];?></span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                
                
                
                
                        <?php if($setting_comment == 1) { ?>
                            <div class="answer-to-comment_form answer-to-comment_form-<?php echo $comment_form_row; ?> wrap_smcomment">
                                <form id="form-smreview-comment_<?php echo $comment_form_row; ?>">
                                    <div class="custom-input_block" animated-placeholder="<?php echo $text_name;?>">
                                        <input class="custom-field input_name_<?php echo $comment_form_row; ?>" id="comment_name_rev" type="text" name="name" placeholder="<?php echo $text_name;?>" value="<?php echo isset($name_customer)?$name_customer:'' ?>" <?php echo isset($name_customer)?'readonly':'' ?>>
                                    </div>
                                    <div class="custom-input_block" animated-placeholder="<?php echo $text_text;?>">
                                        <textarea class="custom-field textarea_<?php echo $comment_form_row; ?>" id="comment_text_rev" rows="5" style="height: auto; width: 100%;" name="text" placeholder="<?php echo $text_text;?>"></textarea>
                                    </div>
                                    <input class="custom-field" type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                                    <button type="button" class="btn btn-primary" id="send-client-review-comment_button_<?php echo $comment_form_row; ?>"><?php echo $text_send;?></button>
                                </form>
                            </div>
                        <?php } ?>
                
                        <script>
                            $('document').ready(function(){
                                $('.wright-answer-<?php echo $comment_form_row; ?>').on('click',function(){
                                    $('.answer-to-comment_form-<?php echo $comment_form_row; ?>').slideToggle(300);
                                });
                            });
                        </script>
                        <?php if( !empty($reviews) && !empty($reviews[array_keys($reviews)[0]]['product_id'])) { ?>
                        <script>
                
                                $('#send-client-review-comment_button_<?php echo $comment_form_row; ?>').on('click', function(en) {
                                    en.preventDefault();
                                    $.ajax({
                                        url: "index.php?route=extension/module/smreview/write&product_id=<?php echo $reviews[array_keys($reviews)[0]]['product_id']; ?>",
                                        type: 'post',
                                        dataType: 'json',
                                        data: $("#form-smreview-comment_<?php echo $comment_form_row; ?>").serialize(),
                                        success: function(json) {
                                            $('.alert-success, .alert-danger').remove();
                
                                            if (json['error']) {
                                                //$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                                                if(json['error']['error_name']){
                                                    $('.input_name_<?php echo $comment_form_row; ?>').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_name'] + '</div>');
                                                }
                                                if(json['error']['error_text']){
                                                    $('.textarea_<?php echo $comment_form_row; ?>').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_text'] + '</div>');
                                                }
                                            }
                
                                            if (json['success']) {
                                                $('.answer-to-comment_form-<?php echo $comment_form_row; ?>').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                                                /*$('.answer-to-comment_form').hide();*/
                                                $('input[name=\'name\']').val('');
                                                $('textarea[name=\'text\']').val('');
                                                $('input[name=\'rating\']:checked').prop('checked', false);
                                                $('.answer-to-comment_form-<?php echo $comment_form_row; ?>').slideToggle(600);
                                            }
                                        }
                                    });
                                });
                
                        </script>
                        <?php } ?>
                        <?php $comment_form_row++; ?>
                
                
                    </div>
                    <?php  } ?>
                    <?php  } ?>
                </div>
                
                </div>
    <div class="client-review_block">
        <div class="client-review-head_block <?php echo ($setting_display_form == 1)?'hidden':''; ?> ">
            <?php // Змінна, яка дозволяє (1) чи забороняє (0) завжди показувати форму відгуку
            $allow_style_display_form = 0; ?>
                <?php // *1* Налаштування - тільки зареєстровані користувачі залишають відгук
                 if($setting_add_review_customer == 1) { ?>
                    <?php // *2* Якщо користувач авторизувався
                     if(isset($allow_customer)) { ?>
                        <?php if($allow_customer == 1) { ?>
                            <?php // *3* Налаштування - тільки ті, хто купив товар може залишати відгук
                             if($setting_add_review_customer_buy == 1) { ?>
                                <?php // *4* Якщо користувач купив товар
                                 if(isset($allow_customer_buy)) { ?>
                                    <?php if($allow_customer_buy == 1) { ?>
                                        <!--<button type="button" class="open-review-form_button "><?php echo $text_write_review; ?></button>-->
                                        <button type="button" class="btn btn-primary btn-lg btn_show"><?php echo $text_write_review; ?></button>
                                        <?php $allow_style_display_form = 1; ?>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php // Змінна для виведення тексту, якщо користувач не купив товар
                                        $text_allow_customer_buy_num = 1;
                                    ?>
                                <?php } ?>
                            <?php }else{ ?>
                                <!--<button type="button" class="open-review-form_button"><?php echo $text_write_review; ?></button>-->
                                <button type="button" class="btn btn-primary btn-lg btn_show"><?php echo $text_write_review; ?></button>
                                <?php $allow_style_display_form = 1; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php // Змінна для виведення тексту, якщо користувач не авторизувався
                            $text_allow_customer_num = 1;
                        ?>
                    <?php } ?>
                <?php }else{ ?>
                    <!--<button type="button" class="open-review-form_button"><?php echo $text_write_review; ?></button>-->
                    <button type="button" class="btn btn-primary btn-lg btn_show"><?php echo $text_write_review; ?></button>
                    <?php $allow_style_display_form = 1; ?>
                <?php } ?>
        </div>
        <?php // Якщо є змінні для виведення тексту, якщо користувач не авторизований, або не купив товар - виводимо їх
            if(isset($text_allow_customer_num) and $text_allow_customer_num == 1){
                echo '<p>' . $text_allow_customer . '<a href="'.$login.'">'.$text_allow_customer_log.'</a>' . $text_or . '<a href="'.$register.'">'.$text_allow_customer_reg.'</a>' .'</p>';
            }
            if(isset($text_allow_customer_buy_num) and $text_allow_customer_buy_num == 1){
                echo '<p>' . $text_allow_customer_buy . '</p>';
            }

        ?>
        <div class="review-form_block collapse block_add_smreview" <?php echo $allow_style_display_form == 1?$style_display_form:''; ?>><span class="review-form_title"><?php echo $text_write_review; ?> </span>
            <button class="close"><span class="first"></span><span class="second"></span></button>
            <form class="form-horizontal" id="form-review" enctype="multipart/form-data">

                <div class="form-body_block">
                    <div class="add-photo_block"><img class="user-photo" src="/image/user_placeholder.png">
                        <?php if($setting_gravatar === 1) { ?>  <button class="select-photo-trigger" type="button"><?php echo $text_chose_photo; ?></button> <?php } ?>
                        <input type="text" name="logo" id="select-user-photo" style="display:none;" >
                    </div>
                    <div class="custom-input_block" animated-placeholder="<?php echo $text_mail;?>">
                        <input class="custom-field" type="email" id="client-mail" name="mail" placeholder="<?php echo $text_mail; ?>" value="<?php echo isset($email_customer)?$email_customer:'' ?>" <?php echo isset($email_customer)?'readonly':'' ?>>
                    </div>
                    <div class="custom-input_block" animated-placeholder="<?php echo $text_name; ?>">
                        <input class="custom-field" type="text" id="client-name" name="name" placeholder="<?php echo $text_name; ?>" value="<?php echo isset($name_customer)?$name_customer:'' ?>" <?php echo isset($name_customer)?'readonly':'' ?>>
                    </div>
                    <div class="custom-input_block" animated-placeholder="<?php echo $text_review; ?>">
                        <textarea class="custom-field" id="client-comment" name="text" placeholder="<?php echo $text_review; ?>" rows="4" style="height: auto;"></textarea>
                    </div>
                    <?php if($setting_rating == 1) { ?>
                    <div class="review-rating_block add_smrating"><span class="rating_title"><?php echo $text_rating; ?></span>
                        <ul>
                            <li class="current-rating">
                                <input type="radio" id="review_rating_1" value="1" name="rating">
                                <label for="review_rating_1"></label>
                            </li>
                            <li class="current-rating">
                                <input type="radio" id="review_rating_2" value="2" name="rating">
                                <label for="review_rating_2"></label>
                            </li>
                            <li class="current-rating">
                                <input type="radio" id="review_rating_3" value="3" name="rating">
                                <label for="review_rating_3"></label>
                            </li>
                            <li class="current-rating">
                                <input type="radio" id="review_rating_4" value="4" name="rating">
                                <label for="review_rating_4"></label>
                            </li>
                            <li class="current-rating">
                                <input type="radio" id="review_rating_5" value="5" name="rating" checked>
                                <label for="review_rating_5"></label>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                    <?php if($setting_picture == 1) { ?>
                    <div class="add-photo_block"><img class="user-picture hidden" src="../image/user_placeholder.png" style="width: 150px; height: 150px;">
                        <div class="user_picture_text hidden" style="margin-bottom: 5px;"><img src="/image/smreview/icon_image.png" style="width: 80px; height: 50px;"></div>
                        <a class="btn btn-danger hidden" id="fa_picture" title="<?php echo $text_delete; ?>"><i class="fa fa-minus-circle"></i></a>
                        <button class="select-picture-trigger btn btn-primary" type="button"><?php echo $text_chose_photo ?></button>
                        <input type="file" name="picture" id="select-user-picture" style="display:none;">
                    </div>
                    <?php } ?>
                    <?php if($setting_video == 1) { ?>
                    <div class="add-photo_block">
                        <!--<video class="user-video hidden" width="400" height="300" controls="controls">
                            <source class="user-source-video" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                        </video>-->

                        <div class="custom-input_block">
                            <div class="user_video_text hidden" style="margin-bottom: 5px;"><img src="/image/smreview/video.png" style="width: 80px; height: 50px;"></div>
                            <a class="btn btn-danger hidden" id="fa_video" title="<?php echo $text_delete; ?>"><i class="fa fa-minus-circle"></i></a>
                            <button class="select-video-trigger btn btn-primary" type="button"><?php echo $text_chose_video ?></button>
                            <input type="file" name="video" id="select-user-video" style="display:none;">
                            <b><?php echo $text_chose_video_yt ?></b>
                            <input type="text" style="width:300px" class="custom-field" name="video_yt" placeholder="https://www.youtube.com/watch?v=XXXXXXX">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="wrap_send_review">
                        <button type="submit" class="btn btn-primary btn-lg btn_send_review" id="send-client-review_button" type="button"><?php echo $text_write_review; ?></button>
                        <div id="smprogress" class="hidden"><img src="/image/smreview/progress.gif" style="width: 50px; height: auto;"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // animate rating stars --start
    function ratingAnimation(){
        var checkedInput = $('.review-rating_block li input[type="radio"]:checked');
        checkedInput.parent().addClass("current-rating").prevAll().addClass("current-rating");
        $('.review-rating_block li').hover(function(){
            $(this).addClass("current-rating");
            $(this).prevAll().addClass("current-rating");
            $(this).nextAll().removeClass("current-rating");
        }, function(){
            checkedInput = $('.review-rating_block li input[type="radio"]:checked');
            checkedInput.parent().nextAll().removeClass("current-rating");
            checkedInput.parent().prevAll().addClass("current-rating");
            checkedInput.parent().addClass("current-rating");
        })
    };
    ratingAnimation();
    // animate rating stars --end
</script>

<div class="col-xlg-60 col-lg-60 col-md-60 col-sm-60 col-xs-60 col-xxs-60">
<div class="pagination_block"><?php echo $pagination; ?></div>
</div>
<script>
    $('document').ready(function(){
        $('.hide_show_comment').click(function(){
            $(this).closest('.main-comment_block').find('.subcomment_block').slideToggle(500);
        });
    });
</script>
<style>
    /*.pagination_element{*/
        /*list-style-type: none;*/
        /*display: inline;*/
        /*margin-right: 5px;*/
        /*padding: 3px;*/
        /*border: 1px solid #23a1d1;*/
    /*}*/
    /*.pagination_element a{*/
        /*text-decoration: none;*/
    /*}*/
    /*.main_pagination_element{*/
        /*margin-top: 10px;*/
    /*}*/
    .main_image_review{
        width: 50px;
        height: 50px;
    }
    .pagination{
        margin-top: 10px;
    }
    .like-button, .dislike-button{
        border: none;
        outline: none;
        background: none;
    }
    .likes_block{
        text-align: right;
        height: auto;
        padding-top: 10px;
    }
    .wrap_send_review{
        text-align: center;
        margin-top: 15px;
    }
    .btn_like_dslike_active{
        color: #0000ff;
    }
    .hide_show_comment{
        margin-top: 5px;
        color: #00b3ee;
        cursor: pointer;
    }
    .hide_show_comment:hover{
        color: #13cfee;
    }
    .add-photo_block{
        margin: 5px 0px;
    }
    .smreview_picture{
        margin-bottom: 4px;
    }
    .block_add_smreview{
        padding: 20px;
    }
    .add_smrating ul li{
        list-style-type: none;
    }
    .client-name{
        font-size: 15px;
    }
    .wrap_smcomment{
        border-bottom: 1px solid rgba(160, 159, 214, 0.25);
        border-radius: 2px;
        margin-top: 5px;
        padding: 3px 0px 10px 20px;
    }
    .likes_block{
        margin-top: 5px;
    }
    .answer-to-comment_form{
        display: none;
    }
    .subcomment_block {
        display: none;
    }
    .subcomment_block, .subcomment_block .review_block{
        padding-left: 20px;
    }
    .review_block{
        margin-top: 5px;
        padding: 7px;
       
    }
</style>
<script>
    //$('#send-client-review_button').on('click', function(e) {
    $('#form-review').on('submit', function(e) {
        e.preventDefault();
        $('#smprogress').removeClass('hidden');
        var files = $(this)[0];
        var trst = $('#form-review');
        var formdata = new FormData (files);
        var fatal_error = '<?php echo $fatal_error; ?>';
        //console.log(formdata);
        $.ajax({
            url: 'index.php?route=extension/module/smreview/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            async: true,
            //data: $("#form-review").serialize(),
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,
            success: function(json) {
                $('.alert-success, .alert-danger').remove();
                $('#smprogress').addClass('hidden');

                if (json['error']) {
                    if(json['error']['fatal_error']){
                        $('#form-review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['fatal_error'] + '</div>');
                    }
                    if(json['error']['error_name']){
                        $('#client-name').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_name'] + '</div>');
                    }
                    if(json['error']['error_email']){
                        $('#client-mail').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_email'] + '</div>');
                    }
                    if(json['error']['error_text']){
                        $('#client-comment').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_text'] + '</div>');
                    }
                    if(json['error']['error_file_video_review_type']){
                        $('.select-video-trigger').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_file_video_review_type'] + '</div>');
                    }
                    if(json['error']['error_video_review_size']){
                        $('.select-video-trigger').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_video_review_size'] + '</div>');
                    }
                    if(json['error']['error_review_link_yt']){
                        $('input[name=\'video_yt\']').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_review_link_yt'] + '</div>');
                    }
                    if(json['error']['error_file_review_type']){
                        $('.select-picture-trigger').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_file_review_type'] + '</div>');
                    }
                    if(json['error']['error_file_review_size']){
                        $('.select-picture-trigger').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['error_file_review_size'] + '</div>');
                    }
                    //$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    /*$('.review-form_block').hide();*/
                    //$('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'picture\']').val('');
                    $('input[name=\'video\']').val('');
                    $('#review_rating_5 + label').trigger('click');
                    $('.add_smrating ul li').addClass("current-rating");
                    //$('input[name=\'rating\']:checked').prop('checked', true);
                    $('.user-picture').addClass('hidden');
                    var allow_style_display_form = '<?php echo $setting_display_form; ?>';
                    if(allow_style_display_form == '0'){
                        $('.review-form_block').hide();
                        $('.client-review_block').after('<div class="alert alert-success" style="margin-top: 5px;"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                    }else{
                        $('#form-review').after('<div class="alert alert-success" style="margin-top: 5px;"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
                    }
                }
            },
            error: function(){
                $('#smprogress').addClass('hidden');
                $('#form-review').after('<div class="alert alert-danger" style="margin-top: 5px;"><i class="fa fa-exclamation-circle"></i> ' + fatal_error + '</div>');
            }
        });
    });
    var addlike = {
        'like': function(id,product_id) {
            $.ajax({
                url: 'index.php?route=extension/module/smreview/addlike',
                type: 'post',
                dataType: 'json',
                data: 'id=' + id + '&product_id=' + product_id,
                success: function(json) {
                    // Якщо прийшла відповідь від сервера
                    if (json['success']) {
                        // Якщо користувач вже ставив лайк - прибираємо активний стиль лайку
                        if($('#like-'+id).hasClass('btn_like_dslike_active')){
                            $('#like-'+id).removeClass('btn_like_dslike_active');
                        }else{
                            // Якщо ж не ставив раніше лайк - ставимо активний стиль лайку
                            $('#like-'+id).addClass('btn_like_dslike_active');
                        }
                        // Оновлюємо число лайків
                        $('#like-'+id).next('span').text(json['success']['like']);
                        // Якщо раніше ставив дізлайк - прибираємо активний стиль дізлайку та оновлюємо число дізлайків
                        if(json['success']['dslike']){
                            $('#dslike-'+id).removeClass('btn_like_dslike_active');
                            $('#dslike-'+id).next('span').text(json['success']['dslike']);
                        }
                    }
                }
            });
        },
        'dslike': function(id,product_id) {
            $.ajax({
                url: 'index.php?route=extension/module/smreview/adddslike',
                type: 'post',
                dataType: 'json',
                data: 'id=' + id + '&product_id=' + product_id,
                success: function(json) {
                    // Якщо прийшла відповідь від сервера
                    if (json['success']) {
                        // Якщо користувач вже ставив дізлайк - прибираємо активний стиль дізлайку
                        if($('#dslike-'+id).hasClass('btn_like_dslike_active')){
                            $('#dslike-'+id).removeClass('btn_like_dslike_active');
                        }else{
                            // Якщо ж не ставив раніше дізлайк - ставимо активний стиль дізлайку
                            $('#dslike-'+id).addClass('btn_like_dslike_active');
                        }
                        // Оновлюємо число дізлайків
                        $('#dslike-'+id).next('span').text(json['success']['dslike']);
                        // Якщо раніше ставив лайк - прибираємо активний стиль лайку та оновлюємо число лайків
                        if(json['success']['like']){
                            $('#like-'+id).removeClass('btn_like_dslike_active');
                            $('#like-'+id).next('span').text(json['success']['like']);
                        }
                    }
                }
            });
        }
    }

    function showReviewForm(){
        $('button.open-review-form_button').click(function(){
            $('.review-form_block').slideToggle();
        });
        $('button.btn_show').click(function(){
            $('.review-form_block').slideToggle();
        });
        $('.client-review_block .review-form_block button.close').click(function(){
            $('.review-form_block').slideUp();
        });
    };

    showReviewForm();

    $(".select-picture-trigger").click(function(){
        $("#select-user-picture").trigger("click");
    });
    $(".select-video-trigger").click(function(){
        $("#select-user-video").trigger("click");
    });
</script>
<?php if($setting_picture == 1) { ?>
<script>
    function selectUserPicture(e) {
        $('.div_error_picture').remove();
        var file = document.getElementById("select-user-picture").files[0];
        if (typeof file != 'undefined'){
            var ext = "не определилось",
                error = 0,
                parts = file.name.split('.');


            if (parts.length > 1) ext = parts.pop();

            if(ext != 'jpg' && ext != 'jpeg' && ext != 'png' && ext != 'gif'){
                $('.select-picture-trigger').after('<div class="alert alert-danger div_error_picture" style="margin-top: 5px;"><i class="fa fa-exclamation-circle"></i><?php echo $error_file_review_type; ?></div>');
                $('#send-client-review_button').attr('disabled','disabled');
                $(".user_picture_text").removeClass("hidden");
                $('.user-picture').addClass('hidden');
                $("#fa_picture").removeClass("hidden");
                error = 1;
            }
            if(file.size > <?php echo $picture_max_size;?>){
                $('.select-picture-trigger').after('<div class="alert alert-danger div_error_picture" style="margin-top: 5px;"><i class="fa fa-exclamation-circle"></i><?php echo $error_file_review_size; ?></div>');
                $('#send-client-review_button').attr('disabled','disabled');
                $(".user_picture_text").removeClass("hidden");
                $('.user-picture').addClass('hidden');
                $("#fa_picture").removeClass("hidden");
                error = 1;
            }

            if(error == 0){
                $('#send-client-review_button').removeAttr('disabled');
                $(".user_picture_text").addClass("hidden");
            }

            var files = e.target.files;

            for (var i = 0, f; f = files[i]; i++) {

                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();


                reader.onload = (function(theFile) {
                    return function(e) {
                        $(".user-picture").attr("src", e.target.result);
                        $(".user-picture").removeClass("hidden");
                        $("#fa_picture").removeClass("hidden");
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }else{
            $('#send-client-review_button').removeAttr('disabled');
            $(".user_picture_text").addClass("hidden");
            $("#fa_picture").addClass("hidden");
            $(".user-picture").addClass("hidden");
        }
    }
    document.getElementById('select-user-picture').addEventListener('change', selectUserPicture, false);
    $(document).ready(function(){
        $("#fa_picture").on("click", function(){
            $("#select-user-picture").val('');
            $('#send-client-review_button').removeAttr('disabled');
            $(".user_picture_text").addClass("hidden");
            $("#fa_picture").addClass("hidden");
            $(".user-picture").addClass("hidden");
            $(".div_error_picture").addClass("hidden");
        });
    });
</script>
<?php } ?>
<?php if($setting_video == 1) { ?>
<script>
    function selectUserVideo(e) {
        $('.div_error_video').remove();
        var file = document.getElementById("select-user-video").files[0];
        if (typeof file != 'undefined'){
            var ext = "не определилось",
                error = 0,
                parts = file.name.split('.');

            if (parts.length > 1) ext = parts.pop();

            if(ext != 'mp4'){
                $('.select-video-trigger').after('<div class="alert alert-danger div_error_video" style="margin-top: 5px;"><i class="fa fa-exclamation-circle"></i><?php echo $error_file_video_review_type; ?></div>');
                $('#send-client-review_button').attr('disabled','disabled');
                $(".user_video_text").removeClass("hidden");
                $('.user-video').addClass('hidden');
                $("#fa_video").removeClass("hidden");
                error = 1;
            }
            if(file.size > <?php echo $video_max_size;?>){
                $('.select-video-trigger').after('<div class="alert alert-danger div_error_video" style="margin-top: 5px;"><i class="fa fa-exclamation-circle"></i><?php echo $error_file_review_size; ?></div>');
                $('#send-client-review_button').attr('disabled','disabled');
                $(".user_video_text").removeClass("hidden");
                $('.user-video').addClass('hidden');
                $("#fa_video").removeClass("hidden");
                error = 1;
            }
            if(error == 0){
                $('#send-client-review_button').removeAttr('disabled');
                $(".user_video_text").removeClass("hidden");
                $("#fa_video").removeClass("hidden");
            }

            var files = e.target.files;

            for (var i = 0, f; f = files[i]; i++) {

                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();


                reader.onload = (function(theFile) {
                    return function(e) {
                        $(".user-source-video").attr("src", e.target.result);
                        //$(".user-video").removeClass("hidden");
                        $("#fa_video").removeClass("hidden");
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }else{
            $('#send-client-review_button').removeAttr('disabled');
            $(".user_video_text").addClass("hidden");
            $("#fa_video").addClass("hidden");
            $(".user-video").addClass("hidden");
        }
    }
    document.getElementById('select-user-video').addEventListener('change', selectUserVideo, false);
    $(document).ready(function(){
        $("#fa_video").on("click", function(){
            $("#select-user-video").val('');
            $('#send-client-review_button').removeAttr('disabled');
            $(".user_video_text").addClass("hidden");
            $("#fa_video").addClass("hidden");
            $(".user-video").addClass("hidden");
            $(".div_error_video").addClass("hidden");
        });
    });

</script>
<?php } ?>
<script>
    $(".select-photo-trigger").click(function(){
        $("#select-user-photo").trigger("click");
    });
    function selectUserPhoto(e) {
        var files = e.target.files;

        for (var i = 0, f; f = files[i]; i++) {

            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();


            reader.onload = (function(theFile) {
                return function(e) {
                    $(".user-photo").attr("src", e.target.result);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
    document.getElementById('select-user-photo').addEventListener('change', selectUserPhoto, false);
</script>
    <?php if($setting_gravatar == 1) { ?>
<script>
    // gravatar
    $('#client-mail').focusout(function() {
        mail = $( this ).val();
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
        if((mail != 0)&&(!pattern.test(mail))) {
            $( this ).focus();
        } else {
            $.ajax({
                url: 'index.php?route=extension/module/smreview/get_gravatar',
                type: 'post',
                data: 'mail=' + mail,

                success: function (json) {
                    console.log(json);
                    $('#form-review .user-photo').attr("src", json);
                    $('#form-review input#select-user-photo').val(json);
                }
            });
        }
    });
</script>
    <?php } ?>
<style>
    .popup {
        position: fixed;
        height: 1378px;
        width: 768px;
        top:0;
        left:0;
        display:none;
        text-align:center;
        z-index: 10;
    }

    .popup_bg {
        background:rgba(0,0,0,0.4);
        position:fixed;
        z-index:1;
        height:100%;
        width:100%;
    }


    .popup_img {
        position: fixed;
        /*margin:0 auto;*/
        z-index:2;
        max-height:94%;
        max-width:94%;
        margin:1% 0 0 0;
    }
</style>
<script>
    $(document).ready(function() { // Ждём загрузки страницы

        $(".image_sm").click(function(){	// Событие клика на маленькое изображение
            var img = $(this);	// Получаем изображение, на которое кликнули
            var src = img.attr('src'); // Достаем из этого изображения путь до картинки
            $("body").append("<div class='popup'>"+ //Добавляем в тело документа разметку всплывающего окна
                "<div class='popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
                "<img src='"+src+"' class='popup_img' />"+ // Само увеличенное фото
                "</div>");
            $(".popup").fadeIn(800); // Медленно выводим изображение
            $(".popup_bg").click(function(){	// Событие клика на затемненный фон
                $(".popup").fadeOut(800);	// Медленно убираем всплывающее окно
                setTimeout(function() {	// Выставляем таймер
                    $(".popup").remove(); // Удаляем разметку всплывающего окна
                }, 800);
            });
        });
        $(".image_sm_yt").click(function(){
            var src = $(this).closest('.data_block').find('iframe').attr('src');
            $("body").append("<div class='popup'>"+
                "<div class='popup_bg'></div>"+
                "<iframe width='900' height='500' src='"+src+"' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen class='popup_img'></iframe>"+ // Само увеличенное фото
                "</div>");
            $(".popup").fadeIn(800);
            $(".popup_bg").click(function(){
                $(".popup").fadeOut(800);
                setTimeout(function() {
                    $(".popup").remove();
                }, 800);
            });
        });
        $(".image_sm_video").click(function(){
            var src = $(this).closest('.data_block').find('source').attr('src');
            $("body").append("<div class='popup'>"+
                "<div class='popup_bg'></div>"+
                "<video class='user-video popup_img' width='900' height='500' controls='controls'>"+
                "<source class='user-source-video' src='"+src+"' type='video/mp4; codecs=\"avc1.42E01E, mp4a.40.2\"'>"+
                "</video>"+
                "</div>");
            $(".popup").fadeIn(800);
            $(".popup_bg").click(function(){
                $(".popup").fadeOut(800);
                setTimeout(function() {
                    $(".popup").remove();
                }, 800);
            });
        });

    });

    function itguest(){
        alert('<?php echo $text_allow_customer_like; ?>');
    }
</script>