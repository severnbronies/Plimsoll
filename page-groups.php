<?php

/* 
Template Name: Severn Bronies groups and subgroups
*/

function twig_slug_filter($string)
{
	return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$groups = get_field('group_categories');
$context['groups'] = $groups;

$navItems = [];
foreach ($groups as $group) {
	$navItems[] = [
		"link" => "#" . twig_slug_filter($group['group_category_name']),
		"title" => $group['group_category_name'],
	];
}
$context['navItems'] = $navItems;

Timber::render('page-groups.twig', $context);
