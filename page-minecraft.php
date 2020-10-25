<?php

/* 
Template Name: Campaign - Minecraft
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$server_status = json_decode(
	file_get_contents('https://api.mcsrvstat.us/2/mc.rippsco.re:7876')
);
$context['server'] = $server_status;

Timber::render('page-minecraft.twig', $context);
