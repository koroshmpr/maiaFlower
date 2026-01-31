<?php
$textColor = 'white';

?>

<div class="grid grid-cols-2 items-center text-<?= $textColor;?>/70 gap-2 justify-center text-sm">
	<?php
	$boxClass = 'flex items-center lg:gap-x-2 gap-x-3';
	$svgClass = 'bg-' . $textColor . ' border border-' . $textColor . '/5 rounded-lg text-black/80 p-2 box-content';
	$svgSize = '18'; ?>
	<span class="<?= $boxClass; ?>">
    <svg class="bi bi-person-fill <?= $svgClass; ?>" width="<?= $svgSize ?>" height="<?= $svgSize ?>"
		 fill="currentColor" viewBox="0 0 16 16">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
    </svg>
    <?php
	$post_id = get_the_ID();
	$author_id = get_post_field('post_author', $post_id);
	$display_name = get_the_author_meta('display_name', $author_id);
	$author_url = get_author_posts_url($author_id);
	?>
    <a href="<?= esc_url($author_url); ?>"
	   rel="author"
	   aria-label="View all posts by <?= esc_attr($display_name); ?>"
	   title="View all posts by <?= esc_attr($display_name); ?>"
	   class="text-<?= $textColor;?>/50 hover:text-<?= $textColor;?> transition">
        <?= esc_html($display_name); ?>
    </a>
</span>
	<time datetime="<?= shamsi_date('d F, Y', get_the_modified_time('U')); ?>" itemprop="modified" class="<?= $boxClass; ?>">
         <svg class="bi bi-calendar2-check <?= $svgClass; ?>" width="<?= $svgSize ?>" height="<?= $svgSize ?>" fill="currentColor"
					  viewBox="0 0 16 16">
                  <path
					  d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                  <path
					  d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
                  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
         <?= shamsi_date('d F, Y', get_the_modified_time('U')); ?>
     </time>
	<span class="<?= $boxClass; ?>">
		<svg class="bi bi-tags-fill shrink-0 <?= $svgClass; ?>" width="<?= $svgSize ?>" height="<?= $svgSize ?>" fill="currentColor" viewBox="0 0 16 16">
		  <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
		  <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z"/>
		</svg>
         	<?php
			$categories = get_the_terms(get_the_ID(), 'category');
			if ($categories && !is_wp_error($categories)) : ?>
				<p class="text-sm items-center !my-0 flex line-clamp-1 overflow-hidden gap-x-3">
					<?php foreach ($categories as $index => $category) : ?>
						<a href="<?= get_term_link($category); ?>"
						   class="text-<?= $textColor;?>/50 text-sm text-nowrap lg:text-xs no-underline hover:text-<?= $textColor;?>"><?= $category->name; ?></a>
					<?php
					endforeach; ?>
				</p>
			<?php
			endif; ?>
     </span>
	<span class="<?= $boxClass; ?>">
		<svg class="bi bi-stopwatch-fill shrink-0 <?= $svgClass; ?>" width="<?= $svgSize ?>" height="<?= $svgSize ?>" fill="currentColor"
			 viewBox="0 0 16 16">
		  <path
			  d="M6.5 0a.5.5 0 0 0 0 1H7v1.07A7.001 7.001 0 0 0 8 16a7 7 0 0 0 5.29-11.584l.013-.012.354-.354.353.354a.5.5 0 1 0 .707-.707l-1.414-1.415a.5.5 0 1 0-.707.707l.354.354-.354.354-.012.012A6.97 6.97 0 0 0 9 2.071V1h.5a.5.5 0 0 0 0-1zm2 5.6V9a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1 0-1h3V5.6a.5.5 0 1 1 1 0"/>
		</svg>
		<span class="font-bold"><?= do_shortcode('[reading_time]') ?></span>
		<span>دقیقه</span>
	</span>
</div>
