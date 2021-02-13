<?php

/**
 * Create 'news' post type.
 */
function sb_news_post_type()
{
	$labels = [
		'name' => _x('News Posts', 'post type general name'),
		'singular_name' => _x('News Post', 'post type singular name'),
		'add_new' => _x('Add New', 'book'),
		'add_new_item' => __('Add New News Post'),
		'edit_item' => __('Edit News Post'),
		'new_item' => __('New News Post'),
		'all_items' => __('All News Posts'),
		'view_item' => __('View News Post'),
		'search_items' => __('Search News Posts'),
		'not_found' => __('No news posts found'),
		'not_found_in_trash' => __('No news posts found in the trash'),
		'parent_item_colon' => '',
		'menu_name' => 'News Posts',
	];
	$args = [
		'labels' => $labels,
		'description' => 'Contains news posts.',
		'public' => true,
		'menu_position' => 7,
		'supports' => ['title', 'editor', 'custom-fields', 'author'],
		'has_archive' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'rewrite' => [
			'slug' => 'news',
			'with_front' => false,
		],
	];
	register_post_type('news', $args);
}
add_action('init', 'sb_news_post_type');

/**
 * Used for a little detailing.
 */
function sb_roman_numeral($number)
{
	$map = [
		'M' => 1000,
		'CM' => 900,
		'D' => 500,
		'CD' => 400,
		'C' => 100,
		'XC' => 90,
		'L' => 50,
		'XL' => 40,
		'X' => 10,
		'IX' => 9,
		'V' => 5,
		'IV' => 4,
		'I' => 1,
	];
	$returnValue = '';
	while ($number > 0) {
		foreach ($map as $roman => $int) {
			if ($number >= $int) {
				$number -= $int;
				$returnValue .= $roman;
				break;
			}
		}
	}
	return $returnValue;
}
