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
 * Puts the member header and other BuddyPress top content
 * in the page content header.
 *
 * @since 1.0.0
 */
function paco2017_bp_page_content_header() {

	// Start output buffer
	ob_start();

	// Single user item header
	if ( bp_is_user() ) : ?>

		<div id="item-header" role="complementary">

			<?php bp_get_template_part( 'members/single/member-header' ); ?>

		</div><!-- #item-header -->

	<?php endif;

	// Directory search
	if ( bp_is_members_directory() ) : ?>

		<?php /* Backward compatibility for inline search form. Use template part instead. */ ?>
		<?php if ( has_filter( 'bp_directory_members_search_form' ) ) : ?>

			<div id="members-dir-search" class="dir-search" role="search">
				<?php bp_directory_members_search_form(); ?>
			</div><!-- #members-dir-search -->

		<?php else: ?>

			<?php bp_get_template_part( 'common/search/dir-search-form' ); ?>

		<?php endif; ?>

	<?php endif;

	// Wrap logic in #buddypress to force use the styling logic
	if ( $content = ob_get_clean() ) : ?>

	<div id="buddypress"><!-- Cheat the system: another #buddypress! :o -->
		<?php echo $content; ?>
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

/**
 * Act before the members directory page is rendered
 *
 * @since 1.0.0
 */
function paco2017_bp_before_directory_members() {

	/**
	 * Prevent members search form from outputting, because we've put it in the
	 * page content header location. Assume that after this point no search
	 * form is requested anymore.
	 */
	remove_all_filters( 'bp_directory_members_search_form' );
	add_filter( 'bp_get_template_part', function( $templates, $slug, $name ) {
		if ( 'common/search/dir-search-form' === $slug ) {
			$templates = array();
		}

		return $templates;
	}, 10, 3 );
}
add_filter( 'bp_before_directory_members', 'paco2017_bp_before_directory_members' );
