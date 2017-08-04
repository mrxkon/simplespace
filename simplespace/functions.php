<?php
/*-----------------------------------------------------------------------------------*/
/* If this file is called directly, abort
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*-----------------------------------------------------------------------------------*/
/* Define the version as a constant so we can easily replace it throughout the theme
/*-----------------------------------------------------------------------------------*/
define( 'WHITESPACE_VERSION', '1.0.1' );
define( 'BOOTSTRAP_VERSION', '3.3.7' );
define( 'SWIPEBOX_VERSION', '1.4.4' );
define( 'MATCHHEIGHT_VERSION', '0.7.2' );

/*-----------------------------------------------------------------------------------*/
/* Add theme supports
/*-----------------------------------------------------------------------------------*/
function simplespace_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );
	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}
}
add_action( 'after_setup_theme', 'simplespace_setup' );

function simplespace_load_comment_reply() {
	if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
		wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
	}
}
add_action(  'wp_enqueue_scripts', 'simplespace_load_comment_reply' );

/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
function simplespace_register_menus() {
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'simplespace' ),
		)
	);
}
add_action( 'after_setup_theme', 'simplespace_register_menus' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function simplespace_scripts()
{
	wp_enqueue_style( 'simplespace-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), BOOTSTRAP_VERSION );

	wp_enqueue_style( 'simplespace-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), WHITESPACE_VERSION );

	wp_enqueue_style( 'simplespace-fonts', 'https://fonts.googleapis.com/css?family=Fira+Mono:400,500,700|Marko+One&amp;subset=greek', array(), WHITESPACE_VERSION );

	wp_enqueue_style( 'simplespace-swipebox', get_template_directory_uri() . '/css/swipebox.min.css', array(), WHITESPACE_VERSION );

	wp_enqueue_style( 'simplespace', get_stylesheet_uri(), array(), WHITESPACE_VERSION );

	wp_enqueue_script( 'simplespace-bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), BOOTSTRAP_VERSION, true );

	wp_enqueue_script( 'simplespace-matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array( 'jquery' ), MATCHHEIGHT_VERSION, true );

	wp_enqueue_script( 'simplespace-swipebox', get_template_directory_uri() . '/js/jquery.swipebox.min.js', array( 'jquery' ), SWIPEBOX_VERSION, true );

	wp_enqueue_script( 'simplespace-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), WHITESPACE_VERSION, true );

	wp_enqueue_script( 'simplespace-ajax-request', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), WHITESPACE_VERSION );

	wp_localize_script( 'simplespace-ajax-request', 'simplespaceAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'simplespace_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Theme customizer options
/*-----------------------------------------------------------------------------------*/
function simplespace_customize( $wp_customize )
{

	//	General Options

	$wp_customize->add_section(
		'simplespace_options',
		array(
			'title' => __( 'Simplespace Options', 'simplespace' ),
			'priority' => 100,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting( 'simplespace_gravatar',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_email',
		)
	);

	$wp_customize->add_control(
		'simplespace_avatar', array(
			'label' => __( 'Alternative Gravatar Email', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_gravatar',
			'type' => 'email',
		)
	);

	$wp_customize->add_setting( 'simplespace_404_img',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'simplespace_404_img',
			array(
				'label' => __( 'Upload 404 Image', 'simplespace' ),
				'section' => 'simplespace_options',
				'settings' => 'simplespace_404_img',
			)
		)
	);

	$wp_customize->add_setting( 'simplespace_portfolio_widget_title',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_text',
		)
	);

	$wp_customize->add_control(
		'simplespace_portfolio_widget_title', array(
			'label' => __( 'Portfolio Widget Title', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_portfolio_widget_title',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting( 'simplespace_top_widget_column',
		array(
			'default' => 'col-sm-6 col-md-3',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_top_widget_column', array(
			'label' => __( 'Top Widgets Columns', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_top_widget_column',
			'type' => 'select',
			'choices' => array(
				'col-sm-12' => __( 'One Column', 'simplespace' ),
				'col-sm-6' => __( 'Two Columns', 'simplespace' ),
				'col-sm-4' => __( 'Three Columns', 'simplespace' ),
				'col-sm-6 col-md-3' => __( 'Four Columns', 'simplespace' ),
			),
		)
	);

	$wp_customize->add_setting( 'simplespace_bottom_widget_column',
		array(
			'default' => 'col-sm-6 col-md-3',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_bottom_widget_column', array(
			'label' => __( 'Bottom Widgets Columns', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_bottom_widget_column',
			'type' => 'select',
			'choices' => array(
				'col-sm-12' => __( 'One Column', 'simplespace' ),
				'col-sm-6' => __( 'Two Columns', 'simplespace' ),
				'col-sm-4' => __( 'Three Columns', 'simplespace' ),
				'col-sm-6 col-md-3' => __( 'Four Columns', 'simplespace' ),
			),
		)
	);

	$wp_customize->add_setting( 'simplespace_footer_text',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_text',
		)
	);

	$wp_customize->add_control(
		'simplespace_footer_text', array(
			'label' => __( 'Footer Text', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_footer_text',
			'type' => 'textarea',
		)
	);

	$wp_customize->add_setting( 'simplespace_show_creds',
		array(
			'default' => 'yes',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_show_creds', array(
			'label' => __( 'Show credits', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_show_creds',
			'type' => 'select',
			'choices' => array(
				'yes' => __( 'Yes', 'simplespace' ),
				'no' => __( 'No', 'simplespace' ),
			),
		)
	);

	$wp_customize->add_setting( 'simplespace_do_titles',
		array(
			'default' => 'yes',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_do_titles', array(
			'label' => __( 'Show "category:" etc titles', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_do_titles',
			'type' => 'select',
			'choices' => array(
				'yes' => __( 'Yes', 'simplespace' ),
				'no' => __( 'No', 'simplespace' ),
			),
		)
	);

	$wp_customize->add_setting( 'simplespace_show_latest',
		array(
			'default' => 'yes',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_show_latest', array(
			'label' => __( 'Show Latest on Front Page', 'simplespace' ),
			'section' => 'simplespace_options',
			'settings' => 'simplespace_show_latest',
			'type' => 'select',
			'choices' => array(
				'yes' => __( 'Yes', 'simplespace' ),
				'no' => __( 'No', 'simplespace' ),
			),
		)
	);

	$wp_customize->add_setting( 'simplespace_the_category',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_select',
		)
	);

	$wp_customize->add_control(
		'simplespace_the_category', array(
			'settings' => 'simplespace_the_category',
			'label' => 'Select Category:',
			'section' => 'simplespace_options',
			'type' => 'select',
			'choices' => simplespace_get_category(),
		)
	);

	//	Social Media Options

	$wp_customize->add_section(
		'simplespace_social_media',
		array(
			'title' => __( 'Social Media Links', 'simplespace' ),
			'priority' => 100,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_wp',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_wp', array(
			'label' => __( 'WordPress Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_wp',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_git',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_git', array(
			'label' => __( 'GitHub Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_git',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_in',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_in', array(
			'label' => __( 'LinkedIn Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_in',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_da',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_da', array(
			'label' => __( 'DeviantArt Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_da',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_fb',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_fb', array(
			'label' => __( 'Facebook Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_fb',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_tt',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_tt', array(
			'label' => __( 'Twitter Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_tt',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_ig',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_ig', array(
			'label' => __( 'Instagram Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_ig',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting( 'simplespace_sm_gp',
		array(
			'default' => '',
			'sanitize_callback' => 'simplespace_sanitize_customizer_url',
		)
	);

	$wp_customize->add_control(
		'simplespace_sm_gp', array(
			'label' => __( 'Google+ Link', 'simplespace' ),
			'section' => 'simplespace_social_media',
			'settings' => 'simplespace_sm_gp',
			'type' => 'url',
		)
	);
}

add_action( 'customize_register', 'simplespace_customize' );

function simplespace_get_category()
{
	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach ( $categories as $category ) {
		if ( $i == 0 ) {
			$default = $category->slug;
			$i++;
		}
		$cats[ $category->slug ] = $category->name;
	}
	return $cats;
}

function simplespace_sanitize_customizer_text( $value )
{
	$sanitized = sanitize_text_field( $value );
	return $sanitized;
}

function simplespace_sanitize_customizer_email( $value )
{
	$sanitized = sanitize_email( $value );
	return $sanitized;
}

function simplespace_sanitize_customizer_url( $value )
{
	$sanitized = esc_url( $value );
	return $sanitized;
}

function simplespace_sanitize_customizer_select( $value )
{
	$sanitized = sanitize_text_field( $value );
	return $sanitized;
}

/*-----------------------------------------------------------------------------------*/
/* Register Widget & Sidebar areas
/*-----------------------------------------------------------------------------------*/
function simplespace_register_areas()
{

	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="col-sm-12 sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	if ( get_theme_mod( 'simplespace_top_widget_column' ) ) {
		$top_widget_spacing = get_theme_mod( 'simplespace_top_widget_column' );
	} else {
		$top_widget_spacing = 'col-sm-6 col-md-3';
	}

	register_sidebar( array(
		'name' => 'Top Widgets',
		'id' => 'top_widgets',
		'before_widget' => '<div class="' . $top_widget_spacing . ' top-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	if ( get_theme_mod( 'simplespace_bottom_widget_column' ) ) {
		$bottom_widget_spacing = get_theme_mod( 'simplespace_bottom_widget_column' );
	} else {
		$bottom_widget_spacing = 'col-sm-6 col-md-3';
	}

	register_sidebar( array(
		'name' => 'Bottom Widgets',
		'id' => 'bottom_widgets',
		'before_widget' => '<div class="' . $bottom_widget_spacing . ' bottom-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'simplespace_register_areas' );

/*-----------------------------------------------------------------------------------*/
/* Ajax Calls
/*-----------------------------------------------------------------------------------*/
function simplespace_fetch_index_post()
{
	$the_category = get_theme_mod( 'simplespace_the_category' );
	if ( ! empty( $_REQUEST['id'] ) ) {
		$post_id = $_REQUEST['id'];
		$query = new WP_Query(
			array(
				'p' => $post_id,
				'category_name' => $the_category,
				'posts_per_page' => 1,
			)
		);
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<div class="ajax-post_image">' . get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ) . '</div>';
			echo '<div class="ajax-post-title"><h3><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3></div> ';
			echo '<div class="ajax-post-description">' . the_excerpt() . '</div> ';
			echo '<div class="ajax-post-date"><i class="fa fa-calendar"></i> ' . get_the_date() . '</div>';
			echo '<div class="ajax-post-category"><i class="fa fa-th-list"></i> ';
			the_category( ', ' );
			echo '</div>';
			echo '<div class="ajax-post-tags">' . get_the_tag_list( '<i class="fa fa-tag"></i> ', ', ' ) . '</div> ';
			echo '<div class="ajax-post-pagination">';
			$prev_post = get_previous_post( true );
			$next_post = get_next_post( true );
			if ( ! empty( $prev_post ) ) {
				echo '<a href="#" class="pull-left ajax-prev-post" data-id="' . $prev_post->ID . '"><i class="fa fa-arrow-left"></i> ' . __( 'Previous', 'simplespace' ) . '</a>';
			}
			if ( ! empty( $next_post ) ) {
				echo '<a href="#" class="pull-right ajax-next-post" data-id="' . $next_post->ID . '">' . __( 'Next', 'simplespace' ) . ' <i class="fa fa-arrow-right"></i></a>';
			}
			echo '</div>';
		}
	} else {
		$query = new WP_Query(
			array(
				'category_name' => $the_category,
				'posts_per_page' => 1,
			)
		);
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<div class="ajax-post_image">' . get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ) . '</div>';
			echo '<div class="ajax-post-title"><h3><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3></div> ';
			echo '<div class="ajax-post-description">' . the_excerpt() . '</div> ';
			echo '<div class="ajax-post-date"><i class="fa fa-calendar"></i> ' . get_the_date() . '</div>';
			echo '<div class="ajax-post-category"><i class="fa fa-th-list"></i> ';
			the_category( ', ' );
			echo '</div>';
			echo '<div class="ajax-post-tags">' . get_the_tag_list( '<i class="fa fa-tag"></i> ', ', ' ) . '</div> ';
			echo '<div class="ajax-post-pagination">';
			$prev_post = get_previous_post( true );
			$next_post = get_next_post( true );
			if ( ! empty( $prev_post ) ) {
				echo '<a href="#" class="pull-left ajax-prev-post" data-id="' . $prev_post->ID . '"><i class="fa fa-arrow-left"></i> ' . __( 'Previous', 'simplespace' ) . '</a>';
			}
			if ( ! empty( $next_post ) ) {
				echo '<a href="#" class="pull-right ajax-next-post" data-id="' . $next_post->ID . '">' . __( 'Next', 'simplespace' ) . ' <i class="fa fa-arrow-right"></i></a>';
			}
			echo '</div>';
		}
	}
	echo "<script>
					/* <![CDATA[ */
					(function($){
						$('.ajax-prev-post').on('click', function ( event ) {
							event.preventDefault();
							var id = $( this ).data( 'id' );
							getPrevPost(id);
						});
						
						$('.ajax-next-post').on('click', function ( event ) {
							event.preventDefault();
							var id = $( this ).data( 'id' );
							getNextPost(id);
						});
						
						function getPrevPost(id) {

							$.ajax({
								url: simplespaceAjax.ajaxurl,
								data: {
									'action' : 'fetch_index_post',
									'id' : id
								},
								success:function(data) {
									$('#ajax-post-content').html(data);
								}
							});
						};
				
						function getNextPost() {
				
							var id = $('.ajax-next-post').data('id');
				
							$.ajax({
								url: simplespaceAjax.ajaxurl,
								data: {
									'action' : 'fetch_index_post',
									'id' : id
								},
								success:function(data) {
									$('#ajax-post-content').html(data);
								}
							});
						};
						
					})(jQuery)
					/* ]]> */
				</script>";
	die();
}

add_action( 'wp_ajax_simplespace_fetch_index_post', 'simplespace_fetch_index_post' );
add_action( 'wp_ajax_nopriv_simplespace_fetch_index_post', 'simplespace_fetch_index_post' );

/*-----------------------------------------------------------------------------------*/
/* Change Comments Output
/*-----------------------------------------------------------------------------------*/
function simplespace_comment( $comment, $args, $depth ) {
	echo '<div ';
	echo comment_class( empty( $args['has_children'] ) ? '' : 'parent' );
	echo ' id="comment-';
	echo comment_ID();
	echo '">';
	echo '<div id="div-comment-';
	echo comment_ID();
	echo '" class="comment-body">';
	echo '<div class="comment-author vcard">';
	echo '<div class="comment-avatar">';
	if ( $args['avatar_size'] != 0 ) {
		echo get_avatar( $comment, '32', null, null,
			array(
				'class' => array( 'img-circle' ),
			)
		);
	}
	echo '</div>';
	echo '<div class="comment-author-name">';
	echo get_comment_author_link() . ' ';
	echo __( 'said:', 'simplespace' );
	echo '</div>';
	echo '</div>';
	if ( $comment->comment_approved == '0' ) {
		echo '<em class="comment-awaiting-moderation">' . __( 'Your comment is awaiting moderation.', 'simplespace' ) . '</em>';
		echo '<br />';
	}
	echo '<div class="comment-meta commentmetadata">';
	echo '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';
	echo get_comment_date() . ' ';
	echo get_comment_time() . ' ';
	echo edit_comment_link( __( '(Edit)', 'simplespace' ), '  ', '' );
	echo '</a>';
	echo '</div>';
	comment_text();
	echo '<div class="reply">';
	comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below' => 'comment',
				'depth' => $depth,
				'max_depth' => $args['max_depth'],
			)
		)
	);
	echo '</div><hr/>';
	echo '</div>';
	echo '</div>';
}

/*-----------------------------------------------------------------------------------*/
/* Change Gallery Output
/*-----------------------------------------------------------------------------------*/
function simplespace_ct_post_gallery( $output, $attr ) {
	global $post;

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => '',
	), $attr));

	$id = intval( $id );
	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts(
			array(
				'include' => $include,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $order,
				'orderby' => $orderby,
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if (empty($attachments)) return '';

	$output = '<div class="col-sm-12">';
	if ( $columns >= 7 ) {
		$myColumns = 1;
	} elseif ( $columns == 6 ) {
		$myColumns = 2;
	} elseif ( $columns == 5 ) {
		$myColumns = 2;
	} elseif ( $columns == 4 ) {
		$myColumns = 3;
	} elseif ( $columns == 3 ) {
		$myColumns = 4;
	} elseif ( $columns == 2 ) {
		$myColumns = 6;
	} elseif ( $columns == 1 ) {
		$myColumns = 12;
	}

	foreach ($attachments as $id => $attachment) {
		$img = wp_get_attachment_image_src($id, 'full');

		$output .= '<div class="gall-img col-sm-' . $myColumns . '">';
		$output .= "<a rel=\"gallery-1\" href=\"{$img[0]}\" class=\"swipebox\">";
		$output .= "<img src=\"{$img[0]}\" class=\" img-responsive\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />";
		$output .= "</a>";
		$output .= '</div>';
	}

	$output .= '</div>';

	return $output;
}
add_filter('post_gallery', 'simplespace_ct_post_gallery', 10, 2);
