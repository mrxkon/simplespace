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
			<h1 class="post-title">
				<?php
				if ( get_theme_mod( 'simplespace_do_titles' ) == 'yes' ) {
					echo '<small>' . __( 'read about:', 'simplespace' ) . ' </small>';
				}
				the_title();
				?>
			</h1>
			<div class="post-date"><i class="fa fa-calendar"></i> <?php the_date(); ?></div>
			<div class="post-category"><i class="fa fa-th-list"></i> <?php the_category( ', ' ); ?></div>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<hr/>
			<div class="post-tags"><?php the_tags( '<i class="fa fa-tag"></i> ', ', ' ); ?></div>
		</article>
	</div>
	<div class="comments-holder col-sm-12">
	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
	</div>
	<?php
	}
	?>
	<div class="col-sm-12 blog-pagination">
		<span class="pull-left"><?php echo previous_post_link( '%link', '<i class="fa fa-arrow-left"></i> Previous', true ); ?></span>
		<span class="pull-right"><?php echo next_post_link( '%link', 'Next <i class="fa fa-arrow-right"></i>', true ); ?></span>
	</div>
</div>
<?php
get_footer();
?>
