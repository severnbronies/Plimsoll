<?php

/**
 * Copyright attribution
 */

function sb_copyright_field($form_fields, $post)
{
	$form_fields["copyright_field"] = [
		"label" => "Copyright",
		"value" => get_post_meta($post->ID, "_custom_copyright", true),
	];
	return $form_fields;
}
add_filter("attachment_fields_to_edit", "sb_copyright_field", null, 2);

function sb_copyright_field_save($post, $attachment)
{
	if (!empty($attachment["copyright_field"])) {
		update_post_meta(
			$post["ID"],
			"_custom_copyright",
			$attachment["copyright_field"]
		);
	} else {
		delete_post_meta($post["ID"], "_custom_copyright");
	}
	return $post;
}
add_filter("attachment_fields_to_save", "sb_copyright_field_save", null, 2);

/**
 * Source URL
 */

function sb_copyright_source($form_fields, $post)
{
	$form_fields["copyright_source"] = [
		"label" => "Source URL",
		"value" => get_post_meta($post->ID, "_custom_source", true),
	];
	return $form_fields;
}
add_filter("attachment_fields_to_edit", "sb_copyright_source", null, 2);

function sb_copyright_source_save($post, $attachment)
{
	if (!empty($attachment["copyright_source"])) {
		update_post_meta(
			$post["ID"],
			"_custom_source",
			$attachment["copyright_source"]
		);
	} else {
		delete_post_meta($post["ID"], "_custom_source");
	}
	return $post;
}
add_filter("attachment_fields_to_save", "sb_copyright_source_save", null, 2);

/**
 * Front-end function for getting those
 */

function get_featured_image_copyright($attachment_id = null)
{
	$attachment_id = empty($attachment_id)
		? get_post_thumbnail_id()
		: (int) $attachment_id;
	if ($attachment_id) {
		return [
			"copyright" => get_post_meta(
				$attachment_id,
				"_custom_copyright",
				true
			),
			"source" => get_post_meta($attachment_id, "_custom_source", true),
		];
	}
	return false;
}
