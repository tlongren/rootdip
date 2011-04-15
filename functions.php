<?php

add_action( 'after_theme_setup', 'html5press_theme_setup' );

function html5press_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	register_nav_menu('main-menu', __('Main Menu'));
	add_theme_support( 'automatic-feed-links' );
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

?>
