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
 * Enqueue the theme's scripts
 *
 * @since 1.0.0
 *
 * @uses wp_enqueue_style()
 * @uses get_template_directory_uri()
 */
function paco2017_enqueue_scripts() {

	// Load parent theme's stylesheet
	wp_register_style( 'twentyfifteen', get_template_directory_uri() . '/style.css' );

	// Load child theme's stylesheet with dependence
	wp_enqueue_style( 'paascongres-2017', get_stylesheet_uri(), array( 'twentyfifteen' ) );
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
 * Add the VGSR logo to the theme's design
 *
 * References to chapter 16 of Twenty Fifteen's stylesheet for the
 * defined viewport widths.
 *
 * @since 1.0.0
 *
 * @uses vgsr()
 */
function paco2017_vgsr_branding() {

	// Bail when VGSR plugin is not active
	if ( ! function_exists( 'vgsr' ) )
		return;

	$images_url = vgsr()->assets_url . 'images/'; ?>

	<style id="site-header-vgsr-logo">
		.site-header:before {
			content: '';
			background-image: url('<?php echo $images_url . 'logo-wit.png'; ?>');
			position: absolute;
			-webkit-background-size: 42px;
			background-size: 42px;
			width: 42px;
			height: 42px;
			margin: -6px 0;
		}

		.site-branding {
			padding-left: 64px;
		}

		/**
		 * 16.1 Mobile Large 620px
		 */

		@media screen and (min-width: 38.75em) {
			.site-header:before {
				margin: 4px 0;
			}
		}

		/**
		 * 16.2 Tablet Small 740px
		 */

		@media screen and (min-width: 46.25em) {
			.site-header:before {
				-webkit-background-size: 56px;
				background-size: 56px;
				width: 56px;
				height: 56px;
			}

			.site-branding {
				padding-left: 83px;
			}
		}

		/**
		 * 16.3 Tablet Large 880px
		 */

		@media screen and (min-width: 55em) {
			.site-header:before {
				-webkit-background-size: 64px;
				background-size: 64px;
				width: 64px;
				height: 64px;
			}

			.site-branding {
				padding-left: 94px;
			}
		}

		/**
		 * 16.4 Desktop Small 955px
		 */

		@media screen and (min-width: 59.6875em) {
			.site-header:before {
				position: relative;
				display: block;
				margin: 0 auto 10%;
			}

			.site-branding {
				padding-left: 0;
			}
		}
	</style>

	<?php
}
add_action( 'wp_head', 'paco2017_vgsr_branding' );

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
