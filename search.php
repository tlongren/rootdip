<?php get_header(); ?>
<?php $options = html5press_get_options(); ?>
<main id="content" role="main" class="span7">
	<?php $results = absint( $wp_query->found_posts ); ?>
		<h2 class="pagetitle">
			<?php printf( _n( "%d Results for", "%d Search Results for:", $results, 'html5press' ), $results ); ?>
			<span class="search-terms">"<?php echo esc_attr( get_search_query() ); ?>"</span>
		</h2>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
			<?php $large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $options['featured_image_size'] ); ?>
            <?php if ( has_post_thumbnail() ) { ?><a href="<?php echo "$large_image[0]"; ?>" rel="thumbnail"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
            <?php the_content(__( 'Read more','html5press' )); ?>
			<?php /* Edit Link */ edit_post_link(); ?>
			<footer class="entry-meta">
					<?php _e( 'In ','html5press'); ?><?php the_category(', '); ?>
					<?php _e( 'by ','html5press'); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span>
					<?php if ($options['fuzzy_timestamps'] == 0) { _e( '','html5press'); } ?> <time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" class="timeago" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time><?php if (get_the_modified_time() != get_the_time()) { ?>, updated <time datetime="<?php the_modified_time('Y-m-d\TH:i:sO'); ?>"><?php the_modified_date(); ?></time><?php } ?>
					<?php wp_link_pages( array( 'before' => __( '<span class="alignright">Pages:', 'html5press' ), 'after' => '</span>' ) ); ?>
				
            </footer> <!-- end post meta -->
			<article class="comments">
				<?php comments_template(); ?>
			</article>
        </article> <!-- end post 1 -->
		<?php endwhile; endif; ?>
    	<h2 class="assistive-text"><?php _e( 'Post navigation', 'html5press' ); ?></h2>
		<nav class="navigation">
			<div class="nav-previous alignleft"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts','html5press' ) ); ?></div>
			<div class="nav-next alignright"><?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>','html5press' ) ); ?></div>
		</nav>
    </main> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
