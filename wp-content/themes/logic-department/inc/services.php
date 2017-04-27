<?php
function display_service( $service ) {
	$case_study = get_last_case_study_for_service( $service );
	$service_image_url = esc_url( get_theme_mod( 'logic_department__service-' . $service->name . '-image' ) );
	?>

	<div class="link-block link-block--service flex-row__item" style="background-image: url(<?php echo $service_image_url ?>);">
		<div class="link-block__inner">
			<h1 class="link-block__title"><?php echo esc_html( $service->name ); ?></h1>
			<div class="link-block__description"><?php echo esc_html( $service->description ); ?></div>
			<a href="<?php echo get_permalink( $case_study ); ?>"class="link-block__link button-link">View a related project</a>
		</div>
	</div>
<?php }

function get_last_case_study_for_service( $service ) {
	$tax_query = array(
		array(
			'taxonomy' => 'service',
			'field' => 'term_id',
			'terms' => $service->term_id,
		)
	);
	$case_studies_for_service = new WP_Query( array( 'tax_query' => $tax_query ) );
	return $case_studies_for_service->posts[0];
}
?>