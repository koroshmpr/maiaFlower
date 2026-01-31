<?php
$links = paginate_links(array(
	'type' => 'array',
	'prev_next' => false,

));
if ($links) : ?>

	<nav class="mt-10" aria-label="pagination">
		<?php echo '<ul class="pagination justify-center flex-wrap items-center flex gap-x-3 mb-0">';
		// get_previous_posts_link will return a string or void if no link is set.
		if ($prev_posts_link = get_previous_posts_link(__('<'))) :
			echo '<li class="prev p-3 bg-foreground aspect-square text-black">';
			echo $prev_posts_link;
			echo '</li>';
		endif;
		echo '<li class="page-item">';
		echo join('</li><li class="page-item">', $links);
		echo '</li>';

		// get_next_posts_link will return a string or void if no link is set.
		if ($next_posts_link = get_next_posts_link(__('>'))) :
			echo '<li class="next p-3 bg-foreground aspect-square text-black">';
			echo $next_posts_link;
			echo '</li>';
		endif;
		echo '</ul>';
		?>
	</nav>

<?php endif;
wp_reset_postdata();
?>
