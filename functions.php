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
define( 'html5press_version', '1.4-rc1' );
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
	
	add_theme_support( 'post-thumbnails' ); // post thumbnails
	register_nav_menu( 'main-menu', __('Main Menu','html5press') ); // navigation menus
	add_theme_support( 'automatic-feed-links' ); // automatic feeds
	add_image_size('bxthumb', 200, 200, true);
}

// Register all the javascript and css we need to accompany those scripts
add_action( 'init', 'html5press_register_scripts' );
function html5press_register_scripts() {
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js' ), false, null, true );
		wp_enqueue_script( 'jquery' );
		global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options );
		// if back to top is enabled, add easing and the back to top javascript.
		if ($html5press_settings['back_to_top'] == 1) {
			wp_enqueue_script('easing', get_bloginfo('stylesheet_directory').'/js/easing.js', 'jquery', '1.1.2');
			wp_enqueue_script('totop', get_bloginfo('stylesheet_directory').'/js/jquery.ui.totop.js', 'jquery', '1.1');
		}
		wp_enqueue_script('bxslider', get_bloginfo('stylesheet_directory').'/js/jquery.bxSlider.min.js', 'jquery', '3.0');
		wp_enqueue_style('bxslider-style', get_bloginfo('stylesheet_directory').'/css/bx_styles.css', 'bxslider', '1.0');
		wp_enqueue_script('bxslider-load', get_bloginfo('stylesheet_directory').'/js/bxslider-load.js', 'bxslider', '1.0');
	}
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
add_filter('comment_form_default_fields', 'html5press_comments');
function html5press_comments() {
	$req = get_option('require_name_email');
	$fields =  array(
'author' => '<p>' . '<label for="author">' . __( 'Name','html5press' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "What should we call you?"' . ( $req ? ' required' : '' ) . '/></p>',

'email'  => '<p><label for="email">' . __( 'Email','html5press' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
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

// Style the "edit post" links
add_filter( 'edit_post_link','html5press_edit_post_link' );
function html5press_edit_post_link() {
	$link = '<span class="alignright"><a class="post-edit-link more-link" href="'.get_edit_post_link().'">'.__( 'Edit This','html5press' ).'</a></span>';
	return $link;
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
		'title' => __('HTML5Press Options'),
		'href' => admin_url( 'themes.php?page=theme_options'),
		'meta' => false
	));
}

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
		</div><!-- close #slider-wrapper -->
<?php
}
?>
