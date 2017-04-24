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
					<h1 class="home-top__title">We turn frustraing messes into elegant systems.</h1>
					<img class="home-top__image" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
					<div class="home-top__statement">
						<?php //echo sanitize_text_field( get_theme_mod( 'logic_department__front_page_statement' ) );
							echo html_entity_decode( get_option( 'homepage-statement' ), ENT_HTML5 );
						?>
					</div>
					<a href="#" class="home-top__more-link button-link">More About Us</a>
				</div>
			</div>
			<div class="flex-row">
			<div class="home-services flex-row__item">
				<div class="home-services__lists">
					<ul class="home-services__list collapsable">
						<div class="home-services-list__header collapsable__header">
							<p class="home-services-list__title collapsable__title">What we do</p>
							<div class="home-services-list__toggle collapsable__toggle"></div>
						</div>
						<li class="home-services-list__item">Expert Usability Reviews</li>
						<li class="home-services-list__item">Heuristic Reviews</li>
						<li class="home-services-list__item">Scope Definition</li>
						<li class="home-services-list__item">Site Maps</li>
						<li class="home-services-list__item">Stakeholder Interviews</li>
						<li class="home-services-list__item">Taxonomy Creation</li>
						<li class="home-services-list__item">User Flows</li>
						<li class="home-services-list__item">User Interviews</li>
						<li class="home-services-list__item">User Testing</li>
						<li class="home-services-list__item">Wireframing</li>
						<li class="home-services-list__item">Wordpress Consulting</li>
					</ul>
					<ul class="home-services__list home-services__list--hidden collapsable collapsable--hidden">
						<div class="home-services-list__header collapsable__header">
							<p class="home-services-list__title collapsable__title">What we don't do</p>
							<div class="home-services-list__toggle collapsable__toggle"></div>
						</div>
						<li class="home-services-list__item">App Development</li>
						<li class="home-services-list__item">Coding</li>
						<li class="home-services-list__item">Copywriting</li>
						<li class="home-services-list__item">Content Creation</li>
						<li class="home-services-list__item">User Interface Design</li>
						<li class="home-services-list__item">Interaction Design</li>
						<li class="home-services-list__item">Technical Architecture</li>
						<li class="home-services-list__item">Bulding Architecture</li>
					</ul>
				</div>
				<a href="services" class="home-services__more-link button-link"><span class="more-link__extended">Learn More About </span>Our Services</a>
			</div>

			<div class="home-image-grid flex-row__item">
				<?php
				for ( $i = 0; $i < 4; $i++ ) :
				?>
					<img class="home-image-grid__image flex-image" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
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