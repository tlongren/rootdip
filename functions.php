<?php
require_once ( get_template_directory() . '/theme-options.php' );

// Setup options
add_action( 'wp_head', 'html5press_layout_view' );
function html5press_layout_view() {
	$options = html5press_get_options();
}

if ( ! isset( $content_width ) ) $content_width = 580;

// Set html5press version
define( 'html5press_version', '2.5.3' );
function html5press_getinfo( $show = '' ) {
		$output = '';

		switch ( $show ) {
			case 'version' :
			$output = html5press_version;
					break;
		}
		return $output;
}

// Setup theme basics
add_action( 'after_setup_theme', 'html5press_theme_setup' );
function html5press_theme_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'html5press', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	add_theme_support( 'post-formats', array( 'link','quote','status' ) ); // support for post formats
	add_theme_support( 'post-thumbnails' ); // post thumbnails
	register_nav_menu( 'main-menu', __('Main Menu','html5press') ); // navigation menus
	add_theme_support( 'automatic-feed-links' ); // automatic feeds
	add_image_size( 'bxthumb', 200, 200, true ); // featured post slider image size
	$backgroundDefaults = array(
		'wp-head-callback'       => 'html5press_custom_background_callback'
	);
	add_theme_support( 'custom-background', $backgroundDefaults ); // enable custom backgrounds
	add_editor_style( '/css/editor-style.css' );
}

// Register all the javascript
add_action( 'wp_enqueue_scripts', 'html5press_register_scripts' );
function html5press_register_scripts() {
   
	/**
	 * Modernizr enables HTML5 elements & feature detects
	 * For optimal performance, use a custom Modernizr build: www.modernizr.com/download/
	 */
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr-2.6.1.min.js', '', '2.0.6' );

	// Make sure jQuery is loaded after Modernizr
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array( 'modernizr' ), null );
	wp_enqueue_script( 'easing', get_stylesheet_directory_uri() . '/js/easing.min.js', array( 'jquery' ), '1.1.2', true );

	$options = html5press_get_options();

	// If back to top is enabled, add easing and the back to top javascript.
	if ( $options['back_to_top'] == 1 ) {
		wp_enqueue_script( 'totop', get_stylesheet_directory_uri() . '/js/jquery.ui.totop.js', array( 'jquery' ), '1.1', true );
	}

	if ( $options['enable_slimbox'] == 1 ) {
		wp_enqueue_script( 'slimbox2', get_stylesheet_directory_uri() . '/js/slimbox2.js', array( 'jquery' ), '2.04', true );
	}

	if ( !empty($options['featured_cat']) ) {
		wp_enqueue_script( 'bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxSlider.min.js', array( 'jquery' ), '3.0', true );
		wp_enqueue_script( 'bxslider-load', get_stylesheet_directory_uri() . '/js/bxslider-load.js', array( 'bxslider' ), '1.0', true );
	}
	
	if ( $options['fuzzy_timestamps'] == 1 ) {
		wp_enqueue_script( 'timeago', get_stylesheet_directory_uri() . '/js/jquery.timeago.js', array( 'jquery' ), '0.9.3', true );
	}
}

// Register styles to accompany the scripts above
add_action( 'wp_enqueue_scripts', 'html5press_register_styles' );

function html5press_register_styles() {
	$options = html5press_get_options();

	if ( !empty($options['featured_cat']) ) {
		wp_enqueue_style( 'bxslider-style', get_stylesheet_directory_uri().'/css/bx_styles.css');
	}

	if ( $options['enable_slimbox'] == 1 ) {
		wp_enqueue_style( 'slimbox2-style', get_stylesheet_directory_uri().'/css/slimbox2.css');
	}
	wp_enqueue_style( 'html5press-style', get_stylesheet_directory_uri().'/css/html5press.css');
	wp_enqueue_style( 'fonts', get_stylesheet_directory_uri().'/css/fonts/'.$options['theme_font'].'.css');
}

// Load custom javascript
add_action('wp_footer', 'html5press_load_scripts');
function html5press_load_scripts() {
	$options = html5press_get_options();
	if ($options['back_to_top'] == 1) { ?>
		<script type="text/javascript">
	jQuery(document).ready(function() {		
		jQuery().UItoTop({ easingType: 'easeOutQuart',text: 'Back To Top',min: '300'});
	});
	</script>
<?php
	}
	if ($options['fuzzy_timestamps'] == 1) { ?>
		<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("time.timeago").timeago();
	});
	</script>
