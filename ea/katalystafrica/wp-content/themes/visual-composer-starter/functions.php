<?php
/**
 * Functions
 *
 * @package WordPress
 * @subpackage Visual Composer Starter
 * @since Visual Composer Starter 1.0
 */

define( 'VISUALCOMPOSERSTARTER_VERSION', '1.3' );

if ( ! function_exists( 'visualcomposerstarter_setup' ) ) :
	/**
	 * Theme setup
	 */
	function visualcomposerstarter_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'visual-composer-starter', get_template_directory() . '/languages' );

		/*
		 * Define sidebars
		 */
		define( 'VISUALCOMPOSERSTARTER_PAGE_SIDEBAR',                     'vct_overall_site_page_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_POST_SIDEBAR',                     'vct_overall_site_post_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_ARCHIVE_AND_CATEGORY_SIDEBAR',     'vct_overall_site_aac_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_DISABLE_HEADER',                   'vct_overall_site_disable_header' );
		define( 'VISUALCOMPOSERSTARTER_DISABLE_FOOTER',                   'vct_overall_site_disable_footer' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable custom logo
		 */
		add_theme_support( 'custom-logo' );

		/*
		 * Enable custom background
		 */
		add_theme_support( 'custom-background', array(
				'default-color' => '#ffffff',
			) );

		visualcomposerstarter_set_old_styles();

		/*
		 * Feed Links
		 */
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array( 'gallery', 'video', 'image' ) );

		add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		if ( get_theme_mod( 'vct_overall_site_featured_image', true ) === true ) {
			add_theme_support( 'post-thumbnails' );
		}

		add_image_size( 'visualcomposerstarter-featured-loop-image', 848, 0 );
		add_image_size( 'visualcomposerstarter-featured-loop-image-full', 1140, 0 );
		add_image_size( 'visualcomposerstarter-featured-single-image-boxed', 1170, 0 );
		add_image_size( 'visualcomposerstarter-featured-single-image-full', 1920, 0 );

		/*
		 * Set the default content width.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 848;
		}

		/*
		 * This theme uses wp_nav_menu() in two locations.
		 */
		register_nav_menus( array(
			'primary'       => esc_html__( 'Primary Menu', 'visual-composer-starter' ),
			'secondary'     => esc_html__( 'Footer Menu', 'visual-composer-starter' ),
		) );

		/*
		 * Comment reply
		 */
		add_action( 'comment_form_before', 'visualcomposerstarter_enqueue_comments_reply' );

		/*
		 * ACF Integration
		 */

		if ( class_exists( 'acf' ) && function_exists( 'register_field_group' ) ) {
			$vct_acf_page_options = array(
				'id' => 'acf_page-options',
				'title' => esc_html__( 'Page Options', 'visual-composer-starter' ),
				'fields' => array(
					array(
						'key' => 'field_589f5a321f0bc',
						'label' => esc_html__( 'Sidebar Position', 'visual-composer-starter' ),
						'name' => 'sidebar_position',
						'type' => 'select',
						'instructions' => esc_html__( 'Select specific sidebar position.', 'visual-composer-starter' ),
						'choices' => array(
							'none' => esc_html__( 'None', 'visual-composer-starter' ),
							'left' => esc_html__( 'Left', 'visual-composer-starter' ),
							'right' => esc_html__( 'Right', 'visual-composer-starter' ),
						),
						'default_value' => get_theme_mod( VISUALCOMPOSERSTARTER_PAGE_SIDEBAR, 'none' ),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array(
						'key' => 'field_589f55db2faa9',
						'label' => esc_html__( 'Hide Page Title', 'visual-composer-starter' ),
						'name' => 'hide_page_title',
						'type' => 'checkbox',
						'choices' => array(
							1 => esc_html__( 'Yes', 'visual-composer-starter' ),
						),
						'default_value' => '',
						'layout' => 'vertical',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'page',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position' => 'side',
					'layout' => 'default',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			);

			$vct_acf_post_options = array(
				'id' => 'acf_post-options',
				'title' => esc_html__( 'Post Options', 'visual-composer-starter' ),
				'fields' => array(
					array(
						'key' => 'field_589f5b1d656ca',
						'label' => esc_html__( 'Sidebar Position', 'visual-composer-starter' ),
						'name' => 'sidebar_position',
						'type' => 'select',
						'instructions' => esc_html__( 'Select specific sidebar position.', 'visual-composer-starter' ),
						'choices' => array(
							'none' => esc_html__( 'None', 'visual-composer-starter' ),
							'left' => esc_html__( 'Left', 'visual-composer-starter' ),
							'right' => esc_html__( 'Right', 'visual-composer-starter' ),
						),
						'default_value' => get_theme_mod( VISUALCOMPOSERSTARTER_POST_SIDEBAR, 'none' ),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array(
						'key' => 'field_589f5b9a56207',
						'label' => esc_html__( 'Hide Post Title', 'visual-composer-starter' ),
						'name' => 'hide_page_title',
						'type' => 'checkbox',
						'choices' => array(
							1 => esc_html__( 'Yes', 'visual-composer-starter' ),
						),
						'default_value' => '',
						'layout' => 'vertical',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position' => 'side',
					'layout' => 'default',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			);

			if ( ! get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_HEADER, false ) ) {
				$vct_acf_page_options['fields'][] = array(
					'key' => 'field_58c800e5a7722',
					'label' => 'Disable Header',
					'name' => 'disable_page_header',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'visual-composer-starter' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);

				$vct_acf_post_options['fields'][] = array(
					'key' => 'field_58c7e3f0b7dfb',
					'label' => 'Disable Header',
					'name' => 'disable_post_header',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'visual-composer-starter' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);
			}

			if ( ! get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_FOOTER, false ) ) {
				$vct_acf_page_options['fields'][] = array(
					'key' => 'field_58c800faa7723',
					'label' => 'Disable Footer',
					'name' => 'disable_page_footer',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'visual-composer-starter' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);

				$vct_acf_post_options['fields'][] = array(
					'key' => 'field_58c7e40db7dfc',
					'label' => 'Disable Footer',
					'name' => 'disable_post_footer',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'visual-composer-starter' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);
			}
			register_field_group( $vct_acf_page_options );
			register_field_group( $vct_acf_post_options );
		} // End if().

		/**
		 * Customizer settings.
		 */
		require get_template_directory() . '/inc/customizer/class-visualcomposerstarter-fonts.php';
		require get_template_directory() . '/inc/customizer/class-visualcomposerstarter-customizer.php';
		require get_template_directory() . '/inc/hooks.php';
		new VisualComposerStarter_Fonts();
		new VisualComposerStarter_Customizer();

	}
endif; /* visualcomposerstarter_setup */

add_action( 'after_setup_theme', 'visualcomposerstarter_setup' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/*
 * Add Next Page Button to WYSIWYG editor
 */

add_filter( 'mce_buttons', 'visualcomposerstarter_page_break' );

/**
 * Add page break
 *
 * @param VisualComposerStarter_Customizer $mce_buttons Add page break.
 *
 * @return array
 */
function visualcomposerstarter_page_break( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );

	if ( false !== $pos ) {
		$buttons = array_slice( $mce_buttons, 0, $pos );
		$buttons[] = 'wp_page';
		$mce_buttons = array_merge( $buttons, array_slice( $mce_buttons, $pos ) );
	}

	return $mce_buttons;
}

/**
 * Enqueues styles.
 *
 * @since Visual Composer Starter 1.0
 */
function visualcomposerstarter_style() {

	/* Bootstrap stylesheet */
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	/* Fonts */
	wp_register_style( 'fonts', get_template_directory_uri() . '/fonts/fonts.css');

	/* Theme stylesheet */
	wp_register_style( 'visualcomposerstarter-style', get_stylesheet_uri() );

	/* Enqueue styles */
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'fonts' );
	wp_enqueue_style( 'visualcomposerstarter-style' );
}
add_action( 'wp_enqueue_scripts', 'visualcomposerstarter_style' );


/**
 * Enqueues scripts.
 *
 * @since Visual Composer Starter 1.0
 */
function visualcomposerstarter_script() {

	wp_register_script( 'bundle-js', get_template_directory_uri() . '/js/bootstrap/bundle.js', array( 'jquery' ), '4.1.3', true );
	wp_register_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'bundle-js' );
	wp_enqueue_script( 'main-js' );
}
add_action( 'wp_enqueue_scripts', 'visualcomposerstarter_script' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param Classes $classes Classes list.
 *
 * @return array
 */
function visualcomposerstarter_body_classes( $classes ) {
	/* Sandwich color */
	if ( get_theme_mod( 'vct_header_sandwich_style', '#333333' ) === '#FFFFFF' ) {
		$classes[] = 'sandwich-color-light';
	}

	/* Header Style */
	if ( get_theme_mod( 'vct_header_position', 'top' ) === 'sandwich' ) {
		$classes[] = 'menu-sandwich';
	}

	/* Menu position */
	if ( get_theme_mod( 'vct_header_sticky_header', false ) === true ) {
		$classes[] = 'fixed-header';
	}

	/* Navbar background */
	if ( get_theme_mod( 'vct_header_reserve_space_for_header', true ) === false ) {
		$classes[] = 'navbar-no-background';
	}

	/* Width of header-area */
	if ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width' ) {
		$classes[] = 'header-full-width';
	} elseif ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width_boxed' ) {
		$classes[] = 'header-full-width-boxed';
	}

	/* Width of content-area */
	if ( get_theme_mod( 'vct_content_area_size', 'boxed' ) === 'full_width' ) {
		$classes[] = 'content-full-width';
	}

	/* Height of featured image */
	if ( get_theme_mod( 'vct_overall_site_featured_image_height', 'auto' ) === 'full_height' ) {
		$classes[] = 'featured-image-full-height';
	}

	if ( get_theme_mod( 'vct_overall_site_featured_image_height', 'auto' ) === 'custom' ) {
		$classes[] = 'featured-image-custom-height';
	}

	if ( false === visualcomposerstarter_is_the_header_displayed() ) {
		$classes[] = 'header-area-disabled';
	}
	if ( false === visualcomposerstarter_is_the_footer_displayed() ) {
		$classes[] = 'footer-area-disabled';
	}

	return $classes;
}
add_filter( 'body_class', 'visualcomposerstarter_body_classes' );

