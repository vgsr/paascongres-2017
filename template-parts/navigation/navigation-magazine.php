<?php

/**
 * Displays top navigation for the Magazine template
 *
 * @package Paascongres 2017
 * @subpackage Theme
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'twentyseventeen' ); ?>">
	<?php wp_nav_menu( array(
		'theme_location' => has_nav_menu( 'magazine' ) ? 'magazine' : 'top',
		'menu_id'        => 'top-menu',
	) ); ?>
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) ); echo twentyseventeen_get_svg( array( 'icon' => 'close' ) ); _e( 'Menu', 'twentyseventeen' ); ?></button>
</nav><!-- #site-navigation -->
