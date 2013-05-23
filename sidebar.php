<div id="sidebar" role="complementary" class="span4">
<?php
if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
<?php
	dynamic_sidebar( 'right-sidebar' ); ?>
<?php
else:
?>
<section class="widget">
<?php get_search_form(); ?>
</section>

<section class="widget">
	<h3 class="widget-title"><?php _e( 'Archives','html5press' ); ?></h3>
	<ul>
		<?php wp_get_archives( array('type' => 'monthly') ); ?>
	</ul>
</section>

<section class="widget">
	<h3 class="widget-title"><?php _e( 'Categories','html5press' ); ?></h3>
	<ul>
		<?php wp_list_categories( array('title_li' => false,'depth' => '-1') ); ?>
	</ul>
</section>

<section class="widget">
	<h3 class="widget-title"><?php _e( 'Meta','html5press' ); ?></h3>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>
</section>
<?php endif; ?>
</div> <!-- end sidebar -->
