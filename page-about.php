<?php

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

// Meet stats
$all_meets = new WP_Query("post_type=post&posts_per_page=-1");
$context['meet_count'] = $all_meets->found_posts;
$meet_length = 0;
while ($all_meets->have_posts()) {
	$all_meets->the_post();
	$start = get_field("meet_start_time");
	$end = get_field("meet_end_time");
	$meet_length += $end - $start;
}
$context['meet_hours'] = round($meet_length / 60 / 60);
$context['meet_years'] = date('Y') - 2012;

// Meet types
$context['meet_types'] = get_categories();

// Meet staff
function parseStaffList($staff_list)
{
	$staff_list_return = [];
	foreach ($staff_list as $staff) {
		$staff_list_return[] = [
			"name" => $staff->post_title,
			"avatar" => sb_runner_avatar($staff->ID),
			"biography" => $staff->post_content,
			"email" => get_field("runner_email", $staff->ID),
		];
	}
	return $staff_list_return;
}
$context['staff_current'] = parseStaffList(
	get_field('about_staff_current', $timber_post->ID)
);
$context['staff_former'] = parseStaffList(
	get_field('about_staff_former', $timber_post->ID)
);

// Media appearances
$media_appearances = get_field('about_media_appearances', $timber_post->ID);
$context['media_appearances'] = $media_appearances;

Timber::render('about.twig', $context);
