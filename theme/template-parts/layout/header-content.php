<header
	:class="[
<!--	scrollingDown ? '-translate-y-full' : (scrollingUp ? 'translate-y-0' : ''),-->
	 scrolled ? 'shadow-sm <?= current_user_can('administrator') ? '!lg:top-0' : ''; ?>' : '']"
	class="fixed <?= current_user_can('administrator') ? 'lg:top-8' : 'lg:top-0'; ?> max-lg:bottom-0 max-lg:border-t border-black/10 left-0 w-full bg-white transition-all duration-200 z-50"
	id="header"
>
	<nav
		class="container <?= is_admin() ? 'lg:pt-12' : '' ?> flex items-center lg:h-14 max-lg:px-2 lg:py-4 justify-between">
		<div class="flex items-center gap-5 max-lg:hidden">
			<!-- Logo -->
			<?php
			$args = array(
				'logoSize' => 'h-full  !max-w-10'
			);
			get_template_part('template-parts/global/logo', null, $args);
			?>

			<!-- Desktop Menu -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'primary-menu',
					'menu_class' => 'max-lg:hidden flex gap-x-3 justify-center lg:justify-start',
					'depth' => 1,
					'walker' => new Footer_Walker_Nav_Menu(),
				)
			);
			?>
		</div>
		<div class="flex items-center max-lg:justify-between max-lg:w-full gap-3">
			<?php
			$class = 'lg:bg-flower/5 lg:border border-flower/10 p-2 max-lg:py-4 hover:bg-flower/10';
			$svgClass = 'text-black/50 lg:text-black/70';
			$svgSize = '20';
			$args = array(
				'class' =>$class,
				'svgClass' => $svgClass,
				'svgSize' => $svgSize,
			);
			get_template_part('template-parts/layout/my-account-button', null, $args);
			?>

			<a href="<?= wc_get_cart_url(); ?>" aria-label="go to cart" class="<?= $class; ?> relative">
				<?php
				$args = array(
					'size' => $svgSize,
					'class' => $svgClass,
				);
				get_template_part('template-parts/svg/cart', null, $args);
				?>
				<span
					class="absolute top-0 start-0 translate-x-1/2 lg:-translate-y-1/2 translate-y-1 bg-flower/50 flex leading-auto justify-center items-center pt-1 p-0.5 rounded-sm text-xs size-4">
					<?= WC()->cart->get_cart_contents_count() ?? '0'; ?>
				</span>
			</a>
			<a href="<?= home_url('/'); ?>" class="<?= $class; ?> lg:hidden bg-flower/15 border-x border-flower/20 px-4 text-black/60">
				<?php
				$args = array(
					'size' => '25',
					'class' => '',
				);
				get_template_part('template-parts/svg/home', null, $args);
				?>
			</a>
			<a href="<?= home_url('/compare'); ?>" class="<?= $class; ?> relative" x-data="{ compareCount: 0 }" x-init="
    				compareCount = JSON.parse(localStorage.getItem('compare_products') || '[]').length;">
				<?php
				$args = array(
					'size' => $svgSize,
					'class' => $svgClass,
				);
				get_template_part('template-parts/svg/compare', null, $args);
				?>
				<span
					:class="compareCount === 0 ? 'hidden' : '!opacity-100'"
					class="absolute top-0 start-0 opacity-0 translate-x-1/2 lg:-translate-y-1/2 translate-y-1 bg-flower/50 flex leading-auto justify-center items-center pt-1 p-0.5 rounded-sm text-xs size-4"
					x-text="compareCount">
    			</span>
			</a>

			<!-- Mobile Menu Button -->
			<button @click="menuOpen = true" aria-labelledby="open mobileMenu" class="<?= $class; ?> lg:hidden">
				<?php
				$args = array(
					'size' => 23,
					'class' => $svgClass,
				);
				get_template_part('template-parts/svg/menu-dot', null, $args);
				?>
			</button>
		</div>
	</nav>
</header>

<!-- Mobile Menu Modal -->
<div
	@keydown.escape.window="menuOpen = false" id="mobileMenu"
	:class="menuOpen ? '!z-50 !opacity-100' : ''"
	class="fixed inset-0 flex justify-center z-[-1] bg-black/50 opacity-0 items-end lg:hidden backdrop-blur-sm transition-all duration-300"
	@click.self="menuOpen = false"
>
	<div
		class="bg-gray-50 text-black w-full max-w-sm p-6  translate-y-full transition-all duration-300"
		:class="menuOpen ? 'delay-200 !translate-y-0' : 'translate-y-full'"
	>
		<!-- Close Button -->
		<button @click="menuOpen = false" aria-label="close menu" class="absolute top-4 right-4 text-black">
			<?php
			$args = array(
				'size' => '25',
				'class' => '',
			);
			get_template_part('template-parts/svg/close', null, $args);
			?>
		</button>

		<!-- Mobile Menu Items -->
		<nav class="mt-10">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'mobile-menu',
					'menu_class' => 'flex flex-col gap-y-4 text-base text-center font-medium',
					'depth' => 1,
				)
			);
			?>
		</nav>
	</div>
</div>
