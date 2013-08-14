<?php
require_once ( get_template_directory() . '/theme-options.php' );

// Setup options
add_action( 'wp_head', 'rootdip_layout_view' );
function rootdip_layout_view() {
	$options = rootdip_get_options();
}

if ( ! isset( $content_width ) ) $content_width = 580;

// Set rootdip version
define( 'rootdip_version', '2.5.6' );
function rootdip_getinfo( $show = '' ) {
		$output = '';

		switch ( $show ) {
			case 'version' :
			$output = rootdip_version;
					break;
		}
		return $output;
}

// Setup theme basics
add_action( 'after_setup_theme', 'rootdip_theme_setup' );
function rootdip_theme_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'rootdip', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	add_theme_support( 'post-formats', array( 'link','quote','status' ) ); // support for post formats
	add_theme_support( 'post-thumbnails' ); // post thumbnails
	register_nav_menu( 'main-menu', __('Main Menu','rootdip') ); // navigation menus
	add_theme_support( 'automatic-feed-links' ); // automatic feeds
	add_image_size( 'bxthumb', 200, 200, true ); // featured post slider image size
	$backgroundDefaults = array(
		'wp-head-callback'       => 'rootdip_custom_background_callback'
	);
	add_theme_support( 'custom-background', $backgroundDefaults ); // enable custom backgrounds
	add_editor_style( '/css/editor-style.css' );
}

// Register all the javascript
add_action( 'wp_enqueue_scripts', 'rootdip_register_scripts' );
function rootdip_register_scripts() {
   
	/**
	 * Modernizr enables HTML5 elements & feature detects
	 * For optimal performance, use a custom Modernizr build: www.modernizr.com/download/
	 */
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr-2.6.1.min.js', '', '2.0.6' );

	// Make sure jQuery is loaded after Modernizr
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array( 'modernizr' ), null );
	wp_enqueue_script( 'easing', get_stylesheet_directory_uri() . '/js/easing.min.js', array( 'jquery' ), '1.1.2', true );

	$options = rootdip_get_options();

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
add_action( 'wp_enqueue_scripts', 'rootdip_register_styles' );

function rootdip_register_styles() {
	$options = rootdip_get_options();

	if ( !empty($options['featured_cat']) ) {
		wp_enqueue_style( 'bxslider-style', get_stylesheet_directory_uri().'/css/bx_styles.css');
	}

	if ( $options['enable_slimbox'] == 1 ) {
		wp_enqueue_style( 'slimbox2-style', get_stylesheet_directory_uri().'/css/slimbox2.css');
	}
	wp_enqueue_style( 'rootdip-style', get_stylesheet_directory_uri().'/css/rootdip.css');
	wp_enqueue_style( 'fonts', get_stylesheet_directory_uri().'/css/fonts/'.$options['theme_font'].'.css');
}

// Load custom javascript
add_action('wp_footer', 'rootdip_load_scripts');
function rootdip_load_scripts() {
	$options = rootdip_get_options();
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
function rootdip_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'content',
        'render'    => 'rootdip_infinite_scroll_render',
        'footer'    => 'wrapper',
    ) );
}
add_action( 'init', 'rootdip_infinite_scroll_init' );
function rootdip_infinite_scroll_render() {
    get_template_part( 'loop' );
}

// Setup update checking
add_action( 'admin_notices', 'rootdip_update_notice' );
add_action( 'network_admin_notices', 'rootdip_update_notice' ); // I have no idea if that actually works
function rootdip_update_notice() {

	if ( current_user_can( 'update_themes' ) ) :

		include_once( ABSPATH . WPINC . '/feed.php' );

		// Get the update feed
		$rss = fetch_feed( 'http://www.longren.org/rootdip.xml' );

		if ( ! is_wp_error( $rss ) ) :
			$maxitems = $rss->get_item_quantity(1); // We only want the latest
			$rss_items = $rss->get_items(0, 1);
		endif;

		if ( $maxitems != 0 ) :

			foreach ( $rss_items as $item ) {
				// Compare feed version to theme version
				if ( version_compare( $item->get_title(), rootdip_getinfo('version') ) > 0 )
					echo '<div id="update-nag">RootDip ' . esc_html( $item->get_title() ) .' is available! <a href="' . esc_url( $item->get_permalink() ) .'">Click here to download</a>. ' . esc_html( $item->get_description() ) .
'</div>';
}
endif;
endif; // current_user_can('update_themes')
}

