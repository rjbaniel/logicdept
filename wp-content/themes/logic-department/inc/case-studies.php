<?php

function logic_department__register_case_studies() {	
	$labels = array(
		'name'                => __( 'Case Studies', 'logic-department' ),
		'singular_name'       => __( 'Case Study', 'logic-department' ),
		'edit_item'           => __( 'Edit Case Study', 'logic-department' ),
		'new_item'            => __( 'New Case Study', 'logic-department' ),
		'view_item'           => __( 'View Case Study', 'logic-department' ),
		'search_items'        => __( 'Search Case Studies', 'logic-department' ),
		'not_found'           => __( 'No Case Studies found', 'logic-department' ),
		'not_found_in_trash'  => __( 'No Case Studies found in Trash', 'logic-department' ),
		'menu_name'           => __( 'Case Studies', 'logic-department' ),
	);

	$post_type_args = array(
		'labels'              => $labels,
		'taxonomies'          => array( 'service' ),
		'public'              => true,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'revisions',
			'page-attributes',
		),
		'register_meta_box_cb' => 'logic_department__register_case_study_meta_box',
	);
	register_post_type( 'case-study', $post_type_args );

	$tax_args = array(
		'label' => _x( 'Services', 'logic-department' ,'logic-department' ),
		'hierarchical' => true,
	);
	register_taxonomy( 'service', 'case-study', $tax_args );
}
add_action( 'init', 'logic_department__register_case_studies' );

function logic_department__register_case_study_meta_box( $post ) {
	wp_enqueue_media();
	wp_register_script( 'case-studies-admin', get_template_directory_uri() . '/js/case-studies-admin.js', array( 'jquery' ) );
	wp_localize_script( 'case-studies-admin', 'meta_image', array(
		'title' => __( 'Choose images for this Case Study', 'logic-department' ),
		'button' => __( 'Use these images', 'logic-department' ),
	) );
	wp_enqueue_script( 'case-studies-admin' );
	add_meta_box( 'case-study-meta-box', __( 'Case Study', 'logic-department' ), 'logic_department__show_case_study_meta_box', 'case-study', 'normal', 'high' );
}
function logic_department__show_case_study_meta_box( $post ) {
	$image_ids = ( get_post_meta( $post->ID, '_ld-case-study-images', true ) ) ? get_post_meta( $post->ID, '_ld-case-study-images', true ) : array();
	$live_link = ( get_post_meta( $post->ID, '_ld-case-study-live-link', true ) ) ? get_post_meta( $post->ID, '_ld-case-study-live-link', true ) : '';
	
	$challenge = ( get_post_meta( $post->ID, '_ld-case-study-challenge', true ) ) ? get_post_meta( $post->ID, '_ld-case-study-challenge', true ) : '';
	$approach = ( get_post_meta( $post->ID, '_ld-case-study-approach', true ) ) ? get_post_meta( $post->ID, '_ld-case-study-approach', true ) : '';
	$result = ( get_post_meta( $post->ID, '_ld-case-study-result', true ) ) ? get_post_meta( $post->ID, '_ld-case-study-result', true ) : '';
	?>
	<label for="ld-live-link"><?php _e( 'Link to live site', 'logic-department' ); ?></label>
	<input type="text" name="ld-live-link" id="ld-live-link" class="widefat" value="<?php echo esc_url( $live_link ) ?>">

	<label for="ld-challenge"><?php _e( 'Challenge: ', 'logic-department' ); ?></label>
	<textarea name="ld-challenge" id="ld-challenge" class="widefat"><?php echo esc_html( $challenge ) ?></textarea>
	<label for="ld-approach"><?php _e( 'Approach: ', 'logic-department' ); ?></label>
	<textarea name="ld-approach" id="ld-approach" class="widefat"><?php echo esc_html( $approach ) ?></textarea>
	<label for="ld-result"><?php _e( 'Result', 'logic-department' ); ?></label>
	<textarea name="ld-result" id="ld-result" class="widefat"><?php echo esc_html( $result ) ?></textarea>

	<label for="ld-case-study-images"><?php _e( 'Images', 'logic-department' ); ?></label>
	<input type="text" name="ld-case-study-images" id="ld-case-study-images" class="widefat" value="<?php echo implode( ', ', $image_ids ); ?>">
	<input type="button" id="ld-case-study-images-button" value="Choose images">
<?php }

function logic_department__save_case_study( $post_id ) {
	if ( get_post_type( $post_id ) != 'case-study' )
		return;

	if ( isset( $_POST['ld-case-study-images'] ) ) {
		$case_study_images = $_POST['ld-case-study-images'];
		$case_study_images = str_replace( ', ', ',', $case_study_images );
		$case_study_images_array = explode( ',', $case_study_images);
		update_post_meta( $post_id, '_ld-case-study-images', $case_study_images_array );
	}

	if ( isset( $_POST['ld-live-link'] ) ) {
		$live_link_url = $_POST['ld-live-link'];
    	if ( ! filter_var( $live_link_url, FILTER_VALIDATE_URL) === false) {
			update_post_meta( $post_id, '_ld-case-study-live-link', $live_link_url );
    	}
	}

	$other_meta_keys = array( 'challenge', 'approach', 'result' );
	foreach( $other_meta_keys as $key ) {
		if ( isset( $_POST[ 'ld-' . $key ] ) ) {
			update_post_meta( $post_id, '_ld-case-study-' . $key, $_POST['ld-' . $key ] );
		}
	}
}
add_action( 'save_post', 'logic_department__save_case_study' );

function logic_department__add_case_studies_active_class( $classes, $menu_item ) {
	if ( get_post_type() == 'case-study' && strpos( $menu_item->title, 'Projects' ) !== false ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'logic_department__add_case_studies_active_class', 10, 2 );
?>