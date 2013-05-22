<?php get_header(); ?>

<?php $options = html5press_get_options(); ?>

<main id="content" role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article <?php post_class(); ?>>
	
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

		<div class="alignleft prev-post">
			<?php previous_image_link( false, __( 'Previous Attachment', 'html5press' ) ); ?>
		</div>

		<div class="alignright next-post">
			<?php next_image_link( false, __( 'Next Attachment','html5press' ) ); ?>
		</div>
		
		<div class="clear"></div>

		<?php
			if ( wp_attachment_is_image() ) :
				$att_image   = wp_get_attachment_image_src( $post->ID, 'medium' );
				$large_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $options['featured_image_size'] );
				$excerpt     = $post->post_excerpt;
		?>

			<figure>
				<a href="<?php echo esc_url( $large_image[0] ); ?>" title="<?php the_title(); ?>" rel="lightbox">
					<img src="<?php echo esc_url( $att_image[0] ); ?>" width="<?php echo esc_attr( $att_image[1] ); ?>" height="<?php echo esc_attr( $att_image[2] ); ?>" class="attachment-medium" alt="<?php esc_attr( $excerpt ); ?>" />
				</a>

				<figcaption><?php if ( ! empty( $excerpt ) ) echo $excerpt; ?></figcaption>
			</figure>

			<p><a href="<?php echo get_permalink( $post->post_parent ); ?>">&laquo;<?php _e( 'Back to Post','html5press' ); ?></a></p>

		<?php else : ?>

			<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename( $post->guid ); ?></a>
		
			<div><?php if ( ! empty( $excerpt ) ) echo $excerpt; ?></div>

		<?php endif; ?>

		<?php /* Edit Link */ edit_post_link(); ?>

		<footer class="post-meta">
			<p>
				<?php printf( __( 'Created on %s', 'html5press' ), '<time datetime="' . get_the_date('Y-m-d\TH:i:sO') . '" pubdate>' . get_the_date( get_option( 'date_format' ) ) . '</time>' ); ?>
			</p>
		</footer> <!-- .post-meta -->

		<article class="comments">
			<?php comments_template(); ?>
		</article>

	</article> <!-- end post 1 -->

	<?php endwhile; endif; ?>
	
</div> <!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
