<?php

if (function_exists('acf_add_local_field_group')):
	acf_add_local_field_group([
		'key' => 'group_5edb7c158568a',
		'title' => 'Meet staff',
		'fields' => [
			[
				'key' => 'field_5edb7c96f06b4',
				'label' => 'Current staff',
				'name' => 'about_staff_current',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'post_type' => [
					0 => 'meet_runner',
				],
				'taxonomy' => '',
				'filters' => [
					0 => 'search',
				],
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			],
			[
				'key' => 'field_5edb7ccdf06b5',
				'label' => 'Former staff',
				'name' => 'about_staff_former',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'post_type' => [
					0 => 'meet_runner',
				],
				'taxonomy' => '',
				'filters' => [
					0 => 'search',
				],
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			],
		],
		'location' => [
			[
				[
					'param' => 'page',
					'operator' => '==',
					'value' => '897',
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

	acf_add_local_field_group([
		'key' => 'group_5edb7ce736191',
		'title' => 'Media appearances',
		'fields' => [
			[
				'key' => 'field_5edb7cf75e9a2',
				'label' => 'Media appearances',
				'name' => 'about_media_appearances',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'collapsed' => 'field_5edb7d445e9a3',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => [
					[
						'key' => 'field_5edb7d445e9a3',
						'label' => 'Name',
						'name' => 'media_name',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					],
					[
						'key' => 'field_5edb7d5c5e9a4',
						'label' => 'Image',
						'name' => 'media_image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
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
					[
						'key' => 'field_5edb7d715e9a5',
						'label' => 'Link',
						'name' => 'media_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'placeholder' => '',
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'page',
					'operator' => '==',
					'value' => '897',
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
endif;
