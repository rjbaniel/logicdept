<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logic_Department
 */

?>

	</div><!-- #content -->
	<?php get_endorsements(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		if ( is_page( 'services' ) ) {
			$footer_text = 'More Services Available!';
		} elseif ( is_archive() && get_post_type() == 'case-study' ) {
			$footer_text = "Looking for Information Architects?";			
		} elseif ( is_single() && get_post_type() == "case-study" ) {
			$footer_text = "Are you a Non-Profit business?";
		} else {
			$footer_text = 'How can we help?';
		}
		?>
		<p class="footer-text"><?php echo $footer_text; ?> <a href="contact-us" class="footer-text__link">Contact Us</a></p>
		<p class="footer-copyright">&copy; 2016, Logic Department, LLC, 594 Dean Street, Brooklyn NY 11238</p>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
