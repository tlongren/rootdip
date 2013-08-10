<?php get_header(); ?>
<?php $options = rootdip_get_options(); ?>
<main id="content" role="main" class="span7">
		<?php get_template_part( 'loop', 'index' ); ?>
	<h2 class="assistive-text"><?php _e( 'Post navigation', 'rootdip' ); ?></h2>
	<nav class="navigation">
		<div class="nav-previous alignleft"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts','rootdip' ) ); ?></div>
		<div class="nav-next alignright"><?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>','rootdip' ) ); ?></div>
	</nav>
    </main> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
