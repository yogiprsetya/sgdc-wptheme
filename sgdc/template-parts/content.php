<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sgdc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

	<?php the_post_thumbnail('featured-image'); ?>

	<header>
		<span class="post-category">
			<?php $category = get_the_category();
				if ( $category[1] ) {
					echo '<a href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->cat_name . '</a> ';
				} if ( $category[0] ) {
					echo ' <a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
				}
			?>
		</span>

		<?php
			if ( is_singular() ) :
				the_title( '<h1 itemprop="headline">', '</h1>' );
			else :
				the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
		?>

			<div class="entry-meta">
				<?php sgdc_posted_on() ?>. Ditulis oleh <?php sgdc_posted_by(); endif; ?>
			</div>
	</header>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sgdc' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>
	</div>

	<div class="content-foot">
		<?php
			the_tags('<ul class="post-tags"><li>', '</li><li>', '</li></ul>');
			get_template_part( 'template-parts/features/share-button');
		?>
	</div>

	<div class="entry-footer">
		<?php the_post_navigation(array(
			'prev_text' => __( '<span>< Previous post</span> %title' ),
			'next_text' => __( '<span>Next post ></span> %title' )
			));
		?>
	</div>
</article>

<?php get_template_part( 'template-parts/features/related'); ?>
