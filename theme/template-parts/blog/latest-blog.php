<section class="container max-lg:px-3 my-12">
	<div class="flex justify-between items-center border-b mb-4 border-black/10">
		<h2 class="pb-2 border-b-2 border-flower/90">مطالب خواندنی</h2>
		<a class="flex gap-1 items-center group" href="/blog">
			<span class="group-hover:translate-x-1 transition-all">مشاهده همه</span>
		<?php
		$args = array(
			'size' => '18',
			'class' => 'rotate-180 group-hover:-translate-x-1 transition-all'
		);
		get_template_part('template-parts/svg/chevron-right',null,$args); ?>
		</a>
	</div>
	<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 lg:gap-4">
		<?php
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 4,
			'ignore_sticky_posts' => true
		);
		$loop = new WP_Query($args);
		if ($loop->have_posts()) :
			// Load posts loop.
			while ($loop->have_posts()) :
				$loop->the_post();
				get_template_part('template-parts/blog/archive-card');
			endwhile;
			// Reset query
			wp_reset_postdata();
		endif;
		?>
	</div>
</section>
