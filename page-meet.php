<?php
/**
 * This page acts as the meet archive page. It's at this URL because meet URLs
 * are prefixed with /meet/, and doing it this way was the path of least
 * fucking-with-how-WordPress works.
 */

$context = Timber::context();

// We use a bunch of custom archive logic here, cuz we're categorising based on a meta key and not the posted date.
$meet_year = get_query_var('meet_year');
$meet_month = get_query_var('meet_month');

if ($meet_year || $meet_month) {
	$context['showing_archived_meets'] = true;
	$context['title'] = $meet_month
		? 'Meets from ' . $meet_month . ' ' . $meet_year
		: 'Meets from ' . $meet_year;

	// Obtain meets from the archive
	$meet_range_start = $meet_month
		? $meet_year . '-' . $meet_month . '-01 00:00:00'
		: $meet_year . '-01-01 00:00:00';
	$meet_range_end = $meet_month
		? $meet_year . '-' . $meet_month . '-31 23:59:59'
		: $meet_year . '-12-31 23:59:59';

	$context['meet_year'] = $meet_year;
	$context['meet_month'] = $meet_month;
	$context['meet_range_start'] = $meet_range_start;
	$context['meet_range_end'] = $meet_range_end;
	$context['meets'] = new Timber\PostQuery([
		'posts_per_page' => -1,
		"meta_key" => "meet_start_time",
		"meta_compare" => "BETWEEN",
		"meta_value" => [$meet_range_start, $meet_range_end],
		'orderby' => 'meta_value',
		'order' => 'DESC',
	]);
} else {
	$context['showing_archived_meets'] = false;
	$context['title'] = 'Upcoming meets';

	// Get upcoming or ongoing meets only
	$context['meets'] = new Timber\PostQuery([
		'posts_per_page' => -1,
		"meta_key" => "meet_end_time",
		"meta_compare" => ">",
		"meta_value" => date('Y-m-d H:i:s'),
		'orderby' => 'meta_value',
		'order' => 'DESC',
	]);
}

// TODO: Make this use WP_Query and not janky inline SQL
$archives_nav = "SELECT DISTINCT YEAR(meta_value) as 'year', DATE_FORMAT(meta_value, '%m') as 'month' FROM $wpdb->postmeta WHERE meta_key = 'meet_start_time' ORDER BY meta_value DESC";
$archives_nav_results = $wpdb->get_results($archives_nav);
$context['meet_archive'] = $archives_nav_results;

Timber::render('archive.twig', $context);
