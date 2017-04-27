<?php
/**
 * The template for the home page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logic_Department
 */

get_header();

?>

	<div id="primary" class="content-area content-area--front-page">
		<main id="main" class="site-main" role="main">
			<div class="home-top flex-row">
				<img class="home-top__large-image flex-image flex-row__item" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
				<div class="home-top__main flex-row__item">
					<h1 class="home-top__title"><?php logic_department__echo_option( 'ld_home-top-title' ); ?></h1>
					<img class="home-top__image" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
					<div class="home-top__statement">
						<?php //echo sanitize_text_field( get_theme_mod( 'logic_department__front_page_statement' ) );
							logic_department__echo_option( 'ld_home-top-text' );
						?>
					</div>
					<a href="/about" class="home-top__more-link button-link button-link--no-border">More About Us</a>
				</div>
			</div>
			<div class="flex-row">
			<div class="home-services flex-row__item">
				<div class="home-services__lists">
					<ul class="home-services__list collapsable">
						<div class="home-services-list__header collapsable__header">
							<p class="home-services-list__title collapsable__title">What we do</p>
							<div class="collapsable__toggle">
								<span class="collapsable__toggle-line"></span>
								<span class="collapsable__toggle-line"></span>
							</div>						
						</div>
						<?php logic_department__echo_option( 'ld_home-what-we-do' ); ?>
					</ul>
					<ul class="home-services__list home-services__list--hidden collapsable collapsable--hidden">
						<div class="home-services-list__header collapsable__header">
							<p class="home-services-list__title collapsable__title">What we don't do</p>
							<div class="collapsable__toggle">
								<span class="collapsable__toggle-line"></span>
								<span class="collapsable__toggle-line"></span>
							</div>						
						</div>
						<?php logic_department__echo_option( 'ld_home-dont-do' ); ?>
					</ul>
				</div>
				<a href="services" class="home-services__more-link button-link"><span class="more-link__extended">Learn More About </span>Our Services</a>
			</div>

			<div class="home-image-grid flex-row__item">
				<?php
				for ( $i = 0; $i < 4; $i++ ) :
					$image_url = get_theme_mod( 'logic_department__home-image-' . $i );
				?>
					<img class="home-image-grid__image flex-image" src="<?php echo esc_url( $image_url ); ?>">
				<?php
				endfor;
				?>
			</div>
			</div>
			<?php display_clients(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();