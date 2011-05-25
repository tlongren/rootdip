<?php get_header(); ?>
<?php global $html5press_options; $html5press_settings = get_option( 'html5press_options', $html5press_options ); ?>
<div id="content" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
			<?php
			printf( __( 'In %1$s by <span class="author vcard"><a class="url fn n" href="%2$s" title="%3$s">%4$s</a></span> on <time class="entry-date" datetime="%5$s" pubdate>%6$s</time></a>', 'html5press' ),
				get_the_category_list( ', ' ),
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'html5press' ), get_the_author() ),
				get_the_author(),
				get_the_date( 'c' ),
				get_the_date()
			);
			
			wp_link_pages( array( 'before' => __( '<span class="alignright">Pages:', 'html5press' ), 'after' => '</span>' ) );
			
			the_tags( '<span class="post-tags">' . __( 'Tagged with: ','html5press' ), ', ', '</span>' );
		?>
	</p>
	<?php edit_post_link(); ?>
</footer> <!-- .post meta -->
			
			<article class="comments">
				<?php comments_template(); ?>
			</article>
        </article> <!-- end post 1 -->
		<?php endwhile; endif; ?>
    
    </div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
