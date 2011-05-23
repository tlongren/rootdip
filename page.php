<?php get_header(); ?>

<div id="content" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
            <?php the_content(__( 'Read more','html5press' )); ?>
			
			<footer class="post-meta">
                <p>
                	<?php _e( 'Created ','html5press'); ?><time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
				</p>
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
