<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bluebox
 */

get_header();
?>
	<section class="grid lg:grid-cols-12 max-md:px-3 lg:px-0 gap-x-5 gap-y-5 items-start container">
		<?php
		$args = array(
			'class' => 'lg:col-span-12 order-0 max-lg:translate-y-2'
		);
		get_template_part('template-parts/global/breadcrumb', null, $args); ?>
		<header class="relative lg:col-span-8 xl:col-span-9 order-1">
			<?php if (has_post_thumbnail()) : ?>
				<img
					src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>"
					class="object-cover w-full px-0 rounded-lg transition-all duration-500 h-auto lg:aspect-video">
			<?php endif; ?>
			<h1 class="text-2xl lg:text-4xl text-black  font-normal mt-5"><?php the_title(); ?></h1>
		</header>
		<article id="post-<?php the_ID(); ?>" <?php post_class('lg:col-span-8 xl:col-span-9 order-3 entry-content prose prose-neutral text-black/70 prose-img:mx-auto text-justify prose-strong:text-black prose-headings:text-black prose-a:no-underline prose-a:text-icon'); ?>>
			<?php the_content(); ?>
		</article>
		<aside class="lg:sticky lg:col-span-4 xl:col-span-3 order-2 top-20 grid gap-4 max-md:w-full border border-gray-700 bg-black rounded-lg p-4">
			<?php get_template_part('template-parts/blog/single/post-information'); ?>
			<?php get_template_part('template-parts/blog/single/toc'); ?>
			<?php
			$args = array(
				'class' => 'max-lg:hidden'
			);
			get_template_part('template-parts/blog/single/related-portfolio', null, $args); ?>
			<?php
			$args = array(
				'class' => 'max-lg:hidden text-white',
			);
			get_template_part('template-parts/blog/single/share-button', null, $args); ?>
		</aside>
	</section>
<?php
$args = array(
	'class' => 'lg:hidden px-5'
);
get_template_part('template-parts/blog/single/related-portfolio', null, $args); ?>
<div class="container px-0 my-10">
	<?php
	if (comments_open() || get_comments_number()) {
		comments_template();
	}
	?>
</div>
<?php
$args = array(
	'class' => 'lg:hidden px-5 text-black mt-8',
	'linkClass' => 'bg-black p-2 !text-white rounded-sm hover:bg-black/10 transition-all'
);
get_template_part('template-parts/blog/single/share-button', null, $args); ?>
<?php //get_template_part('template-parts/blog/single/next-previous-posts'); ?>
<?php get_template_part('template-parts/blog/single/related-posts'); ?>
<?php
get_footer();
