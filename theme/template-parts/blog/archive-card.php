<a href="<?php the_permalink(); ?>" class="relative group overflow-hidden">
	<div class="absolute bottom-0 text-white inset-x-0 bg-gradient-to-t lg:translate-y-8/12 group-hover:translate-y-0 duration-500 from-black via-black/70 to-black/20 group-hover:backdrop-blur-sm transition-all flex flex-col justify-between gap-y-3 p-3 pb-6">
		<span class="text-xl font-bold"><?php the_title(); ?></span>
		<span class="text-xs lg:text-sm"><?= shamsi_date('d F, Y', get_the_modified_time('U')); ?></span>
		<p class="text-white/80 text-xs text-justify line-clamp-2 transition-all"><?= wp_trim_words(get_the_content(), 25); ?></p>
	</div>
	<img class="w-full object-cover aspect-3/4" height="250" src="<?= the_post_thumbnail_url(); ?>"
		 alt="image of the <?= get_the_title(); ?> post">
</a>
