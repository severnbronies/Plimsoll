<?php

function sb_menus()
{
	$locations = [
		'primary' => __('Primary Navigation', 'sb'),
		'footer' => __('Footer Menu', 'sb'),
		'social' => __('Social Menu', 'sb'),
		'about-subnav' => __('About Subnav', 'sb'),
		'resources-subnav' => __('Resources Subnav', 'sb'),
	];

	register_nav_menus($locations);
}

add_action('init', 'sb_menus');