<?php
	}
}

// Add theme support for infinity scroll
function html5press_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'content',
        'render'    => 'html5press_infinite_scroll_render',
        'footer'    => 'wrapper',
    ) );
}
add_action( 'init', 'html5press_infinite_scroll_init' );
function html5press_infinite_scroll_render() {
    get_template_part( 'loop' );
}

// Setup update checking
add_action( 'admin_notices', 'html5press_update_notice' );
add_action( 'network_admin_notices', 'html5press_update_notice' ); // I have no idea if that actually works
function html5press_update_notice() {

	if ( current_user_can( 'update_themes' ) ) :

		include_once( ABSPATH . WPINC . '/feed.php' );

		// Get the update feed
		$rss = fetch_feed( 'http://www.longren.org/html5press.xml' );

		if ( ! is_wp_error( $rss ) ) :
			$maxitems = $rss->get_item_quantity(1); // We only want the latest
			$rss_items = $rss->get_items(0, 1);
		endif;

		if ( $maxitems != 0 ) :

			foreach ( $rss_items as $item ) {
				// Compare feed version to theme version
				if ( version_compare( $item->get_title(), html5press_getinfo('version') ) > 0 )
					echo '<div id="update-nag">HTML5Press ' . esc_html( $item->get_title() ) .' is available! <a href="' . esc_url( $item->get_permalink() ) .'">Click here to download</a>. ' . esc_html( $item->get_description() ) .
'</div>';
}
endif;
endif; // current_user_can('update_themes')
}

// Setup sidebars
add_action( 'widgets_init', 'html5press_sidebars' );
function html5press_sidebars() {
	register_sidebar(array(
		'id' => 'right-sidebar',
		'name' => 'Right Sidebar',
		'before_widget' => '<aside class="widget">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => "</h3>\n"
	));
}

// Setup comments form
add_filter( 'comment_form_default_fields', 'html5press_comments' );

function html5press_comments() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields = array(
		'author' => '<p><label for="author">' . __( 'Name','html5press' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ( $req ? ' required' : '' ) . '/></p>',

		'email' => '<p><label for="email">' . __( 'Email','html5press' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
		'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ( $req ? ' required' : '' ) . ' /></p>',

		'url' => '<p><label for="url">' . __( 'Website','html5press' ) . '</label>' .
		'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
	);

	return $fields;
}

// Setup actual comment form field
add_filter('comment_form_field_comment', 'html5press_commentfield');

function html5press_commentfield() {
	return '<p><label for="comment">' . _x( 'Comment','noun','html5press' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';
}

// Show comments the HTML5Press way
function html5press_list_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">

			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 48 ); ?>

					<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'html5press' ), get_comment_author_link() ); ?>
				</div> <!-- .comment-author.vcard -->

				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'html5press' ) ?></em>
					<br />
				<?php endif; ?>

				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<time pubdate datetime="<?php comment_time( 'Y-m-d\TH:i:s' ); ?>" class="timeago"><?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></time>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'html5press' ), '', '' ); ?>
			</footer> <!-- .comment-meta -->

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div> <!-- .reply -->
		</div> <!-- #comment-<?php comment_ID() ?> -->
<?php
}

// Enable maintenance mode
add_action('get_header', 'html5press_maintenance_mode');
function html5press_maintenance_mode() {
	$options = html5press_get_options();
	if ($options['maintenance_mode'] == 1) {
		if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
			wp_die("Performing site maintenance, please check back soon.","Performing Site Maintenance");
		}
	}
}

// Style the "edit post" links
add_filter( 'edit_post_link','html5press_edit_post_link' );
function html5press_edit_post_link() {
	$link = '<p><a class="more-link" href="'.get_edit_post_link().'">'.__( 'Edit This','html5press' ).'</a></p>';
	return $link;
}

// Style the "read more" links
/*
add_filter( 'the_content_more_link','html5press_read_more_link' );
function html5press_read_more_link() {
	$link = '<span class="alignleft more-span"><a class="more-link" href="'.get_permalink().'">'.__( 'Read More','html5press' ).'</a></span>';
	return $link;
}
*/

// Add class to style next/prev posts links
add_filter('next_posts_link_attributes', 'html5press_posts_nav_attributes');
add_filter('previous_posts_link_attributes', 'html5press_posts_nav_attributes');
function html5press_posts_nav_attributes(){
	return 'class="button"';
}

