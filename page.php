<?php get_header(); ?>
<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
<div id="content" role="main">
		<?php if (!empty($html5press_settings['featured_cat']) && is_front_page()) { html5press_featured_posts(); } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
			<?php $large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $html5press_settings['featured_image_size'] ); ?>
            <?php if ( has_post_thumbnail() ) { ?><figure><a href="<?php echo "$large_image[0]"; ?>" rel="thumbnail"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a></figure><?php } ?>
            <?php the_content(__( 'Read more','html5press' )); ?>
			
			<footer class="post-meta">
                <p>
                	<?php _e( 'Created ','html5press'); ?><time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" class="timeago" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time>
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