/**
 *  Give linked images class
 *
 * @param string $html Html.
 * @since Visual Composer Starter 1.2
 * @return mixed
 */
function visualcomposerstarter_give_linked_images_class( $html ) {
	$classes = 'image-link'; // separated by spaces, e.g. 'img image-link'.

	$patterns = array();
	$replacements = array();

	// Matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes.
	$patterns[0] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
	$replacements[0] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

	// Matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes.
	$patterns[1] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
	$replacements[1] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

	// Matches img tag wrapped in anchor tag where anchor tag has no existing classes.
	$patterns[2] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
	$replacements[2] = '<a\1 class="' . $classes . '"><img\2></a>';

	$html = preg_replace( $patterns, $replacements, $html );

	return $html;
}
add_filter( 'the_content', 'visualcomposerstarter_give_linked_images_class' );

/**
 * Footer area 1.
 *
 * @return array
 */
function visualcomposerstarter_footer_1() {
	return array(
		'name' => esc_html__( 'Footer Widget Column 1', 'visual-composer-starter' ),
		'id' => 'footer',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'visual-composer-starter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h2>',
	);
}
/**
 * Footer area 2.
 *
 * @return array
 */
function visualcomposerstarter_footer_2() {
	return array(
		'name' => esc_html__( 'Footer Widget Column 2', 'visual-composer-starter' ),
		'id' => 'footer-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'visual-composer-starter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h2>',
	);
}
/**
 * Footer area 3.
 *
 * @return array
 */
