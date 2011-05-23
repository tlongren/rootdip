<?php get_header(); ?>
<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
<div id="content" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if (has_tag()) { ?>
			<div class="post-tags alignleft">
				<p><?php the_tags(__( 'Tagged with: ','html5press' )); ?></p>
			</div>
			<?php } ?>
			<div class="clear"></div>
			<div class="alignleft"><?php previous_post_link(); ?></div>
			<div class="alignright"><?php next_post_link(); ?></div>
            <div class="clear"></div>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
			<?php $large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $html5press_settings['featured_image_size'] ); ?>
            <?php if ( has_post_thumbnail() ) { ?><figure><a href="<?php echo "$large_image[0]"; ?>" rel="thumbnail"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a></figure><?php } ?>
            
            <?php the_content(__('Read more')); ?>
			
			<footer class="post-meta">
				<p>
                    <?php _e( 'In ','html5press'); ?><?php the_category(', '); ?>
                    <?php _e( 'by ','html5press'); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span>
                    <?php _e( 'on ','html5press'); ?> <time datetime="<?php echo get_the_time('Y-m-d'); ?>" pubdate><?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
					<?php wp_link_pages( array( 'before' => __( '<span class="alignright">Pages:', 'html5press' ), 'after' => '</span>' ) ); ?>
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
