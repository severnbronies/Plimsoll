<?php

/**
 * Return the HTML formatted start and end dates for a meet as an HTML5 time element.
 * @param  string $start The start date timestamp.
 * @param  mixed  $end   The end date timestamp, set to false to not output this at all.
 * @return string        HTML formatted start and end dates.
 */
function sb_meet_dates($start, $end = false)
{
	$output = '<strong>' . date("j F Y", $start) . '</strong><br>';
	$output .= date("g:ia", $start);
	if ($end) {
		$output .= "&ndash;" . date("g:ia", $end);
	}
	return $output;
}

/**
 * Add running time column header to WP admin.
 * @param  array $defaults The existing list of column headers.
 * @return array           The modified list of column headers.
 */
function sb_meet_time_column_title($defaults)
{
	$new = [];
	foreach ($defaults as $key => $title) {
		if ($key == "author") {
			$new['meet_time'] = 'Running Time';
		}
		$new[$key] = $title;
	}
	unset($new["date"]);
	return $new;
}
add_filter("manage_posts_columns", "sb_meet_time_column_title", 10);

/**
 * Add running time column content to WP admin.
 * @param  string $column_name The current column header.
 * @param  int    $post_id     The current post ID.
 */
function sb_meet_time_column_content($column_name, $post_id)
{
	if ($column_name == "meet_time") {
		echo sb_meet_dates(
			get_field("meet_start_time", $post_id),
			get_field("meet_end_time", $post_id)
		);
	}
}
add_filter("manage_posts_custom_column", "sb_meet_time_column_content", 10, 2);

/**
 * Make running time sortable in WP admin.
 * @param  array $columns The existing list of sortable columns.
 * @return array          The modified list of sortable columns.
 */
function sb_meet_time_column_sortable($columns)
{
	$columns["meet_time"] = "meet_time";
	return $columns;
}
add_filter("manage_edit_sortable_columns", "sb_meet_time_column_sortable");

/**
 * Define how to sort running time column in WP admin.
 * @param  ??? $query I dunno, probably an object or something?
 */
function sb_meet_time_column_orderby($query)
{
	$orderby = $query->get("orderby");
	if ($orderby == "meet_time") {
		$query->set("meta_key", "meet_start_time");
		$query->set("orderby", "meta_value_num");
	}
}
add_action("pre_get_posts", "sb_meet_time_column_orderby");

/**
 * Add location column header to WP admin.
 * @param  array $defaults The existing list of column headers.
 * @return array           The modified list of column headers.
 */
function sb_meet_location_column_title($defaults)
{
	$new = [];
	foreach ($defaults as $key => $title) {
		if ($key == "author") {
			$new['location'] = 'Location';
		}
		$new[$key] = $title;
	}
	return $new;
}
add_filter("manage_posts_columns", "sb_meet_location_column_title", 11);

/**
 * Add location column content to WP admin.
 * @param  string $column_name The current column header.
 * @param  int    $post_id     The current post ID.
 */
function sb_meet_location_column_content($column_name, $post_id)
{
	if ($column_name == "location") {
		$meet_location = get_field("meet_location", $post_id);
		for ($i = 0; $i < count($meet_location); $i++) {
			$address = get_field("location_address", $meet_location[$i]);
			echo '<strong>' .
				get_the_title($meet_location[$i]) .
				"</strong><br>" .
				$address["address"];
			if (!empty($meet_location[$i + 1])) {
				echo "<br>";
			}
		}
	}
}
add_filter(
	"manage_posts_custom_column",
	"sb_meet_location_column_content",
	10,
	2
);

/**
 * ACF configuration
 */
if (function_exists("register_field_group")) {
	register_field_group([
		'id' => 'acf_meet-details',
		'title' => 'Meet Details',
		'fields' => [
			[
				'key' => 'field_53bda6ededcb8',
				'label' => 'Meet Notes',
				'name' => 'meet_notes',
				'type' => 'textarea',
				'instructions' =>
					'Notes on this meet. This content is <strong>NOT</strong> rendered on the front-end of the site, and is here merely for reference and planning purposes.',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			],
			[
				'key' => 'field_532f5918221fb',
				'label' => 'Start Time',
				'name' => 'meet_start_time',
				'type' => 'date_time_picker',
				'instructions' => 'The starting time and date for the meet.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'display_format' => 'd/m/Y; g:i a',
				'return_format' => 'U',
				'first_day' => 1,
			],
			[
				'key' => 'field_532f59a1221fc',
				'label' => 'End Time',
				'name' => 'meet_end_time',
				'type' => 'date_time_picker',
				'instructions' => 'The ending time and date for the meet.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'display_format' => 'd/m/Y; g:i a',
				'return_format' => 'U',
				'first_day' => 1,
			],
			[
				'key' => 'field_533001b69737a',
				'label' => 'Location',
				'name' => 'meet_location',
				'type' => 'relationship',
				'instructions' => 'Where this meet is. ',
				'required' => 1,
				'return_format' => 'id',
				'post_type' => [
					0 => 'location',
				],
				'taxonomy' => [
					0 => 'all',
				],
				'filters' => [
					0 => 'search',
				],
				'result_elements' => [
					0 => 'post_title',
				],
				'max' => '',
			],
			[
				'key' => 'field_53300fe71d850',
				'label' => 'Meet Runner',
				'name' => 'meet_runner',
				'type' => 'relationship',
				'instructions' => 'Who\'s in charge of this shindig?',
				'required' => 1,
				'return_format' => 'id',
				'post_type' => [
					0 => 'meet_runner',
				],
				'taxonomy' => [
					0 => 'all',
				],
				'filters' => [
					0 => 'search',
				],
				'result_elements' => [
					0 => 'post_title',
				],
				'max' => '',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
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
