<?php

$context = Timber::context();
$context['post'] = new Timber\Post();

Timber::render('index.twig', $context);
