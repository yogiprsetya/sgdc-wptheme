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