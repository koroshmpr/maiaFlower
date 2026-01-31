<?php

class Footer_Walker_Nav_Menu extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$classes = empty($item->classes) ? array() : (array)$item->classes;

		// Check if the menu item is the current page
		if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
			$classes[] = '!text-black before:scale-x-100'; // Add your custom active class
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="text-black/50 relative transition-all before:absolute before:origin-right before:bg-flower/50 before:h-0.5 before:w-full before:-bottom-1 before:duration-400 before:ease-in-out before:scale-x-0 hover:before:scale-100 before:transition-all before:bottom-0' . esc_attr($class_names) . ' text-sm hover:text-black"';

		$output .= '<li' . $class_names . '>';

		$atts = array();
		$atts['href'] = !empty($item->url) ? $item->url : '';
		$atts['class'] = 'transition';

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
			}
		}

		$title = apply_filters('the_title', $item->title, $item->ID);
		$output .= '<a' . $attributes . '>' . $title . '</a>';
	}
}
