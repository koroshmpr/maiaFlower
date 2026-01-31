<?php
// Get the tag slugs of the current post
$post_tags = wp_get_post_tags(get_the_ID(), array('fields' => 'names'));
// Ensure the array is not empty before querying
if (!empty($post_tags)) :
	?>
		<div class="<?= $args['class'] ?? ''; ?> flex flex-col gap-2 mt-6">
			<div class="w-full mb-4 text-white flex lg:px-5 justify-between items-center">
				<h6 class="fw-bold">نمونه کارهای مرتبط</h6>
				<a class="flex gap-1 text-white/60 hover:text-white/90 hover:gap-2 transition-all duration-500 items-center" href="<?= home_url() ?>/portfolio">همه
					<svg width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
					</svg>
				</a>
			</div>
			<?php
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'ignore_sticky_posts' => true,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio-category', // Ensure this is the correct taxonomy
						'field' => 'name',
						'terms' => $post_tags, // Filter by tags
					),
				),
			);

			$loop = new WP_Query($args);

			if ($loop->have_posts()) :
				$i = 0;
				while ($loop->have_posts()) : $loop->the_post(); ?>
					<a class="flex gap-x-3 relative items-center group justify-center overflow-hidden max-lg:rounded-lg"
					   href="<?= get_the_permalink(); ?>">
						<img class="absolute size-full z-0 inset-0 object-cover" height="50"
							 src="<?= the_post_thumbnail_url(); ?>"
							 alt="image of the <?= get_the_title(); ?> post">
						<p class="text-lg py-6 size-full z-[1] group-hover:bg-black/80 text-center transition-all bg-black/60 text-white"><?= get_the_title(); ?></p>
					</a>
				<?php endwhile;
			else :
				echo ''; // Message if no related portfolio posts
			endif;

			wp_reset_postdata();
			?>
		</div>
<?php endif; ?>
