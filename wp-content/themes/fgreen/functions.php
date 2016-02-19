<?php
/**
 * fGreen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage fGreen
 * @author tishonator
 * @since fGreen 1.0.0
 *
 */

if ( ! function_exists( 'fgreen_setup' ) ) :
/**
 * fGreen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fgreen_setup() {

	load_theme_textdomain( 'fgreen', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'primary menu', 'fgreen' ),
	) );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 'full', 'full', true );

	if ( ! isset( $content_width ) )
		$content_width = 900;

	add_theme_support( 'automatic-feed-links' );

	// add Custom background				 
	add_theme_support( 'custom-background', 
				   array ('default-color'  => '#f0ece3')
				 );

	// add custom header
	add_theme_support( 'custom-header', array (
					   'default-image'          => '',
					   'random-default'         => '',
					   'width'                  => 145,
					   'height'                 => 36,
					   'flex-height'            => '',
					   'flex-width'             => '',
					   'default-text-color'     => '',
					   'header-text'            => '',
					   'uploads'                => true,
					   'wp-head-callback'       => '',
					   'admin-head-callback'    => '',
					   'admin-preview-callback' => '',
					) );
					
	add_theme_support( "title-tag" );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	// add support for Post Formats.
	add_theme_support( 'post-formats', array (
											'aside',
											'image',
											'video',
											'audio',
											'quote', 
											'link',
											'gallery',
					) );

	// add the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css' ) );
}
endif; // fgreen_setup
add_action( 'after_setup_theme', 'fgreen_setup' );

/**
 * the main function to load scripts in the fGreen theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fgreen_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'fgreen-style', get_stylesheet_uri(), array( ) );
	
	wp_enqueue_style( 'fgreen-fonts', fgreen_fonts_url(), array(), null );
	
	// Load thread comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// Load Utilities JS Script
	wp_enqueue_script( 'fgreen-js', get_template_directory_uri() . '/js/fgreen.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'fgreen_load_scripts' );

/**
 *	Load google font url used in the fGreen theme
 */
function fgreen_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by PT Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $cantarell = _x( 'on', 'PT Sans font: on or off', 'fgreen' );

    if ( 'off' !== $cantarell ) {
        $font_families = array();
 
        $font_families[] = 'PT Sans:400,400italic,700';
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 * Display website's logo image
 */
function fgreen_show_website_logo_image_or_title() {

	if ( get_header_image() != '' ) {
	
		// Check if the user selected a header Image in the Customizer or the Header Menu
		$logoImgPath = get_header_image();
		$siteTitle = get_bloginfo( 'name' );
		$imageWidth = get_custom_header()->width;
		$imageHeight = get_custom_header()->height;
		
		echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
		
		echo '<img src="' . esc_attr( $logoImgPath ) . '" alt="' . esc_attr( $siteTitle ) . '" title="' . esc_attr( $siteTitle ) . '" width="' . esc_attr( $imageWidth ) . '" height="' . esc_attr( $imageHeight ) . '" />';
		
		echo '</a>';

	} else {
	
		echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
		
		echo '<h1>'.get_bloginfo('name').'</h1>';
		
		echo '</a>';
		
		echo '<strong>'.get_bloginfo('description').'</strong>';
	}
}

/**
 *	Displays the copyright text.
 */
function fgreen_show_copyright_text() {

	$footerText = get_theme_mod('fgreen_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fgreen_widgets_init() {
	
	// Register Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fgreen'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fgreen'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );
	
	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fgreen' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fgreen' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fgreen' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fgreen' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fgreen' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fgreen' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}

add_action( 'widgets_init', 'fgreen_widgets_init' );

/**
 *	Used to load the content for posts and pages.
 */
function fgreen_the_content() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {
		
		echo '<a href="'. esc_url( get_permalink() ) .'" title="' . esc_attr( get_the_title() ) . '">';
		
		the_post_thumbnail();
		
		echo '</a>';
	}
	the_content( __( 'Read More', 'fgreen') );
}

/**
 *	Displays the single content.
 */
function fgreen_the_content_single() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {

		the_post_thumbnail();
	}
	the_content( __( 'Read More...', 'fgreen') );
}

/**
 * Gets additional theme settings description
 */
function fgreen_get_customizer_sectoin_info() {

	$premiumThemeUrl = 'https://tishonator.com/product/tgreen';

	return sprintf( __( 'The fGreen theme is a free version of the professional WordPress theme tGreen. <a href="%s" class="button-primary" target="_blank">Get tGreen Theme</a><br />', 'fgreen' ), $premiumThemeUrl );
}

/**
 * Register theme settings in the customizer
 */
function fgreen_customize_register( $wp_customize ) {

	$premiumThemeUrl = 'https://tishonator.com/product/tgreen';

	// Header Image Section
	$wp_customize->add_section( 'header_image', array(
		'title' => __( 'Header Image', 'fgreen' ),
		'description' => fgreen_get_customizer_sectoin_info(),
		'theme_supports' => 'custom-header',
		'priority' => 60,
	) );

	// Colors Section
	$wp_customize->add_section( 'colors', array(
		'title' => __( 'Colors', 'fgreen' ),
		'description' => fgreen_get_customizer_sectoin_info(),
		'priority' => 50,
	) );

	// Background Image Section
	$wp_customize->add_section( 'background_image', array(
			'title' => __( 'Background Image', 'fgreen' ),
			'description' => fgreen_get_customizer_sectoin_info(),
			'priority' => 70,
		) );

    $wp_customize->add_section(
		'fgreen_footer_section',
		array(
			'title'       => __( 'Footer', 'fgreen' ),
			'capability'  => 'edit_theme_options',
			'description' => fgreen_get_customizer_sectoin_info(),
		)
	);

	# Add footer copyright text
	$wp_customize->add_setting(
		'fgreen_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fgreen_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fgreen' ),
            'section'        => 'fgreen_footer_section',
            'settings'       => 'fgreen_footer_copyright',
            'type'           => 'text',
            )
        )
	);
}

add_action('customize_register', 'fgreen_customize_register');

?>
