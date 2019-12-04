<section class="related">
  <?php
  $orig_post = $post;
  global $post;
  $categories = get_the_category($post->ID);
  if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 3,
        'caller_get_posts'=> 1
    );
    $my_query = new wp_query( $args );

    if( $my_query->have_posts() ) {
      echo '<h3>Related Posts</h3><div class="row">';

      while( $my_query->have_posts() ) {
          $my_query->the_post();?>

          <article>
            <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
              <?php if (has_post_thumbnail( $post->ID ) ):
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail') ?>
                <img data-src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title() ?>" class="lazy" itemprop="image">
              <?php endif; ?>
            </a>

            <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php  echo substr(get_the_title(), 0, 45) ?></a>
          </article>
    <?php } echo '</div>'; }
  }
  $post = $orig_post;
  wp_reset_query();
  ?>
</section>
