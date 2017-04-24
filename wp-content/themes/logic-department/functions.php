<?php
/**
 * Logic Department functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Logic_Department
 */

if ( ! function_exists( 'logic_department_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function logic_department_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Logic Department, use a find and replace
	 * to change 'logic-department' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'logic-department', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'logic-department' ),
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
	add_theme_support( 'custom-background', apply_filters( 'logic_department_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'logic_department_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function logic_department_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'logic_department_content_width', 640 );
}
add_action( 'after_setup_theme', 'logic_department_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function logic_department_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'logic-department' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'logic-department' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'logic_department_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function logic_department_scripts() {
	wp_enqueue_style( 'logic-department-style', get_stylesheet_uri() );

	wp_enqueue_script( 'logic-department-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'logic-department-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'logic-department-sticky-header', get_template_directory_uri() . '/js/sticky-header.js', array( 'jquery' ), '0.1', true );
	wp_enqueue_script( 'logic-department', get_template_directory_uri() . '/js/logic-dept.js', array(), '2.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page( 'services' ) || get_post_type() == 'case-study' ) {
		if ( get_post_type() == 'case-study' ) {
			wp_enqueue_script( 'single-case-study', get_template_directory_uri() . '/js/single-case-study.js', array('jquery'), '0.1', true );
		}
	}


}
add_action( 'wp_enqueue_scripts', 'logic_department_scripts' );

/**
 *	Override Contact Form Add enqueing logic
 */
function logic_department__maybe_dequeue_smuzform() {
	if ( ! is_admin() && ! is_page( 'contact-us' ) ) {
		wp_dequeue_script( 'smuzformsjs');
		wp_dequeue_script( 'jquery-validate' );
		wp_dequeue_style( 'smuzform-public-form-render' );
	}
}
add_action( 'wp_enqueue_scripts', 'logic_department__maybe_dequeue_smuzform', 15 );
/**
 * Add custom post types and related logic
*/
require_once( 'inc/case-studies.php' );
require_once( 'inc/endorsements.php' );
require_once( 'inc/clients.php' );

/**
 * Helper functions for Services page
*/
require_once( 'inc/services.php' );

function logic_department__add_homepage_statement_meta_box() {
	global $post;
	if ( get_option( 'page_on_front' ) === $post->ID ) {
		add_meta_box(
			'homepage-statement',
			'Homepage Statement',
			'logic_department__show_homepage_statement_meta_box',
			'page',
			'normal',
			'high'
		);
	} else {
		return;
	}
}
add_action( 'add_meta_boxes', 'logic_department__add_homepage_statement_meta_box' );

function logic_department__show_homepage_statement_meta_box() { ?>
	<label for="homepage-statement-text">Statement:</label><br>
	<textarea cols="100" rows="20" name="_homepage-statement" id="homepage-statement-text"><?php
		if ( get_option( 'homepage-statement' ) ) {
			echo html_entity_decode( get_option('homepage-statement'), ENT_HTML5 );
		}
	?></textarea>
<?php }

function logic_department__save_homepage_statement() {
	if ( !empty( $_POST['_homepage-statement'] ) ) {
		$encoded_statement = esc_html( $_POST['_homepage-statement'] );
		update_option( 'homepage-statement', $encoded_statement );
	} else {
		return;
	}
}
add_action( 'save_post', 'logic_department__save_homepage_statement' );
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
