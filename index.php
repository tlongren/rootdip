<?php get_header(); ?>

<div id="main" class="grid_8 alpha">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post">
        
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
            <?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
            
            <?php the_content(__('Read more')); ?>
            
            <div class="clear"></div>  
            
            <footer class="postmeta">
                <span class="btn alignleft">
                	In <?php the_category(', '); ?> by <?php the_author(); ?> on <time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time('F j, Y'); ?></time>
				</span>
                <!-- <a href="<?php //the_permalink(); ?>" class="more-link alignright">Read more</a> -->
            </footer> <!-- end post meta -->
        
        </article> <!-- end post 1 -->
    <?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
