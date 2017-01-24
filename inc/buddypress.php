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

/**
 * Return whether the current profile group in the loop has fields
 *
 * Alternative for `bp_profile_group_has_fields()` which only returns
 * true when the group's fields have data. This however, returns regardless
 * of field data presence.
 *
 * @since 1.0.0
 *
 * @return bool Template profile group has fields
 */
function paco2017_bp_profile_group_has_fields() {
	global $profile_template;
	return $profile_template->field_count > 0;
}

/**
 * Add markup to the page content header
 *
 * Puts the member header in the page content header.
 *
 * @since 1.0.0
 */
function paco2017_bp_page_content_header() {

	// Single user
	if ( bp_is_user() ) : ?>

	<div id="buddypress"><!-- Cheat the system: another #buddypress! :o -->
		<div id="item-header" role="complementary">

			<?php bp_get_template_part( 'members/single/member-header' ); ?>

		</div><!-- #item-header -->
	</div>

	<?php endif;
}
add_action( 'paco2017_page_content_header', 'paco2017_bp_page_content_header' );

/**
 * Add additional entry title after the member's avatar
 *
 * @since 1.0.0
 */
function paco2017_bp_page_entry_title() { ?>

	<span class="entry-title"><?php the_title(); ?></span>

	<?php
}
add_action( 'bp_before_member_header_meta', 'paco2017_bp_page_entry_title', 5 );
