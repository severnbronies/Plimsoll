<?php

/**
 * Only permit a subset of WP editor block types.
 */

function sb_allowed_block_types($allowed_blocks)
{
	return [
		// 'core-embed/facebook',
		// 'core-embed/instagram',
		// 'core-embed/tumblr',
		// 'core-embed/twitter',
		// 'core-embed/youtube',
		'core/freeform',
		//'core/gallery',
		'core/heading',
		'core/image',
		'core/list',
		'core/paragraph',
		'core/separator',
		//'core/shortcode',
		'acf/sb-gallery',
	];
}

add_filter('allowed_block_types', 'sb_allowed_block_types');

/**
 * Add custom gallery block via ACF.
 */

function sb_custom_gallery_block()
{
	if (function_exists('acf_register_block')) {
		acf_register_block([
			'name' => 'sb_gallery',
			'title' => __('Gallery'),
			'description' => __('A gallery of several images.'),
			'render_callback' => 'sb_custom_gallery_block_render',
			'category' => 'formatting',
			'icon' => 'admin-comments',
			'keywords' => ['gallery', 'image'],
		]);
		acf_add_local_field_group([
			'key' => 'group_5ecad97a4294d',
			'title' => 'Block: Gallery',
			'fields' => [
				[
					'key' => 'field_5ecad98d18644',
					'label' => 'Images',
					'name' => 'block_gallery_images',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => [
						[
							'key' => 'field_5ecad9aa18645',
							'label' => 'Image',
							'name' => 'block_gallery_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => [
								'width' => '',
								'class' => '',
								'id' => '',
							],
							'return_format' => 'array',
							'preview_size' => 'medium',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						],
					],
				],
			],
			'location' => [
				[
					[
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/sb-gallery',
					],
				],
			],
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		]);
	}
}

add_action('acf/init', 'sb_custom_gallery_block');

function sb_custom_gallery_block_render($block)
{
	$slug = str_replace('acf/', '', $block['name']);
	if (file_exists(get_theme_file_path("/blocks/{$slug}.php"))) {
		include get_theme_file_path("/blocks/{$slug}.php");
	}
}
