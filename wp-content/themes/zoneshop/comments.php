<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package thim
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area comment-container">
	<?php if ( have_comments() ) : ?>
		<div class="comment-stats">
			<?php
			echo esc_attr( get_comments_number() );
			if ( get_comments_number() == 0 ) {
				echo __( ' comment', 'thim' );
			} else {
				if ( get_comments_number() == 1 ) {
					echo __( ' comment', 'thim' );
				} else {
					echo __( ' comments', 'thim' );
				}
			}
			?>
		</div>
		<ol class="comment-list">
			<?php wp_list_comments( 'style=li&&type=comment&avatar_size=96&callback=thim_comment' ); ?>    <!-- .comment-list -->
		</ol><!-- .comment-list -->

		<div class="clear"></div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<div class="comment_nav">
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'thim' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'thim' ) ); ?></div>
				</div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation.  ?>
	<?php endif; // have_comments() ?>
	<?php if ( !comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'thim' ); ?></p>
	<?php endif; ?>
	<?php
	comment_form();
	?>

</div><!-- #comments -->