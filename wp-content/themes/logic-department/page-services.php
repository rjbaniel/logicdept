<?php
/**
 * The template for the services page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logic_Department
 */

get_header(); ?>

	<div id="primary" class="content-area content-area--services">
		<main id="main" class="site-main" role="main">
			<header class="services-top">
				<h2 class="services__title"><?php logic_department__echo_option( 'ld_services-top-title' ); ?></h2>
				<div class="services__text">
					<p>
						<?php logic_department__echo_option( 'ld_services-top-text' ); ?>
					</p>
				</div>
			</header><!-- .page-header -->
			<div class="page-main flex-row flex-row--link-blocks">
				<?php
					$services = get_categories( array( 'taxonomy' => 'service' ) );
					foreach( $services as $service ) {
						display_service( $service );
					}
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
