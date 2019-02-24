<?php
/**
 * Enqueues styles.
 */
function my_styles() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );

	wp_enqueue_script('lazyLoad', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js', array('jquery'), '1.7.4', true);

	wp_enqueue_script('wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/0.1.12/wow.min.js', array('jquery'), '', true);

	wp_enqueue_script('misc', get_stylesheet_directory_uri().'/assets/js/misc.js', array('lazyLoad'), '1.0', true);

}
add_action('wp_enqueue_scripts', 'my_styles');


//Dequeue JavaScripts
function project_dequeue_unnecessary_scripts() {

	wp_dequeue_script( 'touch-swipe' );
	wp_deregister_script( 'touch-swipe' );


}
add_action( 'wp_print_scripts', 'project_dequeue_unnecessary_scripts' );


// Hide Editor on Specific Template Pages
function hide_editor() {
    if( isset($_GET['post']) || isset($_POST['post_ID']) ){
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    }
    if( !isset( $post_id ) ) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if($template_file == 'page-instructors.php'){
        remove_post_type_support('page', 'editor');
    }
}
add_action( 'admin_init', 'hide_editor' );


//Tax Flush Rewrite
function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init', 'custom_taxonomy_flush_rewrite');


//Remove pages editor
function remove_pages_editor(){
    if(get_the_ID() == 263) {
        remove_post_type_support( 'post', 'editor' );
    }
}
add_action( 'add_meta_boxes', 'remove_pages_editor' );


//Rmove comment meta boxes
function my_remove_post_meta_boxes() {
	/* Comments meta box. */
	remove_meta_box( 'commentsdiv','instructors', 'normal' );
	remove_meta_box( 'commentsdiv','testimonials', 'normal' );
	remove_meta_box( 'commentsdiv','courses', 'normal' );
	remove_meta_box( 'commentsdiv','events', 'normal' );
}
add_action( 'add_meta_boxes', 'my_remove_post_meta_boxes' );


//Attempt to change "View All Events" to "View All Courses" on the sidebar button
function filter_translations($translation, $text, $domain) {
	if ($domain == 'tribe-events-calendar') {
		switch ($text) {
			case 'View All Events':
			$translation = 'View All Courses';
			break;
		}
		switch ($text) {
			case 'Venue':
			$translation = 'Location';
			break;
		}
	}
	return $translation;
}
add_filter('gettext', 'filter_translations', 10, 3);


 // Allow SVG uploads
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
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

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


add_action('login_enqueue_scripts', function (){
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css', array(), '1.0' );
});


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


function my_login_logo_url_title() {
    return 'Visit the homepage';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


function login_markup() {
  echo '<div class="icon-forklift"></div>';
}
add_action( 'login_footer', 'login_markup' );


function my_footer_funcs() { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-35976420-1"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());
gtag('config', 'UA-35976420-1');
</script>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4783008.js"></script>
<!-- End of HubSpot Embed Code -->
<script type="text/javascript">
(function(h, o, t, j, a, r) {
    h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments) };
    h._hjSettings = { hjid: 952142, hjsv: 6 };
    a = o.getElementsByTagName('head')[0];
    r = o.createElement('script');
    r.async = 1;
    r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
    a.appendChild(r);
})(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
</script>
<?php }
add_action( 'wp_footer', 'my_footer_funcs', 100 );