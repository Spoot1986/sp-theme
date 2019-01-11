<?php
/*
 * sp functions and definitions
 */

if ( ! function_exists( 'sp_setup' ) ) :

	function sp_setup() {

		load_theme_textdomain( 'sp-theme', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );


		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'sp-theme' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		add_theme_support( 'custom-background', apply_filters( 'sp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;

add_action( 'after_setup_theme', 'sp_setup' );


function sp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sp_content_width', 640 );
}
add_action( 'after_setup_theme', 'sp_content_width', 0 );

//Register widget area.
function sp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'sp-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'sp-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'sp_widgets_init' );

//Enqueue scripts and styles.
function sp_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style('cms-style', get_stylesheet_uri() );
	wp_enqueue_style('mediascreen', get_template_directory_uri().'/css/mediascreen.css');
	wp_enqueue_style('swiper', get_template_directory_uri().'/css/swiper.css');
	wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.css');
	wp_enqueue_style('fontawesome', get_template_directory_uri().'/css/fontawesome-all.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.js');
	wp_enqueue_script('wow', get_template_directory_uri().'/js/wow.js');
	wp_enqueue_script('lazyload', get_template_directory_uri().'/js/lazyload.js');
	wp_enqueue_script('script', get_template_directory_uri().'/js/script.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sp_scripts' );

//Include the TGM_Plugin_Activation class.
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

//Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/sp-class.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

//Customizer additions.
require get_template_directory() . '/inc/customizer.php';