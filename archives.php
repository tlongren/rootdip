<?php
/*Template Name: Archives*/
$count_posts    = wp_count_posts( 'post' );
$count_pages    = wp_count_posts( 'page' );
$count_comments = wp_count_comments();
$count_cats         = wp_count_terms( 'category', array( 'hide_empty' => true ) );
$count_tags         = wp_count_terms( 'post_tag', array( 'hide_empty' => true ) );
?>
<?php get_header(); ?>

<div id="content" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
        
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            
			<p class="archivetext">
			<?php
			/* translators: 1: blog name, 2: post count, 3: page count 4: comment count, 5: category count, 6: tag count */
			printf( __('This is the frontpage of the <strong>%1$s</strong> archives. Currently the archives consist of <strong>%2$s</strong>, <strong>%3$s</strong> and <strong>%4$s</strong>, with a total of <strong>%5$s</strong> and <strong>%6$s</strong>.', 'html5press'),
					get_bloginfo('name'),
					sprintf( _n( '%d post', '%d posts', $count_posts->publish, 'html5press' ), number_format_i18n( $count_posts->publish ) ),
					sprintf( _n( '%d page', '%d pages', $count_pages->publish, 'html5press' ), number_format_i18n( $count_posts->publish ) ),
					sprintf( _n( '%d comment', '%d comments', $count_comments->approved, 'html5press' ), number_format_i18n( $count_comments->approved ) ),
					sprintf( _n( '%d category', '%d categories', $count_cats, 'html5press' ), number_format_i18n( $count_cats ) ),
					sprintf( _n( '%d tag', '%d tags', $count_tags, 'html5press' ), number_format_i18n( $count_tags ) )
			);
			?>
			</p>
			
			<?php
			$tag_cloud = get_terms( 'post_tag' );
			if ( $tag_cloud ) :
			?>
					<h3><?php _e('Tag Cloud', 'html5press'); ?></h3>
					<div id="tag-cloud">
							<?php wp_tag_cloud('number=0'); ?>
					</div>
			<?php endif; ?>
			
			<h3><?php _e('Browse by Month', 'html5press'); ?></h3>
			<ul class="archive-list">
					<?php wp_get_archives('show_post_count=1'); ?>
			</ul>
			
			<br class="clear" />
			
			<h3><?php _e('Browse by Category', 'html5press'); ?></h3>
			<ul class="archive-list">
					<?php wp_list_categories( array( 'hierarchical' => true, 'show_count' => 1, 'title_li' => '' ) ); ?>
			</ul>
			
			<footer class="post-meta">
                <p>
                	<?php _e( 'Created ','html5press'); ?><time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" class="timeago" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time>
				</p>
				<?php /* Edit Link */ edit_post_link(); ?>
            </footer><!-- end post meta -->
			<article class="comments">
				<?php comments_template(); ?>
			</article>
		</article> <!-- end post 1 -->
		<?php endwhile; endif; ?>
    
	</div> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
