<?php

$context = Timber::context();
$timber_post = Timber::query_post();

$context['GOOGLE_MAPS_API_KEY'] = GOOGLE_MAPS_API_KEY;

$context['post'] = $timber_post;
$context['locations'] = sb_location_twig_function($timber_post->ID);

$runners = sb_runner_twig_function($timber_post->ID);
$context['runners'] = $runners;

$runners_names = [];
foreach ($runners as $runner) {
	$runners_names[] = $runner['name'];
}
$context['runners_names'] = $runners_names;

Timber::render('meet.twig', $context);
