<?php

/* 
Template Name: Generic page with About subnav
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$context['subnavLabel'] = 'About the Severn Bronies';
$context['subnav'] = new Timber\Menu('about-subnav');

Timber::render('page-with-subnavigation.twig', $context);
