<?php get_header(); ?>

<div id="main" class="grid_8 alpha">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post">
        
            <h2><a href="#"><?php the_title(); ?></a></h2>
            
            <?php the_content(__('Read more')); ?>
            
            <div class="clear"></div>
			
			<footer class="postmeta">
                <span class="btn alignleft">
                	Created <time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time('F j, Y'); ?></time>
				</span>
            </footer> <!-- end post meta -->
        
        </article> <!-- end post 1 -->
		<?php endwhile; endif; ?>
    
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
