<?php
// Ensure arguments are extracted correctly
$taxonomy = $args['taxonomy'] ?? 'product_cat';

// Fetch terms dynamically based on taxonomy
$terms = get_terms([
	'taxonomy' => $taxonomy,
	'orderby' => 'name',
	'hide_empty' => true,
	'post_per_page' => -1, // Fix: Correct parameter for unlimited terms
	'parent' => 0, // For hierarchical taxonomies, this gets top-level terms
]);

$current_term_id = 0;
$i = 0;

// Detect current term in archive pages
if (is_tax($taxonomy)) {
	$term = get_queried_object();
	if ($term) {
		$current_term_id = $term->term_id;
	}
}
?>
<section class="bg-flower/10">
	<div class="container flex max-lg:px-5 lg:grid grid-cols-7 lg:justify-center overflow-x-scroll flex-nowrap max-lg:gap-x-3 max-lg:mt-0 my-8">
		<?php
		if (!empty($terms) && !is_wp_error($terms)): ?>
			<?php foreach ($terms as $term):
				// Get ACF field for term thumbnail
				$thumbnail = get_field('image_cover', "{$taxonomy}_{$term->term_id}");
				$thumbnail_url = is_array($thumbnail) ? $thumbnail['url'] : (is_numeric($thumbnail) ? wp_get_attachment_url($thumbnail) : $thumbnail);

				// Fallback: get term meta thumbnail
				if (!$thumbnail_url) {
					$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
					$thumbnail_url = wp_get_attachment_url($thumbnail_id);
				}
				?>
				<a class="transition-all shrink-0 group flex flex-col relative gap-2 py-8 hover:bg-white items-center duration-500 overflow-hidden"
				   href="<?= esc_url(get_term_link($term, $taxonomy)); ?>">
					<?php if ($thumbnail_url): ?>
						<img :class="scrolled ? '' : 'lg:scale-75'"
							class="size-28 object-cover group-hover:scale-150 duration-500 inset-0 bg-white transition-all aspect-square"
							src="<?= esc_url($thumbnail_url); ?>"
							alt="<?= esc_attr($term->name); ?>">
					<?php endif; ?>
					<p class="text-center group-hover:translate-y-7 duration-500 transition-all text-base opacity-75 ">
						<?= esc_html($term->name); ?>
					</p>
				</a>
			<?php
			endforeach;
			wp_reset_postdata();
		endif; ?>
	</div>
</section>
