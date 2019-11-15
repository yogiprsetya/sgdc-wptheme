<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sgdc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php sgdc_post_thumbnail(); ?>

	<?php the_title( '<h1 itemprop="headline">', '</h1>' ); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sgdc' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->


</article>
