<?php get_header(); ?>

<main id="content" role="main" class="span7">
	<article class="hentry">
        <h1 class="entry-title"><?php _e( 'Error 404','rootdip'); ?></h1>
		<p><?php _e( 'The page you requested could not be found. Try searching or going back to the ','rootdip'); ?><a href="<?php echo home_url(); ?>"><?php _e( 'home page','rootdip'); ?></a>.</p>
		<div class="clear"></div>
	</article> <!-- end post 1 --> 
</main> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
