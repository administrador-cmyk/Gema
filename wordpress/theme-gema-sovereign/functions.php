<?php
/**
 * Gema Sovereign theme bootstrap.
 *
 * @package GemaSovereign
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function gema_sovereign_enqueue_assets(): void {
	$theme = wp_get_theme();
	$version = $theme->get( 'Version' ) ?: '0.1.0';

	wp_enqueue_style(
		'gema-sovereign-style',
		get_stylesheet_uri(),
		array(),
		$version
	);
}
add_action( 'wp_enqueue_scripts', 'gema_sovereign_enqueue_assets' );

function gema_sovereign_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'gema-sovereign' ),
			'footer'  => __( 'Menu footer', 'gema-sovereign' ),
		)
	);
}
add_action( 'after_setup_theme', 'gema_sovereign_setup' );

