<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

if ( visualcomposerstarter_is_the_footer_displayed() ) : ?>
	<?php visualcomposerstarter_hook_before_footer(); ?>
	<section id="footer" class="section pb-4">
	    <div class="container">
	      <div class="row">
	        <div class="col-12 col-md-6 col-lg-3 col-xl-3 mb-4 mb-md-0">
	          <p>
	            <a href="#">
	                <img src="/wp-content/themes/visual-composer-starter/img/logo-footer.png" alt="logo" data-rjs="2">
	            </a>
	          </p>
	          <p class="slogan">FutureTech and Blockchain</p>
	        </div>
	        <div class="col-sm-7 col-lg-2 col-xl-3 mb-4 mb-md-0">
	          <h4>Menu</h4>
				<?php wp_nav_menu(array('menu_class' => 'row' )); ?>
	        </div>
	        <div class="col-sm-5 col-lg-4 col-xl-3 mb-4 mb-md-0">
	          <h4>Contacts</h4>
	          <ul>
	            <li>info@katalystafrica.com</li>
	            <li>2035, Sunset Lake Road, Newark, USA</li>
	          </ul>
	        </div>
	        <div class="col-md-6 col-lg-3 col-xl-3">
	          <h4>Subscribe</h4>
				<?= do_shortcode("[fc id='2'][/fc]") ?>
				<div class="dev-n">development and maintenance by <a href="https://easystudio.com.ua" target="_blank">EasyStudio</div>
	        </div>
	      </div>
	    </div>
	  </section>
	<?php visualcomposerstarter_hook_after_footer(); ?>
<?php endif; ?>
<?php wp_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#footer .menu-main-menu-container li').addClass('col-6 col-md-4 col-lg-12 col-xl-6');
		$('.myAnimate').append("<div id='animationBlock'><div class='triangle-1'></div><div class='triangle-2'></div><div class='triangle-3'></div><div class='triangle-4'></div><div class='triangle-5'></div></div>");
	})
</script>

</body>
</html>