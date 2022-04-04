<?php
/**
 * arbah functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package arbah
 */

if ( ! function_exists( 'arbah_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 */
function arbah_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on arbah, use a find and replace
	 * to change 'arbah' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'arbah', get_template_directory() . '/languages' );

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
	add_image_size( 'feat-thumb', 400, 230, true);
	add_image_size( 'small-thumb', 240, 120, true);
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 150,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'image',
		'video',
		'audio',
	) );
	
	// This theme uses wp_nav_menu() in 4 locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Header Menu', 'arbah' ),
		'secondary' => esc_html__( 'Mobile Menu', 'arbah' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'arbah' ),
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

	// Load theme updater functions.
	require( get_template_directory() . '/inc/updater/theme-updater.php' );
}
endif;
add_action( 'after_setup_theme', 'arbah_setup' );

/**
 * Set the content width in pixels
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function arbah_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'arbah_content_width', 760 );
}
add_action( 'after_setup_theme', 'arbah_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function arbah_widgets_init() {
	

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'arbah' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'arbah' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arbah_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function arbah_scripts() {
	
	wp_enqueue_script('hoverIntent');


	wp_enqueue_style( 'arbah-style', get_stylesheet_uri() );

		

	if (( is_front_page()  &&  get_theme_mod('show_homepage_slider', '1' ) == 1)  || (is_single() && get_theme_mod('show_random_posts_slider', '1') == 1 ) ) {
		
		wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/css/slick.css', array(), '1.8.0' );
	
		wp_enqueue_script( 'slick-js', get_template_directory_uri () . '/js/slick.min.js', array( 'jquery' ), '', true );
	}
	
	
    if (!is_rtl() ) {
    	$arbah_font_args = array(
	        'family' => 'Open+Sans:400,700|Work+Sans:700',
	    );
        wp_enqueue_style( 'arbah-google-fonts', add_query_arg( $arbah_font_args, "//fonts.googleapis.com/css" ) );
    }
	
	if ( get_theme_mod('make_sidebars_sticky', '1') == 1 )  {
		wp_enqueue_script( 'arbah-sticky-kit', get_template_directory_uri() . '/js/jquery.sticky-kit.min.js', array(), '1.1.2', true );
	}
		
	wp_enqueue_script( 'arbah-scripts', get_template_directory_uri() . '/js/arbah-scripts.js', array('jquery'), '', true );

	wp_enqueue_script( 'arbah-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod('arbah_adze_readmore', '') && get_post_meta( get_the_ID(), 'arbah_readmore_button', true ) ) {
		wp_enqueue_script( 'arbah-readmore', get_template_directory_uri() . '/js/readmore.js', array(), '', true );
	}
		
}
add_action( 'wp_enqueue_scripts', 'arbah_scripts' );


if ( ! function_exists( 'arbah_add_footer_styles' ) ) :
/**
 * Call css files in  footer
 */
