<?php
$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;

// 1. Check if it's the first page
// 2. Check if the $_GET array is empty (no URL parameters like ?filter_color=...)
if ($current_page == 1 && empty($_GET)) :

	get_template_part('template-parts/shop/slider');

	$args = array(
		'class' => 'w-full mb-2',
		'perPage' => '5.1',
		'tabletPerPage' => '3.4',
		'mobilePerPage' => '2.1'
	);
	get_template_part('template-parts/product/colored-product-slider', null, $args);

endif;
?>
