<?php

/**
 * Paascongres 2017 Login Widget
 * 
 * @package Paascongres 2017
 * @subpackage Widgets
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( class_exists( 'BP_Core_Login_Widget' ) ) :
/**
 * Login Widget based on BP's Login Widget
 *
 * @since 1.1.0
 */
class PaCo2017_Login_Widget extends BP_Core_Login_Widget {

	/**
	 * Constructor method.
	 */
	public function __construct() {
		WP_Widget::__construct(
			false,
			_x( '(PaCo 2017) Log In', 'Title of the login widget', 'paascongres-2017' ),
			array(
				'description' => __( 'Show a Log In form to logged-out visitors, and a Log Out link to those who are logged in.', 'buddypress' ),
				'classname' => 'widget_bp_core_login_widget buddypress widget',
			)
		);
	}

	/**
	 * Display the login widget.
	 *
	 * @see WP_Widget::widget() for description of parameters.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Widget settings, as saved by the user.
	 */
	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title );

		echo $args['before_widget'];

		echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>

		<?php if ( is_user_logged_in() ) : ?>

			<?php do_action( 'bp_before_login_widget_loggedin' ); ?>

			<div class="bp-login-widget-user-avatar">
				<a href="<?php echo bp_loggedin_user_domain(); ?>">
					<?php bp_loggedin_user_avatar( 'type=thumb&width=50&height=50' ); ?>
				</a>
			</div>

			<div class="bp-login-widget-user-links">
				<div class="bp-login-widget-user-link"><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></div>
				<div class="bp-login-widget-user-logout"><a class="logout" href="<?php echo wp_logout_url( bp_get_requested_url() ); ?>"><?php _e( 'Uitloggen', 'buddypress' ); ?></a></div>
			</div>

			<?php do_action( 'bp_after_login_widget_loggedin' ); ?>

		<?php else : ?>

			<?php do_action( 'bp_before_login_widget_loggedout' ); ?>

			<form name="bp-login-form" id="bp-login-widget-form" class="standard-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
				<input type="hidden" name="redirect_to" value="<?php echo bp_get_requested_url(); ?>" />

				<!-- <label for="bp-login-widget-user-login"><?php _e( 'Username', 'buddypress' ); ?></label> -->
				<input type="text" name="log" id="bp-login-widget-user-login" class="input" value="" placeholder="Gebruikersnaam" />

				<!-- <label for="bp-login-widget-user-pass"><?php _e( 'Password', 'buddypress' ); ?></label> -->
				<input type="password" name="pwd" id="bp-login-widget-user-pass" class="input" value="" placeholder="Wachtwoord"  />

				<!-- <div class="forgetmenot"><label><input name="rememberme" type="checkbox" id="bp-login-widget-rememberme" value="forever" /> <?php _e( 'Remember Me', 'buddypress' ); ?></label></div> -->

				<input type="submit" name="wp-submit" id="bp-login-widget-submit" value="<?php esc_attr_e( 'Inloggen', 'buddypress' ); ?>" />

				<?php if ( bp_get_signup_allowed() ) : ?>

					<span class="bp-login-widget-register-link"><?php printf( __( '<a href="%s" title="Register for a new account">Register</a>', 'buddypress' ), bp_get_signup_page() ); ?></span>

				<?php endif; ?>

			</form>

			<?php do_action( 'bp_after_login_widget_loggedout' ); ?>

		<?php endif;

		echo $args['after_widget'];
	}
}

endif; // class_exists
