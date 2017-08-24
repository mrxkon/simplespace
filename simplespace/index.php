<?php
get_header();

if ( is_tag() ) {
	$what = esc_attr( 'tag:', 'simplespace' );
} else {
	$what = esc_attr( 'category:', 'simplespace' );
}
?>
<div id="primary" class="row section">
	<div class="list-title-holder col-sm-12">
		<h1 class="post-title">
			<?php
			if ( get_theme_mod( 'simplespace_do_titles' ) == 'yes' ) {
				echo '<small>' . esc_attr( $what ) . ' </small>';
			}
			single_cat_title();
			?>
		</h1>
	</div>
	<?php

	if ( get_theme_mod( 'simplespace_the_category_column' ) ) {
		$the_category_column = get_theme_mod( 'simplespace_the_category_column' );
	} else {
		$the_category_column = 'col-sm-4';
	}

	if ( 'col-sm-4' == $the_category_column || 'col-sm-12' == $the_category_column ) {
		$row_count = 3;
	} elseif ( 'col-sm-6' == $the_category_column ) {
		$row_count = 2;
	}

	echo '<div class="row">';
	$count = 1;
	while ( have_posts() ) {
		the_post();
	?>
	<div class="list-post-holder <?php echo esc_attr( $the_category_column ); ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-image"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive', 'title' => get_the_title(), 'alt' => get_the_title() ) ); ?></div>
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
	if ( 0 == $count % $row_count ) {
		echo '</div><div class="row">';
	}
	$count++;
	}
	echo '</div>';
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
