<div id="sidebar" role="complementary">
<?php
if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
<?php
	dynamic_sidebar( 'right-sidebar' ); ?>
<?php
else:
?>
<aside class="widget">
<?php get_search_form(); ?>
</aside>

<aside class="widget">
	<h2 class="widget-title"><?php _e( 'Archives','html5press' ); ?></h2>
	<ul>
		<?php wp_get_archives( array('type' => 'monthly') ); ?>
	</ul>
</aside>

<aside class="widget">
	<h2 class="widget-title"><?php _e( 'Categories','html5press' ); ?></h2>
	<ul>
		<?php wp_list_categories( array('title_li' => false,'depth' => '-1') ); ?>
	</ul>
</aside>

<aside class="widget">
	<h2 class="widget-title"><?php _e( 'Meta','html5press' ); ?></h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>
</aside>
<?php endif; ?>
</div> <!-- end sidebar -->
 </div> <!-- end content -->
