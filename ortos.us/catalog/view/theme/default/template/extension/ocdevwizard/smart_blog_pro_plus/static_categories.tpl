<div class="" id="<?php echo $_code; ?>-categories-block-<?php echo $module_id; ?>">
  <!--
  ##==================================================================##
  ## @author    : OCdevWizard                                         ##
  ## @contact   : ocdevwizard@gmail.com                               ##
  ## @support   : http://help.ocdevwizard.com                         ##
  ## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
  ## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
  ##==================================================================##
  -->
 
  <div class="list_kat">
    <?php if ($results) { ?>
      <?php foreach ($results as $result) { ?>
        <?php if ($result['category_id'] == $category_id) { ?>
          <a href="<?php echo $result['href']; ?>" class="<?php echo $_code; ?> active"><?php if ($show_main_image) { ?><img src="<?php echo $result['image']; ?>" class="img-responsive"/><?php } ?><?php echo $result['name']; ?></a>
          <?php if ($result['children']) { ?>
            <?php foreach ($result['children'] as $child_2lv) { ?>
              <?php if ($child_2lv['category_id'] == $child_id) { ?>
                <a href="<?php echo $child_2lv['href']; ?>" class="<?php echo $_code; ?> active">&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_2lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_2lv['name']; ?></a>
                <?php if ($child_2lv['children']) { ?>
                  <?php foreach ($child_2lv['children'] as $child_3lv) { ?>
                    <?php if ($child_3lv['category_id'] == $child_2lv_id) { ?>
                      <a href="<?php echo $child_3lv['href']; ?>" class="<?php echo $_code; ?> active">&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_3lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_3lv['name']; ?></a>
                      <?php if ($child_3lv['children']) { ?>
                        <?php foreach ($child_3lv['children'] as $child_4lv) { ?>
                          <?php if ($child_4lv['category_id'] == $child_3lv_id) { ?>
                            <a href="<?php echo $child_4lv['href']; ?>" class="<?php echo $_code; ?> active">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_4lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_4lv['name']; ?></a>
                            <?php if ($child_4lv['children']) { ?>
                              <?php foreach ($child_4lv['children'] as $child_5lv) { ?>
                                <?php if ($child_5lv['category_id'] == $child_4lv_id) { ?>
                                  <a href="<?php echo $child_5lv['href']; ?>" class="<?php echo $_code; ?> active">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_5lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_5lv['name']; ?></a>
                                <?php } else { ?>
                                  <a href="<?php echo $child_5lv['href']; ?>" class="<?php echo $_code; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_5lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_5lv['name']; ?></a>
                                <?php } ?>
                              <?php } ?>
                            <?php } ?>
                          <?php } else { ?>
                            <a href="<?php echo $child_4lv['href']; ?>" class="<?php echo $_code; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_4lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_4lv['name']; ?></a>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    <?php } else { ?>
                      <a href="<?php echo $child_3lv['href']; ?>" class="<?php echo $_code; ?>">&nbsp;&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_3lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_3lv['name']; ?></a>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              <?php } else { ?>
                <a href="<?php echo $child_2lv['href']; ?>" class="<?php echo $_code; ?>">&nbsp;&nbsp;&nbsp;- <?php if ($show_main_image) { ?><img src="<?php echo $child_2lv['image']; ?>" class="img-responsive"/><?php } ?><?php echo $child_2lv['name']; ?></a>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } else { ?>
          <a href="<?php echo $result['href']; ?>" class="<?php echo $_code; ?>"><?php if ($show_main_image) { ?><img src="<?php echo $result['image']; ?>" class="img-responsive"/><?php } ?><?php echo $result['name']; ?></a>
        <?php } ?>
      <?php } ?>
    <?php } ?>
  </div>
</div>
<script type="text/javascript">
  $('#<?php echo $_code; ?>-categories-block-<?php echo $module_id; ?> .list-group .<?php echo $_code; ?>.active').last().addClass('current-item');
</script>