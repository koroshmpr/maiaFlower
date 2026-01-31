<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bluebox
 */

?>

<section id="page-<?php the_ID(); ?>" <?php post_class('container max-lg:px-2'); ?>>
	<?php if (!is_shop()) : ?>
		<header class="entry-header border-b my-5 border-black/10 overflow-hidden">
			<?php
			if (!is_front_page()) { ?>
				<h1 :class="intro ? '!translate-x-0' : '' "
					class="border-b-3 pb-2 text-3xl translate-x-full transition-all w-fit duration-300 border-flower"><?php the_title(); ?></h1>
			<?php } else {
				the_title('<h2 class="entry-title">', '</h2>');
			}
			?>
		</header><!-- .entry-header -->

	<?php
	endif;
	// Check if it's the shop AND the first page
	if (is_shop()) :
		get_template_part('template-parts/shop/shop-page-components');
	endif;
	?>

	<?php
	if (!is_shop()) :
		bluebox_post_thumbnail();
	endif; ?>

	<div <?php bluebox_content_class(''); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __('Pages:', 'bluebox'),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<?php if (is_shop()) :
		get_template_part('template-parts/shop/shop-page-components-loop-end');
	endif;
	?>

	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
						__('Edit <span class="sr-only">%s</span>', 'bluebox'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</section><!-- #post-<?php the_ID(); ?> -->
