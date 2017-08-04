<?php
get_header();
?>
<div id="primary" class="row section">
	<div class="col-sm-12">
		<?php
		if ( get_theme_mod( 'simplespace_404_img' ) ) {
			echo '<div class="col-sm-12 text-center">';
			echo '<img class="fourofour-image img-responsive" src="' . get_theme_mod( 'simplespace_404_img' ) . '" alt="Page not found"/>';
			echo '</div>';
		}
		?>
	</div>
	<div class="col-sm-12">
		<h1><?php echo __( 'But but... where could the page be?', 'simplespace'); ?></h1>
		<?php echo __( "It looks like you've found a missing page!", 'simplespace'); ?>
		<h3><?php echo __( "Don't panic!", 'simplespace'); ?>'</h3>
		<?php echo __( 'Here are 3 awesome things you could do:', 'simplespace'); ?>
		<ol>
			<li><?php echo __( 'Select a page from the menu', 'simplespace'); ?></li>
			<li><?php echo __( 'Go to the', 'simplespace'); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php echo __( 'Homepage', 'simplespace'); ?></a></li>
			<li><?php echo __( 'Try another search!', 'simplespace'); ?></li>
		</ol>
		<?php get_search_form(); ?>
	</div>
</div>
<?php
get_footer();
?>
