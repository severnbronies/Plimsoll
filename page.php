<?php

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$child_pages = get_pages(
	[
		'child_of' => $timber_post->ID,
	],
	'ARRAY_A'
);

$timber_child_pages = [];
foreach ($child_pages as $page) {
	$timber_child_pages[] = new Timber\Post($page->ID);
}

$context['children'] = $timber_child_pages;

Timber::render('page.twig', $context);
