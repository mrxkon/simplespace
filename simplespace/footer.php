<?php
if ( is_active_sidebar( 'bottom_widgets' ) ) {
	echo '<div class="row bottom-widget-area">';
	dynamic_sidebar( 'bottom_widgets' );
	echo '</div>';
}
?>
<div id="footer" class="row">
	<div class="col-sm-10 text-left" id="credits">
		<?php
		if ( get_theme_mod( 'simplespace_footer_text' ) ) {
			esc_attr( get_theme_mod( 'simplespace_footer_text' ) );
		} else {
			echo '&copy; ' . esc_attr( get_bloginfo( 'title' ) );
		}
		if ( get_theme_mod( 'simplespace_show_creds' ) ) {
		?>
		<br/>
		<a href="<?php echo esc_url( SIMPLESPACE_THEME_URL ); ?>">Simplespace</a> by
		<a href="<?php echo esc_url( SIMPLESPACE_AUTHOR_URL ); ?>">Xenos (xkon) Konstantinos</a>
		<br/>
		<a href="https://wordpress.org/" title="A Semantic Personal Publishing Platform">Proudly powered by WordPress</a>
		<?php
		}
		?>
	</div>
	<div class="col-sm-2 text-right" id="back-to-top">
		<a href="#toppage" title="<?php esc_attr_e( 'Back to Top', 'simplespace'); ?>"><i class="fa fa-arrow-up"></i> <?php esc_attr_e( 'Top', 'simplespace'); ?></a>
	</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>