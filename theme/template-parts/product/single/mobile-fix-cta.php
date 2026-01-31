<?php
global $product;
if ( ! $product ) return;

$isSale = $product->is_on_sale();
$regular_price = (float)$product->get_regular_price();
$sale_price = (float)$product->get_sale_price();
$percentage = 0;

if ($isSale && $regular_price > 0) {
	$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}
?>
<nav :class="intro ? '!translate-y-0' : ''"
	 class="fixed md:px-24 translate-y-full border-t border-black/10 xl:hidden px-3 py-1.5 transition-all z-[2] bg-gray-50 duration-500 flex justify-between items-center shadow bottom-14 inset-x-0 w-full">


	<div class="flex flex-col flex-1 relative">
		<?php if ($percentage > 0) : ?>
			<div class="absolute top-0 -translate-y-1/2 end-3 z-0 flex items-center justify-center">
				<div class="bg-red-400 text-white px-2 py-1  rounded-tr-2xl rounded-bl-2xl rounded-tl-sm rounded-br-sm shadow-lg">
					<span class="text-xs font-black leading-none"><?= $percentage; ?>% -</span>
				</div>
			</div>
		<?php endif; ?>
		<?php if ($isSale) : ?>
			<span class="text-md font-bold [&_.woocommerce-Price-currencySymbol]:text-[10px]"><?= wc_price($sale_price); ?></span>
		<?php endif; ?>
		<span class="[&_.woocommerce-Price-currencySymbol]:text-[10px] <?= $isSale ? 'opacity-50 line-through text-sm' : ' text-2xl'; ?>">
          <?= wc_price($regular_price); ?>
       </span>
	</div>

	<?php
	echo apply_filters('woocommerce_loop_add_to_cart_link',
		sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s"
                   class="bg-flower px-5 py-3 hover:brightness-125 transition-all flex-1 text-center rounded-lg text-white">%s</a>',
			esc_url($product->add_to_cart_url()),
			esc_attr($product->get_id()),
			esc_attr($product->get_sku()),
			$product->is_purchasable() ? 'افزودن به سبد خرید' : ''
		),
		$product);
	?>
</nav>
