<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage html5press
 * @since html5press 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.','html5press' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'html5press' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous alignleft"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments','html5press' ) ); ?></div>
				<div class="nav-next alignright"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>','html5press' ) ); ?></div>
			</div> <!-- .navigation -->
			<div class="clear"></div>
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
			
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use html5press_list_comments() to format the comments.
					 * See html5press_list_comments() in html5press/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'html5press_list_comments' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous alignleft"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments','html5press' ) ); ?></div>
				<div class="nav-next alignright"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>','html5press' ) ); ?></div>
			</div> <!-- .navigation -->
			<div class="clear"></div>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.','html5press' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
