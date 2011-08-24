<?php
require_once ( get_template_directory() . '/theme-options.php' );

// Setup options
add_action( 'wp_head', 'html5press_layout_view' );
function html5press_layout_view() {
	global $html5press_options;
	$settings = get_option( 'html5press_options', $html5press_options );
}

if ( ! isset( $content_width ) ) $content_width = 580;

// Set html5press version
define( 'html5press_version', '2.0-rc1' );
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
	load_theme_textdomain( 'html5press', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	add_theme_support( 'post-formats', array( 'link','quote','status' ) );
	add_theme_support( 'post-thumbnails' ); // post thumbnails
	register_nav_menu( 'main-menu', __('Main Menu','html5press') ); // navigation menus
	add_theme_support( 'automatic-feed-links' ); // automatic feeds
	add_image_size('bxthumb', 200, 200, true);
}

// Register all the javascript
add_action( 'wp_enqueue_scripts', 'html5press_register_scripts' );
function html5press_register_scripts() {
   
	/**
	 * Modernizr enables HTML5 elements & feature detects
	 * For optimal performance, use a custom Modernizr build: www.modernizr.com/download/
	 */
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr-2.0.6.min.js', '', '2.0.6' );

	// Make sure jQuery is loaded after Modernizr
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array( 'modernizr' ), null );
	wp_enqueue_script( 'easing', get_stylesheet_directory_uri() . '/js/easing.min.js', array( 'jquery' ), '1.1.2', true );
	global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options );
	// If back to top is enabled, add easing and the back to top javascript.
	if ( $html5press_settings['back_to_top'] == 1 ) {
		wp_enqueue_script( 'totop', get_stylesheet_directory_uri() . '/js/jquery.ui.totop.js', array( 'jquery' ), '1.1', true );
	}
	if ( $html5press_settings['enable_slimbox'] == 1 ) {
		wp_enqueue_script( 'slimbox2', get_stylesheet_directory_uri() . '/js/slimbox2.js', array( 'jquery' ), '2.04', true );
	}
	if ( !empty($html5press_settings['featured_cat']) ) {
		wp_enqueue_script( 'bxslider', get_stylesheet_directory_uri() . '/js/jquery.bxSlider.min.js', array( 'jquery' ), '3.0', true );
		wp_enqueue_script( 'bxslider-load', get_stylesheet_directory_uri() . '/js/bxslider-load.js', array( 'bxslider' ), '1.0', true );
	}
}

// Register styles to accompany the scripts above
add_action( 'wp_print_styles', 'html5press_register_styles' );
function html5press_register_styles() {
	global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options );
	if ( !empty($html5press_settings['featured_cat']) ) {
		wp_enqueue_style( 'bxslider-style', get_stylesheet_directory_uri().'/css/bx_styles.css');
	}
	if ( $html5press_settings['enable_slimbox'] == 1 ) {
		wp_enqueue_style( 'slimbox2-style', get_stylesheet_directory_uri().'/css/slimbox2.css');
	}
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
		'before_title' => '<h2 class="widget-title">',
		'after_title' => "</h2>\n"
	));
}

// Setup comments form
add_filter('comment_form_default_fields', 'html5press_comments');
function html5press_comments() {
	$req = get_option('require_name_email');
	$fields =  array(
'author' => '<p><label for="author">' . __( 'Name','html5press' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "What should we call you?"' . ( $req ? ' required' : '' ) . '/></p>',

'email'  => '<p><label for="email">' . __( 'Email','html5press' ) . '' . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . 
'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="How can we reach you?"' . ( $req ? ' required' : '' ) . ' /></p>',

'url'    => '<p><label for="url">' . __( 'Website','html5press' ) . '</label>' .
'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'
);
	return $fields;
}

// Setup actual comment form field
add_filter('comment_form_field_comment', 'html5press_commentfield');
function html5press_commentfield() {
	$commentArea = '<p><label for="comment">' . _x( 'Comment','noun','html5press' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="What\'s on your mind?"></textarea></p>';
	return $commentArea;
}

// Show comments the HTML5Press way
function html5press_list_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>

         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>','html5press'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e( 'Your comment is awaiting moderation.','html5press' ) ?></em>
         <br />
      <?php endif; ?>

      <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></time></a><?php edit_comment_link(__('(Edit)','html5press'),'  ','') ?><div class="authortag"><?php _x( 'Author','noun','html5press' ); ?></div></div>
		
      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
}

// Enable maintenance mode
add_action('get_header', 'html5press_maintenance_mode');
function html5press_maintenance_mode() {
	global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options );
	if ($html5press_settings['maintenance_mode'] == 1) {
		if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
			wp_die("Performing site maintenance, please check back soon.","Performing Site Maintenance");
		}
	}
}

// Style the "edit post" links
add_filter( 'edit_post_link','html5press_edit_post_link' );
function html5press_edit_post_link() {
	$link = '<a class="more-link" href="'.get_edit_post_link().'">'.__( 'Edit This','html5press' ).'</a>';
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
		'parent' => 'appearance',
		'id' => 'html5press-options',
		'title' => __( 'HTML5Press Options','html5press' ),
		'href' => admin_url( 'themes.php?page=theme_options'),
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

// Generic login failure message to reduce details given on login failure.
add_filter( 'login_errors', 'html5press_generic_login_failure' );
function html5press_generic_login_failure() { return '<strong>ERROR</strong>: The login you provided is incorrect.'; }

// Add rel="lightbox" to images embedded in a post for greater slimbox2 usage
add_filter('the_content', 'html5press_addlightboxrel');
function html5press_addlightboxrel($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox" title="'.$post->post_title.'"$6>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

// Setup featured posts slider
function html5press_featured_posts() { ?>
		<div id="slider-wrapper">
			<ul id="slider">
				<?php
				global $wp_query, $html5press_options;
				$settings = get_option( 'html5press_options', $html5press_options );
				$tmp = $wp_query;
				$wp_query = new WP_Query('posts_per_page='.esc_attr( $settings['num_featured'] ).'&cat='.esc_attr( $settings['featured_cat']));
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
?>
