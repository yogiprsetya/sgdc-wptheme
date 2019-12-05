<section class="container popular-today">
  <h3 class="text-center">Today Hot Story</h3>

  <div class="row">
    <?php
      $popular = new WP_Query(array(
        'posts_per_page' => 4,
        'meta_key' => 'popular_posts',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'date_query' => array(
          array(
            'after' => array(
              'year'  => date('Y', '-1 day' ),
              'month' => date('m', '-1 day' ),
              'day'   => date('d', '-1 day' ),
            ),
          )
        )
      ));

      while ($popular->have_posts()) : $popular->the_post();
    ?>

    <article itemscope itemtype="http://schema.org/CreativeWork">
      <?php if (has_post_thumbnail( $post->ID ) ):
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail') ?>
        <img data-src="<?php echo $image[0]; ?>" src="<?php echo get_template_directory_uri() . '/img/spinner.svg' ?>" class="lazy size-featured-image" alt="<?php echo get_the_title() ?>" itemprop="image">
  	  <?php endif; ?>

      <span>
        <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
      </span>

      <h2 itemprop="headline"><a itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>

      <div class="post-info">
        <?php the_author_posts_link(); ?> |
        <a href="<?php comments_link(); ?>"><?php comments_number(' 0 Comments',' 1 Comment',' % Comments'); ?></a>
      </div>

      <p>
        <?php echo excerpt(25);?>
      </p>
    </article>

    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
