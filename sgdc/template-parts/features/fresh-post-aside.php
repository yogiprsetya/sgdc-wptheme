<section class="new-post-aside">
  <div class="container">
    <h3>Latest Stories</h3>

    <div class="row">
      <?php $arr_posts = new WP_Query(array(
          'posts_per_page' => 5,
        ));

        while($arr_posts->have_posts()) :
          $arr_posts->the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <header>
                <span>
                  <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
                </span>

                <a href="<?php echo post_permalink() ?>" rel="bookmark">
                  <h2><?php the_title(); ?></h2>
                </a>
              </header>
          </article>
        <?php endwhile;
      ?>
    </div>
  </div>
</section>
