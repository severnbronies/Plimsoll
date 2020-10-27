<?php

/* 
Template Name: Campaign - Minecraft
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

if ($server_url = get_field('api_minecraft_server_url', 'option')) {
	$server_status = json_decode(
		file_get_contents('https://api.mcsrvstat.us/2/' . $server_url)
	);
	$context['server'] = $server_status;
} else {
	$context['server'] = false;
}

Timber::render('page-minecraft.twig', $context);
