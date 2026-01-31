<?php if (!defined('ABSPATH')) exit; ?>

<div class="lg:hidden fixed bottom-14 divide-x divide-gray-200 inset-x-0 bg-white z-40 py-2 flex items-center rtl" dir="rtl">
	<?php
	$btnCLass= 'flex-1 flex items-center justify-center gap-2 py-3 bg-gray-50 text-sm font-bold active:scale-95 transition-transform'
	?>
	<button @click="$dispatch('open-filter')" type="button"
			class="<?= $btnCLass; ?>">
		<svg class="w-5 h-5 text-flower" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				  d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
		</svg>
		فیلترها
	</button>
	<button @click="$dispatch('open-sort')" type="button"
			class="<?= $btnCLass; ?>">
		<svg class="w-5 h-5 text-flower" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				  d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
		</svg>
		مرتب‌سازی
	</button>
</div>

<div x-data="{ gridView: 'large', sortOpen: false }" @open-sort.window="sortOpen = true"
	 class="grid w-full lg:gap-4 mb-4 lg:grid-cols-3 xl:grid-cols-4 rtl" dir="rtl">

		<?php get_template_part('template-parts/shop/filter'); ?>

	<div class="lg:col-span-2 xl:col-span-3">

		<nav class="hidden lg:flex items-center justify-between bg-white rounded-lg p-2 border border-gray-200 mb-3">
			<div class="flex items-center gap-4">
				<div class="flex items-center bg-gray-50 rounded-xl p-1 border border-gray-100">
					<button @click="gridView = 'large'"
							:class="gridView === 'large' ? 'bg-flower text-white shadow-md' : 'text-gray-400 hover:text-gray-600'"
							class="p-2 rounded-lg transition-all duration-300">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
						</svg>
					</button>
					<button @click="gridView = 'small'"
							:class="gridView === 'small' ? 'bg-flower text-white shadow-md' : 'text-gray-400 hover:text-gray-600'"
							class="p-2 rounded-lg transition-all duration-300">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								  d="M4 5a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM10 5a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1V5zM16 5a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1V5zM4 11a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1v-2zM10 11a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2zM16 11a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2zM4 17a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1v-2zM10 17a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2zM16 17a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2z"></path>
						</svg>
					</button>
				</div>
				<div
					class="text-xs font-bold text-gray-400 custom-result-count [&>p]:!mb-0"><?php woocommerce_result_count(); ?></div>
			</div>

			<div class="flex items-center gap-2 custom-ordering">
				<span class="text-xs font-bold text-gray-400">مرتب‌سازی:</span>
				<div
					class="[&_select]:bg-transparent [&_select]:text-xs [&_select]:font-black [&_select]:border-none [&>form]:!mb-0 [&_select]:focus:ring-0 [&_select]:cursor-pointer [&>form]:flex [&>form]:items-center [&>form]:border [&>form]:border-black/5 [&>form]:rounded-md [&>form]:p-2">
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>
		</nav>

		<ul class="grid gap-2 transition-all duration-500 p-0 !my-0"
			:class="gridView === 'large' ? 'grid-cols-2 xl:grid-cols-3' : 'grid-cols-2 lg:grid-cols-3 xl:grid-cols-4'">

			<template x-teleport="body">
				<div x-show="sortOpen" class="fixed inset-0 z-[150] lg:hidden rtl" dir="rtl">
					<div x-show="sortOpen" x-transition:opacity @click="sortOpen = false"
						 class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
					<div x-show="sortOpen" x-transition:enter="transition ease-out duration-300 transform"
						 x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
						 class="absolute bottom-0 inset-x-0 bg-white rounded-t-[2rem] p-6 shadow-2xl">
						<div class="w-12 h-1 bg-gray-200 rounded-full mx-auto mb-6"></div>
						<h3 class="text-center font-black text-lg mb-6">ترتیب نمایش</h3>
						<div class="w-full flex flex-col items-center [&_select]:bg-transparent [&_select]:text-xs [&_select]:font-black [&_select]:border-none [&>form]:!mb-0 [&_select]:focus:ring-0 [&_select]:cursor-pointer [&>form]:flex [&>form]:items-center [&>form]:border [&>form]:border-black/5 [&>form]:rounded-md [&>form]:p-2">
							<?php woocommerce_catalog_ordering(); ?>
						</div>
					</div>
				</div>
			</template>
