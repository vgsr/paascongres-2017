<?php
/**
 * BuddyPress - Members Single Profile Edit
 *
 * Changes to the bp-default template:
 * - Removed single profile group edit limit: this is now one page to edit all profile groups
 * - Removed field visibility settings
 * - Added #profile-group-{group_id} and .bp-widget to the form
 *
 * @package Paascongres 2017
 * @subpackage BuddyPress
 */

/**
 * Fires after the display of member profile edit content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_profile_edit_content' );

if ( bp_has_profile() ) :
	while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

	<?php if ( paco2017_bp_profile_group_has_fields() ) : ?>

<form id="profile-group-<?php bp_the_profile_group_id(); ?>" action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form bp-widget <?php bp_the_profile_group_slug(); ?>">

	<?php

		/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
		do_action( 'bp_before_profile_field_content' ); ?>

		<h2><?php bp_the_profile_group_name(); ?></h2>

		<div class="profile-fields">

		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

			<div<?php bp_field_css_class( 'editfield' ); ?>>

				<?php
				$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
				$field_type->edit_field_html();

				/**
				 * Fires before the display of visibility options for the field.
				 *
				 * @since 1.7.0
				 */
				do_action( 'bp_custom_profile_edit_fields_pre_visibility' );

				/**
				 * Fires after the visibility options for a field.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_custom_profile_edit_fields' ); ?>
			</div>

		<?php endwhile; ?>

		</div>

	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
	do_action( 'bp_after_profile_field_content' ); ?>

	<div class="submit">
		<input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

</form>

<?php endif;
	endwhile;
endif; ?>

<?php

/**
 * Fires after the display of member profile edit content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_profile_edit_content' ); ?>
