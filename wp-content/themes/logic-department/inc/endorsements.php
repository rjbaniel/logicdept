<?php
function logic_department__register_endorsements() {
	$labels = array(
		'name'                => __( 'Endorsements', 'logic-department' ),
		'singular_name'       => __( 'Endorsement', 'logic-department' ),
		'edit_item'           => __( 'Edit Endorsement', 'logic-department' ),
		'new_item'            => __( 'New Endorsement', 'logic-department' ),
		'view_item'           => __( 'View Endorsement', 'logic-department' ),
		'search_items'        => __( 'Search Endorsements', 'logic-department' ),
		'not_found'           => __( 'No Endorsements found', 'logic-department' ),
		'not_found_in_trash'  => __( 'No Endorsements found in Trash', 'logic-department' ),
		'menu_name'           => __( 'Endorsements', 'logic-department' ),
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
			'editor',
			'revisions',
			'page-attributes',
		),
		'register_meta_box_cb' => 'logic_department__register_endorsement_meta_box',
	);
	register_post_type( 'endorsement', $post_type_args );
}
add_action( 'init', 'logic_department__register_endorsements' );

function logic_department__register_endorsement_meta_box( $post ) {
	add_meta_box( 'endorsement-meta-box', __( 'Endorsement', 'logic-department' ), 'logic_department__show_endorsement_meta_box', 'endorsement', 'normal', 'high' );
}
function logic_department__show_endorsement_meta_box( $post ) { 
	$endorser = ( get_post_meta( $post->ID, '_ld-endorser', true ) ) ? get_post_meta( $post->ID, '_ld-endorser', true ) : '';
	?>
	<label for="ld-endorser"><?php _e( 'Endorser', 'logic-department' ); ?></label>
	<input type="text" name="ld-endorser" class="widefat" value="<?php echo $endorser ?>">
<?php }

function logic_department__save_endorsement( $post_id ) {
	if ( get_post_type( $post_id ) != 'endorsement' )
		return;

	if ( ! empty( $_POST['ld-endorser'] ) ) {
		$endorser = $_POST['ld-endorser'];
		update_post_meta( $post_id, '_ld-endorser', $endorser );
	}
}
add_action( 'save_post', 'logic_department__save_endorsement' );
function get_endorsements() {
	$endorsements_query = new WP_Query( array( 'post_type' => 'endorsement', 'posts_per_page' => -1 ) );
	$endorsements = $endorsements_query->posts;
	if ( count( $endorsements ) > 1 ) {
		?>
		<div class="endorsements">
		<?php
		$display_endorsements = array();
		$display_endorsements[0] = rand( 0, count( $endorsements ) - 1 );
		$display_endorsements[1] = rand( 0, count( $endorsements ) - 1 );
		while ( $display_endorsements[1] === $display_endorsements[0] ) {
			$display_endorsements[1] = rand( 0, count( $endorsements ) - 1 );
		}

		foreach( $display_endorsements as $index ) {
		?>
			<div class="endorsement">
				<div class="endorsement__content">
				<?php
					$content = $endorsements[$index]->post_content;
					$content = apply_filters( 'the_content', $content );
		  			$content = str_replace( ']]>', ']]&gt;', $content );
		  			echo "<em>" . $content . "</em>";
				?>
				</div>
				<div class="endorsement__endorser"><?php echo "&mdash; " . esc_html( get_post_meta( $endorsements[$index]->ID, '_ld-endorser', true ) ); ?></div>
			</div>
		<?php } ?>
		</div>
		<?php
	}
}
?>