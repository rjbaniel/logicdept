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
	wp_localize_script( 'logic-department', 'ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( get_post_type() == 'case-study' && ! is_archive() ) {
		wp_enqueue_script( 'single-case-study', get_template_directory_uri() . '/js/single-case-study.js', array('jquery'), '0.1', true );
		wp_enqueue_style( 'dashicons' );
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

function logic_department__add_special_meta_boxes() {
	global $post;
	$about_args = array(
		'name' => "about",
		'fields' => array(
			'intro-highlighted' => array(
				'type' => 'full',
				'display' => 'Highlighted intro text',
			),
			'intro-regular' => array(
				'type' => 'full',
				'display' => 'Regular intro text',
			),
			'services-offered' => array(
				'type' => 'full',
				'display' => 'Offered services (use HTML li markup)'
			),
			'team-member-1-name' => array(
				'type' => 'small',
				'display' => 'First team member name',
			),
			'team-member-1-bio' => array(
				'type' => 'full',
				'display' => 'First team member bio',
			),
			'team-member-2-name' => array(
				'type' => 'small',
				'display' => 'Second team member name',
			),
			'team-member-2-bio' => array(
				'type' => 'full',
				'display' => 'Second team member bio',
			),
		),
	);
	$home_args = array(
		'name' => 'home',
		'fields' => array(
			'top-title' => array(
				'type' => 'small',
				'display' => 'Home page top title',
			),
			'top-text' => array(
				'type' => 'full',
				'display' => 'Home page top text',
			),
			'what-we-do' => array(
				'type' => 'full',
				'display' => 'List items for "what we do" (use HTML li markup)',
			),
			'dont-do' => array(
				'type' => 'full',
				'display' => 'List items for "what we don\'t do" (use HTML li markup)',
			),
		),
	);
	$services_args = array(
		'name' => 'services',
		'fields' => array(
			'top-title' => array(
				'type' => 'small',
				'display' => 'Services page top title',
			),
			'top-text' => array(
				'type' => 'full',
				'display' => 'Services page top text',
			),
		),
	);
	$contact_args = array(
		'name' => 'contact-us',
		'fields' => array(
			'text' => array(
				'type' => 'full',
				'display' => 'Text for the contact page',
			),
		),
	);
	if ( $post->post_name == 'services' )
		logic_department__add_page_meta_box( $services_args );

	if ( $post->post_name == 'about' )
		logic_department__add_page_meta_box( $about_args );

	if ( $post->post_name == 'contact-us' )
		logic_department__add_page_meta_box( $contact_args );

	if ( get_option( 'page_on_front' ) === $post->ID )
		logic_department__add_page_meta_box( $home_args );
}
add_action( 'add_meta_boxes', 'logic_department__add_special_meta_boxes', 5);

function logic_department__add_page_meta_box( $args ) {
	if ( ! is_array( $args ) || empty( $args ) )
		return;
	$template_name = isset( $args['name'] ) ? $args['name'] : '';
	$fields = isset( $args['fields'] ) ? $args['fields'] : '';	
	if ( empty( $template_name ) || empty( $fields ) )
		return;	
	if ( ! is_array( $fields ) )
		$fields = array( $fields );
	
	$meta_box_markup = '';
	foreach( $fields as $fieldname => $field ) {
		$meta_box_markup .= logic_department__meta_box_markup( $template_name, $fieldname, $field );
	}

	add_meta_box(
		$template_name . '-meta',
		ucfirst($template_name) . ' content options',
		function( $post, $info ) { echo $info['args']['markup']; },
		'page',
		'normal',
		'high',
		array( 'markup' => $meta_box_markup )
	);
}

function logic_department__meta_box_markup( $template_name, $fieldname, $field ) {
	$type = $field['type'];
	ob_start();
	$field_id = esc_attr( $template_name . '-' . $fieldname );
	$field_option_id = 'ld_' . $field_id;
	$current_value = stripslashes( html_entity_decode( get_option( $field_option_id ) ) );
	?>
	<label for="<?php echo $field_id ?>">
		<?php echo esc_html( $field['display'] ); ?>:
	</label><br>
	<?php
	if ( $field['type'] == 'full' ) :
	?>
		<textarea cols="80" rows="10" name="<?php echo $field_option_id; ?>" id="<?php echo $field_id; ?>"><?php
			echo $current_value;
		?></textarea><br>
	<?php
	else :
	?>
		<input type="text" name="<?php echo $field_option_id; ?>" id="<?php echo $field_id; ?>" value="<?php echo $current_value; ?>"><br>
	<?php
	endif;
	return ob_get_clean();
}

function logic_department__save_page_option() {
	foreach( $_POST as $key => $value ) {
		if ( strpos( $key, 'ld_' ) === 0 ) {
			$encoded_option = esc_html( $_POST[$key] );
			update_option( $key, $encoded_option);
		}
	}
}
add_action( 'save_post', 'logic_department__save_page_option');

function logic_department__echo_option( $option_name ) {
	$decoded = html_entity_decode( get_option( $option_name ) );
	$slashes_stripped = stripslashes( $decoded );
	echo $slashes_stripped;
}
function logic_department__modify_case_studies_query( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'case-study' ) ) {
		$query->set( 'posts_per_page', '4' );
		return $query;
	}
}
add_action( 'pre_get_posts', 'logic_department__modify_case_studies_query' );

function load_next_projects_page() {
	$page_num = $_POST['page_num'];
	$projects_query = new WP_Query( array(
		'post_type' => 'case-study',
		'posts_per_page' => 4,
		'paged' => $page_num,
		'post_status' => 'publish',
	) );

	$projects_markup = array();
	if ( $projects_query->have_posts() ) :
		while( $projects_query->have_posts() ) :
			$projects_query->the_post();
			ob_start();
			?>
			<div class="link-block link-block--case-study flex-row__item" style="background-image: url(<?php echo the_post_thumbnail_url( 'full' ); ?> );">
				<div class="link-block__inner">
					<h1 class="link-block__title"><?php echo the_title(); ?></h1>
					<div class="case-study__hr"></div>
					<?php 
					$content = get_the_content();
					if ( !empty( $content ) ) : ?>
						<div class="link-block__description"><?php the_content(); ?></div>
					<?php endif; ?>
					<a href="<?php echo get_permalink( $post ); ?>"class="link-block__link button-link">View Project</a>
				</div>
			</div>
			<?php
			$projects_markup[] = ob_get_clean();
		endwhile;
		echo json_encode( $projects_markup );
	else :
		echo 'done';
	endif;
	wp_die();
}
add_action( 'wp_ajax_load_next_projects_page', 'load_next_projects_page' );
add_action( 'wp_ajax_nopriv_load_next_projects_page', 'load_next_projects_page' );
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
