<a href="<?php the_permalink(); ?>" class="flex flex-col gap-y-4 group text-white/70 hover:text-white/90 border-e border-transparent hover:border-white/5 transition-all duration-500">
	<div class="flex justify-between gap-x-3 items-start">
		<span class="lg:w-10/12 text-xl font-bold"><?php the_title(); ?></span>
	</div>
	<img class="lg:w-10/12 object-cover aspect-square opacity-65 group-hover:opacity-100 transition-all" height="250" src="<?= the_post_thumbnail_url(); ?>"
		 alt="image of the <?= get_the_title(); ?> post">
</a>
