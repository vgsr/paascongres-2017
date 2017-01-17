<?php

/**
 * Displays header site branding for the Above The Fold template
 *
 * @package Paascongres 2017
 * @subpackage Theme
 */

?>

<div class="site-branding">
	<div class="wrap">

		<?php the_custom_logo(); ?>

		<div class="site-branding-text">
			<h1 class="site-title"><?php the_title(); ?></h1>

			<?php $description = get_the_content();
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
		</div><!-- .site-branding-text -->

	</div><!-- .wrap -->
</div><!-- .site-branding -->
