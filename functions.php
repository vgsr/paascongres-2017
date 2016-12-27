<?php

/**
 * Paascongres 2017 Theme Functions
 * 
 * @package Paascongres 2017
 * @subpackage Main
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Setup requirements for the theme
 *
 * @since 1.1.0
 */
function paco2017_setup_theme() {

}
add_action( 'after_setup_theme', 'paco2017_setup_theme' );

/**
 * Register Google Fonts for this theme
 *
 * @since 1.1.0
 *
 * @return string Fonts url
 */
function paco2017_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Flamenco, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'zeta' ) ) {
		$fonts[] = 'Flamenco:300,400';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'zeta' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue the theme's scripts
 *
 * @since 1.0.0
 *
 * @uses wp_register_style()
 * @uses wp_enqueue_style()
 * @uses get_template_directory_uri()
 */
function paco2017_enqueue_scripts() {

	// Add parent theme's stylesheet. Twentyseventeen enqueues the child theme for us.
	wp_enqueue_style( 'twentyseventeen-parent-style', get_template_directory_uri() . '/style.css' );

	// Add custom fonts
	wp_enqueue_style( 'paascongres-2017-fonts', paco2017_fonts_url(), array( 'twentyseventeen-style' ) );
}
add_action( 'wp_enqueue_scripts', 'paco2017_enqueue_scripts' );

/**
 * Return whether to show the admin bar
 *
 * @since 1.0.0
 *
 * @uses is_user_vgsr()
 * 
 * @param bool $show Whether to show the admin bar
 * @return bool Whether to show the admin bar
 */
function paco2017_show_admin_bar( $show ) {

	// Hide admin bar for non-vgsr users
	if ( $show && function_exists( 'vgsr' ) && ! is_user_vgsr() ) {
		$show = false;
	}

	return $show;
}
add_filter( 'show_admin_bar', 'paco2017_show_admin_bar' );

/**
 * Register widgets
 *
 * @since 1.1.0
 */
function paco2017_register_widgets() {

	// Require files
	require_once( get_stylesheet_directory() . '/widgets/class-paco2017-login-widget.php' );

	// Register widgets
	register_widget( 'PaCo2017_Login_Widget' );
}
add_action( 'widgets_init', 'paco2017_register_widgets' );
