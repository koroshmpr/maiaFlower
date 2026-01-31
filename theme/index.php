<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bluebox
 */

get_header();
?>
	<article class=" container grid lg:grid-cols-12 gap-4  pt-4 lg:pt-8">
		<header class="lg:col-span-12 border-b border-black/10">
			<h1 class="text-black text-3xl border-b-2 border-flower w-fit"><?php single_post_title(); ?></h1>
		</header>
		<aside x-data="{open : false}" class="lg:col-span-4 xl:col-span-3">
			<button
				:class="intro ? '!translate-y-0' : ''"
				class="lg:hidden fixed translate-y-full duration-200 bg-white border border-black/5 rounded-full z-[3] end-4 bottom-4 p-3 transition-all aspect-square"
				@click="open = !open">
				<?php
				$args = array(
					'size' => '30',
					'class' => 'text-gray-600',
				);
				get_template_part('template-parts/svg/tag', null, $args);
				?>
			</button>
			<div
				class="flex flex-col transition-all -z-1 duration-300 bg-black/5 backdrop-blur-sm fixed inset-0 start-0"
				:class="open ? '!z-[3]' : ''" @click="open = !open"></div>
			<div
				:class="open ? '!translate-x-0' : ''"
				class="lg:contents flex flex-col transition-all bg-gray-50 translate-x-full duration-300 w-3/4 fixed inset-y-0 start-0 z-[3]">
				<div class="lg:hidden flex justify-between items-center pt-20 px-5 pb-3 font-bold lg:pt-0">
					<span>دسته بندی‌ها:</span>
					<button
						:class="intro ? '!translate-y-0' : ''"
						class=" text-white p-1.5 transition-all border bg-gray-700 border-black/10 rounded-full aspect-square"
						@click="open = !open">
						<?php
						$args = array(
							'size' => '15',
							'class' => '',
						);
						get_template_part('template-parts/svg/close', null, $args);
						?>
					</button>
				</div>
				<?php
				$args = array(
					'class' => 'h-full lg:h-auto',
				);
				get_template_part('template-parts/global/category-dropdown-list', null, $args); ?>
			</div>
		</aside>
		<section class="lg:col-span-8 xl:col-span-9 max-w-content grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mb-8">
			<?php
			if (have_posts()) :
			$paged = max(1, get_query_var('paged', 1)); // Get current page number
			$posts_per_page = get_query_var('posts_per_page', get_option('posts_per_page'));
			$i = ($paged - 1) * $posts_per_page + 1; // Calculate starting index
			// Load posts loop.
			while (have_posts()) :
				the_post();
				$args = array(
					'index' => $i
				);
				get_template_part('template-parts/blog/archive-card', null, $args);
				$i++;
			endwhile;
			?>
		</section>
		<?php get_template_part('template-parts/global/pagination');
		// Reset query
		wp_reset_postdata();
		endif; ?>
	</article>
<?php get_footer();
