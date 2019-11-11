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
	
	<main class="">

		<section class="container featured-category">
			<div class="item-list">
				<img src="<?php echo get_template_directory_uri() . '/img/suka-travel.jpg' ?>" alt="suka travel">
				<div class="hover-post text-center">
					<a class="category-link" href="category/wisata">Suka Travel</a>
					<p>Nyari duit mulu, kapan ngabisinnya.</p>
				</div>
			</div>

			<div class="item-list">
				<img src="<?php echo get_template_directory_uri() . '/img/suka-jajan.jpg' ?>" alt="suka jajan">
				<div class="hover-post text-center">
					<a class="category-link" href="category/wisata">Suka Jajan</a>
					<p>Dietnya nanti aja, yuk mempertebal body.</p>
				</div>
			</div>

			<div class="item-list">
				<img src="<?php echo get_template_directory_uri() . '/img/inspirasi.jpg' ?>" alt="inspirasi">
				<div class="hover-post text-center">
					<a class="category-link" href="category/wisata">Inspirasi</a>
					<p>Buntu ide?, carilah inspirasi disini.</p>
				</div>
			</div>
		</section>

		<?php get_template_part( 'template-parts/features/fresh-post'); ?>

	</main>

<?php

get_footer();
