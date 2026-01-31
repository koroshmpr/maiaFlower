<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bluebox
 */

?>

<footer class="<?= is_singular('product') || is_shop() ? 'max-lg:pb-36' : 'max-lg:pb-24'; ?> max-lg:pt-12 bg-gray-800 text-white">
	<div class="flex max-lg:flex-col flex-wrap gap-y-6 container max-w-content">
		<div class="lg:basis-2/3 lg:border-e border-[#ffffff08] flex flex-col gap-y-8 justify-center lg:py-32">
			<p class="lg:text-4xl text-2xl"><?= get_field('footer_content', 'option') ?? ''; ?></p>
			<?php if (has_nav_menu('menu-2')) : ?>
				<nav aria-label="<?php esc_attr_e('Footer Menu', 'bluebox'); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class' => 'flex divide-x-2 divide-white/40 flex-wrap items-center',
							'depth' => 1,
							'link_before' => '<span class="px-4 lg:text-xl text-base text-white/40 hover:text-white transition-all leading-tight">',
							'link_after' => '</span>',
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>
		<!-- Moving Item with Inline Alpine.js -->
		<div class="lg:basis-1/3 flex flex-col justify-center ps-4">
			<a class="flex justify-end relative after:z-[-1] after:bg-white/5 px-5 after:w-full after:h-0.5 after:absolute after:top-1/2"
			   href="/about-us">
        <span x-data="{ x: 0, y: 0,
               handleMouseMove(e) {
                   this.x = (e.clientX - window.innerWidth / 2) / 30;
                   this.y = (e.clientY - window.innerHeight / 2) / 30;
               },
               resetPosition() {
                   this.x = 0;
                   this.y = 0;
               }
             }"  @mousemove="handleMouseMove"
			   @mouseleave="resetPosition" class="p-10 me-7 transition-transform duration-500 ease-out rounded-full bg-icon/90 flex justify-center items-center text-foreground aspect-square"
			  :style="'transform: translate(' + x + 'px, ' + y + 'px)'">
            بیشتر باما
        </span>
			</a>

		</div>
		<!-- End Moving Item -->

	</div>
	<div class="container flex max-lg:flex-col gap-y-3 justify-between max-lg:pt-8 lg:pb-10 items-center">
		<span class="ltr text-end">© 2023 - <?= date('Y'); ?> طراحی شده توسط بلوباکس</span>
		<div class="flex items-center justify-center lg:justify-end">
			<?php
			$socials = get_field('social', 'option');
			if ($socials):
				foreach ($socials as $social):?>
					<a aria-label="<?= $social['name']; ?>" title="<?= $social['name']; ?>"
					   class="p-5 text-icon rounded-full border border-white/10" target="_blank"
					   href="<?= $social['link']['url'] ?? ''; ?>">
						<?php
						$args = array(
							'size' => 20
						);
						get_template_part('template-parts/svg/socials/' . $social['name'], null, $args); ?>
					</a>
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
</footer>
