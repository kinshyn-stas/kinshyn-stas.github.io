<?php echo $header; ?>
<script>
    $(document).ready(function() {
        $("#phone").mask("(099) 999-99-99");

    });
</script>
<script>
    $(document).ready(function() {
        calc();
        $('input:checkbox').on('click', function(){
            var str = $(this).parent().text().match(/[+]([^г]*)/g);
            if (str)
            {
                var sum = str[0].substring(1, str[0].length);
                var price = $('.price').first().text();
                price = price.slice(0,-3);
                if ($(this).is(":checked"))
                {
                    var pricu_sum = parseInt(price) + parseInt(sum);
                }
                else
                {
                    var pricu_sum = parseInt(price) - parseInt(sum);
                }
                pricu_sum = Math.round(pricu_sum).toFixed(2)
                $('.price').first().text(pricu_sum+' грн');
            }
        });
        $('#kvm').on('keyup', function(){
            calc();
        });
        $('input[name=stock]').on('change', function(){
            calc();
        });

        function calc(){
            var price = parseFloat($('#price').val());
            var pack_price = parseFloat($('#pack_price').val());
            var kvm = $('#kvm').val();
            var stock = $('input[name=stock]:checked').val();
            var kvm_for_stock = 0;
            var packs = 0;
            var cost = 0;
            var meter = 0;
            var sale_proc = 0;
            var sale = 0;
            var cost_sale = 0;
            var proc = 0;
            if (kvm)
            {
                kvm_for_stock = kvm / pack_price;
                packs = Math.ceil(kvm_for_stock * stock);
                meter = packs * pack_price;
                meter = meter.toFixed(2);
                cost = (packs * price * pack_price).toFixed(2);
                //sale_proc = parseInt((packs / 1000) * 100) / 100 ;
                sale_proc = parseInt((Math.trunc(kvm) / 1000) * 100) / 100 ;
                if ((sale_proc >= 0.01) && (sale_proc < 0.1))
                {
                    sale = cost * sale_proc;
                    proc = sale_proc * 100;
                }else if (sale_proc >= 0.1)
                {
                    sale = cost * 0.1;
                    proc = 10;
                }else
                {
                    sale = 0;
                    proc = 0;
                }
                cost_sale = (cost - sale).toFixed(2);
                // console.log('Необходимая площадь '+kvm);
                // console.log('Цена за м2 '+price);
                // console.log('Пачек '+packs);
                // console.log('Цена '+cost);
                // console.log('Цена со скодкой '+ cost_sale);
                // console.log('Процент скидки '+ sale_proc);
                // console.log('Метраж '+ meter);

                // $('#cost').val(cost);
                // if (cost_sale == cost)
                //     $('#cost_sale').val('');
                // else $('#cost_sale').val(cost_sale);
                $('strong.price').first().text(cost_sale+' грн');
                $('#calc_sale').text('скидка '+proc+'%');
                $('#result').html('<span><p>Потребуется:</p>'+packs+' пачек ('+meter+' м<sup>2</sup>)</span>');
                $('#cart_price').val(cost_sale);
                $('#cart_quantity').val(kvm);
                $('#cart_stock').val(stock);
                $('#cart_single').val(price);
                $('#cart_pack').val(pack_price);
                // if (cost_sale == cost)
                //      $('#cost_sale').val('');
                // else $('#cost_sale').val(cost_sale);
            }else {$('#cart_price').val('');}
        }
    });
