<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Constructionn_Pro
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
<div class="comment-area-wrap">
	<?php echo constructionn_pro_get_comment_count(); ?>
	<div id="comments" class="comments-area">
		<?php
			// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<?php the_comments_navigation(); ?>

				<ol class="comment-list">
				<?php
					wp_list_comments(
						array(
							'style'      => 'ol',
							'short_ping' => true,
							'callback'   => 'constructionn_pro_comment_list',
						)
					);
				?>
				</ol><!-- .comment-list -->

				<?php
				the_comments_navigation();

				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() ) :
					?>
					<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'constructionn-pro' ); ?></p>
					<?php
				endif;

			endif; // Check for have_comments().


			comment_form(
				array(
					'title_reply_before'   => __( '<h5 id="reply-title" class="comment-reply-title">', 'constructionn-pro' ),
					'title_reply'          => __( 'Leave a Reply Here', 'constructionn-pro' ),
					'title_reply_after'    => __( '</h5>', 'constructionn-pro' ),
					'title_reply_to'       => __( 'Reply to %s', 'constructionn-pro' ),
					'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.', 'constructionn-pro' ) . '</span><span class="required-field-message">' . __( ' Required fields are marked ', 'constructionn-pro' ) . '<span class="required">*</span></span>' . '</p>',
					'label_submit'         => __( 'Submit Now', 'constructionn-pro' ),
					'class_form'           => 'comment-form',
					'class_submit'         => 'submit',
					'fields'               => array(
						'author' => '<div class="row">
										<div class="col-md-6 col-12">
											<p class="comment-form-author">
												<label for="author">' . __( 'Name', 'constructionn-pro' ) . ' <span class="required">*</span></label> ' .
												'<input id="author" name="author" type="text" placeholder="' . __( 'Your Name *', 'constructionn-pro' ) . '" value="' . esc_attr( $req ? $commenter['comment_author'] : '' ) . '" size="30" aria-required="true" required />
											</p>
										</div>
										<div class="col-md-6 col-12">
											<p class="comment-form-author-email">
												<label class="screen-reader-text" for="email">' . __( 'Email', 'constructionn-pro' ) . '<span class="required">*</span></label>
												<input id="email" name="email" placeholder="' . __( 'Email *', 'constructionn-pro' ) . '" type="text" value="' . esc_attr( $req ? $commenter['comment_author_email'] : '' ) . '" size="30" aria-required="true" required>
											</p>
										</div>
									</div>',
						'url'    => '<p class="comment-form-url"><label class="screen-reader-text" for="url" for="url">' . __( 'Website', 'constructionn-pro' ) . '</label> ' .
									'<input id="url" name="url" type="text" placeholder="' . __( 'Website', 'constructionn-pro' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
					),
					'comment_field'        => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . __( 'Comment', 'constructionn-pro' ) . '</label>' . '<textarea id="comment" name="comment" placeholder="' . __( 'Comment here *', 'constructionn-pro' ) . '" cols="40" rows="8" aria-required="true" required></textarea></p>',
				)
			);
			?>

	</div><!-- #comment-area-wrap -->
</div><!-- #comments -->
