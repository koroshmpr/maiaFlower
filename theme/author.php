<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package YourTheme
 */

get_header(); ?>

<?php
// Get Author Data
$author = get_queried_object();
?>

	<!-- Author Info -->
	<header class="container max-w-content pb-8">
		<h1 class="text-black text-3xl"><?php echo esc_html($author->display_name); ?></h1>
	</header>
	<section class="container max-w-content grid lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-5">
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
	<?php get_template_part('template-parts/global/pagination'); ?>
	<?php
	// Reset query
	wp_reset_postdata();
endif; ?>
	</section>

<?php get_footer(); ?>
