<?php

$context = Timber::context();

$context['error404_heading'] = get_field('error404_heading', 'option');
$context['error404_content'] = get_field('error404_content', 'option');

Timber::render('error.twig', $context);
