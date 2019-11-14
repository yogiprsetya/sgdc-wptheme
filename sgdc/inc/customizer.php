<?php
/**
 * sgdc Theme Customizer
 *
 * @package sgdc
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sgdc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sgdc_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sgdc_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'sgdc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sgdc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sgdc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sgdc_customize_preview_js() {
	wp_enqueue_script( 'sgdc-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sgdc_customize_preview_js' );

function deregister_scripts() {
	wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'deregister_scripts');

function remove_wp_block_library_css() {
	wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library_css');

// Remove WP-Emoji Class
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ", $excerpt);
  } else {
    $excerpt = implode(" ", $excerpt);
	}

  $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
  return $excerpt;
}

// Make popular post
function count_post_visits($post_id) {
	$count_key = 'popular_posts';
	$count = get_post_meta($post_id, $count_key, true);

	if($count == '') {
		$count = 0;
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
	} else {
		$count++;
		update_post_meta($post_id, $count_key, $count);
	}
}

function track_post_visits($post_id) {
	if(!is_single()) return;

	if(empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}

	count_post_visits($post_id);
}
add_action('wp_head', 'track_post_visits');

// Custome comment form
function wpsites_comment_form_fields( $fields ) {
  unset($fields['author']);
  unset($fields['email']);
  unset($fields['comment_field']);
	unset($fields['url']);

	$fields['author'] = '<div class="row"><input required id="author" name="author" placeholder="My name is .." type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />';
	$fields['email']  = '<input required id="email" name="email" placeholder="My email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div>';
  $fields['comment_field'] = '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="Write a comment ..." required></textarea>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'wpsites_comment_form_fields' );

function remove_comment_field( $defaults ) {
	$defaults['comment_field'] = '';
	$defaults['title_reply'] = 'Tulis Komentar';
	$defaults['title_comment'] = 'Tulis Komentar';
	$defaults['comment_notes_before'] = '';
	$defaults['class_submit'] = 'btn';
	$defaults['label_submit'] = 'SEND COMMENT';
  return $defaults;
}
add_filter( 'comment_form_defaults', 'remove_comment_field', 10, 1 );

// Custom comments list
function not_default_comments( $comment, $args, $depth ) {
  global $post;
  $author_id = $post->post_author;
  $GLOBALS['comment'] = $comment;
  ?>

  <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>">
      <div class="comment-author">
        <?php echo get_avatar( $comment, 45 ); ?>
      </div>

      <div class="comment-details">
        <header class="comment-meta">
					<div class="comment-reply-link">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => esc_html__( 'Reply'),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'] )
						) ); ?>
					</div>
					<cite><?php comment_author_link(); ?></cite>

          <?php printf( '<time datetime="%2$s">%3$s</time>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            sprintf( _x( '%1$s', '1: date', 'twenties' ), get_comment_date() )
					); ?>
        </header>

        <?php if ( '0' == $comment->comment_approved ) : ?>
          <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'twenties' ); ?></p>
        <?php endif; ?>

        <div class="comment-content">
          <?php comment_text(); ?>
        </div>
      </div>
    </article>
  <?php
}

add_filter( 'get_the_archive_title', function ($title) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
	} elseif ( is_tax() ) {
		$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
	}
	return $title;
});

// Pagination number mode
function sgdc_get_pagination(){
	global $wp_rewrite;
	global $wp_query;
	return paginate_links( apply_filters('args', array(
		'base'      => str_replace('99999', '%#%', esc_url(get_pagenum_link(99999))),
		'format'    => $wp_rewrite->using_permalinks() ? 'page/%#%' : '?paged=%#%',
		'current'   => max(1, get_query_var('paged')),
		'total'     => $wp_query->max_num_pages,
		'prev_text' => 'PREV PAGE',
		'next_text' => 'NEXT PAGE',
		'type'      => 'list'
	)));
}

