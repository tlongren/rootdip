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
?>
