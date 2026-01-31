<?php
global $product;
?>
<aside
	class="lg:col-span-3 duration-500 sticky max-xl:hidden bg-flower/5 border border-flower/20 rounded-sm <?= current_user_can('administrator') ? 'top-28' : 'top-20'; ?> p-3 flex flex-col justify-center transition-all">
	<div class="flex gap-3 items-center mb-3">
		<img :class="scrolled ? 'w-16' : '!w-0'"
			 class="object-cover !h-16 rounded-sm duration-500 aspect-square transition-all"
			 src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>"/>
		<div class="flex flex-col">
			<?php
			$isSale = $product->is_on_sale();
			if ($isSale) :?>
				<span><?= wc_price($product->get_sale_price()); ?></span>
			<?php endif; ?>
			<span
				class="<?= $isSale ? 'opacity-50 line-through text-xl' : ' text-4xl'; ?>"><?= wc_price($product->get_regular_price()); ?></span>
		</div>
	</div>

	<?php
	global $product;

	// 1. تنظیم آرگومان‌های آیکون
	$svg_args = array(
		'size' => '20',
		'class' => 'group-hover/add:delay-100 rotate-45 group-hover/add:rotate-0 text-white duration-300 translate-x-2 opacity-0 transition-all group-hover/add:opacity-100 group-hover/add:translate-x-0'
	);

	// 2. گرفتن محتوای آیکون بدون چاپ مستقیم (Output Buffering)
	ob_start();
	get_template_part('template-parts/svg/shop', null, $svg_args);
	$svg_icon = ob_get_clean();

	// 3. تعیین متن دکمه
	$button_text = $product->is_purchasable() ? 'افزودن به سبد خرید' : $product->add_to_cart_text();

	// 4. خروجی نهایی فیلتر و ساختار HTML
	echo apply_filters('woocommerce_loop_add_to_cart_link',
		sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-product_type="%s"
                class="bg-flower px-5 py-4 group/add flex gap-x-2 justify-center hover:brightness-125 transition-all text-center rounded-lg text-white">
                   %s
                   <span class="group-hover/add:-translate-x-0 font-bold text-sm transition-all duration-300 translate-x-3">%s</span>
                </a>',
			esc_url($product->add_to_cart_url()),
			esc_attr($product->get_id()),
			esc_attr($product->get_sku()),
			esc_attr($product->get_type()),
			$svg_icon, // آیکون اینجا قرار می‌گیرد
			esc_html($button_text)
		),
		$product
	);
	get_template_part('template-parts/shop/property');

	$regular_price = (float)$product->get_regular_price();
	$sale_price = (float)$product->get_sale_price();
	$percentage = 0;

	if ($isSale && $regular_price > 0) {
		$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
	}
	if ($percentage > 0) : ?>
		<div class="absolute -top-2 -left-2 z-20 flex items-center justify-center">
			<div
				class="bg-red-400 text-white px-3 py-1.5 rounded-tr-2xl rounded-bl-2xl rounded-tl-sm rounded-br-sm shadow-lg">
				<span class="text-[10px] font-medium block leading-none opacity-90">تخفیف</span>
				<span class="text-lg font-black leading-none"><?= $percentage; ?>%</span>
			</div>
		</div>
	<?php endif; ?>
</aside>
