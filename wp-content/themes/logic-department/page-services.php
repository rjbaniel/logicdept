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
			<header class="page-top">
				<?php while ( have_posts() ) : the_post(); ?>
				<h2 class="page-top__title"><?php the_title(); ?></h2>
				<div class="page-top__text"><?php the_content();?></div>
				<?php endwhile; ?>
			</header>
			<div class="page-main services masonry-container">
				<?php
					$services = get_categories( array( 'taxonomy' => 'service' ) );
					$last_height = 0;
					foreach( $services as $service ) {
						display_service( $service, $last_height );
					}
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
