<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sgdc
 */

?>

	<footer class="text-center">
		<h3>SUKAGITU</h3>
		<p>© Copyright 2019 - All rights reserved.</p>

		<ul class="social-list">
			<li>
				<a href="/kontak">Kontak</a>
			</li>
			<li>
				<a href="/tentang">Cerita Sukagitu</a>
			</li>
			<li>
				<a href="/privacy-policy">Privacy Policy</a>
			</li>
			<li>
				<a href="/disclaimer">Disclaimer</a>
			</li>
		</ul>
	</footer>

<?php wp_footer(); ?>

	<script src="<?php echo get_template_directory_uri(); ?>/js/all.min.js"></script>

</body>
</html>