function arbah_add_footer_styles() {
	wp_enqueue_style( 'font-awesome-icons', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.3' );
};
add_action( 'get_footer', 'arbah_add_footer_styles' );
endif;



if ( ! function_exists( 'arbah_add_footer_scripts' ) ) :
/**
 * Call script functions in  footer
 */
function arbah_add_footer_scripts() { ?>
<script>
/* <![CDATA[ */

	(function($) {

		jQuery(document).ready(function($) {
			<?php if ( get_theme_mod('arbah_adze_readmore', '') && get_post_meta( get_the_ID(), 'arbah_readmore_button', true ) )  : ?>

				new Readmore('.article-content', {
					moreLink: '<a href="#"><?php _e('Continue Reading', 'arbah'); ?></a>',
					speed: 75,
					lessLink: '',
					collapsedHeight: 450,
				});
			<?php endif; ?>
			
			<?php if ( get_theme_mod('arbah_adblock_detector', '0') == 1 ) : ?>
			 	if ( typeof $RunAds === 'undefined' ) {
					setTimeout(function(){ $('body').addClass('arbah-popup-active');},10);
					$('#arbah-popup-adblock').show();
			 	}
	
			<?php endif; ?>

		 	<?php if ( get_theme_mod('make_sidebars_sticky', '1') == 1 ) : ?>
	 			if($(window).width() >= 992) {
					$(".widget-area").stick_in_parent();
			    }
			<?php endif; ?>

		});

	})(jQuery);
/* ]]> */
</script>
<?php
}
endif;

add_action( 'wp_footer', 'arbah_add_footer_scripts' );


/**
 * Load scripts inside Wordpress dahsboard.
 */
function arbah_image_uploader() {
    wp_enqueue_media();
    wp_enqueue_script('arbah-widget-image-upload', get_template_directory_uri() . '/js/image-uploader.js', false, '20150309', true);
}
add_action('admin_enqueue_scripts', 'arbah_image_uploader');


/**
 * Convert page links to prev/next links
 *
 */
function arbah_wp_link_pages( $output, $args ) { 
    global $page, $numpages, $multipage, $more;
    

    $defaults = array(
      'before' => '<nav class="prev-next-posts clear"><span class="prev-next-title">'.$page. __(' of ', 'arbah') .$numpages.'</span>',
      'after' => '</nav>',
      'link_before' => '<span class="page-link" data_page="'.$page .'">',
      'link_after' => '</span>',
      'next_or_number' => 'next',
      'separator' => ' ',
      'nextpagelink' => '<i class="fa fa-angle-right"></i>',
      'previouspagelink' => '<i class="fa fa-angle-left"></i>',
      );
    $params = wp_parse_args( $args, $defaults );

    /**
     * Filters the arguments used in retrieving page links for paginated posts.
     *
     * @since 3.0.0
     *
     * @param array $params An array of arguments for page links for paginated posts.
     */
    $r = apply_filters( 'wp_link_pages_args', $params );
    

    $output = '';
    if ( $multipage ) {
      if ( $more ) {
			$ad_code = get_theme_mod('arbah_adze_prev_next');
			if ( get_theme_mod('arbah_adze_prev_next', '') ) {
				$output .= '<div class="prev-next-adze" >'. $ad_code . '</div>';
			}
		
          $output .= '<nav class="prev-next-posts clear"><span class="prev-next-title">'.$page. __(' of ', 'arbah') .$numpages.'</span>';
          $prev = $page - 1;

          if ( $prev > 0 ) {
            $link = _wp_link_page( $prev ) .'<span class="page-link pre">'. $r['previouspagelink'] . '</span>' . '</a>';

            /** This filter is documented in wp-includes/post-template.php */
            $output .= apply_filters( 'wp_link_pages_link', $link, $prev );
          }

          $next = $page + 1;
          
          if ( $next <= $numpages ) {
            if ( $prev ) {
              $output .= $r['separator'];
            }
            $link = _wp_link_page( $next ) . '<span class="page-link next">' . $r['nextpagelink'] . '</span>' . '</a>';

            /** This filter is documented in wp-includes/post-template.php */
            $output .= apply_filters( 'wp_link_pages_link', $link, $next );
          }

          $output .= '</nav>';
        }
      }

    print_r($output); 
  
    }
add_filter('wp_link_pages', 'arbah_wp_link_pages',  10, 2);



/**
 * Load widgets for this theme.
 */
require_once (get_template_directory() . "/inc/widgets/sidebar-posts-list.php");
require_once (get_template_directory() . "/inc/widgets/social-profiles.php");
require_once (get_template_directory() . "/inc/widgets/ads.php");

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory(). '/inc/super-menu.php';

/**
 * Add custom fields.
 */
require get_template_directory() . '/inc/arbah-custom-fields.php';


/**
 * Install Required Plugins
 */
require get_template_directory() . '/inc/tgm/arbah-tgmpa.php';


/**
 * Load demo data importer file
*/

require trailingslashit( get_template_directory() ) . '/inc/import/arbah-demos.php';
