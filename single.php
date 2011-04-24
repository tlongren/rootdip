<?php get_header(); ?>

<div id="main" class="grid_8 alpha">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="post-tags alignleft">
				<p><?php the_tags(__( 'Tagged with: ','html5press' )); ?></p>
			</div>
			<div class="clear"></div>
			<div class="alignleft"><?php previous_post_link(); ?></div>
			<div class="alignright"><?php next_post_link(); ?></div>
            <div class="clear"></div>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
			<?php $large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
            <?php if ( has_post_thumbnail() ) { ?><a href="<?php echo "$large_image[0]"; ?>" rel="thumbnail"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
            
            <?php the_content(__('Read more')); ?>
            
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
		<?php endwhile; endif; ?>
    
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
