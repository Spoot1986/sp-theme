<?php
/*
 * SP Theme Customizer
 */

//Add postMessage support for site title and description for the Theme Customizer.
function sp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'sp_customize_register' );


function sp_customizer_addition( $wp_customize ) {

	$wp_customize->add_panel( 
		'sp_default',
		array(
			'title'		=>	__('Default Setting','sp-theme'),
			'priority'	=>	1,
		)
	);

	$wp_customize->get_section( 'title_tagline' )->panel = 'sp_default';
	$wp_customize->get_section( 'colors' )->panel = 'sp_default';
	$wp_customize->get_section( 'background_image' )->panel = 'sp_default';
	$wp_customize->get_section( 'static_front_page' )->panel = 'sp_default';
	$wp_customize->get_section( 'custom_css' )->panel = 'sp_default';

}

add_action( 'customize_register', 'sp_customizer_addition' );

//Render the site title for the selective refresh partial.
function sp_customize_partial_blogname() {
	bloginfo( 'name' );
}

//Render the site tagline for the selective refresh partial.
function sp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

//Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function sp_customize_preview_js() {
	wp_enqueue_script( 'sp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sp_customize_preview_js' );