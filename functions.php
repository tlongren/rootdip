<?php
require_once ( get_template_directory() . '/theme-options.php' );
function html5press_layout_view() {
	global $html5press_options;
	$settings = get_option( 'html5press_options', $html5press_options );
}

add_action( 'wp_head', 'html5press_layout_view' );
if ( ! isset( $content_width ) ) $content_width = 580;
define( 'html5press_version', '1.3' );
function html5press_getinfo( $show = '' ) {
        $output = '';

		switch ( $show ) {
			case 'version' :
			$output = html5press_version;
					break;
		}
		return $output;
}

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
	
	if ($options['backToTop'] == 1) {
		wp_enqueue_script('jquery');
	}
}

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

add_filter('comment_form_field_comment', 'html5press_commentfield');

function html5press_commentfield() {
	$commentArea = '<p><label for="comment">' . _x( 'Comment','noun','html5press' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="What\'s on your mind?"></textarea></p>';
	return $commentArea;
}

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

add_filter( 'edit_post_link','html5press_edit_post_link' );
function html5press_edit_post_link() {
	$link = '<span class="alignright"><a class="post-edit-link more-link" href="'.get_edit_post_link().'">'.__( 'Edit This','html5press' ).'</a></span>';
	return $link;
}

add_filter( 'wp_page_menu','html5press_page_menu' );
function html5press_page_menu($menu) {
	return preg_replace('/<ul>/', '<ul id="menu">', $menu, 1);
	return $menu;
}
?>
