 
  <!--
  ##==================================================================##
  ## @author    : OCdevWizard                                         ##
  ## @contact   : ocdevwizard@gmail.com                               ##
  ## @support   : http://help.ocdevwizard.com                         ##
  ## @license   : http://license.ocdevwizard.com/Licensing_Policy.pdf ##
  ## @copyright : (c) OCdevWizard. Smart Blog Pro Plus, 2019          ##
  ##==================================================================##
  -->
  
    <div class="tags">
      <?php if ($results) { ?>
      <?php foreach ($results as $result) { ?>
      <a href="<?php echo $result['href']; ?>"><?php echo $result['name']; ?></a>
      <?php } ?>
      <?php } ?>
    </div>
 