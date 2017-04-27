<?php
/**
 * The template for displaying the Contact page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logic_Department
 */

get_header(); ?>

<div id="primary" class="content-area content-area--contact-us">
	<main id="main" class="site-main site-main--contact" role="main">
		<div class="contact-row flex-row">
		<div class="contact-top flex-row__item">
			<div class="contact-top__text">
				<?php
					logic_department__echo_option( 'ld_contact-us-text' );
				?>
			</div>
			<div class="contact-top__social-media">
				<a href="<?php echo esc_url( get_theme_mod( 'logic_department__linked_in_link' ) ); ?>" class="contact-social-media__link">
					<img src="<?php echo get_template_directory_uri() . '/icons/linked-in.svg'; ?>" class="contact-social-media__link-icon">
				</a>
				<a href="<?php echo esc_url( get_theme_mod( 'logic_department__twitter_link' ) ); ?>" class="contact-social-media__link">
					<img src="<?php echo get_template_directory_uri() . '/icons/twitter.svg'; ?>" class="contact-social-media__link-icon">
				</a>
			</div>
		</div>
		<div class="contact-form flex-row__item">
			<div><?php smuzform_render_form( 103 ) ?></div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
