<?php

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'nav-menus' );
	add_theme_support( 'post-thumbnails' );
}
if (function_exists('register_nav_menu')) {
	register_nav_menu('main-menu', __('Main Menu'));
}

if(function_exists('register_sidebar')){
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
'author' => '<p>' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder = "What should we call you?"' . ( $req ? ' required' : '' ) . '/></p>',

'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="How can we reach you?"' . ( $req ? ' required' : '' ) . ' /></p>',

'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Have you got a website?" /></p>'
);
	return $fields;
}

add_filter('comment_form_field_comment', 'html5press_commentfield');
function html5press_commentfield() {
	$commentArea = '<p><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="What\'s on your mind?"    ></textarea></p>';
	return $commentArea;
}

?>
