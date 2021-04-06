<?php
/**
 * Two Sisters Bakery functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Two_Sisters_Bakery
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'two_sisters_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function two_sisters_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Two Sisters Bakery, use a find and replace
		 * to change 'two-sisters' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'two-sisters', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' => esc_html__( 'Header Menu Location', 'two-sisters' ),
				'social' => esc_html__( 'Social Menu Location', 'two-sisters' ),
				'footer' => esc_html__( 'Footer Menu Location', 'two-sisters' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'two_sisters_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'two_sisters_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function two_sisters_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'two_sisters_content_width', 640 );
}
add_action( 'after_setup_theme', 'two_sisters_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function two_sisters_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'two-sisters' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'two-sisters' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'two_sisters_widgets_init' );*/

/**
 * Enqueue scripts and styles.
 */
function two_sisters_scripts() {
	wp_enqueue_style( 'two-sisters-googlefonts', 'https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Open+Sans:wght@400;600;700;800&display=swap',
	array(),
	null
	);
	wp_enqueue_style( 'two-sisters-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'two-sisters-style', 'rtl', 'replace' );

	wp_enqueue_script( 'two-sisters-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAcvAEXBQ33tMdZA2yB1HWovu8pbx5Qoj4' );
	wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/js/maps.js', array('jquery','google-maps'), '', true);
}
add_action( 'wp_enqueue_scripts', 'two_sisters_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

//Disable block editor on front page
function ts_post_filter( $use_block_editor, $post ) {
	$pages=array(20, 31, 32, 35, 38, 211);

	if ( in_array($post->ID, $pages) ) { 
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'ts_post_filter', 10, 2 );


/**
 * Admin Customizations
 */
require get_template_directory() . '/inc/admin-customizations.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/**
 * Options Page
*/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-general-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Options',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-options',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Options',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-options',
	));
}

//Customize WYSIWYG Toolbar

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars ){
	// Uncomment to view format of $toolbars
	
	// echo '< pre >';
	// 	print_r($toolbars);
	// echo '< /pre >';
	// die;
	
	$toolbars['Very Simple' ] = array();
	$toolbars['Very Simple' ][1] = array('formatselect', 'bold' , 'italic', 'pastetext', 'link');

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

// Customize WP Login Page
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// Return home from login page when clicking on logo
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Google Maps API Key Method 1: Filter.
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAcvAEXBQ33tMdZA2yB1HWovu8pbx5Qoj4';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


//  Disable Reviews
function iconic_disable_reviews() {
    remove_post_type_support( 'product', 'comments' );
}
add_action( 'init', 'iconic_disable_reviews' );


//Move Yoast Metabox Priority

function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );

