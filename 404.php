<?php get_header(); ?>

<div id="content" role="main">
	<article class="hentry">
        <h1 class="entry-title"><?php _e( 'Error 404','html5press'); ?></h1>
		<p><?php _e( 'The page you requested could not be found. Try searching or going back to the ','html5press'); ?><a href="<?php echo home_url(); ?>"><?php _e( 'home page','html5press'); ?></a>.</p>
		<div class="clear"></div>
	</article> <!-- end post 1 --> 
</div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