function visualcomposerstarter_footer_3() {
	return array(
		'name' => esc_html__( 'Footer Widget Column 3', 'visual-composer-starter' ),
		'id' => 'footer-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'visual-composer-starter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h2>',
	);
}
/**
 * Footer area 4.
 *
 * @return array
 */
function visualcomposerstarter_footer_4() {
	return array(
		'name' => esc_html__( 'Footer Widget Column 4', 'visual-composer-starter' ),
		'id' => 'footer-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'visual-composer-starter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h2>',
	);
}

add_action( 'widgets_init',             'visualcomposerstarter_all_widgets' );
add_action( 'admin_bar_init',           'visualcomposerstarter_widgets' );

/**
 * All widgets.
 */
function visualcomposerstarter_all_widgets() {
	/**
	 * Register all zones for availability in customizer
	 */
	register_sidebar(
		visualcomposerstarter_footer_1()
	);
	register_sidebar(
		visualcomposerstarter_footer_2()
	);
	register_sidebar(
		visualcomposerstarter_footer_3()
	);
	register_sidebar(
		visualcomposerstarter_footer_4()
	);
}

/**
 * Widgets handler
 */
function visualcomposerstarter_widgets() {
	unregister_sidebar( 'footer' );
	unregister_sidebar( 'footer-2' );
	unregister_sidebar( 'footer-3' );
	unregister_sidebar( 'footer-4' );
	if ( get_theme_mod( 'vct_footer_area_widget_area', false ) ) {
		$footer_columns = intval( get_theme_mod( 'vct_footer_area_widgetized_columns', 1 ) );
		if ( $footer_columns >= 1 ) {
			register_sidebar(
				visualcomposerstarter_footer_1()
			);
		}

		if ( $footer_columns >= 2 ) {
			register_sidebar(
				visualcomposerstarter_footer_2()
			);
		}

		if ( $footer_columns >= 3 ) {
			register_sidebar(
				visualcomposerstarter_footer_3()
			);
		}
		if ( 4 === $footer_columns ) {
			register_sidebar(
				visualcomposerstarter_footer_4()
			);
		}
	}

}

