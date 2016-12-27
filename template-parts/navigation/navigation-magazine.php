<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'twentyseventeen' ); ?>">
	<?php wp_nav_menu( array(
		'theme_location' => 'magazine',
		'menu_id'        => 'top-menu',
	) ); ?>
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) ); echo twentyseventeen_get_svg( array( 'icon' => 'close' ) ); _e( 'Menu', 'twentyseventeen' ); ?></button>
</nav><!-- #site-navigation -->
