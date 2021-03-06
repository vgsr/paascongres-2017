<?php

/**
 * Displays header media for the Above The Fold template
 *
 * @package Paascongres 2017
 * @subpackage Theme
 */

?>

<div class="custom-header">

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

	<?php get_template_part( 'template-parts/header/above-the-fold', 'branding' ); ?>

</div><!-- .custom-header -->
