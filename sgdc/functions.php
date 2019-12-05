<?php
/**
 * sgdc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sgdc
 */

if ( ! function_exists( 'sgdc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sgdc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sgdc, use a find and replace
		 * to change 'sgdc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'sgdc', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'sgdc' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'sgdc_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'sgdc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sgdc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'sgdc_content_width', 640 );
}
add_action( 'after_setup_theme', 'sgdc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sgdc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sgdc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sgdc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'sgdc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sgdc_scripts() {
	wp_enqueue_style( 'sgdc-style', get_stylesheet_uri() );

	// wp_enqueue_script( 'sgdc-navigation', get_template_directory_uri() . '/js/all.min.js', array(), '20151215', true );

	// wp_enqueue_script( 'sgdc-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sgdc_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

// add default class for img-responsive
function add_image_responsive_class($content) {
   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
   $replacement = '<img$1class="$2 lazy"$3>';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}
add_filter('the_content', 'add_image_responsive_class');

add_filter('the_content', 'filter');
function filter($content) {
		// $filtersrc .= get_template_directory_uri() . "/img/spinner.svg";
    return str_replace('src="', 'src="' . get_template_directory_uri() . "/img/spinner.svg" . '" data-src="', $content);
}

// Remove the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false' );

// Remove the calculated image sizes
add_filter( 'wp_calculate_image_srcset', '__return_false' );

// Clean image attrs
// add_filter( 'wp_get_attachment_image_attributes', 'unset_image_sizes');
function unset_image_sizes() {
  if( isset( $attr['sizes'] ) )
    unset( $attr['sizes'] );

  if( isset( $attr['srcset'] ) )
    unset( $attr['srcset'] );
}

// HTML Minify
class HTML_Compression {
	protected $compress_css = true;
	protected $compress_js = true;
	protected $info_comment = true;
	protected $remove_comments = true;
	protected $html;

    public function __construct($html) {
    	if (!empty($html)) {
    		$this->parseHTML($html);
    	}
    }

    public function __toString() {
    	return $this->html;
    }

    protected function bottomComment($raw, $compressed) {
    	$raw = strlen($raw);
    	$compressed = strlen($compressed);
    	$savings = ($raw-$compressed) / $raw * 100;
    	$savings = round($savings, 2);
    	return;
    }

    protected function minifyHTML($html) {
    	$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
    	preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
    	$overriding = false;
    	$raw_tag = false;
    	$html = '';

    	foreach($matches as $token) {
    		$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
    		$content = $token[0];

    		if (is_null($tag)) {
    			if ( !empty($token['script']) ) {
    				$strip = $this->compress_js;
    			} else if (!empty($token['style'])) {
    				$strip = $this->compress_css;
    			} else if ($content == '<!--wp-html-compression no compression-->') {
    				$overriding = !$overriding;
    				continue;
    			} else if ($this->remove_comments) {
    				if(!$overriding && $raw_tag != 'textarea') {
    					$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
            } else {
                if ($tag == 'pre' || $tag == 'textarea') {
                    $raw_tag = $tag;
                } else if ($tag == '/pre' || $tag == '/textarea') {
                    $raw_tag = false;
                } else {
                    if ($raw_tag || $overriding) {
                        $strip = false;
                    } else {
                        $strip = true;
                        $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                        $content = str_replace(' />', '/>', $content);
                    }
                }
            }
            if($strip) {
                $content = $this->removeWhiteSpace($content);
            }
            $html .= $content;
        }

        return $html;
    }

    public function parseHTML($html) {
        $this->html = $this->minifyHTML($html);
        if($this->info_comment) {
            $this->html .= "" . $this->bottomComment($html, $this->html);
        }
    }

    protected function removeWhiteSpace($str) {
        $str = str_replace("\t", '', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);

        while (stristr($str, '  ')) {
            $str = str_replace('  ', '', $str);
        }
        return $str;
    }
}

function wp_html_compression_finish($html) {
    return new HTML_Compression($html);
}

function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
}

add_action('get_header', 'wp_html_compression_start');
