<?php
/**
 * The template for the about page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logic_Department
 */

get_header();

?>
<div id="primary" class="content-area content-area--about-page">
	<main id="main" class="site-main" role="main">
		<div class="flex-row about-top">
			<div class="flex-row__item about-top__intro">
				<p class="about-intro__highlighted">
					<?php logic_department__echo_option( 'ld_about-intro-highlighted' ); ?>
				</p>
				<?php logic_department__echo_option( 'ld_about-intro-regular' ); ?>
			</div>
			<ul class="flex-row__item about__project-types">
				<p class="project-types__title">
					The Types of Projects We Tackle
				</p>
				<?php logic_department__echo_option( 'ld_about-services-offered' ); ?>
			</ul>
		</div>
		<div class="about-team">
			<h1 class="about-team__title">Our Team</h1>
			<img class="about-team__image flex-image" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
			<div class="about-team__members flex-row">
				<div class="collapsable collapsable--team-member flex-row__item">
					<div class="collapsable__header">
						<p class="collapsable__title">
							<?php logic_department__echo_option( 'ld_about-team-member-1-name' ); ?>
						</p>
						<div class="collapsable__toggle">
							<span class="collapsable__toggle-line"></span>
							<span class="collapsable__toggle-line"></span>
						</div>
					</div>
					<div class="team-member__bio">
						<?php logic_department__echo_option( 'ld_about-team-member-1-bio' ); ?>
					</div>
				</div>
				<div class="collapsable collapsable--team-member collapsable--hidden flex-row__item">
					<div class="collapsable__header">
						<p class="collapsable__title">
							<?php logic_department__echo_option( 'ld_about-team-member-2-name' ); ?>
						</p>
						<div class="collapsable__toggle">
							<span class="collapsable__toggle-line"></span>
							<span class="collapsable__toggle-line"></span>
						</div>
					</div>
					<div class="team-member__bio">
						<?php logic_department__echo_option( 'ld_about-team-member-2-bio' ); ?>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();