<style>
#top #form-currency .currency-select:hover, #top #form-language .language-select:hover {
	background: none;
	cursor: pointer;
}
</style>
<?php if (count($languages) > 1) { ?>
 
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
   
    <?php foreach ($languages as $language) { ?>
      <a class="language-select" name="<?php echo $language['code']; ?>">
          <?php echo $language['name']; ?>
      </a>
	  <?php } ?>
 
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
 
<?php } ?>
