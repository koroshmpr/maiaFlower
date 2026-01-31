<?php /* Template Name: about us */
$owners = get_field('owners');
get_header(); ?>
	<section class="container max-w-content pt-24">
		<h1 class="text-white text-6xl"><?php the_title() ?></h1>
		<article class="bg-icon/90 border border-white/5 mt-12 mb-6 p-5 text-black/70 leading-[2]"><?php the_content(); ?></article>
	</section>
<?php if ($owners): ?>
	<section class="container max-w-content grid lg:grid-cols-2 gap-5 pb-12">
		<?php foreach ($owners as $owner): ?>
		<div class="flex flex-col gap-y-1 text-white">
			<img src="<?= $owner['image']['url'] ?? '' ?>" alt="<?= $owner['image']['title'] ?? '' ?>">
			<h2 class="font-bold mt-5 text-3xl"><?= $owner['name'] ?? ''; ?></h2>
			<span><?=  $owner['position'] ?? '';?></span>
		</div>
		<?php endforeach; ?>
	</section>
<?php
endif;
get_footer();
