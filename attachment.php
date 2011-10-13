<?php get_header(); ?>
<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
<div id="content" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="alignleft prev-post"><?php previous_image_link(false,__('Previous Attachment','html5press')); ?></div><div class="alignright next-post"><?php next_image_link(false,__('Next Attachment','html5press')); ?></div>
			<div class="clear"></div>
<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "medium"); $large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $html5press_settings['featured_image_size'] ); ?>
			<figure>
			<a href="<?php echo "$large_image[0]"; ?>" title="<?php the_title(); ?>" rel="lightbox"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
			<figcaption><?php if ( !empty($post->post_excerpt) ) echo "$post->post_excerpt" ?></figcaption>
			</figure>
			<p><a href="<?php echo get_permalink($post->post_parent); ?>">&laquo;<?php _e( 'Back to Post','html5press' ); ?></a></p>
<?php else : ?>
			<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
			<div><?php if ( !empty($post->post_excerpt) ) echo "$post->post_excerpt" ?></div>
<?php endif; ?>
			
			<footer class="post-meta">
                <p>
                	<?php _e( 'Created ','html5press'); ?><time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time>
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
