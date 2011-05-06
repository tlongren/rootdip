<?php get_header(); ?>
<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
<div id="main" class="grid_8 alpha">
		<?php if (isset($html5press_settings['featured_cat'])) { html5press_featured_posts(); } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
            <?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
            
            <?php the_content(__( 'Read more','html5press' )); ?>
            
            <div class="clear"></div>  
            
            <footer class="postmeta">
                <span class="btn alignleft">
                	<?php _e( 'In ','html5press'); ?><?php the_category(', '); ?><?php _e( ' by ','html5press'); ?><?php the_author_posts_link(); ?><?php _e( ' on ','html5press'); ?><a href="<?php bloginfo('url'); ?>/<?php echo get_the_time('Y/m'); ?>"><time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time( get_option( 'date_format' ) ); ?></time></a>
				</span>
				<?php /* Edit Link */ edit_post_link(); ?>
            </footer> <!-- end post meta -->
			<article class="comments">
				<?php comments_template(); ?>
			</article>
        </article> <!-- end post 1 -->
    <?php endwhile; else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.','html5press' ); ?></p>
	<?php endif; ?>
	<div class="navigation">
		<div class="nav-previous alignleft"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts','html5press' ) ); ?></div>
		<div class="nav-next alignright"><?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>','html5press' ) ); ?></div>
	</div>
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
