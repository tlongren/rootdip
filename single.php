<?php get_header(); ?>
<?php $options = html5press_get_options(); ?>
<main id="content" role="main" class="span7">
	<?php get_template_part( 'loop', 'index' ); ?>
	<h2 class="assistive-text"><?php _e( 'Post navigation', 'html5press' ); ?></h2>
	<nav class="navigation">
		<div class="nav-previous alignleft"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts','html5press' ) ); ?></div>
		<div class="nav-next alignright"><?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>','html5press' ) ); ?></div>
	</nav>
</main> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>