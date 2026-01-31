<?php
global $product;

if (!$product) {
	return;
}

$product_id = $product->get_id();
$price = $product->get_price();
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$is_on_sale = $product->is_on_sale();
$stock_status = $product->get_stock_status();
?>

<li
	x-data="{ hover: false }"
	@mouseenter="hover = true"
	@mouseleave="hover = false"
	class="group relative bg-gray-50 border rounded-md border-gray-200 p-1 !my-0 transition-all duration-500 hover:border-flower/5 rtl"
	dir="rtl"
>
	<a href="<?php the_permalink(); ?>"
	   class="relative aspect-[4/5] overflow-hidden flex flex-col rounded-sm bg-gray-50">
		<?php if ($is_on_sale) :
			$percentage = round((($regular_price - $sale_price) / $regular_price) * 100); ?>
			<span class="absolute top-2 right-2 z-10 bg-flower text-white text-[10px] font-bold px-2.5 py-1 rounded-lg">
                <?= $percentage; ?>% تخفیف
            </span>
		<?php endif; ?>

		<div class="block relative size-full aspect-[3/4] overflow-hidden">
			<?php
			$image_id = $product->get_image_id();
			$image_url = wp_get_attachment_image_url($image_id, 'large');
			$gallery_ids = $product->get_gallery_image_ids();
			$hover_image_url = !empty($gallery_ids) ? wp_get_attachment_image_url($gallery_ids[0], 'large') : $image_url;
			?>
			<img
				src="<?= $image_url; ?>"
				alt="<?php the_title(); ?>"
				class="object-cover w-full !h-full !my-0 transition-all duration-700 transform group-hover:scale-110"
				:class="hover ? 'opacity-0 scale-105' : 'opacity-100'"
			>
			<img
				alt="<?= $gallery_ids[0]['title'] ?? '';?>"
				src="<?= $hover_image_url; ?>"
				class="absolute inset-0 object-cover w-full !my-0 h-full transition-all duration-700 transform-all opacity-0"
				:class="hover ? 'opacity-100 scale-110 duration-500' : 'opacity-0'"
			>
			<button
				@click.stop.prevent="window.location.href = '<?= esc_url(add_query_arg('add-to-cart', $product_id)); ?>'"
				class="absolute bottom-4 group/add overflow-hidden inset-x-3 duration-300 shadow-sm translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 z-20 flex items-center cursor-pointer justify-center gap-2 w-11/12 py-3 bg-white/90 text-gray-800 rounded-md font-bold hover:bg-flower hover:text-white transition-all"
			>
				<?php
				$args = array(
					'size' => '20',
					'class' => 'group-hover/add:delay-100 text-white duration-300 rotate-45 group-hover/add:rotate-0 translate-x-2 opacity-0 transition-all group-hover/add:opacity-100 group-hover/add:translate-x-0'
				);
				get_template_part('template-parts/svg/shop',null,$args);
				?>
				<span class="group-hover/add:-translate-x-0 text-sm transition-all duration-300 translate-x-3">افزودن به سبد</span>
			</button>
		</div>

		<div class="flex p-2 max-lg:flex-col max-lg:gap-2 items-center justify-between">
				<span class="text-md font-bold text-gray-800 hover:text-flower transition-colors line-clamp-1">
					<?php the_title(); ?>
				</span>
			<div class="flex flex-col">
				<?php if ($is_on_sale) : ?>
					<del class="text-xs text-gray-400 text-center font-medium"><?= number_format($regular_price); ?>
						<span class="text-[10px] text-gray-400 font-bold">تومان</span>
					</del>
					<div class="flex items-baseline gap-1">
					<span
						class="text-base lg:text-lg font-black text-gray-900"><?= number_format($sale_price); ?></span>
						<span class="text-[10px] text-gray-400 font-bold">تومان</span>
					</div>
				<?php else : ?>
					<div class="flex items-baseline gap-1">
						<span class="text-lg font-black text-gray-900"><?= number_format($price); ?></span>
						<span class="text-[10px] text-gray-400 font-bold">تومان</span>
					</div>
				<?php endif; ?>
			</div>

			<button class="p-2 text-gray-300 hidden hover:text-red-400 transition-colors">
				<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
					<path
						d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
				</svg>
			</button>
		</div>
	</a>
</li>
