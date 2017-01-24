<?php
/**
 * Template part for displaying page content in page.php
 *
 * Added the 'paco2017_page_content_header' hook callback.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paascongres 2017
 * @subpackage Template
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twentyseventeen_edit_link( get_the_ID() ); ?>

		<?php paco2017_page_content_header(); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
