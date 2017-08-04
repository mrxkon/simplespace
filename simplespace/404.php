<?php
get_header();
?>
<div id="primary" class="row section">
	<div class="col-sm-12">
		<?php
		if ( get_theme_mod( 'simplespace_404_img' ) ) {
			echo '<div class="col-sm-12 text-center">';
			echo '<img class="fourofour-image img-responsive" src="' . esc_url ( get_theme_mod( 'simplespace_404_img' ) ) . '" alt="Page not found"/>';
			echo '</div>';
		}
		?>
	</div>
	<div class="col-sm-12">
		<h1><?php esc_attr_e( 'But but... where could the page be?', 'simplespace'); ?></h1>
		<?php esc_attr_e( "It looks like you've found a missing page!", 'simplespace'); ?>
		<h3><?php esc_attr_e( "Don't panic!", 'simplespace'); ?>'</h3>
		<?php esc_attr_e( 'Here are 3 awesome things you could do:', 'simplespace'); ?>
		<ol>
			<li><?php esc_attr_e( 'Select a page from the menu', 'simplespace'); ?></li>
			<li><?php esc_attr_e( 'Go to the', 'simplespace'); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_attr_e( 'Homepage', 'simplespace'); ?></a></li>
			<li><?php esc_attr_e( 'Try another search!', 'simplespace'); ?></li>
		</ol>
		<?php get_search_form(); ?>
	</div>
</div>
<?php
get_footer();
?>
