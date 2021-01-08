<?php

/* 
Template Name: Generic page 
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

Timber::render('page.twig', $context);
