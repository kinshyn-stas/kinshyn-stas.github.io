<?php
/**
 * Header
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>

    <head>
        <?php visualcomposerstarter_hook_after_head(); ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head() ?>
    </head>

    <body <?php body_class(); ?>>
        <?php if ( visualcomposerstarter_is_the_header_displayed() ) : ?>
        <?php visualcomposerstarter_hook_before_header(); ?>
        <header id="header">
            <div class="container">
               <nav class="navbar navbar-expand-lg">
				  <?php the_custom_logo(); ?>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => 'ul',
							'menu_class'      => 'navbar-nav',
						) );
					?>
				  </div>
				</nav>
            </div>
        </header>
        <?php visualcomposerstarter_hook_after_header(); ?>
        <?php endif;