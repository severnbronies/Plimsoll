<?php

/* 
Template Name: Meets - Feed (iCal)
*/

header("Content-Type: text/calendar");

$context = Timber::context();
$context['EOL'] = PHP_EOL;
$context['meets'] = new Timber\PostQuery([
	"meta_key" => "meet_start_time",
	'orderby' => 'meta_value_num',
	'order' => 'DESC',
]);

Timber::render('feeds/ical.twig', $context);

?>
