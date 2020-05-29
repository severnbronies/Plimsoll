<?php

$context = Timber::context();
$context['search_query'] = get_search_query();
$context['results'] = new Timber\PostQuery(
	$query_string . "&posts_per_page=-1&post_type=post"
);

Timber::render('search.twig', $context);
