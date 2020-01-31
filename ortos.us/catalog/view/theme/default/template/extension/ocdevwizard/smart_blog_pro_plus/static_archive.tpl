<div class="panel panel-default" id="<?php echo $_code; ?>-archive-block-<?php echo $module_id; ?>">
  <!--
  ##==================================================================##
  ## @author    : OCdevWizard                                         ##
  ## @contact   : ocdevwizard@gmail.com                               ##
  ## @support   : http://help.ocdevwizard.com                         ##
  ## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
  ## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
  ##==================================================================##
  -->
  <div class="panel-heading"><i class="fa fa-archive" aria-hidden="true"></i> <?php echo $heading_title; ?></div>
  <div class="list-group">
    <?php if ($results) { ?>
    <?php foreach ($results as $result) { ?>
    <a href="<?php echo $result['href']; ?>" class="list-group-item"><?php echo $result['name']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
</div>