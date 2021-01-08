<?php

/* 
Template Name: Generic page with Resources subnav
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$context['subnavLabel'] = 'Resources navigation';
$context['subnav'] = new Timber\Menu('resources-subnav');

Timber::render('page-with-subnavigation.twig', $context);
