<?php /* Template Name: Home */
get_header();
get_template_part('template-parts/homepage/hero');
get_template_part('template-parts/product/category-list');

$args = array(
	'class' => 'lg:py-12 px-0 container',
	'tabletPerPage' => '3.4',
	'mobilePerPage' => '2.1'
);
get_template_part('template-parts/product/colored-product-slider', null, $args);
get_template_part('template-parts/homepage/aboutus');
get_template_part('template-parts/homepage/portfolios-slider');
get_template_part('template-parts/blog/latest-blog');
//get_template_part('template-parts/homepage/information');
//get_template_part('template-parts/homepage/last-post');
//get_template_part('template-parts/homepage/customers');

?>
<?php
get_footer();
