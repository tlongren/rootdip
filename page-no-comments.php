<?php/*Template Name: Page With No Comments*/?>
<?php get_header(); ?>

<div id="main" class="grid_8 alpha">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
            <?php the_content(__( 'Read more','html5press' )); ?>
            
            <div class="clear"></div>
			
			<footer class="postmeta">
                <span class="btn alignleft">
                	<?php _e( 'Created ','html5press'); ?><time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
				</span>
				<?php /* Edit Link */ edit_post_link(); ?>
            </footer> <!-- end post meta -->
        </article> <!-- end post 1 -->
		<?php endwhile; endif; ?>
    
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
