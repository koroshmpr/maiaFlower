<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Maia Flower
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php
	$focus_keyword = get_post_meta(get_the_ID(), 'rank_math_focus_keyword', true);
	?>
	<meta name="keywords" content="<?= $focus_keyword ??  get_bloginfo('name'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php
	$scripts = get_field('header-scripts', 'option');
	echo $scripts ?? '';
	?>
</head>

<body
	x-data="{
		atBottom: false,
		scrolled: false,
        lastScroll: 0,
        scrollingDown: false,
        scrollingUp: false,
        menuOpen: false,
        intro : false
    }"
	x-init="window.addEventListener('scroll', () => {
        let currentScroll = window.pageYOffset;
        scrollingDown = currentScroll > lastScroll && currentScroll > 20;
        scrollingUp = currentScroll < lastScroll;
        lastScroll = currentScroll;
        scrolled = window.scrollY > 150;
        atBottom = (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 250;
    },
    setTimeout(() => { intro = true }, 200)
    )"
	<?php body_class('font-peyda'); ?>>
<?php $scripts = get_field('body-scripts', 'option');
echo $scripts ?? ''; ?>
<?php wp_body_open(); ?>
<?php get_template_part('template-parts/layout/header-content'); ?>
<main :class="menuOpen ? 'scale-[95%]' : ''"  class="relative lg:pt-16 pt-2 transition-all" id="<?= get_post_type() ?? ''; ?>-<?= the_ID(); ?>">
