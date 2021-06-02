<?php
if (function_exists('acf_add_local_field_group')):
	acf_add_local_field_group([
		'key' => 'group_60b7eb71af170',
		'title' => 'Groups and subgroups links',
		'fields' => [
			[
				'key' => 'field_60b7eb76bbdfb',
				'label' => 'Categories',
				'name' => 'group_categories',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'collapsed' => 'field_60b7eba3bbdfc',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add category',
				'sub_fields' => [
					[
						'key' => 'field_60b7eba3bbdfc',
						'label' => 'Category name',
						'name' => 'group_category_name',
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
						'key' => 'field_60b7ebbfbbdfd',
						'label' => 'Category icon',
						'name' => 'group_category_icon',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'return_format' => 'url',
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
						'key' => 'field_60b7ec42bbdfe',
						'label' => 'Description',
						'name' => 'group_content',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'basic',
						'media_upload' => 0,
						'delay' => 0,
					],
					[
						'key' => 'field_60b800ba18d02',
						'label' => 'Links',
						'name' => 'group_links',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'collapsed' => 'field_60b800e518d03',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => 'Add link',
						'sub_fields' => [
							[
								'key' => 'field_60b800e518d03',
								'label' => 'Link text',
								'name' => 'title',
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
								'key' => 'field_60b8010218d04',
								'label' => 'Link URL',
								'name' => 'href',
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
			],
		],
		'location' => [
			[
				[
					'param' => 'post_template',
					'operator' => '==',
					'value' => 'page-groups.php',
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
