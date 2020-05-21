<?php

$context = Timber::context();
$context['search_query'] = get_search_query();
$context['posts'] = new Timber\PostQuery($query_string . "&posts_per_page=-1");

Timber::render('search.twig', $context);
