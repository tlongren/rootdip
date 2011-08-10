<?php get_header(); ?>
<div id="content" role="main">
	<?php $results = absint( $wp_query->found_posts ); ?>
	<h2 class="pagetitle">
		<?php printf( _n( "%d Results for", "%d Search Results for:", $results, 'html5press' ), $results ); ?>
		<span class="search-terms">"<?php echo esc_attr( get_search_query() ); ?>"</span>
	</h2>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><span class="comments-link"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
            <?php if ( has_post_thumbnail() ) { ?><figure><a href="<?php the_permalink(); ?>"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a></figure><?php } ?>
            
            <?php the_content(__( 'Read more','html5press' )); ?>
            
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
		<hr />
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
