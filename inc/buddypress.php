<?php

/**
 * Paascongres 2017 BuddyPress Functions
 *
 * @package Paascongres 2017
 * @subpackage BuddyPress
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Append the page element target to the profile group form edit action
 * for the single profile edit page 
 *
 * @since 1.0.0
 *
 * @param string $action Edit form action
 * @return string Edit form action
 */
function paco2017_bp_get_the_profile_group_edit_form_action( $action ) {
	$target  = 'profile-group-' . bp_get_the_profile_group_id();
	$action .= "#{$target}";

	return $action;
}
add_filter( 'bp_get_the_profile_group_edit_form_action', 'paco2017_bp_get_the_profile_group_edit_form_action' );