/**
 * Is header displayed
 *
 * @return bool
 */
function visualcomposerstarter_is_the_header_displayed() {
	if ( get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_HEADER, false ) ) {
		return false;
	} elseif ( function_exists( 'get_field' ) ) {
		if ( is_page() ) {
			return ! get_field( 'field_58c800e5a7722' );
		} elseif ( is_singular() ) {
			return ! get_field( 'field_58c7e3f0b7dfb' );
		} else {
			return true;
		}
	} else {
		return true;
	}
}

/**
 * Is footer displayed.
 *
 * @return bool
 */
function visualcomposerstarter_is_the_footer_displayed() {
	if ( get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_FOOTER, false ) ) {
		return false;
	} elseif ( function_exists( 'get_field' ) ) {
		if ( is_page() ) {
			return ! get_field( 'field_58c800faa7723' );
		} elseif ( is_singular() ) {
			return ! get_field( 'field_58c7e40db7dfc' );
		} else {
			return true;
		}
	} else {
		return true;
	}
}

/**
 * Get header container class.
 *
 * @return string
 */
function visualcomposerstarter_get_header_container_class() {
	if ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width' ) {
		return 'container-fluid';
	} else {
		return 'container';
	}
}

/**
 * Get header image container class.
 *
 * @return string
 */
function visualcomposerstarter_get_header_image_container_class() {
	if ( get_theme_mod( 'vct_overall_site_featured_image_width', 'full_width' ) === 'full_width' ) {
		return 'container-fluid';
	} else {
		return 'container';
	}
}

/**
 * Get contant container class
 *
 * @return string
 */
function visualcomposerstarter_get_content_container_class() {
	if ( 'full_width' === get_theme_mod( 'vct_content_area_size', 'boxed' ) ) {
		return 'container-fluid';
	} else {
		return 'container';
	}
}

/**
 * Check needed sidebar
 *
 * @return string
 */
function visualcomposerstarter_check_needed_sidebar() {
	if ( is_page() ) {
		return VISUALCOMPOSERSTARTER_PAGE_SIDEBAR;
	} elseif ( is_singular() ) {
		return VISUALCOMPOSERSTARTER_POST_SIDEBAR;
	} elseif ( is_archive() || is_category() || is_search() || is_front_page() ) {
		return VISUALCOMPOSERSTARTER_ARCHIVE_AND_CATEGORY_SIDEBAR;
	} else {
		return 'none';
	}
}

/**
 * Specify sidebar
 *
 * @return null
 */
function visualcomposerstarter_specify_sidebar() {
	if ( is_page() ) {
		$value = function_exists( 'get_field' ) ? get_field( 'field_589f5a321f0bc' ) : null;
	} elseif ( is_singular() ) {
		$value = function_exists( 'get_field' ) ? get_field( 'field_589f5b1d656ca' ) : null;
	} else {
		$value = null;
	}

	$specify_setting = function_exists( 'get_field' ) ? $value : null;

	if ( $specify_setting ) {
		return $specify_setting;
	} else {
		return get_theme_mod( visualcomposerstarter_check_needed_sidebar(), 'none' );
	}
}

