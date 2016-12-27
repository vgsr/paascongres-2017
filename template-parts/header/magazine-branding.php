<?php

/**
 * Displays header site branding for the Magazine template
 *
 * @package Paascongres 2017
 * @subpackage Theme
 */

?>

<div class="site-branding">
	<div class="wrap">

		<?php the_custom_logo(); ?>

		<div class="site-branding-text">
			<p class="site-title"><a href="<?php echo esc_url( paco2017_magazine_url() ); ?>" rel="home"><?php the_title(); ?></a></p>

			<?php $description = get_the_content();
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
		</div><!-- .site-branding-text -->

	</div><!-- .wrap -->
</div><!-- .site-branding -->
