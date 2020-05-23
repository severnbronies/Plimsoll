<?php

/**
 * Additional named crop sizes
 */

add_image_size("search-result", 160, 160, true);
add_image_size("meet-smaller", 380, 190, true);
add_image_size("meet-small", 760, 380, true);
add_image_size("meet-medium", 1140, 760, true);
add_image_size("meet-large", 1520, 1140, true);
add_image_size("meet-larger", 1900, 1520, true);

/**
 * Make image attachments 'link to' setting default to 'none'.
 */

function sb_set_image_linking()
{
	$image_set = get_option("image_default_link_type");
	if ($image_set !== "none") {
		update_option("image_default_link_type", "none");
	}
}
add_action("admin_init", "sb_set_image_linking", 10);

/**
 * Override WP's default image embedding code to allow for responsive images.
 */

function sb_image_insertion(
	$html,
	$id,
	$caption,
	$title,
	$align,
	$url,
	$size,
	$alt
) {
	return "[image id='$id' align='$align']";
}
add_filter("image_send_to_editor", "sb_image_insertion", 10, 9);

// Build responsive image sources.
function sb_responsive_image($image, $mappings)
{
	$array = [];
	foreach ($mappings as $size => $type) {
		$image_src = wp_get_attachment_image_src($image, $type);
		$array[] =
			'<source srcset="' .
			$image_src[0] .
			'" media="(min-width: ' .
			$size .
			'px)">';
	}
	return implode(array_reverse($array));
}

// Image alt text
function sb_responsive_image_alt($image)
{
	$image_alt = trim(
		strip_tags(get_post_meta($image, "_wp_attachment_image_alt", true))
	);
	if (!$image_alt) {
		$image_alt = "Image";
	}
	return $image_alt;
}

// Shortcode for responsive images in content.
function sb_responsive_image_shortcode($attributes)
{
	extract(
		shortcode_atts(
			[
				"id" => 1,
				"size1" => 0,
				"size2" => 600,
				"size3" => 1024,
				"align" => "none",
			],
			$attributes
		)
	);
	$mappings = [
		$size1 => "article-small",
		$size2 => "article-medium",
		$size3 => "article-large",
	];
	$return =
		'<picture><!--[if IE 9]><video style="display:none;"><[endif]-->' .
		sb_responsive_image($id, $mappings) .
		'<!--[if IE 9]></video><![endif]--><img srcset="' .
		wp_get_attachment_image_src($id)[0] .
		'" alt="' .
		sb_responsive_image_alt($id) .
		'"><noscript>' .
		wp_get_attachment_image($id, $mappings[0]) .
		'</noscript></picture>';
	if (isset($align) && $align != "none") {
		$return = sb_aside_shortcode(["align" => $align], $return);
	}
	return $return;
}
add_shortcode("image", "sb_responsive_image_shortcode");

// Asides (for aligning images)
function sb_aside_shortcode($attributes, $content = null)
{
	extract(
		shortcode_atts(
			[
				"align" => "right",
			],
			$attributes
		)
	);
	if ($align === "centre") {
		$align = "center";
	}
	return '<aside class="article__aside article__aside--' .
		$align .
		'">' .
		$content .
		'</aside>';
}
add_shortcode("aside", "sb_aside_shortcode");
