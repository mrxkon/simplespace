<?php
get_header();
?>
<div id="primary" class="row section">
	<div class="post-holder col-sm-12">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			if ( is_front_page() ) {
				while ( have_posts() ) {
					the_post();
					?>
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					<?php
				}
			}
			?>
		</article>
	</div>
	<?php
	if ( get_theme_mod( 'simplespace_show_latest' ) == 'yes' ) {
	?>
	<div class="col-sm-12">
		<h1 class="post-title">
		<?php
		if ( get_theme_mod( 'simplespace_portfolio_widget_title' ) ) {
			$latest_title = get_theme_mod( 'simplespace_portfolio_widget_title' );
			echo esc_attr( $latest_title );
		} else {
			esc_attr_e( 'Portfolio', 'simplespace' );
		}
		?>
		</h1>
		<?php
		$the_category = get_theme_mod( 'simplespace_the_category' );
		$post_count = get_theme_mod( 'simplespace_latestposts_number' );

		if ( get_theme_mod( 'simplespace_the_post_column' ) ) {
			$the_post_column = get_theme_mod( 'simplespace_the_post_column' );
		} else {
			$the_post_column = 'col-sm-4';
		}

		if ( 'col-sm-4' == $the_post_column || 'col-sm-12' == $the_post_column ) {
			$row_count = 3;
		} elseif ( 'col-sm-6' == $the_post_column ) {
			$row_count = 2;
		}

		$query = new WP_Query(
			array(
				'category_name' => $the_category,
				'posts_per_page' => $post_count,
			)
		);

		echo '<div class="row">';
		$count = 1;
		while ( $query->have_posts() ) {
			$query->the_post();

			echo '<div class="cvworks ' . esc_attr( $the_post_column ) . '">';
			echo '<div class="ajax-post_image">' . get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ) . '</div>';
			echo '<div class="ajax-post-title"><h3><a href="' . esc_url( get_the_permalink() ) . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3></div> ';
			echo '<div class="ajax-post-description">' . the_excerpt() . '</div> ';
			echo '<div class="ajax-post-date"><i class="fa fa-calendar"></i> ' . get_the_date() . '</div>';
			echo '<div class="ajax-post-category"><i class="fa fa-th-list"></i> ';
			the_category( ', ' );
			echo '</div>';
			echo '<div class="ajax-post-tags">';
			the_tags( '<i class="fa fa-tag"></i> ' );
			echo '</div>';
			echo '</div>';
			if ( 0 == $count % $row_count ) {
				echo '</div><div class="row">';
			}
			$count++;
		}
		echo '</div>';
		?>
	</div>
	<?php
	}
	?>
</div>
<?php
get_footer();
?>