</script>
<script type="text/javascript">
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
</script>
<div class="container">

  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $content_class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $content_class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $content_class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $content_class; ?>"><?php echo $content_top; ?>
      <div class="row">
        <div class="col-sm-12">
        <?php include DIR_APPLICATION . '/view/theme/default/template/_breadcrumb.tpl'; ?>
        </div>

          <?php if ((!$column_left && !$column_right) && $thumb && $images) { //покажем доп.фото сбоку, если нет боковых колонок ?>

            <?php if ($thumb || $images) { ?>
              <div class="col-lg-1 col-sm-2 hidden-xs images-overflow">
                  <div style="max-height: <?php echo $thumb_height; ?>px;">
                  <ul class="thumbnails">
                      <?php if ($thumb) { ?>
                          <li class="image-additional"><a class="thumbnail gallery-item"
                                 data-src="<?php echo $thumb; ?>"
                                 href="<?php echo $popup; ?>"
                                 title="<?php echo $heading_title; ?>">
                                  <img class="lazy" data-src="<?php echo $small_thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                              </a></li>
                      <?php } ?>
                      <?php if ($images) { ?>
                          <?php foreach ($images as $image) { ?>
                              <li class="image-additional"><a class="thumbnail gallery-item"
                                                              data-src="<?php echo $image['src']; ?>"
                                                              href="<?php echo $image['popup']; ?>"
                                                              title="<?php echo $heading_title; ?>">
                                      <img class="lazy" data-src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                                  </a></li>
                          <?php } ?>
                      <?php } ?>
                  </ul>
                  </div>
              </div>

              <div class="col-lg-6 col-sm-5 col-xs-12">
                  <ul class="thumbnails">
                    <?php if ($thumb) { ?>
                    <li><a class="thumbnail" id="main-image" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img class="lazy" data-src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
                    <?php } ?>
                  </ul>
              </div>
            <?php } ?>

          <?php } else { //в противном случае, доп.фото снизу ?>

              <?php if ($thumb || $images) { ?>
                  <div class="col-sm-7">
                      <?php if ($thumb || $images) { ?>
                          <ul class="thumbnails">
                              <?php if ($thumb) { ?>
                                  <li><a class="thumbnail" id="main-image" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img class="lazy" data-src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
                              <?php } ?>
                              <?php if ($images) { ?>
                                  <?php if ($thumb) { ?>
                                      <li class="image-additional"><a class="thumbnail gallery-item"
                                                                      href="<?php echo $popup; ?>"
                                                                      data-src="<?php echo $thumb; ?>"
                                                                      title="<?php echo $heading_title; ?>">
                                              <img class="lazy" data-src="<?php echo $small_thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                                          </a></li>
                                  <?php } ?>
                                  <?php if ($images) { ?>
                                      <?php foreach ($images as $image) { ?>
                                          <li class="image-additional"><a class="thumbnail gallery-item"
                                                                          data-src="<?php echo $image['src']; ?>"
                                                                          href="<?php echo $image['popup']; ?>"
                                                                          title="<?php echo $heading_title; ?>">
                                                  <img class="lazy" data-src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                                              </a></li>
                                      <?php } ?>
                                  <?php } ?>
                              <?php } ?>
                          </ul>
                      <?php } ?>
                  </div>
              <?php } ?>
          <?php } ?>

        <?php if ($thumb || $images) { ?>
        <?php $class = 'col-sm-5 col-xs-12'; ?>
        <?php } else { ?>
        <?php $class = 'col-lg-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?> product-info">

        <h1><?php echo $heading_title; ?></h1>
        <?php $group_atr = $attribute_groups[0]['attribute']; ?>
        <?php foreach($group_atr as $attribute){
                    if($attribute['attribute_id'] == '28')
                    {
                        $pack_price = $attribute['text'];
                        break;
                    }
                } ?>
          <?php if ($price) { ?>
          <ul class="list-unstyled">
            <?php if (!$special) { ?>
            <li>
              <span class="price"><?php echo $price; ?></span>
                <?php if(strpos($pack_price, 'м2') !== false){ ?>
                    <span class="price">\м2</span>
                <?php } ?>
            </li>
            <?php } else { ?>
            <li><span class="price"><?php echo $special; ?></span> <span class="price price-old"><?php echo $price; ?></span>
                <?php if(strpos($pack_price, 'м2') !== false){ ?>
                    <span class="price">\м2</span>
                <?php } ?>
            </li>
            <?php } ?>
            <?php if ($points) { ?>
            <li><?php echo $text_points; ?> <?php echo $points; ?></li>
            <?php } ?>
            <?php if ($discounts) { ?>
            <li>
              <hr>
            </li>
            <?php foreach ($discounts as $discount) { ?>
            <li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
                <?php $group_atr = $attribute_groups[0]['attribute']; ?>
                <?php foreach($group_atr as $attribute){
                        if($attribute['attribute_id'] == '28')
                        {
                            $pack_price = $attribute['text'];
                            break;
                        }
                    } ?>
                <?php if(strpos($pack_price, 'м2') !== false){ ?>
                    <div class="row">
                        <div class="stock">
                            <div class="stock__head">
                                <label>
                                    <div class="input-description">
                                        <p>Необходимая площадь, м<sup>2</sup>:</p>
                                    </div>
                                    <input type="number" id="kvm" class="form-control" placeholder="1" value="1">
                                </label>
                            </div>
                            <form action="" class="stock__filter">
                                <label class="radio_c">
                                    <input type="radio" name="stock" value="1" class="hidden" checked>
                                    <span class="radio_c-btn"></span>
                                    <span class="radio_c-text">Без запаса 0%</span>
                                </label>
                                <label class="radio_c">
                                    <input type="radio" name="stock" value="1.05" class="hidden">
                                    <span class="radio_c-btn"></span>
                                    <span class="radio_c-text">Запас 5%</span>
                                </label>
                                <label class="radio_c">
                                    <input type="radio" name="stock" value="1.07" class="hidden">
                                    <span class="radio_c-btn"></span>
                                    <span class="radio_c-text">Запас 7%</span>
                                </label>
                                <label class="radio_c">
                                    <input type="radio" name="stock" value="1.1" class="hidden">
                                    <span class="radio_c-btn"></span>
                                    <span class="radio_c-text">Запас 10%</span>
                                </label>
                            </form>
                            <div class="stock__footer">
                                <div class="price-box">
                                    <strong class="price">0 грн</strong>
                                    <span id="calc_sale" class="sale">скидка 0%</span>
                                </div>
                                <div id="result" class="result">
                                    <span>
                                        <p>Потребуется:</p>
                                        0 пачек (0м<sup>2</sup>)
                                    </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="price" value="<?php if($special) echo str_replace('грн', '', $special); else echo str_replace('грн', '', $price); ?>">
                        <input type="hidden" id="pack_price" value="<?php $pack_price = str_replace('м2', '', $pack_price);  echo str_replace(',', '.', $pack_price); ?>">
                    </div>
                <?php } ?>
            <ul class="list-unstyled">
                <?php if ($manufacturer) { ?>
                    <li><?php echo $text_manufacturer; ?> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
                <?php } ?>
                <li><?php echo $text_model; ?> <?php echo $model; ?></li>
                <?php if ($reward) { ?>
                    <li><?php echo $text_reward; ?> <?php echo $reward; ?></li>
                <?php } ?>
                <li><?php echo $text_stock; ?> <?php echo $stock; ?></li>
            </ul>
		<?php if ($cheaper_ssp == 1) { ?>
		<div class="cheaper">
			<a href="index.php?route=extension/module/cheaper/cheaperform&product_id=<?php echo $product_id; ?>" class="colorbox openquick" data-rel="colorbox"><i class="fa fa-phone"></i> <span><?php echo $text_cheaper; ?></span></a>
		</div>
		<?php } ?>
          <div id="product">
            <?php if ($options) { ?>
            <hr>
            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'image') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <img data-src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="lazy img-thumbnail" /> <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <div class="form-group">
                <?php /*
                <div class="row">
                    <div class="col-lg-5">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" data-value="decrease" data-target="#input-quantity" data-toggle="spinner">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="text" name="quantity" data-ride="spinner" id="input-quantity" class="form-control input-number" value="<?php echo $minimum; ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" data-value="increase" data-target="#input-quantity" data-toggle="spinner">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                        <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>
                    </div>
                </div>
                */ ?>
                <input type="hidden" name="cart_price" id="cart_price" value="" />
                <input type="hidden" name="cart_quantity" id="cart_quantity" value="" />
                <input type="hidden" name="cart_single" id="cart_single" value="" />
                <input type="hidden" name="cart_stock" id="cart_stock" value="" />
                <input type="hidden" name="cart_pack" id="cart_pack" value="" />
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>
                <br>
                <div class="wish-compare text-muted">
                    <span id="fav-cart" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><i class="fa fa-heart-o"></i> <?php echo $button_wishlist; ?></span>
                    <span data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><i class="fa fa-bars"></i> <?php echo $button_compare; ?></span>
                </div>
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>

          </div>

          <?php if ($review_status) { ?>
          <div class="rating">
            <p>
              <?php for ($i = 1; $i <= 5; $i++) { ?>
              <?php if ($rating < $i) { ?>
              <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
              <?php } else { ?>
              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
              <?php } ?>
              <?php } ?>
              <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a> / <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $text_write; ?></a></p>
          </div>
          <?php } ?>
            <?php if ($fastorder) { ?>
            <div class="click-to-order">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="(0XX) XXX XX XX" id="phone" name="cto_telephone">
                      <span class="input-group-btn">
                        <button id="click-to-order" class="btn btn-secondary" type="button">Заказ в 1 клик!</button>
                      </span>
                </div>
            </div>
            <?php } ?>
        </div>
      </div>
        <div class="row product-tabs">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-description" data-toggle="tab"><?php echo $tab_description; ?></a></li>
                <?php if ($attribute_groups) { ?>
                    <li><a href="#tab-specification" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
                <?php } ?>
                <?php if ($review_status) { ?>
                    <li><a href="#tab-review" data-toggle="tab"><?php echo $tab_review; ?></a></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-description"><?php echo str_replace('src', 'class="lazy" data-src', $description); ?></div>
                <?php if ($attribute_groups) { ?>
                    <div class="tab-pane" id="tab-specification">
                        <table class="table table-bordered">
                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <thead>
                                <tr>
                                    <td colspan="2"><strong><?php echo $attribute_group['name']; ?></strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                    <tr>
                                        <td><?php echo $attribute['name']; ?></td>
                                        <td><?php echo $attribute['text']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
                <?php if ($review_status) { ?>
                    <div class="tab-pane" id="tab-review">
                        <form class="form-horizontal" id="form-review">
                            <div id="review"></div>
                            <div class="h2"><?php echo $text_write; ?></div>
                            <?php if ($review_guest) { ?>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                        <input type="text" name="name" value="" id="input-name" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-review"><?php echo $entry_review; ?></label>
                                        <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                        <div class="help-block"><?php echo $text_note; ?></div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label"><?php echo $entry_rating; ?></label>
                                        &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                                        <input type="radio" name="rating" value="1" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="2" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="3" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="4" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="5" />
                                        &nbsp;<?php echo $entry_good; ?></div>
                                </div>
                                <?php //echo $captcha; ?>
                                <div class="buttons clearfix">
                                    <div class="pull-right">
                                        <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_continue; ?></button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <?php echo $text_login; ?>
                            <?php } ?>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>

      <?php if ($products) { ?>
          <br>
          <br>
      <div class="box-heading"><?php echo $text_related; ?></div>
          <?php $i = 0; ?>

              <?php if ($column_left && $column_right) { ?>
                  <?php $class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12'; ?>
              <?php } elseif ($column_left || $column_right) { ?>
                  <?php $class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12'; ?>
              <?php } else { ?>
                  <?php $class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; ?>
              <?php } ?>
              <?php include DIR_APPLICATION . '/view/theme/default/template/extension/module/_module_default.tpl'; ?>
      <?php } ?>
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<script type="text/javascript"><!--
domReady(function(){
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
        data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

            if (json['success']) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('#cart > .mini-cart').html('<span id="cart-total"> ' + json['total'] + '</span>');
                }, 100);

                $('#cart-modal > .modal-dialog').load('index.php?route=common/cart/info .modal-content');
                $('#cart-modal').modal();
            }
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});

<?php if ($fastorder) { ?>
$('#click-to-order').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/clickToOrder',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea, input[name=\'cto_telephone\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#click-to-order').button('loading');
		},
		complete: function() {
			$('#click-to-order').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				if (json['error']['cto_telephone']) {
					$('.click-to-order .input-group').after('<div class="text-danger">' + json['error']['cto_telephone'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			} else {
                location = json['success_link'];
            }

		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
<?php } ?>
<?php if ($timepicker_status) { ?>
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});
<?php } ?>

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});

$(document).ready(function() {
    <?php if ($images) { ?>

        $('.image-additional:first').addClass('active');

        $('.image-additional a').on('mouseover', function(){
            var s = $(this).data('src');
            var h = $(this).attr('href');
            $(this).parent('li').addClass('active');
            $(this).parent('li').siblings().removeClass('active');

            $('#main-image').attr('href', h);
            $('#main-image img').attr('src', s);
        });

        $('#main-image').on('click', function(){
            $('.image-additional.active a').click();
            return false;
        });

        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a.gallery-item',
            gallery: {
                enabled:true
            }
        });

        $('.images-overflow').perfectScrollbar();

        <?php } else { ?>
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    <?php } ?>
});
});
//--></script>
<?php
$data_price = str_replace(' грн', '' , $price);
$micro_rew = '';
foreach ($data_rew as $k => $rew)
{
    if ($k+1 == count($data_rew)){
        $micro_rew .= '{
        "@type": "Review",
        "author": "'.$rew['author'].'",
        "datePublished": "'.$rew['date_added'].'",
        "description": "'.$rew['text'].'",
        "name": "",
        "reviewRating": {
        "@type": "Rating",
        "bestRating": "5",
        "ratingValue": "'.$rew['rating'].'",
        "worstRating": "1"
        }
        }';
    }else{
        $micro_rew .= '{
        "@type": "Review",
        "author": "'.$rew['author'].'",
        "datePublished": "'.$rew['date_added'].'",
        "description": "'.$rew['text'].'",
        "name": "",
        "reviewRating": {
        "@type": "Rating",
        "bestRating": "5",
        "ratingValue": "'.$rew['rating'].'",
        "worstRating": "1"
        }
        },';
    }
}
$aggregateRating = '';
if(count($data_rew) > 0 ){
    $aggregateRating = '"aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "'.$rating.'",
    "reviewCount": "'.count($data_rew).'"
    },';
}
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Product",
        "brand": "<?= $manufacturer ?>",
        "sku": "<?= $model ?>",
        <?= $aggregateRating ?>
        "description": "<?= $schema_description ?>",
        "name": "<?= $heading_title ?>",
        "image": "<?= $thumb ?>",
        "offers": {
            "@type": "Offer",
            "availability": "http://schema.org/InStock",
            "url": "<?= $url ?>",
            "price": "<?= $data_price ?>",
            "priceCurrency": "UAH"
        },
        "review": [
            <?= $micro_rew ?>
        ]
    }
</script>
<?php echo $footer; ?>
