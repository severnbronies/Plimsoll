<?php

if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page([
		'page_title' => 'Phase Banner',
		'menu_title' => 'Phase Banner',
		'parent_slug' => 'website-settings',
	]);

	acf_add_local_field_group([
		'key' => 'group_5ec903b4466aa',
		'title' => 'Phase Banner',
		'fields' => [
			[
				'key' => 'field_5ec903ce70362',
				'label' => 'Title',
				'name' => 'phase_banner_title',
				'type' => 'text',
				'instructions' => 'The primary text on the banner.',
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
				'key' => 'field_5ec903e770363',
				'label' => 'Subtitle',
				'name' => 'phase_banner_subtitle',
				'type' => 'text',
				'instructions' =>
					'Secondary text, providing more context to the title.',
				'required' => 0,
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
				'key' => 'field_5ec903f870364',
				'label' => 'Description',
				'name' => 'phase_banner_description',
				'type' => 'wysiwyg',
				'instructions' => 'Extended details, if necessary.',
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
				'delay' => 1,
			],
		],
		'location' => [
			[
				[
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-phase-banner',
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
