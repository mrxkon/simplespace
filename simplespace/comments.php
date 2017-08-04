<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
	?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				echo __( 'One comment for', 'simplespace' ) . ' ';
				echo get_the_title();
			} else {
				echo number_format_i18n( $comments_number );
				echo ' ' . __( 'comments for', 'simplespace' ) . ' ';
				echo get_the_title();
			}
			?>
		</h2>
		<div class="comment-list">
			<?php
			wp_list_comments( 'type=comment&callback=simplespace_comment' );
			?>
		</div>

	<?php
	the_comments_pagination();
	}
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	echo '<p class="no-comments">' . __( 'Comments are closed.', 'simplespace' ) . '</p>';
	}
	comment_form();
	?>
</div>