/**
 * Is the title displayed
 *
 * @return bool
 */
function visualcomposerstarter_is_the_title_displayed() {
	if ( function_exists( 'get_field' ) ) {
		if ( is_page() ) {
			return (bool) ! get_field( 'field_589f55db2faa9' );
		} elseif ( is_singular() ) {
			return (bool) ! get_field( 'field_589f5b9a56207' );
		} else {
			return true;
		}
	} else {
		return true;
	}
}

/**
 * Get main content block class
 *
 * @return string
 */
function visualcomposerstarter_get_maincontent_block_class() {
	switch ( visualcomposerstarter_specify_sidebar() ) {
		case 'none':
			return 'col-md-12';
		case 'left':
			return 'col-md-9 col-md-push-3';
		case 'right':
			return 'col-md-9';
		default:
			return 'col-md-12';
	}
}

/**
 * Get sidebar class
 *
 * @return bool|string
 */
function visualcomposerstarter_get_sidebar_class() {
	switch ( visualcomposerstarter_specify_sidebar() ) {
		case 'none':
			return false;
		case 'left':
			return 'col-md-3 col-md-pull-9';
		case 'right':
			return 'col-md-3';
		default:
			return false;
	}
}

/**
 * For backward compatibility for background
 * Will be removed in v 1.7
 */
