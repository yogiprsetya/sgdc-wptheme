<section class="new-post-home">
  <div class="container">
    <h3 class="text-center">Fresh Stories</h3>

    <div class="row">
      <?php $arr_posts = new WP_Query(array(
          'posts_per_page' => 4,
        ));

        while($arr_posts->have_posts()) :
          $arr_posts->the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/CreativeWork">
            <a href="<?php echo post_permalink() ?>" itemprop="url" rel="bookmark">
              <?php if (has_post_thumbnail( $post->ID ) ):
          		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium') ?>
          		<img data-src="<?php echo $image[0]; ?>" class="lazy" src="<?php echo get_template_directory_uri() . '/img/spinner.svg' ?>" alt="<?php echo get_the_title() ?>" itemprop="image">
          	  <?php endif; ?>
              <header>
                <span>
                  <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
                </span>

                <h2 itemprop="headline"><?php the_title(); ?></h2>

                <p class="post-info">
                  <?php the_author_posts_link(); ?> | <a href="<?php comments_link(); ?>"><?php comments_number(' 0 Comments',' 1 Comment',' % Comments'); ?></a>
                </p>
              </header>
            </a>
          </article>
        <?php endwhile;
      ?>
    </div>
  </div>
</section>
