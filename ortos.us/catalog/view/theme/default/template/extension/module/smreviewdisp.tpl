<div class="list-group">
  <p style="background-color: #00aaaa; height: 3px;">&nbsp</p>
  <?php if($smreviewdisp_title and trim($smreviewdisp_title) != ''){ ?>
  <h2><?=$smreviewdisp_title?></h2>
  <?php } ?>
  <p style="background-color: #00aaaa; height: 3px;">&nbsp</p>
  <?php if($smreviews != array() and $smreviews != ''){ ?>
  <?php if($smreviewdisp_view == 'list'){ ?>
    <?php foreach($smreviews as $smreview){ ?>
    <div>
      <a href="index.php?route=product/product&product_id=<?php echo $smreview['product_id']; ?>" class="review_link">
        <h3><?php echo $smreview['author']; ?></h3>
        <p><?php echo $smreview['text']; ?></p>
        <?php if($smreviewdisp_date == 1){ ?>
          <p><?php echo $smreview['date_added']; ?></p>
        <?php } ?>
      </a>
    </div>
  <?php } ?>
  <?php }
  elseif($smreviewdisp_view == 'table'){ ?>
  <table class="smreview_table">
    <tr>
      <th><?=$text_author ?></th>
      <th><?=$text_text ?></th>
      <?php if($smreviewdisp_date == 1){ ?>
        <th><?=$text_date ?></th>
      <?php } ?>
    </tr>
  <?php foreach($smreviews as $smreview){ ?>
    <tr>
    <a href="index.php?route=product/product&product_id=<?php echo $smreview['product_id']; ?>" class="review_link">
      <td><h4><b><?php echo $smreview['author']; ?></b></h4></td>
      <td><?php echo $smreview['text']; ?></td>
      <?php if($smreviewdisp_date == 1){ ?>
      <td><?php echo $smreview['date_added']; ?></td>
      <?php } ?>
    </a>
    </tr>
  <?php } ?>
  </table>
  <?php }
  elseif($smreviewdisp_view == 'carousel'){ ?>
  <div id="carousel_smreviewdisp" class="owl-carousel">
    <?php foreach($smreviews as $smreview){ ?>
    <div class="item text-center">
      <div>
        <a href="index.php?route=product/product&product_id=<?php echo $smreview['product_id']; ?>" class="review_link">
          <h3><?php echo $smreview['author']; ?></h3>
          <p><?php echo $smreview['text']; ?></p>
          <?php if($smreviewdisp_date == 1){ ?>
          <p><?php echo $smreview['date_added']; ?></p>
          <?php } ?>
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
  <script type="text/javascript"><!--
      $('#carousel_smreviewdisp').owlCarousel({
          items: 6,
          autoPlay: 3000,
          navigation: true,
          navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
          pagination: true
      });
      --></script>
  <?php } ?>
  <?php } ?>
</div>
<style>
  .review_link{
    border: none!important;
    padding: 0!important;
  }
  .smreview_table tr th{
    border: 1px solid #a2a2a2;
  }
  .smreview_table tr td, .smreview_table tr th{
    padding: 10px;
  }
</style>
