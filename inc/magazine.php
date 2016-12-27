<?php

/**
 * Paascongres 2017 Magazine Functions
 *
 * @package Paascongres 2017
 * @subpackage Templates
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Return the name of the Magazine template file
 *
 * @since 1.2.0
 *
 * @return string Template file name
 */
function paco2017_magazine_template_name() {
	return 'templates/magazine.php';
}

/**
 * Return whether we're on a page using the Magazine template
 *
 * @since 1.2.0
 *
 * @return bool Is this page using the Magazine template?
 */
function paco2017_is_magazine_template() {
	return is_page_template( paco2017_magazine_template_name() );
}

/**
 * Modify the array of body classes
 *
 * @since 1.2.0
 *
 * @param array $classes Body classes
 * @return array Body classes
 */
function paco2017_magazine_body_classes( $classes ) {

	// Mimic front-page styling
	if ( paco2017_is_magazine_template() ) {
		$classes[] = 'twentyseventeen-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'paco2017_magazine_body_classes' );

/**
 * Modify whether the queried menu location has a nav menu
 *
 * @since 1.2.0
 *
 * @param bool $has_nav_menu Has nav menu
 * @param string $location Menu location name
 * @return bool Has nav menu
 */
function paco2017_magazine_has_nav_menu( $has_nav_menu, $location ) {

	// Consider the Top menu in the Magazine template present when
	// the `magazine` menu location has a nav menu.
	if ( 'top' === $location && paco2017_is_magazine_template() ) {

		// Only use Magazine menu when it is assigned. This enables
		// fallback to the default `top` menu.
		if ( has_nav_menu( 'magazine' ) ) {
			$has_nav_menu = true;
		}
	}

	return $has_nav_menu;
}
add_filter( 'has_nav_menu', 'paco2017_magazine_has_nav_menu', 10, 2 );

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
function paco2017_magazine_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'magazine' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . twentyseventeen_get_svg( array( 'icon' => 'angle-down' ) );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'paco2017_magazine_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Return the main magazine destination url
 *
 * @since 1.2.0
 *
 * @return string Main magazine url
 */
function paco2017_magazine_url() {
	return apply_filters( 'paco2017_magazine_url', home_url( '/' ) );
}
