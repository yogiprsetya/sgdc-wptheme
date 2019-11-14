<section class="new-post-home">
  <div class="container">
    <h3 class="text-center">Fresh Stories</h3>

    <div class="row">
      <?php $arr_posts = new WP_Query(array(
          'posts_per_page' => 4,
        ));

        while($arr_posts->have_posts()) :
          $arr_posts->the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope>
            <a href="<?php echo post_permalink() ?>" itemprop="url" rel="bookmark">
              <?php
                if(has_post_thumbnail()) :
                  the_post_thumbnail('medium', ['class' => 'lazy']);
                endif;
              ?>
              <header>
                <span>
                  <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
                </span>

                <h2 itemprop="headline"><?php the_title(); ?></h2>

                <p class="post-info">
                  <?php the_author_posts_link(); ?> |
                  <a href="<?php comments_link(); ?>"><?php comments_number(' 0 Comments',' 1 Comment',' % Comments'); ?></a>
                </p>
              </header>
            </a>
          </article>
        <?php endwhile;
      ?>
    </div>
  </div>
</section>
