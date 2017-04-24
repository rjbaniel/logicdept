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
					Logic Department is committed to improving usability through better information architecture. We specialize in IA for non-profits and cultural institutions, and we partner with agencies to serve large corporate clients.
				</p>
				<p>
					We know that frustrating interfaces and confusing processes cost everyone time nad money. By balancing user needs and client goals, we create successful solutions that benefit both.
				</p>
				<p>
					We also know that life is too short to spend on staring at a screen. So as a business, Logic Department is dedicated to efficient work, helping both our clients and our employees to enjoy more time living and learning outside of the office.
				</p>
			</div>
			<ul class="flex-row__item about__project-types">
				<p class="project-types__title">
					The Types of Projects We Tackle
				</p>
				<li class="project-types__type">
					Two non-profits have merged and need to combine their content into one website.
				</li>
				<li class="project-types__type">
					A library's website has gotten way too "crowded" and the site's menu options have become overly long.
				</li>
				<li class="project-types__type">
					A museum's growing digital collection has become unwieldy to the point that it's difficult for users to find things.
				</li>
				<li class="project-types__type">
					A design agency is faced with a redesign for an information-heavy website and isn't sure where to start to untangle the complexity.
				</li>
				<li class="project-types__type">
					A large office building with an interactive digital directory needs help figuring out the user flow for presenting maps, office listings, etc.
				</li>
				<li class="project-types__type">
					A small video production company's employees are forgetting vital steps during their shoots and they're unsure how to ensure a standard procedure is followed.
				</li>
				<li class="project-types__type">
					A company has proprietary software that is hard for their employees to use, which wastes the company time and money.
				</li>
			</ul>
		</div>
		<div class="about-team">
			<h1 class="about-team__title">Our Team</h1>
			<img class="about-team__image flex-image" src="<?php echo esc_url( get_theme_mod( 'logic_department__front_page_logo' ) ); ?>">
			<div class="about-team__members flex-row">
				<div class="about-team__member flex-row__item collapsable">
					<div class="team-member__header collapsable__header">
						<p class="team-member__name collapsable__title">
							Sam Raddatz, Founder and Director of Information Architecture
						</p>
						<div class="team-member__toggle collapsable__toggle"></div>
					</div>
					<div class="team-member__bio">
						<p>
							Sam Raddatz is an information architext and the founder of Logic Department. With a background in project management, qualitative sociology and holding a Master's degree in information and Library Science, she tackles any challenge in the most organized and transparent way possible.
						</p>
						<p>
							An active part of the international IA community, Sam was elected to the Information Architecture INstitute's board as Director of Events and Programming where she oversees the coordination of World Information Architecture Day.
						</p>
						<p>
							"I was first motivated to pursue work in IA after reading The Design of Eeveryday Things by Don Norman. It opened my eyes to how good design can influence our expxerience of the world. I'm a strong believer that in daily life, there are design solutions that can make almost every interaction less frustrting &mdash; from opening a door to browsing a website. So I love working on projects that reduce stress for both users and clients."
						</p>
					</div>
				</div>
				<div class="about-team__member flex-row__item collapsable collapsable--hidden">
					<div class="team-member__header collapsable__header">
						<p class="team-member__name collapsable__title">
							Sam Raddatz, Founder and Director
						</p>
						<div class="team-member__toggle collapsable__toggle"></div>
					</div>
					<div class="team-member__bio">
						<p>
							Sam Raddatz is an information architext and the founder of Logic Department. With a background in project management, qualitative sociology and holding a Master's degree in information and Library Science, she tackles any challenge in the most organized and transparent way possible.
						</p>
						<p>
							An active part of the international IA community, Sam was elected to the Information Architecture INstitute's board as Director of Events and Programming where she oversees the coordination of World Information Architecture Day.
						</p>
						<p>
							"I was first motivated to pursue work in IA after reading The Design of Eeveryday Things by Don Norman. It opened my eyes to how good design can influence our expxerience of the world. I'm a strong believer that in daily life, there are design solutions that can make almost every interaction less frustrting &mdash from opening a door to browsing a website. So I love working on projects that reduce stress for both users and clients."
						</p>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();