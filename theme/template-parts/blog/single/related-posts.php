<section class="container max-lg:px-3 my-8 lg:mt-12">
	<div class="border-b border-black/10 flex mb-6">
		<h6 class="pb-3 border-b-2 border-flower text-center text-black text-2xl fw-bold">
			مقالات مرتبط
		</h6>
	</div>

	<div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
		<?php
		$current_post_id = get_the_ID();
		$categories = wp_get_post_categories($current_post_id);

		$args = [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 4,
			'post__not_in'        => [$current_post_id], // ❌ exclude current post
			'ignore_sticky_posts' => true,
			'category__in'        => $categories, // ✅ sibling posts
		];

		$related = new WP_Query($args);

		if ($related->have_posts()) :
			while ($related->have_posts()) :
				$related->the_post();
				get_template_part('template-parts/blog/archive-card');
			endwhile;
		endif;

		wp_reset_postdata();
		?>
	</div>
</section>
