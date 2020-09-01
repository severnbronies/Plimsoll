<?php

$context = Timber::context();
$context['post'] = new Timber\Post();

// The format we get images back in is messier than we'd like and doesn't align
// with the format our gallery component uses, so we're gonna clean it up first
$images = get_field('block_gallery_images');
$images_cleaned = [];
foreach ($images as $image) {
	$img = $image['block_gallery_image'];
	$images_cleaned[] = [
		'id' => $img['id'],
		'ID' => $img['ID'],
		'href' => $img['url'],
		'image' => [
			'alt' => $img['alt'] || $img['description'],
			'src' => $img['sizes']['medium'],
			'width' => $img['width'],
			'height' => $img['height'],
			'sizes' => $img['sizes'],
		],
	];
}
$context['images'] = $images_cleaned;

Timber::render('partials/blocks/sb-gallery.twig', $context);
