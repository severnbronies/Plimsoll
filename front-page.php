<?php

$context = Timber::context();
$context['post'] = new Timber\Post();
$context['upcoming_meets'] = new Timber\PostQuery([
	"meta_key" => "meet_end_time",
	"meta_compare" => ">",
	"meta_value" => date('Y-m-d H:i:s'),
	'orderby' => 'meta_value',
	'order' => 'DESC',
]);

Timber::render('front-page.twig', $context);
