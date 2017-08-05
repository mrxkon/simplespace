<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
	<?php
	if ( has_header_image() ) {
		$title = esc_attr( get_bloginfo( 'title' ) );
	?>
	<div id="header-image" class="row">
		<div class="col-sm-12">
			<img src="<?php header_image(); ?>" height="<?php echo intval( get_custom_header()->height ); ?>" width="<?php echo intval( get_custom_header()->width ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
		</div>
	</div>
	<?php } ?>
	<div id="header" class="row">
		<div class="col-sm-12">
			<div id="gravatar">
				<?php
				if ( has_custom_logo() ) {
					$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
					$title = esc_attr( get_bloginfo( 'title' ) );
					echo '<img class="logo" src="' . esc_url( $image[0] ) . '" title="' . esc_attr( $title ) . '" alt="' . esc_attr( $title ) . '"/>';
				} elseif ( get_theme_mod( 'simplespace_gravatar' ) ) {
					$admin_email = get_theme_mod( 'simplespace_gravatar' );
					$default = 'gravatar_default';
					$title = esc_attr( get_bloginfo( 'title' ) );
					echo get_avatar( $admin_email, '100', null, esc_attr( $title ),
						array(
							'class' => array( 'img-circle' ),
						)
					);
				} else {
					$admin_email = get_option( 'admin_email' );
					$title = esc_attr( get_bloginfo( 'title' ) );
					echo get_avatar( $admin_email, '100', null, esc_attr( $title ),
						array(
							'class' => array( 'img-circle' ),
						)
					);
				}
				?>
			</div>
			<div id="brand">
				<div class="info">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'title' ); ?>"><?php bloginfo( 'title' ); ?></a>
					</h1>
					<span><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
				</div>
				<div class="social-media-icons">
					<?php
					if ( get_theme_mod( 'simplespace_sm_wp' ) ) {
						echo '<a href="' . esc_url( get_theme_mod( 'simplespace_sm_wp' ) ) .
							'" title="' . esc_attr( 'Find me on WordPress', 'simplespace' ) .
							'"><i class="fa fa-wordpress"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_git' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_git' ) ) .
							'" title="' . esc_attr( 'Find me on GitHub', 'simplespace' ) .
							'"><i class="fa fa-github"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_in' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_in' ) ) .
							'" title="' . esc_attr( 'Find me on LinkedIn', 'simplespace' ) .
							'"><i class="fa fa-linkedin"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_da' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_da' ) ) .
							'" title="' . esc_attr( 'Find me on DeviantArt', 'simplespace' ) .
							'"><i class="fa fa-deviantart"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_fb' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_fb' ) ) .
							'" title="' . esc_attr( 'Find me on Facebook', 'simplespace' ) .
							'"><i class="fa fa-facebook"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_tt' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_tt' ) ) .
							'" title="' . esc_attr( 'Find me on Twitter', 'simplespace' ) .
							'"><i class="fa fa-twitter"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_ig' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_ig' ) ) .
							'" title="' . esc_attr( 'Find me on Instagram', 'simplespace' ) .
							'"><i class="fa fa-instagram"></i></a>';
					}
					if ( get_theme_mod( 'simplespace_sm_gp' ) ) {
						echo ' <a href="' . esc_url( get_theme_mod( 'simplespace_sm_gp' ) ) .
							'" title="' . esc_attr( 'Find me on Google+', 'simplespace' ) .
							'"><i class="fa fa-google-plus"></i></a>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div id="nav" class="row">
		<div class="col-sm-12 main-navigation text-center">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
			) );
			?>
		</div>
	</div>
	<?php
	if ( is_active_sidebar( 'top_widgets' ) ) {
		echo '<div class="row top-widget-area">';
		dynamic_sidebar( 'top_widgets' );
		echo '</div>';
	}
	?>
