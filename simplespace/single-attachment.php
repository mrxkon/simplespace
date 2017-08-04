<?php
get_header();
?>
<div id="primary" class="row section">
	<?php
	while ( have_posts() ) {
		the_post();
		?>
		<div class="post-holder col-sm-12">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<div class="post-date"><i class="fa fa-calendar"></i> <?php the_date(); ?></div>
				<div class="attachment-content">
					<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
						<p class="attachment"><a href="<?php echo esc_url( wp_get_attachment_url($post->id) ); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo esc_url( $att_image[0] );?>" width="<?php echo esc_attr( $att_image[1] );?>" height="<?php echo esc_attr( $att_image[2] );?>"  class="img-responsive attachment-full" alt="<?php $post->post_excerpt; ?>" /></a>
						</p>
					<?php else : ?>
						<a href="<?php echo esc_url( wp_get_attachment_url($post->ID) ); ?>" title="<?php echo get_the_title($post->ID); ?>" rel="attachment"><?php echo esc_attr( basename($post->guid) ); ?></a>
					<?php endif; ?>
				</div>
				<hr/>
			</article>
		</div>
		<?php
	}
	?>
	<div class="col-sm-12 blog-pagination">
		<?php
		posts_nav_link(
			' ',
			'<span class="pull-right">Next Page <i class="fa fa-arrow-right"></i></span>',
			'<span class="pull-left"><i class="fa fa-arrow-left"></i> Previous Page</span>'
		);
		?>
	</div>
</div>
<?php
get_footer();
?>
