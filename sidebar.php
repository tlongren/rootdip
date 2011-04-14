<div id="sidebar" class="grid_4 omega">
<?php
if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
<?php
	dynamic_sidebar( 'right-sidebar' ); ?>
<?php
else:
?>
<aside class="widget">
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <input type="search" value="" name="s" id="s" placeholder="<?php _e('Search...'); ?>" />
        <input type="submit" id="searchsubmit" value="<?php _e('Search...'); ?>" />
</form>
</aside>

<aside class="widget">
	<h3><?php _e( 'Archives'); ?></h3>
	<ul>
		<?php wp_get_archives( 'type=monthly' ); ?>
	</ul>
</aside>

<aside class="widget">
	<h3><?php _e( 'Meta'); ?></h3>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
	</ul>
</aside>
<?php endif; ?>
</div> <!-- end sidebar -->
 </div> <!-- end content -->
