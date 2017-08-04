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
			esc_attr_e( 'Comments', 'simplespace' );
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
	echo '<p class="no-comments">' . esc_attr__( 'Comments are closed.', 'simplespace' ) . '</p>';
	}
	comment_form();
	?>
</div>