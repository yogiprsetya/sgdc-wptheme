<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sgdc
 */

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<div class="container">
				<?php
					printf( esc_html__( 'Search Results for: %s', 'sgdc' ), '<h1>' . get_search_query() . '</h1>' );
				?>
			</div>
		</header>

		<section class="category-page row container">
		<main role="main">
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="http://schema.org/CreativeWork">
				<a href="<?php echo post_permalink() ?>" itemprop="url" rel="bookmark">
					<?php if (has_post_thumbnail( $post->ID ) ):
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large') ?>
						<img data-src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title() ?>" itemprop="image">
					<?php endif; ?>
				</a>

				<header>
					<?php the_title( '<h2 itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" itemprop="url" rel="bookmark">', '</a></h2>' ); ?>
					<?php sgdc_posted_on() ?>

					<div itemprop="text">
						<?php the_excerpt(); ?>
					</div>
				</header>
			</article>
			<?php
				endwhile;
					echo sgdc_get_pagination();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
			?>
		</main>

		<?php get_sidebar(); ?>
	</section>
<?php
get_footer();