function visualcomposerstarter_set_old_styles() {
	if ( get_theme_mod( 'vct_overall_site_bg_color' ) ) {
		set_theme_mod( 'background_color', str_replace( '#', '', get_theme_mod( 'vct_overall_site_bg_color' ) ) );
		remove_theme_mod( 'vct_overall_site_bg_color' );
	}

	if ( get_theme_mod( 'vct_overall_site_enable_bg_image' ) ) {

		set_theme_mod( 'background_attachment', 'scroll' );
		set_theme_mod( 'background_image', esc_url_raw( get_theme_mod( 'vct_overall_site_bg_image' ) ) );
		if ( 'repeat' === get_theme_mod( 'vct_overall_site_bg_image_style' ) ) {
			set_theme_mod( 'background_repeat', 'repeat' );
		} else {
			set_theme_mod( 'background_repeat', 'no-repeat' );
			set_theme_mod( 'background_size', esc_html( get_theme_mod( 'vct_overall_site_bg_image_style' ) ) );
		}
		remove_theme_mod( 'vct_overall_site_bg_image' );
		remove_theme_mod( 'vct_overall_site_bg_image_style' );
		remove_theme_mod( 'vct_overall_site_enable_bg_image' );
	}
}
add_action( 'init', 'regPostType' );
function regPostType(){
	register_post_type('teams', array(
		'labels'             => array(
			'name'               => 'Teams',
			'singular_name'      => 'Team member', 
			'add_new'            => 'Add new team member',
			'add_new_item'       => 'Add new team member',
			'edit_item'          => 'Edit team member',
			'new_item'           => 'New team member',
			'view_item'          => 'View team member',
			'search_items'       => 'Search team member',
			'not_found'          =>  'Team member not found',
			'parent_item_colon'  => '',
			'menu_name'          => 'Teams'
		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'		 	 => 'dashicons-groups',
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 3,
		'supports'           => array('title','thumbnail')
	) );
}

function team_slider(){?>
<div id="owlTeam" class="owl-carousel owl-theme owl-loaded">
    <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(-2400px, 0px, 0px); transition: all 0.75s ease 0s; width: 4800px;"> 
        	<?php  
	        	$query = new WP_Query(array('post_type' => 'teams', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1));
				if( $query->have_posts() ){
					while( $query->have_posts() ){ $query->the_post();
					?>
			            <div class="owl-item" style="width: 400px;">
			                <div class="card">
			                    <div class="card-img-top">
			                        <img class="card-img" src="<?php the_post_thumbnail_url(); ?>">
			                    </div>
			                    <div class="card-body">
			                        <h5 class="card-title mb-2"><?php the_title(); ?></h5>
			                        <div class="card-subtitle mb-3"><?= get_field("team_position"); ?></div>
			                        <div class="card-text mb-2"><?= get_field("team_excerpt"); ?></div>
			                        <ul class="card-social-list mb-4">
			                            <li><a href="<?= get_field('team_facebook'); ?>"><i class="icon icon-facebook"></i></a></li>
										<li><a href="<?= get_field('team_twitter'); ?>"><i class="icon icon-twitter"></i></a></li>
										<li><a href="<?= get_field('team_linkedin'); ?>"><i class="icon icon-linkedin"></i></a></li>
			                        </ul>
			                    </div>
			                </div>
			            </div>						
					<?php
					}
					wp_reset_postdata(); 
				} 
				else echo 'No posts.';
			?>
        </div>
    </div>
</div>
<?php }
add_shortcode('teamSlider', 'team_slider');

function shortTeam(){ ?>
	<div class="row" id="Team"><?php
		$query1 = new WP_Query(array('post_type' => 'teams', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1));
		if( $query1->have_posts() ){
			while( $query1->have_posts() ){ $query1->the_post();?>
			<div class="col-xl-4 col-sm-6">
			    <div class="card text-center">
			        <div class="card-img-top">
			            <img class="card-img" src="<?php the_post_thumbnail_url(); ?>">
			        </div>
			        <div class="card-body">
			            <h5 class="card-title mb-2"><?php the_title(); ?></h5>
			            <div class="card-subtitle mb-3"><?= get_field("team_position"); ?></div>
			            <div class="card-text mb-2"><?= get_field("team_excerpt"); ?></div>
			            <ul class="card-social-list mb-4">
	                        <li><a href="<?= get_field('team_facebook'); ?>"><i class="icon icon-facebook"></i></a></li>
							<li><a href="<?= get_field('team_twitter'); ?>"><i class="icon icon-twitter"></i></a></li>
							<li><a href="<?= get_field('team_linkedin'); ?>"><i class="icon icon-linkedin"></i></a></li>
			            </ul>
			        </div>
			    </div>
			</div>
			<?php } wp_reset_postdata(); 
		} else echo 'No posts.';?>
	</div><?php
}
add_shortcode('shortTeam', 'shortTeam');


/* OFF UPDATE theme, plugin and Wordpress */

	add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
		wp_clear_scheduled_hook('wp_version_check');
		remove_action( 'load-update-core.php', 'wp_update_plugins' );
	add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
		wp_clear_scheduled_hook( 'wp_update_plugins' );
		remove_action('load-update-core.php','wp_update_themes');
	add_filter('pre_site_transient_update_themes',create_function('$a', "return null;"));
		wp_clear_scheduled_hook('wp_update_themes');

/* End off update */

function postNews(){ ?>
	<div class="row postNews"><?php
		$query2 = new WP_Query(array('post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1));
		if( $query2->have_posts() ){
			while( $query2->have_posts() ){ $query2->the_post();?>

			<div class="col-md-6 col-xl-4">
			  <div class="card mb-4">
			    <div class="card-img-top">
			      <a href="<?php the_permalink(); ?>"><img class="card-img" src="<?php the_post_thumbnail_url(); ?>" alt="Card image cap"></a>
			      <img src="/wp-content/themes/visual-composer-starter/img/370x200.png">
			    </div>
			    <div class="card-body">
			      <h5 class="card-title mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			      <p class="card-text mb-2"><?php the_excerpt(); ?></p><br>
			      <div class="row">
			        <div class="card-date col"><span class="icon"><img src="/wp-content/themes/visual-composer-starter/img/calendar-icon.png" data-rjs="2"></span><?= get_the_date('d.m.Y'); ?></div>
			        <div class="card-author pl-0 col text-right"><?php if(!empty(get_field("post_author"))){echo 'by ' . get_field("post_author");} ?></div>
			      </div>
			    </div>
			  </div>
			</div>

			<?php } wp_reset_postdata(); 
		} else echo 'No posts.';?>
	</div><?php
}
add_shortcode('postNews', 'postNews');

function recentSidebar(){ ?>
	<div class="sidebar">
	    <div class="recent-posts">
	        <h3 class="mb-4">Recent posts</h3>
	        <ul>
			<?php
			$query2 = new WP_Query(array('post_type' => 'post', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 6));
			if( $query2->have_posts() ){
				while( $query2->have_posts() ){ $query2->the_post();?>
				    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php } wp_reset_postdata(); 
			} else echo 'No posts.';?>	
		</ul>		    
		</div>
	</div>
	<?php
}
add_shortcode('recentSidebar', 'recentSidebar');