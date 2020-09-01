<?php

$context = Timber::context();
$context['post'] = new Timber\Post();

$context['url'] = get_field('block_button_url');
$context['label'] = get_field('block_button_label');
$context['variants'] = get_field('block_button_variants');

Timber::render('partials/blocks/sb-button.twig', $context);
