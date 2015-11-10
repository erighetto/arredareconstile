<?php
/**
 * Anna Cecchini functions and definitions
 *
 * @package Anna Cecchini
 */

if ( ! function_exists( 'annacecchini_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function annacecchini_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Anna Cecchini, use a find and replace
	 * to change 'annacecchini' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'annacecchini', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'annacecchini' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'annacecchini_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // annacecchini_setup
add_action( 'after_setup_theme', 'annacecchini_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function annacecchini_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'annacecchini_content_width', 640 );
}
add_action( 'after_setup_theme', 'annacecchini_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function annacecchini_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_singular()) {
		wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js', array('jquery'), '16092015', false );
		wp_enqueue_script( 'jquery.mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), '16092015', false );
		wp_enqueue_script( 'jquery.kinetic', get_template_directory_uri() . '/js/jquery.kinetic.min.js', array('jquery'), '16092015', false );
		wp_enqueue_script( 'jquery.smoothdivscroll', get_template_directory_uri() . '/js/jquery.smoothdivscroll-1.3-min.js', array('jquery'), '16092015', false );
		wp_enqueue_script( 'jquery.colorbox', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array('jquery'), '16092015', true );
		wp_enqueue_script( 'jquery.imgpreload', get_template_directory_uri() . '/js/jquery.imgpreload.js', array('jquery'), '16092015', true );


		wp_enqueue_style( 'smoothDivScroll', get_template_directory_uri() . '/css/smoothDivScroll.css' );
		wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/css/colorbox.css' );
	}


	if(is_archive()){
		wp_enqueue_script( 'freewall', get_template_directory_uri() . '/js/freewall.min.js', array('jquery'), '16092015', true );
	}

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), 'v3.3.5', true );
}
add_action( 'wp_enqueue_scripts', 'annacecchini_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Bootstrap integration
*/
require get_template_directory() . '/inc/functions-strap.php';


if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails'  );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'single-page-thumbnail', 1085, 710, true );
	add_image_size( 'home-page-thumbnail', 1105, 710, true );
	add_image_size( 'portfolio-thumbnail', 250, 250, true ); // (ritagliata)
}

add_filter( 'nav_menu_css_class', 'add_custom_class', 10, 2 );

function add_custom_class( $classes = array(), $menu_item = false ) {
	global $post;
    if ( is_single() && has_term(null,'typology', $post ) && 218 == $menu_item->ID ) {
        $classes[] = 'active';
    }
	if ( is_single() && ( in_category( 'portfolio' ) || post_is_in_descendant_category( 9, $post ) ) && 186 == $menu_item->ID ) {
        $classes[] = 'active';
    }
    return $classes;
}

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}