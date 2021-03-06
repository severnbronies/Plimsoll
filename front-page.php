<?php

$context = Timber::context();
$context['post'] = new Timber\Post();

$context['upcoming_meets'] = new Timber\PostQuery([
	"posts_per_page" => 3,
	"meta_key" => "meet_end_time",
	"meta_compare" => ">",
	"meta_value" => date('Y-m-d H:i:s'),
	'orderby' => 'meta_value',
	'order' => 'DESC',
]);

/* Signposts */
function parseSignposts($signposts)
{
	$signpost_return = [];
	foreach ($signposts as $post) {
		$signpost_return[] = [
			"url" => get_field("signpost_link"),
			"image" => get_field("signpost_image"),
			"heading" => get_field("signpost_heading"),
			"blurb" => get_field("signpost_blurb"),
		];
	}
	return $signpost_return;
}
$context['signposts'] = get_field("homepage_signposts");

Timber::render('front-page.twig', $context);
