<?php

$context = Timber::context();
$context['posts'] = new Timber\PostQuery([
	'posts_per_page' => -1,
	'post_type' => 'news',
]);

Timber::render('news-archive.twig', $context);
