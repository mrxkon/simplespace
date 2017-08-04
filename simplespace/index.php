<?php
get_header();

if ( is_tag() ) {
	$what = '<small>' . __( 'tag:', 'simplespace' ) . ' </small>';
} else {
	$what = '<small>' . __( 'category:', 'simplespace' ) . ' </small>';
}
?>
<div id="primary" class="row section">
	<div class="list-title-holder col-sm-12">
		<h1 class="post-title">
			<?php
			if ( get_theme_mod( 'simplespace_do_titles' ) == 'yes' ) {
				echo $what;
			}
			single_cat_title();
			?>
		</h1>
	</div>
	<?php
	while ( have_posts() ) {
		the_post();
	?>
	<div class="grid-item list-post-holder col-sm-12">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-image"><?php the_post_thumbnail( 'full', ['class' => 'img-responsive', 'title' => get_the_title(), 'alt' => get_the_title() ] ); ?></div>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="post-date"><i class="fa fa-calendar"></i> <?php the_date(); ?></div>
			<div class="post-category"><i class="fa fa-th-list"></i> <?php the_category(', '); ?></div>
			<div class="post-content">
				<?php the_excerpt(); ?>
			</div>
			<hr>
			<div class="post-tags"><?php the_tags( '<i class="fa fa-tag"></i> ', ', ' ); ?></div>
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
