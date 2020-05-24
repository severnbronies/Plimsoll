<?php

/**
 * Create 'location' post type.
 */
function sb_location_post_type()
{
	$labels = [
		'name' => _x('Locations', 'post type general name'),
		'singular_name' => _x('Location', 'post type singular name'),
		'add_new' => _x('Add New', 'book'),
		'add_new_item' => __('Add New Location'),
		'edit_item' => __('Edit Location'),
		'new_item' => __('New Location'),
		'all_items' => __('All Locations'),
		'view_item' => __('View Location'),
		'search_items' => __('Search Locations'),
		'not_found' => __('No locations found'),
		'not_found_in_trash' => __('No locations found in the trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Locations',
	];
	$args = [
		'labels' => $labels,
		'description' => 'Contains meet locations and venues.',
		'public' => false,
		'menu_position' => 7,
		'supports' => ['title', 'custom-fields', 'author'],
		'has_archive' => false,
		'show_ui' => true,
		'show_in_menu' => true,
	];
	register_post_type('location', $args);
}
add_action('init', 'sb_location_post_type');

/**
 * Add locality column header to list of meet locations.
 * @param  array $defaults List of existing column headers.
 * @return array           List of modified column headers.
 */
function sb_meet_locality_column_title($defaults)
{
	$new = [];
	foreach ($defaults as $key => $title) {
		if ($key == "author") {
			$new['locality'] = 'Locality';
		}
		$new[$key] = $title;
	}
	return $new;
}
add_filter(
	"manage_location_posts_columns",
	"sb_meet_locality_column_title",
	10
);

/**
 * Add locality column content to list of meet locations.
 * @param  string $column_name The current column name.
 * @param  int    $post_id     The current post ID.
 */
function sb_meet_locality_column_content($column_name, $post_id)
{
	if ($column_name == "locality") {
		echo get_field("location_locality", $post_id);
	}
}
add_filter(
	"manage_location_posts_custom_column",
	"sb_meet_locality_column_content",
	10,
	2
);

/**
 * ACF configuration
 */
if (function_exists("register_field_group")) {
	register_field_group([
		'id' => 'acf_location-details',
		'title' => 'Location Details',
		'fields' => [
			[
				'key' => 'field_5330011b130fb',
				'label' => 'Address',
				'name' => 'location_address',
				'type' => 'google_map',
				'instructions' => 'Drop a pin for this location',
				'center_lat' => '51.4481083',
				'center_lng' => '-2.5835877',
				'zoom' => 12,
				'height' => '',
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
			],
			[
				'key' => 'field_56c487d97e01f',
				'label' => 'Locality',
				'name' => 'location_locality',
				'type' => 'select',
				'required' => 0,
				'choices' => [
					'Bristol' => 'Bristol',
					'Cardiff' => 'Cardiff',
					'Newport' => 'Newport',
					'Weston-super-Mare' => 'Weston-super-Mare',
					'' => 'Elsewhere',
				],
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			],
			[
				'key' => 'field_5eca48be711ea',
				'label' => 'Travel information',
				'name' => 'location_travel',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
			],
			[
				'key' => 'field_5eca47e2711e9',
				'label' => 'Accessibility information',
				'name' => 'location_accessibility',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'location',
					'order_no' => 0,
					'group_no' => 0,
				],
			],
		],
		'options' => [
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => [
				0 => 'custom_fields',
			],
		],
		'menu_order' => 0,
	]);
}

function sb_location_twig_function($id)
{
	$locations = get_field('meet_location', $id);
	$return_array = [];
	foreach ($locations as $location_id) {
		$data = get_field("location_address", $location_id);
		$return_array[] = [
			"name" => get_the_title($location_id),
			"address" => $data["address"],
			"latitude" => $data["lat"],
			"longitude" => $data["lng"],
			"locality" =>
				get_field("location_locality", $location_id) != ""
					? get_field("location_locality", $location_id)
					: false,
			"accessibility_info" => get_field(
				"location_accessibility",
				$location_id
			),
			"travel_info" => get_field("location_travel", $location_id),
		];
	}
	return $return_array;
}
