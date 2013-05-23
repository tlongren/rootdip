<?php if (is_paged()) { ?><h1 class="pagetitle"><?php $pageNumber = (get_query_var('paged')) ? get_query_var('paged') : 1; _e( 'Page '.$pageNumber,'html5press' ); ?></h1><?php } ?>
		<?php if (!empty($options['featured_cat']) && is_front_page()) { html5press_featured_posts(); } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        	<header class="entry-header">
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php if (!has_post_format('link')) { ?><span class="comments-link"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span><?php } ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
            <?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
           	</header> <!-- .entry-header -->
            <div class="entry-content">
	            <?php if ($options['homepage_article_summary'] == 1) { ?>
					<?php the_excerpt(); ?>
				<?php } else { ?>
					<?php the_content(__( 'Read more','html5press' )); ?>
	            <?php } ?>
            </div> <!-- .entry-content -->
			<?php /* Edit Link */ edit_post_link(); ?>
			<footer class="entry-meta">
				<p>
					<?php _e( 'In ','html5press'); ?><?php the_category(', '); ?>
					<?php _e( 'by ','html5press'); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span>
					<?php if ($options['fuzzy_timestamps'] == 0) { _e( '','html5press'); } ?> <time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" class="timeago" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time><?php if (get_the_modified_time() != get_the_time()) { ?>, updated <time datetime="<?php the_modified_time('Y-m-d\TH:i:sO'); ?>"><?php the_modified_date(); ?></time><?php } ?>
					<?php wp_link_pages( array( 'before' => __( '<span class="alignright">Pages:', 'html5press' ), 'after' => '</span>' ) ); ?>
				</p>
				
            </footer> <!-- end post meta -->
			<article class="comments">
				<?php comments_template(); ?>
			</article>
        </article> <!-- end post 1 -->
		<hr />
    <?php endwhile; else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.','html5press' ); ?></p>
	<?php endif; ?>