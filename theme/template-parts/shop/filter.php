<?php
$weight_unit = get_option('woocommerce_weight_unit');
$categories  = get_terms('product_cat', array('hide_empty' => true));

/**
 * Reusable Filter Content
 * We use a variable to store the shared UI pieces (Categories and Sliders)
 */
ob_start(); ?>
<div class="mb-2">
	<h4 class="text-sm lg:text-md font-black text-gray-700 mt-0 mb-4">دسته‌بندی‌ها</h4>
	<div class="flex flex-wrap gap-2">
		<?php foreach($categories as $cat): ?>
			<button
				type="button"
				@click="toggleCategory('<?= $cat->slug ?>')"
				:class="filters.category.includes('<?= $cat->slug ?>') ? 'bg-flower text-white border-flower shadow-md shadow-flower/20' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-flower/10 hover:border-flower/30'"
				class="py-3 px-2 flex-1 cursor-pointer text-nowrap rounded-xl border text-[11px] lg:text-xs font-bold transition-all">
				<?= $cat->name ?>
			</button>
		<?php endforeach; ?>
	</div>
</div>

<div class="space-y-3">
	<div class="border-t border-gray-100 pt-2">
		<div class="flex justify-between items-center mb-2">
			<h4 class="text-sm font-black my-0 text-gray-700">حداقل وزن</h4>
			<span class="text-[10px] font-black px-2 py-1 bg-flower/5 rounded-lg text-flower" x-text="filters.min_weight + ' <?= $weight_unit ?>'"></span>
		</div>
		<input type="range" min="0" max="50" step="0.5" x-model="filters.min_weight" class="w-full h-1.5 bg-gray-100 rounded-lg appearance-none cursor-pointer accent-flower">
	</div>

	<div class="border-t border-gray-100 pt-2">
		<div class="flex justify-between items-center mb-2">
			<h4 class="text-sm font-black text-gray-700">حداکثر قیمت</h4>
			<span class="text-[10px] font-black text-flower" x-text="formatPrice(filters.max_price)"></span>
		</div>
		<input type="range" min="0" max="10000000" step="100000" x-model="filters.max_price" class="w-full h-1.5 bg-gray-100 rounded-lg appearance-none cursor-pointer accent-flower">
	</div>
</div>
<?php
$shared_filter_html = ob_get_clean();
?>

<aside
	x-data="productFilter"
	x-init="initFilters()"
	@open-filter.window="open = true"
	class="relative rtl" dir="rtl">

	<div class="hidden lg:block w-full p-6 bg-white border border-gray-200 rounded-sm sticky top-24">
		<div class="flex items-center justify-between border-b border-gray-100 mb-6">
			<span class="text-lg font-black text-gray-900 border-b-2 pb-3 border-flower leading-none">فیلترها</span>
			<button @click="resetFilters()" class="text-[10px] font-bold text-flower hover:underline">حذف همه</button>
		</div>

		<?= $shared_filter_html; ?>

		<button @click="applyFilters()" class="w-full py-4 cursor-pointer mt-8 bg-flower text-white rounded-2xl font-black shadow-lg shadow-flower/20 hover:brightness-110 transition-all">
			اعمال فیلترها
		</button>
	</div>

	<div x-show="open"
		 x-cloak
		 x-transition:enter="transition ease-out duration-300 transform"
		 x-transition:enter-start="translate-y-full"
		 x-transition:enter-end="translate-y-0"
		 x-transition:leave="transition ease-in duration-300 transform"
		 x-transition:leave-start="translate-y-0"
		 x-transition:leave-end="translate-y-full"
		 class="fixed inset-0 z-[100] lg:hidden bg-white flex flex-col" style="display: none;">

		<div class="flex items-center justify-between px-5 h-14 border-b border-black/10 sticky top-0 bg-white z-10">
			<button @click="open = false" class="p-2 bg-gray-50 rounded-xl">
				<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
			</button>
			<span class="font-black border-b-2 mt-auto border-flower pb-3 text-lg">فیلتر محصولات</span>
			<button @click="resetFilters()" class="text-xs font-bold text-flower">حذف همه</button>
		</div>

		<div class="flex-1 overflow-y-auto p-6">
			<?= $shared_filter_html; ?>
		</div>

		<div class="p-2 sticky bottom-0 bg-white">
			<button @click="applyFilters()" class="w-full py-4 bg-flower text-white rounded-2xl font-black text-lg shadow-xl shadow-flower/20">مشاهده نتایج</button>
		</div>
	</div>
</aside>

<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('productFilter', () => ({
			open: false,
			filters: { category: [], max_price: 10000000, min_weight: 0 },

			initFilters() {
				const params = new URLSearchParams(window.location.search);
				if (params.has('product_cat')) this.filters.category = params.get('product_cat').split(',');
				if (params.has('max_price')) this.filters.max_price = parseInt(params.get('max_price'));
				if (params.has('min_weight')) this.filters.min_weight = parseFloat(params.get('min_weight'));
			},

			toggleCategory(slug) {
				if (this.filters.category.includes(slug)) {
					this.filters.category = this.filters.category.filter(i => i !== slug);
				} else {
					this.filters.category.push(slug);
				}
			},

			formatPrice(val) { return new Intl.NumberFormat('fa-IR').format(val) + ' تومان'; },

			applyFilters() {
				const params = new URLSearchParams();
				if (this.filters.category.length > 0) params.set('product_cat', this.filters.category.join(','));
				if (this.filters.max_price < 10000000) params.set('max_price', this.filters.max_price);
				if (this.filters.min_weight > 0) params.set('min_weight', this.filters.min_weight);
				window.location.search = params.toString();
			},

			resetFilters() { window.location.href = window.location.pathname; }
		}))
	})
</script>