// Make page menus show correctly
add_filter( 'wp_page_menu','html5press_page_menu' );
function html5press_page_menu($menu) {
	return preg_replace('/<ul>/', '<ul id="menu">', $menu, 1);
	return $menu;
}

// Setup HTML5Press Options link in the admin bar
add_action( 'wp_before_admin_bar_render', 'html5press_admin_bar_link' );
function html5press_admin_bar_link() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => '',
		'id' => 'html5press-options',
		'title' => __( 'HTML5Press Options','html5press' ),
		'href' => admin_url( 'themes.php?page=theme_options' ),
		'meta' => false
	));
}

// Custom the_excerpt size for the featured post slider
add_filter('excerpt_length', 'html5press_excerpt_length');
function html5press_excerpt_length($length) {
	return 30;
}

// Link post titles to the link for link post formats
add_filter('post_link', 'html5press_link_filter', 10, 2);
function html5press_link_filter($link, $post) {
	 if (has_post_format('link', $post) && get_post_meta($post->ID, 'LinkFormatURL', true)) {
		  $link = get_post_meta($post->ID, 'LinkFormatURL', true);
	 }
	 return $link;
}

// Add featured post images to RSS feed
add_filter('the_excerpt_rss', 'html5press_feed_thumbnail');
add_filter('the_content_feed', 'html5press_feed_thumbnail');
function html5press_feed_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID,array(200,200)) .
		'</p>' . get_the_content();
	}

	return $content;
}

// Add rel="lightbox" to images embedded in a post for greater slimbox2 usage
add_filter('the_content', 'html5press_addlightboxrel');
function html5press_addlightboxrel($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

// Add rel="lightbox" to gallery images and make a set out of them for next/prev functionality
add_filter( 'wp_get_attachment_link' , 'html5press_addlightboxrel_to_gallery' );
function html5press_addlightboxrel_to_gallery( $attachment_link ) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox-gallery" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $attachment_link);
	return $content;
}

add_filter('excerpt_more', 'html5press_excerpt_more');
function html5press_excerpt_more($more) {
	global $post;
	$content = ' <a href="'. get_permalink($post->ID) . '" class="button">' . __( 'Continue reading...','html5press' ) . '</a>';
	return $content;
}

// Setup featured posts slider
function html5press_featured_posts() { ?>
		<div id="slider-wrapper">
			<ul id="slider">
				<?php
				global $wp_query;
				$options = html5press_get_options();
				$tmp = $wp_query;
				if ($options['featured_cat'] == 10000) { $options['featured_cat'] = "-1"; }
				$wp_query = new WP_Query('posts_per_page='.esc_attr( $options['num_featured'] ).'&cat='.esc_attr( $options['featured_cat']));
				if(have_posts()) :
					while(have_posts()) :
						the_post();
				?>
							<li>							
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bxthumb'); ?></a>	
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
								<p><?php the_excerpt(); ?></p> 
								<div class="clear"></div>
							</li> 
				<?php
					endwhile;
				endif;
				$wp_query = $tmp;
				?>
			</ul>
			<nav class="bx-pager"></nav>
		</div><!-- close #slider-wrapper -->
<?php
}
add_shortcode('featured', 'html5press_featured_posts');
// Custom callback function for add_custom_background
function html5press_custom_background_callback() {

	/* Get the background image. */
	$image = get_background_image();
	/* If there's an image, call normal callback function and set background-size to auto. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		$style = 'background-size: auto;';
	}

	/* Get the background color. */
	$color = get_background_color();
	/* If a background color is set, set that as the background color. */
	if ( !empty( $color ) && empty($image) ) {
		$style .= "background: #{$color};";
	}
?>
<style type="text/css">body { <?php echo trim( $style ); ?> }</style>
<?php

}

// PressTrends theme tracking
add_action('wp_head', 'presstrends');
function presstrends() {
// Add your PressTrends and Theme API Keys
$api_key = 'a772ez0rwkeszmbwt9glta1bimxxfevhah4f';
$auth = 'bjt6p2d21y2cygqofqp6lkk0c9iy1snqf';

// NO NEED TO EDIT BELOW
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
$url = $api_base . $auth . '/api/' . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$comments_count = wp_count_comments();
$theme_data = wp_get_theme(get_template_directory() . '/style.css');
$plugin_count = count(get_option('active_plugins'));
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['comments'] = $comments_count->total_comments;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';
}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);
}}

require( get_template_directory() . '/custom-header.php' );
?>
