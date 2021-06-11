<?php

if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page([
		'page_title' => 'Header',
		'menu_title' => 'Header',
		'parent_slug' => 'website-settings',
	]);

	acf_add_local_field_group([
		'key' => 'group_60c3ba96e91a4',
		'title' => 'Logo colours',
		'fields' => [
			[
				'key' => 'field_60c3baa0fff2d',
				'label' => 'Color 1',
				'name' => 'logo_color_1',
				'type' => 'color_picker',
				'instructions' =>
					'Applied to the \'Severn\' text and speech bubble icon.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
			],
			[
				'key' => 'field_60c3bacffff2e',
				'label' => 'Color 2',
				'name' => 'logo_color_2',
				'type' => 'color_picker',
				'instructions' => 'Applied to the \'Bronies\' text.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'default_value' => '',
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-header',
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
		'key' => 'group_5ec94f2745a73',
		'title' => 'Banners',
		'fields' => [
			[
				'key' => 'field_5ec94f331834b',
				'label' => 'Banners',
				'name' => 'banners',
				'type' => 'repeater',
				'instructions' =>
					'Banners are shown at the top of the screen, and may be persistent or dismissible. They\'re good for short but important messaging.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [
					'width' => '',
					'class' => '',
					'id' => '',
				],
				'collapsed' => 'field_5ec94f801834c',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => [
					[
						'key' => 'field_5ec94f801834c',
						'label' => 'Banner Text',
						'name' => 'banner_text',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 1,
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
						'delay' => 1,
					],
					[
						'key' => 'field_5ec94f9c1834d',
						'label' => 'Dismissable?',
						'name' => 'banner_dismissable',
						'type' => 'true_false',
						'instructions' =>
							'Can the user dismiss the banner? Dismissing a banner makes it not appear to the user again for 28 days. The banner will show again if the banner text is altered.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => [
							'width' => '',
							'class' => '',
							'id' => '',
						],
						'message' => 'Yes, this banner can be dismissed.',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-header',
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
