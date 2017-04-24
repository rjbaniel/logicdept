<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Logic_Department
 */

get_header(); ?>
	<div id="primary" class="content-area content-area--case-study">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>
			<div class="case-study-top">
				<h2 class="case-study-top__title"><?php the_title(); ?></h2>
				<div class="case-study-top__text">
					<div class="case-study-top__section">
						<p class="case-study-top__section__title">Challenge</p>
						<?php echo esc_html( get_post_meta( get_the_ID(), '_ld-case-study-challenge', true ) ); ?>
					</div>

					<div class="case-study-top__section">
						<h3 class="case-study-top__section__title">Approach</h3>
						<?php echo esc_html( get_post_meta( get_the_ID(), '_ld-case-study-approach', true ) ); ?>
					</div>

					<div class="case-study-top__section">
						<h3 class="case-study-top__section__title">Result</h3>
						<?php echo esc_html( get_post_meta( get_the_ID(), '_ld-case-study-result', true ) ); ?>
					</div>
				</div>
				<?php
					if ( get_post_meta( get_the_id(), '_ld-case-study-live-link', true ) ) { ?>
						<a href="<?php echo esc_html( get_post_meta( get_the_id(), '_ld-case-study-live-link', true ) ); ?>" class="case-study-top__live-link button-link"><?php _e( 'View the Live Site', 'logic-department' ); ?></a>
					<?php }
				?>
			</div>
			<div class="case-study-main case-study__images flex-row flex-row--link-blocks">
				<?php
		    	$images = get_post_meta( get_the_id(), '_ld-case-study-images', true );
			    if ( empty( $images ) ) {
			    	echo "</div>";
			    	break;
			    }
			    foreach ( $images as $image ) : ?>
			    	<div class="case-study-block flex-row__item link-block">
						<img class="case-study-block__image flex-image" src="<?php echo wp_get_attachment_image_src( $image, 'full' )[0];?>">
						<div class="case-study-block__content">
							<?php 
							    $content = get_post( $image )->post_content;
							    $content = apply_filters( 'the_content', $content );
	  							$content = str_replace( ']]>', ']]&gt;', $content );
	  							echo $content;
							?>
						</div>
					</div>
				<?php
				endforeach;
				?>
			</div>
			<div class="image-overlay" id="imageOverlay">
				<div class="image-overlay__content">
					<img class="image-overlay__image" src="#">
					<div class="image-overlay__text"></div>
				</div>
			</div>
		<?php
		endwhile; // End of the loop.

		/* Projects Navigation Links */
		$projects_query = new WP_Query( array(
			'post_type'=> 'case-study',
			)
		);
		$projects = $projects_query->posts;
		$this_index = $post;
		foreach( $projects as $index => $project ) {
			if ( $post->ID === $project->ID ) {
				$this_index = $index;
			}
		}
		if ( $this_index != 0 )
			$prev_link = get_permalink( $projects[$this_index - 1]->ID );
		
		if ( $this_index != count( $projects ) - 1 )
			$next_link = get_permalink( $projects[$this_index + 1]->ID );

		if ( isset( $next_link ) && ! isset( $prev_link ) ) {
			$project_nav_mod = "just-next";
		} elseif ( !isset( $next_link ) && isset( $prev_link ) ) {
			$project_nav_mod = "just-prev";
		}
		?>
		<div class="project-nav <?php if ( isset( $project_nav_mod ) ) echo 'project-nav--' . $project_nav_mod; ?>">
		<?php
		if ( isset( $prev_link ) ) :
			?>
			<a href="<?php echo esc_url( $prev_link ); ?>" class="project-nav__link project-nav__link--prev">Previous Project</a>
			<?php
		endif;

		if ( isset( $next_link ) ) :
			?>
			<a href="<?php echo esc_url( $next_link ); ?>" class="project-nav__link project-nav__link--next">Next Project</a>
			<?php
		endif;
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
