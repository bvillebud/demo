<?php
/**
 * webco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package webco
 */

if ( ! function_exists( 'webco_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function webco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on webco, use a find and replace
		 * to change 'webco' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'webco', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'webco' ),
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
		add_theme_support( 'custom-background', apply_filters( 'webco_custom_background_args', array(
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
add_action( 'after_setup_theme', 'webco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function webco_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'webco_content_width', 640 );
}
add_action( 'after_setup_theme', 'webco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function webco_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'webco' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'webco' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'webco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function webco_scripts() {
	wp_enqueue_style( 'webco-style', get_stylesheet_uri() );
	wp_enqueue_style('roboto-condensed', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');
	wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,700');
	
	
	wp_enqueue_script( 'jq-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(),'', true );
	wp_enqueue_script( 'webco-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'webco-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
wp_enqueue_script( 'webco-misc', get_template_directory_uri() . '/js/misc.js', array('jq-ui'), '1.2', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'webco_scripts', 1000, 1 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'widget_text', 'do_shortcode' );

// Allow SVG - added by Kyle
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

global $wp_version; if( (float) $wp_version < 4.9 ) { return $data; }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
//admin area styles
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
		#webco-products-admin a, #webco_industries h3, #webco_creating_value a{
			display: inline-block;
    		margin-left: 5px;
		    text-decoration: none;
			color: #000;
		}
		#webco-products-admin a img, #webco_creating_value img{display:none;}
		#webco-products-admin a h3, #webco_industries h3, #webco_creating_value h3{
			margin: 2px 0px;
		    position: relative;
		    top: 2px;
			font-size:1em;
		}
		#webco_industries h3{ margin-left: 5px;}
		/*#postdivrich, .fl-builder-admin-tabs a:first-child{ display: none; }*/
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

//[sidebar]
function sidebar_func( $atts ){
	global $wp_query;
	$pages = '';
	$has_parent = false;
  if( empty($wp_query->post->post_parent) ) {
    $parent = $wp_query->post->ID; //has no parent
  } else {
	  $has_parent = true;
    $parent = $wp_query->post->post_parent; //does have a parent
  }
	//careers ID 402
	$what_parent = new WP_Query( array( 'page_id' => $parent ) );
	if ( $what_parent->have_posts() ) { while ( $what_parent->have_posts() ) { 
		$what_parent->the_post();
		$parent_name = get_the_title();
		$parent_link = get_the_permalink(); 
	  //echo $parent_name;
	}
		wp_reset_postdata();
	}
	
  if( $has_parent ) {
	$pages = '<aside>';
	$pages .= "<li><a href='{$parent_link}'>{$parent_name}</a></li>";
    $pages .= wp_list_pages("title_li=&depth=1&child_of=$parent&echo=0" );
	 
	if( $parent_name == 'Careers'){
		$pages .= "<li><a target='_blank' href='https://www.paycomonline.net/v4/ats/web.php/jobs?clientkey=FA1535D67F2CF68FC586A92C051C9744'>Job Listings</a></li>";
	}
	elseif( $parent_name == 'Webco: A Forever Kind of Company'){
		$pages .= "<li><a href='/terms-and-conditions'>Terms & Conditions</a></li>";
	}
	elseif( $parent_name == 'Product Types'){
		$pages .= "<li><a href='/cold-drawn-welded'>Cold Drawn &ndash; Welded</a></li>";
	}
	elseif( $parent_name == 'Power-Gen Tubing'){
		$pages .= "<li><a href='/feed-water-heater'>Feed Water Heater</a></li>";
		$pages .= "<li><a href='/steam-surface-condenser'>Steam Surface Condenser</a></li>";
	}
	  
	$pages .= '</aside>';
  }
	return $pages;
}
add_shortcode( 'sidebar', 'sidebar_func' );

/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p( $content ) {
	$content = force_balance_tags( $content );
	$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
	$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
	return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

function admin_styles() {
//login page
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css', array(), '1.0' );
}
add_action( 'login_enqueue_scripts', 'admin_styles' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Visit the Webco homepage';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function login_markup() {
  echo '<div class="icon-forklift"></div>';
}
//add_action( 'login_footer', 'login_markup' );

