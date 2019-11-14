<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sgdc
 */

get_header();
?>

	<main role="main">

		<?php get_template_part( 'template-parts/features/featured-category'); ?>
		<?php get_template_part( 'template-parts/features/fresh-post'); ?>
		<?php get_template_part( 'template-parts/features/popular-today'); ?>

	</main>

<?php

get_footer();
