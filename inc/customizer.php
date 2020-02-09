<?php
/**
 * Instruktoři Brno Theme Customizer
 *
 * @package Instruktoři Brno
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function instruktori_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'instruktori_customize_register' );

/**
 * Add API keys and other secrets to theme settings.
 * 
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function instruktori_customizer_secrets( $wp_customize ) {
	$wp_customize->add_section( 'cd_secrets' , array(
		'title'      => 'API keys and secrets',
		'priority'   => 30,
		) 
	);
	$wp_customize->add_setting( 'google_maps_api_key' , array(
		'default'     => 'no-maps-api-aky',
		'transport'   => 'refresh',
		)
	);
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_maps_api_key', array(
		'label'      => 'Google Maps API key',
		'section'    => 'cd_secrets',
		'settings'   => 'google_maps_api_key',
		'type'		 => 'text',
		) ) 
	);
}
add_action( 'customize_register', 'instruktori_customizer_secrets' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function instruktori_customize_preview_js() {
	wp_enqueue_script( 'instruktori_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'instruktori_customize_preview_js' );
