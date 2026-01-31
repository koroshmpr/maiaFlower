<?php
/**
 * Amazing Offer Slider (Digikala Style)
 */
$productOffer = get_field('product-offer');

// 1. Setup Arguments
$class = $args['class'] ?? '';
$perPage = $args['perPage'] ?? '4.2';
$mobile = $args['mobilePerPage'] ?? '1.7';
$tablet = $args['tabletPerPage'] ?? '3.2';
$show = $productOffer['show'] ?? false;
$category_obj = $productOffer['category'] ?? null; // This is a Term Object from ACF
$titleImg = $productOffer['image'] ?? '';
$titleText = $productOffer['text'] ?? '';

// Handle section IDs safely if no category is selected
$slug_id = ($category_obj) ? $category_obj->slug : 'on-sale';
$term_id_id = ($category_obj) ? $category_obj->term_id : '0';

if ($show) :

// 2. Define Query Logic
	$query_args = [
		'post_type' => 'product',
		'posts_per_page' => 10,
		'status' => 'publish',
	];

	if ($category_obj && isset($category_obj->slug)) {
		$query_args['tax_query'] = [[
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $category_obj->slug, // Fixed: use 'terms' not 'slug'
		]];
	} else {
		// Fallback: Show On-Sale Products
		$query_args['meta_query'] = [[
			'key' => '_sale_price',
			'value' => 0,
			'compare' => '>',
			'type' => 'NUMERIC',
		]];
	}

	$amazing_query = new WP_Query($query_args);

// Fallback check: if category query is empty, show Sale items
	if ($category_obj && !$amazing_query->have_posts()) {
		unset($query_args['tax_query']);
		$query_args['meta_query'] = [[
			'key' => '_sale_price',
			'value' => 0,
			'compare' => '>',
			'type' => 'NUMERIC',
		]];
		$amazing_query = new WP_Query($query_args);
	}

	if (!$amazing_query->have_posts()) return;
	?>

	<section class="rtl group/amazing overflow-hidden <?= $class; ?>" dir="rtl"
			 id="amazing-section-<?= esc_attr($slug_id); ?>">
		<div
			class="bg-flower/50 rounded-sm p-4 lg:p-8 flex flex-col lg:flex-row gap-4 lg:gap-6 items-stretch shadow-gray-200">

			<div class="lg:w-1/5 flex flex-col items-center justify-center gap-5 text-center text-white lg:p-4 shrink-0">
				<?php
				if ($titleText) : ?>
					<div class="text-2xl font-black leading-tight"><?= $titleText; ?></div>
				<?php else : ?>
					<div>
						<span class="block text-4xl font-black mb-2 leading-tight">پیشنهاد</span>
						<span class="block text-2xl font-light tracking-[0.2em] opacity-90">شگفت‌انگیز</span>
					</div>
				<?php endif;
				if (!empty($titleImg)) : ?>
					<img src="<?= esc_url($titleImg['url']); ?>" alt="Promotion"
						 class="w-11/12 lg:w-full h-auto my-auto drop-shadow-xl">
				<?php
				endif; ?>
				<?php if ($category_obj || !is_shop()): ?>
					<a href="<?= get_term_link($category_obj) ?? get_permalink(wc_get_page_id('shop')); ?>"
					   class="<?= empty($titleImg) ? '' : 'mt-auto'; ?> flex items-center gap-2 text-sm font-bold bg-white/20 border border-white/30 px-6 py-3 rounded-2xl hover:bg-white hover:text-flower transition-all group/btn">
						<span>مشاهده همه</span>
						<svg class="w-4 h-4 transition-transform group-hover/btn:-translate-x-1" fill="none"
							 stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
						</svg>
					</a>
				<?php endif; ?>
			</div>

			<div class="flex-1 relative">
				<div class="swiper post-slider !overflow-visible"
					 data-index="<?= esc_attr($term_id_id); ?>"
					 data-perfix="amazing"
					 data-space="10"
					 data-autoplay="5000"
					 data-perpage="<?= $perPage; ?>"
					 data-laptop="3.2"
					 data-tablet="<?= $tablet;?>>"
					 data-mobile="<?= $mobile;?>">

					<div class="swiper-wrapper">
						<?php while ($amazing_query->have_posts()) : $amazing_query->the_post(); ?>
							<div class="swiper-slide h-auto">
								<?php get_template_part('template-parts/product/card/product-card'); ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
						<?php if ($amazing_query->post_count > 4): ?>
							<div class="swiper-slide h-auto">
								<?php if ($category_obj || !is_shop()): ?>
									<a href="<?= get_term_link($category_obj) ?? get_permalink(wc_get_page_id('shop')); ?>"
									   class="flex flex-col items-center justify-center bg-white/10 border-2 border-dashed border-white/30 rounded-md h-full p-8 text-white group hover:bg-white hover:text-flower transition-all duration-500">
										<div
											class="w-16 h-16 rounded-full border-2 border-current flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
											<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													  d="M12 4v16m8-8H4"/>
											</svg>
										</div>
										<span class="font-black text-lg">مشاهده همه</span>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>

					<button
						class="amazing-prev-<?= esc_attr($term_id_id); ?> absolute top-1/2 -right-6 z-30 w-12 h-12 bg-white shadow-2xl rounded-sm flex items-center justify-center text-gray-800 -translate-y-1/2 opacity-0 group-hover/amazing:opacity-100 transition-all hover:bg-gray-50 max-lg:hidden">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					</button>
					<button
						class="amazing-next-<?= esc_attr($term_id_id); ?> absolute top-1/2 -left-6 z-30 w-12 h-12 bg-white shadow-2xl rounded-sm flex items-center justify-center text-gray-800 -translate-y-1/2 opacity-0 group-hover/amazing:opacity-100 transition-all hover:bg-gray-50 max-lg:hidden">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								  d="M15 19l-7-7 7-7"/>
						</svg>
					</button>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
