<?php

/**
 * Paascongres 2017 Above The Fold Functions
 *
 * @package Paascongres 2017
 * @subpackage Templates
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Return the name of the Above The Fold template file
 *
 * @since 1.2.0
 *
 * @return string Template file name
 */
function paco2017_atf_template_name() {
	return 'templates/above-the-fold.php';
}

/**
 * Return whether we're on a page using the Above The Fold template
 *
 * @since 1.2.0
 *
 * @return bool Is this page using the Above The Fold template?
 */
function paco2017_is_atf_template() {
	return is_page_template( paco2017_atf_template_name() );
}

/**
 * Modify the array of body classes
 *
 * @since 1.2.0
 *
 * @param array $classes Body classes
 * @return array Body classes
 */
function paco2017_atf_body_classes( $classes ) {

	// Mimic front-page styling
	if ( paco2017_is_atf_template() ) {
		$classes[] = 'twentyseventeen-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'paco2017_atf_body_classes' );

/**
 * Modify the header image tag for the Above The Fold template
 *
 * @since 1.2.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string HTML image tag
 */
function paco2017_atf_header_image( $html, $header, $attr ) {

	// This is for the Above The Fold template and there's a featured image
	if ( paco2017_is_atf_template() && get_post_thumbnail_id() ) {

		// We're not using the header image
		unset( $attr['src'], $attr['srcset'] );

		// Has this post a featured image?
		$thumbnail = get_the_post_thumbnail( null, 'twentyseventeen-featured-image', $attr );

		if ( $thumbnail ) {
			$html = $thumbnail;
		}
	}

	return $html;
}
add_filter( 'get_header_image_tag', 'paco2017_atf_header_image', 5, 3 );

/**
 * Wrap the header image tag for the Above The Fold template in a link
 *
 * @since 1.2.0
 *
 * @param string $html The HTML image tag markup being filtered.
 * @return string HTML image tag
 */
function paco2017_atf_wrap_header_image_in_link( $html ) {

	// Get target url
	$target_url = paco2017_get_atf_url();

	// This is for the Above The Fold template and there's a download url
	if ( paco2017_is_atf_template() && $target_url !== home_url( '/' ) ) {
		$html = sprintf( '<a href="%s" target="_blank">%s</a>', $target_url, $html );
	}

	return $html;
}
add_filter( 'get_header_image_tag', 'paco2017_atf_wrap_header_image_in_link', 99 );

/**
 * Modify whether the queried menu location has a nav menu
 *
 * @since 1.2.0
 *
 * @param bool $has_nav_menu Has nav menu
 * @param string $location Menu location name
 * @return bool Has nav menu
 */
function paco2017_atf_has_nav_menu( $has_nav_menu, $location ) {

	// Consider the Top menu in the Above The Fold template present
	// when the `above-the-fold` menu location has a nav menu.
	if ( 'top' === $location && paco2017_is_atf_template() ) {

		// Only use Above The Fold menu when it is assigned. This enables
		// fallback to the default `top` menu.
		if ( has_nav_menu( 'above-the-fold' ) ) {
			$has_nav_menu = true;
		}
	}

	return $has_nav_menu;
}
add_filter( 'has_nav_menu', 'paco2017_atf_has_nav_menu', 10, 2 );

/**
 * Add dropdown icon if menu item has children.
 *
 * @see twentyseventeen_dropdown_icon_to_menu_link()
 *
 * @since 1.2.0
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function paco2017_atf_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'above-the-fold' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . twentyseventeen_get_svg( array( 'icon' => 'angle-down' ) );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'paco2017_atf_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Return the specified target url for the Above The Fold page
 *
 * @since 1.2.0
 *
 * @return string Target url
 */
function paco2017_get_atf_url() {
	return apply_filters( 'paco2017_get_atf_url', home_url( '/' ) );
}
