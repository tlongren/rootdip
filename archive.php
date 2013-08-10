<?php get_header(); ?>
<?php
if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
else :
	$curauth = get_userdata(intval($author));
endif;
?>
<main id="content" role="main" class="span7">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="pagetitle"><?php _e( 'Archive for the','rootdip' ); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e( 'Category','rootdip' ); ?></h1>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="pagetitle"><?php _e( 'Posts Tagged ','rootdip' ); ?>&#8216;<?php single_tag_title(); ?>&#8217;</h1>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="pagetitle"><?php _e( 'Archive for ','rootdip' ); ?><?php the_time('F jS, Y'); ?></h1>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="pagetitle"><?php _e( 'Archive for ','rootdip' ); ?><?php the_time('F, Y'); ?></h1>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="pagetitle"><?php _e( 'Archive for ','rootdip' ); ?><?php the_time('Y'); ?></h1>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="pagetitle"><?php _e( 'Author Archive for ','rootdip' ); ?><?php echo $curauth->display_name; ?></h1>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="pagetitle"><?php _e( 'Blog Archives','rootdip' ); ?></h1>
 	  <?php } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php if (!has_post_format('link')) { ?><span class="comments-link"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a></span><?php } ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
			<?php if ( has_post_thumbnail() ) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo "$image[0]"; ?>" alt="" class="thumbnail alignleft" /></a><?php } ?>
            
			<?php the_content(__( 'Read more','rootdip' )); ?>
			<?php /* Edit Link */ edit_post_link(); ?>
			<footer class="post-meta">
				<p>
					<?php _e( 'In ','rootdip'); ?><?php the_category(', '); ?>
					<?php _e( 'by ','rootdip'); ?> <span class="author vcard"><?php the_author_posts_link(); ?></span>
					<?php if ($rootdip_settings['fuzzy_timestamps'] == 0) { _e( 'on ','rootdip'); } ?> <time datetime="<?php the_time('Y-m-d\TH:i:sO'); ?>" class="timeago" pubdate><?php the_time( get_option( 'date_format' ) ); ?></time><?php if (get_the_modified_time() != get_the_time()) { ?>, updated <time datetime="<?php the_modified_time('Y-m-d\TH:i:sO'); ?>"><?php the_modified_date(); ?></time><?php } ?>
					<?php wp_link_pages( array( 'before' => __( '<span class="alignright">Pages:', 'rootdip' ), 'after' => '</span>' ) ); ?>
				</p>
				
            </footer> <!-- end post meta -->
        
        </article> <!-- end post 1 -->
		<hr />
		<?php endwhile; endif; ?>
		<h2 class="assistive-text"><?php _e( 'Post navigation', 'rootdip' ); ?></h2>
		<nav class="navigation">
			<div class="nav-previous alignleft"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts','rootdip' ) ); ?></div>
			<div class="nav-next alignright"><?php next_posts_link( __( 'Older Posts <span class="meta-nav">&rarr;</span>','rootdip' ) ); ?></div>
		</nav>
    </main> <!-- end main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
