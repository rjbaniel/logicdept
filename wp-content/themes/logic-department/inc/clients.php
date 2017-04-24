<?php
function logic_department__register_clients() {
	$labels = array(
		'name'                => __( 'Clients', 'logic-department' ),
		'singular_name'       => __( 'Client', 'logic-department' ),
		'edit_item'           => __( 'Edit Client', 'logic-department' ),
		'new_item'            => __( 'New Client', 'logic-department' ),
		'view_item'           => __( 'View Client', 'logic-department' ),
		'search_items'        => __( 'Search Clients', 'logic-department' ),
		'not_found'           => __( 'No Clients found', 'logic-department' ),
		'not_found_in_trash'  => __( 'No Clients found in Trash', 'logic-department' ),
		'menu_name'           => __( 'Clients', 'logic-department' ),
	);

	$post_type_args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'thumbnail',
			'page-attributes',
		),
	);
	register_post_type( 'client', $post_type_args );
}
add_action( 'init', 'logic_department__register_clients' );

function display_clients() {
	$client_posts = get_all_client_posts();
	if ( ! empty( $client_posts ) ) { ?>
		<div class="clients">
			<h1 class="clients__title">Who we've worked with</h1>
			<div class="client_images_container">
			<?php
			foreach( $client_posts as $client_post ) {
				display_client_image( $client_post );
			}
			?>
			</div>
			<a href="#" class="clients__more-link button-link"><span class="more-link__extended">See Our </span>Previous Projects</a>
		</div>
	<?php }
}

function get_all_client_posts() {
	$client_posts_query = new WP_Query( array( 'post_type' => 'client', 'posts_per_page' => -1 ) );
	$client_posts = $client_posts_query->posts;
	return $client_posts;
}

function display_client_image( $post ) {
	$client_image_url = get_the_post_thumbnail_url( $post, 'full' );
	$client_name = get_the_title( $post );
	?>
	<div class="client">
		<img src="<?php echo esc_url( $client_image_url ); ?>" class="client_image" alt="<?php echo esc_html( $client_name ); ?>">
	</div>
	<?php
}
?>