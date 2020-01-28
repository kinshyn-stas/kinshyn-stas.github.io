<div id="cart" class="hidden-xs">
  <span class="mini-cart pull-right" data-target="#cart-modal" data-toggle="modal" data-loading-text="<?php echo $text_loading; ?>"><span id="cart-total"><?php echo $text_items; ?></span></span>
</div>

<div id="cart-modal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span class="h4 modal-title"><?php echo $text_popup_cart; ?></span>
            </div>
            <div class="modal-body">
                <?php if ($products || $vouchers) { ?>
                    <?php foreach ($products as $product) { ?>
                    <div class="row">
                        <div class="col-sm-2 col-xs-4">
                            <button type="button" class="close pull-left" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" >&times;</button>
                            <?php if ($product['thumb']) { ?>
                                <a class="pull-right" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
                            <?php } ?>
                        </div>
                        <div class="col-sm-5 col-xs-8 product-name">
                            <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                <br/>
                                <small><?php echo $product['model']; ?></small>
                            <?php if ($product['reward']) { ?>
                                <br />
                                <small><?php echo $product['reward']; ?></small>
                            <?php } ?>
                            <?php if ($product['option']) { ?>
                                <?php foreach ($product['option'] as $option) { ?>
                                    <br />
                                    - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($product['recurring']) { ?>
                                <br />
                                - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="col-sm-3 col-xs-8 product-count">
                            <div class="input-group inc-dec">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" onclick="cart.liveupdate('<?php echo $product['cart_id']; ?>', parseInt($('#input-quantity-<?php echo $product['cart_id']; ?>').val())-1);">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                                <input type="text" name="quantity" id="input-quantity-<?php echo $product['cart_id']; ?>" class="form-control input-number" value="<?php echo $product['quantity']; ?>"  onchange="cart.liveupdate('<?php echo $product['cart_id']; ?>', parseInt($(this).val()));">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" onclick="cart.liveupdate('<?php echo $product['cart_id']; ?>', parseInt($('#input-quantity-<?php echo $product['cart_id']; ?>').val())+1);">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span>
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-8 product-total"><?php echo $product['total']; ?></div>
                    </div>
                    <?php } ?>
                    <?php if ($vouchers) { ?>
                        <table  class="table table-hover">
                            <?php foreach ($vouchers as $voucher) { ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-left"><?php echo $voucher['description']; ?></td>
                                    <td class="text-right">x&nbsp;1</td>
                                    <td class="text-right"><?php echo $voucher['amount']; ?></td>
                                    <td class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } ?>
                    <div>
                        <table class="table totals">
                            <?php foreach ($totals as $total) { ?>
                                <tr>
                                    <td class="text-right"><strong><?php echo $total['title']; ?></strong>: <?php echo $total['text']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="empty text-center">
                        <i class="fa fa-shopping-cart"></i><br>
                        <?php echo $text_empty; ?>
                    </div>
                <?php } ?>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-dashed pull-left hidden-550" data-dismiss="modal"><?php echo $text_continue; ?></button>
                 <?php if ($products || $vouchers) { ?>
                <a class="btn btn-primary  btn-lg pull-right" href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
                 <?php } ?>
            </div>
        </div>
    </div>

</div>

