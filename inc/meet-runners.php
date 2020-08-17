<?php

/**
 * Create the 'meet runner' post type.
 */
function sb_runner_post_type()
{
	$labels = [
		"name" => _x("Meet Runners", "post type general name"),
		"singular_name" => _x("Meet Runner", "post type singular name"),
		"add_new" => _x("Add New", "book"),
		"add_new_item" => __("Add New Meet Runner"),
		"edit_item" => __("Edit Meet Runner"),
		"new_item" => __("New Meet Runner"),
		"all_items" => __("All Meet Runners"),
		"view_item" => __("View Meet Runner"),
		"search_items" => __("Search Meet Runners"),
		"not_found" => __("No meet runners found"),
		"not_found_in_trash" => __("No meet runners found in the trash"),
		"parent_item_colon" => "",
		"menu_name" => "Meet Runners",
	];
	$args = [
		"labels" => $labels,
		"description" => "Contains information about meet runners.",
		"public" => false,
		"menu_position" => 7,
		"supports" => ["title", "editor", "custom-fields", "author"],
		"has_archive" => false,
		"show_ui" => true,
		"show_in_menu" => true,
	];
	register_post_type("meet_runner", $args);
}
add_action("init", "sb_runner_post_type");

/**
 * Add meet runner column header to WP admin.
 * @param  array $defaults The existing list of column headers.
 * @return array           The modified list of column headers.
 */
function sb_meet_runner_column_title($defaults)
{
	$new = [];
	foreach ($defaults as $key => $title) {
		if ($key == "author") {
			$new['meet_runner'] = 'Meet Runner';
		}
		$new[$key] = $title;
	}
	return $new;
}
add_filter("manage_meet_posts_columns", "sb_meet_runner_column_title", 10);

/**
 * Add meet runner column content to WP admin.
 * @param  string $column_name The current column header.
 * @param  int    $post_id     The current post ID.
 */
function sb_meet_runner_column_content($column_name, $post_id)
{
	if ($column_name == "meet_runner") {
		$meet_runner = get_field("meet_runner", $post_id);
		for ($i = 0; $i < count($meet_runner); $i++) {
			echo get_the_title($meet_runner[$i]);
			if (!empty($meet_runner[$i + 1])) {
				echo ", ";
			}
		}
	}
}
add_filter(
	"manage_meet_posts_custom_column",
	"sb_meet_runner_column_content",
	11,
	2
);

/**
 * ACF configuration
 */
if (function_exists("register_field_group")) {
	register_field_group([
		'id' => 'acf_meet-runner-metadata',
		'title' => 'Meet Runner Metadata',
		'fields' => [
			[
				'key' => 'field_8xWzasD44tWQD',
				'label' => 'Contact email',
				'name' => 'runner_email',
				'type' => 'text',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'meet_runner',
					'order_no' => 0,
					'group_no' => 0,
				],
				[
					'param' => 'user_type',
					'operator' => '==',
					'value' => 'administrator',
					'order_no' => 1,
					'group_no' => 0,
				],
			],
		],
		'options' => [
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => [
				0 => 'custom_fields',
			],
		],
		'menu_order' => 0,
	]);
	register_field_group([
		'id' => 'acf_meet-runner-profile',
		'title' => 'Meet Runner Profile',
		'fields' => [
			[
				'key' => 'field_53300f71d84e2',
				'label' => 'Small Avatar',
				'name' => 'runner_avatar',
				'type' => 'image_crop',
				'instructions' =>
					'To upload a new avatar, delete the existing image (by hovering over the image below and clicking the × symbol) and upload a new one. ',
				'crop_type' => 'hard',
				'target_size' => 'custom',
				'width' => 200,
				'height' => 200,
				'preview_size' => 'medium',
				'force_crop' => 'yes',
				'save_in_media_library' => 'no',
				'retina_mode' => 'yes',
				'save_format' => 'url',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'meet_runner',
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

/**
 * Twig function
 */

function sb_runner_twig_function($id)
{
	$runners = get_field('meet_runner', $id);
	$meet_runners = [];
	foreach ($runners as $runner_id) {
		$meet_runners[] = [
			"id" => $runner_id,
			"name" => get_the_title($runner_id),
			"avatar" => sb_runner_avatar($runner_id),
			"biography" => sb_runner_biography($runner_id),
			"email" => get_field("runner_email", $runner_id),
		];
	}
	return $meet_runners;
}

/**
 * Get a meet runner's avatar from their user ID
 * @param  int    $id The post ID.
 * @return string     The URL for their avatar image.
 */
function sb_runner_avatar($id)
{
	if ($image = get_field("runner_avatar", $id)) {
		return $image;
	} else {
		return "http://1.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=96";
	}
}

/**
 * Get a meet runner's biography from their user ID
 * @param  int    $id The post ID.
 * @return string     Their biography contents as HTML.
 */
function sb_runner_biography($id)
{
	$content_post = get_post($id);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	return $content;
}