// Setup sidebars
add_action( 'widgets_init', 'rootdip_sidebars' );
function rootdip_sidebars() {
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
add_filter( 'comment_form_default_fields', 'rootdip_comments' );

function rootdip_comments() {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields = array(
		'author' => '<p><label for="author">' . __( 'Name','rootdip' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ( $req ? ' required' : '' ) . '/></p>',

		'email' => '<p><label for="email">' . __( 'Email','rootdip' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
		'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ( $req ? ' required' : '' ) . ' /></p>',

		'url' => '<p><label for="url">' . __( 'Website','rootdip' ) . '</label>' .
		'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
	);

	return $fields;
}

// Setup actual comment form field
add_filter('comment_form_field_comment', 'rootdip_commentfield');

function rootdip_commentfield() {
	return '<p><label for="comment">' . _x( 'Comment','noun','rootdip' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';
}

// Show comments the RootDip way
function rootdip_list_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">

			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 48 ); ?>

					<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'rootdip' ), get_comment_author_link() ); ?>
				</div> <!-- .comment-author.vcard -->

				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'rootdip' ) ?></em>
					<br />
				<?php endif; ?>

				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<time pubdate datetime="<?php comment_time( 'Y-m-d\TH:i:s' ); ?>" class="timeago"><?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></time>
				</a>
				<?php edit_comment_link( __( '(Edit)', 'rootdip' ), '', '' ); ?>
			</footer> <!-- .comment-meta -->

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div> <!-- .reply -->
		</div> <!-- #comment-<?php comment_ID() ?> -->
<?php
}

// Enable maintenance mode
add_action('get_header', 'rootdip_maintenance_mode');
function rootdip_maintenance_mode() {
	$options = rootdip_get_options();
	if ($options['maintenance_mode'] == 1) {
		if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
			wp_die("Performing site maintenance, please check back soon.","Performing Site Maintenance");
		}
	}
}

// Style the "edit post" links
add_filter( 'edit_post_link','rootdip_edit_post_link' );
function rootdip_edit_post_link() {
	$link = '<p><a class="more-link" href="'.get_edit_post_link().'">'.__( 'Edit This','rootdip' ).'</a></p>';
	return $link;
}

// Style the "read more" links
/*
add_filter( 'the_content_more_link','rootdip_read_more_link' );
function rootdip_read_more_link() {
	$link = '<span class="alignleft more-span"><a class="more-link" href="'.get_permalink().'">'.__( 'Read More','rootdip' ).'</a></span>';
	return $link;
}
*/

// Add class to style next/prev posts links
add_filter('next_posts_link_attributes', 'rootdip_posts_nav_attributes');
add_filter('previous_posts_link_attributes', 'rootdip_posts_nav_attributes');
function rootdip_posts_nav_attributes(){
	return 'class="button"';
}

// Make page menus show correctly
add_filter( 'wp_page_menu','rootdip_page_menu' );
function rootdip_page_menu($menu) {
	return preg_replace('/<ul>/', '<ul id="menu">', $menu, 1);
	return $menu;
}

// Setup RootDip Options link in the admin bar
add_action( 'wp_before_admin_bar_render', 'rootdip_admin_bar_link' );
function rootdip_admin_bar_link() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => '',
		'id' => 'rootdip-options',
		'title' => __( 'RootDip Options','rootdip' ),
		'href' => admin_url( 'themes.php?page=theme_options' ),
		'meta' => false
	));
}

// Custom the_excerpt size for the featured post slider
add_filter('excerpt_length', 'rootdip_excerpt_length');
function rootdip_excerpt_length($length) {
	return 30;
}

// Link post titles to the link for link post formats
add_filter('post_link', 'rootdip_link_filter', 10, 2);
function rootdip_link_filter($link, $post) {
	 if (has_post_format('link', $post) && get_post_meta($post->ID, 'LinkFormatURL', true)) {
		  $link = get_post_meta($post->ID, 'LinkFormatURL', true);
	 }
	 return $link;
}

// Add featured post images to RSS feed
add_filter('the_excerpt_rss', 'rootdip_feed_thumbnail');
add_filter('the_content_feed', 'rootdip_feed_thumbnail');
function rootdip_feed_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID,array(200,200)) .
		'</p>' . get_the_content();
	}

	return $content;
}

// Add rel="lightbox" to images embedded in a post for greater slimbox2 usage
add_filter('the_content', 'rootdip_addlightboxrel');
function rootdip_addlightboxrel($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

// Add rel="lightbox" to gallery images and make a set out of them for next/prev functionality
add_filter( 'wp_get_attachment_link' , 'rootdip_addlightboxrel_to_gallery' );
function rootdip_addlightboxrel_to_gallery( $attachment_link ) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox-gallery" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $attachment_link);
	return $content;
}

add_filter('excerpt_more', 'rootdip_excerpt_more');
function rootdip_excerpt_more($more) {
	global $post;
	$content = ' <a href="'. get_permalink($post->ID) . '" class="button">' . __( 'Continue reading...','rootdip' ) . '</a>';
	return $content;
}

// Setup featured posts slider
function rootdip_featured_posts() { ?>
		<div id="slider-wrapper">
			<ul id="slider">
				<?php
				global $wp_query;
				$options = rootdip_get_options();
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
add_shortcode('featured', 'rootdip_featured_posts');
// Custom callback function for add_custom_background
function rootdip_custom_background_callback() {

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
require( get_template_directory() . '/custom-header.php' );
?>
