<?php
/**
 * The template for displaying the Case Studies archive
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logic_Department
 */

get_header(); ?>
	<div id="primary" class="content-area content-area--case-studies">
		<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) : ?>

			<header class="projects-top">
				<h2 class="projects__title">
					<?php echo esc_html( get_theme_mod( 'logic_department__case_studies_title' ) ); ?>
				</h2>
				<div class="projects__text">
					<p>
						<?php echo esc_html( get_theme_mod( 'logic_department__case_studies_description' ) ); ?>
					</p>
				</div>
			</header><!-- .page-header -->

			<div class="page-main projects-container flex-row flex-row--link-blocks">
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
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
			<?php endwhile; ?>
			</div>
			<a href="#" class="projects__load-more-link button-link" id="loadMoreProjects">Show More Projects</a>
			<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
