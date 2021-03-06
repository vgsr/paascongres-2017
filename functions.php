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

	// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus( array(
		'above-the-fold' => __( 'Above The Fold Menu', 'paascongres-2017' ),
	) );
}
add_action( 'after_setup_theme', 'paco2017_setup_theme', 15 ); // After parent theme

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

	// Load the BuddyPress specific stylesheet
	if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
		if ( version_compare( bp_get_version(), '2.8.0', '<' ) ) {
			wp_enqueue_style( 'bp-twentyseventeen', get_theme_file_uri( '/assets/css/bp-twentyseventeen.css' ), array( 'twentyseventeen-style', 'bp-legacy-css' ) );
		}

		wp_enqueue_style( 'paascongres-2017-buddypress', get_theme_file_uri( '/assets/css/paco2017-buddypress.css' ), array( 'bp-twentyseventeen', 'bp-legacy-css' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'paco2017_enqueue_scripts', 8 );

/**
 * Register widgets
 *
 * @since 1.1.0
 */
function paco2017_register_widgets() {

	// Require files
	require_once( get_stylesheet_directory() . '/widgets/class-paco2017-login-widget.php' );

	// Register widgets
	if ( class_exists(( 'PaCo2017_Login_Widget' ) ) ) {
		register_widget( 'PaCo2017_Login_Widget' );
	}
}
add_action( 'widgets_init', 'paco2017_register_widgets' );

/**
 * Run dedicated hook for the page content header
 *
 * @since 1.0.0
 *
 * @uses do_action() Calls 'paco2017_page_content_header'
 */
function paco2017_page_content_header() {
	do_action( 'paco2017_page_content_header' );
}

/**
 * Implement the Above The Fold template feature.
 */
require get_theme_file_path( '/inc/above-the-fold.php' );

/**
 * Implement the BuddyPress modifications.
 */
require get_theme_file_path( '/inc/buddypress.php' );
