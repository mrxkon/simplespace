<?php
get_header();
?>
<div id="primary" class="row section">
	<?php
	if ( get_theme_mod( 'simplespace_show_latest' ) == 'no' && ! is_active_sidebar( 'sidebar' ) ) {
	?>
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
	} elseif ( get_theme_mod( 'simplespace_show_latest' ) == 'no' && is_active_sidebar( 'sidebar' ) ) {
	?>
	<div class="post-holder col-sm-8">
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
	<div id="sidebar" class="post-holder col-sm-4">
		<?php
		if ( is_active_sidebar( 'sidebar' ) ) {
			dynamic_sidebar( 'sidebar' );
		}
		?>
	</div>
	<?php
	} else {
	?>
		<div class="post-holder col-sm-8">
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
		<div id="sidebar" class="post-holder col-sm-4">
			<div class="col-sm-12">
				<h2>
					<?php
					if ( get_theme_mod( 'simplespace_portfolio_widget_title' ) ) {
						$latest_title = get_theme_mod( 'simplespace_portfolio_widget_title' );
						echo esc_attr( $latest_title );
					} else {
						esc_attr_e( 'Portfolio', 'simplespace' );
					}
					?>
				</h2>
				<div id="ajax-post-content">
				</div>
			</div>
			<?php
			if ( is_active_sidebar( 'sidebar' ) ) {
				dynamic_sidebar( 'sidebar' );
			}
			?>
		</div>
	<?php
	}
	?>
</div>
<?php
get_footer();
?>
